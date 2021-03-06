<?php
namespace Edu\Cnm\Sprots\Test;




require_once("SprotsTest.php");

//grab the project test parameters
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

use Edu\Cnm\Sprots\Team;
use Edu\Cnm\Sprots\Sport;

/**
 * Full PHPUnit test for the PlayerStatistic class
 *
 * This is a complete PHPUnit test of the PlayerStatistic class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Team
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class TeamTest extends SprotsTest {
	/**
	 * Team Api ID that the team belongs to
	 * @var int $VALID_TEAMAPIID
	 */
	protected $VALID_TEAMAPIID = 42;

	/**
	 * content of the updated team api id
	 * @var string $VALID_TEAMAPIID2
	 **/
	protected $VALID_TEAMAPIID2 = 01;

	/**
	 * Team City that the team belongs to
	 * @var string $VALID_TEAMCITY
	 */
	protected $VALID_TEAMCITY = "Team City 1";

	/**
	 * content of the updated team city
	 * @var string $VALID_TEAMCITY2
	 **/
	protected $VALID_TEAMCITY2 = "Team City 2";

	/**
	 * Team name associated with the Team
	 * @var string $VALID_TEAMNAME
	 */

	protected $VALID_TEAMNAME= "Team Name 1";

	/**
	 * content of the updated team name
	 * @var string $VALID_TEAMNAME2
	 **/
	protected $VALID_TEAMNAME2 = "Team Name 2";

	/**
	 * Sport that team belongs to
	 * @var Sport $sport
	 */
	protected $sport = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// Create and insert a sport to own the test team
		$this->sport = new Sport (null, "sportLeague", "sportLeague2", "SportName", "SportName2");
		$this->sport->insert($this->getPDO());

	}

	/**
	 * test inserting a valid team and verify that the actual mySQL data matches
	 */
	public function testInsertValidTeam() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("team");

		// Create a new team and insert into mySQL
		$team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeam = Team::getTeamByTeamId($this->getPDO(), $team->getTeamId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("team"));
		$this->assertEquals($pdoTeam->getTeamId(), $team->getTeamId());
		$this->assertEquals($pdoTeam->getTeamApiId(), $this->VALID_TEAMAPIID);
		$this->assertEquals($pdoTeam->getTeamCity(), $this->VALID_TEAMCITY);
		$this->assertEquals($pdoTeam->getTeamName(), $this->VALID_TEAMNAME);
		$this->assertEquals($pdoTeam->getTeamSportId(), $this->sport->getSportId());
	}



	/**
	 * test inserting a Team that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidTeam() {
		// create a Team with a non-null team id and watch it fail
		$team = new Team($this->sport->getSportId(),  SprotsTest::INVALID_KEY, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());
	}

	/**
	 * test inserting a Team, editing it, and then updating it
	 **/
	public function testUpdateValidTeam() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("team");

		// Create a new team and insert into mySQL
		$team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());

		// edit the Team and update it in mySQL
		$team->setTEAMAPIID($this->VALID_TEAMAPIID2);
		$team->setTEAMCITY($this->VALID_TEAMCITY2);
		$team->setTEAMNAME($this->VALID_TEAMNAME2);
		$team->update($this->getPDO());


		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTeam = Team::getTeamByTeamId($this->getPDO(), $team->getTeamId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("team"));
		$this->assertEquals($pdoTeam->getTeamSportId(), $this->sport->getSportId());
		$this->assertEquals($pdoTeam->getTeamApiId(), $this->VALID_TEAMAPIID2);
		$this->assertEquals($pdoTeam->getTeamCity(), $this->VALID_TEAMCITY2);
		$this->assertEquals($pdoTeam->getTeamName(), $this->VALID_TEAMNAME2);
		//$this->assertEquals($pdoTeam->getTeamSportId(), $this->VALID_TEAMSPORTID);
	}
	/**
	 * test updating a Team that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidTeam() {
		// create a Team with a non null team id and watch it fail
		$team = new Team($this->sport->getSportId(), SprotsTest::INVALID_KEY, $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());
		$team->update($this->getPDO());
	}
	/**
	 * test creating a Team and then deleting it
	 **/
	public function testDeleteValidTeam() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("team");

		// create a new Team and insert to into mySQL
		$team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());

		// delete the Team from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("team"));
		$team->delete($this->getPDO());

		// grab the data from mySQL and enforce the Team does not exist
		$pdoTeam = Team::getTeamByTeamId($this->getPDO(), $team->getTeamId());
		$this->assertNull($pdoTeam);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("team"));
	}

	/**
	 * test deleting a Team that does not exist
	 *
	 * @expectedException \PDOException
	 **/

	public function testDeleteInvalidTeam() {
		// create a new Team and try to delete it without actually inserting it
		$team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->delete($this->getPDO());
	}

	/**
	 * test grabbing a Team that does not exist
	 **/
	public function testGetValidTeamByTeamId() {
		// grab a team id that exceeds the maximum allowable team id
		$team = Team::getTeamByTeamId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($team);
	}

	/**
	 * test grabbing a Team that does not exist
	 **/
	public function testGetValidTeamByTeamApiId() {
		// grab a team Api id that exceeds the maximum allowable team api id
		$team = Team::getTeamByTeamApiId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($team);
	}

	/**
	 * test grabbing a Team by team city
	 **/
	public function testGetValidTeamByTeamCity() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("team");

		// create a new Team and insert to into mySQL
		$team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Team::getTeamByTeamCity($this->getPDO(), $team->getTeamCity());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("team"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Team", $results);

		// grab the result from the array and validate it
		$pdoTeam = $results[0];
		$this->assertEquals($pdoTeam->getTeamSportId(), $this->sport->getSportId());
		$this->assertEquals($pdoTeam->getTeamApiId(), $this->VALID_TEAMAPIID);
		$this->assertEquals($pdoTeam->getTeamCity(), $this->VALID_TEAMCITY);
		$this->assertEquals($pdoTeam->getTeamName(), $this->VALID_TEAMNAME);
		//$this->assertEquals($pdoTeam->getTeamSportId(), $this->VALID_TEAMSPORTID);
	}

	/**
	 * test grabbing a Team by team name
	 **/
	public function testGetValidTeamByTeamName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("team");

		// create a new Team and insert to into mySQL
		$team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Team::getTeamByTeamName($this->getPDO(), $team->getTeamName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("team"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Team", $results);

		// grab the result from the array and validate it
		$pdoTeam = $results[0];
		$this->assertEquals($pdoTeam->getTeamSportId(), $this->sport->getSportId());
		$this->assertEquals($pdoTeam->getTeamApiId(), $this->VALID_TEAMAPIID);
		$this->assertEquals($pdoTeam->getTeamCity(), $this->VALID_TEAMCITY);
		$this->assertEquals($pdoTeam->getTeamName(), $this->VALID_TEAMNAME);
		//$this->assertEquals($pdoTeam->getTeamSportId(), $this->VALID_TEAMSPORTID);
	}

	/**
	 * test grabbing all Teams
	 **/
	public function testGetAllValidTeams() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("team");

		// create a new Team and insert to into mySQL
		$team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Team::getAllTeams($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("team"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Team", $results);

		// grab the result from the array and validate it
		$pdoTeam = $results[0];
		$this->assertEquals($pdoTeam->getTeamSportId(), $this->sport->getSportId());
		$this->assertEquals($pdoTeam->getTeamApiId(), $this->VALID_TEAMAPIID);
		$this->assertEquals($pdoTeam->getTeamCity(), $this->VALID_TEAMCITY);
		$this->assertEquals($pdoTeam->getTeamName(), $this->VALID_TEAMNAME);
		//$this->assertEquals($pdoTeam->getTeamSportId(), $this->VALID_TEAMSPORTID);
	}


}