<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * player, player that a user will look up
 *
 * player is uniqu
 *
 * $author Jude Chavez <chavezjude7@gmail.com>
 *
 */
class Player {
	/**
	 * id for the player; this is the primary key
	 * @var int $playerId
	 */
	private $playerId;
	/**
	 * is unique player
	 * @var string $playerName
	 */
	private $playerName;
	/**
	 * uniquename
	 */
	private $playerApiId;
	/**
	 * player is unique to team player cannot be on >1 teams
	 */
	private $playerTeamId;

	/**
	 * @param int|null $newplayerId of this player or null if a new player
	 * @param int $newplayername Id of the player
	 * @param int $newplayerApi Api Id of the player
	 * @param int $newplayerTeam Id of the player
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bouds (e.g, strings to long, negative intergers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */


	public function __construct(int $newPlayerId = null, int $newPlayerName, int $newPlayerApiId, int $newPlayerTeamId = null) {
		try {
			$this->setPlayerId($newPlayerId);
			$this->setPlayerName($newPlayerName);
			$this->setPlayerApiId($newPlayerApiId);
			$this->setPlayerTeamId($newPlayerTeamId);
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
	 * accessor method for player id
	 *
	 * @return int|null value of player Id
	 */

	public function getplayerId() {
		return ($this->playerId);
	}

	/**
	 * @param int $newplayerId new value of player Id
	 * @throws InvalidArgumentException if player id is not an integer
	 * @throws RangeException if profile id is negative
	 */

	public function setplayerId($newplayerId) {
		if($newplayerId === null) {
			$this->playerId = null;
			return;
		}
		$newplayerId = filter_var($newplayerId, FILTER_VALIDATE_INT);
		if($newplayerId == false) {
		}
		if($newplayerId <= 0) {
			throw(new RangeException("player id must be positive"));
		}
		$this->playerId = $newplayerId;

	}

	/**
	 * accessor method for playerid
	 *
	 * @return int value of player id
	 */
	public function getPlayerName() {
		return $this->playerName;
	}

	/**
	 * @param int $playerName new value of player name
	 * @throws InvalidArgumentException if player name is not an integer
	 * @throws RangeException if profile id is negative
	 */

	public function setPlayerName($playerName) {
		if($playerName === null) {
			$this->playerName = null;
			return;
		}
		$playerName = filter_var($playerName, FILTER_VALIDATE_INT);
		if($playerName == false) {
		}
		if($playerName <= 0) {
			throw(new RangeException("player name must be positive"));
		}
		$this->playerName = $playerName;
	}

	/**
	 * accessor for player name
	 *
	 * @return int value of player name
	 */


	public function getPlayerApiId() {
		return $this->playerApiId;
	}

	/**
	 * @param int $playerApiId new value of player Api Id
	 * @throws InvalidArgumentException if player Api Id is not an integer
	 * @throws RangeException if profile Id is negative
	 */
	public function setPlayerApiId($playerApiId) {
		if($playerApiId === null) {
			$this->playerApiId = null;
			return;
		}
		$playerApiId = filter_var($playerApiId, FILTER_VALIDATE_INT);
		if($playerApiId == false) {
		}
		if($playerApiId <= 0) {
			throw(new RangeException("player api Id must be positive"));
		}
		$this->$playerApiId = $playerApiId;
	}

	/**
	 * accessor for player Api id
	 *
	 * @return int value of player Api id
	 */
	public function setplayerTeamId($playerTeamId) {
		if($playerTeamId === null) {
			$this->playerteam = null;
			return;
			/**
			 * @param int playerTeamId new value of playerTeamId
			 * @throws InvalidArgumentException if player team Id is not an integer
			 * @throws RangeException if player Id is negative
			 */
		}
		$playerTeamId = filter_var($playerTeamId, FILTER_VALIDATE_INT);
		if($playerTeamId == false) {
		}
		if($playerTeamId <= 0) {
			throw(new RangeException("player team Id must be positive"));
		}
		$this->$playerTeamId;
	}

	/**
	 * inserts this player into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the playerId is null (i.e., dont insert a player that already exists
		if($this->playerId !== null) {
			throw(new \PDOException("not a new player"));
		}

		// create query template
		$query = "INSERT INTO player(playerName, PlayerApiId, playerTeamId) VALUES(:playerId, :playerName, PlayerApiId, :playerTeamId)";
		$statement = $pdo->prepare($query);

		// update the null playerId with what mySql just gave us
		$this->playerId = interval($pdo->lastInsertId());

	}

	/**
	 * updates this player in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		if($this->playerId === null) {
			throw(new \PDOException("unable to update a player that does not exist"));
		}
		$query = "UPDATE player SET playerNameId = :playerNameId, PlayerApiId = :PlayerApiId, playerTeamId = :playerTeamId WHERE playerId = :playerId";
		$statement = $pdo->prepare($query);


		$formattedDate = $this->playerId->format("Y-m-d H:i:s");
		$parameters = ["playerNameId" => $this->playerNameId, "playerApiId" => $this->playerApiId, "playerTeamId" => $this->playerTeamId, "playerId" => $this->playerId];
		$statement->execute($parameters);
	}



	/**
	 * deletes player from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 **/
	public function delete(\PDO $pdo) {
		//enforce the playerId is not null (i.e., don't delete a player that hasn't been inserted)
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
	 * accessor for player Team Id
	 *
	 * @return int value of player Team id
	 */
}




