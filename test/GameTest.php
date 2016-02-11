<?php
namespace Edu\Cnm\Sprots;

use Edu\Cnm\Sprots\{Game};
use Edu\Cnm\Sprots\Test\SprotsTest;

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
	 * the team that created the game for foreign keys
	 * @var Team team
	 */
	protected $team = null;


	/**
	 * create dependent objects before running  each test
	 */
	public final function setUp(){
		//run the default setUp() method first
		parent::setUp();

		// create and insert a Team t own the test
		$this->team = new Team(null, teamId, teamApiId, teamCity, teamName);
		$this->team->insert($this->PDO());

		// calculate the date (same as unit test)
		$this->VALID_GAMETIME = new \GameTime();
	}
}