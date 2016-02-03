<?php
namespace Edu\Cnm\Sprots

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
		 * @return int value of Player Statistic Game Id
		 **/
		public function getPlayerStatisticGameId() {
			return ($this->playerStatisticGameId);
		}

		/**
		 * mutator method for
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





	}