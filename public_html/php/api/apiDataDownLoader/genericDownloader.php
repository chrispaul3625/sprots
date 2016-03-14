<?php
namespace Edu\Cnm\Sprots;
require_once(dirname(__DIR__, 2) . "/classes/autoload.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * This is a downloader, that will pull the teams, players, and game schedules, for NBA, NHL, and MLB
 * @author Dom Kratos <dom@domkratos.com>
 * User: dom
 * Date: 3/2/16
 * Time: 1:30 PM
 */

$GLOBALS["stats"] = ["AtBats", "Runs", "Hits", "Singles", "Doubles", "Triples", "HomeRuns", "RunsBattedin", "BattingAverage", "Outs", "Strikeouts", "Walks", "HitByPitch", "Sacrifices", "SacrificeFlies", "GroundIntoDoublePlay", "StolenBases", "CaughtStealing", "PitchesSeen", "OnBasePercentage", "SluggingPercentage", "OnBasePlusSlugging", "Errors", "Wins", "Losses", "Saves", "InningsPitchedDecimal", "TotalOutsPitched", "InningsPitchedFull", "InningsPitchedOuts", "EarnedRunAverage", "PitchingHits", "PitchingRuns", "PitchingEarnedRuns", "PitchingWalks", "PitchingStrikeouts", "PitchingHomeRuns", "PitchesThrown", "PitchesThrownStrikes", "WalksHitsPerInningsPitched", "PitchingBattingAverageAgainst", "GrandSlams", "Games", "Minutes", "Seconds", "FieldGoalsMade", "FieldGoalsAttempted", "FieldGoalsPercentage", "EffectiveFieldGoalsPercentage", "TwoPointersMade", "TwoPointersAttempted", "TwoPointersPercentage", "ThreePointersMade", "ThreePointersAttempted", "ThreePointersPercentage", "FreeThrowsMade", "FreeThrowsAttempted", "FreeThrowsPercentage", "OffensiveRebounds", "DefensiveRebounds", "Rebounds", "OffensiveReboundsPercentage", "DefensiveReboundsPercentage", "TotalReboundsPercentage", "Assists", "Steals", "BlockedShots", "Turnovers", "PersonalFouls", "Points", "TrueShootingAttempts", "TrueShootingPercentage", "PlayerEfficiencyRating", "AssistsPercentage", "StealsPercentage", "BlocksPercentage", "TurnOversPercentage", "UsageRatePercentage", "Goals", "Assists", "ShotsOnGoal", "PowerPlayGoals", "ShortHandedGoals", "EmptyNetGoals", "PowerPlayAssists", "ShortHandedAssists", "HatTricks", "ShootoutGoals", "PlusMinus", "PenaltyMinutes", "Blocks", "Hits", "Takeaways", "Giveaways", "FaceoffsWon", "FaceoffsLost", "Shifts", "GoaltendingMinutes", "GoaltendingSeconds", "GoaltendingShotsAgainst", "GoaltendingGoalsAgainst", "GoaltendingSaves", "GoaltendingWins", "GoaltendingLosses", "GoaltendingShutouts"];


// this will make a call to the api, and pull all of the players, by active.
function getPlayers(string $league) {
	try {
		// grab the db connection
		$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
		$apiKeys = json_decode($config["fantasyData"]);
		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $apiKeys->$league, 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		// response from api
		$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/Players", false, $context);
		$data = json_decode($response);



		$sport = Sport::getSportBySportLeague($pdo, $league);
		/*todo

		Get Teams
		Get Game
		Use the player's team key to get team IDs from your database
		Use team ID to get games
		Use game date time + player api ID to get game stats

		*/
		// Adds players to database
		foreach($data as $player) {
			$team = Team::getTeamByTeamApiId($pdo, $player->TeamID);
				if($team !== null) {
					$playerToInsert = new Player(null, $player->PlayerID, $team->getTeamId(), $sport->getSportId(), $player->FirstName . " " . $player->LastName);
					$playerToInsert->insert($pdo);

				$game = Game::getGameByGameFirstTeamId($pdo, $team->getTeamId());
				if($game === null) {
					$game = Game::getGameByGameSecondTeamId($pdo, $team->getTeamId());
				}
				$gameDate = $game->getGameTime()->format("Y-m-d");

				// Get player statistics by game
				// response from api
				$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/PlayerGameStatsByPlayer/$gameDate/$player->PlayerID", false, $context);
				$statisticData = json_decode($response);

				// Adds statistics to database
				foreach($GLOBALS['stats'] as $statisticName) {
					$statistic = Statistic::getStatisticByStatisticName($pdo, $statisticName);
					if($statistic === null || $statistic->getSize() <= 0) {
						$statistic = new Statistic(null, $statisticName);
						$statistic->insert($pdo);
					} else {
						$statistic = $statistic[0];
					}
					if(empty($statisticData->$statisticName) === false) {
						$playerStatisticToInsert = new PlayerStatistic($game->getGameId(), $playerToInsert->getPlayerId(), $team->getTeamId(), $statistic->getStatisticId(), $statisticData->$statisticName);
						$playerStatisticToInsert->insert($pdo);
					}
//					var_dump($statisticData);
//					var_dump($statisticName);
//					var_dump($statistic);
//					var_dump($statisticValue);
				}
			} else {
				echo "<p>* * * SIX OF THIRTEEN IS NOT A TEAM PLAYER * * *</p>" . PHP_EOL;
			}
		}

	} catch(Exception $exception) {
		echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
	} catch(TypeError $typeError) {
		echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
	}
}

/**
 * @param string $league
 * @param int $teamSportId
 */
function getTeams(string $league, int $teamSportId) {
	try {
		// grab the db connection
		$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
		$apiKeys = json_decode($config["fantasyData"]);
		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $apiKeys->$league, 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		// response from api
		$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/teams", false, $context);
		$data = json_decode($response);

		// Places team in designated sport, and populates teams in team db with response from api
		$sport = Sport::getSportBySportLeague($pdo, $league);
		foreach($data as $team) {
			$team = new Team(null, $sport->getSportId(), $team->TeamID, $team->City, $team->Name);
			$team->insert($pdo);

			// get team statistics by game
			$game = Game::getGameByGameFirstTeamId($pdo, $team->getTeamId());
			if($game === null) {
				$game = Game::getGameByGameSecondTeamId($pdo, $team->getTeamId());
				if($game === null) {
					continue;
				}
			}
			$gameDate = $game->getGameTime()->format("Y-m-d");

			// response from api
			$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/TeamGameStatsByDate/$gameDate");
			$statisticData = json_decode($response);

			// adds statistics to database
			foreach($GLOBALS['stats'] as $statisticName) {
				$statistic = Statistic::getStatisticByStatisticName($pdo, $statisticName);
				if($statistic === null || $statistic->getSize() <= 0) {
					$statistic = new Statistic(null, $statisticName);
					$statistic->insert($pdo);
				} else {
					$statistic = $statistic[0];
				}
				$statisticValue = $statisticData->$statisticName;
				if($statisticValue !== null) {
//					$statisticValue = "";
					$teamStatisticToInsert = new TeamStatistic($game->getGameId(), $team->getTeamId(), $statistic->getTeamStatisticStatisticId(), $statisticValue);
					$teamStatisticToInsert->insert($pdo);
				} else {
					echo "<p> team statistics isn't working </p>" . PHP_EOL;
				}
			}
		}

	} catch(Exception $exception) {
		echo "Something went wrong: " . $exception->getMessage() . PHP_EOL;
	} catch(TypeError $typeError) {
		echo "Something went wrong: " . $typeError->getMessage() . PHP_EOL;
	}
}

function getGames(string $league) {
	try {
		// grab the db connection
		$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
		$config = readConfig("/etc/apache2/capstone-mysql/sprots.ini");
		$apiKeys = json_decode($config["fantasyData"]);
		$opts = array(
			'http' => array(
				'method' => "GET",
				'header' => "Content-Type: application/json\r\nOcp-Apim-Subscription-key: " . $apiKeys->$league, 'content' => "{body}")
		);
		$context = stream_context_create($opts);

		// response from api
		$seasoning = ["2015", "2016"];
		foreach($seasoning as $season) {
			$response = file_get_contents("https://api.fantasydata.net/$league/v2/JSON/Games/$season", false, $context);
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
}

$sportLeagues = ["NHL", "NBA", "MLB"];
$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/sprots.ini");
foreach($sportLeagues as $sportLeague) {
	$sport = Sport::getSportBySportLeague($pdo, $sportLeague);
	getTeams($sportLeague, $sport->getSportId());
	getGames($sportLeague);
	getPlayers($sportLeague);
}