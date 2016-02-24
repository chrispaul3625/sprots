<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * Player Statistics, This will be a player stat that is being pulled from APIs.
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class TeamStatistic {

	use ValidateDate;
	/**
	 * $playerStatisticGameId id for player in a specific game; this is a foreign key
	 * @var int $playerStatisticGameId
	 **/
	private $teamStatisticGameId;
	/**
	 * $playerStatisticTeamId id for players statistic to team , this is a foreign key
	 * @var int $playerStatisticTeamId
	 **/
	private $teamStatisticTeamId;
	/**
	 * $playerStatisticStatisticId id for the players individual statistic, this is a foreign key
	 * @var int $playerStatisticStatisticId
	 **/
	private $teamrStatisticStatisticId;
	/**
	 * $playerStatisticValue the value of individual stats, number value for a stat
	 * @var int $playerStatisticValue
	 **/
	private $teamStatisticValue;

	/**
	 * Constructor for this  statistics
	 *
	 * @param int $newTeamStatisticGameId id of game the player is in
	 * @param int $newPlayerStatisticPlayerId statistic id of the player
	 * @param int $newTeamStatisticTeamId statistic id of the player referencing team
	 * @param int $newTeamStatisticStatisticId name associated with team
	 * @param int $newTeamStatisticValue Value of the statistic
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newTeamStatisticGameId, int $newTeamStatisticTeamId, int $newTeamStatisticStatisticId, int $newTeamStatisticValue) {
		try {
			$this->setTeamStatisticGameId($newTeamStatisticGameId);
			$this->setTeamStatisticTeamId($newTeamStatisticTeamId);
			$this->setTeamStatisticStatisticId($newTeamStatisticStatisticId);
			$this->setTeamStatisticValue($newTeamStatisticValue);
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
	public function getTeamStatisticGameId() {
		return ($this->teamStatisticGameId);
	}

	/**
	 * mutator method for PlayerStatisticGameId
	 *
	 * @param int|null $newPlayerStatisticGameId new value of Player Statistic Game Id
	 * @throws \RangeException if the $newPlayerStatisticGameId is not positive
	 * @throws \TypeError if $newPlayerStatisticGameId is not an integer
	 **/
	public function setTeamStatisticGameId(int $newTeamStatisticGameId) {
		if($newTeamStatisticGameId === null) {
			throw(new \InvalidArgumentException("Id cannot be null"));
		}
// Verify the PlayerStatisticGameId is positive
		if($newTeamStatisticGameId <= 0) {
			throw(new \RangeException("TeamStatisticGameId is not positive"));
		}
// Convert and store the PlayerStatisticGameId
		$this->teamStatisticGameId = $newTeamStatisticGameId;
	}


	/**
	 *accessor method for Player Statistic Team Id
	 *
	 * @return int|null value of Player Statistic Team Id
	 **/
	public function getTeamStatisticTeamId() {
		return ($this->teamStatisticTeamId);
	}

	/**
	 * mutator method for Player Statistic Team Id
	 *
	 * @param int|null $newPlayerStatisticTeamId new value of Player Statistic Team Id
	 * @throws \RangeException if the $newPlayerStatisticTeamId is not positive
	 * @throws \TypeError if $newPlayerStatisticTeamId is not an integer
	 **/
	public function setTeamStatisticTeamId(int $newTeamStatisticTeamId = null) {
		// base case: if PlayerStatisticTeamId is null, this is a new player statistic team id without a MySQL assigned id (yet)
		if($newTeamStatisticTeamId === null) {
			throw(new \InvalidArgumentException("Id cannot be null"));
		}
// Verify the Player Statistic Team Id is positive
		if($newTeamStatisticTeamId <= 0) {
			throw(new \RangeException("Team Statistic Team Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->teamStatisticTeamId = $newTeamStatisticTeamId;
	}

	/**
	 * accessor method for Player Statistic Statistic Id
	 *
	 * @return int|null value of Player Statistic Statistic Id
	 **/
	public function getTeamStatisticStatisticId() {
		return ($this->teamStatisticStatisticId);
	}

	/**
	 * mutator method for Player Statistic Statistic Id
	 *
	 * @param int|null $newPlayerStatisticStatisticId new value of Player Statistic Statistic Id
	 * @throws \InvalidArgumentException if $newPlayerStatisticStatisticId is not a string or insecure
	 * @throws \RangeException if $newPlayerStatisticStatisticId is >32 characters
	 * @throws \TypeError if $newPlayerStatisticStatisticId is not an integer
	 **/
	public function setTeamStatisticStatisticId(int $newTeamStatisticStatisticId = null) {
		// base case: if PlayerStatisticStatisticId is null, this is a new player statistic Statistic id without a MySQL assigned id (yet)
		if($newTeamStatisticStatisticId === null) {
			throw(new \InvalidArgumentException("Id cannot be null"));
		}
// Verify the Player Statistic Statistic Id is positive
		if($newTeamStatisticStatisticId <= 0) {
			throw(new \RangeException("team Statistic teM Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->teamStatisticStatisticId = $newTeamStatisticStatisticId;
	}

	/**
	 * accessor method for Player Statistic Value
	 *
	 * @return int value of Player Statistic Value
	 **/

	public function getTeamStatisticValue() {
		return ($this->teamStatisticValue);
	}

	/**
	 * mutator method for Player Statistic Value
	 *
	 * @param int $newPlayerStatisticValue value of statistic
	 * @throws \InvalidArgumentException if $newPlayerStatisticValue is not an integer or insecure
	 * @throws \RangeException if $newPlayerStatisticValue is >32 characters
	 * @throws \TypeError if $newPlayerStatisticValue is not an integer
	 **/

	public function setTeamStatisticValue(int $newTeamStatisticValue = null) {
		// base case: if PlayerStatisticStatisticId is null, this is a new player statistic Statistic id without a MySQL assigned id (yet)
		if($newTeamStatisticValue === null) {
			throw(new \InvalidArgumentException("Value cannot be null"));
		}
// Verify the Player Statistic Statistic Id is positive
		if($newTeamStatisticValue <= 0) {
			throw(new \RangeException("Team Statistic Team Id is not positive"));
		}
// Convert and store the Player Statistic Player Id
		$this->teamStatisticValue = $newTeamStatisticValue;
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
		if($this->teamStatisticGameId === null || $this->teamStatisticPlayerId === null || $this->teamStatisticTeamId === null || $this->teamStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist"));
		}
		// Create query template
		$query = "INSERT INTO teamStatistic(teamStatisticGameId, teamStatisticTeamId, teamStatisticStatisticId, teamStatisticValue) VALUES(:teamStatisticGameId, :teamStatisticTeamId, :teamStatisticStatisticId, :teamStatisticValue)";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["teamStatisticGameId" => $this->teamStatisticGameId, "teamStatisticTeamId" => $this->teamStatisticTeamId, "teamStatisticStatisticId" => $this->teamStatisticStatisticId, "teamStatisticValue" => $this->teamStatisticValue];
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
		if($this->teamStatisticGameId === null || $this->teamStatisticPlayerId === null || $this->teamStatisticTeamId === null || $this->teamStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist to delete"));
		}
		// Create query template
		$query = "DELETE FROM teamStatistic WHERE teamStatisticGameId | teamStatisticTeamId| teamStatisticStatisticId | teamStatisticValue = teamStatisticGameId | teamStatisticTeamId| teamStatisticStatisticId | teamStatisticValue";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["teamStatisticGameId" => $this->teamStatisticGameId, "teamStatisticTeamId" => $this->teamStatisticTeamId, "teamStatisticStatisticId" => $this->teamStatisticStatisticId, "teamStatisticValue" => $this->teamStatisticValue];
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
		if($this->teamStatisticGameId === null || $this->teamStatisticTeamId === null || $this->teamStatisticStatisticId === null) {
			throw(new \PDOException("Ids do not exist to update"));
		}
		// Create query template
		$query = "UPDATE teamStatistic SET teamStatisticGameId = :teamStatisticGameId, teamStatisticTeamId = :teamStatisticTeamId, teamStatisticStatisticId = :teamStatisticStatisticId, teamStatisticValue = :teamStatisticValue";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in template
		$parameters = ["teamStatisticGameId" => $this->teamStatisticGameId, "teamStatisticTeamId" => $this->teamStatisticTeamId, "teamStatisticStatisticId" => $this->teamStatisticStatisticId, "teamStatisticValue" => $this->teamStatisticValue];
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

	public static function getTeamStatisticByTeamStatisticGameIdAndTeamStatisticTeamIdAndTeamStatisticStatisticId(\PDO $pdo, int $teamStatisticGameId, int $teamStatisticTeamId, int $teamStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($teamStatisticGameId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}

		if($teamStatisticTeamId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}

		if($teamStatisticStatisticId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}


		// create query template
		$query = "SELECT teamStatisticGameId, teamStatisticTeamId, teamStatisticStatisticId, teamStatisticValue FROM teamStatistic WHERE teamStatisticGameId = :teamStatisticGameId AND teamStatisticTeamId = :teamStatisticTeamId AND teamStatisticStatisticId = :teamStatisticStatisticId";
		$statement = $pdo->prepare($query);



//Search based on Game, player, team, statistic ids
		$parameters = ["teamStatisticGameId" => $teamStatisticGameId, "teamStatisticTeamId" => $teamStatisticTeamId,"teamStatisticStatisticId" => $teamStatisticStatisticId ];
		$statement->execute($parameters);

		//Grab the them from mySQL
		try {
			$teamStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatistic = new TeamStatistic($row["teamStatisticGameId"], $row["teamStatisticTeamId"], $row["teamStatisticStatisticId"], $row["teamStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($teamStatistic);
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

	public static function getTeamStatisticByTeamStatisticGameId(\PDO $pdo, int $teamStatisticGameId, int $teamStatisticTeamId, int $teamStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($teamStatisticGameId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}


		if($teamStatisticTeamId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}

		if($teamStatisticStatisticId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}


		// create query template
		$query = "SELECT teamStatisticGameId, teamStatisticTeamId, teamStatisticStatisticId, teamStatisticValue FROM teamStatistic WHERE teamStatisticGameId = :teamStatisticGameId AND teamStatisticTeamId = :teamStatisticTeamId AND teamStatisticStatisticId = :teamStatisticStatisticId";
		$statement = $pdo->prepare($query);

//Search based on Game, player, team, statistic ids
		$parameters = ["teamStatisticGameId" => $teamStatisticGameId, "teamStatisticTeamId" => $teamStatisticTeamId,"teamStatisticStatisticId" => $teamStatisticStatisticId ];
		$statement->execute($parameters);

		//Grab the them from mySQL
		try {
			$teamStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatistic = new TeamStatistic($row["teamStatisticGameId"], $row["teamStatisticTeamId"], $row["teamStatisticStatisticId"], $row["teamStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($teamStatistic);
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

	/**public static function getPlayerStatisticByPlayerStatisticPlayerId(\PDO $pdo, int $playerStatisticGameId, int $playerStatisticPlayerId, int $playerStatisticTeamId, int $playerStatisticStatisticId) {
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

	**/


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

	public static function getTeamStatisticByTeamStatisticTeamId(\PDO $pdo, int $teamStatisticGameId, int $teamStatisticPlayerId, int $teamStatisticTeamId, int $teamStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($teamStatisticGameId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}

		if($teamStatisticTeamId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}

		if($teamStatisticStatisticId <= 0) {
			throw (new \PDOException("team statistic game id is not positive"));
		}
		// create query template
		$query = "SELECT teamStatisticGameId, teamStatisticPlayerId, teamStatisticTeamId, teamStatisticStatisticId, teamStatisticValue FROM teamStatistic WHERE teamStatisticGameId = :teamStatisticGameId AND teamStatisticTeamId = :teamStatisticTeamId AND teamStatisticStatisticId = :teamStatisticStatisticId";
		$statement = $pdo->prepare($query);


		//Search based on Game, player, team, statistic ids
		$parameters = ["teamStatisticGameId" => $teamStatisticGameId, "teamStatisticTeamId" => $teamStatisticTeamId,"teamStatisticStatisticId" => $teamStatisticStatisticId ];
		$statement->execute($parameters);


		//Grab the them from mySQL
		try {
			$teamStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatistic = new TeamStatistic($row["teamStatisticGameId"], $row["teamStatisticTeamId"], $row["teamStatisticStatisticId"], $row["teamStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($teamStatistic);
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
	public static function getTeamStatisticByteamStatisticStatisticId(\PDO $pdo, int $teamStatisticGameId, int $teamStatisticTeamId, int $teamStatisticStatisticId) {
		// sanitize the player statistic statistic id before searching
		if($teamStatisticGameId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($teamStatisticTeamId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}

		if($teamStatisticStatisticId <= 0) {
			throw (new \PDOException("player statistic game id is not positive"));
		}
		// create query template
		$query = "SELECT teamStatisticGameId, teamStatisticTeamId, teamStatisticStatisticId, teamStatisticValue FROM teamStatistic WHERE teamStatisticGameId = :teamStatisticGameId AND teamStatisticTeamId = :teamStatisticTeamId AND teamStatisticStatisticId = :teamStatisticStatisticId";
		$statement = $pdo->prepare($query);


		//Search based on Game, player, team, statistic ids
		$parameters = ["teamStatisticGameId" => $teamStatisticGameId, "teamStatisticTeamId" => $teamStatisticTeamId,"teamStatisticStatisticId" => $teamStatisticStatisticId ];
		$statement->execute($parameters);


		//Grab the them from mySQL
		try {
			$teamStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatistic = new TeamStatistic($row["teamStatisticGameId"], $row["teamStatisticTeamId"], $row["teamStatisticStatisticId"], $row["teamStatisticValue"]);
			}
		} catch(\Exception $exception) {
			//If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($teamStatistic);
	}

	/**
	 * gets all PlayrrStatistics
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of PlayerStatistics found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAllTeamStatistics(\PDO $pdo) {
		//create query template
		$query = "SELECT teamStatisticGameId, teamStatisticTeamId, teamStatisticStatisticId, teamStatisticValue FROM teamStatistic";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of Player Statistics
		$teamStatistics = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$teamStatistic = new TeamStatistic($row["teamStatisticGameId"], $row["teamStatisticTeamId"], $row["playerStatisticStatisticId"], $row["teamStatisticValue"]);
				$teamStatistics[$teamStatistics->key()] = $teamStatistic;
				$teamStatistics->next();
			} Catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($teamStatistics);
	}


}