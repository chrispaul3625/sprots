<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/vendor/autoload.php");

/**
 * api for the statistic class
 * @author Dominic Cuneo < cuneo94@gmail.com
 *
 */

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

//prepare  an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try{
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");


	//determine which HTTP method was used
	$method = arry_key_exist("HTTP_X_HTTP_METHOD",$_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id can not be empty or negitive", 405));
	}


	//Sanitize and trim other fields
	$statisticId = filter_input(INPUT_GET, "statisticId", FILTER_VALIDATE_INT);
	$statisticName = filter_input(INPUT_GET, "statisticName", FILTER_SANITIZE_STRING);

	//handle REST calls, while only allowing administrators to access database-modifying methods
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");
		//get the volunteer based on the given field
		if(empty($id) === false) {
			$statistic = Statistic::getStatisticByStatisticId($pdo, $id);
			if($statistic !== null && $statistic->getStatisticId() === $_SESSION["statistic"]->getStatisticId()) {
				$reply->data = $statistic;
			}
		} else if(empty($name) === false) {
			$statistic = Statistic::getStatisticByStatisticName($pdo, $statisticName);
			if($statistic !== null && $statistic->getStatisticId() === $_SESSION["statistic"]->getStatisticId()) {
				$reply->data = $statistic;
			}
		}
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