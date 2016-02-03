<?php
/**
 * Team Statistic, This is a field in which all statistics related to a team are going to be held.
 *
 * @author Jude Chavez <Chavezjude7@gmail.com>
 */
class teamStatistic {
	/**
	 * id for the statistic; this is the primary key
	 * @var int $teamStatistic
	 */
		private $teamStatisticTeamId;

	/**
	 * is unique statistic, unique to team
	 * @return int $teamstatisticId
	 */

	private $teamStatisticValue;

	/**
	 * is unique value of statistic
	 * @return int $teamStatisticValue
	 */

	private $teamStastisticStatisticId;

	/**
	 * is unique to statistic and team
	 * @return int $teamStatisticStatisticId
	 */

	private $teamStatisticGameId;

	/**
	 * is unique to team and game played
	 * @return int
	 */

		public function getTeamStatisticTeamId() {
			return $this->teamStatisticTeamId;
		}

	/**
	 * @param int $teamStatisticTeamId new values of team statistic Id
	 * @throws InvalidArgumentException if statistic team id is not an integer
	 * @throws RangeException if statistic team Id is negative
	 */

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

	/**
	 * accessor for team statistic team Id
	 * @return int valur of team statistic team id
	 *
	 */
			public function getTeamStatisticValue() {
				return $this->teamStatisticValue;
			}

	/**
	 * @param int $teamStatisticValue new values of team statistic value
	 */

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
			public function getTeamStatisticGameId() {
				return $this->teamStatisticGameId;

				public
				function setteamStatisticGameId($teamStatisticGameId) {
					if($teamStatisticGameId === null) {
						$this->teamStatisticGameId = null;
						return;
					}
					$teamStatisticGameId = filter_var($teamStatisticGameId, FILTER_VALIDATE_INT);
					if($teamStatisticGameId == false) {
					}
					if($teamStatisticGameId <= 0) {
						throw (new RangeException("team statistic must be positive"));
					}
					$this->teamStatisticGameId = $teamStatisticGameId;
				}
			}
		}

