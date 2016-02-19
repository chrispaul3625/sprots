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
	 * is unique Player
	 * @var string $PlayerName
	 */
	private $playerName;
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
	 * Constructor for this team
	 *
	 * @param int|null $newPlayerId id of the player that is being created
	 * @param int $newPlayerApiId Id that is associated with the sport
	 * @param int $newTeamId id that is associated with team
	 * @param string $newPlayerName name associated with team
	 * @throws \Exception if some other exception occurs
	 * @throws \TypeError if data types violate type hints
	 */


	public function __construct(int $newPlayerId = null, int $newPlayerApiId, int $newTeamId = null, string $newPlayerName) {
		try {
			$this->setPlayerId($newPlayerId);
			$this->setPlayerApiId($newPlayerApiId);
			$this->setTeamId($newTeamId);
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
	 * @param int|null $newPlayerApiId new value of player Api id
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
		$query = "INSERT INTO player(playerId, playerApiId, teamId, playerName) VALUES(:playerID, :playerApiId, :playerTeamID, :playerName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["playerID" => $this->playerId, "playerApiId" => $this->playerApiId, "teamId" => $this->teamId, "playerName" => $this->playerName];
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
		$query = "INSERT INTO player(playerId, playerApiId, teamId, playerName) VALUES(:playerID, :playerApiId, :playerTeamID, :playerName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["playerID" => $this->playerId, "playerApiId" => $this->playerApiId, "teamId" => $this->teamId, "playerName" => $this->playerName];
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
		if($this->teamId === null) {
			throw(new \PDOException("unable to delete a player that does not exist"));
		}
		// create query template
		$query = "DELETE FROM player WHERE playerId = :playerId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["playerId" => $this->playerId];
		$statement->execute($parameters);
	}

}



