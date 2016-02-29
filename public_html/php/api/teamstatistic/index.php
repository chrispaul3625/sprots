<?php
require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/vendor/autoload.php");

/**
 * controller/api for the teamStatistic  class
 *
 * @author Jude Chavez <chavezjude7@gmail.com>
 */

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;


//grab the mySQL connection
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");

//sanitize inputs
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

//sanitize and trim other fields
$teamStatisticGameId= filter_input(INPUT_GET, "GameId", FILTER_SANITIZE_NUMBER_INT);
$teamStatisticTeamId = filter_input(INPUT_GET, "TeamId", FILTER_SANITIZE_NUMBER_INT);
$teamStatisticStatisticId = filter_input(INPUT_GET, "StatisticId", FILTER_SANITIZE_NUMBER_INT);
$teamStatisticValue = filter_input(INPUT_GET, "Team Statistic Value", FILTER_SANITIZE_NUMBER_INT);

//handle REST calls, while only allowing administrators to access database-modifying methods
if($method === "GET") {
	//set XSRF cookie
	setXsrfCookie("/");
	//get the teamStatistic based on the given field
} else if(empty($teamStatisticGameId) === false) {
	$teamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticGameId($pdo, $teamStatisticGameId);
	if($teamStatistic !== null && $teamStatistic->getGameId() === $_SESSION["teamStatistic"]->getGameId()) {
		$reply->data = $teamStatistic;
	}
} else if(empty($teamStatisticTeamId) === false) {
	$teamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticTeamId($pdo, $teamStatisticTeamId);
	if($teamStatistic !== null && $teamStatistic->getPlayerId() === $_SESSION["teamStatistic"]->getTeamId()) {
		$reply->data = $teamStatistic;
	}
} else if(empty($teamStatisticStatisticId) === false) {
	$teamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticStatisticId($pdo, $teamStatisticStatisticId);
	if($teamStatistic !== null && $teamStatistic->getStatisticId() === $_SESSION["teamStatistic"]->getStatisticId()) {
		$reply->data = $teamStatistic;
	}
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);


