<?php
/**
 * Created by PhpStorm.
 * User: dom
 * Date: 2/26/16
 * Time: 11:22 AM
 */

require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/vendor/autoload");

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
	$favoriteTeamProfileId= filter_input(INPUT_GET, "profileId", FILTER_VALIDATE_INT);
	$favoriteTeamTeamId= filter_input(INPUT_GET, "teamId", FILTER_VALIDATE_INT);



	//get the team based on the given field
	if(empty($id) === false) {
		$favoriteTeam = FavoriteTeam::getFavoriteTeamByFavoriteTeamProfileIdAndFavoriteTeamTeamId($pdo, $id);
		$reply->data = $favoriteTeam;

	} elseif(empty($favoriteTeamTeamId) === false) {
		$favoriteTeam = FavoriteTeam::getFavoriteTeamsByFavoriteTeamProfileId($pdo, $teamId);
		$reply->date = $favoriteTeam;
	}



} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);





?>