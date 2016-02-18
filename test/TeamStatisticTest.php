<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{Statistic, Player, Team};

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

class TeamStatistictTest extends SprotsTest {

	/**
	 * Id of the TeamStatistic
	 * @var string $VALID_TEAMSTATISTICTEAMID
	 **/
	protected $VALID_TEAMSTATISTICTEAMID = null;

	/**
	 * content of the updated teamStatisticId
	 * @var string $VALID_TEAMSTATISTICTEAMID2
	 **/

	protected $VALID_TEAMSTATISTICTEAMID2 = null;

	/**
	 * is unique value of the teamStatistic
	 * @var string $VALID_TEAMSTATISTICVALUE
	 **/

	protected $VALID_TEAMSTATISTICVALUE = null;

	/**
	 * content of the updated teamStatisticValue
	 * @var string $VALID_TEAMSTATISTICVALUE2
	 **/

	protected $VALID_TEAMSTATISTICVALUE2 = null;

	/**
	 * is unique to Statistic and Team
	 * @var string $VALID_TEAMSTATISTICSTATISTICID
	 */

	protected $VALID_TEAMSTATISTICSTATISTICID = null;

	/**
	 * content of the updated statistic and team
	 * @var string $VALID_TEAMSTATISTICSTATISTICID2
	 **/

	protected $VALID_TEAMSTATISTICSTATISTICID2 = Touchdowns;

	/**
	 * is unique to Team and Game Played
	 * @var string $VALID_TEAMSTATISTICGAMEID
	 */

	protected $VALID_TEAMSTATISTICGAMEID = null;

	/**
	 * content of updated TeamStatisticGameId
	 * @var string $VALID_TEAMSTATISTICGAMEID2
	 */

	protected $VALID_TEAMSTATISTICGAMEID2 = null;

	/**
	 * Team that Statistic belongs to
	 * @var string $VALID_TEAM
	 */

	protected $team = null;
	protected $statistic = null;
	protected $game = null;

	/**
	 * create dependent objects before running each test
	 **/

	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// Create and insert a sport to own the test teamstatistic
		$this->team = new Team (null, 24, 24, Chicago, Chicago, Bears, Bears);
		$this->team->insert($this->getPDO());

	}

	/**
	 * test inserting a valid team and verify that the actual mySQL data matches
	 */
public function testInsertValidTeamStatistic() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount(42);

	// create a new teamStatistic and insert into mySQL
$teamStatistic = new teamStatistic(null, $this->team->getTeamId(Bears), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
$teamStatistic->insert($this->getPDO());
}

/**
 * test inserting a Statistic that already exists
 *
 * @expectedException PDOException
 **/
public function testInsertInvalidTeamStatistic() {
	// create a teamStatsitc with a non null TeamStatisticId and watch it fail
	$teamStatistic = new teamStatistic(SprotsTest::INVALID_KEY, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
	$teamStatistic->insert($this->getPDO());
}

	/**
	 * test inserting a teamStatistic, editing it, and then updating it
	 **/
	public function testUpdateValidTeamStaitistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");

		// create a new TeamStatistic and insert to into mySQL
		$teamStatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$teamStatistic->insert($this->getPDO());

		// edit the TeamStatisitc and update it in mySQL
		$teamStatistic->setTeamStatisitcContent($this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$teamStatistic->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeamStatistic = teamStatisitc::getTeamStatisticByTeamStatisticId($this->getPDO(), $teamStatistic->getTeamId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$this->assertEquals($pdoTeamStatistic->getTeamId(), $this->team->getTeamId());
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticContent(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$this->assertEqulas($pdoTeamStatistic->getTeamStatisticGameId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
	}

	/**
	 * test updating a teamStatistic that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidTeamStatistic() {
		// create a TeamStatistic with a non null TeamStatisticId and watch it fail
		$teamStatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$teamStatistic->update($this->getPDO());
	}


	/**
	 * test creating a teamStatistic and then deleting it
	 **/
	public function testDeleteValidTeamStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamStatistic");

		// create a new TeamStatistic and insert to into mySQL
		$teamStatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
		$teamStatistic->insert($this->getPDO());

		// delete the TeamStatistic from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
		$teamStatistic->delete($this->getPDO());

		// grab the data from mySQL and enforce the TeamStatistic does not exist
		$pdoTeamStatistic = teamStatistic::getTeamStatisticByTeamStatisticId($this->getPDO(), $teamStatistic->getTeamStatisticId());
		$this->assertNull($pdoTeamStatistic);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("teamStatistic"));
	}


/**
 * test deleting a TeamStatistic that does not exist
 *
 * @expectedException PDOException
 **/
public function testDeleteInvalidTeamStatistic() {
	// create a TeamStatistic and try to delete it without actually inserting it
	$teamStatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
	$teamStatistic->delete($this->getPDO());
}

/**
 * test inserting a TeamStatistic and regrabbing it from mySQL
 **/
public function testGetValidTeamStatitsticByTeamStatisticId() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("teamStatistic");

	// create a new TeamStatistic and insert to into mySQL
	$teamStatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
	$teamStatistic->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our expectations
	$pdoTeamStatistic = teamStatistic::getTeamStatisticByTeamStatisticId($this->getPDO(), $teamStatistic->getTeamStatisticId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
	$this->assertEquals($pdoTeamStatistic->getTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticId(), $this->VALID_TEAMSTATISTICID);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->VALID_TEAMSTATISTICSTATISTICID);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->VALID_TEAMSTATISTICGAMEID);
}

/**
 * test grabbing a teamStatistic that does not exist
 **/
public function testGetInvalidTeamStatisticByTeamStatisticId() {
	// grab a teamStatisticId that exceeds the maximum allowable team id
	$teamStatistic = teamStatistic::getTeamStatisticByTeamStatisticId($this->getPDO(), SprotsTest::INVALID_KEY);
	$this->assertNull($teamStatistic);
}

/**
 * test grabbing a teamStatistic by teamStatistic content
 **/
public function testGetValidTeamStatisticByTeamStatisticContent() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("teamStatistic");

	// create a new TeamStatistic and insert to into mySQL
	$teamStatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->TEAMSTATISTICGAMEID);
	$teamStatistic->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our expectations
	$results = teamStatistic::getTeamStatisticByTeamStatisticContent($this->getPDO(), $teamStatistic->getTeamStatisticContent());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamstatistic"));
	$this->assertCount(1, $results);
	$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Test", $results);

	// grab the result from the array and validate it
	$pdoTeamStatistic = $results[0];
	$this->assertEquals($pdoTeamStatistic->getTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->VALID_TEAMSTATISTICTEAMID);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->VALID_TEAMSTATISTICSTATISTICID);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->VALID_TEAMSTATISTICGAMEID);

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
 * test grabbing all teamStatistic
 **/
public function testGetAllValidTeamStatistics() {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("teamStatistic");

	// create a new teamStatistic and insert to into mySQL
	$teamStatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICTEAMID, $this->VALID_TEAMSTATISTICVALUE, $this->VALID_TEAMSTATISTICSTATISTICID, $this->VALID_TEAMSTATISTICGAMEID);
	$teamStatistic->insert($this->getPDO());

	// grab the data from mySQL and enforce the fields match our expectations
	$results = teamStatistic::getAllTeamStatistics($this->getPDO());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamStatistic"));
	$this->assertCount(1, $results);
	$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Test", $results);

	// grab the result from the array and validate it
	$pdoTeamStatistic = $results[0];
	$this->assertEquals($pdoTeamStatistic->getTeamId(), $this->team->getTeamId());
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticTeamId(), $this->VALID_TEAMSTATISTICTEAMID);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticValue(), $this->VALID_TEAMSTATISTICVALUE);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticStatisticId(), $this->VALID_TEAMSTATISTICSTATISTICID);
	$this->assertEquals($pdoTeamStatistic->getTeamStatisticGameId(), $this->VALID_TEAMSTATISTICGAMEID);
}
}

