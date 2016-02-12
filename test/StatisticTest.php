<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{Statistic};

// grab the project test parameters
require_once("SprotsTest.php");
//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full phpUnit test for statistic class
 * This is a complete phpunit test for the statistic class. It is complete because all my SQL/PDO enabled methods
 * are tested fro both invalid and valid inputs
 *
 * @see Statistic
 * @Dominic Cuneo <cuneo94@gmail.com
 */
class StatisticTest extends Statistic {
	/**
	 * content of Statistic
	 * @var string $valid_statistic
	 */
	protected $VALID_STATISTIC = "PHPUnit test passing";
	/**
	 * content of the updated Statistic
	 * @var string $VALID_STATISTIC2
	 */
	protected $VALID_STATISTIC2 = "PHPUnit test still passing";

/**
 * test inserting a valid Statistic and verify that the actual mySQL data matches
 */
	public function testInsertValidStatistic(){
		//count the number of rows and save
		$numRows = $this->getConnection()->getRowCount("statistic");

		//create a new statistic and insert into mySQL
		$statistic = new Statistic(null, $this->statistic->getStatisticId(), $this->VALID_STATISTIC, $this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match expectations
		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic-getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowcount("statistic"));
		$this->assertEquals($pdoStatistic->getStatistic(), $this->VALID_STATISTIC);
	}
	/**
	 * test inserting statistic editing and update
	 */
	public function testUpdateValidStatistic(){
		//count the number of rows and save
		$numRows = $this->getConnection()->getRowCount("statistic");
		//create a new Statistic and insert into mySQL
		$statistic = new Statistic(null,$this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());

		//edit statistic and update in mySQL
		$statistic->setStatistic($this->VALID_STATISTIC2);
		$statistic->update($this->getPDO());
		//grab the data from mySQL and enforce the fields match expectations
		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic-getStatisticId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowcount("statistic"));
		$this->assertEquals($pdoStatistic->getStatistic(), $this->VALID_STATISTIC);
	}
	/**
	 * test updating a statistic that already exists
	 */
	public function testUpdateInvalidStatistic(){
		//create a Statistic with a non null tweet id and watch it fail
		$statistic = new Statistic(null, $this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());
	}
	/**
	 * test crating a Statistic and deleting it
	 */
	public function testDeleteValidStatistic(){
		//count the number of rows and save
		$numRows = $this->getConnection()->getRowCount("statistic");
		//create a new statistic adn insert into mySQL
		$statistic = new Statistic(null, $this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());
		//delete from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("statistic"));
		$statistic->delete($this->getPDO());
		//grab data from mySQL adn enforce statistic does not exist
		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic->getStatisticId());
		$this->assertNull($pdoStatistic);
		$this->assertEquals($numRows, $this->getConneection()->getRowCount("statistic"));
	}
	/**
	 * test deleting a Statistic that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testGetValidStatisticByStatisticId(){
		//count the number of rows and save
		$numRows = $this->getConnections()->getRowCount("statistic");
		//create a new Statistic adn insert into mySQL
		$statistic = new Statistic(null, $this->VALID_STATISTIC);
		$this->insert($this->getPDO());
		//grab data from mySQL and enforce  the fields to expectations

		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic->getStatisticId());
		$this->assertsEquals($numRows + 1, $this->getConnection()->getRowCount("statistic"));
		$this->assertsEquals($pdoStatistic->getStatistic(), $this->VALID_STATISTIC);
	}
	/**
	 * test grab all statistic
	 */
	public function testGetAllValidStatistic() {
		//count the numbers of rows and save
		$numRows = $this->getConnection()->getRowCount("statistic");

		//create a new Game and insert into mySql
		$game = new Game(null, $this->statistic->statisticId(), $this->VALID_STATISTIC);
		$game->insert($this->getPDO());

		//grab the dat from mySQL and enforce the fields match
		$results = Game::getAllStatistic($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount('statistic'));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dcuneo1\\Sprots\\Statistic", $results);
	}
}