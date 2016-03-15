<?php
/**
 *
 * micro api for logging in
 * @author Dom Kratos <dom@domkratos.com>
 * Date: 2/26/16
 * Time: 10:59 AM
 */

// auto loader
require_once(dirname(dirname(dirname(__DIR__)) . "/php/classes/autoloader.php"));
// imports xsrf
require_once(dirname(dirname(__DIR__) . "/lib/xsrf.php"));
// a security file that's on the schools server, that Dylan created, so it'll show not found.
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

// prepare the default error message
$reply = new stdClass();
$reply->status = 200;
$reply->message = null;


try {
	// start the session and create an xsrf token
	if(session_start() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	verifyXsrf();

	// connect to the db
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/sprots.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	if($method === "POST") {

		// convert JSON to an object
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// sanitize the email, and search by profileEmail
		$profileEmail = filter_var($requestObject->profileEmail, FILTER_SANITIZE_EMAIL);
		$profile = Profile::getProfileByProfileEmail($pdo, $profileEmail);

		if($profile !== null) {
			$profileHash = hash_pbkdf2("sha512", $requestObject->password, $profile->getProfileSalt(), 262144, 128);
			if($profileHash === $profile->getProfileHash()) {
				$_SESSION["Profile"] = $profile;
				$reply->status = 200;
				$reply->message = "Successfully logged in";
			} else {
				throw(new InvalidArgumentException("email or password is invalid", 401));
			}
		}
	} else {
		throw (new \Exception("Invalid HTTP method"));
	}
	// create an exception to pass back to the REST caller
}  catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}


header("Content-type: application/json");
echo json_encode($reply);

