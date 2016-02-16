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
	protected $VALID_PLAYERSTATISTICVALUE;

	/**
	 * Sport that the Player is playing
	 * @var Sport $VALID_SPORT
	 */
	protected $sport = null;
	/**
	 * Game that PlayerStatistic derived from
	 * @var Game $VALID_GAME
	 */
	protected $game = null;
	/**
	 * Player that the Stat is associated with
	 * @var Player $VALID_PLAYER
	 */
	protected $player = null;
	/**
	 * Statistic that is associated with the player
	 * @var Statistic $VALID_STATISTIC
	 */
	protected $statistic = null;

	/**
	 * Create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Sport to own the test playerStatistic
		$this->sport = new Sport(null, "sportTeam", "sportLeague");
		$this->sport->insert($this->getPDO());


		//create and insert a Game to own the test playerStatistic
		$this->game = new Game(null, "gameFirstTeamId","GameSecondTeamId","GameTime");
		$this->game->insert($this->getPDO());

		//create and insert a Player to own the test playerStatistic
		$this->player = new Player(null, "playerName", "playerTeamId", "playerApiId");
		$this->player->insert($this->getPDO());

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
		$playerStatistic = new PlayerStatistic(null, $this->plsayerStatistic->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTIC);
		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticGameId($this->getPDO(), $playerStatistic->getPlayerStatisticStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticStatisticId(), $this->sport->getSportId());
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticValue(), $this->VALID_PLAYERSTATISTICVALUE);


	}
















}