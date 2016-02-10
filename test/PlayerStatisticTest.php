<?php
namespace Edu\Cnm\Sprots;

use Edu\Cnm\Sprots;{Game; Player; Statistic;};

//grab the project test parameters
require_once ((__DIR__) . "/php/classes/autoload.php");

/**
 * Full PHPUnit test for the PlayerStatistic class
 *
 * This is a complete PHPUnit test of the PlayerStatistic class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see PlayerStatistic
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class PlayerStatisticTest extends DataDesignTest {
	/**
	 * Id of the PlayerStatisticGameId
	 * @var int $VALID_PLAYERSTATISTICGAMEID
	 **/
	protected $VALID_PLAYERSTATISTICGAMEID = "PHPUnit test passing";
	/**
	 * Id of the PlayerStatisticPlayerId
	 * @var string $VALID_PLAYERSTATISTICPLAYERID
	 **/
	protected $VALID_PLAYERSTATISTICPLAYERID = "PHPUnit test still passing";
	/**
	 * Id of PlayerStatisticStatisticId
	 * @var int $VALID_PLAYERSTATISTICSTATISTICID
	 **/
	protected $VALID_PLAYERSTATISTICSTATISTICID = "PHPUnit test still passing";

}
