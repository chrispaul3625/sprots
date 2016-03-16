<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * Player Statistics, This will be a player stat that is being pulled from APIs.
 * @author Jude Chavez <chavezjude7@gmail.com>
 **/
class TeamStatistic implements \JsonSerializable{

	use ValidateDate;
	/**
	 * $teamStatisticGameId id for team in a specific game; this is a foreign key
	 * @var int $teamStatisticGameId
	 **/
	private $teamStatisticGameId;
	/**
	 * $teamStatisticTeamId id for team statistic to team , this is a foreign key
	 * @var int $teamStatisticTeamId
	 **/
	private $teamStatisticTeamId;
	/**
	 * $teamStatisticStatisticId id for the team individual statistic, this is a foreign key
	 * @var int $teamStatisticStatisticId
	 **/
	private $teamStatisticStatisticId;
	/**
	 * $teamStatisticValue the value of individual stats, number value for a stat
	 * @var int $teamStatisticValue
	 **/
	private $teamStatisticValue;

	/**
	 * Constructor for this  statistics
	 *
	 * @param int $newTeamStatisticGameId id of game the team is in
	 * @param int $newTeamStatisticTeamId statistic id of the team referencing team
	 * @param int $newTeamStatisticStatisticId name associated with team
	 * @param int $newTeamStatisticValue Value of the statistic
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newTeamStatisticGameId, int $newTeamStatisticTeamId, int $newTeamStatisticStatisticId, string $newTeamStatisticValue) {
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
	 * accessor method for team Statistic Game Id
	 *
	 * @return int|null value of team Statistic Game Id
	 **/
	public function getTeamStatisticGameId() {
		return ($this->teamStatisticGameId);
	}

	/**
	 * mutator method for TeamStatisticGameId
	 *
	 * @param int|null $newTeamStatisticGameId new value of Team Statistic Game Id
	 * @throws \RangeException if the $newTeamStatisticGameId is not positive
	 * @throws \TypeError if $newTeamStatisticGameId is not an integer
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
	 *accessor method for Team Statistic Team Id
	 *
	 * @return int|null value of Team Statistic Team Id
	 **/
	public function getTeamStatisticTeamId() {
		return ($this->teamStatisticTeamId);
	}

	/**
	 * mutator method for Team Statistic Team Id
	 *
	 * @param int|null $newTeamStatisticTeamId new value of Team Statistic Team Id
	 * @throws \RangeException if the $newTeamStatisticTeamId is not positive
	 * @throws \TypeError if $newTeamStatisticTeamId is not an integer
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
	 * accessor method for Team Statistic Statistic Id
	 *
	 * @return int|null value of Team Statistic Statistic Id
	 **/
	public function getTeamStatisticStatisticId() {
		return ($this->teamStatisticStatisticId);
	}

	/**
	 * mutator method for Team Statistic Statistic Id
	 *
	 * @param int|null $newTeamStatisticStatisticId new value of Team Statistic Statistic Id
	 * @throws \InvalidArgumentException if $newTeamStatisticStatisticId is not a string or insecure
	 * @throws \RangeException if $newTeamstatisticStatisticId is >32 characters
	 * @throws \TypeError if $newTeamStatisticStatisticId is not an integer
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
	 * accessor method for Team Statistic Value
	 *
	 * @return int value of Team Statistic Value
	 **/

	public function getTeamStatisticValue() {
		return ($this->teamStatisticValue);
	}

	/**
	 * mutator method for Team Statistic Value
	 *
	 * @param int $newTeamStatisticValue value of statistic
	 * @throws \InvalidArgumentException if $newTeamStatisticValue is not an integer or insecure
	 * @throws \RangeException if $newTeamStatisticValue is >32 characters
	 * @throws \TypeError if $newTeamStatisticValue is not an integer
	 **/

	public function setTeamStatisticValue(string $newTeamStatisticValue = null) {
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
	 * Inserts this team statistics into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo) {
		// enforce the player statistic game id, the player statistic player id, and the player statistic statistic id exist
		if($this->teamStatisticGameId === null || $this->teamStatisticTeamId === null || $this->teamStatisticStatisticId === null) {
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
		if($this->teamStatisticGameId === null || $this->teamStatisticTeamId === null || $this->teamStatisticStatisticId === null) {
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
	 * updates this Team Statistics in mySQL
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
	 * gets the TeamStatistic by teamStatisticGameId,  and teamStatisticStatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamStatisticGameId team statistic game id to search for
	 * @param int $teamStatisticTeamId team statistic game id to search for
	 * @param int $teamStatisticStatisticId team statistic game id to search for
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
	 * @param int $teamStatisticGameId team statistic game id to search for
	 * @param int $teamStatisticTeamId team statistic game id to search for
	 * @param int $teamStatisticStatisticId team statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of team statistic game ids found
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
	 * gets the TeamStatistic by teamStatisticTeamId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamStatisticGameId team statistic game id to search for
	 * @param int $teamStatisticTeamId team statistic game id to search for
	 * @param int $teamStatisticStatisticId team statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of team statistic game ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getTeamStatisticByTeamStatisticTeamId(\PDO $pdo, int $teamStatisticGameId, int $teamStatisticTeamId, int $teamStatisticStatisticId) {
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
	 * gets the PlayerStatistic by playerStatisticStatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamStatisticGameId team statistic game id to search for
	 * @param int $teamStatisticTeamId team statistic game id to search for
	 * @param int $teamStatisticStatisticId team statistic game id to search for
	 * @return \SplFixedArray SplFixedArray of team statistic game ids found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTeamStatisticByTeamStatisticStatisticId(\PDO $pdo, int $teamStatisticGameId, int $teamStatisticTeamId, int $teamStatisticStatisticId) {
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
	 * gets all TeamStatistics
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
				$teamStatistic = new TeamStatistic($row["teamStatisticGameId"], $row["teamStatisticTeamId"], $row["teamStatisticStatisticId"], $row["teamStatisticValue"]);
				$teamStatistics[$teamStatistics->key()] = $teamStatistic;
				$teamStatistics->next();
			} Catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($teamStatistics);
	}
	public function jsonSerialize() {
		return(get_object_vars($this));
	}

}