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


// Teams  Downloader for NFL
		try {
			$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
			$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
			if(empty($season) === true) {
				$today = new DateTime();
				$season = $today->format("Y");
			}
			$sport = Sport::getSportBySportLeague($pdo, "NFL")[0];

			$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

			$opts = array(
				'http' => array(
					'method' => "GET",
					'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"]["NFL"], 'content' => "{body}")
			);
			$context = stream_context_create($opts);

			$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Teams/$season", false, $context);
			$data = json_decode($response);
		} catch (Exception $exception) {
			echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
		} catch(TypeError $typeError) {
			echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
		}
		foreach($reply->data as $team) {
			$teamToInsert = new Team(null, $sport->getSportId(), $team->TeamID, $team->Key, $team->City, $team->Name);
			$teamToInsert->insert($pdo);
		}

// Schedules Downloader for NFL
try {
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
	$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
	if(empty($season) === true) {
		$today = new DateTime();
		$season = $today->format("Y");
	}

	$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

	$opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"]["NFL"], 'content' => "{body}")
	);
	$context = stream_context_create($opts);

	$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Schedules/$season", false, $context);
	$data = json_decode($response);
} catch (Exception $exception) {
	echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
} catch(TypeError $typeError) {
	echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
}
foreach($reply->data as $game) {
	$gameToInsert = new Team(null, $game->GameKey, $game->Date, $game->Week, $game->SeasonType);
	$gameToInsert->insert($pdo);
}


	//downloader for players NFL
try {
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
	$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
	if(empty($season) === true) {
		$today = new DateTime();
		$season = $today->format("Y");
	}
	$sport = Sport::getSportBySportLeague($pdo, "NFL")[0];
	$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

	$opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"]["NFL"], 'content' => "{body}")
	);
	$context = stream_context_create($opts);

	$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Players/$season", false, $context);
	$data = json_decode($response);
} catch (Exception $exception) {
	echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
} catch(TypeError $typeError) {
	echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
}
foreach($reply->data as $player) {
	$playerToInsert = new Player(null, $sport->getSportId(), $player->PlayerID , $player->team, $player->FirstName, $player->LastName);
	$playerToInsert->insert($pdo);
}
// downloader for standings NFL
	try {
		$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
		$season = filter_input(INPUT_GET, "season", FILTER_SANITIZE_STRING);
		if(empty($season) === true) {
			$today = new DateTime();
			$season = $today->format("Y");
		}

		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");

		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $config["fantasyData"]["NFL"], 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Standings/$season", false, $context);
		$data = json_decode($response);
	} catch (Exception $exception) {
		echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
	} catch(TypeError $typeError) {
		echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
	}
	foreach($reply->data as $standing) {
		$standingToInsert = new Standing(null, $standing->SeasonType, $standing->team, $standing->Name, $standing->LastName);
		$standingToInsert->insert($pdo);
	}

		header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);