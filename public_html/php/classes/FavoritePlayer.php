<?php

namespace Edu\Cnm\Sprots;

require_once("autoload.php");

//This is the class for users to select favorite player(s)//

class FavoritePlayer implements \JsonSerializable{

	/**
	 * Id for this FavoritePlayer class, this is the foreign key
	 * @var int $favoritePlayerProfileId
	 **/
	private $favoritePlayerProfileId;
	/**
	 * Id for the player being favorited
	 * @var int $favoritePlayerPlayerId
	 */
	private $favoritePlayerPlayerId;

	/**
	 * constructor for favoriting a Player
	 *
	 * @param int $newFavoritePlayerProfileId this will be inherited from the profileId
	 * @param int $newFavoritePlayerPlayerId this will be inherited from the playerId
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

	public function __construct(int $newFavoritePlayerProfileId, int $newFavoritePlayerPlayerId) {

		try {
			$this->setFavoritePlayerProfileId($newFavoritePlayerProfileId);
			$this->setFavoritePlayerPlayerId($newFavoritePlayerPlayerId);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $rangeException) {
			throw(new \RangeException ($rangeException->getMessage(), 0, $rangeException));
		} catch(\Exception $exception) {
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for favorite player profile id
	 *
	 * @return int|null value of favoritePlayerProfileId
	 **/

	public function getFavoritePlayerProfileId() {
		return ($this->favoritePlayerProfileId);
	}


	/**
	 * mutator method for favoritePlayerProfileId
	 *
	 * @param int|null $newFavoritePlayerProfileId new value of the favoritePlayerProfileId
	 * @throws \Exception if the $newFavoritePlayerProfileId is not positive
	 * @return int $newFavoritePlayerProfileId
	 **/

	public function setFavoritePlayerProfileId(int $newFavoritePlayerProfileId) {
		if($newFavoritePlayerProfileId === null) {
			throw (new \Exception ("new favorite player profile Id cannot be null"));

		}
		return $this->favoritePlayerProfileId = $newFavoritePlayerProfileId;
	}

	/**
	 * accessor method for favoritePlayerPlayerId
	 *
	 * @return int value of favorite player Id
	 **/

	public function getFavoritePlayerPlayerId() {
		return ($this->favoritePlayerPlayerId);
	}

	/**
	 * mutator method for favoritePlayerPlayerId
	 *
	 * @param int|null $newFavoritePlayerPlayerId new value of the favoritePlayerProfileId
	 * @throws \Exception if the $newFavoritePlayerPlayerId is null
	 * @return int $newFavoritePlayerPlayerId
	 **/

	public function setFavoritePlayerPlayerId(int $newFavoritePlayerPlayerId) {
		if($newFavoritePlayerPlayerId === null) {
			throw (new \Exception ("new favorite player player Id cannot be null"));

		}

		return $this->favoritePlayerPlayerId = $newFavoritePlayerPlayerId;
	}

	/**
	 * Inserts a favorite player into the FavoritePlayer class
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/

	public function insert(\PDO $pdo) {
		if($this->favoritePlayerProfileId === null) {
			throw(new \PDOException("profile id does not exist"));
		}
		if($this->favoritePlayerPlayerId === null) {
			throw(new \PDOException("player id doesn't exist"));
		}
		//create query template
		$query = "INSERT INTO favoritePlayer(favoritePlayerProfileId, favoritePlayerPlayerId) VALUES (:favoritePlayerProfileId, :favoritePlayerPlayerId)";
		$statement = $pdo->prepare($query);

		$parameters = ["favoritePlayerProfileId" => $this->favoritePlayerProfileId, "favoritePlayerPlayerId" => $this->favoritePlayerPlayerId];
		$statement->execute($parameters);

		//insert with what mySQL just gave us
		// $this->favoritePlayerProfileId = intval($pdo->lastInsertId());

	}

	/**
	 * Deletes a favorite player from the FavoritePlayer class
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/

	public function delete(\PDO $pdo) {
		if($this->favoritePlayerProfileId === null) {
			throw(new \PDOException("profile id does not exist"));
		}
		if($this->favoritePlayerPlayerId === null) {
			throw(new \PDOException("player id doesn't exist"));
		}
		//create query template
		$query = "DELETE FROM favoritePlayer WHERE favoritePlayerProfileId = :favoritePlayerProfileId AND favoritePlayerPlayerId = :favoritePlayerPlayerId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["favoritePlayerProfileId" => $this->favoritePlayerProfileId, "favoritePlayerPlayerId" => $this->favoritePlayerPlayerId];
		$statement->execute($parameters);

	}

	/**
	 * updates this favorite player in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/

	public function update(\PDO $pdo) {
		//enforce the Profile and Player id's are not null
		if($this->favoritePlayerProfileId === null || $this->favoritePlayerPlayerId === null) {
			throw(new \PDOException("Ids do not exist to update"));
		}
		//create query template
		$query = "UPDATE favoritePlayer SET favoritePlayerProfileId = :favoritePlayerProfileId, favoritePlayerPlayerId = :favoritePlayerPlayerId";
		$statement = $pdo->prepare($query);

		$parameters = ["favoritePlayerProfileId" => $this->favoritePlayerProfileId, "favoritePlayerPlayerId" => $this->favoritePlayerPlayerId];
		$statement->execute($parameters);
	}//end of update function

	/**
	 * get a favorite player by favorite player id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $playerId
	 * @return \SplFixedArray SplFixedArray of Favorite Players found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getFavoritePlayerByFavoritePlayerProfileIdAndFavoritePlayerPlayerId(\PDO $pdo, int $favoritePlayerProfileId, int $favoritePlayerPlayerId) {
		if($favoritePlayerProfileId <= 0) {
			throw(new \PDOException("profile id is not positive"));
		}
		//Sanitize the team id
		if($favoritePlayerPlayerId <= 0) {
			throw(new \PDOException("Player Id is not positive"));
		}
		// create query template
		$query = "SELECT favoritePlayerProfileId, favoritePlayerPlayerId FROM favoritePlayer WHERE favoritePlayerProfileId = :favoritePlayerProfileId AND favoritePlayerPlayerId = :favoritePlayerPlayerId";
		$statement = $pdo->prepare($query);
		$parameters = ["favoritePlayerProfileId" => $favoritePlayerProfileId, "favoritePlayerPlayerId" => $favoritePlayerPlayerId];
		$statement->execute($parameters);

		// build an array of favorite players
		// $favoritePlayers= new \SplFixedArray($statement->rowCount());
		// while(($row = $statement->fetch()) !== false)
		try {
			$favoritePlayer = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$favoritePlayer = new FavoritePlayer($row["favoritePlayerProfileId"], $row["favoritePlayerPlayerId"]);
			}
			// $favoritePlayers[$favoritePlayers->key()] = $favoritePlayer;
			// $favoritePlayers->next();
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($favoritePlayer);
	}

	/**
	 * get a favorite player by profile id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $profileId
	 * @return \SplFixedArray SplFixedArray of Favorite Players found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/

	public static function getFavoritePlayersByFavoritePlayerProfileId(\PDO $pdo, int $favoritePlayerProfileId) {

		if($favoritePlayerProfileId <= 0) {
			throw(new \PDOException("this profile doesn't exist"));
		}
		// create query template
		$query = "SELECT favoritePlayerProfileId, favoritePlayerPlayerId  FROM favoritePlayer WHERE favoritePlayerProfileId = :favoritePlayerProfileId";
		$statement = $pdo->prepare($query);
		$parameters = ["favoritePlayerProfileId" => $favoritePlayerProfileId];
		$statement->execute($parameters);

		// build an array of favorite players
		$favoritePlayers = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$favoritePlayer = new FavoritePlayer($row["favoritePlayerProfileId"], $row["favoritePlayerPlayerId"]);
				$favoritePlayers[$favoritePlayers->key()] = $favoritePlayer;
				$favoritePlayers->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($favoritePlayers);
	}
	public function jsonSerialize() {
		return(get_object_vars($this));
	}
} //end of class
