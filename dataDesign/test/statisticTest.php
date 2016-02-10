<?php
namespace Edu\Cnm\Sprots;

use Edu\Cnm\Sprots\{statistic};

// grab the project test parameters
require_once("phpUnitConfig.php");
//grab the class under scrutiny
require_once(dirname(__Statistic__) . "/php/classes/autoload.php");

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
	 * create dependent objects before running tests
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();
		// create and insert a Statistic to own the test
		$this->statistic = new Statistic(null, "@phpunit", "test@phpunit.de",
			"+12125551212");
		$this->statistic->insert($this->getPDO());
	}
/**
 * test inserting a valid Statistic and verify that the actual mySQL data matches
 */
	public function testInsertValidStatistic(){
		//count the number of rows and save
		$numRows = $this->getConnection()->getRowCount("statistic");
		//create a new statistic and insert into mySQL
		$statistic = new Statistic(null, $this->statistic->getStatisticId(), $this->VALID_STATISTIC, $this->VALID_STATISTIC);
		$statistic->insert($this->getPDO());
		//grab the data frim mySQL and enforce the fields match expectations
		$pdoStatistic = Statistic::getStatisticByStatisticId($this->getPDO(), $statistic-getStatisticId());
		$this->assertEquals($pdoStatistic->getSatisticId(),$this->statistic-get)

	}
}