<?php
namespace Edu\Cnm\Sprots;

require_once("autoloader.php");

/**
 * Player Statistics, This will be a player stat that is being pulled from APIs.
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
	class PlayerStatistics {
		/**
		 * $playerStatisticGameId id for player in a specific game; this is a foreign key
		 * @var int $playerStatisticGameId
		 **/
		private $playerStatisticGameId;
		/**
		 * $playerStatisticPlayerId id for players overall statistics, this is a foreign key
		 * @var int $playerStatisticPlayerId
		 **/
		private $playerStatisticPlayerId;
		/**
		 * $playerStatisticStatisticId id for the players individual statistic, this is a foreign key
		 * @var int $playerStatisticStatisticId
		 **/
		private $playerStatisticStatisticId;
		/**
		 * $playerStatisticValue the value of individual stats, number value for a stat
		 * @var int $playerStatisticValue
		 **/
		private $playerStatisticValue;

/**
 * Constructor for this players statistics
 *
 * @param int $newPlayerStatisticGameId id of game the player is in
 * @param int $newPlayerStatisticPlayerId statistic id of the player
 * @param int $newPlayerStatisticStatisticId name associated with team
 * @param int $newPlayerStatisticValue Value of the statistic
 * @throws \InvalidArgumentException if data types are not valid
 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
 * @throws \TypeError if data types violate type hints
 * @throws \Exception if some other exception occurs
 **/

public function __construct(int $newPlayerStatisticGameId, int $newPlayerStatisticPlayerId, int $newPlayerStatisticStatisticId, int $newPlayerStatisticValue) {
	try {
		$this->setPlayerStatisticGameId($newPlayerStatisticGameId);
		$this->setPlayerStatisticPlayerId($newPlayerStatisticPlayerId);
		$this->setPlayerStatisticStatisticId($newPlayerStatisticStatisticId);
		$this->setPlayerStatisticValue($newPlayerStatisticValue);
	} catch(\InvalidArgumentException $InvalidArgument) {
		// Rethrow the exception to the caller
		throw(new \InvalidArgumentException($InvalidArgument->getmessage(), 0, $InvalidArgument));
	} catch(\RangeException $range) {
		// Rethrow the exception to the caller
		throw(new \RangeException($range->getMessage(), 0, $range));
	} catch(\TypeError $typeError) {
		throw(new \TypeError($typeError->getMessage(), 0, $typeError));
	}
}


		/**
		 * accessor method for Player Statistic Game Id
		 *
		 * @return int|null value of Player Statistic Game Id
		 **/
		public function getPlayerStatisticGameId() {
			return ($this->playerStatisticGameId);
		}

		/**
		 * mutator method for PlayerStatisticGameId
		 *
		 * @param int|null $newPlayerStatisticGameId new value of Player Statistic Game Id
		 * @throws \RangeException if the $newPlayerStatisticGameId is not positive
		 * @throws \TypeError if $newPlayerStatisticGameId is not an integer
		 **/
		public function setPlayerStatisticGameId(int $newPlayerStatisticGameId) {
			if($newPlayerStatisticGameId === null) {
				$this->playerStatisticGameId = null;
				return;
			}
// Verify the PlayerStatisticGameId is positive
			if($newPlayerStatisticGameId <= 0) {
				throw(new \RangeException("PlayerStatisticGameId is not positive"));
			}
// Convert and store the PlayerStatisticGameId
			$this->playerStatisticGameId = $newPlayerStatisticGameId;
		}

		/**
		 *accessor method for Player Statistic Player Id
		 *
		 * @return int|null value of Player Statistic Player Id
		 **/
		public function getPlayerStatisticPlayerId() {
			return ($this->playerStatisticPlayerId);
		}

		/**
		 * mutator method for Player Statistic Player Id
		 *
		 * @param int|null $newPlayerStatisticPlayerId new value of Player Statistic Player Id
		 * @throws \RangeException if the $newPlayerStatisticPlayerId is not positive
		 * @throws \TypeError if $newPlayerStatisticPlayerId is not an integer
		 **/
		public function setPlayerStatisticPlayerId(int $newPlayerStatisticPlayerId = null) {
			// base case: if PlayerStatisticPlayerId is null, this is a new player statistic player id without a MySQL assigned id (yet)
			if($newPlayerStatisticPlayerId === null) {
				$this->playerStatisticPlayerId = null;
				return;
			}
// Verify the Player Statistic Player Id is positive
			if($newPlayerStatisticPlayerId <= 0) {
				throw(new \RangeException("Player Statistic Player Id is not positive"));
			}
// Convert and store the Player Statistic Player Id
			$this->playerStatisticPlayerId = $newPlayerStatisticPlayerId;
		}

		/**
		 * accessor method for Player Statistic Statistic Id
		 *
		 * @return int|null value of Player Statistic Statistic Id
		 **/
		public function getPlayerStatisticStatisticId() {
			return ($this->playerStatisticStatisticId);
		}

		/**
		 * mutator method for Player Statistic Statistic Id
		 *
		 * @param int|null $newPlayerStatisticStatisticId new value of Player Statistic Statistic Id
		 * @throws \InvalidArgumentException if $newPlayerStatisticStatisticId is not a string or insecure
		 * @throws \RangeException if $newPlayerStatisticStatisticId is >32 characters
		 * @throws \TypeError if $newPlayerStatisticStatisticId is not an integer
		 **/
		public function setPlayerStatisticStatisticId(int $newPlayerStatisticStatisticId) {
			//verify the Player Statistic Statistic Id is secure
			$newPlayerStatisticStatisticId = trim($newPlayerStatisticStatisticId);
			$newPlayerStatisticStatisticId = filter_var($newPlayerStatisticStatisticId);
			if(empty($newPlayerStatisticStatisticId) === true) {
				throw(new \InvalidArgumentException("Player Statistic Statistic Id is empty or insecure"));
			}
//verify the Player Statistic Statistic Id will fit in the database
			if(strlen($newPlayerStatisticStatisticId) > 32) {
				throw(new \RangeException("Player Statistic Statistic Id is too large"));
			}
// store the new Player Statistic Statistic Id
			$this->$newPlayerStatisticStatisticId = $newPlayerStatisticStatisticId;
		}

		/**
		 * accessor method for Player Statistic Value
		 *
		 * @return int value of Player Statistic Value
		 **/

		public function getPlayerStatisticValue() {
			return ($this->playerStatisticValue);
		}

		/**
		 * mutator method for Player Statistic Value
		 *
		 * @param int $newPlayerStatisticValue value of statistic
		 * @throws \InvalidArgumentException if $newPlayerStatisticValue is not an integer or insecure
		 * @throws \RangeException if $newPlayerStatisticValue is >32 characters
		 * @throws \TypeError if $newPlayerStatisticValue is not an integer
		 **/

		public function setPlayerStatisticValue(int $newPlayerStatisticValue) {
			//verify the Player Statistic Value is secure
			$newPlayerStatisticValue = trim($newPlayerStatisticValue);
			$newPlayerStatisticValue = filter_var($newPlayerStatisticValue);
			if(empty($newPlayerStatisticValue) === true) {
				throw(new \InvalidArgumentException("Player Statistic Value is empty or insecure"));
			}
//verify the Player Statistic Value will fit in the database
			if(strlen($newPlayerStatisticValue) > 32) {
				throw(new \RangeException("Player Statistic Value is too large"));
			}
// store the new Player Statistic Value
			$this->$newPlayerStatisticValue = $newPlayerStatisticValue;
		}
		/**
		 * Inserts this player statistic into mySQL
		 *
		 *@param \PDO $pdo PDO connection object
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError if $pdo is not a PDO connection object
		 **/

		public function insert(\PDO $pdo) {
			// enforce the player statistic game id, the player statistic player id, and the player statistic statistic id is exists
			if($this->playerStatisticGameId === null || $this->playerStatisticPlayerId === null || $this->playerStatisticStatisticId === null) {
				throw(new \PDOException("Ids do not exist"));
			}
		// Create query template
			$query = "INSERT INTO playerStatistic(playerStatisticGameId, playerStatisticPlayerId, playerStatisticStatisticId, playerStatisticValue) VALUES(:playerStatisticGameId, :playerStatisticPlayerId, :playerStatisticStatisticId, :playerStatisticValue)";
			$statement = $pdo->prepare($query);

			// Bind the member variables to the place holders in template
			$parameters = ["playerStatisticGameId" => $this->playerStatisticGameId, "playerStatisticPlayerId" => $this->playerStatisticPlayerId, "playerStatisticStatisticId" => $this->playerStatisticStatisticId, "playerStatisticValue" => $this->playerStatisticValue];
			$statement->execute($parameters);
		}





	}