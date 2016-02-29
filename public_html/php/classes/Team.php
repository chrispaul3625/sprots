<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * A Team, This will be a Team that is being monitored by our stats and participates in competing with other teams.
 *
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class Team {


	/**
	 * id for this Team; this is the primary key
	 * @var int $teamId
	 **/
	private $teamId;
	/**
	 * teamApiId, one Api id per Team.
	 * @var int $teamApiId
	 **/
	private $teamApiId;
	/**
	 * teamCity, one city per Team.
	 * @var string $teamCity
	 **/
	private $teamCity;
	/**
	 * teamName, one Team name per Team.
	 * @var string $teamName
	 **/
	private $teamName;
	/**
	 * SportId, one Sport id per Team
	 * @var int $sportId
	 */
	private $teamSportId;


	/**
	 * Constructor for this Team
	 *
	 * @param int|null $newTeamId id of the Team that is being created
	 * @param int $newTeamSportId Id that is associated with the Sport
	 * @param int $newTeamApiId Api id that is associated with Team
	 * @param string $newTeamCity city associated with Team
	 * @param string $newTeamName name associated with Team
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 */

	public function __construct(int $newTeamId = null, int $newTeamSportId, int $newTeamApiId, string $newTeamCity, string $newTeamName) {
		try {
			$this->setTeamId($newTeamId);
			$this->setTeamApiId($newTeamApiId);
			$this->setTeamCity($newTeamCity);
			$this->setTeamName($newTeamName);
			$this->setTeamSportId($newTeamSportId);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		} catch(\TypeError $typeError) {
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		}
	}


	/**
	 *accessor method for teamId
	 *
	 * @return int|null value of Team id
	 **/
	public function getTeamId() {
		return ($this->teamId);
	}

	/**
	 * mutator method for Team id
	 *
	 * @param int|null $newTeamId new value of Team id
	 * @throws \RangeException if the $newTeamId is not positive
	 * @throws \TypeError if $newTeamId is not an integer
	 **/
	public function setTeamId(int $newTeamId = null) {
		// base case: if teamId is null, this is a new Team without a MySQL assigned id (yet)
		if($newTeamId === null) {
			$this->teamId = null;
			return;
		}

		// Verify the Team id is positive
		if($newTeamId <= 0) {
			throw(new \RangeException("Team id is not positive"));
		}

		// Convert and store the Team id
		$this->teamId = $newTeamId;
	}

	/**
	 *accessor method for Team Api id
	 *
	 * @return int|null value of Team api id
	 **/
	public function getTeamApiId() {
		return ($this->teamApiId);
	}

	/**
	 * mutator method for Team Api id
	 *
	 * @param int|null $newTeamApiId new value of Team Api id
	 * @throws \RangeException if the $newTeamApiId is not positive
	 * @throws \TypeError if $newTeamApiId is not an integer
	 **/
	public function setTeamApiId(int $newTeamApiId) {
		// Verify the Team id is positive
		if($newTeamApiId <= 0) {
			throw(new \RangeException("Team api id is not positive"));
		}
		// Convert and store the Team api id
		$this->teamApiId = $newTeamApiId;
	}

	/**
	 * accessor method for Team city
	 *
	 * @return string value of Team city
	 **/
	public function getTeamCity() {
		return ($this->teamCity);
	}

	/**
	 * mutator method for Team city
	 *
	 * @param string $newTeamCity new value of Team city
	 * @throws \InvalidArgumentException if $newTeamCity is not a string or insecure
	 * @throws \RangeException if $newTeamCity is >32 characters
	 * @throws \TypeError if $newTeamCity is not a string
	 **/
	public function setTeamCity(string $newTeamCity) {
		//verify the Team city name is secure
		$newTeamCity = trim($newTeamCity);
		$newTeamCity = filter_var($newTeamCity, FILTER_SANITIZE_STRING);
		if(empty($newTeamCity) === true) {
			throw(new \InvalidArgumentException("Team name is empty or insecure"));
		}
		//verify the Team city name will fit in the database
		if(strlen($newTeamCity) > 32) {
			throw(new \RangeException("Team city name is too large"));
		}
		// store the new Team city name
		$this->teamCity = $newTeamCity;
	}

	/**
	 * accessor method for Team name
	 *
	 * @return string value of Team name
	 **/

	public function getTeamName() {
		return ($this->teamName);
	}

	/**
	 * mutator method for Team name
	 *
	 * @param string $newTeamName new value of Team name
	 * @throws \InvalidArgumentException if $newTeamName is not a string or insecure
	 * @throws \RangeException if $newTeamName is >32 characters
	 * @throws \TypeError if $newTeamName is not a string
	 **/

	public function setTeamName(string $newTeamName) {
		//verify the Team name is secure
		$newTeamName = trim($newTeamName);
		$newTeamName = filter_var($newTeamName, FILTER_SANITIZE_STRING);
		if(empty($newTeamName) === true) {
			throw(new \InvalidArgumentException("Team name is empty or insecure"));
		}
		//verify the Team name will fit in the database
		if(strlen($newTeamName) > 32) {
			throw(new \RangeException("Team name is too large"));
		}
		// store the new Team name
		$this->teamName = $newTeamName;
	}

	/**
	 *accessor method for teamSportId
	 *
	 * @return int|null value of Team Sport id
	 **/
	public function getTeamSportId() {
		return ($this->teamSportId);
	}

	/**
	 * mutator method for Team Sport id
	 *
	 * @param int|null $newTeamSportId new value of Team Sport id
	 * @throws \RangeException if the $newTeamSportId is not positive
	 * @throws \TypeError if $newTeamSportId is not an integer
	 **/
	public function setTeamSportId(int $newTeamSportId) {
		// Verify the Team id is positive
		if($newTeamSportId <= 0) {
			throw(new \RangeException("Team Sport id is not positive"));
		}
		// Convert and store the Team id
		$this->teamSportId = $newTeamSportId;
	}


	/**
	 * inserts this Team into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforces that Team id is null (i.e., don't insert a Team that already exists.
		if($this->teamId !== null) {
			throw(new \PDOException("not a new Team"));
		}

		// create query template
		$query = "INSERT INTO Team(teamSportId, teamApiId, teamCity, teamName) VALUES(:teamSportId, :teamApiId, :teamCity, :teamName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["teamSportId" => $this->teamSportId, "teamApiId" => $this->teamApiId, "teamCity" => $this->teamCity, "teamName" => $this->teamName];
		$statement->execute($parameters);

		// update the null teamId with what mySQL just gave us
		$this->teamId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes Team from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo) {
		// enforce the Team id is not null (i.e., don't delete a Team that hasn't been inserted)
		if($this->teamId === null) {
			throw(new \PDOException("unable to delete a Team that does not exist"));
		}
		// create query template
		$query = "DELETE FROM Team WHERE teamId = :teamId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["teamId" => $this->teamId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Team in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function update(\PDO $pdo) {
		//enforce the teamId is not null (i.e., don't update a Team that hasn't been inserted)
		if($this->teamId === null) {
			throw(new \PDOException("Unable to update a Team that does not exist"));
		}

		// Create query template
		$query = "UPDATE Team SET teamSportId = :teamSportId, teamApiId = :teamApiId, teamCity = :teamCity, teamName = :teamName";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["teamSportId" => $this->teamSportId, "teamApiId" => $this->teamApiId, "teamCity" => $this->teamCity, "teamName" => $this->teamName,];
		$statement->execute($parameters);
	}

	/**
	 * gets the Team by teamId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamId Team id to search for
	 * @return Team|null Team found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getTeamByTeamId(\PDO $pdo, int $teamId) {
		// sanitize the teamId before searching
		if($teamId <= 0) {
			throw(new \PDOException("Team id is not positive"));
		}
		// Create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM Team WHERE teamId = :teamId";
		$statement = $pdo->prepare($query);

		// Bind the Team id to the place holder in the template
		$parameters = array("teamId" => $teamId);
		$statement->execute($parameters);

		// Grab the Team from mySQL
		try {
			$team = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$team = new Team($row["teamId"], $row["teamSportId"], $row["teamApiId"], $row["teamCity"], $row["teamName"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($team);
	}


	/**
	 * gets the Team by teamApiId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamApiId Team Api id to search for
	 * @return Team|null Team found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getTeamByTeamApiId(\PDO $pdo, int $teamApiId) {
		// sanitize the teamApiId before searching
		if($teamApiId <= 0) {
			throw(new \PDOException("Team Api id is not positive"));
		}
		// Create query template
		$query = "SELECT teamId,  teamSportId, teamApiId, teamCity, teamName FROM Team WHERE teamApiId = :teamApiId";
		$statement = $pdo->prepare($query);

		// Bind the Team id to the place holder in the template
		$parameters = array("teamApiId" => $teamApiId);
		$statement->execute($parameters);

		// Grab the Team from mySQL
		try {
			$team = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$team = new Team($row["teamId"], $row["teamSportId"], $row["teamApiId"], $row["teamCity"], $row["teamName"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($team);
	}


	/**
	 * gets the Team by teamCity
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $teamCity Team City to search for
	 * @return \SplFixedArray SplFixedArray of Team found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getTeamByTeamCity(\PDO $pdo, string $teamCity) {
		// sanitize the description before searching
		$teamCity = trim($teamCity);
		$teamCity = filter_var($teamCity, FILTER_SANITIZE_STRING);
		if(empty($teamCity) === true) {
			throw(new \PDOException("Team city is invalid"));
		}

		// create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM Team WHERE teamCity LIKE :teamCity";
		$statement = $pdo->prepare($query);


		// bind the Team city to the place holder in the template
		$teamCity = "%$teamCity%";
		$parameters = array("teamCity" => $teamCity);
		$statement->execute($parameters);

		// build an array of Team cities
		$teamCities = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$teamCity = new team ($row["teamId"], $row["teamSportId"], $row["teamApiId"], $row["teamCity"], $row["teamName"]);
				$teamCities[$teamCities->key()] = $teamCity;
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($teamCities);

	}

	/**
	 * gets the Team by teamName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $teamName Team Name to search for
	 * @return \SplFixedArray SplFixedArray of Team found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getTeamByTeamName(\PDO $pdo, string $teamName) {
		// sanitize the description before searching
		$teamName = trim($teamName);
		$teamName = filter_var($teamName, FILTER_SANITIZE_STRING);
		if(empty($teamName) === true) {
			throw(new \PDOException("Team name is invalid"));
		}

		// create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM Team WHERE teamName LIKE :teamName";
		$statement = $pdo->prepare($query);


		// bind the Team name to the place holder in the template
		$teamName = "%$teamName%";
		$parameters = array("teamName" => $teamName);
		$statement->execute($parameters);

		// build an array of Team Names
		$teamNames = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		While(($row = $statement->fetch()) !== false) {
			try {
				$teamName = new team($row["teamId"], $row["teamSportId"], $row["teamApiId"], $row["teamCity"], $row["teamName"]);
				$teamNames[$teamNames->key()] = $teamName;
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($teamNames);

	}

	/**
	 * gets all Teams
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Teams found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAllTeams(\PDO $pdo) {
		//create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM Team";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of teams
		$teams = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$team = new Team($row["teamId"], $row["teamSportId"], $row["teamApiId"], $row["teamCity"], $row["teamName"]);
				$teams[$teams->key()] = $team;
				$teams->next();
			} Catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($teams);
	}


}