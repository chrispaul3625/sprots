<?php

namespace Cnm\Edu\Sprots\;

//require_once (autoload.php);//

//This is the class for users to select favorite player(s)//
Class FavoritePlayer {

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

}

		public function __construct(int $favoritePlayerProfileId, int $favoritePlayerPlayerId) {

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
 		* @throws \RangeException if the $newFavoritePlayerProfileId is not positive
		 **/

			public function setFavoritePlayerProfileId(int $newFavoritePlayerProfileId) {
				if($newFavoritePlayerProfileId === null) {
					$this->$favoritePlayerProfileId = null;
					return;
			}

			//verify the favoritePlayerProfileId is an integer
				if($newFavoritePlayerProfileId != int) {
					throw(new \RangeException("favoritePlayerProfileId is not an integer"));
			}


		//convert and store the favoritePlayerProfileId
				$this->favoritePlayerProfileId = $newFavoritePlayerProfileId;
	}
		/**
 		* accessor method for favoritePlayerPlayerId
 		*
 		* @param int|null $newFavoritePlayerPlayerId
 		* @throws \RangeException if the $newFavoritePlayerPlayerId is not positive
		 **/

		public function getFavoritePlayerPlayerId() {
			return ($this->favoritePlayerPlayerId);
		}

		/**
 		* mutator method for favoritePlayerPlayerId
 		*
 		* @param int|null $newFavoritePlayerPlayerId new value of the favoritePlayerProfileId
 		* @throws \RangeException if the $newFavoritePlayerPlayerId is not positive
 		**/

		public function setFavoritePlayerPlayerId(int $newFavoritePlayerPlayerId) {
			if($newFavoritePlayerPlayerId === null) {
			$this->$favoritePlayerPlayerId = null;
				return;
		}

			//verify the favoritePlayerPlayerId is positive
				if($newFavoritePlayerPlayerId <= 0) {
					throw(new \RangeException("favoritePlayerPlayerId is not a positive number"));
			}


		//verify the favoritePlayerPlayerId is an integer.
		//if($newFavoritePlayerProfileId != int)
		//convert and store the favoritePlayerPlayerId
		$this->favoritePlayerPlayerId = $newFavoritePlayerPlayerId;
		}

		/**
 		* Inserts this favorite player into the FavoritePlayer class
 		*
 		* @param \PDO $pdo PDO connection object
 		* @throws \PDOException when mySQL related errors occur
 		**/

			public function insert(\PDO $pdo) {
					if($this->favoritePlayerProfileId === null || $this->favoritePlayerPlayerId) {
						throw(new \PDOException("Id doesn't exist"));
					}
					//create query template
					$query = "INSERT INTO favoritePlayer(favoritePlayerProfileId, favoritePlayerPlayerId) VALUES (:favoritePlayerProfileId, favoritePlayerPlayerId)";
					$statement = $pdo->prepare($query);

					$parameters = ["favoritePlayerProfileId" => $this->favoritePlayerProfileId, "favoritePlayerPlayerId" => $this->favoritePlayerPlayerId];
					$statement->execute($parameters);

					//insert with what mySQL just gave us
						$this->favoritePlayerProfileId = intval($pdo->lastInsertId());

			}

			/**
			* Deletes this favorite player from the FavoritePlayer class
 			*
 			* @param \PDO $pdo PDO connection object
 			* @throws \PDOException when mySQL related errors occur
 			**/

				public function delete(\PDO $pdo) {
					if($this->favoritePlayerProfileId === null || $this->favoritePlayerPlayerId === null) {
						throw(new \PDOException("unable to delete favorite player profile that does not exist"));

			}

				//create query template
					$query = "DELETE FROM favoritePlayer WHERE favoritePlayerProfileId  | favoritePlayerPlayerId = :favoritePlayerProfileId | :favoritePlayerPlayerId";
						$statement = $pdo->prepare($query);

					// bind the member variables to the place holder in the template
						$parameters = ["favoritePlayerProfileId" => $this->favoritePlayerProfileId, "favoritePlayerPlayerId" => $this->favoritePlayerPlayerId];
						$statement->excute($parameters);

		}
				/**
				 * updates this profiles favorite team in mySQL
				 *
				 * @param \PDO $pdo PDO connection object
				 * @throws \PDOException when mySQL related errors occur
				 **/

				 public function update(\PDO $pdo) {
					 //enforce the id's are not null
					 if($this->favoritePlayerProfileId === null || $this->favoriteTeamTeamId === null) {
						 throw(new \PDOException("Ids do not exist to update"));
					 }
					 //create query template
					 $query = "UPDATE favoritePlayer SET favoritePlayerProfileId = :favoritePlayerPlayerId";
					 $statement->($parameters);

					 $parameters = ["favoritePlayerProfileId" => $this->favoritePlayerProfileId, "favoritePlayerPlayerId" => $this->favoritePlayerPlayerId];
					 $statement->excute($parameters);
				 }
