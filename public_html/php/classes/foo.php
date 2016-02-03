<?php
namespace Edu\Cnm\Dcuneo1\sprots;

require_once("autoloader.php");
/**
 * Created by PhpStorm.
 * User: OldManVin
 * Date: 2/2/2016
 * Time: 1:09 PM
 */

/**
 * game is the record of what teams played  each other and the scores
 *
 * @author Dominic Cuneo < cueno94@gmail.com
 *
 */
class Game {
	/**
	 * id for gameid primary key
	 * @var int $gameId
	 */
	private $gameId;
	/**
	 * id for gameFirstTeamId
	 * var $gameFirstTeamId
	 */
	private $gameFirstTeamId;
	/**
	 * id for gameSecondId
	 * var $gameSecondId
	 */
	private $gameSecondId;
	/**
	 * id for gameTime
	 * var $gameTime
	 */
	private $gameTime;
}