<?php
/**
 * This is a downloader, that will pull the teams, players, and game schedules, for NBA, NHL, and MLB
 * @author Dom Kratos <dom@domkratos.com>
 * User: dom
 * Date: 3/2/16
 * Time: 1:30 PM
 */


// this will make a call to the api, and pull all of the players, by active.
function getPlayers(string $league, int $playerSportId) {
	try {
		// grab the db connection
		$pdo = connetToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"][$league], 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		// response from api
		$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/Players", false, $context);
		$data = json_decode($response);

		foreach($data as $player) {
			$playerToInsert = new Player(null, $player->PlayerID, $player->TeamID, $playerSportId, $player->FirstName . " " . LastName);
			$playerToInsert->insert($pdo);
		}
	} catch (Exception $exception) {
		echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
	} catch(TypeError $typeError) {
		echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
	}
}

function getTeams(string $league, int $teamSportId) {
	try {
		// grab the db connection
		$pdo = connetToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"][$league], 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		// response from api
		$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/teams", false, $context);
		$data = json_decode($response);

		foreach($data as $team) {
			$teamToInsert = new Team(null, $teamSportId, $team->TeamID, $team->City, $team->Name);
			$teamToInsert->insert($pdo);
		}
	} catch (Exception $exception) {
		echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
	} catch(TypeError $typeError) {
		echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
	}
}

function getGames(string $league) {
	try {
		// grab the db connection
		$pdo = connetToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"][$league], 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		// response from api
		$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/Games/{season}", false, $context);
		$data = json_decode($response);
	} catch (Exception $exception) {
		echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
	} catch(TypeError $typeError) {
		echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
	}
}

