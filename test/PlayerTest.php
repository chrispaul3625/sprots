<?php

namespace Edu\Cnm\Sprots\Test;


use Edu\Cnm\Sprots\Player;
use Edu\Cnm\Sprots\Sport;
use Edu\Cnm\Sprots\Team;


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
	 * is unique to Player
	 * @var string $VALID_PLAYERNAME
	 *
	 **/

	Protected $VALID_PLAYERNAME = "Player Name 1";

	/**
	 * content of the updated player name
	 * @var string $VALID_PLAYERNAME2
	 **/

	Protected $VALID_PLAYERNAME2 = "Player Name 2";

	/**
	 * Api Id of the player
	 * @var string $VALID_PLAYERAPIID
	 **/

	Protected $VALID_PLAYERAPIID = 54;

	/**
	 * content of the updated player Api Id
	 * @var string $VALID_PLAYERAPIID2
	 **/

	Protected $VALID_PLAYERAPIID2 = 865;

	/**
	 * content of the updated team api id
	 * @var string $VALID_PLAYERAPIID
	 **/
	protected $VALID_TEAMAPIID = 001;

	/**
	 * content of the updated team api id
	 * @var string $VALID_PLAYERAPIID2
	 **/
	protected $VALID_TEAMAPIID2 = 941;

/**
 * content of the updated player team
 * @var string $VALID_PLAYERTEAMID2
 **/

Protected $VALID_PLAYERTEAMID2 = null;

/**
 * Team that Player Belongs to
 * @var Team $team
 **/

Protected $team = null;

	/**
	 * Team that Player Belongs to
	 * @var Team $team2
	 **/

	Protected $team2 = null;



	/**
	 * Sport that Player/team Belongs to
	 * @var Sport $sport
	 **/

	Protected $sport = null;
/**
 * create dependent objects before running each test
 **/

public final function setUp() {
	// run the default setUp() method first
	parent::setUp();

	// Create and insert a sport to own the test team

	$this->sport = new Sport (null, "sportLeagues", "sportLeagues2", "SportNames", "SportNames2");
	$this->sport->insert($this->getPDO());


	// create and insert a Profile to own the test Team
	$this->team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, "TeamCities2", "TeamName");
	$this->team->insert($this->getPDO());

	$this->team2 = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID2, "TeamCity2", "TeamName2");
	$this->team2->insert($this->getPDO());



}

  /**
	* test inserting a valid playerand verify that the actual mySQL data matches
	*/
public function testInsertValidIdPlayer(){
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and insert into mySQL
	$player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(),$this->sport->getSportId(), $this->VALID_PLAYERNAME);
	$player->insert($this->getPDO());

// grab the data from mySQL and enforce the fields match our expectations
	$pdoPlayer = Player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$this->assertEquals($pdoPlayer->getPlayerId(), $player->getPlayerId());
	$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID);
	$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoPlayer->getPlayerSportId(), $this->sport->getSportId());
	$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME);


}
	/**
	 * test inserting a Player that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidPlayer() {
		// create a Player with a non-null player id and watch it fail
		$player = new Player($this->VALID_PLAYERAPIID,$this->team->getTeamId(), SprotsTest::INVALID_KEY,$this->sport->getSportId(),  SprotsTest::INVALID_KEY, $this->VALID_PLAYERNAME);
		$player->insert($this->getPDO());
	}

/**
 * test inserting a player, editing it and then updating it
 **/
public function testUpdateValidPlayer() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and update it in mySQL
	$player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(),$this->sport->getSportId(), $this->VALID_PLAYERNAME);
	$player->insert($this->getPDO());

	// edit the Player and update it in mySQL
	$player->setPLAYERAPIID($this->VALID_PLAYERAPIID2);
	$player->setPLAYERNAME($this->VALID_PLAYERNAME2);
	$player->update($this->getPDO());

	// grab the data from mySQL and enforce the fields match out expectations
	$pdoPlayer = player::getPlayerByPlayerId($this->getPDO(), $player->getPlayerId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$this->assertEquals($pdoPlayer->getPlayerId(), $player->getPlayerId());
	$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID2);
	$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoPlayer->getPlayerSportId(), $this->sport->getSportId());
	$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME2);
}

/**
 * test updating a player that already exists
 *
 * @expectedException \PDOException
 **/
public function testUpdateInvalidPlayer() {
	// create a player with a non null playerId and watch it fail
	$player = new Player($this->VALID_PLAYERAPIID,$this->team->getTeamId(), SprotsTest::INVALID_KEY,$this->sport->getSportId(),  SprotsTest::INVALID_KEY, $this->VALID_PLAYERNAME);
	$player->insert($this->getPDO());
	$player->update($this->getPDO());
}

/**
 * test creating a player and then deleting it
 **/
public function testDeleteValidPlayer() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and insert into mySQL
	$player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(),$this->sport->getSportId(), $this->VALID_PLAYERNAME);
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
 * @expectedException \PDOException
 **/
public function testDeleteInvalidPlayer() {
	// create a player and try to delete it without actually inserting it
	$player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(),$this->sport->getSportId(), $this->VALID_PLAYERNAME);
	$player->delete($this->getPDO());
}

/**
 * test inserting a player and regrabbing it from mySQL
 **/
public function testGetValidPlayerByPlayerId() {

	//create a new player and insert to into mySQL
	$player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(),$this->sport->getSportId(), $this->VALID_PLAYERNAME);
	$player->insert($this->getPDO());

}


/**
 * test grabbing a player that does not exist
 **/
public function testGetInvalidPlayerByPlayerId() {
	// grab a player that exceeds the maximum allowable team id
	$player = Player::getPlayerByPlayerId($this->getPDO(), SprotsTest::INVALID_KEY);
	$this->assertNull($player);
}

/**
 * test grabbing a player by player content
 **/
public function testGetValidPlayerByPlayerApiId() {
	$player = Player::getPlayerByPlayerApiId($this->getPDO(), SprotsTest::INVALID_KEY);
	$this->assertNull($player);
}


	/**
	 * test grabbing a player by player content
	 **/
	public function testGetValidPlayerByPlayerName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("player");

		//create a new player and insert to into mySQL
		$player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(),$this->sport->getSportId(), $this->VALID_PLAYERNAME);
		$player->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Player::getPlayerByPlayerName($this->getPDO(), $player->getPlayerName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Player", $results);

		// grab the result from the array and validate it
		$pdoPlayer = $results[0];
		$this->assertEquals($pdoPlayer->getPlayerId(), $player->getPlayerId());
		$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID);
		$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoPlayer->getPlayerSportId(), $this->sport->getSportId());
		$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME);
	}



/**
 * test grabbing all players
 **/
public function testGetAllValidPlayers() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("player");

	// create a new player and insert to into mySQL
	$player = new Player(null, $this->VALID_PLAYERAPIID, $this->team->getTeamId(),$this->sport->getSportId(), $this->VALID_PLAYERNAME);
	$player->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our expectations
	$results = Player::getAllPlayers($this->getPDO());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("player"));
	$this->assertCount(1, $results);
	$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Player", $results);

	// grab the result from the array and validate it
	$pdoPlayer = $results[0];
	$this->assertEquals($pdoPlayer->getPlayerId(), $player->getPlayerId());
	$this->assertEquals($pdoPlayer->getPlayerApiId(), $this->VALID_PLAYERAPIID);
	$this->assertEquals($pdoPlayer->getPlayerTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoPlayer->getPlayerSportId(), $this->sport->getSportId());
	$this->assertEquals($pdoPlayer->getPlayerName(), $this->VALID_PLAYERNAME);
}
}
