<?php
namespace Edu\Cnm\Sprots;


require_once("autoload.php");

/**
 * Play, Player that a user will look up
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
	 * ID associated with the Player from api
	 * @var int $playerApiId
	 */
	private $playerApiId;
	/**
	 * Player is unique to Team Player cannot be on >1 teams
	 * @var int $playerTeamId
	 */
	private $playerTeamId;
	/**
	 * Id associated with Sport
	 * @var int $playerSportId
	 */
	private $playerSportId;
	/**
	 * is unique Player
	 * @var string $PlayerName
	 */
	private $playerName;


	/**
	 * Constructor for this Team
	 *
	 * @param int|null $newPlayerId id of the Player that is being created
	 * @param int $newPlayerApiId Id that is associated with the Sport
	 * @param int $newPlayerTeamId id that is associated with Team
	 * @param int $newPlayerSportId id associated with Sport
	 * @param string $newPlayerName name associated with Team
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 */


	public function __construct(int $newPlayerId = null, int $newPlayerApiId, int $newPlayerTeamId, int $newPlayerSportId, string $newPlayerName) {
		try {
			$this->setPlayerId($newPlayerId);
			$this->setPlayerApiId($newPlayerApiId);
			$this->setPlayerTeamId($newPlayerTeamId);
			$this->setPlayerSportId($newPlayerSportId);
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
	 * @param int|null $newPlayerId new value of playerId
	 * @throws \RangeException if the $newPlayerId is not positive
	 * @throws \TypeError if $newPlayerId is not an integer
	 **/
	public function setPlayerId(int $newPlayerId = null) {
		// base case: if playerId is null, this is a new Player without a MySQL assigned id (yet)
		if($newPlayerId === null) {
			$this->playerId = null;
			return;
		}

		// Verify the Player id is positive
		if($newPlayerId <= 0) {
			throw(new \RangeException("Team id is not positive"));
		}

		// Convert and store the Player id
		$this->playerId = $newPlayerId;
	}


	/**
	 *accessor method for Player Api id
	 *
	 * @return int|null value of Player api id
	 **/
	public function getPlayerApiId() {
		return ($this->playerApiId);
	}

	/**
	 * mutator method for Player Api id
	 *
	 * @param int $newPlayerApiId new value of Player Api id
	 * @throws \RangeException if the $newPlayerApiId is not positive
	 * @throws \TypeError if $newPlayerApiId is not an integer
	 **/
	public function setPlayerApiId(int $newPlayerApiId) {
// Verify the Player id is positive
		if($newPlayerApiId <= 0) {
			throw(new \RangeException("Player api id is not positive"));
		}
// Convert and store the Player api id
		$this->playerApiId = $newPlayerApiId;
	}

	/**
	 *accessor method for Player Team id
	 *
	 * @return int value of Player Team id
	 **/
	public function getPlayerTeamId() {
		return ($this->playerTeamId);
	}

	/**
	 * mutator method for Team id
	 *
	 * @param int $newPlayerTeamId new value of Player Team id
	 * @throws \RangeException if the $newPlayerTeamId is not positive
	 * @throws \TypeError if $newPlayerTeamId is not an integer
	 **/
	public function setPlayerTeamId(int $newPlayerTeamId) {
// Verify the Team is positive
		if($newPlayerTeamId <= 0) {
			throw(new \RangeException("Player Team id is not positive"));
		}
// Convert and store the Player Team id
		$this->playerTeamId = $newPlayerTeamId;
	}

	/**
	 * accessor method for PlayerSportId
	 *
	 * @return int value of PlayerSportId
	 */

	public function getPlayerSportId() {
		return ($this->playerSportId);
	}

	/**
	 * mutator method for PlayerSportId
	 *
	 * @param int $newPlayerSportId new value of Player Sport id
	 * @throws \RangeException if the $newPlayerSportId is not positive
	 * @throws \TypeError if $newPlayerSportId is not an integer
	 **/
	public function setPlayerSportId(int $newPlayerSportId) {
		// base case: if Sport id is null, this is a new Player without a MySQL assigned id (yet)
		if($newPlayerSportId <= 0) {
			throw(new \RangeException("Player Sport id is not positive"));

		}

		// Verify the Player Sport id is positive
		if($newPlayerSportId <= 0) {
			throw(new \RangeException("Player Sport id is not positive"));
		}

		// Convert and store the Player Sport id
		$this->playerSportId = $newPlayerSportId;
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
	 * mutator method for Player name
	 *
	 * @param string $newPlayerName new value of Player name
	 * @throws \InvalidArgumentException if $newPlayerName is not a string or insecure
	 * @throws \RangeException if $newPlayerName is >32 characters
	 * @throws \TypeError if $newPlayerName is not a string
	 **/
	public function setPlayerName(string $newPlayerName) {
		//verify the Player name is secure
		$newPlayerName = trim($newPlayerName);
		$newPlayerName = filter_var($newPlayerName, FILTER_SANITIZE_STRING);
		if(empty($newPlayerName) === true) {
			throw(new \InvalidArgumentException("Player name is empty or insecure"));
		}
//verify the Player name will fit in the database
		if(strlen($newPlayerName) > 32) {
			throw(new \RangeException("Player name is too large"));
		}
// store the new Player name
		$this->playerName = $newPlayerName;
	}


	/**
	 * inserts this Player into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforces that Player id is null (i.e., don't insert a Team that already exists.
		if($this->playerId !== null) {
			throw(new \PDOException("not a new Player"));
		}

		// create query template
		$query = "INSERT INTO Player(playerId, playerApiId, playerTeamId, playerSportId, playerName) VALUES(:playerId, :playerApiId, :playerTeamId,:playerSportId, :playerName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["playerId" => $this->playerId, "playerApiId" => $this->playerApiId, "playerTeamId" => $this->playerTeamId, "playerSportId" => $this->playerSportId, "playerName" => $this->playerName];
		$statement->execute($parameters);

		// update the null playerId with what mySQL just gave us
		$this->playerId = intval($pdo->lastInsertId());
	}

	/**
	 * updates this Player into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforces that Player id is null (i.e., don't insert a Team that already exists.
		if($this->playerId === null) {
			throw(new \PDOException("Unable to update a Player that doesn't exist"));
		}

		// create query template
		$query = "UPDATE Player SET playerApiId = :playerApiId, playerTeamId = :playerTeamId, playerSportId = :playerSportId, playerName = :playerName";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["playerApiId" => $this->playerApiId, "playerTeamId" => $this->playerTeamId, "playerSportId" => $this->playerSportId, "playerName" => $this->playerName];
		$statement->execute($parameters);
	}

	/**
	 * deletes Player from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function delete(\PDO $pdo) {
// enforce the Player id is not null (i.e., don't delete a Player that hasn't been inserted)
		if($this->playerId === null) {
			throw(new \PDOException("unable to delete a Player that does not exist"));
		}
		// create query template
		$query = "DELETE FROM Player WHERE playerId = :playerId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["playerId" => $this->playerId];
		$statement->execute($parameters);
	}

	/**
	 * gets the Player by playerId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $playerId Player id to search for
	 * @return Player|null Player found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getPlayerByPlayerId(\PDO $pdo, int $playerId) {
		// sanitize the playerId before searching
		if($playerId <= 0) {
			throw(new \PDOException("Player id is not positive"));
		}
		// Create query template
		$query = "SELECT playerId, playerApiId, playerTeamId, playerSportId, playerName FROM Player WHERE playerId = :playerId";
		$statement = $pdo->prepare($query);

		// Bind the Player id to the place holder in the template
		$parameters = array("playerId" => $playerId);
		$statement->execute($parameters);

		// Grab the Player from mySQL
		try {
			$player = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$player = new Player($row["playerId"], $row["playerApiId"], $row["playerTeamId"], $row["playerSportId"], $row["playerName"]);
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
	 * @param int $playerApiId Player Api id to search for
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
		$query = "SELECT playerId, playerApiId, playerTeamId, playerSportId, playerName FROM Player WHERE playerApiId = :playerApiId";
		$statement = $pdo->prepare($query);

		// Bind the Player API id to the place holder in the template
		$parameters = array("playerApiId" => $playerApiId);
		$statement->execute($parameters);

		// Grab the Team from mySQL
		try {
			$player = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$player = new Player($row["playerId"], $row["playerApiId"], $row["playerTeamId"], $row["playerSportId"], $row["playerName"]);
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
	 * @param string $playerName Player name to search for
	 * @return Player|null Player found or null if not found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 */
	public static function getPlayerByPlayerName(\PDO $pdo, string $playerName) {
		// sanitize the $playerName before searching
		$playerName = trim($playerName);
		$playerName = filter_var($playerName, FILTER_SANITIZE_STRING);
		if(empty($playerName) === true) {
			throw(new \PDOException("Team name is invalid"));
		}

		// Create query template
		$query = "SELECT playerId, playerApiId, playerTeamId, playerSportId, playerName FROM Player WHERE playerName LIKE :playerName";
		$statement = $pdo->prepare($query);

		// Bind the Player Name to the place holder in the template
		$playerName = "%$playerName%";
		$parameters = array("playerName" => $playerName);
		$statement->execute($parameters);

		// build an array of Player Names
		$playerNames = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		While(($row = $statement->fetch()) !== false) {
			try {
				$playerName = new player($row["playerId"], $row["playerApiId"], $row["playerTeamId"], $row["playerSportId"], $row["playerName"]);
				$playerNames[$playerNames->key()] = $playerName;
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($playerNames);

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
		$query = "SELECT playerId, playerApiId, playerTeamId, playerSportId, playerName FROM Player";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of teams
		$players = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$player = new Player($row["playerId"], $row["playerApiId"], $row["playerTeamId"], $row["playerSportId"], $row["playerName"]);
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



