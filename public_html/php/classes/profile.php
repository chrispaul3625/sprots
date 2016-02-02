<?php
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
	 * mutator method for profile id
	 *
	 * @param int $newProfileId new value of profile id
	 * @throws TypeError if $newProfileId is not an integer
	 * @throws RangeException if $newProfileId is negative
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
