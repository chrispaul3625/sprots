<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib./xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/vendor/autoload");

/**
 * API for the player class
 */

//verify the xsrf challenge

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
		// grab the MySQL connection
		$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");

		//determine which HTTP method was used
		$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $SERVER["REQUEST_METHOD"];

		//sanitize inputs
		$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
		//make sure the id is valid for methods that require it
		if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id can not be empty or negative", 405));
	}

		//sanitize and trim other fields
		$playerId = filter_input(INPUT_GET, "playerId", FILTER_VALIDATE_INT);
		$playerTeamId = filter_input(INPUT_GET, "playerTeamId", FILTER_VALIDATE_INT);
		$playerSportId = filter_input(INPUT_GET, "playerSportId", FILTER_VALIDATE_INT);
		$playerName = filter_input(INPUT_GET, "playerName", FILTER_SANITIZE_STRING);

		//handle rest calls
		if (method ==="GET") {
		// set XSRF cookie
		setXsrfCookie("/");


	}



}





?>