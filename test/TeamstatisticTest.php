<?php

namespace Edu\Cnm\Sprots\DataDesign\Test;

use Edu\Cnm\Sprots\DataDesign\{Sport};

// grab the project test parameters
require_once("DataDesignTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for the teamstatistic class
 *
 * This is a complete PHPUnit test of the teamstatistic class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see
 * @author Jude Chavez @chavezjude7@gmail.com>
 **/

class teamstatistictTest extends DataDesignTest {
	/**
	 * content of the teamstatistic
	 * @var string $VALID_TEAMSTATISTICCONTENT
	 **/
	protected $VALID_TEAMSTATISTICCONTENT = "PHPUnit test passing:";
	/**
	 * content of the updated teamstatistic
	 * @var string $VALID_TEAMSTATISTICCONTENT2
	 **/
	protected $VALID_TEAMSTATISTICCONTENT2 = "PHPUnit test still passing";
	/**
	 * timestamp of the teamstatistic; this starts as null is assigned later
	 * @var \DateTime $VALID_TEAMSTATISITCDATE
	 */
	protected $VALID_TEAMSTATISTICDATE = null;
	/**
	 * team that created the teamstatistic; this is for foreign key relations
	 * @var player teamstatistic
	 */
	protected $team = null;

	/**
	 * create depended objects before running each test
	 */
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		//create and insert a team to own this team statistic
		$this->team = new team(null, "@phpunit", "test@phpunit.de", "+12125551212");

		$this->team->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_TEAMSTATISTIC = new /\DateTime();

	}

	/**
	 * test inserting a valid teamsatistic and verify that the actual mySQL was setup...)
	 */
	public function testInsertValidIdTeamstatistic() {
		// count the number of rows and save if for later
		$numRows = $this->getConnection()->getRowCount("TeamStatistic");

		// create a new TeamStatistic and insert to into mySQL
		$teamStatistic = new Tweet(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICCONTENT, $this->VALID_TEAMSTATISTICDATE);
	}

	/**
	 * test inserting a teamstatistic that already exists
	 *
	 * @expectedException PDOException
	 */
	public function testInsertInvalidTeamstatistic() {
		// create a team statistic with a non null teamstatistic id and watch it fail
		$teamstatistic = new teamStatistic(DataDesignTest::INVALID_KEY, $this->profile->getProfileId(), $this->VALID_TEAMSTATISTICCONTENT, $this->VALID_TEAMSTATISTICDATE0);
		$teamstatistic->insert($this->getPDO());
	}
	/**
	 * test inserting a teamstatistic, editing it, and then uploading it
	 */
	public function testUpdateValidTeamStatistic() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamstatistic");

		//create a new teamstatistic and insert to into mySLQ
		$tesmstatistc = new \teamStatistic(null, $this->team->getteamId(), $this->VALID_TEAMSTATISTICCONTENT, $this->VALID_TEAMSTATISTICDATE);
		$teamstatistic->insert($this->getPDO());

		// delete the tweet from mySQL
		$this->assertEquals($numRows + 1, 4this->getConnection()->getRowCount("teamstatistic"));
		$teamstatistic->delete($this->getPDO());

		//grab the data from mySQL and enforce the teamstatistic does not exists
		$pdoTeamstatistic = teamstatistic::getTeamstatisticByTeamstatisticId($this->getPDO(), $Teamstatistic->getTeamstatisticId());
		$this->assertNull($pdoTeamstatistic);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("teamstatistic"));
		}
	/**
	 * test deleting a teamstatistic that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testDeleteInvalidTeamstatistic() {
		// create a teamstatistic and try to delete it without actually inserting it
		$teamstatistic = new teamStatistic(null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTICCONTENT, $this->VALID_TEAMSTATISTICDATE);
		$teamstatistic->delete($this->getPDO());
		}

	/**
	 * test inserting a teamstatistic and regrabbing it from mySQL
	 */

	public function testGetValidTeamstatitsticByTweetId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("teamstatistic");

		// create a new teamstatistic and insert to into mySQL
		$teamstatistic = new \teamStatistic(null, $this->profile->getprofileId(), $this->VALID_TEAMSTATISTICCONTENT, $this->VALID_TEAMSTATISTICDATE);
		$tweet->insert(this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectation
		$pdoTeamstatistic = Teamstatistic::getTeamstatisticByTeamstatisticId($this->getPDO(), $teamstatistic->getTeamStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamstatistic"));
		$this->asserEquals($pdoTeamstatistic->getTeamId(), $this->Team->getTeamId());
		$this->assertEquals($pdoTeamstatistic->getTeamstatisticContent(), $this->VALID_TEAMSTATISTICCONTENT);
		$this->assertEquals($pdoTeamstatistic->getTeamstatisticDate(), $this->VALID_TEAMSTATISTICDATE);
	}

	/**
	 * test grabbing a tweet that does not exist
	 */
	public function testGetInvalidTeamstatisticByTeamstatisticId() {
		// grab a team id that exceeds the maximus allowable team id
		$teamstatistic = $teamstatistic::getteamstatisticByteamstatisticId($this->getPDO(), DataDesignTest::INVALID_KEY);
		$this->assertNull($teamstatistic);
	}
	/**
	 * test grabbing a teamstatistic by teamstatistic content
	 */
	public function testGetValidTeamstatisticByTeamstatisticContent()

		// count the number of rows and save it for later

	$numRows = $this->getConnection()->getRowCount("teamstatistic")

	// create a new teamstatistic and insert to into mySQL

	$teamstatistic = new Teamstatistic (null, $this->team->getTeamId(), $this->VALID_TEAMSTATISTIC, $this->VALID_TEAMSTATISTICDATE);

	$teamstatistic->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectation
			$results= teamstatistic::getTeamstatisticByTeamstatisticContent($this->getPDO(), $tweet->getTeamstatisticContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("teamstatistic"));
$this->assertCount(1, $results);
}