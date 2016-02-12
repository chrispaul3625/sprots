<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{
	Game, Team, Sport
};

// grab the project test parameters
require_once("SprotsTest.php");
//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for Game class
 *
 * this is a complete PHPUnit test for Game class. all mySQL/PDO enabled methods are being tested for moth invalid and valid inputs
 * @see Game
 * @Dominic Cuneo <Cuneo94@gmail.com
 */
class GameTest extends SprotsTest {
	/**
	 * content of Game
	 * @var  string $VALID_GAME
	 */
	protected $VALID_GAME = "PHPUnit test passing ";
	/**
	 * content of updated Game
	 * @var string $VALID_GAME
	 */
	protected $VALID_GAME2 = "PHPUnit test still passing ";
	/**
	 * timestamp of the Game; this starts as null and is assigned later
	 * @var DateTime $VALID_GAMETIME
	 */
	protected $VALID_GAMETIME = null;
	/**
	 * content of Team
	 * @var int $valid_TEAMAPIID
	 */
	protected $VALID_TEAMAPIID = null;
	/**
	 * content for teamCity
	 * @var string  $VALID_TEAMCITY
	 */
	protected $VALID_TEAMCITY = null;
	/**
	 * content for teamName
	 * @var string $VALID_TEAMNAME
	 */
	protected $VALID_TEAMNAME =null;
	/**
	 * Sport that the Player is playing
	 * @var string $VALID_SPORT
	 */
	protected $sport = null;
	/**
	 * the team that created the game for foreign keys
	 * @var Team team
	 */

	protected $team = null;

	protected $team2 = null;


	/**
	 * create dependent objects before running  each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		// create and insert a Team t own the test

		$this->sport = new Sport(null, "sportTeam", "sportLeague");
		$this->sport->insert($this->getPDO());

		$this->team = new Team(null, teamApiId, teamCity, teamName);
		$this->team->insert($this->PDO());

		// calculate the date (same as unit test)
		$this->VALID_GAMETIME = new \GameTime();

		// create and insert a Team t own the test
		$this->team = new Team(null, teamApiId, teamCity, teamName);
		$this->team->insert($this->PDO());

		// calculate the date (same as unit test)
		$this->VALID_GAMETIME = new \GameTime();
	}
		/**
		 * test inserting a valid Game and verify that the actual mySQL data matches
		 */
		public function testInsertValidGame(){
			//count rows and save
			$numRows = $this->getConnection()->getRowCount("game");

			// create a new Game and insert into mySQL
			$game = new Game(null, $this->team->getTeamId(), $this->VALID_GAME, $this->VALID_GAMETIME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
			$game->insert($this->getPDO());

			//grab data from mySQL and enforce the match
			$pdoGame = Game::getGameByGameId($this->getPDO(),$game->getGameId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
			$this->assertEquals($pdoGame->getTeamId(), $this->team->getTeamId());
			$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME, $this->VALID_GAME);
		}
	/**
	 * test inserting a Game that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidGame(){
		//create a game with a non null game id adn watch it fail
		$game = new Game(SprotsTest::INVALID_KEY, $this->team->getTeamId(), $this->VALID_GAMETIME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$game->insert($this->getPDO());
	}
	/**
	 * test inserting a Game, editing it, and then updating it
	 **/
	public function testUpdateValidGame() {
		$numRows = $this->getConnection()->getRowCount("game");

		//create a new game and insert to mySQL
		$game = new Game(null, $this->getTeam->getTeamId(), $this->VALID_GAMETIME, $this->VALID_GAME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$game->insert($this->getPDO());

		//edit Game and update it in mySql
		$game->setGame($this->VALID_GAME2);
		$game->update($this->getPDO());

		//grab data from mySQL and enforce the fields to match
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
		$this->assertEquals($pdoGame->getTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME, $this->VALID_GAME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
	}
	/**
	 * test updating a Game that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidGame(){
		//create a  Game with  non null game id an watch it fail
		$game = new Game(null,$this->game->getGameId(), $this->VALID_GAME, $this->VALID_GAMETIME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$game->update($this->getPDO());
	}
	/**
	 * test creating a Game and then deleting it
	 **/
	public function testDeleteValidGame(){
		//count the number of rows and save
		$numRows = $this->getConnection()->getRowCount("game");
		// create a new Game and insert into mySQL
		$game =new Game(null,$this->team->getTeamId(), $this->VALID_GAME, $this->VALID_GAMETIME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$game->insert($this->getPDO());

		// delete the game from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
		$game->insert($this->getPDO());
		//grab the data from mySQL and enforce the Game that does not exist
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertNull($pdoGame);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("game"));
	}
	/**
	 * test deleting a Game that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidGame(){
		//create a game and try to delete it without actually inserting it
		$game = Game(null, $this->team->getGameId(), $this->VALID_GAME, $this->VALID_GAMETIME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$this->delete($this->getPDO());
	}
	/**
	 * test inserting a Game and regrabbing it from mySQL
	 **/
	public function testGetValidGameByGameId(){
		// count the number of row and save
		$numRows = $this->getConnection()->getRowCount("game");

		//create a new Game and insert into mySql
		$game = new Game(null, $this->team->getTeamId(), $this->VALID_GAMETIME, $this->VALID_GAME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$game->insert($this->getPDO());


		//grab data from mySQL and enforce the fields to match
		$pdoGame = Game::getGameByGameId($this->getPDO(), $game->getGameId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("game"));
		$this->assertEquals($pdoGame->getTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME, $this->VALID_GAME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
	}
	/**
	 * test grabbing a Game that does not exist
	 **/
	public function testGetInvalidGameByGameId(){
		//grab a team that exceeds the max allowable team id
		$game = Game::getGameByGameId($this->getPDO(),SprotsTest::INVALID_KEY);
		$this->assertNull($game);
	}
	/**
	 * test grab all games
	 */
	public function testGetAllValidGames(){
		//count the numbers of rows and save
		$numRows =$this->getConnection()->getRowCount("game");

		//create a new Game and insert into mySql
		$game = new Game(null, $this->team->teamId(), $this->VALID_GAME, $this->VALID_GAMETIME, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$game->insert($this->getPDO());

		//grab the dat from mySQL and enforce the fields match
		$results = Game::getAllGames($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount('game'));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dcuneo1\\Sprots\\Game",$results);

		//grab the results from the array and validate
		$pdoGame = $results[0];
		$this->assertEquals($pdoGame->getTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoGame->getGameTime(), $this->VALID_GAMETIME);
		$this->assertEquals($pdoGame->getTeamApiId(),$this->VALID_TEAMAPIID);
		$this->assertEquals($pdoGame->getTeamCity(), $this->VALID_TEAMCITY);
		$this->assertEquals($pdoGame->getTeamName(), $this->VALID_TEAMNAME);
	}
}