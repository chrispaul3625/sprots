<?php

require_once("autoload.php");

/**
 * TeamStatistic, This is a field in which all statistics related to a team are going to be held.
 *
 * @author Jude Chavez <Chavezjude7@gmail.com>
 */
class TeamStatistic {
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
	 * @param int $teamStatisticId
	 * @param int $newTeamStatisticTeamId
	 * @param int $newTeamStatisticValue
	 * @param int $newTeamStatisticStatisticId
	 * @param int $newTeamStatisticGameId
	 * @throws Exception if some other exception occurs
	 * @throws InvalidArgumetException
	 * @internal param int|null $teamStatisticTeam of this teamStatistic or null if a New Player
	 * @internal param int $teamStatisticTeamId Id of the teamStatistic
	 * @internal param int $teamStatisticValue Statistic value of the Team
	 * @internal param int $teamStatisticStatisticId Id of the Statistic being called
	 * @internal param int $teamStatisticGameId Id of the Game that the Statistic is coming from
	 */

	public function __construct(int $teamStatisticId = null, int $newTeamStatisticTeamId, int $newTeamStatisticValue, int $newTeamStatisticStatisticId, int $newTeamStatisticGameId = null) {
		try {
			$this->setTeamStatisticTeamId($newTeamStatisticTeamId);
			$this->setTeamStatisticValue($newTeamStatisticValue);
			$this->setTeamStatisticStatisticId($newTeamStatisticStatisticId);
			$this->setTeamStatisticGameId($newTeamStatisticGameId);
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



	/**
	 * @param $teamStatisticTeamId
	 * @param InvalidArgumentExceptioin if teamStatisticTeamId is not an integer
	 * @throws RangeException if teamStatistic TeamId is negatice
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
				throw (new RangeException("PlayerStatisticId must be postive"));
				{
					$this->teamStatisticTeamId = $teamStatisticTeamId;
				}
			}
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
	 * @throws InvalidArgumentException if Statistic TeamId is not an integer
	 * @throws RangeException if StatisticTeamId is negative
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
					throw (new RangeException("PlayerStatisticValue must be positive"));
						$this->teamStatisticValue = $teamStatisticValue;
				}
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
				 * @throws InvalidArgumentException if StatisticTeamId is not an integer
				 * @throws RangeException if Statistic is negative
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
				throw (new RangeException("TeamStatistic must be posititve"));
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
				 * @throws InvalidArgumentException if StatisticTeamId is not an integer
				 * @throws RangeException if Statistic is negative
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
						throw (new RangeException("TeamStatistic must be positive"));
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
		$query = "INSERT INTO teamStatistic(playerId, teamStatisticTeamId) VALUES(:teamStatisticTeamId, :teamStatisticValue, :teamStatisticStatisticId, :teamStatisticGameId)";
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
	$query = "UPDATE teamStatistic SET teamStatisticTeamId = :teamStatisticTeamId, teamStatisticValue = :teamStatisticValue, teamStatisticStatisticId = :teamStatisticStatisticId, teamStatisticGameId = :teamStatisticGameId WHERE teamStatisticTeamId = :TeamStatisticTeamId";
	$statement = $pdo->prepare($query);
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
	 * accessor for teamStatisticGameId
	 * @return int value of teamStatisticGameId
	 */

}



