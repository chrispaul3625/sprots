<?php
namespace Edu\Cnm\Sprots\Test;

require_once("SprotsTest.php");

//grab the project test parameters
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

use Edu\Cnm\Sprots\TeamStatistic;
use Edu\Cnm\Sprots\Sport;
use Edu\Cnm\Sprots\Game;
use Edu\Cnm\Sprots\Team;
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
class TeamStatisticTest extends SprotsTest {

	/**
	 * $playerStatisticValue the value of individual stats, number value for a stat
	 * @var int $VALID_PLAYERSTATISTICVALUE
	 **/
	protected $VALID_TEAMSTATISTICVALUE = 1678;

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
	 * Team Api ID that the Team belongs to
	 * @var int $VALID_TEAMAPIID
	 */
	protected $VALID_TEAMAPIID = 462;

	/**
	 * content of the updated Team api id
	 * @var string $VALID_TEAMAPIID2
	 **/
	protected $VALID_TEAMAPIID2 = 371;
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
	 * Statistic that is associated with the Player
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

		//create and insert a Sport to own the test TeamStatistic
		$this->sport = new Sport(null, "sportName", "sportLeague");
		$this->sport->insert($this->getPDO());

		//create and insert a Team to own the test TeamStatistic
		$this->team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, "TeamCity", "TeamName");
		$this->team->insert($this->getPDO());

		$this->team2 = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID2, "TeamCity2", "TeamName2");
		$this->team2->insert($this->getPDO());


		//create and insert a Game to own the test PlayerStatistic
		$this->game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), "2015-03-23 15:23:04");
		$this->game->insert($this->getPDO());

		// calculate the date (same as unit test)
		$this->VALID_GAMETIME = \DateTime::createFromFormat("Y-m-d H:i:s", "2015-03-23 15:23:04");
		$this->VALID_GAMETIME2 = \DateTime::createFromFormat("Y-m-d H:i:s", "2015-03-23 16:23:04");

		//create and insert a Statistic to own the test PlayerStatistic
		$this->statistic = new Statistic(null, "statisticName");
		$this->statistic->insert($this->getPDO());

	}

	/**
	 * test inserting a valid TeamStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidTeamStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);

		$teamStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticGameIdAndTeamStatisticTeamIdAndTeamStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);
	}

	/**
	 * test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidTeamStatisticByTeamStatisticGameId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);

		$teamStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticGameId($this->getPDO(), $this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);

	}


	/**
	 * test inserting a valid TeamStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidTeamStatisticByTeamStatisticPlayerId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);

		$teamStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticTeamId($this->getPDO(), $this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);

	}


	/**
	 * test inserting a valid TeamStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidTeamStatisticByTeamStatisticTeamId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");


		// create a new TeamStatistics and insert to into mySQL
		$TeamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);

		$TeamStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticTeamId($this->getPDO(), $this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);

	}


	/**
	 * test inserting a valid TeamStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidTeamStatisticByTeamStatisticStatisticId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");


		// create a new PlayerStatistics and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);
		$teamStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);

	}

	/**
	 * test inserting a TeamStatistic that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidTeamStatistic() {
		// create a Team Statistic with a non null id, and watch it fail
		$teamStatistic = new TeamStatistic(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$teamStatistic->insert($this->getPDO());
	}

	/**
	 * test creating a teamStatistic and then deleting it
	 **/
	public function testUpdateValidTeamStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");

		// create a new Team Statistic and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);
		$teamStatistic->insert($this->getPDO());

		// Edit the teamStatistic and update it in mySQL
		$teamStatistic->setTeamStatisticValue($this->VALID_TEAMSTATISTICVALUE);
		$teamStatistic->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticGameIdAndTeamStatisticTeamIdAndTeamStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);
	}

	/**
	 * test updating a TeamStatistic that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidTeamStatistic() {
		// create a friend with a non null friendId and watch it fail
		$teamStatistic = new TeamStatistic(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$teamStatistic->insert($this->getPDO());
		$teamStatistic->update($this->getPDO());
	}

	/**
	 * test creating a TeamStatistic and then deleting it
	 **/
	public function testDeleteValidTeamStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");

		// create a new Player Statistic and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);
		$teamStatistic->insert($this->getPDO());

		// Delete the Team from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$teamStatistic->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = TeamStatistic::getTeamStatisticByTeamStatisticGameIdAndTeamStatisticTeamIdAndTeamStatisticStatisticId($this->getPDO(), $this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId());
		$this->assertNull($pdoTeamStatistic);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("teamStatistic"));
	}

	/**
	 * test deleting a TeamStatistic That does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidTeamStatistic() {
// create a PlayerStatistic with a non null foreign key and watch it fail
		$teamStatistic = new TeamStatistic(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$teamStatistic->insert($this->getPDO());
		$teamStatistic->delete($this->getPDO());
	}

	/**
	 * test inserting a TeamStatistic and regrabbing it from mySQL
	 **/
	public function testGetValidTeamStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");

		// create a new TeamStatistics and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);
		$teamStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = TeamStatistic::getAllTeamStatistics($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\TeamStatistic", $results);

		// grab the result from the array and validate it
		$pdoTeamStatistic = $results[0];
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);
	}

	/**
	 * test grabbing a TeamStatistic that does not exist
	 **/
	public function testGetInvalidTeamStatistic() {
// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");

		// create a new TeamStatistics and insert to into mySQL
		$teamStatistic = new TeamStatistic($this->game->getGameId(), $this->team->getTeamId(), $this->statistic->getStatisticId(), $this->VALID_TEAMSTATISTICVALUE);
		$teamStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = TeamStatistic::getAllTeamStatistics($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\TeamStatistic", $results);

		// grab the result from the array and validate it
		$pdoTeamStatistic = $results[0];
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->game->getGameId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->statistic->getStatisticId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);

	}
}