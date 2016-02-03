<?php

/** @author Michael Prinz mprinz1@cnm.edu */
/**require_once("autoloader.php"); http://www.php-fig.org/psr/psr-4/ */
namespace Cnm\Edu\mprinz1\sprots\Profile;


Class Profile {
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
	 * @var int $profileHash
	 **/
	private $profileHash;
	/**
	 * Salt of profile
	 * @var int $profileSalt
	 **/
	private $profileSalt;

	/**
	 * Profile constructor.
	 * @param int|null $newProfileId
	 * @param string $newProfileUserName
	 * @param string $newProfileEmail
	 * @param $newProfileHash
	 * @param null $newProfileSalt
	 * @throws \InvalidArgumentException if data types are invalid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \Exception is some other exception occurs
	 */
	public function __construct(int $newProfileId = null, string $newProfileUserName, string $newProfileEmail, $newProfileHash, $newProfileSalt = null) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileUserName($newProfileUserName);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileSalt($newProfileSalt);
		}catch (\InvalidArgumentException $invalidArgument) {
			throw (new \InvalidArgumentException($invalidArgument->getMessage(),0, $invalidArgument));
		}catch (\RangeException $range) {
			throw (new \RangeException($range->getMessage(),0,$range));
		}catch (\Exception $exception) {
			throw (new \Exception($exception->getMessage(),0,$exception));
		}
	}


	/**
	 * mutator method for profile id
	 *
	 * @param int $newProfileId new value of profile id
	 * @throws \InvalidArgumentException if $newProfileId is not an integer
	 **/
	public function setProfileId($newProfileId) {
		//base case: if the profile id is null, this is a new profile without a mySQL assigned id (yet)
		if($newProfileId === null) {
			$this->profileId = null;
			return;
		}

		//first apply the filter to the input
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT);

		//if filter_var() rejects the new id, throw an Exception
		if($newProfileId === false) {
			throw(new \InvalidArgumentException("profile id is not an integer"));

			//save the object
			$this->profileId = $newProfileId;
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @return int value of profile id
	 **/
	public function getProfileId() {
		return ($this->profileId);
	}

	/**
	 * mutator method for Profile User Name
	 * @param string $newProfileUserName new value of profileUserName
	 * @throws \InvalidArgumentException if $newProfileUserName is not a string
	 * @throws \RangeException if
	 */

	public function setProfileUserName(string $newProfileUserName) {
		$newProfileUserName = trim($newProfileUserName);
		$newProfileUserName = filter_var($newProfileUserName, FILTER_SANITIZE_STRING);
		if($newProfileUserName === false)
			throw (new  ("User name already exits")}

	/**
	 * accessor method for Profile User Name
	 */
	public function getProfileUserName() {
		return ($this->profileUserName);
	}

	/**
	 * mutator method for profile Email
	 *
	 * @param string $newProfileEmail
	 * @throw  if $newProfileEmail is not a valid email
	 */
	public function setProfileEmail($newProfileEmail) {
		//verify the email is secure
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);

		if ($newProfileEmail = false)
			throw (new \Exception ("invalid email"));
		//store the email content
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * profileHash mutator method
	 * @param $newProfileHash
	 */
	public function setProfileHash($newProfileHash) {
		$newProfileHash = }
}

?>