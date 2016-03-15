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

try{
//grab the mySQL connection
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");

//determine which HTTP method was used
$method = arry_key_exist("HTTP_X_HTTP_METHOD",$_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

//sanitize inputs
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
//make sure the id is valid for methods that require it
if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
	throw(new InvalidArgumentException("id can not be empty or negitive", 405));
}

//sanitize and trim other fields
$playerStatisticGameId = filter_input(INPUT_GET, "gameId", FILTER_SANITIZE_NUMBER_INT);
$playerStatisticPlayerId = filter_input(INPUT_GET, "playerId", FILTER_SANITIZE_NUMBER_INT);
$playerStatisticStatisticId = filter_input(INPUT_GET, "statisticId", FILTER_SANITIZE_NUMBER_INT);
$playerStatisticValue = filter_input(INPUT_GET, "statisticValue", FILTER_SANITIZE_NUMBER_INT);

//handle REST calls, while only allowing administrators to access database-modifying methods
if($method === "GET") {
	//set XSRF cookie
	setXsrfCookie("/");
	//get the playerStatistic based on the given field
} else if(empty($playerStatisticGameId) === false) {
	$playerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameId($pdo, $playerStatisticGameId);
		$reply->data = $playerStatistic;

} else if(empty($playerStatisticPlayerId) === false) {
	$playerStatistics = PlayerStatistic::getPlayerStatisticByPlayerStatisticPlayerId($pdo, $playerStatisticPlayerId)->toArray();
	$reply->data = $playerStatistic;

} else if(empty($playerStatisticStatisticId) === false) {
	$playerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticStatisticId($pdo, $playerStatisticStatisticId);
	$reply->data = $playerStatistic;
		}

}catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);