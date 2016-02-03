<?php
namespace Edu\Cnm\Dmartinez337\sprots;

require_once("autoLoader.php");

/**
 * This will be the class for our 4 chosen sports. NFL, MLB, NBA, and EPL.
 *
 * @author Dom Kratos <mr.kratos85@gmail.com>
 */
class sport {
	/**
	 * id for the sport
	 * @var int $sportId
	 **/
	private $sportId;

	/**
	 * Name of the team
	 * @var string $sportTeam
	 */
	private $sportTeam;
	/**
	 * this identifies the league of the particular sport. Western Eastern conference etc.
	 * @var string $sportLeague
	 */
	private $sportLeague;

	/**
	 *Constructor for sport class
	 *
	 * @param int|null $newSportId id of the sport or null if its a new sport
	 * @param string $newSportTeam Name of team in particular sport
	 * @param string $newSportLeague League to which the sport belongs
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data is out of predetermined range
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newSportId = null, string $newSportTeam, string $newSportLeague) {
		try {
			$this->setSportId($newSportId);
			$this->set
		}
	}
}