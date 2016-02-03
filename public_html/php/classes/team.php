<?php
namespace Edu\Cnm\cpaul9\sprots;

require_once("autoLoader.php");

/**
 * A team, This will be a team that is being monitored by our stats and participates in competing with other teams.
 *
 * @author Chris Paul <chrispaul3625@gmail.com>
 **/
class team {
	/**
	 * id for this team; this is the primary key
	 * @var int $teamId
	 **/
	private $teamId;
	/**
	 * teamCity, one city per team.
	 * @var string $teamCity
	 **/
	private $teamCity;
	/**
	 * teamName, one team name per team.
	 * @var string $teamName
	 **/
	private $teamName;
	/**
	 * teamApiId, one Api id per team.
	 * @var int $teamApiId
	 **/
	private $teamApiId;

	/**
	 * Constructor for this team
	 *
	 * @param int $newTeamId id of the team that is being created
	 * @param string $newTeamCity city associated with team
	 * @param string $newTeamName name associated with team
	 * @param int $newTeamApiId Api id that is associated with team
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newTeamId = null, string $newTeamCity, string $newTeamName, int $newTeamApiId = null) {
		try {
			$this->setTeamId($newTeamId);
			$this->setTeamCity($newTeamCity);
			$this->setTeamName($newTeamName);
			$this->setTeamApiId($newTeamApiId);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 *accessor method for teamId
	 *
	 * @return int|null value of team id
	 **/
	public function getTeamId() {
		return ($this->teamId);
	}

	/**
	 * mutator method for team id
	 *
	 * @param int|null $newTeamId new value of team id
	 * @throws \RangeException if the $newTeamId is not positive
	 * @throws \TypeError if $newTeamId is not an ineger
	 **/
	public function setTeamId(int $newTeamId = null) {
		// base case: if profileId is null, this is a new team without a MySQL assigned id (yet)
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
 * accessor method for team city
 *
 * @return string value of team city
 **/
public function getTeamCity (){
	return($thi->teamCiy);
}
/**
 * mutator method for team city
 *
 *@param string $newTeamCity new value of team city
 *@throws \InvalidArgumentException if $newTeamCity is not a string or insecure
 *@throws \RangeException if $newTeamCity is >32 characters
 *@throws \TypeError if $newTeamCity is not a string
 **/
public function setTeamCity (string $newTeamCity){
	//verify the team city content is secure
}


}