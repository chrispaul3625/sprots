<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
/**
 * api for profile class
 * @author Dom Kratos <dom@domkratos.com>
 *
 */

// verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	// grab the db connection
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/sprots.ini");

	// if the profile session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["profile"]) === true) {
		setXsrfCookie("/");
		throw(new RuntimeException("Please log-in, or sign up", 401));
	}

	// determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// sanitize the inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	// make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	// sanitize and trim the other fields
	$profileId = filter_input(INPUT_GET, "profileId", FILTER_VALIDATE_INT);
	$profileUserName = filter_input(INPUT_GET, "profileUserName", FILTER_SANITIZE_STRING);
	$profileEmail = filter_input(INPUT_GET, "profileEmail", FILTER_SANITIZE_EMAIL);
	// handle REST calls
	if($method === "GET") {
		// set XSRF cookie
		setXsrfCookie("/");

		// get the profile based on the field
		if(empty($id) === false) {
			$profile = Profile::getProfileByProfileId($pdo, $id);
			if($profile !== null && $profile->getProfileId() === $_SESSION["profile"]->getProfileId()) {
				$reply->data = $profile;
			}
		} elseif(empty($profileUserName) === false) {
			$profile = Profile::getProfileByProfileUserName($pdo, $profileUserName);
			if($profile !== null && $profile->getProfileId() === $_SESSION["profile"]->getProfileId()) {
				$reply->data = $profile;
			}
		} elseif(empty($profileEmail) === false) {
			$profile = Profile::getProfileByProfileEmail($pdo, $id);
			if($profile !== null && $profile->getProfileId() === $_SESSION["profile"]->getProfileId()) {
				$reply->data = $profile;
			}
		}
	}
	// create, update, and delete of profile
	if($method === "PUT") {
		verifyXsrf();
		$profile = Profile::getProfileId($pdo, $id);
		if($profile === null) {
			throw(new RuntimeException ("Profile does not exist"));
		}
		// make sure the user is only trying to edit their own profile information
		$security = Profile::getProfileByProfileId($pdo, $_SESSION["profile"]->getProfileId());
		if(($security->getProfileId() === false) && ($_SESSION["profile"]->getProfileId() !== $profile->getProfileId())) {
			$_SESSION["profile"]->setProfileId(false);
			throw(new RunTimeException("You can only modify your own profile", 403));
		}
		$profile->setProfileUserName($requestObject->profileUserName);
		$profile->setProfileEmail($requestObject->profileEmail);

		// require a password. hash the pw, and set it.
		if($requestObject->profilePassword !== null) {
			$hash = hash_pbkdf2("sha512", $requestObject->profilePassword, $profile->getProfileSalt(), 262144, 128);
			$profile->setProfileHash($hash);
		}
		if(empty($requestObject->profilePassword) === true) {
			throw(new \PDOException("password is required"));
		}
		if(($profile->getProfileId() === false) && ($requestObject->profilePassword !== null))
			$profile->update($pdo);
		$reply->message = "Profile Updated";
	} // creating a profile
	elseif($method === "POST") {

		// hash the pw, and set it
		$password = bin2hex(openssl_random_pseudo_bytes(32));
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144, 128);
		$emailActivation = bin2hex(openssl_random_pseudo_bytes(8));
		// create new profile
		$profile = new Profile($id, $_SESSION["profile"]->getProfileId(), $requestObject->profileUserName, $requestObject->profleEmail, $hash, $salt);
		$profile->insert($pdo);
		$reply->message = "Profile Created!";
		// compose and send the email for confirmation and setting a new password
		// create swift message
		$swiftMessage = Swift_Message::newInstance();
		// attach the sender to the message
		// this takes the form of an associative array where the Email is the key for the real name
		$swiftMessage->setFrom(["email@gmail.com" => "Sprots"]);
		/**
		 * attach the recipients to the message
		 * notice this an array that can include or omit the the recipient's real name
		 * use the recipients' real name where possible; this reduces the probability of the Email being marked as spam
		 **/
		$recipients = [$requestObject->profileEmail];
		$swiftMessage->setTo($recipients);
		// attach the subject line to the message
		$swiftMessage->setSubject("Please confirm your Sprots account");
		/**
		 * attach the actual message to the message
		 * here, we set two versions of the message: the HTML formatted message and a special filter_var()ed
		 * version of the message that generates a plain text version of the HTML content
		 * notice one tactic used is to display the entire $confirmLink to plain text; this lets users
		 * who aren't viewing HTML content in Emails still access your links
		 **/
		// building the activation link that can travel to another server and still work. This is the link that will be clicked to confirm the account.
		$basePath = $_SERVER["SCRIPT_NAME"];
		for($i = 0; $i < 3; $i++) {
			$lastSlash = strrpos($basePath, "/");
			$basePath = substr($basePath, 0, $lastSlash);
		}
		$urlglue = $basePath . "/controllers/email-confirmation?emailActivation=" . $profile->getProfileEmail();
		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue;
		$message = <<< EOF
		<h1>You've been registered for Sprots, the best in up to date professional sport statistics!</h1>
		<p>Visit the following URL to set a new password and complete the registration process: </p>
		<a href="$confirmLink">$confirmLink</a></p>
EOF;
		$swiftMessage->setBody($message, "text/html");
		$swiftMessage->addPart(html_entity_decode(filter_var($message, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)), "text/plain");
		/**
		 * send the Email via SMTP; the SMTP server here is configured to relay everything upstream via CNM
		 * this default may or may not be available on all web hosts; consult their documentation/support for details
		 * SwiftMailer supports many different transport methods; SMTP was chosen because it's the most compatible and has the best error handling
		 * @see http://swiftmailer.org/docs/sending.html Sending Messages - Documentation - SwitftMailer
		 **/
		$smtp = Swift_SmtpTransport::newInstance("localhost", 25);
		$mailer = Swift_Mailer::newInstance($smtp);
		$numSent = $mailer->send($swiftMessage, $failedRecipients);
		/**
		 * the send method returns the number of recipients that accepted the Email
		 * so, if the number attempted is not the number accepted, this is an Exception
		 **/
		if($numSent !== count($recipients)) {
			// the $failedRecipients parameter passed in the send() method now contains contains an array of the Emails that failed
			throw(new RuntimeException("unable to send email", 404));
			/**
			 * the send method returns the number of recipients that accepted the Email
			 * so, if the number attempted is not the number accepted, this is an Exception
			 **/
			if($numSent !== count($recipients)) {
				// the $failedRecipients parameter passed in the send() method now contains contains an array of the Emails that failed
				throw(new RuntimeException("unable to send email", 404));
			}
		}
	} elseif($method === "DELETE") {
		verifyXsrf();
		// make sure the user is only deleting their own profile.
		$security = Profile::getProfileByProfileId($pdo, $_SESSION["profile"]->getProfileId());
		if(($security->getProfileId() === false) && ($_SESSION["profile"]->getProfileId() !== $profile->getProfileId())) {
			$_SESSION["profile"]->setProfileId(false);
			throw(new RunTimeException("You can only modify your own profile", 403));
		}
		$profile = Profile::getProfileByProfileId($pdo, $id);
		if($profile === null) {
			throw(new RangeException("Profile does not exist", 404));
		}
		$profile->delete($pdo);
		$deleteObject = new stdClass();
		$deleteObject->profileId = $id;
		$reply->message = "Profile deleted.";
	}
	// send exception bac to the caller
} catch(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);



