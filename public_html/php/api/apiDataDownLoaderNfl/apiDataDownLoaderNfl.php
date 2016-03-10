<?php
namespace Edu\Cnm\Sprots;
require_once(dirname(__DIR__, 2) . "/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * This is an api to collect Teams from Fantasy data
 * @author Dom Kratos <dom@domkratos.com>
 * @author Dominic Cuneo <cuneo94@gmail.com>
 * Date: 2/26/16
 * Time: 11:23 AM
 */


// Teams  Downloader for NFL
try {
	$week = null;
	function (int $newWeek) {
		for($i = 1; $i < 21; $i++) {
			$i = newWeek;
			$this->setWeek($newWeek);
		}
	}
	$seasoning = ["2015", "2016"];
	foreach($seasoning as $season) {
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
	$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
	$apiKeys = json_decode($config["fantasyData"]);
	$opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $apiKeys->NFL, 'content' => "{body}")
	);
	$context = stream_context_create($opts);

	$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Teams/$season", false, $context);
	$data = json_decode($response);

	$stats = ["TeamID", "PlayerID", "City", "Name", "Conference", "Division","FullName", "StadiumID", "ByeWeek", "AverageDraftPosition", "AverageDraftPositionPPR","HeadCoach", "OffensiveCoordinator", "DefensiveCoordinator", "SpecialTeamsCoach", "OffensiveScheme", "DefensiveScheme", "UpcomingOpponent", "UpcomingOpponentRank ", "UpcomingOpponentPositionRank"];

	$sport = Sport::getSportBySportLeague($pdo, "NFL");

	foreach($data as $team) {
		$team = Team::getTeamByTeamApiId($pdo, $team->TeamID);
		if($team !== null){
		$teamToInsert = new Team(null, $team->TeamID, $team->getPlayerID(), $sport->getSportId(), $team->TeamCity, $team->TeamName);
		$teamToInsert->insert($pdo);
			$game = Game::getGameByGameFirstTeamId($pdo, $team->getTeamId());
			if($game === null) {
				$game = Game::getGameByGameSecondTeamId($pdo, $team->getTeamId());
			}

			// response from api
			//get team statistics by game
			$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/GameStatsByWeek/$season/$");
			$statisticData = json_decode($response);

			//adds statistic to database
			foreach($stats as $statisticName) {
				$statistic = Statistic::getStatisticByStatisticName($pdo, $statisticName);
				if($statistic === null || $statistic->getSize() <= 0) {
					$statistic = new Statistic(null, $statisticName);
					$statistic->insert($pdo);
				}else{
					$statistic = $statistic[0];
				}
				$statisticValue = $statisticData->$statisticName;
				if($statisticValue === null) {
					$statisticValue = " ";
				}
				$teamStatisticToInsert = new TeamStatistic($game->getGameId(), $teamToInsert->getTeamId(), $team->getTeamId(),$statistic->getStatisticId(), $statisticValue );
				$teamStatisticToInsert->insert($pdo);
				}
			}
		}
	}
} catch(Exception $exception) {
	echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
} catch(TypeError $typeError) {
	echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
}

// Schedules Downloader for NFL
try {
	// grab the db connection
	$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
	$apiKeys = json_decode($config["fantasyData"]);
	$opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $apiKeys->NFL, 'content' => "{body}")
	);
	$context = stream_context_create($opts);

	// response from api
	$seasoning = ["2015", "2016"];
	foreach($seasoning as $season) {
		$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Schedules/$season", false, $context);
		$data = json_decode($response);

		foreach($data as $game) {
			$badDate = str_replace("T", " ", $game->DateTime);
			if(empty($badDate) === false) {
				$teamChavez = Team::getTeamByTeamApiId($pdo, $game->AwayTeamID);
				$teamPaul = Team::getTeamByTeamApiId($pdo, $game->HomeTeamID);
				if($teamChavez !== null && $teamPaul !== null) {
					$gameToInsert = new Game(null, $teamChavez->getTeamId(), $teamPaul->getTeamId(), $badDate);
					$gameToInsert->insert($pdo);
				} else {
					echo "<p>* * * SIX OF THIRTEEN SKIPPED THIS GAME * * *</p>" . PHP_EOL;
				}
			}
		}
	}
} catch(Exception $exception) {
	echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
} catch(TypeError $typeError) {
	echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
}

//downloader for players NFL
try {
	$week = null;
	function (int $newWeek) {
		for($i = 1; $i < 21; $i++) {
			$i = newWeek;
			$this->setWeek($newWeek);
		}
	}
	$seasoning = ["2015", "2016"];
	foreach($seasoning as $season) {
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
	$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
	$apiKeys = json_decode($config["fantasyData"]);
	$opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $apiKeys->NFL, 'content' => "{body}")
	);
	$context = stream_context_create($opts);

	//response from Api
	$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/Players/$season", false, $context);
	$data = json_decode($response);

	$stats = ["PlayerID  ", "Team", "Number ", "FirstName ", "LastName", "Status ","Height ", "Weight", "BirthDate ", "College ", "Experience ","Active ", "PositionCategory ", "Name", "Age ", "ExperienceString ", "BirthDateString", "PhotoUrl ", "ByeWeek  ", "UpcomingGameOpponent ", "UpcomingGameWeek", "ShortName  ","AverageDraftPosition ", "DepthPositionCategory  ", "DepthPosition ", "DepthOrder  ", "DepthDisplayOrder ", "CurrentTeam  ", "HeightFeet  ", "UpcomingOpponentRank ", "UpcomingOpponentPositionRank ", "CurrentStatus"];

	$sport = Sport::getSportBySportLeague($pdo, "NFL");

	foreach($data as $player) {
		$team = Team::getTeamByTeamApiId($pdo, $player->TeamID);
		if($team !== null) {
			$playerToInsert = new Player(null, $player->PlayerID, $team->getTeamId(), $sport->getSportId(), $player->FirstName . " " . $player->LastName);
			$playerToInsert->insert($pdo);
			$game = Game::getGameByGameFirstTeamId($pdo, $team->getTeamId());
			if($game === null) {
				$game = Game::getGameByGameSecondTeamId($pdo, $team->getTeamId());
			}


			//get player statistic by game
			//response from api
			$response = file_get_contents("https://api.fantasydata.net/nfl/v2/JSON/PlayerGameStatsByPlayerID/$season/$week->getNewWeek()/$player->PlayerID");

			$statisticData = json_decode($response);

			//adds statistic to database
			foreach($stats as $statisticName) {
				$statistic = Statistic::getStatisticByStatisticName($pdo, $statisticName);
				if($statistic === null || $statistic->getSize() <= 0) {
					$statistic = new Statistic(null, $statisticName);
					$statistic->insert($pdo);
				} else {
					$statistic = $statistic[0];
				}
				$statisticValue = $statisticData->$statisticName;
				if($statisticValue === null) ;
				{
					$statisticValue = " ";
				}
				$playerStatisticToInsert = new PlayerStatistic($game->getGameId(), $player->getPlayerId(), $team->getGetTeamId(), $statistic->getStatisticId(),
					$statisticValue);
				$playerStatisticToInsert->insert($pdo);
				}
			}
		}
	}
} catch(Exception $exception) {
	echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
} catch(TypeError $typeError) {
	echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
}
