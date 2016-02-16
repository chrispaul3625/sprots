<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\FavoritePlayer;

require_once ("SprotsTest.php");

require_once (dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Favorite Player class
 *
 * This is a complete PHPUnit test of the FavoritePlayer class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Favorite Player
 * @author Mike Prinz <mnprinz@gmail.com>
 **/

Class FavoritePlayerTest extends SprotsTest {

	/**
	 * Team of Player
	 * @var string $VALID_TEAM
	 */
	protected $VALID_TEAM= null;

	/**
	 * Confirm valid Player
	 * @var string $VALID_PLAYER
	 */

	protected $VALID_PLAYER = null;

	/**
	 * confirm Player Id
	 * @var $VALID_PLAYERID
	 */
	protected $VALID_PLAYERID = null;

	/**
	 * Create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setup() method first
		parent::setUp();

		// create and insert a team that the player would play for
		$this->team = new Team (null, "teamName", "teamCity");
		$this->sport->insert($this->getPDO());
		// create and insert a ;player that would be favorited
		$this->team = new Player(null, "PlayerName", "teamCity");
		$this->team->insert($this->getPDO());
		// create and insert a Profile to own the FavoriteTeam
		$this->profile = new Profile(null, "@phpunit", "test@phpunit.de");
		$this->profile->insert($this->getPDO());
	}