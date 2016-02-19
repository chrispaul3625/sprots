<?php

namespace Edu\Cnm\Sprots\Test;


use Edu\Cnm\Sprots\Sport;
use Edu\Cnm\Sprots\Team;
use Edu\Cnm\Sprots\TeamStatistic;

// grab the project test parameters
require_once("SprotsTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the TeamStatistic class
 *
 * This is a complete PHPUnit test of the TeamStatistic class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see
 * @author Jude Chavez <chavezjude7@gmail.com>
 **/

class PlayerTest extends SprotsTest {

	/**
	 * Id of the Player
	 * @var string $VALID_PLAYERID
	 **/

	Protected $VALID_PLAYERID = null;

	/**
	 * content of the updated Player
	 * @var string $VALID_PLAYERID2
	 **/

	Protected $VALID_PLAYERID2 = null;

	/**
	 * is unique to Player
	 * @var string $VALID_PLAYERNAME
	 *
	 **/

	Protected $VALID_PLAYERNAME = null;

	/**
	 * content of the updated player name
	 * @var string $VALID_PLAYERNAME2
	 **/

	Protected $VALID_PLAYERNAME2 = null;

	/**
	 * Api Id of the player
	 * @var string $VALID_PLAYERAPIID
	 **/

	Protected $VALID_PLAYERAPIID = null;

	/**
	 * content of the updated player Api Id
	 * @var string $VALID_PLAYERAPIID2
	 **/

	Protected $VALID_PLAYERAPIID2 = null;

/**
 * player is unique to team, player can not be associated with >1 team
 * @var string $VALID_PLAYERTEAMID
 **/

Protected $VALID_PLAYERTEAMID = null;

/**
 * content of the updated player team
 * @var string $VALID_PLAYERTEAMID2
 **/

Protected $VALID_PLAYERTEAMID2 = null;

/**
 * Team that Player Belongs to
 * @var string $VALID_TEAM
 **/

Protected $team = "PHPUnit test still passing";

/**
 * create dependent objects before running each test
 **/

public final function setUp() {
	// run the default setUp() method first
	parent::setUp();

	// create and insert a Profile to own the test Tweet
	$this->team = new Team(null, "teamApiId", "teamApiId2", "teamCity", "teamCity2", "teamName", "teamName2");
	$this->team->insert($this->getPDO());

}

  /**
	* test inserting a valid team and verify that the actual mySQL data matches
	*/
public function testInsertValidIdPlayer(){
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and insert into mySQL
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->insert($this->getPDO());
}

/**
 * test inserting a player, editing it and then updating it
 **/
public function testUpdateValidPlayer() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and update it in mySQL
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->insert($this->getPDO());

	// edit the date from mySQL and enforce the fields match out expectations
	$pdoPlayer = player::getPlayerByPlayerId($this->getPDO(), $player->getTeamId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$this->assertEquals($pdoPlayer->getTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoPlayer->getPlayerId(), $this->VALID_PLAYERID);
	$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME);
	$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID);
	$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->VALID_PLAYERTEAMID);
}

/**
 * test updating a player that already exists
 *
 * @expectedException PDOException
 **/
public function testUpdateinValidPlayer() {
	// create a player with a non null playerId and watch it fann_get_bit_fail
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->update($this->getPDO());
}

/**
 * test creating a player and then deleting it
 **/
public function testDeleteValidPlayer() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and insert into mySQL
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->insert($this->getPDO());

	// delete the player from mySQL
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$player->delete($this->getPDO());

	// grab the data from mySQL and enforce the player does not exist
	$pdoPlayer = player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
	$this->assertNull($pdoPlayer);
	$this->assertEquals($numRows, $this->getConnection()->getRowCount("player"));
}

/**
 * test deleting a player that does not exist
 *
 * @expectedException PDOException
 **/
public function testDeleteInvalidPlayer() {
	// creat a player and try to delete it without actually inserting it
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->delete($this->getPDO());
}

/**
 * test inserting a player and regrabbing it from mySQL
 **/
public function testGetValidPlayerByPlayerId() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	//create a new player and insert to into mySQL
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our ecpectations
	$pdoPlayer = player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$this->assertEquals($pdoPlayer->getTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoPlayer->getPlayerId(), $this->VALID_PLAYERID);
	$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME);
	$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID);
	$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->VALID_PLAYERTEAMID);
}

/**
 * test grabbing a player that does not exist
 **/
public function testGetInvalidPlayerByPlayerId() {
	// grab a player that exceeds the maximum allowable team id
	$player = player::getPlayerByPlayerId($this->getPDO(), SprotsTest::INVALID_KEY);
	$this->assertNull($player);
}

/**
 * test grabbing a player by player content
 **/
public function testGetValidPlayerByPlayerContent() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new Player and insert to into mySQL
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our expectations
	$results = player::getPlayerByPlayerContent($this->getPDO(), $player->getPlayerContent());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$this->assertCount(1, $results);
	$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Test", $results);

	// grab the result from the array and validate it
	$pdoPlayer = $results[0];
	$this->assertEquals($pdoPlayer->getTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoPlayer->getPlayerId(), $this->VALID_PLAYERID);
	$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME);
	$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID);
	$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->VALID_PLAYERTEAMID);
}

/**
 * test grabbing a teamStatistic by content that does not exist
 **/
public function testGetInvalidTeamStatisticByTeamStatisticContent() {
	// grab a team id that exceeds the maximum allowable team id
	$teamStatistic = teamStatistic::getTeamStatisticByTeamStatisticContent($this->getPDO(), "teamStatistic does not exist");
	$this->assertCount(0, $teamStatistic);
}

/**
 * test grabbing all players
 **/
public function testGetAllValidPlayers() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and insert to into mySQL
	$player = new player(null, $this->team->getTeamId(), $this->VALID_PLAYERID, $this->VALID_PLAYERNAME, $this->VALID_PLAYERAPIID, $this->VALID_PLAYERTEAMID);
	$player->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our expectations
	$results = player::getAllPlayers($this->getPDO());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$this->assertCount(1, $results);
	$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Test", $results);

	// grab the result from the array and validate it
	$pdoPlayer = $results[0];
	$this->assertEquals($pdoPlayer->getTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoPlayer->getPlayerId(), $this->VALID_PLAYERID);
	$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME);
	$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID);
	$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->VALID_PLAYERTEAMID);
}
}
