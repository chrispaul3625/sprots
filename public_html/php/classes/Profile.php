<?php

namespace Edu\Cnm\Sprots;


require_once("autoload.php");

class Profile {
	/**
	 * id for this Profile; this is the primary key
	 * @var int $profileId
	 **/
	private $profileId;
	/**
	 * User Name of user
	 * @var string $profileUserName
	 **/
	private $profileUserName;
	/**
	 * Email of user
	 * @var string $profileEmail
	 **/
	private $profileEmail;
	/**
	 * Hash of profile
	 * @var string $profileHash
	 **/
	private $profileHash;
	/**
	 * Salt of profile
	 * @var string $profileSalt
	 **/
	private $profileSalt;

	/**
	 * Profile constructor.
	 * @param int $newProfileId
	 * @param string $newProfileUserName
	 * @param string $newProfileEmail
	 * @param string $newProfileHash
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if data types are invalid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \Exception is some other exception occurs
	 **/
	public function __construct($newProfileId, string $newProfileUserName, string $newProfileEmail, $newProfileHash, $newProfileSalt) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileUserName($newProfileUserName);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileSalt($newProfileSalt);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw (new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw (new \RangeException($range->getMessage(), 0, $range));
		} catch(\Exception $exception) {
			throw (new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * mutator method for profileId
	 *
	 * @param int $newProfileId new value of profileId
	 * @throws \RangeException if $newProfileId is not positive
	 *
	 **/
	public function setProfileId(int $newProfileId = null) {
		//base case: if the profile id is null, this is a new profile without a mySQL assigned id (yet)
		if($newProfileId === null) {
			$this->profileId = null;
			return;
		}

		//first apply the filter to the input
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT);

		//if filter_var() rejects the new id, throw an Exception
		if($newProfileId <= 0) {
			throw(new \RangeException("profile id is not positive"));
		}

		//save the object
		$this->profileId = $newProfileId;
	}


	/**
	 * accessor method for profileId
	 *
	 * @return int value of profileId
	 **/
	public function getProfileId() {
		return ($this->profileId);
	}

	/**
	 * mutator method for profileUserName
	 *
	 * @param string $newProfileUserName new value of profileUserName
	 * @throws \InvalidArgumentException if $newProfileUserName is not a string
	 * @throws \RangeException if $newProfileUserName is >25 characters
	 *
	 **/

	public function setProfileUserName(string $newProfileUserName) {
		$newProfileUserName = trim($newProfileUserName);
		$newProfileUserName = filter_var($newProfileUserName, FILTER_SANITIZE_STRING);
		if($newProfileUserName === false)
			throw (new \InvalidArgumentException ("User name invalid"));
		if(strlen($newProfileUserName) > 32)
			throw (new \RangeException ("User name must be less than 32 characters"));

		//save the object//
		$this->profileUserName = $newProfileUserName;
	}

	/**
	 * accessor method for profileUserName
	 *
	 * @return string value for profileUserName
	 *
	 **/
	public function getProfileUserName() {
		return ($this->profileUserName);
	}

	/**
	 * mutator method for profileEmail
	 *
	 * @param string $newProfileEmail new value of profileEmail
	 * @throws \Exception if $newProfileEmail is not a valid email
	 *
	 **/
	public function setProfileEmail($newProfileEmail) {
		//verify the email is secure//
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);

		if($newProfileEmail === false)
			throw (new \Exception ("invalid email"));

		/**store the email content**/
		$this->profileEmail = $newProfileEmail;
	}

	/** accessor method for profileEmail
	 *
	 * @return string value of profileEmail
	 **/

	public function getProfileEmail() {
		return ($this->profileEmail);
	}


	/**
	 * mutator method for profileHash
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if hash value is not a string
	 * @throws \RangeException if profile hash is !== 128
	 *
	 **/
	public function setProfileHash(string $newProfileHash) {
		$newProfileHash = filter_var($newProfileHash, FILTER_SANITIZE_STRING);

		if($newProfileHash === false) {
			throw (new\InvalidArgumentException("profile hash cannot be null"));
		}

		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash has to be 128"));
		}

		//convert and store profile activation
		$this->profileHash = $newProfileHash;
	}


	/**
	 * accessor method for profileHash
	 *
	 * @return string value of profileHash
	 **/
	public function getProfileHash() {
		return ($this->profileHash);
	}

	/**
	 * mutator method for profileSalt
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if salt is not a string
	 * @throws \RangeException if $newProfileSalt is !=64
	 *
	 **/
	public function setProfileSalt($newProfileSalt) {
		// verify salt is exactly string of 64
		if((ctype_xdigit($newProfileSalt)) === false) {
			if(empty($newProfileSalt) === true) {
				throw new InvalidArgumentException ("salt invalid");
			}
			if(strlen($newProfileSalt) !== 64) {
				throw (new RangeException ("salt not valid"));
			}
		}
		$this->profileSalt = $newProfileSalt;
	}

	// public function setProfileSalt($newProfileSalt) {
	// 	$newProfileSalt = filter_var($newProfileSalt, FILTER_SANITIZE_STRING);
	//
	// 	if($newProfileSalt === false) {
	// 		throw (new \InvalidArgumentException("salt must be a string value"));
	//
	// 		//make sure profile salt =  64
	//
	// 		if($newProfileSalt !== 64) {
	// 			throw(new \RangeException("profile salt has to be 64"));
	//
	// 		}
	// 		$this->profileSalt = $newProfileSalt;
	// 	}
	// }

	/**accessor method for profileSalt
	 *
	 * @return string value of profileSalt
	 */

	public function getProfileSalt() {
		return ($this->profileSalt);

	}

	/**Inserts this Profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 **/
	public function insert(\PDO $pdo) {
		if($this->profileId !== null) {
			throw (new \PDOException ("this profile already exists"));
		}
		//create query template//
		$query = "INSERT INTO profile(profileUserName, profileEmail, profileHash, profileSalt) VALUES (:profileUserName, :profileEmail, :profileHash, :profileSalt)";
		$statement = $pdo->prepare($query);

		$parameters = array("profileUserName" => $this->profileUserName, "profileEmail" => $this->profileEmail, "profileHash" => $this->getProfileHash(), "profileSalt" => $this->getProfileSalt());
		$statement->execute($parameters);
		$this->profileId = intval($pdo->lastInsertId());
	}

	/** Deletes this profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 *
	 */

	public function delete(\PDO $pdo) {
		if($this->profileId === null) {
			throw(new \PDOException("unable to delete a profile that does not exist"));
		}

		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileId" => $this->profileId];
		$statement->execute($parameters);
	}

	/** Updates the profile in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related error occurs
	 * @throws \RuntimeException if $pdo is not a PDO connection
	 **/
	public function update(\PDO $pdo) {
		if($this->profileId === null) {
			throw(new \PDOException("unable to update a profile that hasn't been entered"));
		}
		//create query template
		$query = "UPDATE profile SET profileUserName = :profileUserName, profileEmail = :profileEmail, profileHash = :profileHash, profileSalt = :profileSalt WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileUserName" => $this->profileUserName, "profileEmail" => $this->profileEmail, "profileHash" => $this->profileHash, "profileSalt" => $this->profileSalt, "profileId" => $this->profileId];
		$statement->execute($parameters);
	}

	/** this function retrieves a profile by using profileId
	 * @param \PDO $pdo -pdo connection object
	 * @param int $profileId to look for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 *
	 */


	public static function getProfileByProfileId(\PDO $pdo, int $profileId) {
		// sanitize the profileId before searching
		if($profileId <= 0) {
			throw(new \PDOException("profile id is not positive"));
		}

		// create query template
		$query = "SELECT profileId, profileUserName, profileEmail, profileHash, profileSalt FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// bind the profile id to the place holder in the template
		$parameters = array("profileId" => $profileId);
		$statement->execute($parameters);

		// grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileUserName"], $row["profileEmail"],
					$row["profileHash"], $row["profileSalt"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($profile);
	}


	/** this function retrieves a profile by using profileUserName
	 * @param \PDO $pdo -pdo connection object
	 * @param string $profileUserName to look for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 *
	 */


	public static function getProfileByProfileUserName(\PDO $pdo, string $profileUserName) {
		// sanitize the description before searching
		$profileUserName = trim($profileUserName);
		$profileUserName = filter_var($profileUserName, FILTER_SANITIZE_STRING);
		if(empty($profileUserName) === true) {
			throw(new \PDOException("profile user name is invalid"));
		}


		// create query template
		$query = "SELECT profileId, profileUserName, profileEmail, profileHash, profileSalt FROM profile WHERE profileUserName = :profileUserName";
		$statement = $pdo->prepare($query);

		// bind the profile id to the place holder in the template
		$parameters = array("profileUserName" => $profileUserName);
		$statement->execute($parameters);

		// grab the profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileUserName"], $row["profileEmail"],
					$row["profileHash"], $row["profileSalt"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($profile);
	} //get profile by user name


	/** this function retrieves a profile by using profileEmail
	 * @param \PDO $pdo pdo connection object
	 * @param string $profileEmail to look for
	 * @return Profile|null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 *
	 */


	public static function getProfileByProfileEmail(\PDO $pdo, string $profileEmail) {

		// validate the profileEmail before searching
		$profileEmail = filter_var($profileEmail, FILTER_SANITIZE_STRING);
		if(empty($profileEmail) === true) {
			throw(new \PDOException("profile email is not valid"));
		}


		// create query template
		$query = "SELECT profileId, profileUserName,profileEmail, profileHash, profileSalt FROM profile WHERE profileEmail = :profileEmail";
		$statement = $pdo->prepare($query);

		// bind the profile email to the place holder in the template
		$parameters = array("profileEmail" => $profileEmail);
		$statement->execute($parameters);

		// grab the profile from mySQL
		try {

			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileUserName"], $row["profileEmail"],
					$row["profileHash"], $row["profileSalt"]);
			}

		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		return $profile;

	}
} //end of class
?>
