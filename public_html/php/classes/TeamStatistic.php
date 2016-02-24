<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");


/**
 * TeamStatistic, This is a field in which all statistics related to a team are going to be held.
 *
 * @author Jude Chavez <Chavezjude7@gmail.com>*/
class TeamStatistic implements \JsonSerializable {
	/**
	 * Id for the Statistic; this is the primary key
	 * @var int $teamStatistic
	 */
	private $teamStatisticTeamId;
	/**
	 * is unique statistic, unique to team
	 * @return int $teamStatisticStatisticId
	 */
	private $teamStatisticStatisticId;

	/**
	 * is unique value of statistic
	 * @return int $teamStatisticValue
	 */
	private $teamStatisticValue;

	/**
	 * is unique to Team and Game Played
	 * @return int $teamStatisticGameId
	 */
	private $teamStatisticGameId;

	/**
	 * @param int $newTeamStatisticId
	 * @param int $newTeamStatisticTeamId
	 * @param int $newTeamStatisticValue
	 * @param int $newTeamStatisticStatisticId
	 * @param int $newTeamStatisticGameId
	 * @throws \Exception if some other exception occurs
	 * @throws \InvalidArgumentException
	 * @internal param int|null $teamStatisticTeam of this teamStatistic or null if a New Player
	 * @internal param int $teamStatisticTeamId Id of the teamStatistic
	 * @internal param int $teamStatisticValue Statistic value of the Team
	 * @internal param int $teamStatisticStatisticId Id of the Statistic being called
	 * @internal param int $teamStatisticGameId Id of the Game that the Statistic is coming from
	 */

	public function __construct(int $newTeamStatisticTeamId, int $newTeamStatisticValue, int $newTeamStatisticStatisticId, int $newTeamStatisticGameId = null) {
		try {
			$this->setTeamStatisticTeamId($newTeamStatisticTeamId);
			$this->setTeamStatisticValue($newTeamStatisticValue);
			$this->setTeamStatisticStatisticId($newTeamStatisticStatisticId);
			$this->setTeamStatisticGameId($newTeamStatisticGameId);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow exception to caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow exception to caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \RangeException($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * @param $teamStatisticTeamId
	 * @param \InvalidArgumentException if teamStatisticTeamId is not an integer
	 * @throws \RangeException if teamStatistic TeamId is negative
	 */

	public function setTeamStatisticTeamId($teamStatisticTeamId) {
		if($teamStatisticTeamId === null) {
			$this->teamStatisticTeamId = null;
			return;
		}
		$teamStatisticTeamId = filter_var($teamStatisticTeamId, FILTER_VALIDATE_INT);
		if($teamStatisticTeamId == false) {
		}
		if($teamStatisticTeamId <= 0) {
			throw (new \RangeException("PlayerStatisticId must be postive"));
		}
		$this->teamStatisticTeamId = $teamStatisticTeamId;
	}

	/**
	 * accessor for teamStatisticTeamId
	 * @return int value of TeamStatisticTeamId
	 **/
	public function getTeamStatisticValue() {
		return $this->teamStatisticValue;
	}

	/**
	 * @param int $teamStatisticValue new values of TeamStatisticValue
	 * @throws \InvalidArgumentException if Statistic TeamId is not an integer
	 * @throws \RangeException if StatisticTeamId is negative
	 */

	public function setTeamStatisticValue($teamStatisticValue) {
		if($teamStatisticValue === null) {
			$this->teamStatisticValue = null;
			return;
		}
		$teamStatisticValue = filter_var($teamStatisticValue, FILTER_VALIDATE_INT);
		if($teamStatisticValue == false) {
		}
		if($teamStatisticValue <= 0) {
			throw (new \RangeException("PlayerStatisticValue must be positive"));
		}
		$this->teamStatisticValue = $teamStatisticValue;
	}

	/**
	 * accessor for teamStatisticTeamId
	 * @return int value of teamStatisticTeamId
	 */

	public function getTeamStatisticStatisticId() {
		return $this->teamStatisticStatisticId;
	}

	/**
	 * @param int $teamStatisticStatisticId new values of TeamStatisticValue
	 * @throws \InvalidArgumentException if StatisticTeamId is not an integer
	 * @throws \RangeException if Statistic is negative
	 */

	public function setTeamStatisticStatisticId($teamStatisticStatisticId) {
		if($teamStatisticStatisticId === null) {
			$this->teamStatisticStatisticId = null;
			return;
		}
		$teamStatisticStatisticId = filter_var($teamStatisticStatisticId, FILTER_VALIDATE_INT);
		if($teamStatisticStatisticId == false) {
		}
		if($teamStatisticStatisticId <= 0) {
			throw (new \RangeException("TeamStatistic must be posititve"));
		}
		$this->teamStatisticStatisticId = $teamStatisticStatisticId;
	}

	/**
	 * accessor for teamStatisticTeamId
	 * @return int value of teamStatisticTeamId
	 */
	public function getTeamStatisticGameId() {
		return $this->teamStatisticGameId;
	}

	/**
	 * @param int $teamStatisticGameId new values of teamStatisticValue
	 * @throws \InvalidArgumentException if StatisticTeamId is not an integer
	 * @throws \RangeException if Statistic is negative
	 */
	public function setTeamStatisticGameId($teamStatisticGameId) {
		if($teamStatisticGameId === null) {
			$this->teamStatisticGameId = null;
			return;
		}
		$teamStatisticGameId = filter_var($teamStatisticGameId, FILTER_VALIDATE_INT);
		if($teamStatisticGameId == false) {
		}
		if($teamStatisticGameId <= 0) {
			throw (new \RangeException("TeamStatistic must be positive"));
		}
		$this->teamStatisticGameId = $teamStatisticGameId;
	}

	/**
	 * is unique to Team and Game Played
	 * @return int
	 */
	public function getTeamStatisticTeamId() {
		return $this->teamStatisticTeamId;
	}

	/**
	 * inserts this teamStatistic into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the playerId is null (i.e., dont insert a statistic that already exists
		if($this->teamStatisticTeamId !== null) {
			throw(new \PDOException("not a new statistic"));
		}

		// create query template
		$query = "INSERT INTO TeamStatistic(playerId, TeamStatisticTeamId) VALUES(:TeamStatisticTeamId, :TeamStatisticValue, :TeamStatisticStatisticId, :TeamStatisticGameId)";
		$statement = $pdo->prepare($query);

		$parameters = ["TeamStatisticTeamId" => $this->teamStatisticTeamId, "TeamStatisticValue" => $this->teamStatisticValue, "teamStatisticStatisticId" => $this->teamStatisticStatisticId, "teamStatisticGameId" => $this->teamStatisticGameId];
		$statement->execute($parameters);

		// update the null teamStatisticTeamId with what mySql just gave us
		$this->teamStatisticTeamId = interval($pdo->lastInsertId());

	}

	/**
	 * updates this teamStatistic in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		if($this->teamStatisticTeamId === null) {
			throw(new \PDOException("unable to update a player that does not exist"));
		}
		$query = "UPDATE TeamStatistic SET TeamStatisticTeamId = :TeamStatisticTeamId, teamStatisticValue = :TeamStatisticValue, teamStatisticStatisticId = :TeamStatisticStatisticId, teamStatisticGameId = :teamStatisticGameId WHERE teamStatisticTeamId = :TeamStatisticTeamId";
		$statement = $pdo->prepare($query);

		$parameters
	}


	/**
	 * deletes teamStatistic from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 **/
	public function delete(\PDO $pdo, $parameters) {
		//enforce the teamStatisticTeamId is not null (i.e., don't delete a statistic that hasn't been inserted)
		if($this->teamStatisticTeamId === null) {
			throw(new \PDOException("unable to delete a statistic that does not exist"));
		}

		// create query template
		$query = "DELETE FROM statistic WHERE TeamStatisticTeamId = :TeamStatisticTeamId";
		$statement = $pdo->prepare($query);
		$statement->execute($parameters);
	}


	/**
	 * gets the teamStatistic by teamStatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamStatisticId teamStatisticId to search for
	 * @return TeamStatistic|null TeamStatistic found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTeamStatisticByTeamStatisticId(\PDO $pdo, int $teamStatisticId) {
		// sanitize the tweetId before searching
		if($teamStatisticId <= 0) {
			throw(new \PDOException("teamStatistic id is not positive"));
		}

		// create query template
		$query = "SELECT TeamStatisticTeamId, TeamStatisticStatisticId, TeamStatistic, TeamStatisticId FROM TeamStatisticId = :TeamStatisticId";
		$statement = $pdo->prepare($query);

		// bind the teamStatistic id to the place holder in the template
		$parameters = array("teamStatisticId" => $teamStatisticId);
		$statement->execute($parameters);

		// grab the tweet from mySQL
		try {
			$teamStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatistic = new TeamStatistic($row["teamStatisticId"], $row["teamId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($teamStatistic);
	}

	/**
	 * gets the teamStatistic by teamStatisticStatisticId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamStatisticStatisticId TeamStatisticStatisticId to search for
	 * @return TeamStatistic|null TeamStatisticStatistic found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTeamStatisticByTeamStatisticStatisticId(\PDO $pdo, int $teamStatisticStatisticId) {
		// sanitize the tweetId before searching
		if($teamStatisticStatisticId <= 0) {
			throw(new \PDOException("TeamStatisticStatisticId is not positive"));
		}

		// create query template
		$query = "SELECT TeamStatisticTeamId, TeamStatisticStatisticId, TeamStatistic, TeamStatisticId FROM TeamStatisticId = :TeamStatisticId";
		$statement = $pdo->prepare($query);

		// bind the teamStatisticStatisticId to the place holder in the template
		$parameters = array("teamStatisticStatisticId" => $teamStatisticStatisticId);
		$statement->execute($parameters);

		// grab the teamStatisticStatisticId from mySQL
		try {
			$teamStatisticStatisticId = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatisticStatisticId = new TeamStatisticStatistic($row["teamStatisticId"], $row["teamId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($teamStatisticStatisticId);
	}

	/**
	 * gets the teamStatistic by TeamStatisticValue
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamStatisticValue Team Statistic Value to search for
	 * @return TeamStatistic|null TeamStatisticValue found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTeamStatisticByTeamStatisticValue(\PDO $pdo, int $teamStatisticValue) {
		// sanitize the teamStatisticValue before searching
		if($teamStatisticValue <= 0) {
			throw(new \PDOException("teamStatisticValue Value is not positive"));
		}

		// create query template
		$query = "SELECT TeamStatisticTeamId, TeamStatisticStatisticId, TeamStatistic, TeamStatisticId FROM TeamStatisticId = :TeamStatisticId";
		$statement = $pdo->prepare($query);

		// bind the teamStatistic id to the place holder in the template
		$parameters = array("TeamStatisticValue" => $teamStatisticValue);
		$statement->execute($parameters);

		// grab the teamStatistc from mySQL
		try {
			$teamStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatistic = new TeamStatisticValue($row["teamStatisticId"], $row["teamId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($teamStatistic);
	}

	/**
	 * gets the teamStatistic by TeamStatisticGameId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamStatisticGameId Game Id to search for
	 * @return TeamStatistic|null TeamStatisticGameId found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTeamStatisticByTeamStatisticGameId(\PDO $pdo, int $teamStatisticGameId) {
		// sanitize the tweetId before searching
		if($teamStatisticGameId <= 0) {
			throw(new \PDOException("teamStatisticGame id is not positive"));
		}

		// create query template
		$query = "SELECT TeamStatisticTeamId, TeamStatisticStatisticId, TeamStatistic, TeamStatisticId FROM TeamStatisticId = :TeamStatisticId";
		$statement = $pdo->prepare($query);

		// bind the teamStatisticGameId id to the place holder in the template
		$parameters = array("teamStatisticGameId" => $teamStatisticGameId);
		$statement->execute($parameters);

		// grab the tweet from mySQL
		try {
			$teamStatistic = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$teamStatistic = new TeamStatisticGameId($row["teamStatisticId"], $row["teamId"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($teamStatistic);
	}

	/**
	 * gets all teamStatistics
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of TeamStatistics found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllTeamStatistics(\PDO $pdo) {
		// create query template
		$query = "SELECT TeamStatisticTeamId, TeamStatisticStatisticId, TeamStatistic, TeamStatisticId FROM TeamStatisticId = :TeamStatisticId";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of teamStatistics
		$teamStatistic = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$teamStatistic = new TeamStatisticGameId($row["teamStatisticId"], $row["teamId"]);
				$teamStatistic[$teamStatistic->key()] = $teamStatistic;
				$teamStatistic->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($teamStatistic);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["teamStatistic"] = intval($this->TeamStatistic->format("U")) * 1000;
		return ($fields);
	}




}










