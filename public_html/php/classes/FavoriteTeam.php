<?php
namespace Edu\Cnm\Sprots;

require_once("autoload.php");

/**
 * This will be the class for a profile to chose favorite teams
 *
 * @author Dom Kratos <mr.kratos85@gmail.com>
 **/
class favoriteTeam {
	/**
	 *id for the profile that has favorites; this is the foreign key
	 * @var int $favoriteTeamProfileId
	 **/
	private $favoriteTeamProfileId;
	/**
	 *id of the team that is being favorited.
	 * @var int $favoriteTeamTeamId
	 **/
	private $favoriteTeamTeamId;

	/**
	 * constructor for favoring a team.
	 *
	 * @param int|null $newFavoriteTeamProfileId this will be inherieted from the profileId
	 * @param int|null $newFavoriteTeamTeamId this will be inherieted from the teamId
	 * @throws \InvalidArgumentException if data types are not valid* @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newFavoriteTeamProfileId, int $newFavoriteTeamTeamId) {
		try {
			$this->setFavoriteTeamProfileId($newFavoriteTeamProfileId);
			$this->setFavoriteTeamTeamId($newFavoriteTeamTeamId);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $rangeException) {
			throw(new \RangeException ($rangeException->getMessage(), 0, $rangeException));
		} catch(\TypeError $typeError) {
			throw(new \TypeError ($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for profiles favorite teams.
	 *
	 * @return int|null value of favoriteTeamProfileId
	 **/
	public function getFavoriteTeamProfileId() {
		return ($this->favoriteTeamProfileId);
	}

	/**
	 * mutator method for favoriteTeamProfileId
	 *
	 * @param int|null $newFavoriteTeamProfileId new value of the favoriteTeamProfileId
	 * @throws \RangeException if the $newFavoriteTeamProfileId is not positive
	 * @throws \TypeError if $favoriteTeamProfileId is not an integer
	 **/
	public function setFavoriteTeamProfileId(int $newFavoriteTeamProfileId) {
		//verify the favoriteTeamProfileId is positive
		if($newFavoriteTeamProfileId <= 0) {
			throw(new \RangeException("favoriteTeamProfileId is not a positive number"));
		}

		//verify the favoriteTeamProfileId is an integer.
		//if($newFavoriteTeamProfileId != int)
		//convert and store the favoriteTeamProfileId
		$this->favoriteTeamProfileId = $newFavoriteTeamProfileId;
	}

	/**
	 * accessor method for favoriteTeamTeamId
	 *
	 * @return int|null value of favoriteTeamTeamId
	 **/
	public function getFavoriteTeamTeamId() {
		return ($this->favoriteTeamTeamId);
	}

	/**
	 * mutator method for favoriteTeamTeamId
	 *
	 * @param int|null $newFavoriteTeamTeamId new value of the favoriteTeamProfileId
	 * @throws \RangeException if the $newFavoriteTeamTeamId is not positive
	 * @throws \TypeError if $favoriteTeamTeamId is not an integer
	 **/
	public function setFavoriteTeamTeamId(int $newFavoriteTeamTeamId)
		//verify the favorite team team id is an integer
		if($newFavoriteTeamTeamId <= 0) {
			throw(new \RangeException("favoriteTeamTeamId is not a positive number"));
		}
		//convert and store the favoriteTeamTeamId
		$this->favoriteTeamTeamId = $newFavoriteTeamTeamId;
	}

	/**
	 * Inserts this players favoriteTeamProfileId into the favorite table
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when db related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public static function insert(\PDO $pdo) {
		//enforce the favoriteTeamProfileId isn't already in the db
		if($this->favoriteTeamProfileId === null || $this->favoriteTeamTeamId) {
			throw(new \PDOException("ID's don't exist"));
		}

		//create query
		$query = "INSERT INTO favoriteTeam(favoriteTeamProfileId, favoriteTeamTeamId) VALUES(:favoriteTeamProfileId, :favoriteTeamTeamId)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["favoriteTeamProfileId" => $this->favoriteTeamProfileId, "favoriteTeamTeamId" => $this->favoriteTeamTeamId];
		$statement->excute($parameters);
	}

	/**
	 * Deletes this favorite team from associated favoriteTeamProfileId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when database related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public static function delete(\PDO $pdo) {
		if($this->favoriteTeamProfileId === null || $this->favoriteTeamTeamId === null) {
			throw(new \PDOException("Ids do not exist to delete"));
		}
		// Create query template
		$query = "DELETE FROM favoriteTeam WHERE favoriteTeamProfileId | favoriteTeamTeamId = :favoritePlayerProfileId | :favoriteTeamTeamId";
		$statement = $pdo->execute($query);

					// Bind the member variables to the place holders in template
		$parameters = ["favoriteTeamProfileId" => $this->favoriteTeamProfileId, "favoriteTeamTeamId" => $this->favoriteTeamTeamId]; $statement->excute($parameters);
	}
	/**
	* gets a team to favorite by the name
	*
	* @param \PDO $pdo connection object
	* @param string $FavoriteTeam to search for
	* @return \SplFixedArray SplFixedArray of favorite teams found
	* @throws \PDOException when db related errors occur
	* @throws \TypeError when variables are not correct data type
	* public static function getFavoriteTeamByFavoriteTeamName(\PDO $pdo, string $teamName)
	**/

	/**
	* gets a favoriteTeam by the favoriteTeamTeamId
	*
	* @param \PDO $pdo connection object
	* @param int $FavoriteTeam to search for
	* @return \SplFixedArray SplFixedArray of favorite teams found
	* @throws \PDOException when db related errors occur
	* @throws \TypeError when variables are not correct data type
	**/
	public static function getFavoriteTeamByFavoriteTeamTeamId(\PDO $pdo, int $favoriteTeamTeamId) {
		// sanitize favoriteTeamTeamId number before searching
		if($favoriteTeamTeamId <= 0) {
			throw(new \PDOException("that favoriteTeamTeamId is not positive"));
		}

		// create query template
		$query = "SELECT favoriteTeamTeamId FROM favoriteTeam WHERE favoriteTeamTeamId = :favoriteTeamTeamId";
		$statement = $pdo->prepare($query);

		// bind the favoriteTeamTeamId to the place holder in the template
		$parameters = array("favoriteTeamTeamId" => $favoriteTeamTeamId);
		$statement->execute($parameters);

		// grab the team from the db
		try{
			$favoriteTeam = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$favoriteTeam = new FavoriteTeam($row["favoriteTeamTeamId"]);
			}
		} catch(\Exception $exception) {
			// if the row can't be converted rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($favoriteTeam)
	}

	/**
	* gets the list of this profiles favorite teams
	*
	* @param \PDO $pdo connection object
	* @param int $allFavoriteTeams search for
	* @return \SplFixedArray SplFixedArray of all teams favorited found
	* @throws \PDOException when db related errors occur
	* @throws \TypeError when variables are not correct data type
	**/
	public static function getFavoriteTeamsByFavoriteTeamProfileId(\PDO $pdo, int $favoriteTeamProfileId) {
		// create a query template
		$query = "SELECT favoriteTeamProfileId, favoriteTeamTeamId FROM favoriteTeam WHERE favoriteTeamProfileId = :favoriteTeamProfileId";
		$statement = $pdo->prepare($query);

		// bind the favoriteTeamTeamId to the place holder in the template
		$parameters = array("favoriteTeamProfileId" => $favoriteTeamProfileId, "favoriteTeamTeamId" => $favoriteTeamTeamId);
		$statement->execute($parameters);

		// build an array of favorite teams
		$favoriteTeams = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$favoriteTeam = new FavoriteTeam($row["favoriteTeamProfileId"], $row["favoriteTeamTeamId"]);
				$favoriteTeams[$favoriteTeams->key()] = $favoriteTeam;
			} catch(\Exception $exception) {
				// if the row can't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($favoriteTeams)
	}
}
