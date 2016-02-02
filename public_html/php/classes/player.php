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
	}


