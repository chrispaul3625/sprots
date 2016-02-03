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
	 * id for gameId primary key
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
	 * var $gameTimeDate
	 */
	private $gameTime;
	/**
	 * constructor fo Game
	 *
	 * @param int|null $newGameId id of this Game or null if a new Tweet
	 * @param int $newGameId for the last game played for a sport
	 * @param int $newGameFirstTeamId id for the first team in a game
	 * @param int $newGameSecondTeamId id  fo the second team in a game
	 * @param \DateTime|string|null $newGameDate date and time for when game was played
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values exceed limits
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function  __construct(int $newGameId = null, int $newGameFirstTeamId, $newGameSecondTeamId, $newGameTimeDate = null) {
		try{
			$this->setgameId($newGameId);
			$this->setgameFirstTeamId($newGameFirstTeamId);
			$this->setgameSecondId($newGameSecondTeamId);
			$this->setGameTimeDate($newGameTimeDate);
		}catch(\InvalidArgumentException $invalidArgument){
			//rethrow the exception to caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		}catch(\RangeException $range){
			// rethrow
			throw(new \RangeException($range->getMessage(), 0, $range));
		}catch(\TypeError $typeError){
			// rethrow
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		}catch (\Exception $exception){
			// rethrow
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for game id
	 *
	 * @return int|null value for game id
	 */
	public function getGameId() {
		return $this->gameId;
	}
	/**
	 * mutator method for game id
	 *
	 * @param int|null $newGameId new value for game id
	 * @throws \RangeException if $newGameId id not positive
	 * @throws \TypeError if $newGameId is not an integer
	 */
	public function setGameId(int $newGameId = null){
		// base case: if game id is null this is a new game without a mySQL assigned id yet
		if($newGameId === null){
			$this->gameId = null;
			return;
		}
		// verify the game id is positive
		if($newGameId <= 0){
			throw(new \RangeException("game id is not positive"));
		}
		// convert and store game id
		$this->gameId = $newGameId;
	}
}