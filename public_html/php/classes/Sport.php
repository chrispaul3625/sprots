<?php
namespace Edu\Cnm\Dmartinez337\sprots;

require_once("autoloader.php");

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
	 * this identifies the league of the particular sport. Western Eastern conference etc.
	 * @var string $sportLeague
	 */
	private $sportLeague;

	/**
	 * Name of the team
	 * @var string $sportTeam
	 */
	private $sportTeam;


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
			$this->setSportTeam($newSportTeam);
			$this->setSportLeague($newSportLeague);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for sport id
	 *
	 * @return int|null value of sport id
	 **/
	public function getSportId() {
		return ($this->sportId);
	}

	/**
	 * Mutator method for sport id
	 * @param int|null $newSportId new value of sport id
	 * @throws \RangeException if $newSportId is not positive
	 * @throws \TypeError if $newSportId is not an integer
	 **/
	public function setSportId(int $newSportId = null) {
		if($newSportId === null) {
			$this->sportId = null;
			return;
		}
		// verify the sport id is positive
		if($newSportId <= 0) {
			throw(new \RangeException("sport id is not positive"));
		}
		//convert and store the new sport id
		$this->sportId = $newSportId;
	}

	/**
	 * accessor method for sport leage
	 *
	 * @return string value of sport league
	 */
	public function getSportLeague() {
		return ($this->sportLeague);
	}

	/**
	 * mutator method for sport league
	 *
	 * @param string *newSportLeague new value of the sports league
	 * @throws \InvalidArgumentException if $newSportLeague is not a string, or is insecure
	 * @throws \RangeException if $newSportLeague is >32 characters
	 * @throws \TypeError if $newSportLeage is not a string
	 **/
	public function setSportLeague(string $newSportLeague) {
		//verify that the sport leaguue is in a secure format
		$newSportLeague = trim($newSportLeague);
		$newSportLeague = filter_var($newSportLeague, FILTER_SANITIZE_STRING);
		if(empty($newSportLeague) === true) {
			throw(new\InvalidArgumentException("sport league is empty, or not secure"));
		}
		//verify that the team league will fit in the db
		if(strlen($newSportLeague) > 32) {
			throw(new \RangeException("league name is too large"));
		}
		//if the above two pass, go ahead and store it in the db
		$this->sportLeague = $newSportLeague;
	}

	/**
	 * accessor method for sport team
	 *
	 * @return string value of sport team name
	 **/
	public function getSportTeam() {
		return ($this->sportTeam);
	}

	/**
	 * mutator method for sport team name
	 *
	 * @param string $newSportTeam new value of sport team name
	 * @throws \InvalidArgumentException if $newSportTeam is not a string or insecure
	 * @throws \RangeException if $newSportTeam is >32 characters
	 * @throws \TypeError if $newTeamName is not a string
	 **/
	public function setSportTeam(string $newSportTeam) {
		//verify that the content is secure
		$newSportTeam = trim($newSportTeam);
		$newSportTeam = filter_var($newSportTeam, FILTER_SANITIZE_STRING);
		if(empty($newSportTeam) === true) {
			throw(new \InvalidArgumentException("sport team name is empty, or insecure"));
		}

		//verify that the team name will fit in the database
		if(strlen($newSportTeam) > 32) {
			throw(new \RangeException("team name is too large"));
		}

		//if the above two pass, go ahead and store it in the db
		$this->sportTeam = $newSportTeam;
	}

}