<?php
require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once dirname(dirname(__DIR__)) . "/lib./xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/vendor/autoload");

/**
 * API for the Game class
 * @author Dominic Cuneo < cuneo94@gmail.com
 */

//verify the xsrf challange
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
// grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");

//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $SERVER["REQUEST_METHOD"];

//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id can not be empty or negitive", 405));
	}

//sanitize and trim other fields
	$gameId = filter_input(INPUT_GET, "gameId", FILTER_VALIDATE_INT);
	$gameFirstTeamId = filter_input(INPUT_GET, "gameFirstTeamId", FILTER_VALIDATE_INT);
	$gameSecondTeamId = filter_input(INPUT_GET, "gameSecondTeamID", FILTER_VALIDATE_INT);
	$gameTime = filter_input(INPUT_GET, "gameTime", FILTER_VALIDATE_INT);
	$gameTime /= 1000;
	$gameTime = DateTime::createFromFormat("U", strval($gameTime));

	// get the Game based on the given field
	if(empty($id) === false){
		$game = Game::getGameByGameId($pdo, $id);
		if($game !== null && $game->getGameId() === $_SESSION["Game"]->getGameId()){
			$reply->data = $game;
		}
	}else if(empty($gameFirstTeamId) === false){
		$game = Game::getGameByGameFirstTeamId($pdo, $id);
		if($game !== null && $game->getGameId() === $_SESSION["Game"]->getGameId()){
			$reply->data = $game;
		}
	}else if(empty($gameSecondTeamId) === false){
		$game = Game::getGameByGameSecondTeamId($pdo, $id);
		if($game !== null && $game->getGameId() === $_SESSION["Game"]->getGameId()){
			$reply->data = $game;
		}
	}else if (empty($gameTime) === false){
		$game = Game::getGameByGameTime($pdo,$gameTime);
		if($game !== null && $game->getGameTime() === $_SESSION["Game"]->getGameTime()){
			$reply->data = $game;
		}
	else {
			$reply->data = Game::getGamebyGameId($pdo, $_SESSION["Game"]->getGameId())->toArray();
		}
	}

	//send Exception back to caller
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