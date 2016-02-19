<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * Player, Player that a user will look up
 *
 * Player is unique
 *
 * $author Jude Chavez <chavezjude7@gmail.com>
 *
 */
class Player {
	/**
	 * Id for the Player; this is the primary key
	 * @var int $PlayerId
	 */
	private $playerId;
	/**
	 * ID associated with the player from api
	 * @var int $playerApiId
	 */
	private $playerApiId;
	/**
	 * Player is unique to Team Player cannot be on >1 teams
	 * @var int $teamId
	 */
	private $teamId;
	/**
	 * Id associated with sport
	 * @var int $sportId
	 */
	private $sportId;
	/**
	 * is unique Player
	 * @var string $PlayerName
	 */
	private $playerName;



	/**
	 * Constructor for this team
	 *
	 * @param int|null $newPlayerId id of the player that is being created
	 * @param int $newPlayerApiId Id that is associated with the sport
	 * @param int $newTeamId id that is associated with team
	 * @param int $newSportId id associated with sport
	 * @param string $newPlayerName name associated with team
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 */


	public function __construct(int $newPlayerId = null, int $newPlayerApiId, int $newTeamId, int $newSportId, string $newPlayerName) {
		try {
			$this->setPlayerId($newPlayerId);
			$this->setPlayerApiId($newPlayerApiId);
			$this->setTeamId($newTeamId);
			$this->setSportId($newSportId);
			$this->setPlayerName($newPlayerName);
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
	 * accessor method for PlayerId
	 *
	 * @return int|null value of PlayerId
	 */

	public function getPlayerId() {
		return ($this->playerId);
	}

	/**
	 * mutator method for PlayerId
	 *
	 * @param int|null $newPlayerId new value of player id
	 * @throws \RangeException if the $newPlayerId is not positive
	 * @throws \TypeError if $newPlayerId is not an integer
	 **/
	public function setPlayerId(int $newPlayerId = null) {
		// base case: if playerId is null, this is a new player without a MySQL assigned id (yet)
		if($newPlayerId === null) {
			$this->playerId = null;
			return;
		}

		// Verify the player id is positive
		if($newPlayerId <= 0) {
			throw(new \RangeException("team id is not positive"));
		}

		// Convert and store the player id
		$this->playerId = $newPlayerId;
	}


	/**
	 *accessor method for player Api id
	 *
	 * @return int|null value of player api id
	 **/
	public function getPlayerApiId() {
		return ($this->playerApiId);
	}

	/**
	 * mutator method for player Api id
	 *
	 * @param int $newPlayerApiId new value of player Api id
	 * @throws \RangeException if the $newPlayerApiId is not positive
	 * @throws \TypeError if $newPlayerApiId is not an integer
	 **/
	public function setPlayerApiId(int $newPlayerApiId) {
// Verify the player id is positive
		if($newPlayerApiId <= 0) {
			throw(new \RangeException("player api id is not positive"));
		}
// Convert and store the player api id
		$this->playerApiId = $newPlayerApiId;
	}

	/**
	 *accessor method for team id
	 *
	 * @return int|null value of  team id
	 **/
	public function getTeamId() {
		return ($this->teamId);
	}

	/**
	 * mutator method for team id
	 *
	 * @param int|null $newTeamId new value of  team id
	 * @throws \RangeException if the $newTeamId is not positive
	 * @throws \TypeError if $newTeamId is not an integer
	 **/
	public function setTeamId(int $newTeamId) {
// Verify the team is positive
		if($newTeamId <= 0) {
			throw(new \RangeException("team id is not positive"));
		}
// Convert and store the player team id
		$this->teamId = $newTeamId;
	}

	/**
	 * accessor method for PlayerId
	 *
	 * @return int|null value of PlayerId
	 */

	public function getSportId() {
		return ($this->sportId);
	}

	/**
	 * mutator method for PlayerId
	 *
	 * @param int|null $newSportId new value of sport id
	 * @throws \RangeException if the $newSportId is not positive
	 * @throws \TypeError if $newPlayerId is not an integer
	 **/
	public function setSportId(int $newSportId = null) {
		// base case: if sport id is null, this is a new player without a MySQL assigned id (yet)
		if($newSportId <= 0) {
			throw(new \RangeException("sport id is not positive"));

		}

		// Verify the sport id is positive
		if($newSportId <= 0) {
			throw(new \RangeException("sport id is not positive"));
		}

		// Convert and store the player id
		$this->sportId = $newSportId;
	}
	/**
	 * accessor method for PlayerName
	 *
	 * @return string value of PlayerName
	 */
	public function getPlayerName() {
		return $this->playerName;
	}

	/**
	 * mutator method for player name
	 *
	 * @param string $newPlayerName new value of player name
	 * @throws \InvalidArgumentException if $newPlayerName is not a string or insecure
	 * @throws \RangeException if $newPlayerName is >32 characters
	 * @throws \TypeError if $newPlayerName is not a string
	 **/
	public function setPlayerName(string $newPlayerName) {
		//verify the player name is secure
		$newPlayerName = trim($newPlayerName);
		$newPlayerName = filter_var($newPlayerName, FILTER_SANITIZE_STRING);
		if(empty($newPlayerName) === true) {
			throw(new \InvalidArgumentException("Player name is empty or insecure"));
		}
//verify the player name will fit in the database
		if(strlen($newPlayerName) > 32) {
			throw(new \RangeException("player name is too large"));
		}
// store the new player name
		$this->playerName = $newPlayerName;
	}


	/**
	 * inserts this player into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforces that player id is null (i.e., don't insert a team that already exists.
		if($this->playerId !== null) {
			throw(new \PDOException("not a new player"));
		}

		// create query template
		$query = "INSERT INTO player(playerId, playerApiId, teamId, sportId, playerName) VALUES(:playerId, :playerApiId, :teamId,:sportId, :playerName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["playerId" => $this->playerId, "playerApiId" => $this->playerApiId, "playerTeamId" => $this->teamId, "sportId" => $this->sportId,"playerName" => $this->playerName];
		$statement->execute($parameters);

		// update the null playerId with what mySQL just gave us
		$this->playerId = intval($pdo->lastInsertId());
	}

	/**
	 * updates this player into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforces that player id is null (i.e., don't insert a team that already exists.
		if($this->playerId !== null) {
			throw(new \PDOException("not a new player"));
		}

		// create query template
		$query = "INSERT INTO player(playerId, playerApiId, teamId, sportId, playerName) VALUES(:playerID, :playerApiId, :teamID,:sportId, :playerName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["playerId" => $this->playerId, "playerApiId" => $this->playerApiId, "playerTeamId" => $this->teamId, "sportId" => $this->sportId,"playerName" => $this->playerName];;
		$statement->execute($parameters);

		// update the null playerId with what mySQL just gave us
		$this->playerId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes player from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo) {
// enforce the player id is not null (i.e., don't delete a player that hasn't been inserted)
		if($this->playerId === null) {
			throw(new \PDOException("unable to delete a player that does not exist"));
		}
		// create query template
		$query = "DELETE FROM player WHERE playerId = :playerId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["playerId" => $this->playerId];
		$statement->execute($parameters);
	}

	/**
	 * gets the Player by playerId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $playerId player id to search for
	 * @return Player|null Player found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getPlayerByPlayerId(\PDO $pdo, int $playerId) {
		// sanitize the playerId before searching
		if($playerId <= 0) {
			throw(new \PDOException("player id is not positive"));
		}
		// Create query template
		$query = "SELECT playerId, playerApiId, teamId, sportId, playerName FROM player WHERE playerId = :playerId";
		$statement = $pdo->prepare($query);

		// Bind the player id to the place holder in the template
		$parameters = array("playerId" => $playerId);
		$statement->execute($parameters);

		// Grab the player from mySQL
		try {
			$player = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$player = new Player($row["playerId"], $row["playerApiId"], $row["teamId"], $row["sportId"], $row["playerName"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($player);
	}

		/**
		 * gets the Player by playerApiId
		 *
		 * @param \PDO $pdo PDO connection object
		 * @param int $playerApiId player Api id to search for
		 * @return Player|null Player found or null if not found
		 * @throws \PDOException when mySql related errors occur
		 * @throws \TypeError when variable are not the correct data type
		 */
		public static function getPlayerByPlayerApiId(\PDO $pdo, int $playerApiId) {
			// sanitize the playerApiId before searching
			if($playerApiId <= 0) {
				throw(new \PDOException("playerApi id is not positive"));
			}
			// Create query template
			$query = "SELECT playerId, playerApiId, teamId, sportId, playerName FROM player WHERE playerApiId = :playerApiId";
			$statement = $pdo->prepare($query);

			// Bind the player API id to the place holder in the template
			$parameters = array("playerApiId" => $playerApiId);
			$statement->execute($parameters);

			// Grab the team from mySQL
			try {
				$player = null;
				$statement->setFetchMode(\PDO::FETCH_ASSOC);
				$row = $statement->fetch();
				if($row !== false) {
					$player = new Player($row["playerId"], $row["playerApiId"], $row["teamId"], $row["sportId"], $row["playerName"]);
				}
			} catch
			(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));

			}
			return ($player);
		}

			/**
			 * gets the Player by teamId
			 *
			 * @param \PDO $pdo PDO connection object
			 * @param int $teamId team id to search for
			 * @return Player|null Player found or null if not found
			 * @throws \PDOException when mySql related errors occur
			 * @throws \TypeError when variable are not the correct data type
			 */
			public static function getPlayerByTeamId(\PDO $pdo, int $teamId) {
				// sanitize the $teamId before searching
				if($teamId <= 0) {
					throw(new \PDOException("teamId id is not positive"));
				}
				// Create query template
				$query = "SELECT playerId, playerApiId, teamId, sportId, playerName FROM player WHERE $teamId = :teamId";
				$statement = $pdo->prepare($query);

				// Bind the team id to the place holder in the template
				$parameters = array("$teamId" => $teamId);
				$statement->execute($parameters);

				// Grab the player from mySQL
				try {
					$player = null;
					$statement->setFetchMode(\PDO::FETCH_ASSOC);
					$row = $statement->fetch();
					if($row !== false) {
						$player = new Player($row["playerId"], $row["playerApiId"], $row["teamId"], $row["sportId"], $row["playerName"]);
					}
				} catch
				(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));

				}
				return ($player);
			}

	/**
	 * gets the Player by sportId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $sportId team id to search for
	 * @return Player|null Player found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getPlayerBySportId(\PDO $pdo, int $sportId) {
		// sanitize the $sportId before searching
		if($sportId <= 0) {
			throw(new \PDOException("teamId id is not positive"));
		}
		// Create query template
		$query = "SELECT playerId, playerApiId, teamId, sportId, playerName FROM player WHERE $sportId = :sportId";
		$statement = $pdo->prepare($query);

		// Bind the sport id to the place holder in the template
		$parameters = array("$sportId" => $sportId);
		$statement->execute($parameters);

		// Grab the player from mySQL
		try {
			$player = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$player = new Player($row["playerId"], $row["playerApiId"], $row["teamId"], $row["sportId"], $row["playerName"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($player);
	}


	/**
	 * gets the Player by playerName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $playerName player name to search for
	 * @return Player|null Player found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getPlayerByPlayerName(\PDO $pdo, string $playerName) {
		// sanitize the $playerName before searching
		if($playerName <= 0) {
			throw(new \PDOException("playerName is not valid"));
		}
		// Create query template
		$query = "SELECT playerId, playerApiId, teamId, sportId, playerName FROM player WHERE $playerName = :playerName";
		$statement = $pdo->prepare($query);

		// Bind the player Name to the place holder in the template
		$parameters = array("$playerName" => $playerName);
		$statement->execute($parameters);

		// Grab the player from mySQL
		try {
			$player = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$player = new Player($row["playerId"], $row["playerApiId"], $row["teamId"], $row["sportId"], $row["playerName"]);
			}
		} catch
		(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));

		}
		return ($player);

	}
	/**
	 * gets all Players
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of players found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getAllPlayers(\PDO $pdo) {
		//create query template
		$query = "SELECT playerId, playerApiId, teamId, sportId, playerName FROM player";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of teams
		$players = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$player = new Player($row["playerId"], $row["playerApiId"], $row["teamId"], $row["sportId"], $row["playerName"]);
				$players[$players->key()] = $player;
				$players->next();
			} Catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($players);
	}
}



