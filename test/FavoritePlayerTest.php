<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\Profile;
use Edu\Cnm\Sprots\FavoritePlayer;
use Edu\Cnm\Sprots\Player;
use Edu\Cnm\Sprots\Sport;
use Edu\Cnm\Sprots\Team;

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

	protected $VALID_SPORT;

	/**
	 * Player is valid
	 * @var string $VALID_TEAM
	 */
	protected $VALID_TEAM;

	/**
	 * Confirm valid Player
	 * @var string $VALID_PLAYER
	 */

	protected $VALID_PLAYER;

	/**
	 * confirm Player Id
	 * @var int $VALID_PLAYERID
	 */
	protected $VALID_PROFILE;

	protected $hash;

	protected $salt;

	/**
	 * Create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setup() method first
		parent::setUp();

		//Generate Hash and Salt
		$password = "abc123";
		$this->salt = bin2hex(random_bytes(16));
		$this->hash = hash_pbkdf2("sha512", $password, $this->salt, 262144);

		$this->VALID_PROFILE = new Profile(null, "Ronald McDonald", "ronnie@mcdonalds.com", $this->hash, $this->salt);
		$this->VALID_PROFILE->insert($this->getPDO());

		$this->VALID_SPORT = new Sport(null, "basketball", "ABC");
		$this->VALID_SPORT->insert($this->getPDO());

		$this->VALID_TEAM = new Team(null, $this->VALID_SPORT->getSportId(), 1, "Albuquerque", "Lobos");
		$this->VALID_TEAM->insert($this->getPDO());

		$this->VALID_PLAYER = new Player(null, "Mike", 1, $this->VALID_TEAM->getTeamId());
		$this->VALID_PLAYER->insert($this->getPDO());

	}

	/**
	 * test inserting a valid player and verify that the actual MySQL data matches
	 **/
	public function testInsertValidFavoritePlayer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favoritePlayer and insert it into MySQL
		$favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), $this->VALID_PLAYER->getPlayerId());
		$favoritePlayer->insert($this->getPDO());

		//grab the data from MySQL and enforce the fields match our expectation
		$pdoFavoritePlayers = FavoritePlayer::getFavoritePlayerByPlayerId($this->getPDO(), $this->VALID_PLAYER->getPlayerId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));

		foreach($pdoFavoritePlayers as $pdoFavoritePlayer) {
			if($pdoFavoritePlayer->getFavoritePlayerId() === $this->VALID_PLAYER->getPlayerId()) {
				$this->assertEquals($pdoFavoritePlayer->getFavoritePlayerId(), $favoritePlayer->getFavoritePlayerId());
				$this->assertEquals($pdoFavoritePlayer->getFavoritePlayerProfileId(), $favoritePlayer->getFavoritePlayerProfileId());


			}
		}
	}

	/**
	 * test inserting a valid player that has already been inserted and watch it fail
	 *
	 * @expectedException \PDOException
	 */
	public function testInsertInvalidFavoritePlayer() {
		//create a new favoritePlayer and insert it into mySQL
		$favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), $this->VALID_PLAYER->getPlayerId());
		$favoritePlayer->insert($this->getPDO());
		$favoritePlayer->insert($this->getPDO());

	}

	/**
	 * test deleting a favorite player from MySQL
	 *
	 * @expectedException \PDOException
	 */

	public function testDeleteFavoritePlayer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favoritePlayer and insert it into mySQL
		$favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), $this->VALID_PLAYER->getPlayerId());
		$favoritePlayer->insert($this->getPDO());

		// delete the Favorite Player from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));
		$favoritePlayer->delete($this->getPDO());

		// grab the data from mySQL and enforce the Favorite Player does not exist
		$pdoFavoritePlayer = FavoritePlayer::getFavoritePlayerbyPlayerId($this->getPDO(), $favoritePlayer->getPlayerId());
		$this->assertNull($pdoFavoritePlayer);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("favoritePlayer"));

	}


	/**
	 * test inserting a favorite player that does not exist
	 *
	 * @expectedException \PDOException
	 */
	public function testDeleteInvalidFavoritePlayer() {
		//create new player with a null profile Id and watch it fail
		$favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), SprotsTest::INVALID_KEY);
		$favoritePlayer->insert($this->getPDO());

	}

	/**
	 * test getting favorite player by profile id
	 *
	 */

	public function testGetFavoritePlayerByProfileId() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favorite player
		$favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), $this->VALID_PLAYER->getPlayerId());
		$favoritePlayer->insert($this->getPDO());


		//grab the data from MySQL and enforce the fields match our expectation
		$pdoFavoritePlayer = FavoritePlayer::getFavoritePlayerByProfileId($this->getPDO(),$this->getProfileId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));
		$this->assertEquals($pdoFavoritePlayer->getProfileId(), $favoritePlayer->getProfileId());

			}

	/**
	 * test getting favorite player by player id
	 *
	 */

	public function testGetFavoritePlayerByPlayerId() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favorite player
		$favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), $this->VALID_PLAYER->getPlayerId());
		$favoritePlayer->insert($this->getPDO());


		//grab the data from MySQL and enforce the fields match our expectation
		$pdoFavoritePlayer = FavoritePlayer::getFavoritePlayerByPlayerId($this->getPDO(),$this->getPlayerId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));
		$this->assertEquals($pdoFavoritePlayer->getPlayerId(), $favoritePlayer->getPlayerId());

	}


}
