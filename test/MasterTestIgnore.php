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
class MasterTestIgnore extends SprotsTest {
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
	 * Player Statistics of the Player
	 * @var PlayerStatistic $VALID_PLAYERSTATISTIC
	 */
	protected $playerStatistic = null;
	/**
	 * Statistic that is associated with the Player
	 * @var Statistic $VALID_STATISTIC
	 */
	protected $statistic = null;



	/**
	 * Create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Sport to own the test PlayerStatistic
		$this->sport = new Sport(null, "sportTeam", "sportLeague");
		$this->sport->insert($this->getPDO());


		//create and insert a Game to own the test PlayerStatistic
		$this->game = new Game(null, "gameFirstTeamId","GameSecondTeamId","GameTime");
		$this->game->insert($this->getPDO());

		//create and insert a Player to own the test PlayerStatistic
		$this->player = new Player(null, "playerName", "playerTeamId", "playerApiId");
		$this->player->insert($this->getPDO());

		//create and insert a Statistic to own the test PlayerStatistic
		$this->statistic = new Statistic(null, "statisticName");
		$this->statistic->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Sport and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSport() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Sport");

		// create a new Sport and insert to into mySQL
		$sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORT);
		$sport->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Sport"));
		$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
	}

	/**
	 * test inserting a Sport that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidSport() {
		// create a Sport with a non null Sport id and watch it fail
		$sport = new Sport(SprotsTest::INVALID_KEY, $this->sport->getSportId());
		$sport->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Game and verify that the actual mySQL data matches
	 **/
	public function testInsertValidGame() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Game");

		// create a new Game and insert to into mySQL
		$game = new Game(null, $this->game->getGameId(), $this->VALID_GAME);
		$game->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameId(), $this->game->getGameId());

	}

	/**
	 * test inserting a Game that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidGame() {
		// create a Game with a non null Game id and watch it fail
		$game = new Game(SprotsTest::INVALID_KEY, $this->game->getGameId());
		$game->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Player and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->player->getPlayerId(), $this->VALID_PLAYER);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Player"));
		$this->assertEquals($pdoPlayer->getPlayerId(), $this->game->getPlayerId());
	}

	/**
	 * test inserting a Player that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidPlayer() {
		// create a Player with a non null Player id and watch it fail
		$player = new Player(SprotsTest::INVALID_KEY, $this->player->getPlayerId());
		$player->insert($this->getPDO());
	}

	/**
	 * test inserting a valid PlayerStatistic and verify that the actual mySQL data matches
	 **/
	public function testInsertValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("PlayerStatistic");

		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic(null, $this->plsayerStatistic->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTIC);
		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticStatisticId();$this->getPDO(); $playerStatistic->getPlayerStatisticId();
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("PlayerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticId(), $this->playerstatistic->getPlayerStatisticId());

	}

	/**
	 * test inserting  PlayerStatistics that already exist
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidPlayerStatistic() {
		// create PlayerStatistic with a non null Player Statistic id and watch it fail
		$playerStatistic = new PlayerStatistic(SprotsTest::INVALID_KEY, $this->playerStatistic->getPlayerStatisticId());
		$playerStatistic->insert($this->getPDO());
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
		$statistic = new Statistic(SprotsTest::INVALID_KEY, $this->statistic->getStatisticId());
		$statistic->insert($this->getPDO());
	}

	/**
	 * test updating a Sport that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidSport() {
		// Create a Sport with a non null Sport id and watch it fail
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
	 * test inserting a Game, editing it, and updating it
	 **/
	public function testUpdateValidGame() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Game");

		// create a new Game and insert to into mySQL
		$game = new Game(null, $this->game->getGameId(), $this->VALID_GAME);
		$game->insert($this->getPDO());

		// edit the Game and update it in mySQL
		$game->setGame($this->VALID_GAME);
		$game->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameId(), $this->game->getGameId());

	}

	/**
	 * test updating a Game that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidGame() {
		// Create a Game with a non null Game id and watch it fail
		$game = new Game(null, $this->game->getGameId());
		$game->update($this->getPDO());
	}

	/**
	 * test inserting a Player, editing it, and updating it
	 */

	public function testUpdateValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->player->getPlayerId(), $this->VALID_PLAYER);
		$player->insert($this->getPDO());

		// edit the Player and update it in mySQL
		$player->setPlayer($this->VALID_PLAYER);
		$player->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Player"));
		$this->assertEquals($pdoPlayer->getPlayerId(), $this->game->getPlayerId());
	}

	/**
	 * test updating a Player that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidPlayer() {
		// Create a Player with a non null Player id and watch it fail
		$player = new Player(null, $this->Player->getPlayerId());
		$player->update($this->getPDO());
	}

	/**
	 * test inserting a PlayerStatistic, editing it, and updating it
	 */
	public function testUpdateValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("PlayerStatistic");

		// create a new PlayerStatistics and insert to into mySQL
		$playerStatistic = new PlayerStatistic(null, $this->plsayerStatistic->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTIC);
		$playerStatistic->insert($this->getPDO());

		// edit the PlayerStatistic and update it in mySQL
		$playerStatistic->setPlayerStatistic($this->VALID_PLAYERSTATISTIC);
		$playerStatistic->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticId($this->getPDO(), $playerStatistic->getPlayerStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("PlayerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticId(), $this->playerStatistic->getPlayerStatisticId());

	}

	/**
	 * test updating a PlayerStatistic that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidPlayerStatistic() {
		// Create a PlayerStatistic with a non null Player statistic id and watch it fail
		$playerStatistic = new PlayerStatistic(null, $this->VALID_PLAYERSTATISTIC->getPlayerStatisticId());
		$playerStatistic->update($this->getPDO());
	}

	/**
	 * test inserting a Sport, editing it, and updating it
	 */
	public function testUpdateValidSport() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Sport");

		// create a new Sport and insert to into mySQL
		$sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORT);
		$sport->insert($this->getPDO());

		// edit the Sport and update it in mySQL
		$sport->setSport($this->VALID_SPORT);
		$sport->update($this->getPDO());


		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Sport"));
		$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
	}


	/**
	 * test updating a Statistic that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidStatistic() {
		// Create a Statistic with a non null statistic id and watch it fail
		$statistic = new Statistic(null, $this->VALID_STATISTIC->getStatisticId());
		$statistic->update($this->getPDO());
	}

	/**
	 * test deleting a Sport that does not exist
	 */
	public function testDeleteValidSport() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Sport");

		// create a new Sport and insert to into mySQL
		$sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORT);
		$sport->insert($this->getPDO());

		// Delete this Sport from mySQL
		$sport->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Sport"));
		$sport->delete($this->getPDO());


		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Sport"));
		$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
	}

	/**
	 * test deleting a Sport that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidSport() {
		// Create a Sport and try to delete it without actually inserting it
		$sport = new Sport(null, $this->sport->getSportId());
		$sport->delete($this->getPDO());
	}


	/**
	 * test creating a Game then deleting it
	 **/
	public function testDeleteValidGame() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Game");

		// create a new Game and insert to into mySQL
		$game = new Game(null, $this->game->getGameId(), $this->VALID_GAME);
		$game->insert($this->getPDO());

		// Delete this Game from mySQL
		$game->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$game->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameId(), $this->game->getGameId());

	}

	/**
	 * test deleting a Game that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidGame() {
		// Create a Game and try to delete it without actually inserting it
		$game = new Game(null, $this->game->getGameId());
		$game->delete($this->getPDO());
	}

	/**
	 * test creating a Player then deleting it
	 **/
	public function testDeleteValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->player->getPlayerId(), $this->VALID_PLAYER);
		$player->insert($this->getPDO());

		// Delete this Player from mySQL
		$player->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Player"));
		$player->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Player"));
		$this->assertEquals($pdoPlayer->getPlayerId(), $this->game->getPlayerId());
	}

	/**
	 * test deleting a Player that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidPlayer() {
		// Create a Player and try to delete it without actually inserting it
		$player = new Game(null, $this->player->getPlayerId());
		$player->delete($this->getPDO());
	}

	/**
	 * test creating a PlayerStatistic then deleting it
	 **/
	public function testDeleteValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("PlayerStatistic");

		// create a new PlayerStatistic and insert to into mySQL
		$playerStatistic = new PlayerStatistic(null, $this->playerStatistic->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTIC);
		$playerStatistic->insert($this->getPDO());

		// Delete this PlayerStatistic from mySQL
		$playerStatistic->assertEquals($numRows + 1, $this->getConnection()->getRowCount("PlayerStatistic"));
		$playerStatistic->delete($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticId($this->getPDO(), $playerStatistic->getPlayerStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("PlayerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticId(), $this->playerStatistic->getPlayerStatisticId());

	}

	/**
	 * test deleting a PlayerStatistic that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidPlayerStatistic() {
		// Create a PlayerStatistic and try to delete it without actually inserting it
		$playerStatistic = new PlayerStatistic(null, $this->playerStatistic->getPlayerStatisticId());
		$playerStatistic->delete($this->getPDO());
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
		$statistic = new Statistic(null, $this->statistic->getStatisticId());
		$statistic->delete($this->getPDO());
	}

	/**
	 * test inserting a valid Sport and regrabbing it from mySQL
	 **/
	public function testGetValidSportBySportId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Sport");

		// create a new Sport and insert to into mySQL
		$sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORT);
		$sport->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Sport"));
		$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
	}

	/**
	 * test grabbing a Sport that does not exist
	 */
	public function testGetInvalidSportBySportId() {
		//grab a Sport id that exceeds the maximum allowable Sport id
		$sport = Sport::getSportBySportId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($sport);
	}


	/**
	 * test inserting a valid Game and regrabbing it from mySQL
	 **/
	public function testGetValidGameByGameId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Game");

		// create a new Game and insert to into mySQL
		$game = new Game(null, $this->game->getGameId(), $this->VALID_GAME);
		$game->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameId(), $this->game->getGameId());

	}

	/**
	 * test grabbing a Game that does not exist
	 */
	public function testGetInvalidGameByGameId() {
		//grab a Game id that exceeds the maximum allowable Game id
		$game = Game::getGameByGameId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($game);
	}

	/**
	 * test inserting a valid Player and regrabbing it from mySQL
	 **/
	public function testGetValidPlayerByPlayerId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("Player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->player->getPlayerId(), $this->VALID_PLAYER);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Player"));
		$this->assertEquals($pdoPlayer->getPlayerId(), $this->game->getPlayerId());
	}

	/**
	 * test grabbing a Player that does not exist
	 */
	public function testGetInvalidPlayerByPlayerId() {
		//grab a Player id that exceeds the maximum allowable Player id
		$player = Player::getPlayerByPlayerId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($player);
	}

	/**
	 * test inserting a valid Player Statistic and regrabbing it from mySQL
	 **/
	public function testGetValidPlayerStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("PlayerStatistic");

		// create a new PlayerStatistic and insert to into mySQL
		$playerStatistic = new PlayerStatistic(null, $this->plsayerStatistic->getPlayerStatisticId(), $this->VALID_PLAYERSTATISTIC);
		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticId($this->getPDO(), $playerStatistic->getPlayerStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("PlayerStatistic"));
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatisticId(), $this->playerstatistic->getPlayerStatisticId());

	}

	/**
	 * test grabbing a Player Statistic that does not exist
	 */
	public function testGetInvalidPlayerStatisticsByPlayerStatisticId() {
		//grab a PlayerStatistic id that exceeds the maximum allowable PlayerStatistic id
		$playerStatistic = PlayerStatistic::getPlayerStatisticByPlayerStatisticId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($playerStatistic);
	}


	/**
	 * test inserting a valid Statistic and regrabbing it from mySQL
	 **/
	public function testGetValidStatisticByStatisticId() {
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
	 * test grabbing a Statistic that does not exist
	 */
	public function testGetInvalidStatisticByStatisticId() {
		//grab a Statistic id that exceeds the maximum allowable Statistic id
		$statistic = Statistic::getStatisticByStatisticId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($statistic);
	}

	/**
	 * test grabbing all Player Statistics
	 **/
	public function testGetAllValidPlayerStatistics() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("PlayerStatistic");

		// create a new Player Statistic and insert to into mySQL
		$playerStatistic = new PlayerStatistic(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$playerStatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = PlayerStatistic::getAllPlayerStatistics($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("PlayerStatistic"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Public_html\\Php\\Classes\\PlayerStatistic", $results);

		// grab the result from the array and validate it
		$pdoPlayerStatistic = $results[0];
		$this->assertEquals($pdoPlayerStatistic->getSportId(), $this->sport->getSportId());
		$this->assertEquals($pdoPlayerStatistic->getGame(), $this->VALID_GAME);
		$this->assertEquals($pdoPlayerStatistic->getPlayer(), $this->VALID_TWEETDATE);
		$this->assertEquals($pdoPlayerStatistic->getPlayerStatistic(), $this->VALID_TWEETDATE);
		$this->assertEquals($pdoPlayerStatistic->getStatistic(), $this->VALID_TWEETDATE);
	}

}
