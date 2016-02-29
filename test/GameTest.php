<?php
namespace Edu\Cnm\Sprots\Test;

// grab the project test parameters
require_once("SprotsTest.php");
//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

use Edu\Cnm\Sprots\Game;
use Edu\Cnm\Sprots\Team;
use Edu\Cnm\Sprots\Sport;

/**
 * Full PHPUnit test for Game class
 *
 * this is a complete PHPUnit test for Game class. all mySQL/PDO enabled methods are being tested for moth invalid and valid inputs
 * @see Game
 * @Dominic Cuneo <Cuneo94@gmail.com
 */
class GameTest extends SprotsTest {
	/**
	 * timestamp of the Game; this starts as null and is assigned later
	 * @var \DateTime $VALID_GAMETIME
	 */
	protected $VALID_GAMETIME = null;
	/**
	 * timestamp of the Game; this starts as null and is assigned later
	 * @var \DateTime $VALID_GAMETIME
	 */
	protected $VALID_GAMETIME2 = null;
	/**
	 * content of Team
	 * @var int $VALID_TEAMAPIID
	 */
	protected $VALID_TEAMAPIID = 42;
	/**
	 * content of Team
	 * @var int $VALID_TEAMAPIID2
	 */
	protected $VALID_TEAMAPIID2 = 64;
	/**
	 * content for teamCity
	 * @var string  $VALID_TEAMCITY
	 */
	protected $VALID_TEAMCITY = "Nashville";
	/**
	 * content for teamName
	 * @var string $VALID_TEAMNAME
	 */
	protected $VALID_TEAMNAME = "Titans";
	/**
	 * content for teamName
	 * @var string $VALID_TEAMNAME2
	 */
	protected $VALID_TEAMNAME2 = "Cowboys";
	/**
	 * Sport that the Player is playing
	 * @var string $sport
	 */
	protected $sport = null;
	/**
	 * the Team that created the Game for foreign keys
	 * @var Team Team
	 */
	protected $team = null;
	protected $team2 = null;


	/**
	 * create dependent objects before running  each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		// create and insert a Team to own the test
		$this->sport = new Sport(null, "sportLeague", "sportTeam");
		$this->sport->insert($this->getPDO());

		$this->team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$this->team->insert($this->getPDO());

		// create and insert a Team t own the test
		$this->team2 = new Team(null,  $this->sport->getSportId(), $this->VALID_TEAMAPIID2, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME2);
		$this->team2->insert($this->getPDO());

		// calculate the date (same as unit test)
		$this->VALID_GAMETIME = \DateTime::createFromFormat("Y-m-d H:i:s", "2015-03-23 15:23:04");
		$this->VALID_GAMETIME2 = \DateTime::createFromFormat("Y-m-d H:i:s", "2015-03-23 15:23:04");
	}
		/**
		 * test inserting a valid Game and verify that the actual mySQL data matches
		 */
		public function testInsertValidGame(){
			//count rows and save
			$numRows = $this->getConnection()->getRowCount("Game");

			// create a new Game and insert into mySQL
			$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
			//var_dump($Game);
			$game->insert($this->getPDO());

			//grab data from mySQL and enforce the match
			$pdoGame = Game::getGameByGameId($this->getPDO(),$game->getGameId());
			//var_dump($pdoGame);
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
			$this->assertEquals($pdoGame->getGameFirstTeamId(), $this->team->getTeamId());
			$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME);
		}
	/**
	 * test inserting a Game that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidGame(){
		//create a Game with a non null Game id adn watch it fail
		$game = new Game(SprotsTest::INVALID_KEY, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->insert($this->getPDO());
	}
	/**
	 * test inserting a Game, editing it, and then updating it
	 **/
	public function testUpdateValidGame() {
		$numRows = $this->getConnection()->getRowCount("Game");

		//create a new Game and insert to mySQL
		$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->insert($this->getPDO());

		//edit Game and update it in mySql
//		$Game->setGameByGameSecondTeamId($this->VALID_GAME2);
		$game->setGameTime($this->VALID_GAMETIME2);
		$game->update($this->getPDO());

		//grab data from mySQL and enforce the fields to match
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameFirstTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME);
	}
	/**
	 * test updating a Game that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidGame(){
		//create a  Game with  non null Game id an watch it fail
		$game = new Game(null,$this->team->getTeamId(),$this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->update($this->getPDO());
	}
	/**
	 * test creating a Game and then deleting it
	 **/
	public function testDeleteValidGame(){
		//count the number of rows and save
		$numRows = $this->getConnection()->getRowCount("Game");
		// create a new Game and insert into mySQL
		$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->insert($this->getPDO());

		// delete the Game from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$game->delete($this->getPDO());
		//grab the data from mySQL and enforce the Game that does not exist
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertNull($pdoGame);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("Game"));
	}
	/**
	 * test deleting a Game that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidGame(){
		//create a Game and try to delete it without actually inserting it
		$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->delete($this->getPDO());
	}
	/**
	 * test inserting a Game and regrabbing it from mySQL
	 **/
	public function testGetValidGameByGameId(){
		// count the number of row and save
		$numRows = $this->getConnection()->getRowCount("Game");

		//create a new Game and insert into mySql
		$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->insert($this->getPDO());


		//grab data from mySQL and enforce the fields to match
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameFirstTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME);
	}
	/**
	 * test for grabbing getGameByGameFirstTeamId
	 */
	public function testGetGameByGameFirstTeamId(){
		// count the number of row and save
		$numRows = $this->getConnection()->getRowCount("Game");

		//create a new Game and insert into mySql
		$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->insert($this->getPDO());


		//grab data from mySQL and enforce the fields to match
		$pdoGame = Game::getGameByGameFirstTeamId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameFirstTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME);
	}
	/**
	 * testing grabbing for getGameByGamSecondTeamId
	 */
	public function testGetGameByGameSecondTeamId() {
		// count the number of row and save
		$numRows = $this->getConnection()->getRowCount("Game");

			//create a new Game and insert into mySql
			$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
			$game->insert($this->getPDO());


			//grab data from mySQL and enforce the fields to match
			$pdoGame = Game::getGameByGameSecondTeamId($this->getPDO(), $game->getGameId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
			$this->assertEquals($pdoGame->getGameFirstTeamId(), $this->team->getTeamId());
			$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME);
		}
	/**
	 * test grabbing Game by time
	 */
	public function testGetGameByGameTime() {
		// count the number of row and save
		$numRows = $this->getConnection()->getRowCount("Game");

		//create a new Game and insert into mySql
		$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);
		$game->insert($this->getPDO());


		//grab data from mySQL and enforce the fields to match
		$pdoGame = Game::getGameByGameTime($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Game"));
		$this->assertEquals($pdoGame->getGameFirstTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME);
	}
	/**
	 * test grabbing a Game that does not exist
	 **/
	public function testGetInvalidGameByGameId(){
		//grab a Team that exceeds the max allowable Team id
		$game = Game::getGameByGameId($this->getPDO(),SprotsTest::INVALID_KEY);
		$this->assertNull($game);
	}
	/**
	 * test grab all games
	 */
	public function testGetAllValidGames(){
		//count the numbers of rows and save
		$numRows =$this->getConnection()->getRowCount("Game");

		//create a new Game and insert into mySql
		$game = new Game(null, $this->team->getTeamId(), $this->team2->getTeamId(), $this->VALID_GAMETIME);;
		$game->insert($this->getPDO());

		//grab the dat from mySQL and enforce the fields match
		$results = Game::getAllGame($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount('Game'));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Game", $results);

		//grab the results from the array and validate
		$pdoGame = $results[0];
		$this->assertEquals($pdoGame->getGameFirstTeamId(), $this->team->getTeamId());

	}
}