<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\Sport;

// grab the project test parameters
require_once("SprotsTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
* Full PHPUnit test for the Sport class
*
*This is a complete PHPUnit test for the Sport class. It is complete, becasue *ALL* mySQL/pdo enabled methods
* are tested for both invalid, and valid inputs.
*
* @see Sport
* @author Dom Kratos <mr.kratos85@gmail.com>
**/
class SportTest extends SprotsTest {
  /**
  * content for sport league
  * @var string $VALID_SPORTLEAGUE
  **/
  protected $VALID_SPORTLEAGUE = "NFL";
  /**
  * content of the updated sport league
  * @var string $VALID_SPORTLEAGUE2
  **/
  protected $VALID_SPORTLEAGUE2 = "NBA";
  /**
  * content for sport league
  * @var string $VALID_SPORTNAME
  **/
  protected $VALID_SPORTNAME = "Dallas Cowboys";
  /**
  * content of the updated sport league
  * @var string $VALID_SPORTNAME2
  **/
  protected $VALID_SPORTNAME2 = "Houston Rockets";

  /**
  * test inserting a valid sport name into mysql
  **/
  public function testInsertValidSport() {
    //count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");


    // create a new sport and insert into the db
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->insert($this->getPDO());
    // var_dump($sport);

    // grab the data from MySQL and enforce the fields match our expectations
    $pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
    // var_dump($pdoSport);
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
    $this->assertEquals($pdoSport->getSportName(), $this->VALID_SPORTNAME);
  }

  /**
  * test inserting a Sport that already exists
  *
  * @expectedException PDOException
  **/
  public function testInsertInvalidSport() {
    // create a sport with a non null sport id and watch it fail
    $sport = new Sport(SprotsTest::INVALID_KEY, $this->VALID_SPORTNAME, $this->VALID_SPORTLEAGUE);
    $sport->insert($this->getPDO());
  }

  /**
  * test inserting a sport, editing it, and then updating it.
  **/
  public function testUpdateValidSport() {
    //count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new sport and update it in the db
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->insert($this->getPDO());
    // var_dump($sport);

    // edit the sport and update it in mysql
    $sport->setSportLeague($this->VALID_SPORTLEAGUE2);
    $sport->setSportName($this->VALID_SPORTNAME2);
    $sport->update($this->getPDO());

    //grab the data from mysql and enforce the fields match our expectations
    $pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    //$this->assertEquals($pdoSport->getSportId(), $this->sport->getSportId());
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE2);
    $this->assertEquals($pdoSport->getSportName(), $this->VALID_SPORTNAME2);
  }
  /**
  * test updating a sport that already exists
  *
  * @expectedException PDOException
  **/
  public function testUpdateInvalidSport() {
    // create a sport with a non null sport id and watch it fail
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->update($this->getPDO());
  }

  /**
  * test creating a Sport and then deleting it
  **/
  public function testDeleteValidSport() {
    // count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new Sport and insert it into mysql
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
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
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->delete($this->getpdo());
  }

  /**
  * test inserting a Sport and regrabbing it from mysql
  **/
  public function testGetValidSportBySportId() {
    //count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new Sport and insert it into the db
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $pdoSport = Sport::getSportBySportId($this->getPDO(), $sport->getSportId());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
    $this->assertEquals($pdoSport->getSportName(), $this->VALID_SPORTNAME);
  }

  /**
  * test grabbing a sport that does not exist
  **/
  public function testGetInvalidSportBySportId() {
    // grab a sport id that exceeds the maximum allowable sport id
    $sport = Sport::getSportBySportId($this->getPDO(), SprotsTest::INVALID_KEY);
    $this->assertNull($sport);
  }

  /**
  * test grabbing a Sport by the League
  **/
  public function testGetValidSportBySportLeague() {
    // count the number of rows, and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    //create a new sport and insert it into the db
    $sportLeague = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sportLeague->insert($this->getPDO());

    //grab the data from the db and enforce the fields match our expectations
    $results = Sport::getSportBySportLeague($this->getPDO(), $sportLeague->getSportLeague());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Sport", $results);

    //grab the results from teh array and validate it
    $pdoSportLeague = $results[0];
    $this->assertEquals($pdoSportLeague->getSportLeague(), $this->VALID_SPORTLEAGUE);
  }

  /**
  * test grabbing a sport by a league that does not exist
  **/
  public function testGetInvalidSportBySportLeague() {
     // grab a  id that exceeds the maximum allowable sport id
     $sportLeague = Sport::getSportBySportLeague($this->getPDO(), "This League doesn't exist");
     //var_dump($sportLeague);
     $this->assertNull($sportLeague);
  }

  /**
  * test grabbing all of the leagues
  **/
  public function testGetAllValidSportLeagues() {
    // count the number of rows and save it for later
     $numRows = $this->getConnection()->getRowCount("sport");

    // create a new sport and insert it into the db
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $results = Sport::getAllSportLeagues($this->getPDO());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Sport", $results);

    // grab the result from the array and validate it
    $pdoSport = $results[0];
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
    $this->assertEquals($pdoSport->getSportName(), $this->VALID_SPORTNAME);
  }

  /**
  * test grabbing a Sport by the Name
  **/
  public function testGetValidSportBySportName() {
    // count the number of rows, and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new Sport and insert it into the db
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $results = Sport::getSportBySportName($this->getPDO(), $sport->getSportName());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Sport", $results);

    // grab the results from the array and validate it
    $pdoSport = $results[0];
    $this->assertEquals($pdoSport->getSportLeague(), $this->VALID_SPORTLEAGUE);
    $this->assertEquals($pdoSport->getSportName(), $this->VALID_SPORTNAME);
  }


  /**
  * test grabbing a sport by a name that does not exist
  **/
  public function testGetInvalidSportBySportName() {
    // grab a sport id that exceeds the maximum allowable sport id
    $sport = Sport::getSportBySportName($this->getPDO(), "This name doesn't exist");
    //$this->assertCount(0, $sport);
    $this->assertNull($sport);
  }


  /**
  * Test grabbing all of Names
  **/
  public function testGetAllValidSportNames() {
    // count the number of rows and save it for later
    $numRows = $this->getConnection()->getRowCount("sport");

    // create a new sport and insert it into the db
    $sport = new Sport(null, $this->VALID_SPORTLEAGUE, $this->VALID_SPORTNAME);
    $sport->insert($this->getPDO());

    // grab the data from the db and enforce the fields match our expectations
    $results = Sport::getAllSportNames($this->getPDO());
    $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("sport"));
    $this->assertCount(1, $results);
    $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\Sport", $results);

    //grab the results from the array and validate it
    $pdoSport = $results[0];
    $this->assertEquals($pdoSport->getSportName(), $this->VALID_SPORTNAME);
  }
}
