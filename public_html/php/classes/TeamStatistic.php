<?php

require_once("autoload.php");

/**
 * Team Statistic, This is a field in which all statistics related to a team are going to be held.
 *
 * @author Jude Chavez <Chavezjude7@gmail.com>
 */
class teamStatistic {
	/**
	 * id for the statistic; this is the primary key
	 * @var int $teamStatistic
	 */
		private $teamStatisticTeamId;

	/**
	 * is unique statistic, unique to team
	 * @return int $teamstatisticId
	 */

	private $teamStatisticValue;

	/**
	 * is unique value of statistic
	 * @return int $teamStatisticValue
	 */

	private $teamStastisticStatisticId;

	/**
	 * is unique to statistic and team
	 * @return int $teamStatisticStatisticId
	 */

	private $teamStatisticGameId;

	/**
	 *
	 */

	/**
	 * is unique to team and game played
	 * @return int
	 */

		public function getTeamStatisticTeamId() {
			return $this->teamStatisticTeamId;
		}

	/**
		* @param int|null $teamStatisticTeam of this teamStatistic or null if a new player
		* @param int $teamStatisticTeamId Id of the teamStatistic
		* @param int $teamStatisticValue statistic value of the team
		* @param int $teamStatisticStatisticId Id of the statistic being called
	 	* @param int $teamStatisticGameId Id of the game that the statistic is coming from
		* @throws \InvalidArgumentException if data types are not valid
		* @throws \RangeException if data values are out of bouds (e.g, strings to long, negative intergers)
		* @throws \TypeError if data types violate type hints
		* @throws \Exception if some other exception occurs
	 */

	public function __construct(int $teamStatisticId = null, int $newteamStatisticTeamId, int $newteamStatisticValue, int $newStatisticStatisticId, int $newteamStatisticGameId = null) {
		try {
			$this->setTeamStatisticTeamId($newteamStatisticTeamId);
			$this->setTeamStatisticValue($newteamStatisticValue);
			$this->setTeamStatisticStatisticId($newteamStatisticStatisticId);
			$this->setTeamStatisticGameId($newteamStatisticGameId);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow exception to caller
			throw(new \InvalidArgumetException($invalidArgument->getMessage(), 0, $invalidArgument));
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

}

/**
 * @param $teamStatisticTeamId
 * @param InvalidArgumentExceptioin if team statistic team id is not an integer
 * @throws RangeException if team statistic team id is negatice
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
				throw (new RangeException("player statistic Id must be postive"));
				{
					$this->teamStatisticTeamId = $teamStatisticTeamId;
				}
			}
		}

	/**
	 * accessor for team statistic team Id
	 * @return int value of team statistic team Id
	 *
	 */
			public function getTeamStatisticValue() {
				return $this->teamStatisticValue;
			}

	/**
	 * @param int $teamStatisticValue new values of team statistic value
	 * @throws InvalidArgumentException if statistic team Id is not an integer
	 * @throws RangeException if statistic team id is negative
	 */

			public function setTeamStatisticValue($teamStatisticValue) {
				if ($teamStatisticValue === null) {
					$this->teamStatisticValue = null;
					return;
				}
				$teamStatisticValue = filter_var($teamStatisticValue, FILTER_VALIDATE_INT);
				if ($teamStatisticValue == false) {
				}
				if ($teamStatisticValue <=0) {
					throw (new RangeException("player statistic value must be positive"));
					{
						$this->teamStatisticValue = $teamStatisticValue;
					}
				}
			}

	/**
	 * accessor for team statistic team Id
	 * @return int value of team statistic team Id
	 */

			public function getTeamStastisticStatisticId() {
				return $this->teamStastisticStatisticId;

				/**
				 * @param int $teamStastisticStatisticId new values of team statistic value
				 * @throws InvalidArgumentException if statistic team Id is not an integer
				 * @throws RangeException if statistic is negative
				 */

				public function setTeamStastisticStatisticId ($teamStastisticStatisticId) {
					if($teamStastisticStatisticId === null) {
						$this->teamStastisticStatisticId = null;
						return;
					}
					$teamStastisticStatisticId = filter_var($teamStastisticStatisticId, FILTER_VALIDATE_INT);
					if ($teamStastisticStatisticId == false) {
					}
					if ($teamStastisticStatisticId <=0) {
						throw (new RangeException("team statistic must be posititve"));
					}
					$this->teamStastisticStatisticId = $teamStastisticStatisticId;
				}
			}

	/**
	 * accessor for team statistic team id
	 * @return int value of team statistic team Id
	 */
			public function getTeamStatisticGameId() {
				return $this->teamStatisticGameId;
				/**
				 * @param int $teamStatisticGameId new values of team statistic value
				 * @throws InvalidArgumentException if statistic team Id is not an integer
				 * @throws RangeException if statistic is negative
				 */
				public
				function setteamStatisticGameId($teamStatisticGameId) {
					if($teamStatisticGameId === null) {
						$this->teamStatisticGameId = null;
						return;
					}
					$teamStatisticGameId = filter_var($teamStatisticGameId, FILTER_VALIDATE_INT);
					if($teamStatisticGameId == false) {
					}
					if($teamStatisticGameId <= 0) {
						throw (new RangeException("team statistic must be positive"));
					}
					$this->teamStatisticGameId = $teamStatisticGameId;
				}
			}

/**
 * inserts this team statistic into mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function insert(\PDO $pdo) {
	// enforce the playerId is null (i.e., dont insert a statistic that already exists
	if($this->(setTeamStatisticTeamId !null) {
		throw(new \PDOException("not a new statistic"));
	}

		// create query template
		$query = "INSERT INTO teamstatistic(pl, teamstatisticteamId) VALUES(:teamstatisticteamId, :teamStatisticValue, :teamStastisticStatisticId, :teamStatisticGameId)";
		$statement = $pdo->prepare($query);

		// update the null teamstatisticteamId with what mySql just gave us
		$this->teamstatisticteamId = interval($pdo->lastInsertId());

	}

/**
 * updates this teamstatistic in mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function update(\PDO $pdo) {
	if($this->teamstatisticteamId === null) {
		throw(new \PDOException("unable to update a player that does not exist"));
	}
	$query = "UPDATE teamstatistic SET teamstatisticteamId = :teamstatisticteamId, teamStatisticValue = :teamStatisticValue, teamStastisticStatisticId = :teamStastisticStatisticId, teamStatisticGameId = :teamStatisticGameId WHERE teamstatisticteamId = :teamstatisticteamId";
	$statement = $pdo->prepare($query);


	$formattedDate = $this->teamstatisticteamId->format("Y-m-d H:i:s");
	$parameters = ["teamstatisticteamId" => $this->teamstatisticteamId, "teamStatisticValue" => $this->teamStatisticValue, "teamStastisticStatisticId" => $teamStastisticStatisticId, "teamStatisticGameId" => $this->teamStatisticGameId];
	$statement->execute($parameters);
}



/**
 * deletes teamstatistic from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 *
 **/
public function delete(\PDO $pdo) {
	//enforce the teamstatisticteamId is not null (i.e., don't delete a statistic that hasn't been inserted)
	if($this->teamstatisticteamId === null) {
		throw(new \PDOException("unable to delete a statistic that does not exist"));
	}

	// create query template
	$query = "DELETE FROM statistic WHERE teamstatisticteamId = :teamstatisticteamId";
	$statement = $pdo->prepare($query);
	$statement->execute($parameter);
}

	/**
	 * accessor for team statistic game Id
	 * @return int value of team statistic game Id
	 */
		}


