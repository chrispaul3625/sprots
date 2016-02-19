<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");
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
	use ValidateDate;
	/**
	 * id for gameId primary key
	 * @var int $gameId
	 */
	private $gameId;
	/**
	 * id for gameFirstTeamId
	 * @var int $gameFirstTeamId
	 */
	private $gameFirstTeamId;
	/**
	 * id for gameSecondId
	 * @var int $gameSecondId
	 */
	private $gameSecondTeamId;
	/**
	 * id for gameTime
	 * @var  \DateTime $newGameTime
	 */
	private $gameTime;

	/**
	 * constructor fo Game
	 *
	 * @param int|null $newGameId id of this Game or null if a new Tweet
	 * @param int $newGameId for the last game played for a sport
	 * @param int $newGameFirstTeamId id for the first team in a game
	 * @param int $newGameSecondTeamId id  fo the second team in a game
	 * @param \DateTime|null $newGameTime date and time for when game was played
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values exceed limits
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newGameId = null, int $newGameFirstTeamId, int $newGameSecondTeamId, $newGameTime = null) {
		try {
			$this->setgameId($newGameId);
			$this->setgameFirstTeamId($newGameFirstTeamId);
			$this->setgameSecondTeamId($newGameSecondTeamId);
			$this->setgameTime($newGameTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
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
	public function setGameId(int $newGameId = null) {
		// base case: if game id is null this is a new game without a mySQL assigned id yet
		if($newGameId === null) {
			$this->gameId = null;
			return;
		}
		// verify the game id is positive
		if($newGameId <= 0) {
			throw(new \RangeException("game id is not positive"));
		}
		// convert and store game id
		$this->gameId = $newGameId;
	}

	/**
	 * accessor for GameFirstTeamId
	 *
	 * @return int value of game id
	 */
	public function getGameFirstTeamId() {
		return $this->gameFirstTeamId;
	}

	/**
	 * mutator method or GameFirstTeamId
	 *
	 * @param int $newGameFirstTeamId is new value of GameFirstTeamId
	 * @throws \RangeException if $newGameFirstTeamId id not positive
	 * @throws \TypeError if $newGameFirstTeamId in not an integer
	 */
	public function setGameFirstTeamId(int $newGameFirstTeamId) {
		//verify firstGameTeamId is positive
		if($newGameFirstTeamId <= 0) {
			throw(new \RangeException("GameFirstTeamId is not positive"));
		}
		//convert and save
		$this->gameFirstTeamId = $newGameFirstTeamId;
	}

	/**
	 * accessor method for gameSecondTeamId
	 *
	 * @return int|null value of gameSecondTeamId
	 */
	public function getGameSecondTeamId() {
		return ($this->gameSecondTeamId);
	}

	/**
	 * mutator method for gameSecondTeamId id
	 *
	 * @param int|null $newGameSecondTeamId new value of tweet id
	 * @throws \RangeException if $newGameSecondTeamId is not positive
	 * @throws \TypeError if $newGameSecondTeamId is not an integer
	 **/
	public function setGameSecondTeamId(int $newGameSecondTeamId = null) {
		// base case if gameSecondTeamId id is null this is a $new game
		if($newGameSecondTeamId === null) {
			$this->gameSecondTeamId = null;
			return;
		}
		//verify newGameSecondTeamId is positive
		if($newGameSecondTeamId <= 0) {
			throw(new \RangeException("GameSecondTeamId is not positive"));
		}
		//convert and save
		$this->gameSecondTeamId = $newGameSecondTeamId;
	}

	/**
	 * accessor for gameTime
	 *
	 * @return \DateTime value of  game
	 */
	public function getGameTime() {
		return $this->gameTime;
	}

	/**
	 * mutator method for gametime
	 * @param \DateTime|string|null $newGameTime
	 * @throws \InvalidArgumentException if $newGameTime
	 * @throws \RangeException if $newGameTime is nor a valid object or string
	 */
	public function setGameTime($newGameTime) {
		//base case if date is null use current date time
		if($newGameTime === null) {
			$this->newGameTime = new \DateTime();
			return;
		}
		//store game data
		try {
			$newGameTime = $this->validateDate($newGameTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->gameTime = $newGameTime;
	}

	/**
	 * inserts this Game into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the gameId is null
		if($this->gameId !== null) {
			throw(new \PDOException("not a new game"));
		}
		//query template
		$query = "INSERT INTO game(gameFirstTeamId, gameSecondTeamId, gameTime) VALUES(:gameFirstTeamId, :gameSecondTeamId, :gameTime)";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holder
		$formattedDate = $this->gameTime->format("Y-m-d H:i:s");
		$parameters = ["gameFirstTeamId" => $this->gameFirstTeamId, "gameSecondTeamId" => $this->gameSecondTeamId, "gameTime" => $formattedDate];
		$statement->execute($parameters);
		//update the null gameid with mySQL
		$this->gameId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this Game from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the tweetId is not null (
		if($this->gameId === null) {
			throw(new \PDOException("unable to delete a game that does not exist"));
		}
		// query template
		$query = "DELETE FROM game WHERE gameId = :gameId";
		$statement = $pdo->prepare($query);
		//bind member variables to the place holder
		$parameters = ["gameId" => $this->gameId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Game in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the gameId is not null
		if($this->gameId === null) {
			throw(new \PDOException("unable to update a game that does not exist"));
		}
		//query template
		$query = "UPDATE game SET gameTime = :gameTime ";
		$statement = $pdo->prepare($query);
		//bind the member variable to the place holders
		$formattedDate = $this->gameTime->format("Y-m-d H:i:s");
		$parameters  = ["gameTime" => $formattedDate];
		$statement->execute($parameters);
	}
	/**
	 * gets the Game by gameId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $gameId game id to search for
	 * @return Game|null Game found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getGameByGameId(\PDO $pdo, int $gameId){
	// sanitize the gameId before searching
		if($gameId <=0){
			throw(new \PDOException("game id is not positive"));
		}

		//create query template
		$query = "SELECT gameId, gameFirstTeamId, gameSecondTeamId, gameTime FROM game WHERE gameId = :gameId";
		$statement = $pdo->prepare($query);

		// bind the game id to the player holder in the template
		$parameters = array("gameId"=> $gameId);
		$statement->execute($parameters);

		//grab the game form mySQL
		try {
			$game = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$game = new Game($row["gameId"], $row["gameFirstTeamId"], $row["gameSecondTeamId"], $row["gameTime"]);
			}
		}catch
		(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($game);
	}
	/**
	 * gets the Game by gameFirstId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \int gameFirstTeamId Game  id to search for
	 * @return Game|null Game found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getGameByGameFirstTeamId (\PDO $pdo, int $gameFirstTeamId) {
		// sanitize the teamApiId before searching
		if($gameFirstTeamId <= 0) {
			throw(new \PDOException("gameFirstTeam Id is not positive"));
		}
		// Create query template
		$query = "SELECT gameId, gameFirstTeamId, gameSecondTeamId, gameTime FROM game ";
		$statement = $pdo->prepare($query);

		// Bind the game id to the place holder in the template
		$parameters = array("gameFirstTeamId" => $gameFirstTeamId);
		$statement->execute($parameters);

		// Grab the game from mySQL
		try {
			$game = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$game = new Game($row["gameId"], $row["gameFirstTeamId"], $row["gameSecondTeamId"], $row["gameTime"]);
			}
		}catch
		(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($game);
	}
	/**
	 * gets the Game by GameSecondTeamId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $gameSecondTeamId gameSecondTeam id to search for
	 * @return Game|null Game found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getGameByGameSecondTeamId(\PDO $pdo, int $gameSecondTeamId){
		// sanitize the gameId before searching
		if($gameSecondTeamId <=0){
			throw(new \PDOException("GameSecondTeam Id is not positive"));
		}

		//create query template
		$query = "SELECT gameId, gameFirstTeamId, gameSecondTeamId, gameTime FROM game WHERE gameId = :gameId";
		$statement = $pdo->prepare($query);

		// bind the game id to the player holder in the template
		$parameters = array("gameId"=> $gameSecondTeamId);
		$statement->execute($parameters);

		//grab the game form mySQL
		try {
			$game = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$game = new Game($row["gameId"], $row["gameFirstTeamId"], $row["gameSecondTeamId"], $row["gameTime"]);
			}
		}catch
		(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($game);
	}
	/**
	 * gets the Game by GameTime
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \DateTime $gameTime game time to search for
	 * @return Game|null Game found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getGameByGameTime(\PDO $pdo, $gameTime){
		// sanitize the gameId before searching
		if($gameTime <=0){
			throw(new \PDOException("GameSecondTeam Id is not positive"));
		}

		//create query template
		$query = "SELECT gameId, gameFirstTeamId, gameSecondTeamId, gameTime FROM game WHERE gameId = :gameId";
		$statement = $pdo->prepare($query);

		// bind the game id to the player holder in the template
		$parameters = array("gameId"=>  $gameTime);
		$statement->execute($parameters);

		//grab the game form mySQL
		try {
			$game = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$game = new Game($row["gameId"], $row["gameFirstTeamId"], $row["gameSecondTeamId"], $row["gameTime"]);
			}
		}catch
		(\Exception $exception){
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($game);
	}
	/**
	 * gets all Game
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Game found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllGame(\PDO $pdo){
		//create query template
		$query = "SELECT gameId, gameFirstTeamId, gameSecondTeamId, gameTime FROM game ";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of game
		$games =new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$game = new Game($row["gameId"], $row["gameFirstTeamId"], $row["gameSecondTeamId"], $row["gameTime"]);
				$games[$games->key()] = $game;
				$games->next();
			}catch(\Exception $exception){
				// if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($games);
	}
}
