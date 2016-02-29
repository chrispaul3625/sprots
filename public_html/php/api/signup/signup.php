<?php
/**
 *
 * micro api for signing up a new user.
 * @author Dom Kratos <dom@domkratos.com>
 * Date: 2/26/16
 * Time: 10:59 AM
 */

// auto loader
require_once(dirname(dirname(dirname(__DIR__)) . "/php/classes/atoloder.php"));
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

	// convert POSTed JSON to an object
	$requestContent = file_get_contents("php://input");
	$requestObject = json_decode($requestContent);

	// make sure form is filled out fully, to prevent db issues
	if(empty($requestObject->profileUserName) === true) {
		throw(new InvalidArgumentException("Must chose a user name", 405));
	}
	if(empty($requestObject->profileEmail) === true) {
		throw(new InvalidArgumentException("Must use a valid email", 405));
	}
	if(empty($requestObject->profilePassword) === true) {
		throw(new InvalidArgumentException("password cannot be empty", 405));
	}

	// sanitize the email
	$profileSalt = bin2hex(openssl_random_pseudo_bytes(32));
	$profileEmailActivation = bin2hex(openssl_random_pseudo_bytes(8));

	// create the hash
	$profileHash = hash_pbkdf2("sha512", $requestObject->profilePassword, $profileSalt, 262144, 128);

	// create a new Profile, and insert into db
	$profile = new Profile(null, $requestObject->profileEmail, $profileEmailActivation, $profile->insert($pdo);
	$reply->message = "A new Profile has been created";
}

// create Swift Message