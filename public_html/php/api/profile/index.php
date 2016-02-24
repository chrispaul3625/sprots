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
	}
	if($method === "POST") {
		$profile = new Profile($id, $_SESSION["profile"]->getProfileId(), $requestObject->profileUserName, $requestObject->profleEmail, $hash, $salt);
		$profile->insert($pdo);

		$reply->message = "Profile Created!";
	} elseif($method === "DELETE") {
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
	} catch(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}
}

