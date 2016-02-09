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
class StatisticTest extends DataDesign{
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
}