<?php
require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/vendor/autoload.php");

/**
 * controller/api for the playerStatistic  class
 *
 * @author Chris Paul christopher@christopherapaul.com.com>
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
$playerStatisticGameId = filter_input(INPUT_GET, "gameId", FILTER_SANITIZE_NUMBER_INT);
$playerStatisticPlayerId = filter_input(INPUT_GET, "playerId", FILTER_SANITIZE_NUMBER_INT);
$playerStatisticStatisticId = filter_input(INPUT_GET, "statisticId", FILTER_SANITIZE_NUMBER_INT);
$playerStatisticValue = filter_input(INPUT_GET, "statisticValue", FILTER_SANITIZE_NUMBER_INT);

//handle REST calls, while only allowing administrators to access database-modifying methods
//FIXME: define the method
if($method === "GET") {
	//set XSRF cookie
	setXsrfCookie("/");
	//get the playerStatistic based on the given field
} else if(empty($playerStatisticGameId) === false) {
	$playerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameId($pdo, $playerStatisticGameId);
	if($playerStatistic !== null && $playerStatistic->getGameId() === $_SESSION["playerStatistic"]->getGameId()) {
		$reply->data = $playerStatistic;
	}
} else if(empty($playerStatisticPlayerId) === false) {
	$playerStatistics = PlayerStatistic::getPlayerStatisticByPlayerStatisticPlayerId($pdo, $playerStatisticPlayerId)->toArray();
	$reply->data = $playerStatistic;

} else if(empty($playerStatisticStatisticId) === false) {
	$playerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticStatisticId($pdo, $playerStatisticStatisticId);
	if($playerStatistic !== null && $playerStatistic->getStatisticId() === $_SESSION["playerStatistic"]->getStatisticId()) {
		$reply->data = $playerStatistic;
	}
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);

