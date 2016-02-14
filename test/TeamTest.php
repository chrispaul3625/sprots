<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{
	Team, Sport
};


require_once("SprotsTest.php");

//grab the project test parameters
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

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
	protected $VALID_TEAMAPIID = null;

	/**
	 * content of the updated team api id
	 * @var string $VALID_TEAMAPIID2
	 **/
	protected $VALID_TEAMAPIID2 = null;

	/**
	 * Team City that the team belongs to
	 * @var string $VALID_TEAMCITY
	 */
	protected $VALID_TEAMCITY = "PHPUnit test still passing";

	/**
	 * content of the updated team city
	 * @var string $VALID_TEAMCITY2
	 **/
	protected $VALID_TEAMCITY2 = "PHPUnit test still passing";

	/**
	 * Team name associated with the Team
	 * @var string $VALID_TEAMNAME
	 */

	protected $VALID_TEAMNAME= "PHPUnit test still passing";

	/**
	 * content of the updated team name
	 * @var string $VALID_TEAMNAME2
	 **/
	protected $VALID_TEAMNAME2 = "PHPUnit test still passing";

	/**
	 * Sport that team belongs to
	 * @var string $VALID_SPORT
	 */

	protected $sport = "PHPUnit test still passing";

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// Create and insert a sport to own the test team
		$this->sport = new Sport (null, "sportLeague", "sportLeague2", "SportTeam", "SportTeam2");
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
		$this->assertEquals($pdoTeam->getTeamId(), $this->sport->getSportId());
		$this->assertEquals($pdoTeam->getTeamApiId(), $this->VALID_TEAMAPIID);
		$this->assertEquals($pdoTeam->getTeamCity(), $this->VALID_TEAMCITY);
		$this->assertEquals($pdoTeam->getTeamName(), $this->VALID_TEAMNAME);
	}

	/**
	 * test inserting a Team that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidTeam() {
		// create a Team with a non null team id and watch it fail
		$team = new Team(SprotsTest::INVALID_KEY, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
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
		$this->assertEquals($pdoTeam->getTeamId(), $this->sport->getSportId());
		$this->assertEquals($pdoTeam->getTeamApiId(), $this->VALID_TEAMAPIID);
		$this->assertEquals($pdoTeam->getTeamCity(), $this->VALID_TEAMCITY);
		$this->assertEquals($pdoTeam->getTeamName(), $this->VALID_TEAMNAME);
	}
	/**
	 * test updating a Team that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidTeam() {
		// create a Team with a non null team id and watch it fail
		$team = new Team(SprotsTest::INVALID_KEY, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
		$team->insert($this->getPDO());
		$team->update($this->getPDO());
	}


	}