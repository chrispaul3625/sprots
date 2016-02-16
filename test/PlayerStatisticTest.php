<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{
	Game, Player, Sport, Statistic
};
use Edu\Cnm\Sprots\PlayerStatistic;


require_once("SprotsTest.php");

//grab the project test parameters
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the PlayerStatistic class
 *
 * This is a complete PHPUnit test of the PlayerStatistic class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see PlayerStatistic
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class PlayerStatisticTest extends SprotsTest {
	/**
	 * $playerStatisticGameId id for player in a specific game; this is a foreign key
	 * @var int $VALID_PLAYERSTATISTICGAMEID
	 **/
	protected $VALID_PLAYERSTATISTICGAMEID;
	/**
	 * $playerStatisticPlayerId id for players overall statistics, this is a foreign key
	 * @var int $VALID_PLAYERSTATISTICPLAYERID
	 **/
	protected $VALID_PLAYERSTATISTICPLAYERID;
	/**
	 * $playerStatisticStatisticId id for the players individual statistic, this is a foreign key
	 * @var int $VALID_PLAYERSTATISTICSTATISTICID
	 **/
	protected $VALID_PLAYERSTATISTICSTATISTICID;
	/**
	 * $playerStatisticValue the value of individual stats, number value for a stat
	 * @var int $VALID_PLAYERSTATISTICVALUE
	 **/
	protected $VALID_PLAYERSTATISTICVALUE;

	/**
	 * Sport that the Player is playing
	 * @var Sport $VALID_SPORT
	 */
	protected $sport = null;
	/**
	 * Game that PlayerStatistic derived from
	 * @var Game $VALID_GAME
	 */
	protected $game = null;
	/**
	 * Player that the Stat is associated with
	 * @var Player $VALID_PLAYER
	 */
	protected $player = null;
	/**
	 * Statistic that is associated with the player
	 * @var Statistic $VALID_STATISTIC
	 */
	protected $statistic = null;















}