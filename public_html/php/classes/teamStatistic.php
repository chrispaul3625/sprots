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
		if ($teamStatisticTeamId == false) {
		}
		if ($teamStatisticTeamId <=0) {
			throw (new RangeException("player statistic Id must be postive"));
			{
				$this->teamStatisticTeamId = $teamStatisticTeamId;
			}
		}
	}



}