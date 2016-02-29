<?php
/**
 * This is the email to confirm account
 * @author Dom Kratos <dom@domkratos.com>
 * Date: 2/26/16
 * Time: 11:16 AM
 */

// auto loader
require_once(dirname(dirname(dirname(__DIR__)) . "/php/classes/atoloder.php"));
// imports xsrf
require_once(dirname(dirname(__DIR__) . "/lib/xsrf.php"));
// a security file that's on the schools server, that Dylan created, so it'll show not found.
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

// verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare default error message
$reply = new stdClass();
$reply->status = 200;
$reply->message = null;

try {
	// connect to the db
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/sprots.ini");
	$profileEmailActivation = filter_input(INPUT_GET, "emailActivation", FILTER_SANITIZE_STRING);
	$profile = Profile::getProfileByProfileEmail($pdo, $profileEmailActivation);
	if(empty($profile) === true) {
		throw(new InvalidArgumentException("Activation code has been activated or does not exist\", 404"));
	} else {
		$profile->setProfileEmailActivation(null);
		$profile->update($pdo);
	}
	$reply->message = "Congratulations, your account has been activated!";
	// redirect them?

	// iterate to get to the right path i dunno what this does...
	for($i = 0; $i < 3; $i++) {
		$lastSlash = strrpos($basePath, "/");
		$basePath = substr($basePath, 0, $lastSlash);
	}

	// if
	if($profile->getProfileId() === true) {
		$urlglue = $basePath . "/template/email-validation-login.php";
	} else {
		// have to log-in the new profile, and allow them to update/change their password
		$profile->setProfileId(true);
		$_SESSION["profile"] = $profile;
		$repy->status = 200;
		$reply->message = "Successfully Logged in";
		$urlglue = $basePath . "/template/new-profile-login.php";
	}
} catch(Exception $exception) {
	$reply->status = $exception->getcode();
	$reply->message = $exception->getMessage();
}

header("Location: " . $urlglue);
header("Content-type: application/json");

if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);