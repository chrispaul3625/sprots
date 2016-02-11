<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\DataDesign\{Sport};

// grab the project test parameters
require_once("DataDesignTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoload.php");

/**
* Full PHPUnit test for the Sport class
*
*This is a complete PHPUnit test for the Sport class. It is complete, becasue *ALL* mySQL/pdo enabled methods
* are tested for both invalid, and valid inputs.
*
* @see Sport
* @author Dom Kratos <mr.kratos85@gmail.com>
**/
class SportTest extends DataDesignTest {
  /**
  * content for sport league
  * @var string $VALID_SPORTLEAGUE
  **/
  protected $VALID_SPORTLEAGUE = "PHPunit test passing";
  /**
  * content of the updated sport league
  * @var string $VALID_SPORTLEAGUE2
  **/
  protected $VALID_SPORTLEAGUE2 = "PHPUnit test still passing";
  /**
  * content for sport league
  * @var string $VALID_SPORTTEAM
  **/
  protected $VALID_SPORTTEAM = "PHPunit test passing";
  /**
  * content of the updated sport league
  * @var string $VALID_SPORTTEAM2
  **/
  protected $VALID_SPORTTEAM2 = "PHPUnit test still passing";

  /**
  * test inserting a valid sport team into mysql
  **/
  public function testInsertValidSportTeam() {
    //count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new sport and insert into the db
    $sport = new Sport(null, $this->profile->getProfileId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->insert($this->getPDO());

    // grab the data from MySQL and enforce the fields match our expectations
    $pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
    $this->assertEquals($pdoSport->getSportTeam(), $this->VALID_SPORTTEAM);
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
  }

  /**
  * test inserting a Sport that already exists
  *
  * @expectedException PDOException
  **/
  public function testInsertInvalidSport() {
    // create a sport with a non null sport id and watch it fail
    $sport = new Sport(DataDesignTest::INVALID_KEY, $this->sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->insert($this->getPDO());
  }

  /**
  * test inserting a sport, editing it, and then updating it.
  **/
  public function testUpdateValidSport() {
    //count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new sport and update it in the db
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->insert($this->getPDO());

    // edit the sport and update it in mysql
    $sport->setSportTeam($this->VALID_SPORTTEAM2);
    $sport->setSportLeague($this->VALID_SPORTLEAGUE2);
    $sport->update($this->getPDO());

    //grab the data from mysql and enforce the fields match our expectations
    $pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
    $this->assertEquals($numRows + 1, $this-getConnection()->getRowCount("sport"));
    $this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
    $this->assertEquals($pdoSport->getSportTeam(), $this->VALID_SPORTTEAM2);
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE2);
  }
  /**
  * test updating a sport that already exists
  *
  * @expectedException PDOException
  **/
  public function testUpdateInvalidSport() {
    // create a sport with a non null sport id and watch it fail
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->update($this->getPDO());
  }

  /**
  * test creating a Sport and then deleting it
  **/
  public function testDeleteValidSport() {
    // count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new Sport and insert it into mysql
    $sport = new Sport(null, $this-sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->insert($this->getPDO());

    // delete the Sport from the db
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $sport->delete($this->getPDO());

    // grab the data from mySQL and enforce the Sport does not exist
    $pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
    $this->assertNull($pdoSport);
    $this->assertEquals($numRows, $this->getConnection()->getRowCount("sport"));
  }

  /**
  * test deleting a Sport that does not exist
  *
  * @expectedException PDOException
  **/
  public function testDeleteInvalidSport() {
    // create a sport and try to delete it without actually inserting it
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->delete($this->getpdo());
  }

  /**
  * test inserting a Sport and regrabbing it from mysql
  **/
  public function testGetValidSportBySportId() {
    //count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new Sport and insert it into the db
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
    $this->assertEquals($pdoSport->getSportTeam(), $this->VALID_SPORTTEAM);
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
  }

  /**
  * test grabbing a sport that does not exist
  **/
  public function testGetInvalidSportBySportId() {
    // grab a sport id that exceeds the maximum allowable sport id
    $sport = Sport::getSportBySportId($this->getPDO(), SprotsTest::INVALID_KEY);
    $sport->assertNull($sport);
  }

  /**
  * test grabbing a Sport by the League
  **/
  public function testGetValidSportBySportLeague() {
    // count the number of rows, and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    //create a new sport and insert it into the db
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->insert($this-getPDO());

    //grab the data from the db and enforce the fields match our expectations
    $results = Sport::getSportBySportLeague($this->getPDO(), $sport->getSportLeague());
    $this->assertEquals($numrows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Public_html\\Php\\Classes\\Sport", $results);

    //grab the results from teh array and validate it
    $pdoSport = $results[0];
    $this->assertEquals($pdo->getSportId(), $this->sport->getSportId());
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
  }

  /**
  * test grabbing a Sport by the Name
  **/
  public function testGetValidSportBySportTeam() {
    // count the number of rows, and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new Sport and insert it into the db
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTTEAM, $this->VALID_SPORTLEAGUE);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $results = Sport::getSportBySportTeam($this->getPDO(), $sport->getSportTeam());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Public_html\\Php\\Classes\\Sport", $results);

    // grab the results from the array and validate it
    $pdoSport = $results[0];
    $this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
    $this->assertEquals($pdoSport->getSportTeam(), $this->VALID_SPORTTEAM);
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
  }

  /**
  * test grabbing a sport by a league that does not exist
  **/
  public function testGetInvalidSportBySportLeague() {
    // grab a sport id that exceeds the maximum allowable sport id
    $sport = Sport::getSportBySportLeague($this->getPDO(), "This League doesn't exist");
    $this->assertCount(0, $sport);
  }

  /**
  * test grabbing a sport by a team that does not exist
  **/
  public function testGetInvalidSportBySportTeam() {
    // grab a sport id that exceeds the maximum allowable sport id
    $sport = Sport::getSportBySportTeam($this->getPDO(), "This team doesn't exist");
    $this->assertCount(0, $sport);
  }

  /**
  * test grabbing all of the leagues
  **/
  public function testGetAllValidSportLeagues() {
    // count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new sport and insert it into the db
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTLEAGUE $this->VALID_SPORTTEAM);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $results = Sport::getAllSportLeagues($this->getPDO());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Public_html\\Php\\Classes\\Sport", $results);

    // grab the result from the array and validate it
    $pdoSport = $results[0];
    $this->assertEquals($pdoSport->getSportId(), $this->sport-getSportID());
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
    $this->assertEquals($pdoSport->getSportTeam(), $this->VALID_SPORTTEAM);
  }

  /**
  * Test grabbing all of Teams
  **/
  public function testGetAllValidSportTeams() {
    // count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new sport and insert it into the db
    $sport = new Sport(null, $this->sport->getSportId(), $this->VALID_SPORTLEAGUE $this->VALID_SPORTTEAM);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $results = Sport::getAllSportTeams($this->getPDO());
    $this->assertEquals($numrows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Public_html\\Php\\Classes\\Sport", $results);

    //grab the results from the array and validate it
    $pdoSport = $results[0];
    $this->assertEquals($pdoSport->getSportId(), $this->sport-getSportID());
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
    $this->assertEquals($pdoSport->getSportTeam(), $this->VALID_SPORTTEAM);
  }
}
