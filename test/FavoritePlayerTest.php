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
	 * Player is valid
	 * @var string $VALID_TEAM
	 */
	protected $VALID_TEAM = null;

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
		$this->team->insert($this->getPDO());
		// create and insert a ;player that would be favorited
		$this->player = new Player(null, "PlayerName", "PlayerApiId");
		$this->player->insert($this->getPDO());
		// create and insert a Profile to own the FavoritePlayer
		$this->profile = new Profile(null, "", "");
		$this->profile->insert($this->getPDO());
	}

	/**
	 * test inserting a valid player and verify that the actual mySQL data matches
	 **/
	public function testInsertValidFavoritePlayer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favoritePlayer and insert it into mySQL
		$profile = new FavoritePlayer(null, $this->favoritePlayer->getfavoritePlayer(), $this->VALID_PLAYER);
		$profile->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectation
		$pdoProfile = Profile::getProfilebyProfileId($this->$PDO(), $profile->getProfileid());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));
		$this->assertEquals($pdoProfile->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileFirstName(), $this->VALID_PROFILEUSERNAME);
	}
