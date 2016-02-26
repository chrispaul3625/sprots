<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
/**
 * api for teamstatistic class
 * author Jude Chavez <chavezjude7@gmail.com>
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

	// determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

//Grab Statistic
	$teamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticId($pdo, $Id);
	$points = [];
	foreach($teamStatistic as $teamStatistic) {
		$points[] = [TeamStatistic::getTeamStatisticbyTeamStatisticId($pdo, $teamStatistic->getTeamStatisticId())_>getTeamStatisticStart()->getY(), TeamStatistic::getTeamStatisticbyTeamStatisticId($pdo, $teamStatistic->getTeamStatisticId())->getTeamStatisticStart()->getX()];
		$points[] = [TeamStatistic::getTeamStatisticByTeamStatisticId($pdo, $teamStatistic->getTeamStatisticId())->getTeamStatistic())->getStatisticStop()->getY(), TeamStatistic::getTeamStatisticByTeamStatisticId($pdo, $teamStatistic->getTeamStatisticId())->getTeamStatisticStop()->getX()];
	}
//add teamstatistics to reply
	$reply->points = $points;
} elseif(empty($teamStatisticId) === false) {
	$reply->data = TeamStatistic::getTeamStatisticByTeamStatisticId($pdo, $teamStatisticId)->toArray();
} elseif(empty($teamStatisticGameId) === false) {
	$reply->data = TeamStatistic::getTeamStatisticByTeamStatisticGameId($pdo, $teamStatisticGameId)->toArray();
} elseif(empty($teamStatisticTeamId) === false) {
	$reply->data = TeamStatistic::getTeamStatisticByTeamStatisticTeamId($pdo, $teamStatisticTeamId)->toArray();
} elseif(empty($teamStatisticStatisticId) === false) {
	$reply->data = TeamStatistic::getTeamStatisticByTeamStatisticStatisticId($pdo, $teamStatisticStatisticId)->toArray();
} else {
	$reply->data = TeamStatistic::getAllTeamStatistics($pdo)->toArray();
}

//verify user and verify object is not empty

// if the session belongs to an active user allow post
if(empty($_session["teamStatistic"]) === false && $_SESSION["teamStatistic"]->getUserAccountType() !== "X") {
	if($method === "PUT" || $method === "POST") {

		//verify the XSRF cookie is correct
		verifyXsrf();
		$requestConetent = file_get_contents("php://input");
		$requestObject = json_decode($requestConetent);

		//make sure all fields are present, in order to prevent database issues
		if(empty($requestObject->submitTeamStatisticId) === true ) {
			throw(new InvalidArgumentException("Team Statistic Id cannot be empty"));
		}
		if(empty($requestObject->submitTeamStatisticGameId) === true) {
			$requestObject->submitTeamStatisticGameId = null;
		}
		if(empty($requestObject->submitTeamStatisticTeamId)->toArray(); {
			$requestObject->submitTeamStatisticGameId = null;
		}
		if(empty($requestObject->submitTeamStatisticTeamId)->toArray(); {
			$requestObject->submitTeamStatisticTeamId = null;
		}
		if(empty($requestObject->submitTeamStatisticStatisitcId)->toArray(); {
			$requestObject->submitTeamStatisticStatisticId = null;
		}
		if($method === "PUT") {
			verifyXsrf();
			$teamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticId($pdo, $teamStatisticId);
			if($teamStatistic === null) {
				throw(new RuntimeException("Team Statistic does not Exist" , 404));
			}
			$teamStatistic = new TeamStatistic($teamStatisticId, $requestObject->userId, $teamStatistic->getbroswer(), $teamStatistic->getIpAdress(), $requestObject->$teamStatisticId, $requestObject->$teamStatisticGameId, $requestObject->$teamStatisticTeamId, $requestObject->$teamStatisticStatisticId, $trail->update($pdo);
			$reply->message = "teamStatistic submitted okay";
		}
	}
} else {
	// if not active user and attempting a method other than get, throw an exception
	if((empty($method) === false) && ($method !=="GET")) {
		throw(new RuntimeException("only active users are allowed to modify entries", 401));
		}
	}
} catch(exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();

	//blob
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);
