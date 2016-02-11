<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{
	Game, Player, Sport, Statistic
};
use Edu\Cnm\Sprots\PlayerStatistics;

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
class PlayerStatisticsTest extends SprotsTest {
	/**
	 * Game that PlayerStatistic derived from
	 * @var Game $VALID_GAME
	 */
	protected $VALID_GAME = null;
	/**
	 * Player that the Stat is associated with
	 * @var Player $VALID_PLAYER
	 */

	protected $VALID_PLAYER = null;
	/**
	 * Player Statistics of the player
	 * @var PlayerStatistics $VALID_PLAYERSTATISTICS
	 */
	protected $VALID_PLAYERSTATISTICS = null;
	/**
	 * Sport that the Player is playing
	 * @var Sport $VALID_SPORT
	 */
	protected $VALID_SPORT = null;
	/**
	 * Statistic that is associated with the player
	 * @var Statistic $VALID_STATISTIC
	 */
	protected $VALID_STATISTIC = null;

	/**
	 * Create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Game to own the test playerStatistics
		$this->game = new Game(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->game->insert($this->getPDO());

		//create and insert a Player to own the test playerStatistics
		$this->player = new Player(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->player->insert($this->getPDO());

		//create and insert a PlayerStatistics to own the test playerStatistics
		$this->playerstatistics = new PlayerStatistics(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->playerStatsitics->insert($this->getPDO());

		//create and insert a Sport to own the test playerStatistics
		$this->sport = new Sport(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->sport->insert($this->getPDO());

		//create and insert a Statistic to own the test playerStatistics
		$this->statistic = new Statistic(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->statistic->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Game and verify that the actual mySQL data matches
	 **/
	public function testInsertValidGame() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("game");

		// create a new Game and insert to into mySQL
		$game = new Game(null, $this->game->getGameId(), $this->VALID_GAME);
		$game->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
		$this->assertEquals($pdoGame->getGameId(), $this->game->getGameId());

	}
	/**
	 * test inserting a Game that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidGame() {
		// create a Game with a non null game id and watch it fail
		$game = new Game(DataDesignTest::INVALID_KEY, $this->game->getGameId());
		$game->insert($this->getPDO());
	}

/**
* test inserting a valid Player and verify that the actual mySQL data matches
**/
	public function testInsertValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->player->getPlayerId(), $this->VALID_PLAYER);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertEquals($pdoPlayer->getPlayerId(), $this->game->getPlayerId());
	}
	/**
	 * test inserting a Player that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidPlayer() {
		// create a Player with a non null Player id and watch it fail
		$player = new Player(DataDesignTest::INVALID_KEY, $this->player->getPlayerId());
		$player->insert($this->getPDO());
	}

/**
* test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
**/
	public function testInsertValidPlayerStatistics() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistics");

		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistics = new PlayerStatistics(null, $this->plsayerStatistics->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTICS);
		$playerStatistics->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistics = PlayerStatistics::getPlayerStatisticsByPlayerStatisticId($this->getPDO(), $playerStatistics->getPlayerStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistics"));
		$this->assertEquals($pdoPlayerStatistics->getPlayerStatisticId(), $this->playerstatistics->getPlayerStatisticId());

	}
	/**
	 * test inserting  PlayerStatistics that already exist
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidPlayerStatistics() {
		// create PlayerStatstics with a non null Player Statistic id and watch it fail
		$playerStatistics = new PlayerStatistics(DataDesignTest::INVALID_KEY, $this->playerStatistics->getPlayerStatisticsId());
		$playerStatistics->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Sport and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSport() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sport");

		// create a new Sport and insert to into mySQL
		$sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORT);
		$sport->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
		$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
	}
	/**
	 * test inserting a Sport that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidSport() {
		// create a Sport with a non null Sport id and watch it fail
		$sport = new Sport(DataDesignTest::INVALID_KEY, $this->sport->getSportId());
		$sport->insert($this->getPDO());
	}

/**
 * test inserting a valid Statistic and verify that the actual mySQL data matches
 **/
	public function testInsertValidStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("statistic");

		// create a new Statistic and insert to into mySQL
		$statistic = new Statistic(null, $this->statistic->getStatisticId(), $this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statistic"));
		$this->assertEquals($pdoStatistic->getStatisticId(), $this->statistic->getStatisticId());
	}
	/**
	 * test inserting a Statistic that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidStatistic() {
		// create a Statistic with a non null Statistic id and watch it fail
		$statistic = new Statistic(DataDesignTest::INVALID_KEY, $this->statistic->getStatisticId());
		$statistic->insert($this->getPDO());
	}

	/**
	 * test inserting a Game, editing it, and updating it
	 **/
	public function testUpdateValidGame() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("game");

		// create a new Game and insert to into mySQL
		$game = new Game(null, $this->game->getGameId(), $this->VALID_GAME);
		$game->insert($this->getPDO());

		// edit the Game and update it in mySQL
		$game->setGame($this->VALID_GAME);
		$game->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
		$this->assertEquals($pdoGame->getGameId(), $this->game->getGameId());

	}

	/**
	 * test updating a Game that already exists
	 *
	 * @expectedException PDOException
	 **/
public function testUpdateInvalidGame () {
	// Create a Game with a non null game id and watch it fail
	$game = new Game(null, $this->game->getGameId());
	$game->update($this->getPDO());
}

	/**
	 * test inserting a Player, editing it, and updating it
	 */

	public function testUpdateValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->player->getPlayerId(), $this->VALID_PLAYER);
		$player->insert($this->getPDO());

		// edit the Player and update it in mySQL
		$player->setPlayer($this->VALID_PLAYER);
		$player->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertEquals($pdoPlayer->getPlayerId(), $this->game->getPlayerId());
	}
	/**
	 * test updating a Player that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidPlayer () {
		// Create a Player with a non null player id and watch it fail
		$player = new Player(null, $this->Player->getPlayerId());
		$player->update($this->getPDO());
	}

	/**
	 * test inserting a PlayerStatistic, editing it, and updating it
	 */
	public function testUpdateValidPlayerStatistics() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistics");

		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistics = new PlayerStatistics(null, $this->plsayerStatistics->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTICS);
		$playerStatistics->insert($this->getPDO());

		// edit the PlayerStatistics and update it in mySQL
		$playerStatistics->setPlayerStatistics($this->VALID_PLAYERSTATISTICS);
		$playerStatistics->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistics = PlayerStatistics::getPlayerStatisticsByPlayerStatisticId($this->getPDO(), $playerStatistics->getPlayerStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistics"));
		$this->assertEquals($pdoPlayerStatistics->getPlayerStatisticId(), $this->playerstatistics->getPlayerStatisticId());

	}
	/**
	 * test updating a PlayerStatistic that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidPlayerStatistic () {
		// Create a PlayerStatistic with a non null player statistic id and watch it fail
		$playerStatistics = new PlayerStatistics(null, $this->VALID_PLAYERSTATISTICS->getPlayerStatisticId());
		$playerStatistics->update($this->getPDO());
	}

	/**
	 * test inserting a Sport, editing it, and updating it
	 */
	public function testUpdateValidSport() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sport");

		// create a new Sport and insert to into mySQL
		$sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORT);
		$sport->insert($this->getPDO());

		// edit the Sport and update it in mySQL
		$sport->setSport($this->VALID_SPORT);
		$sport->update($this->getPDO());


		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
		$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
	}

	/**
	 * test updating a Sport that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidSport () {
		// Create a Sport with a non null sport id and watch it fail
		$sport = new Sport(null, $this->VALID_SPORT->getSportId());
		$sport->update($this->getPDO());
	}
	/**
	 * test inserting a Statistic, editing it, and updating it
	 */
	public function testUpdateValidStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("statistic");

		// create a new Statistic and insert to into mySQL
		$statistic = new Statistic(null, $this->statistic->getStatisticId(), $this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());

		// edit the Statistic and update it in mySQL
		$statistic->setStatistic($this->VALID_STATISTIC);
		$statistic->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statistic"));
		$this->assertEquals($pdoStatistic->getStatisticId(), $this->statistic->getStatisticId());
	}
	/**
	 * test updating a Statistic that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidStatistic () {
		// Create a Statistic with a non null statistic id and watch it fail
		$statistic = new Statistic(null, $this->VALID_STATISTIC->getStatisticId());
		$statistic->update($this->getPDO());
	}
	/**
	 * test creating a Game then deleting it
	 **/
	public function testDeleteValidGame() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("game");

		// create a new Game and insert to into mySQL
		$game = new Game(null, $this->game->getGameId(), $this->VALID_GAME);
		$game->insert($this->getPDO());

		// Delete this game from mySQL
		$game->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
		$game->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
		$this->assertEquals($pdoGame->getGameId(), $this->game->getGameId());

	}
	/**
	 * test deleting a Game that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidGame () {
		// Create a Game and try to delete it without actually inserting it
		$game = new Game(null, $this->game->getGameId ());
		$game-> delete($this->getPDO());
	}
	/**
	 * test creating a Player then deleting it
	 **/
	public function testDeleteValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->player->getPlayerId(), $this->VALID_PLAYER);
		$player->insert($this->getPDO());

		// Delete this Player from mySQL
		$player->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$player->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertEquals($pdoPlayer->getPlayerId(), $this->game->getPlayerId());
	}
	/**
	 * test deleting a Player that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidPlayer() {
		// Create a player and try to delete it without actually inserting it
		$player = new Game(null, $this->player->getPlayerId ());
		$player-> delete($this->getPDO());
	}
	/**
	 * test creating a PlayerStatistic then deleting it
	 **/
	public function testDeleteValidPlayerStatistics() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("playerStatistics");

		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistics = new PlayerStatistics(null, $this->playerStatistics->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTICS);
		$playerStatistics->insert($this->getPDO());

		// Delete this PlayerStatistic from mySQL
		$playerStatistics->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistics"));
		$playerStatistics->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistics = PlayerStatistics::getPlayerStatisticsByPlayerStatisticId($this->getPDO(), $playerStatistics->getPlayerStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("playerStatistics"));
		$this->assertEquals($pdoPlayerStatistics->getPlayerStatisticId(), $this->playerstatistics->getPlayerStatisticId());

	}
	/**
	 * test deleting a PlayerStatistic that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidPlayerStatistics() {
		// Create a playerStatistic and try to delete it without actually inserting it
		$playerStatistics = new PlayerStatistics(null, $this->playerStatistics->getPlayerStatisticId ());
		$playerStatistics-> delete($this->getPDO());
	}
	/**
	 * test deleting a Sport that does not exist
	 */
	public function testDeleteValidSport() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("sport");

		// create a new Sport and insert to into mySQL
		$sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORT);
		$sport->insert($this->getPDO());

		// Delete this Sport from mySQL
		$sport->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
		$sport->delete($this->getPDO());


		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
		$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
	}
	/**
	 * test deleting a Sport that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidSport() {
		// Create a Sport and try to delete it without actually inserting it
		$sport = new Sport(null, $this->sport->getSportId ());
		$sport-> delete($this->getPDO());
	}

	/**
	 * test deleting a Statistic that does not exist
	 */
	public function testDeleteValidStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("statistic");

		// create a new Statistic and insert to into mySQL
		$statistic = new Statistic(null, $this->statistic->getStatisticId(), $this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());

		// Delete this Statistic from mySQL
		$statistic->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statistic"));
		$statistic->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic->getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statistic"));
		$this->assertEquals($pdoStatistic->getStatisticId(), $this->statistic->getStatisticId());
	}

	/**
	 * test deleting a Statistic that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidStatistic() {
		// Create a Statistic and try to delete it without actually inserting it
		$statistic = new Statistic(null, $this->statistic->getStatisticId ());
		$statistic-> delete($this->getPDO());
	}





}
