<?php
/**
 * Team Statistic, This is a field in which all statistics related to a team are going to be held.
 *
 * @author Chris Paul <chrispaul3625@gmail.com>
 */

class teamStatistic {
	private $teamStatisticTeamId;

	public function getTeamStatisticTeamId() {
		return $this->teamStatisticTeamId;
	}

	public function setTeamStatisticTeamId($teamStatisticTeamId) {
		if($teamStatisticTeamId === null) {
			$this->teamStatisticTeamId = null;
			return;
		}
		$teamStatisticTeamId = filter_var($teamStatisticTeamId, FILTER_VALIDATE_INT);
		if($teamStatisticTeamId == false) {
		}
		if($teamStatisticTeamId <= 0) {
			throw (new RangeException("player statistic Id must be postive"));
			{
				$this->teamStatisticTeamId = $teamStatisticTeamId;
			}
		}
	}
		private $teamStatisticValue;

		public function getTeamStatisticValue;
			return $this->teamStatisticValue;

		public function setTeamStatisticValue($teamStatisticValue) {
			if ($teamStatisticValue === null) {
				$this->teamStatisticValue = null;
				return;
			}
			$teamStatisticValue = filter_var($teamStatisticValue, FILTER_VALIDATE_INT);
			if ($teamStatisticValue == false) {
			}
			if ($teamStatisticValue <=0) {
				throw (new RangeException("player statistic value must be positive"));
				{
					$this->teamStatisticValue = $teamStatisticValue;
				}
			}
		}

		private $teamStastisticStatisticId;

		public function getTeamStastisticStatisticId() {
			return $this->teamStastisticStatisticId;

			public function setTeamStastisticStatisticId ($teamStastisticStatisticId) {
				if($teamStastisticStatisticId === null) {
					$this->teamStastisticStatisticId = null;
					return;
				}
				$teamStastisticStatisticId = filter_var($teamStastisticStatisticId, FILTER_VALIDATE_INT);
				if ($teamStastisticStatisticId == false) {
				}
				if ($teamStastisticStatisticId <=0) {
					throw (new RangeException("team statistic must be posititve"));
				}
				$this->teamStastisticStatisticId = $teamStastisticStatisticId;
			}
		}
		private $teamStatisticGameId;

		public public function getTeamStatisticGameId() {
			return $this->teamStatisticGameId;

			public function setteamStatisticGameId ($teamStatisticGameId) {
				if ($teamStatisticGameId === null) {
					$this->teamStatisticGameId = null;
					return;
					{
						$teamStatisticGameId = filter_var($teamStatisticGameId, FILTER_VALIDATE_INT);
						if ($teamStatisticGameId == false) {
						}
						if ($teamStatisticGameId <=0) {
							throw (new RangeException("team statistic must be positive"));
						}
						$this->teamStatisticGameId = $teamStatisticGameId;
					}
				}
			}
		}
	}

