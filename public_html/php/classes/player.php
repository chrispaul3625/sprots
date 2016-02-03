<?php

class player {
	private $playerId;

	public function getplayerId() {
		return ($this->playerId);
	}
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
	private $playerName;

	public function getPlayerName() {
		return $this->playerName;
	}

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
	private $playerApiId;

	public function getPlayerApiId() {
		return $this->playerApiId;
	}

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

	private $playerTeamId;

	public function  setplayerTeamId($playerTeamId) {
		if($playerTeamId === null) {
			$this->playerteam = null;
			return;
		}
		$playerTeamId = filter_var($playerTeamId, FILTER_VALIDATE_INT);
		if($playerTeamId == false){
		}
		if ($playerTeamId <=0) {
			throw(new RangeException("player team Id must be positive"));
		}
		$this->$playerTeamId;
	}
	$this->player = $playerId;
	$player = new player();
	$player->setplayerId(32);
	$player->setplayerName(128);
	$player->setplayerApiId(32);
	$player->setolayerTeamId(32);
	}



