<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * Player Statistics, This will be a player stat that is being pulled from APIs.
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class PlayerStatistic {
	/**
	 * $playerStatisticGameId id for player in a specific game; this is a foreign key
	 * @var int $playerStatisticGameId
	 **/
	private $playerStatisticGameId;
	/**
	 * $playerStatisticPlayerId id for players overall statistics, this is a foreign key
	 * @var int $playerStatisticPlayerId
	 **/
	private $playerStatisticPlayerId;
	/**
	 * $playerStatisticStatisticId id for the players individual statistic, this is a foreign key
	 * @var int $playerStatisticStatisticId
	 **/
	private $playerStatisticStatisticId;
	/**
	 * $playerStatisticValue the value of individual stats, number value for a stat
	 * @var int $playerStatisticValue
	 **/
	private $playerStatisticValue;

	/**
	 * Constructor for this players statistics
	 *
	 * @param int $newPlayerStatisticGameId id of game the player is in
	 * @param int $newPlayerStatisticPlayerId statistic id of the player
	 * @param int $newPlayerStatisticStatisticId name associated with team
	 * @param int $newPlayerStatisticValue Value of the statistic
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newPlayerStatisticGameId, int $newPlayerStatisticPlayerId, int $newPlayerStatisticStatisticId, int $newPlayerStatisticValue) {
		try {
			$this->setPlayerStatisticGameId($newPlayerStatisticGameId);
			$this->setPlayerStatisticPlayerId($newPlayerStatisticPlayerId);
			$this->setPlayerStatisticStatisticId($newPlayerStatisticStatisticId);
			$this->setPlayerStatisticValue($newPlayerStatisticValue);
		} catch(\InvalidArgumentException $InvalidArgument) {
			// Rethrow the exception to the caller
			throw(new \InvalidArgumentException($InvalidArgument->getmessage(), 0, $InvalidArgument));
		} catch(\RangeException $range) {
			// Rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		}
	}


	/**
	 * accessor method for Player Statistic Game Id
	 *
	 * @return int|null value of Player Statistic Game Id
	 **/
	public function getPlayerStatisticGameId() {
		return ($this->playerStatisticGameId);
	}

	/**
	 * mutator method for PlayerStatisticGameId
	 *
	 * @param int|null $newPlayerStatisticGameId new value of Player Statistic Game Id
	 * @throws \RangeException if the $newPlayerStatisticGameId is not positive
	 * @throws \TypeError if $newPlayerStatisticGameId is not an integer
	 **/
	public function setPlayerStatisticGameId(int $newPlayerStatisticGameId) {
		if($newPlayerStatisticGameId === null) {
			$this->playerStatisticGameId = null;
			return;
		}
// Verify the PlayerStatisticGameId is positive
		if($newPlayerStatisticGameId <= 0) {
			throw(new \RangeException("PlayerStatisticGameId is not positive"));
		}
// Convert and store the PlayerStatisticGameId
		$this->playerStatisticGameId = $newPlayerStatisticGameId;
	}

	/**
	 *accessor method for Player Statistic Player Id
	 *
	 * @return int|null value of Player Statistic Player Id
	 **/
	public function getPlayerStatisticPlayerId() {
		return ($this->playerStatisticPlayerId);
	}

	/**
	 * mutator method for Player Statistic Player Id
	 *
	 * @param int|null $newPlayerStatisticPlayerId new value of Player Statistic Player Id
	 * @throws \RangeException if the $newPlayerStatisticPlayerId is not positive
	 * @throws \TypeError if $newPlayerStatisticPlayerId is not an integer
	 **/
	public function setPlayerStatisticPlayerId(int $newPlayerStatisticPlayerId = null) {
		// base case: if PlayerStatisticPlayerId is null, this is a new player statistic player id without a MySQL assigned id (yet)
		if($newPlayerStatisticPlayerId === null) {
			$this->playerStatisticPlayerId = null;
			return;
		}
// Verify the Player Statistic Player Id is positive
		if($newPlayerStatisticPlayerId <= 0) {
			throw(new \RangeException("Player Statistic Player Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->playerStatisticPlayerId = $newPlayerStatisticPlayerId;
	}

	/**
	 * accessor method for Player Statistic Statistic Id
	 *
	 * @return int|null value of Player Statistic Statistic Id
	 **/
	public function getPlayerStatisticStatisticId() {
		return ($this->playerStatisticStatisticId);
	}

	/**
	 * mutator method for Player Statistic Statistic Id
	 *
	 * @param int|null $newPlayerStatisticStatisticId new value of Player Statistic Statistic Id
	 * @throws \InvalidArgumentException if $newPlayerStatisticStatisticId is not a string or insecure
	 * @throws \RangeException if $newPlayerStatisticStatisticId is >32 characters
	 * @throws \TypeError if $newPlayerStatisticStatisticId is not an integer
	 **/
	public function setPlayerStatisticStatisticId(int $newPlayerStatisticStatisticId) {
		//verify the Player Statistic Statistic Id is secure
		$newPlayerStatisticStatisticId = trim($newPlayerStatisticStatisticId);
		$newPlayerStatisticStatisticId = filter_var($newPlayerStatisticStatisticId);
		if(empty($newPlayerStatisticStatisticId) === true) {
			throw(new \InvalidArgumentException("Player Statistic Statistic Id is empty or insecure"));
		}
//verify the Player Statistic Statistic Id will fit in the database
		if(strlen($newPlayerStatisticStatisticId) > 32) {
			throw(new \RangeException("Player Statistic Statistic Id is too large"));
		}
// store the new Player Statistic Statistic Id
		$this->$newPlayerStatisticStatisticId = $newPlayerStatisticStatisticId;
	}

	/**
	 * accessor method for Player Statistic Value
	 *
	 * @return int value of Player Statistic Value
	 **/

	public function getPlayerStatisticValue() {
		return ($this->playerStatisticValue);
	}

	/**
	 * mutator method for Player Statistic Value
	 *
	 * @param int $newPlayerStatisticValue value of statistic
	 * @throws \InvalidArgumentException if $newPlayerStatisticValue is not an integer or insecure
	 * @throws \RangeException if $newPlayerStatisticValue is >32 characters
	 * @throws \TypeError if $newPlayerStatisticValue is not an integer
	 **/

	public function setPlayerStatisticValue(int $newPlayerStatisticValue) {
		//verify the Player Statistic Value is secure
		$newPlayerStatisticValue = trim($newPlayerStatisticValue);
		$newPlayerStatisticValue = filter_var($newPlayerStatisticValue);
		if(empty($newPlayerStatisticValue) === true) {
			throw(new \InvalidArgumentException("Player Statistic Value is empty or insecure"));
		}
//verify the Player Statistic Value will fit in the database
		if(strlen($newPlayerStatisticValue) > 32) {
			throw(new \RangeException("Player Statistic Value is too large"));
		}
// store the new Player Statistic Value
		$this->$newPlayerStatisticValue = $newPlayerStatisticValue;
	}

	/**
	 * Inserts this player statistics into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo) {
		// enforce the player statistic game id, the player statistic player id, and the player statistic statistic id is exists
		if($this->playerStatisticGameId === null || $this->playerStatisticPlayerId === null || $this->playerStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist"));
		}
		// Create query template
		$query = "INSERT INTO playerStatistic(playerStatisticGameId, playerStatisticPlayerId, playerStatisticStatisticId, playerStatisticValue) VALUES(:playerStatisticGameId, :playerStatisticPlayerId, :playerStatisticStatisticId, :playerStatisticValue)";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["playerStatisticGameId" => $this->playerStatisticGameId, "playerStatisticPlayerId" => $this->playerStatisticPlayerId, "playerStatisticStatisticId" => $this->playerStatisticStatisticId, "playerStatisticValue" => $this->playerStatisticValue];
		$statement->execute($parameters);
	}

	/**
	 * Deletes this statistics from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo) {
		//enforce the Ids are not null
		if($this->playerStatisticGameId === null || $this->playerStatisticPlayerId === null || $this->playerStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist to delete"));
		}
		// Create query template
		$query = "DELETE FROM playerStatistic WHERE playerStatisticGameId | playerStatisticPlayerId | playerStatisticStatisticId | playerStatisticValue = playerStatisticGameId | playerStatisticPlayerId | playerStatisticStatisticId | playerStatisticValue";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["playerStatisticGameId" => $this->playerStatisticGameId, "playerStatisticPlayerId" => $this->playerStatisticPlayerId, "playerStatisticStatisticId" => $this->playerStatisticStatisticId, "playerStatisticValue" => $this->playerStatisticValue];
		$statement->execute($parameters);
	}

	/**
	 * updates this Player Statistics in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function update(\PDO $pdo) {
		//enforce the Ids are not null
		if($this->playerStatisticGameId === null || $this->playerStatisticPlayerId === null || $this->playerStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist to update"));
		}
		// Create query template
		$query = "UPDATE playerStatistic SET playerStatisticGameId = :playerStatisticGameId, playerStatisticPlayerId = :playerStatisticPlayerId, playerStatisticStatisticId = :playerStatisticStatisticId, playerStatisticValue = :playerStatisticValue";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["playerStatisticGameId" => $this->playerStatisticGameId, "playerStatisticPlayerId" => $this->playerStatisticPlayerId, "playerStatisticStatisticId" => $this->playerStatisticStatisticId, "playerStatisticValue" => $this->playerStatisticValue];
		$statement->execute($parameters);
	}

	/**
	 * gets the TeamStatistic by playerStatisticGameId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $playerStatisticGameId player statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of player statistic game ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPlayerStatisticByPlayerStatisticGameId(\PDO $pdo, int $playerStatisticGameId) {
// sanitize the description before searching
		$playerStatisticGameId = trim($playerStatisticGameId);
		$playerStatisticGameId = filter_var($playerStatisticGameId, FILTER_SANITIZE_STRING);
		if(empty($playerStatisticGameId) === true) {
			throw(new \PDOException("player Statistic Game Id is invalid"));
		}

		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticGameId LIKE :playerStatisticGameId";
		$statement = $pdo->prepare($query);


		// bind the player Statistic Game Id to the place holder in the template
		$playerStatisticGameId = "%$playerStatisticGameId";
		$parameters = array("playerStatisticGameId" => $playerStatisticGameId);
		$statement->execute($parameters);

		// build an array of player statistic player id
		$playerStatisticGameId = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		While(($row = $statement->fetch()) !== false) {
			try {
				$playerStatisticGameId = new $playerStatisticGameId($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
				$playerStatisticGameId[$playerStatisticGameId->key()] = $playerStatisticGameId;
			} catch(\Exception $exception){
			}
		}

		// Grab the player Statistic Game Id from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new Playerstatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($playerStatistic);
	}


	/**
	 * gets the TeamStatistic by playerStatisticPlayerId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $playerStatisticPlayerId player statistic player id to search for
	 * @return \SplFixedArray SplFixedArray of player statistic player ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPlayerStatisticByPlayerStatisticPlayerId(\PDO $pdo, int $playerStatisticPlayerId) {
// sanitize the description before searching
		$playerStatisticPlayerId = trim($playerStatisticPlayerId);
		$playerStatisticPlayerId = filter_var($playerStatisticPlayerId, FILTER_SANITIZE_STRING);
		if(empty($playerStatisticPlayerId) === true) {
			throw(new \PDOException("player Statistic Player Id is invalid"));
		}

		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticPlayerId LIKE :playerStatisticPlayerId";
		$statement = $pdo->prepare($query);

// build an array of player statistic player id
		$playerStatisticPlayerId = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		While(($row = $statement->fetch()) !== false) {
			try {
				$playerStatisticPlayerId = new $playerStatisticPlayerId($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
				$playerStatisticPlayerId[$playerStatisticPlayerId->key()] = $playerStatisticPlayerId;
			} catch(\Exception $exception){
			}
		}

		// bind the player Statistic Player Id to the place holder in the template
		$playerStatisticPlayerId = "%$playerStatisticPlayerId";
		$parameters = array("playerStatisticPlayerId" => $playerStatisticPlayerId);
		$statement->execute($parameters);

		// Grab the player Statistic Player Id from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new Playerstatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($playerStatistic);
	}


	/**
	 * gets the PlayerStatistic by playerStatisticStatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $playerStatisticStatisticId player statistic statistic id to search for
	 * @return \SplFixedArray SplFixedArray of player statistic statistic ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPlayerStatisticByPlayerStatisticStatisticId(\PDO $pdo, int $playerStatisticStatisticId) {
		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticStatisticId LIKE :playerStatisticStatisticId";
		$statement = $pdo->prepare($query);


		// bind the player Statistic Statistic Id to the place holder in the template
		$playerStatisticStatisticId = "%$playerStatisticStatisticId";
		$parameters = array("playerStatisticStatisticId" => $playerStatisticStatisticId);
		$statement->execute($parameters);

		// build an array of player statistic id
		$playerStatisticStatisticId = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		While(($row = $statement->fetch()) !== false) {
			try {
				$playerStatisticStatisticId = new $playerStatisticStatisticId($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
				$playerStatisticStatisticId[$playerStatisticStatisticId->key()] = $playerStatisticStatisticId;
			} catch(\Exception $exception){
		}
	}
		// Grab the player Statistic Statistic Id from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new Playerstatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($playerStatistic);
	}


	/**
	 * gets the TeamStatistic by playerStatisticValue
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $playerStatisticStatisticValue player statistic value  to search for
	 * @return \SplFixedArray SplFixedArray of player statistic value found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPlayerStatisticByPlayerStatisticStatisticValue(\PDO $pdo, int $playerStatisticStatisticValue) {

		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticValue LIKE :playerStatisticStatisticValue";
		$statement = $pdo->prepare($query);


		// bind the player Statistic Statistic Value to the place holder in the template
		$playerStatisticStatisticValue = "%$playerStatisticStatisticValue";
		$parameters = array("playerStatisticStatisticValue" => $playerStatisticStatisticValue);
		$statement->execute($parameters);

		// build an array of player statistic id
		$playerStatisticStatisticValue = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		While(($row = $statement->fetch()) !== false) {
			try {
				$playerStatisticStatisticValue = new $playerStatisticStatisticValue($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
				$playerStatisticStatisticValue[$playerStatisticStatisticValue->key()] = $playerStatisticStatisticValue;
			} catch(\Exception $exception){
			}
		}
		// Grab the player Statistic Statistic Id from mySQL
		try {
			$playerStatistic= null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new playerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($playerStatistic);
	}

	/**
	 * gets all PlayerStatistics
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of PlayerStatistics found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAllPlayerStatistics(\PDO $pdo) {
		//create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of Player Statistics
		$playerStatistic = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$playerStatistic = new PlayerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
				$playerStatistic[$playerStatistic->key()] = $playerStatistic;
				$playerStatistic->next();
			} Catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($playerStatistic);
	}





}