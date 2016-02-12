<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{Player};

// grab the project test parameters
require_once("DataDesignTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Tweet class
 *
 * This is a complete PHPUnit test of the Tweet class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Player
 * @author Jude Chavez <chavezjude7@gmail.com>
 **/
class PlayerTest extends SprotsTest {
	/**
	 * content of the player
	 * @var string $VALID_PLAYERCONTENT
	 **/
	protected $VALID_PLAYERCONTENT = "PHPUnit test passing";

/**
 * content of the updated Player
 * @var string $VALID_PLAYERCONTENT2
 **/
	protected $VALID_PLAYERCONTENT2 = "PHPUnit test still passing";
	/**
	 * timestamp of the Player; this starts as null and is assigned later
	 * @var DateTime $VALID_PLAYERDATE
	 **/
	protected $VALID_PLAYERDATE = null;
	/**
	 * Team that created the Player; this is for foreign key relations
	 * @var Team team
	 **/
	protected $team = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a team to own the test player

		$this->team = new team(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->team->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_PLAYERDATE = new \DateTime();
	}

	/**
	 * test inserting a valid player and verify that the actual mySQL data matches
	 **/
	public function testInsertValidplayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new player and insert to into mySQL
		$player = new player(null, $this->team->getteamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoplayer = player::getplayerByplayerId($this->getPDO(), $player->getplayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertEquals($pdoPlayer->getTeamId(), $this->player->getProfileId());
		$this->assertEquals($pdoPlayer->getPlayerContent(), $this->VALID_PLAYERCONTENT);
		$this->assertEquals($pdoPlayer->getPlayerDate(), $this->VALID_PlayerDATE);
	}

	/**
	 * test inserting a player that already exists
	 *
	 * @expectedException PDOException
	 **/

	public function testInsertInvalidPlayer() {
		// create a Player with a non null player id and watch it fail
		$player = new player (DataDesignTest::INVALID_KEY, $this->player->getTeamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->insert($this->getPDO());
	}

	/**
	 * test inserting a Player, editing it, and then updating it
	 **/

	public function testUpdateValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new player and insert to into mySQL

		$tweet = new Player(null, $this->team->getPlayerId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->insert($this->getPDO());

		// edit the player and update it in mySQL
		$player->setPlayerContent($this->VALID_PLAYERCONTENT2);
		$player->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertEquals($pdoPlayer->getTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayer->getPlayerContent(), $this->VALID_PLAYERCONTENT2);
		$this->assertEquals($pdoPlayer->getPlayerDate(), $this->VALID_PLAYERDATE);
	}

	/**
	 * test updating a Player that already exists
	 *
	 * @expectedException PDOException
	 **/

	public function testUpdateInvalidPlayer() {
		// create a Player with a non null Player id and watch it fail
		$tweet = new Player(null, $this->team->getTeamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->update($this->getPDO());
	}

	/**
	 * test creating a Player and then deleting it
	 **/
	public function testDeleteValidPlayer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new Player and insert to into mySQL

		$player = new Player(null, $this->team->getTeamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->insert($this->getPDO());

		// delete the Player from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$player->delete($this->getPDO());

		// grab the data from mySQL and enforce the player does not exist
		$pdoplayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertNull($pdoPlayer);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("player"));
	}

	/**
	 * test deleting a Player that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidPlayer() {
		// create a Player and try to delete it without actually inserting it
		$player = new Player(null, $this->team->getteamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->delete($this->getPDO());
	}

	/**
	 * test inserting a Player and regrabbing it from mySQL
	 **/
	public function testGetValidPlayerByPlayerId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new Player and insert to into mySQL

		$player = new Player(null, $this->team->getTeamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertEquals($pdoPlayer->getTeamId(), $this->twam->getTeamId());
		$this->assertEquals($pdoplayer->getPlayerContent(), $this->VALID_PLAYERCONTENT);
		$this->assertEquals($pdoPlayer->getPlayerDate(), $this->VALID_PLAYERDATE);
	}

	/**
	 * test grabbing a Player that does not exist
	 **/
	public function testGetInvalidPlayerByPlayerId() {
		// grab a team id that exceeds the maximum allowable profile id
		$player = Player::getPlayerByPlayerId($this->getPDO(), DataDesignTest::INVALID_KEY);
		$this->assertNull($Player);
	}

	/**
	 * test grabbing a Player by tweet content
	 **/
	public function testGetValidPlayerByPlayerContent() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new Player and insert to into mySQL
		$player = new Player(null, $this->team->getTeamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Player::getPlayerByPlayerContent($this->getPDO(), $player->getPlayerContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Test\\Player", $results);

		// grab the result from the array and validate it

		$pdoPlayer = $results[0];
		$this->assertEquals($pdoPlayer->getTeamId(), $this->Team->getteamId());
		$this->assertEquals($pdoPlayer->getPlayerContent(), $this->VALID_PLAYERCONTENT);
		$this->assertEquals($pdoPlayer->getPlayerDate(), $this->VALID_PlayerDATE);
	}

	/**
	 * test grabbing a Player by content that does not exist
	 **/
	public function testGetInvalidPlayerByPlayerContent() {
		// grab a team id that exceeds the maximum allowable profile id
		$player = Player::getPlayerByPlayerContent($this->getPDO(), "no player found this");
		$this->assertCount(0, $player);
	}

	/**
	 * test grabbing all Players
	 **/
	public function testGetAllValidPlayers() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		// create a new Player and insert to into mySQL

		$player = new Player(null, $this->team->getTeamId(), $this->VALID_PLAYERCONTENT, $this->VALID_PLAYERDATE);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Player::getAllPlayers($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("Player"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Test\\Player", $results);

		// grab the result from the array and validate it
		$pdoPlayer = $results[0];
		$this->assertEquals($pdoPlayer->getTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayer->getPlayerContent(), $this->VALID_PLAYERCONTENT);
		$this->assertEquals($pdoPlayer->getPlayerDate(), $this->VALID_PLAYERDATE);
	}
}

