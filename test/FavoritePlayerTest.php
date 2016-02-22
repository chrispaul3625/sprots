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

	/**
	 * content of playerId
	 * @var null
	 */
	protected $VALID_PLAYERID = null;

	/**
	 * content of playerApiId
	 * @var int
	 */
	protected $VALID_PLAYERAPIID = 77;

	/**
	 * content of playerTeamId
	 * @var null
	 */
	protected $VALID_PLAYERTEAMID = 99;

	/**
	 * content of playerSportId
	 * @var null
	 */
	protected $VALID_PLAYERSPORTID = 123;

	/**
	 * content of playerName
	 * @var string
	 */

	protected $VALID_PLAYERNAME = "Mike";

	protected $VALID_TEAMSPORTID = 42;

	protected $VALID_TEAMAPIID = 24;

	protected $VALID_TEAMCITY = "Nashville";

	protected $VALID_TEAMNAME = "Titans";


	protected $sport = null;

	protected $team = null;

	protected $player = null;

	protected $profile = null;

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
		$this->salt = bin2hex(openssl_random_pseudo_bytes(32));
		$this->hash = hash_pbkdf2("sha512", $password, $this->salt, 262144, 128);

		$this->profile = new Profile(null, "Ronald McDonald", "ronnie@mcdonalds.com", $this->hash, $this->salt);
		$this->profile->insert($this->getPDO());

		$this->sport = new Sport(null, "basketball", "ABC");
		$this->sport->insert($this->getPDO());

		$this->team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$this->team->insert($this->getPDO());

		$this->player = new Player(null, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID, $this->VALID_PLAYERSPORTID, $this->VALID_PLAYERNAME);
		$this->player->insert($this->getPDO());

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

		//test that the new favorite player was inserted into MySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));

		//grab the data from MySQL and enforce the fields match our expectation
		$pdoFavoritePlayers = FavoritePlayer::getFavoritePlayerByPlayerId($this->getPDO(), $this->VALID_PLAYER->getPlayerId());

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
	 * test inserting a favorite player that does not exist
	 *
	 * @expectedException \PDOException
	 */
	/**public function testInsertInvalidFavoritePlayer() {
		//create new player with a null profile Id and watch it fail
		$favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), SprotsTest::INVALID_KEY);
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
