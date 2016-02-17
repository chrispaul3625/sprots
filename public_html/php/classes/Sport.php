<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * This will be the class for our 4 chosen sports. NFL, MLB, NBA, and EPL.
 *
 * @author Dom Kratos <mr.kratos85@gmail.com>
 */
class Sport {
	/**
	 * id for the sport
	 * @var int $sportId
	 **/
	private $sportId;

	/**
	 * this identifies the league of the particular sport. Western Eastern conference etc.
	 * @var string $sportLeague
	 */
	private $sportLeague;

	/**
	 * Name of the team
	 * @var string $sportTeam
	 */
	private $sportTeam;


	/**
	 *Constructor for sport class
	 *
	 * @param int|null $newSportId id of the sport or null if its a new sport
	 * @param string $newSportTeam Name of team in particular sport
	 * @param string $newSportLeague League to which the sport belongs
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data is out of predetermined range
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newSportId = null, string $newSportLeague, string $newSportTeam) {
		try {
			$this->setSportId($newSportId);
			$this->setSportLeague($newSportLeague);
			$this->setSportTeam($newSportTeam);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for sport id
	 *
	 * @return int|null value of sport id
	 **/
	public function getSportId() {
		return ($this->sportId);
	}

	/**
	 * Mutator method for sport id
	 * @param int|null $newSportId new value of sport id
	 * @throws \RangeException if $newSportId is not positive
	 * @throws \TypeError if $newSportId is not an integer
	 **/
	public function setSportId(int $newSportId = null) {
		if($newSportId === null) {
			$this->sportId = null;
			return;
		}
		// verify the sport id is positive
		if($newSportId <= 0) {
			throw(new \RangeException("sport id is not positive"));
		}
		//convert and store the new sport id
		$this->sportId = $newSportId;
	}

	/**
	 * accessor method for sport leage
	 *
	 * @return string value of sport league
	 */
	public function getSportLeague() {
		return ($this->sportLeague);
	}

	/**
	 * mutator method for sport league
	 *
	 * @param string *newSportLeague new value of the sports league
	 * @throws \InvalidArgumentException if $newSportLeague is not a string, or is insecure
	 * @throws \RangeException if $newSportLeague is >32 characters
	 * @throws \TypeError if $newSportLeage is not a string
	 **/
	public function setSportLeague(string $newSportLeague) {
		//verify that the sport leaguue is in a secure format
		$newSportLeague = trim($newSportLeague);
		$newSportLeague = filter_var($newSportLeague, FILTER_SANITIZE_STRING);
		if(empty($newSportLeague) === true) {
			throw(new\InvalidArgumentException("sport league is empty, or not secure"));
		}
		//verify that the team league will fit in the db
		if(strlen($newSportLeague) > 32) {
			throw(new \RangeException("league name is too large"));
		}
		//if the above two pass, go ahead and store it in the db
		$this->sportLeague = $newSportLeague;
	}

	/**
	 * accessor method for sport team
	 *
	 * @return string value of sport team name
	 **/
	public function getSportTeam() {
		return ($this->sportTeam);
	}

	/**
	 * mutator method for sport team name
	 *
	 * @param string $newSportTeam new value of sport team name
	 * @throws \InvalidArgumentException if $newSportTeam is not a string or insecure
	 * @throws \RangeException if $newSportTeam is >32 characters
	 * @throws \TypeError if $newTeamName is not a string
	 **/
	public function setSportTeam(string $newSportTeam) {
		//verify that the content is secure
		$newSportTeam = trim($newSportTeam);
		$newSportTeam = filter_var($newSportTeam, FILTER_SANITIZE_STRING);
		if(empty($newSportTeam) === true) {
			throw(new \InvalidArgumentException("sport team name is empty, or insecure"));
		}

		//verify that the team name will fit in the database
		if(strlen($newSportTeam) > 32) {
			throw(new \RangeException("team name is too large"));
		}

		//if the above two pass, go ahead and store it in the db
		$this->sportTeam = $newSportTeam;
	}

	/**
	 * inserts this sport into the db
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when db related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		//enforce the sportId is null example: don't insert a sport that already exists
		if($this->sportId !== null) {
			throw(new \PDOException("sport already exists"));
		}

		//create query template
		$query = "INSERT INTO sport(sportLeague, sportTeam) VALUES(:sportLeague, :sportTeam)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["sportLeague" => $this->sportLeague, "sportTeam" => $this->sportTeam];
		$statement->execute($parameters);

		//update the null sportId with what mySQL just gave us
		$this->sportId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this sport from db
	 *
	 * @para \PDO $pdo PDO connection object
	 * @throws \PDOException when db related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce that the sportId is not null
		if($this->sportId === null) {
			throw(new \PDOException("unable to delete a sport that doesn't exist"));
		}

		//query template
		$query = "DELETE FROM sport WHERE sportId = :sportId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder
		$parameters = ["sportId" => $this->sportId];
		$statement->execute($parameters);
	}

	/**
	 * updates this sport in db
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// encforce that the sportId is not null
		if($this->sportId === null) {
			throw(new \PDOException("cant update sport that doesn't exist"));
		}
		//query template
		$query = "UPDATE sport SET SportLeague = :sportLeague, sportTeam = :sportTeam WHERE sportId = :sportId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["sportLeague" => $this->sportLeague, "sportTeam" => $this->sportTeam, "sportId" => $this->sportId];
		$statement->execute($parameters);
	}

	/**
	 * gets the sport by sport league
	 *
	 * @param \PDO $pdo connection object
	 * @param string $sportLeague sport league to search for
	 * @return \SplFixedArray SplFixedArray of sports found
	 * @throws \PDOException when db related errors occur
	 * @throws \TypeError when variables are not correct data type
	 **/
	public static function getSportBySportLeague(\PDO $pdo, string $sportLeague) {
		// sanitize the description before searching
		$sportLeague = trim($sportLeague);
		$sportLeague = filter_var($sportLeague, FILTER_SANITIZE_STRING);
		if(empty($sportLeague) === true) {
			throw(new \PDOException("that league is invalid"));
		}

		//create query template
		$query = "SELECT sportId, sportLeague, sportTeam FROM sport WHERE sportLeague LIKE :sportLeague";
		$statement = $pdo->prepare($query);

		//bind the sport league to the place holder in the template
		$sportLeague = "%$sportLeague%";
		$parameters = array("sportLeague" => $sportLeague);
		$statement->execute($parameters);

		//build array of sport leagues
		$sportLeagues = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$sportLeague = new Sport($row["sportId"], $row["sportLeague"], $row["sportTeam"]);
				$sportLeagues[$sportLeagues->key()] = $sportLeague;
				$sportLeagues->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($sportLeagues);
		}
	}

	/**
	* gets the sport by the sport team
	*
	* @param \PDO $pdo connection object
	* @param string $sportTeam sport Team to search for
	* @return \SplFixedArray SplFixedArray of teams found
	* @throws \PDOException when db related errors occur
	* @throws \TypeError when variables are not correct data type
	**/
	public static function getSportBySportTeam(\PDO $pdo, string $sportTeam) {
		// sanitize the description before searching
		$sportTeam = trim($sportTeam);
		$sportTeam = filter_var($sportTeam, FILTER_SANITIZE_STRING);
		if(empty($sportTeam) === true) {
			throw(new \PDOException("That team is invalid"));
		}

		// create query template
		$query = "SELECT sportId, sportTeam, sportLeague FROM sport WHERE sportTeam LIKE :sportTeam";
		$statement = $pdo->prepare($query);

		// bind the sport team to the place holder in the template
		$sportTeam = "%$sportTeam%";
		$parameters = array("sportTeam" => $sportTeam);
		$statement->execute($parameters);

		//build array of sport teams
		$sportTeams = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !==false) {
			try {
				$sport = new sport($row["sportId"], $row["sportLeague"], $row["sportTeam"]);
				$sportTeams[$sportTeams->key()] = $sport;
				$sportTeams->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return ($sportTeams);
		}
	}

	/**
	 * gets the sport by sportId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $sportId sport id to search for
	 * @return Sport|null Sport found or null if nt found
	 * @throws \PDOException when db related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getSportBySportId(\PDO $pdo, int $sportId) {
		//sanitize sportid number before searching
		if($sportId <= 0) {
			throw(new \PDOException("that sportId is not positive"));
		}

		//create query template
		$query = "SELECT sportId, sportLeague, sportTeam FROM sport WHERE sportId = :sportId";
		$statement = $pdo->prepare($query);

		//bind the sportId to the place holder in the template
		$parameters = array("sportId" => $sportId);
		$statement->execute($parameters);

		//grab the sport from the db
		try {
			$sport = null;
			// var_dump($sport);
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$sport = new Sport($row["sportId"], $row["sportLeague"], $row["sportTeam"]);
				// var_dump($sport);
			}
		} catch(\Exception $exception) {
			//if the row can't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($sport);
	}

	/**
	 * gets all sports
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of sports found or null if nothing was found
	 * @throws \PDOException when db related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllSportLeagues(\PDO $pdo) {
		//create query template
		$query = "SELECT sportId, sportLeague, sportTeam FROM sport";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of leagues
		$allSportLeagues = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$sport = new Sport($row["sportId"], $row["sportLeague"], $row["sportTeam"]);
				$allSportLeagues[$allSportLeagues->key()] = $sport;
			} catch(\Exception $exception) {
				//if the row can't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($allSportLeagues);
	}

	/**
	* gets all sport Names
	* @param \PDO $pdo PDO connection object
	* @return \SplFixedArray SplFixedArray of sports found or null if nothing was found
	* @throws \PDOException when db related errors occur
	* @throws \TypeError when variables are not the correct data type
	**/
	public static function getAllSportTeams(\PDO $pdo) {
		// create a query template
		$query = "SELECT sportId, sportLeague, sportTeam FROM sport";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of sports
		$allSportTeams =new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$sport = new Sport($row["sportId"], $row["sportLeague"], $row["sportTeam"]);
				$allSportTeams[$allSportTeams->key()] = $sport;
			} catch(\Exception $exception) {
				//if the row can't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($allSportTeams);
	}




}
