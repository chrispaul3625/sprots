<?php

/** @author Michael Prinz mprinz1@cnm.edu */

namespace Cnm\Edu\mprinz1\sprots;
require_once("autoloader.php");

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

	public function __construct(int $newProfileId = null, string $newProfileUserName, string $newProfileEmail, $newProfileHash, $newProfileSalt = null) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileUserName($newProfileUserName);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileSalt($newProfileSalt);
		} catch
	}


	/**
	 * mutator method for profile id
	 *
	 * @param int $newProfileId new value of profile id
	 * @throws TypeError if $newProfileId is not an integer
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
			throw(new TypeError("profile id is not an integer"));

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
	 * @throws TypeError if $newProfileUserName is not a string
	 * @throws
	 */

	public function setProfileUserName(string $newProfileUserName) {
		$newProfileUserName = trim($newProfileUserName);
		$newProfileUserName = filter_var($newProfileUserName, FILTER_SANITIZE_STRING);
		if($newProfileUserName === false)
			throw (new TypeError ("User name already exits")}

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
	 * @throw type error if $newProfileEmail is not a valid email
	 */
	public function setProfileEmail($newProfileEmail) {
		//verify the email is secure
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);

		if ($newProfileEmail = false)
			throw (new \Exception ("invalid email"));
		//store the email content
		$this->profileEmail = $newProfileEmail;
	}

	public function setProfileHash($newProfileHash) {
		$newProfileHash = }
}
hello
?>