<?php

/**
 * player, player that a user will look up
 *
 * player is uniqu
 *
 * $author Jude Chavez <chavezjude7@gmail.com>
 *
 */
class player {
	/**
	 * id for the player; this is the primary key
	 * @var int $playerId
	 */
	private $playerId;
	/**
	 * is unique player
	 * @var int $playername
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
	 * player is unique to team, team is unique
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
			if ($newplayerId <=0) {
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
		if ($playerName === null){
			$this->playerName = null;
			return;
		}
		$playerName = filter_var($playerName, FILTER_VALIDATE_INT);
		if($playerName == false){
		}
		if ($playerName <=0) {
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
		if ($playerApiId <=0) {
			throw(new RangeException("player api Id must be positive"));
		}
		$this->$playerApiId = $playerApiId;
	}

	/**
	 * accessor for player Api id
	 *
	 * @return int value of player Api id
	 */
	public function  setplayerTeamId($playerTeamId) {
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
		if($playerTeamId == false){
		}
		if ($playerTeamId <=0) {
			throw(new RangeException("player team Id must be positive"));
		}
		$this->$playerTeamId;
	}
	/**
	 * accessor for player Team Id
	 *
	 * @return int value of player Team id
	 */
	}




