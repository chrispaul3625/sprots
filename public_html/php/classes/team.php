<?php
namespace Edu\Cnm\cpaul9\sprots;

require_once ("autoLoader.php");

/**
 * A team, This will be a team that is being monitored by our stats and participates in competing with other teams.
 *
 * @author Chris Paul <chrispaul3625@gmail.com>
 */
class team {
	/**
	 * id for this team; this is the primary key
	 * @var int $teamId
	 */
	private $teamId;
	/**
	 * teamCity, one city per team.
	 * @var string $teamCity
	 */
	private $teamCity;
	/**
	 * teamName, one team name per team.
	 * @var string $teamName
	 */
	private $teamName;
	/**
	 * teamApiId, one Api id per team.
	 * @var int $teamApiId
	 */
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
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}
}