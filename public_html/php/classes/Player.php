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
	 * uniquename
	 */
	private $playerApiId;
	/**
	 * Player is unique to Team Player cannot be on >1 teams
	 */
	private $playerTeamId;

	/**
	 * @param int|null $newPlayerId of this Player or null if a New Player
	 * @param int $newPlayerName Id of the Player
	 * @param int $newPlayerApi Api Id of the Player
	 * @param int $newPlayerTeamId Id of the Team the Player is on
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
	 * accessor method for PlayerId
	 *
	 * @return int|null value of PlayerId
	 */

	public function getPlayerId() {
		return ($this->playerId);
	}

	/**
	 * @param int $newplayerId new value of PlayerId
	 * @throws InvalidArgumentException if PlayerId is not an integer
	 * @throws RangeException if PlayerTeamId is negative
	 */

	public function setPlayerId($newPlayerId) {
		if($newPlayerId === null) {
			$this->playerId = null;
			return;
		}
		$newPlayerId = filter_var($newPlayerId, FILTER_VALIDATE_INT);
		if($newPlayerId == false) {
		}
		if($newPlayerId <= 0) {
			throw(new RangeException("PlayerId must be positive"));
		}
		$this->playerId = $newPlayerId;

	}

	/**
	 * accessor method for PlayerId
	 *
	 * @return int value of PlayerId
	 */
	public function getPlayerName() {
		return $this->playerName;
	}

	/**
	 * @param int $PlayerName new value of PlayerName
	 * @throws InvalidArgumentException if PlayerName is not an integer
	 * @throws RangeException if TeamId is negative
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
			throw(new RangeException("Player name must be positive"));
		}
		$this->playerName = $playerName;
	}

	/**
	 * accessor for PlayerName
	 *
	 * @return int value of PlayerName
	 */


	public function getPlayerApiId() {
		return $this->playerApiId;
	}

	/**
	 * @param int $playerApiId new value of PlayerApiId
	 * @throws InvalidArgumentException if PlayerApiId is not an integer
	 * @throws RangeException if TeamId is negative
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
			throw(new RangeException("Player api Id must be positive"));
		}
		$this->$playerApiId = $playerApiId;
	}

	/**
	 * accessor for PlayerApiId
	 *
	 * @return int value of PlayerApiId
	 */
	public function setPlayerTeamId($playerTeamId) {
		if($playerTeamId === null) {
			$this->playerTeam = null;
			return;
			/**
			 * @param int PlayerTeamId new value of PlayerTeamId
			 * @throws InvalidArgumentException if PlayerTeamId is not an integer
			 * @throws RangeException if PlayerId is negative
			 */
		}
		$playerTeamId = filter_var($playerTeamId, FILTER_VALIDATE_INT);
		if($playerTeamId == false) {
		}
		if($playerTeamId <= 0) {
			throw(new RangeException("PlayerTeamId must be positive"));
		}
		$this->$playerTeamId;
	}

	/**
	 * inserts this Player into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the PlayerId is null (i.e., dont insert a Player that already exists
		if($this->playerId !== null) {
			throw(new \PDOException("not a new Player"));
		}

		// create query template
		$query = "INSERT INTO Player(PlayerName, PlayerApiId, PlayerTeamId) VALUES(:PlayerId, :PlayerName, PlayerApiId, :PlayerTeamId)";
		$statement = $pdo->prepare($query);

		// update the null playerId with what mySql just gave us
		$this->playerId = interval($pdo->lastInsertId());

	}

	/**
	 * updates this Player in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		if($this->playerId === null) {
			throw(new \PDOException("unable to update a Player that does not exist"));
		}
		$query = "UPDATE Player SET PlayerNameId = :PlayerNameId, PlayerApiId = :PlayerApiId, PlayerTeamId = :PlayerTeamId WHERE PlayerId = :PlayerId";
		$statement = $pdo->prepare($query);


		$formattedDate = $this->playerId->format("Y-m-d H:i:s");
		$parameters = ["PlayerNameId" => $this->playerNameId, "PlayerApiId" => $this->playerApiId, "PlayerTeamId" => $this->playerTeamId, "PlayerId" => $this->playerId];
		$statement->execute($parameters);
	}



	/**
	 * deletes Player from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 **/
	public function delete(\PDO $pdo) {
		//enforce the PlayerId is not null (i.e., don't delete a player that hasn't been inserted)
		if($this->playerId === null) {
			throw(new \PDOException("unable to delete a Player that does not exist"));
		}

		// create query template
		$query = "DELETE FROM Player WHERE PlayerId = :PlayerId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = ["PlayerId" => $this->PlayerId];
		$statement->execute($parameters);
		}

	/**
	 * accessor for PlayerTeamId
	 *
	 * @return int value of PlayerTeamId
	 */
}




