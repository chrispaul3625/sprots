<?php
/**
 * This is an api to collect Teams from Fantasy data
 * @author Dom Kratos <dom@domkratos.com>
 * @author Dominic Cuneo <cuneo94@gmail.com>
 * Date: 2/26/16
 * Time: 11:23 AM
 */
require_once dirname(dirname(__DIR__)) . "/classes/autoload.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

	// grab the db connection
	$pdo = connetToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");

// Teams  Downloader for NFL
		try {
			$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
			if(empty($season) === true) {
				$today = new DateTime();
				$season = $today->format("Y");
			}

			$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

			$opts = array(
				'http' => array(
					'method' => "GET",
					'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"], 'content' => "{body}")
			);
			$context = stream_context_create($opts);

			$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Teams/$season", false, $context);
			$reply->data = json_decode($response);
		} catch(Exception $exception) {
			$reply->status = $exception->getCode();
			$reply->message = $exception->getMessage();
		} catch(TypeError $typeError) {
			$reply->status = $typeError->getCode();
			$reply->message = $typeError->getMessage();
		}
		foreach($reply->data as $team) {
			$teamToInsert = new Team(null, $team->TeamID, $team->Key, 1,  $team->City, $team->Name);
			$teamToInsert->insert($pdo);
		}

// Schedules Downloader for NFL
try {
	$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
	if(empty($season) === true) {
		$today = new DateTime();
		$season = $today->format("Y");
	}

	$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

	$opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"], 'content' => "{body}")
	);
	$context = stream_context_create($opts);

	$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Schedules//$season", false, $context);
	$reply->data = json_decode($response);
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
foreach($reply->data as $game) {
	$gameToInsert = new Team(null, $game->GameKey, 1, $game->Date, $game->Week, $game->SeasonType);
	$gameToInsert->insert($pdo);
}


	//downloader for players NFL
try {
	$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
	if(empty($season) === true) {
		$today = new DateTime();
		$season = $today->format("Y");
	}

	$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

	$opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"], 'content' => "{body}")
	);
	$context = stream_context_create($opts);

	$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Players/$season", false, $context);
	$reply->data = json_decode($response);
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
foreach($reply->data as $player) {
	$playerToInsert = new Player(null, $player->PlayerID , 1,  $player->team, $player->FirstName, $player->LastName);
	$playerToInsert->insert($pdo);
}
// downloader for standings NFL
	try {
		$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
		if(empty($season) === true) {
			$today = new DateTime();
			$season = $today->format("Y");
		}

		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"], 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Standings/$season", false, $context);
		$reply->data = json_decode($response);
	} catch(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	} catch(TypeError $typeError) {
		$reply->status = $typeError->getCode();
		$reply->message = $typeError->getMessage();
	}
	foreach($reply->data as $standing) {
		$standingToInsert = new Standing(null, $standing->SeasonType, 1, $standing->team, $standing->Name, $standing->LastName);
		$standingToInsert->insert($pdo);
	}

		header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);