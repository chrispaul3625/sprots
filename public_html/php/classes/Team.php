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
	 * Constructor for this team
	 *
	 * @param int|null $newTeamId id of the team that is being created
	 * @param string $newTeamCity city associated with team
	 * @param string $newTeamName name associated with team
	 * @param int $newTeamApiId Api id that is associated with team
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newTeamId = null, string $newTeamCity, string $newTeamName, int $newTeamApiId = null) {
		try {
			$this->setTeamId($newTeamId);
			$this->setTeamApiId($newTeamApiId);
			$this->setTeamCity($newTeamCity);
			$this->setTeamName($newTeamName);
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
	public function setTeamApiId(int $newTeamApiId = null) {
		// base case: if teamApiId is null, this is a new team without a MySQL assigned id (yet)
		if($newTeamApiId === null) {
			$this->teamApiId = null;
			return;
		}
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
		$this->$newTeamCity = $newTeamCity;
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
		$this->$newTeamName = $newTeamName;
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
		$query = "INSERT INTO team(teamApiId, teamCity, teamName) VALUES(:teamApiId, :teamCity, :teamName)";
		$statement = $pdo->prepare($query);
//bind the member variables to the place holders in the template
		$parameters = ["teamApiId" => $this->teamApiId, "teamCity" => $this->teamCity, "teamName" => $this->teamName];
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
// enforce the team id is not null (i.e., don't delete a tweet that hasn't been inserted)
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

	public
	function update(\PDO $pdo) {
		//enforce the teamId is not null (i.e., don't update a team that hasn't been inserted)
		if($this->teamId === null) {
			throw(new \PDOException("Unable to update a team that does not exist"));
		}

		// Create query template
		$query = "UPDATE team SET teamApiId = :teamApiId, teamCity = :teamCity, teamName = :teamName";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["teamApiId" => $this->teamApiId, "teamCity" => $this->teamCity, "teamName" => $this->teamName];
		$statement->execute($parameters);
	}
	/**
	 * gets the Team by team Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $teamId teamId to search for
	 * @return \SplFixedArray SplFixedArray of team found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getTeamByTeamId(\PDO $pdo, int $teamId)[
// sanitize the description before searching
$teamId = trim

]





}