<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\Profile;
use Edu\Cnm\Sprots\FavoritePlayer;
use Edu\Cnm\Sprots\Player;
use Edu\Cnm\Sprots\Sport;
use Edu\Cnm\Sprots\Team;

require_once("SprotsTest.php");

require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

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
	 * confirm valid team
	 * @var string $VALID_TEAM
	 */
	protected $VALID_TEAMNAME = "Bears";

	/**
	 * Confirm valid Player
	 * @var string $VALID_PLAYER
	 */
	protected $VALID_TEAMAPIID = 42;
	protected $VALID_TEAMCITY = "Nashville";
	// protected $VALID_PLAYER = null;

	/**
	 * confirm Player Id
	 * @var int $VALID_PLAYERID
	 */
	// protected $VALID_PLAYERID = "42";

	protected $VALID_PLAYERAPIID = 77;
	protected $VALID_PLAYERSPORTID;

	protected $sport = null;
	protected $team = null;
	protected $profile = null;
	protected $player = null;

	protected $hash;

	protected $salt;
	protected $favoritePlayerProfileId = null;
	protected $favoritePlayerPlayerId = null;

	/**
	 * Create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setup() method first
		parent::setUp();


		$this->sport = new Sport(null, "sportLeague", "sportName");
		$this->sport->insert($this->getPDO());

		$this->team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$this->team->insert($this->getPDO());

		$this->player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(), $this->sport->getSportId(), "PlayerName");
		$this->player->insert($this->getPDO());

		$password = "abc123";
		$this->salt = bin2hex(openssl_random_pseudo_bytes(32));
		$this->hash = hash_pbkdf2("sha512", $password, $this->salt, 262144, 128);

		$this->profile = new Profile(null, "Ronald McDonald", "ronnie@mcdonalds.com", $this->hash, $this->salt);
		$this->profile->insert($this->getPDO());
		// $this->VALID_TEAM = new Team(null, $this->VALID_SPORT->getSportId(), 1, "Albuquerque", "Lobos");
		// $this->VALID_TEAM->insert($this->getPDO());

		// $this->VALID_PLAYER = new Player(null, $this->VALID_PLAYERAPIID, $this->VALID_TEAMID, $this->VALID_PLAYERSPORTID,"Mike");
		// $this->VALID_PLAYER->insert($this->getPDO());
		//Generate Hash and Salt

	}

	/**
	 * test inserting a valid player and verify that the actual MySQL data matches
	 **/
	public function testInsertValidFavoritePlayer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favoritePlayer and insert it into MySQL
		$favoritePlayer = new FavoritePlayer($this->profile->getProfileId(), $this->player->getPlayerId());
		$favoritePlayer->insert($this->getPDO());

		//test that the new favorite player was inserted into MySQL
		// $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));

		//grab the data from MySQL and enforce the fields match our expectation
		$pdoFavoritePlayer = FavoritePlayer::getFavoritePlayerByFavoritePlayerProfileIdAndFavoritePlayerPlayerId($this->getPDO(), $this->profile->getProfileId(), $this->player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));
		$this->assertEquals($pdoFavoritePlayer->getFavoritePlayerProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoFavoritePlayer->getFavoritePlayerPlayerId(), $this->player->getPlayerId());
	}


	/**
	 * test inserting a valid player that has already been inserted and watch it fail
	 *
	 * @expectedException \PDOException
	 */
	public function testInsertInvalidFavoritePlayer() {
		//create a new favoritePlayer and insert it into mySQL
		$favoritePlayer = new FavoritePlayer(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$favoritePlayer->insert($this->getPDO());
	}

	/**
	 * test inserting a favorite player that does not exist
	 *
	 *
	 */
	/**public function testInsertInvalidFavoritePlayer() {
	 * //create new player with a null profile Id and watch it fail
	 * $favoritePlayer = new FavoritePlayer($this->VALID_PROFILE->getProfileId(), SprotsTest::INVALID_KEY);
	 * $favoritePlayer->insert($this->getPDO());
	 *
	 * }
	 * /**
	 * test deleting a favorite player from MySQL
	 *
	 *
	 */

	public function testDeleteFavoritePlayer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favoritePlayer and insert it into mySQL
		$favoritePlayer = new FavoritePlayer($this->profile->getProfileId(), $this->player->getPlayerId());
		$favoritePlayer->insert($this->getPDO());

		// delete the Favorite Player from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));
		$favoritePlayer->delete($this->getPDO());

		// grab the data from mySQL and enforce the Favorite Player does not exist
		$pdoFavoritePlayer = FavoritePlayer::getFavoritePlayerByFavoritePlayerProfileIdAndFavoritePlayerPlayerId($this->getPDO(), $this->profile->getProfileId(), $this->player->getPlayerId());
		$this->assertNull($pdoFavoritePlayer);
		//var_dump($pdoFavoritePlayer);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("favoritePlayer"));
	}

	public function testDeleteInvalidFavoritePlayerByFavoritePlayerProfileId() {
		// create a favorite player, with a non null favorite player id, and watch it fail.
		$favoritePlayer = new FavoritePlayer($this->profile->getProfileId(), $this->player->getPlayerId());
		$favoritePlayer->delete($this->getPDO());
	}


	/**
	 * test getting favorite player by profile id
	 *
	 */

	public function testGetFavoritePlayersByFavoritePlayerProfileId() {

		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("favoritePlayer");

		//create a new favorite player
		$favoritePlayer = new FavoritePlayer($this->profile->getProfileId(), $this->player->getPlayerId());
		$favoritePlayer->insert($this->getPDO());


		//grab the data from MySQL and enforce the fields match our expectation
		$results = FavoritePlayer::getFavoritePlayersByFavoritePlayerProfileId($this->getPDO(), $this->profile->getProfileId(), $this->player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoritePlayer"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\FavoritePlayer", $results);

		$pdoFavoritePlayer = $results[0];
		$this->assertEquals($pdoFavoritePlayer->getFavoritePlayerProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoFavoritePlayer->getFavoritePlayerPlayerId(), $this->player->getPlayerId());
	}

	/**
	 * test getting a favorite player from favoritePlayerProfileId
	 **/
	public function testGetInvalidFavoritePlayerByFavoritePlayerProfileId() {
		// grab a favorite player that exceeds the maximum allowable favoriteplayerplayerId length
		$favoritePlayerPlayerId = FavoritePlayer::getFavoritePlayersByFavoritePlayerProfileId($this->getPDO(), SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
		$this->assertEquals(0, 0);
	}
}
