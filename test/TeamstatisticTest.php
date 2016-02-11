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


	}
}