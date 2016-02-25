<?php
namespace Edu\Cnm\Sprots\Test;

require_once("SprotsTest.php");

//grab the project test parameters
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

use Edu\Cnm\Sprots\PlayerStatistic;
use Edu\Cnm\Sprots\Sport;
use Edu\Cnm\Sprots\Game;
use Edu\Cnm\Sprots\Team;
use Edu\Cnm\Sprots\Player;
use Edu\Cnm\Sprots\Statistic;


/**
 * Full PHPUnit test for the PlayerStatistic class
 *
 * This is a complete PHPUnit test of the PlayerStatistic class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see PlayerStatistic
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class PlayerStatisticTest extends SprotsTest {

	/**
	 * $playerStatisticValue the value of individual stats, number value for a stat
	 * @var int $VALID_PLAYERSTATISTICVALUE
	 **/
	protected $VALID_PLAYERSTATISTICVALUE = 1678;

	/**
	 * timestamp of the Game; this starts as null and is assigned later
	 * @var \DateTime $VALID_GAMETIME
	 */
	protected $VALID_GAMETIME = "2015-03-23 14:20:04";
	/**
	 * timestamp of the Game; this starts as null and is assigned later
	 * @var \DateTime $VALID_GAMETIME
	 */
	protected $VALID_GAMETIME2 = "2015-02-23 14:23:02";

	/**
	 * Team Api ID that the team belongs to
	 * @var int $VALID_TEAMAPIID
	 */
	protected $VALID_TEAMAPIID = 462;

	/**
	 * content of the updated team api id
	 * @var string $VALID_TEAMAPIID2
	 **/
	protected $VALID_TEAMAPIID2 = 371;

	/**
	 * Team Api ID that the team belongs to
	 * @var int $VALID_PLAYERAPIID
	 */
	protected $VALID_PLAYERAPIID = 242;

	/**
	 * content of the updated team api id
	 * @var string $VALID_PLAYERAPIID2
	 **/
	protected $VALID_PLAYERAPIID2 = 771;

	/**
	 * Sport that the Player is playing
	 * @var Sport $sport
	 */
	protected $sport = null;
	/**
	 * Game that PlayerStatistic derived from
	 * @var Game $game
	 */
	protected $game = null;
	/**
	 * Player that the Stat is associated with
	 * @var Player $player
	 */
	protected $player = null;
	/**
	 * Player that the Stat is associated with
	 * @var Player $player2
	 */
	protected $player2 = null;
	/**
	 * Statistic that is associated with the player
	 * @var Statistic $statistic
	 */
	protected $statistic = null;
	/**
	 * Team that is associated with the Player
	 * @var team $team
	 */
	protected $team = null;
	/**
	 * Team that is associated with the Player
	 * @var team2 $team2
	 */
	protected $team2 = null;

	/**
	 * Create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Sport to own the test playerStatistic
		$this->sport = new Sport(null, "sportName", "sportLeague");
		$this->sport->insert($this->getPDO());

		//create and insert a team to own the test playerStatistic
		$this->team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, "TeamCity", "TeamName");
		$this->team->insert($this->getPDO());

		$this->team2 = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID2, "TeamCity2", "TeamName2");
		$this->team2->insert($this->getPDO());


		//create and insert a Game to own the test playerStatistic
		$this->game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), "2015-03-23 15:23:04");
		$this->game->insert($this->getPDO());

		// calculate the date (same as unit test)
		$this->VALID_GAMETIME = \DateTime::createFromFormat("Y-m-d H:i:s", "2015-03-23 15:23:04");
		$this->VALID_GAMETIME2 = \DateTime::createFromFormat("Y-m-d H:i:s", "2015-03-23 16:23:04");

		//create and insert a Player to own the test playerStatistic
		// int $newPlayerId = null, int $newPlayerApiId, int $newPlayerTeamId, int $newPlayerSportId, string $newPlayerName
		$this->player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(), $this->sport->getSportId(), "PlayerName");
		$this->player->insert($this->getPDO());

		$this->player2 = new Player(null, $this->VALID_PLAYERAPIID2, $this->team2->getTeamId(), $this->sport->getSportId(), "PlayerNames");
		$this->player2->insert($this->getPDO());

		//create and insert a Statistic to own the test playerStatistic
		$this->statistic = new Statistic(null, "statisticName");
		$this->statistic->insert($this->getPDO());

	}

	/**
	 * test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);

		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameIdAndPlayerStatisticPlayerIdAndPlayerStatisticTeamIdAndPlayerStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->player->getPlayerId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);
	}

	/**
	 * test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlayerStatisticByPlayerStatisticGameId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);

		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameId($this->getPDO(), $this->game->getGameId(), $this->player->getPlayerId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);

	}


	/**
	 * test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlayerStatisticByPlayerStatisticPlayerId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);

		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticPlayerId($this->getPDO(), $this->game->getGameId(), $this->player->getPlayerId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);

	}


	/**
	 * test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlayerStatisticByPlayerStatisticTeamId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);

		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticTeamId($this->getPDO(), $this->game->getGameId(), $this->player->getPlayerId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);

	}


	/**
	 * test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlayerStatisticByPlayerStatisticStatisticId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);

		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->player->getPlayerId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);

	}

	/**
	 * test inserting a PlayerStatistic that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidPlayerStatistic() {
		// create a Player Statistic with a non null id, and watch it fail
		$playerStatistic = new PlayerStatistic(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$playerStatistic->insert($this->getPDO());
	}

	/**
	 * test creating a PlayerStatistic and then deleting it
	 **/
	public function testUpdateValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");

		// create a new Player Statistic and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);
		$playerStatistic->insert($this->getPDO());

		// Edit the playerStatistic and update it in mySQL
		$playerStatistic->setPlayerStatisticValue($this->VALID_PLAYERSTATISTICVALUE);
		$playerStatistic->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameIdAndPlayerStatisticPlayerIdAndPlayerStatisticTeamIdAndPlayerStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->player->getPlayerId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);
	}

	/**
	 * test updating a PlayerStatistic that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidPlayerStatistic() {
		// create a friend with a non null friendId and watch it fail
		$playerStatistic = new PlayerStatistic(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$playerStatistic->insert($this->getPDO());
		$playerStatistic->update($this->getPDO());
	}

	/**
	 * test creating a PlayerStatistic and then deleting it
	 **/
	public function testDeleteValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");

		// create a new Player Statistic and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);
		$playerStatistic->insert($this->getPDO());

		// Delete the Player from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$playerStatistic->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameIdAndPlayerStatisticPlayerIdAndPlayerStatisticTeamIdAndPlayerStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->player->getPlayerId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertNull($pdoPlayerStatistic);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("playerStatistic"));
	}

	/**
	 * test deleting a PlayerStatistic That does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidPlayerStatistic() {
	// create a playerStatistic with a non null foreign key and watch it fail
		$playerStatistic = new PlayerStatistic(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$playerStatistic->insert($this->getPDO());
		$playerStatistic->delete($this->getPDO());
	}

	/**
	 * test inserting a PlayerStatistic and regrabbing it from mySQL
	 **/
	public function testGetValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");

		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);
		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = PlayerStatistic::getAllPlayerStatistics($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\PlayerStatistic", $results);

		// grab the result from the array and validate it
		$pdoPlayerStatistic = $results[0];
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);
	}

	/**
	 * test grabbing a PlayerStatistic that does not exist
	 **/
	public function testGetInvalidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");

		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->game->getGameId(), $this->player->getPlayerID(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE);
		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = PlayerStatistic::getAllPlayerStatistics($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\PlayerStatistic", $results);

		// grab the result from the array and validate it
		$pdoPlayerStatistic = $results[0];
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticPlayerId(), $this->player->getPlayerId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);

	}
}