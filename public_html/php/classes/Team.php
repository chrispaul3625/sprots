<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * A team, This will be a team that is being monitored by our stats and participates in competing with other teams.
 *
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class Team {


	/**
	 * id for this team; this is the primary key
	 * @var int $teamId
	 **/
	private $teamId;
	/**
	 * teamApiId, one Api id per team.
	 * @var int $teamApiId
	 **/
	private $teamApiId;
	/**
	 * teamCity, one city per team.
	 * @var string $teamCity
	 **/
	private $teamCity;
	/**
	 * teamName, one team name per team.
	 * @var string $teamName
	 **/
	private $teamName;
	/**
	 * SportId, one sport id per team
	 * @var int $sportId
	 */
	private $teamSportId;


	/**
	 * Constructor for this team
	 *
	 * @param int|null $newTeamId id of the team that is being created
	 * @param int $newTeamSportId Id that is associated with the sport
	 * @param int $newTeamApiId Api id that is associated with team
	 * @param string $newTeamCity city associated with team
	 * @param string $newTeamName name associated with team
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
	 * @return int|null value of team id
	 **/
	public function getTeamId() {
		return ($this->teamId);
	}

	/**
	 * mutator method for team id
	 *
	 * @param int|null $newTeamId new value of team id
	 * @throws \RangeException if the $newTeamId is not positive
	 * @throws \TypeError if $newTeamId is not an integer
	 **/
	public function setTeamId(int $newTeamId = null) {
		// base case: if teamId is null, this is a new team without a MySQL assigned id (yet)
		if($newTeamId === null) {
			$this->teamId = null;
			return;
		}

		// Verify the team id is positive
		if($newTeamId <= 0) {
			throw(new \RangeException("team id is not positive"));
		}

		// Convert and store the team id
		$this->teamId = $newTeamId;
	}

	/**
	 *accessor method for team Api id
	 *
	 * @return int|null value of team api id
	 **/
	public function getTeamApiId() {
		return ($this->teamApiId);
	}

	/**
	 * mutator method for team Api id
	 *
	 * @param int|null $newTeamApiId new value of team Api id
	 * @throws \RangeException if the $newTeamApiId is not positive
	 * @throws \TypeError if $newTeamApiId is not an integer
	 **/
	public function setTeamApiId(int $newTeamApiId) {
// Verify the team id is positive
		if($newTeamApiId <= 0) {
			throw(new \RangeException("team api id is not positive"));
		}
// Convert and store the team api id
		$this->teamApiId = $newTeamApiId;
	}

	/**
	 * accessor method for team city
	 *
	 * @return string value of team city
	 **/
	public function getTeamCity() {
		return ($this->teamCity);
	}

	/**
	 * mutator method for team city
	 *
	 * @param string $newTeamCity new value of team city
	 * @throws \InvalidArgumentException if $newTeamCity is not a string or insecure
	 * @throws \RangeException if $newTeamCity is >32 characters
	 * @throws \TypeError if $newTeamCity is not a string
	 **/
	public function setTeamCity(string $newTeamCity) {
		//verify the team city name is secure
		$newTeamCity = trim($newTeamCity);
		$newTeamCity = filter_var($newTeamCity, FILTER_SANITIZE_STRING);
		if(empty($newTeamCity) === true) {
			throw(new \InvalidArgumentException("team name is empty or insecure"));
		}
//verify the team city name will fit in the database
		if(strlen($newTeamCity) > 32) {
			throw(new \RangeException("team city name is too large"));
		}
// store the new team city name
		$this->teamCity = $newTeamCity;
	}

	/**
	 * accessor method for team name
	 *
	 * @return string value of team name
	 **/

	public function getTeamName() {
		return ($this->teamName);
	}

	/**
	 * mutator method for team name
	 *
	 * @param string $newTeamName new value of team name
	 * @throws \InvalidArgumentException if $newTeamName is not a string or insecure
	 * @throws \RangeException if $newTeamName is >32 characters
	 * @throws \TypeError if $newTeamName is not a string
	 **/

	public function setTeamName(string $newTeamName) {
		//verify the team name is secure
		$newTeamName = trim($newTeamName);
		$newTeamName = filter_var($newTeamName, FILTER_SANITIZE_STRING);
		if(empty($newTeamName) === true) {
			throw(new \InvalidArgumentException("team name is empty or insecure"));
		}
//verify the team name will fit in the database
		if(strlen($newTeamName) > 32) {
			throw(new \RangeException("team name is too large"));
		}
// store the new team name
		$this->teamName = $newTeamName;
	}

	/**
	 *accessor method for teamSportId
	 *
	 * @return int|null value of team sport id
	 **/
	public function getTeamSportId() {
		return ($this->teamSportId);
	}

	/**
	 * mutator method for team sport id
	 *
	 * @param int|null $newTeamSportId new value of team sport id
	 * @throws \RangeException if the $newTeamSportId is not positive
	 * @throws \TypeError if $newTeamSportId is not an integer
	 **/
	public function setTeamSportId(int $newTeamSportId) {
// Verify the team id is positive
		if($newTeamSportId <= 0) {
			throw(new \RangeException("team sport id is not positive"));
		}
// Convert and store the team id
		$this->teamSportId = $newTeamSportId;
	}


	/**
	 * inserts this team into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforces that team id is null (i.e., don't insert a team that already exists.
		if($this->teamId !== null) {
			throw(new \PDOException("not a new team"));
		}

		// create query template
		$query = "INSERT INTO team(teamSportId, teamApiId, teamCity, teamName) VALUES(:teamSportId, :teamApiId, :teamCity, :teamName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["teamSportId" => $this->teamSportId, "teamApiId" => $this->teamApiId, "teamCity" => $this->teamCity, "teamName" => $this->teamName];
		$statement->execute($parameters);

		// update the null teamId with what mySQL just gave us
		$this->teamId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes team from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo) {
// enforce the team id is not null (i.e., don't delete a team that hasn't been inserted)
		if($this->teamId === null) {
			throw(new \PDOException("unable to delete a team that does not exist"));
		}
		// create query template
		$query = "DELETE FROM team WHERE teamId = :teamId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["teamId" => $this->teamId];
		$statement->execute($parameters);
	}

	/**
	 * updates this team in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function update(\PDO $pdo) {
		//enforce the teamId is not null (i.e., don't update a team that hasn't been inserted)
		if($this->teamId === null) {
			throw(new \PDOException("Unable to update a team that does not exist"));
		}

		// Create query template
		$query = "UPDATE team SET teamSportId = :teamSportId, teamApiId = :teamApiId, teamCity = :teamCity, teamName = :teamName";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["teamSportId" => $this->teamSportId, "teamApiId" => $this->teamApiId, "teamCity" => $this->teamCity, "teamName" => $this->teamName, ];
		$statement->execute($parameters);
	}

	/**
	 * gets the Team by teamId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamId team id to search for
	 * @return Team|null Team found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getTeamByTeamId(\PDO $pdo, int $teamId) {
		// sanitize the teamId before searching
		if($teamId <= 0) {
			throw(new \PDOException("team id is not positive"));
		}
		// Create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM team WHERE teamId = :teamId";
		$statement = $pdo->prepare($query);

		// Bind the team id to the place holder in the template
		$parameters = array("teamId" => $teamId);
		$statement->execute($parameters);

		// Grab the team from mySQL
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
	 * @param int $teamApiId team Api id to search for
	 * @return Team|null Team found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getTeamByTeamApiId(\PDO $pdo, int $teamApiId) {
		// sanitize the teamApiId before searching
		if($teamApiId <= 0) {
			throw(new \PDOException("team Api id is not positive"));
		}
		// Create query template
		$query = "SELECT teamId,  teamSportId, teamApiId, teamCity, teamName FROM team WHERE teamApiId = :teamApiId";
		$statement = $pdo->prepare($query);

		// Bind the team id to the place holder in the template
		$parameters = array("teamApiId" => $teamApiId);
		$statement->execute($parameters);

		// Grab the team from mySQL
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
	 * @param string $teamCity team City to search for
	 * @return \SplFixedArray SplFixedArray of team found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getTeamByTeamCity(\PDO $pdo, string $teamCity) {
// sanitize the description before searching
		$teamCity = trim($teamCity);
		$teamCity = filter_var($teamCity, FILTER_SANITIZE_STRING);
		if(empty($teamCity) === true) {
			throw(new \PDOException("team city is invalid"));
		}

		// create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM team WHERE teamCity LIKE :teamCity";
		$statement = $pdo->prepare($query);


		// bind the team city to the place holder in the template
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
	 * @param string $teamName team Name to search for
	 * @return \SplFixedArray SplFixedArray of team found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getTeamByTeamName(\PDO $pdo, string $teamName) {
// sanitize the description before searching
		$teamName = trim($teamName);
		$teamName = filter_var($teamName, FILTER_SANITIZE_STRING);
		if(empty($teamName) === true) {
			throw(new \PDOException("team name is invalid"));
		}

		// create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM team WHERE teamName LIKE :teamName";
		$statement = $pdo->prepare($query);


		// bind the team name to the place holder in the template
		$teamName = "%$teamName%";
		$parameters = array("teamName" => $teamName);
		$statement->execute($parameters);

		// build an array of Team Names
		$teamNames = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		While(($row = $statement->fetch()) !== false) {
			try {
				$teamName = new team($row["teamId"],$row["teamSportId"], $row["teamApiId"], $row["teamCity"], $row["teamName"]);
				$teamNames[$teamNames->key()] = $teamName;
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($teamNames);

	}

	/**
	 * gets the Team by teamSportId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamSportId team sport id to search for
	 * @return Team|null Team found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getTeamByTeamSportId(\PDO $pdo, int $teamSportId) {
		// sanitize the teamApiId before searching
		if($teamSportId <= 0) {
			throw(new \PDOException("team Sport id is not positive"));
		}
		// Create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM team WHERE teamSportId = :teamSportId";
		$statement = $pdo->prepare($query);

		// Bind the team id to the place holder in the template
		$parameters = array("teamSportId" => $teamSportId);
		$statement->execute($parameters);

		// Grab the team from mySQL
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
	 * gets all Teams
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Teams found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAllTeams(\PDO $pdo) {
		//create query template
		$query = "SELECT teamId, teamSportId, teamApiId, teamCity, teamName FROM team";
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