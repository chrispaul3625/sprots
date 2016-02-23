<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * Player Statistics, This will be a player stat that is being pulled from APIs.
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class PlayerStatistic {

	use ValidateDate;
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
	 * $playerStatisticTeamId id for players statistic to team , this is a foreign key
	 * @var int $playerStatisticTeamId
	 **/
	private $playerStatisticTeamId;
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
	 * @param int $newPlayerStatisticTeamId statistic id of the player referencing team
	 * @param int $newPlayerStatisticStatisticId name associated with team
	 * @param int $newPlayerStatisticValue Value of the statistic
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newPlayerStatisticGameId, int $newPlayerStatisticPlayerId, int $newPlayerStatisticTeamId, int $newPlayerStatisticStatisticId, int $newPlayerStatisticValue) {
		try {
			$this->setPlayerStatisticGameId($newPlayerStatisticGameId);
			$this->setPlayerStatisticPlayerId($newPlayerStatisticPlayerId);
			$this->setPlayerStatisticTeamId($newPlayerStatisticTeamId);
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
			throw(new \InvalidArgumentException("Id cannot be null"));
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
			throw(new \InvalidArgumentException("Id cannot be null"));
		}
// Verify the Player Statistic Player Id is positive
		if($newPlayerStatisticPlayerId <= 0) {
			throw(new \RangeException("Player Statistic Player Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->playerStatisticPlayerId = $newPlayerStatisticPlayerId;
	}

	/**
	 *accessor method for Player Statistic Team Id
	 *
	 * @return int|null value of Player Statistic Team Id
	 **/
	public function getPlayerStatisticTeamId() {
		return ($this->playerStatisticTeamId);
	}

	/**
	 * mutator method for Player Statistic Team Id
	 *
	 * @param int|null $newPlayerStatisticTeamId new value of Player Statistic Team Id
	 * @throws \RangeException if the $newPlayerStatisticTeamId is not positive
	 * @throws \TypeError if $newPlayerStatisticTeamId is not an integer
	 **/
	public function setPlayerStatisticTeamId(int $newPlayerStatisticTeamId = null) {
		// base case: if PlayerStatisticTeamId is null, this is a new player statistic team id without a MySQL assigned id (yet)
		if($newPlayerStatisticTeamId === null) {
			throw(new \InvalidArgumentException("Id cannot be null"));
		}
// Verify the Player Statistic Team Id is positive
		if($newPlayerStatisticTeamId <= 0) {
			throw(new \RangeException("Player Statistic Team Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->playerStatisticTeamId = $newPlayerStatisticTeamId;
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
	public function setPlayerStatisticStatisticId(int $newPlayerStatisticStatisticId = null) {
		// base case: if PlayerStatisticStatisticId is null, this is a new player statistic Statistic id without a MySQL assigned id (yet)
		if($newPlayerStatisticStatisticId === null) {
			throw(new \InvalidArgumentException("Id cannot be null"));
		}
// Verify the Player Statistic Statistic Id is positive
		if($newPlayerStatisticStatisticId <= 0) {
			throw(new \RangeException("Player Statistic Player Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->playerStatisticStatisticId = $newPlayerStatisticStatisticId;
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

	public function setPlayerStatisticValue(int $newPlayerStatisticValue = null) {
		// base case: if PlayerStatisticStatisticId is null, this is a new player statistic Statistic id without a MySQL assigned id (yet)
		if($newPlayerStatisticValue === null) {
			throw(new \InvalidArgumentException("Value cannot be null"));
		}
// Verify the Player Statistic Statistic Id is positive
		if($newPlayerStatisticValue <= 0) {
			throw(new \RangeException("Player Statistic Player Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->playerStatisticValue = $newPlayerStatisticValue;
	}


	/**
	 * Inserts this player statistics into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo) {
		// enforce the player statistic game id, the player statistic player id, and the player statistic statistic id exist
		if($this->playerStatisticGameId === null || $this->playerStatisticPlayerId === null || $this->playerStatisticTeamId === null || $this->playerStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist"));
		}
		// Create query template
		$query = "INSERT INTO playerStatistic(playerStatisticGameId, playerStatisticPlayerId,playerStatisticTeamId, playerStatisticStatisticId, playerStatisticValue) VALUES(:playerStatisticGameId, :playerStatisticPlayerId,:playerStatisticTeamId, :playerStatisticStatisticId, :playerStatisticValue)";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["playerStatisticGameId" => $this->playerStatisticGameId, "playerStatisticPlayerId" => $this->playerStatisticPlayerId, "playerStatisticTeamId" => $this->playerStatisticTeamId, "playerStatisticStatisticId" => $this->playerStatisticStatisticId, "playerStatisticValue" => $this->playerStatisticValue];
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
		if($this->playerStatisticGameId === null || $this->playerStatisticPlayerId === null || $this->playerStatisticTeamId === null || $this->playerStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist to delete"));
		}
		// Create query template
		$query = "DELETE FROM playerStatistic WHERE playerStatisticGameId | playerStatisticPlayerId | playerStatisticTeamId| playerStatisticStatisticId | playerStatisticValue = playerStatisticGameId | playerStatisticPlayerId | playerStatisticTeamId| playerStatisticStatisticId | playerStatisticValue";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["playerStatisticGameId" => $this->playerStatisticGameId, "playerStatisticPlayerId" => $this->playerStatisticPlayerId, "playerStatisticTeamId" => $this->playerStatisticTeamId, "playerStatisticStatisticId" => $this->playerStatisticStatisticId, "playerStatisticValue" => $this->playerStatisticValue];
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
		if($this->playerStatisticGameId === null || $this->playerStatisticPlayerId === null || $this->playerStatisticTeamId === null || $this->playerStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist to update"));
		}
		// Create query template
		$query = "UPDATE playerStatistic SET playerStatisticGameId = :playerStatisticGameId, playerStatisticPlayerId = :playerStatisticPlayerId,playerStatisticTeamId = :playerStatisticTeamId, playerStatisticStatisticId = :playerStatisticStatisticId, playerStatisticValue = :playerStatisticValue";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["playerStatisticGameId" => $this->playerStatisticGameId, "playerStatisticPlayerId" => $this->playerStatisticPlayerId, "playerStatisticTeamId" => $this->playerStatisticTeamId, "playerStatisticStatisticId" => $this->playerStatisticStatisticId, "playerStatisticValue" => $this->playerStatisticValue];
		$statement->execute($parameters);
	}

	/**
	 * gets the PlayerStatistic by playerStatisticGameId, playerStatisticPlayerId and PlayerStatisticStatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $playerStatisticGameId player statistic game id to search for
	 * @param int $playerStatisticPlayerId player statistic game id to search for
	 * @param int $playerStatisticTeamId player statistic game id to search for
	 * @param int $playerStatisticStatisticId player statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of player statistic game ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPlayerStatisticByPlayerStatisticGameIdAndPlayerStatisticPlayerIdAndPlayerStatisticTeamIdAndPlayerStatisticStatisticId(\PDO $pdo, int $playerStatisticGameId, int $playerStatisticPlayerId, int $playerStatisticTeamId, int $playerStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($playerStatisticGameId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticPlayerId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticTeamId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticStatisticId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}


		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticTeamId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticGameId = :playerStatisticGameId AND playerStatisticPlayerID = :playerStatisticPlayerId AND playerStatisticTeamId = :playerStatisticTeamId AND playerStatisticStatisticId = :playerStatisticStatisticId";
		$statement = $pdo->prepare($query);



//Search based on Game, player, team, statistic ids
$parameters = ["playerStatisticGameId" => $playerStatisticGameId,"playerStatisticPlayerId" => $playerStatisticPlayerId, "playerStatisticTeamId" => $playerStatisticTeamId,"playerStatisticStatisticId" => $playerStatisticStatisticId ];
$statement->execute($parameters);

		//Grab the them from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new PlayerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"],$row["playerStatisticTeamId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($playerStatistic);
	}



/**
 * gets the TeamStatistic by playerStatisticGameId
 *
 * @param \PDO $pdo PDO connection object
 * @param int $playerStatisticGameId player statistic game id to search for
 * @param int $playerStatisticPlayerId player statistic game id to search for
 * @param int $playerStatisticTeamId player statistic game id to search for
 * @param int $playerStatisticStatisticId player statistic game id to search for
 * @return \SplFixedArray SplFixedArray of player statistic game ids found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/

	public static function getPlayerStatisticByPlayerStatisticGameId(\PDO $pdo, int $playerStatisticGameId, int $playerStatisticPlayerId, int $playerStatisticTeamId, int $playerStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($playerStatisticGameId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticPlayerId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticTeamId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticStatisticId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}


		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticTeamId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticGameId = :playerStatisticGameId  AND playerStatisticPlayerID = :playerStatisticPlayerId AND playerStatisticTeamId = :playerStatisticTeamId AND playerStatisticStatisticId = :playerStatisticStatisticId";
		$statement = $pdo->prepare($query);

//Search based on Game, player, team, statistic ids
		$parameters = ["playerStatisticGameId" => $playerStatisticGameId,"playerStatisticPlayerId" => $playerStatisticPlayerId, "playerStatisticTeamId" => $playerStatisticTeamId,"playerStatisticStatisticId" => $playerStatisticStatisticId ];
		$statement->execute($parameters);

		//Grab the them from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new PlayerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"],$row["playerStatisticTeamId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($playerStatistic);
	}

	/**
	 * gets the TeamStatistic by playerStatisticPlayerId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $playerStatisticGameId player statistic game id to search for
	 * @param int $playerStatisticPlayerId player statistic game id to search for
	 * @param int $playerStatisticTeamId player statistic game id to search for
	 * @param int $playerStatisticStatisticId player statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of player statistic game ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPlayerStatisticByPlayerStatisticPlayerId(\PDO $pdo, int $playerStatisticGameId, int $playerStatisticPlayerId, int $playerStatisticTeamId, int $playerStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($playerStatisticGameId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticPlayerId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticTeamId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticStatisticId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}
		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticTeamId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticGameId = :playerStatisticGameId  AND playerStatisticPlayerID = :playerStatisticPlayerId AND playerStatisticTeamId = :playerStatisticTeamId AND playerStatisticStatisticId = :playerStatisticStatisticId";
		$statement = $pdo->prepare($query);


		//Search based on Game, player, team, statistic ids
		$parameters = ["playerStatisticGameId" => $playerStatisticGameId,"playerStatisticPlayerId" => $playerStatisticPlayerId, "playerStatisticTeamId" => $playerStatisticTeamId,"playerStatisticStatisticId" => $playerStatisticStatisticId ];
		$statement->execute($parameters);


		//Grab the them from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new PlayerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"],$row["playerStatisticTeamId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($playerStatistic);
	}

	/**
	 * gets the TeamStatistic by playerStatisticTeamId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $playerStatisticGameId player statistic game id to search for
	 * @param int $playerStatisticPlayerId player statistic game id to search for
	 * @param int $playerStatisticTeamId player statistic game id to search for
	 * @param int $playerStatisticStatisticId player statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of player statistic game ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getPlayerStatisticByPlayerStatisticTeamId(\PDO $pdo, int $playerStatisticGameId, int $playerStatisticPlayerId, int $playerStatisticTeamId, int $playerStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($playerStatisticGameId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticPlayerId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticTeamId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticStatisticId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}
		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticTeamId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticGameId = :playerStatisticGameId  AND playerStatisticPlayerID = :playerStatisticPlayerId AND playerStatisticTeamId = :playerStatisticTeamId AND playerStatisticStatisticId = :playerStatisticStatisticId";
		$statement = $pdo->prepare($query);


		//Search based on Game, player, team, statistic ids
		$parameters = ["playerStatisticGameId" => $playerStatisticGameId,"playerStatisticPlayerId" => $playerStatisticPlayerId, "playerStatisticTeamId" => $playerStatisticTeamId,"playerStatisticStatisticId" => $playerStatisticStatisticId ];
		$statement->execute($parameters);


		//Grab the them from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new PlayerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"],$row["playerStatisticTeamId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($playerStatistic);
	}


	/**
	 * gets the PlayerStatistic by playerStatisticStatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $playerStatisticGameId player statistic game id to search for
	 * @param int $playerStatisticPlayerId player statistic game id to search for
	 * @param int $playerStatisticTeamId player statistic game id to search for
	 * @param int $playerStatisticStatisticId player statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of player statistic game ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getPlayerStatisticByPlayerStatisticStatisticId(\PDO $pdo, int $playerStatisticGameId, int $playerStatisticPlayerId, int $playerStatisticTeamId, int $playerStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($playerStatisticGameId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticPlayerId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticTeamId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($playerStatisticStatisticId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}
		// create query template
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticTeamId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic WHERE playerStatisticGameId = :playerStatisticGameId  AND playerStatisticPlayerID = :playerStatisticPlayerId AND playerStatisticTeamId = :playerStatisticTeamId AND playerStatisticStatisticId = :playerStatisticStatisticId";
		$statement = $pdo->prepare($query);


		//Search based on Game, player, team, statistic ids
		$parameters = ["playerStatisticGameId" => $playerStatisticGameId,"playerStatisticPlayerId" => $playerStatisticPlayerId, "playerStatisticTeamId" => $playerStatisticTeamId,"playerStatisticStatisticId" => $playerStatisticStatisticId ];
		$statement->execute($parameters);


		//Grab the them from mySQL
		try {
			$playerStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$playerStatistic = new PlayerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"],$row["playerStatisticTeamId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($playerStatistic);
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
		$query = "SELECT playerStatisticGameId, playerStatisticPlayerId, playerStatisticTeamId, playerStatisticStatisticId, playerStatisticValue FROM playerStatistic";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of Player Statistics
		$playerStatistics = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$playerStatistic = new PlayerStatistic($row["playerStatisticGameId"], $row["playerStatisticPlayerId"], $row["playerStatisticTeamId"], $row["playerStatisticStatisticId"], $row["playerStatisticValue"]);
				$playerStatistics[$playerStatistics->key()] = $playerStatistic;
				$playerStatistics->next();
			} Catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($playerStatistics);
	}


}