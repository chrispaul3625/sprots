<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{
	Game, Player, Sport, Statistic
};
use Edu\Cnm\Sprots\PlayerStatistic;


require_once("SprotsTest.php");

//grab the project test parameters
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

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
		$this->sport = new Sport(null, "sportTeam", "sportLeague");
		$this->sport->insert($this->getPDO());

		//create and insert a team to own the test playerStatistic
		$this->team = new Player(null, "playerName", $this->team->getTeamId(), 42);
		$this->team->insert($this->getPDO());
		$this->team2 = new Player(null, "playerName", $this->team2->getTeamId(), 42);
		$this->team2->insert($this->getPDO());

		//create and insert a Game to own the test playerStatistic
		$currentDate = new \DateTime();
		$this->game = new Game(null, $this->team->getTeamId(),"GameSecondTeamId", $currentDate);
		$this->game->insert($this->getPDO());

		//create and insert a Player to own the test playerStatistic
		$this->player = new Player(null, "playerName", $this->team->getTeamId(), 42);
		$this->player->insert($this->getPDO());
		$this->player2 = new Player(null, "playerName", $this->team2->getTeamId(), 65);
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
		$playerStatistic = new PlayerStatistic($this->player->getPlayerId(), $this->player2->getPlayerId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE );
		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameId($this->getPDO(), $playerStatistic->getPlayerStatisticStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->sport->getSportId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);

	}

	/**
	 * test inserting a PlayerStatistic that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidPlayerStatistic() {
// create a friend with a non null friendId and watch it fail
		$playerStatistic = new PlayerStatistic(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY, $this->VALID_PLAYERSTATISTICVALUE);
		$playerStatistic->insert($this->getPDO());
	}

	/**
	 * test creating a PlayerStatistic and then deleting it
	 **/
	public function testDeleteValidPlayerStatistic() {
// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistic");

// create a new Player Statistic and insert to into mySQL
		$playerStatistic = new PlayerStatistic($this->player->getPlayerId(), $this->player2->getPlayerId(), $this->statistic->getStatisticId(), $this->VALID_PLAYERSTATISTICVALUE );
		$playerStatistic->insert($this->getPDO());

// delete the Profile from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$playerStatistic->delete($this->getPDO());

// grab the data from mySQL and enforce the PlayerStatistic does not exist
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticPlayerId($this->getPDO(), $playerStatistic->getPlayerId());


	}













}