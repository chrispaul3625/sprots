<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\Profile;

require_once("SprotsTest.php");

require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Profile class
 *
 * This is a complete PHPUnit test of the Profile class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Profile
 * @author Mike Prinz <mnprinz@gmail.com>
 **/
Class ProfileTest extends SprotsTest {


	/**
	 * profile user name
	 * @var string $VALID_PROFILEUSERNAME
	 */
	protected $VALID_PROFILEUSERNAME = "PHPUnit test pass";

	/**
	 * another profile user name
	 * @var string $VALID_PROFILEUSERNAME_2
	 */

	protected $VALID_PROFILEUSERNAME_2 = "Ronald McDonald";

	/**
	 * profile email
	 * @var string $VALID_PROFILEEMAIL
	 */
	protected $VALID_PROFILEEMAIL = "mike@mike.com";

	/**
	 * another profile email
	 * @var string $VALID_PROFILEEMAIL_2
	 */

	protected $VALID_PROFILEEMAIL_2 = "prinz@prinz.com";

	protected $salt;

	protected $hash;


	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();
		//Generate Php 7 hash and salt //
		$password = "abc123";
		$this->salt = bin2hex(openssl_random_pseudo_bytes(32));
		$this->hash = hash_pbkdf2("sha512", $password, $this->salt, 262144, 128);
	}

	/**
	 * test inserting a valid profile and verify that the actual mySQL data matches
	 **/
	public function testInsertValidProfile() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a new profile and insert it into mySQL//

		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectation
		$pdoProfile = Profile::getProfilebyProfileId($this->getPDO(), $profile->getProfileid());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileUserName(), $profile->getProfileUserName());
		$this->assertEquals($pdoProfile->getProfileEmail(), $profile->getProfileEmail());
		$this->assertEquals($pdoProfile->getProfileHash(), $profile->getProfileHash());
		$this->assertEquals($pdoProfile->getProfileSalt(), $profile->getProfileSalt());
	}

	/**
	 * test inserting a Profile that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidProfile() {
		//create new profile with a null profile Id and watch it fail
		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->insert($this->getPDO());

		//insert profile again and watch it fail
		$profile->insert($this->getPDO());
	}


	/**
	 * test inserting a Profile with an invalid profile id
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertWithInvalidProfileId() {
		//create new profile with a null profile Id and watch it fail
		$profile = new Profile(SprotsTest::INVALID_KEY, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->insert($this->getPDO());

	}

	/**
	 * test inserting a Profile, editing it, and then updating it
	 **/
	public function testUpdateValidProfile() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->insert($this->getPDO());

		// edit the Profile and update it in mySQL
		$profile->setProfileUserName($this->VALID_PROFILEUSERNAME_2);
		$profile->setProfileEmail($this->VALID_PROFILEEMAIL_2);
		$profile->setProfileHash($this->hash);
		$profile->setProfileSalt($this->salt);
		$profile->update($this->getPDO());


		//grab the data from mySQL and enforce the fields match our expectation
		$pdoProfile = Profile::getProfilebyProfileId($this->getPDO(), $profile->getProfileId());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileUserName(), $this->VALID_PROFILEUSERNAME_2);
		$this->assertEquals($pdoProfile->getProfileEmail(), $profile->getProfileEmail());
		$this->assertEquals($pdoProfile->getProfileHash(), $profile->getProfileHash());
		$this->assertEquals($pdoProfile->getProfileSalt(), $profile->getProfileSalt());

	}

	/**
	 * test updating a Profile that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidProfile() {
		// create a Profile with a non null profile id and watch it fail
		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->update($this->getPDO());
	}

	/**
	 * test creating a Profile and then deleting it
	 **/
	public function testDeleteValidProfile() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new Profile and insert to into mySQL
		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->insert($this->getPDO());

		// delete the Profile from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$profile->delete($this->getPDO());

		// grab the data from mySQL and enforce the Profile does not exist
		$pdoProfile = Profile::getProfilebyProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertNull($pdoProfile);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("profile"));
	}

	/**
	 * test deleting a Profile that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidProfile() {
		// create a Profile and try to delete it without actually inserting it
		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->delete($this->getPDO());
	}

	/**
	 * test grabbing a Profile that does not exist
	 **/
	public function testGetInvalidProfileByProfileId() {
		//grab a profile with invalid profile Id and watch it fail
		$profile = Profile::getProfileByProfileId($this->getPDO(), SprotsTest::INVALID_KEY);
		$this->assertNull($profile);
	}

	/**
	 * test grabbing a Profile by profile user name
	 **/
	public function testGetValidProfileByProfileUserName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new Profile and insert it into mySQL
		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileUserName($this->getPDO(), $profile->getProfileUserName());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileUserName(), $profile->getProfileUserName());
		$this->assertEquals($pdoProfile->getProfileEmail(), $profile->getProfileEmail());
		$this->assertEquals($pdoProfile->getProfileHash(), $profile->getProfileHash());
		$this->assertEquals($pdoProfile->getProfileSalt(), $profile->getProfileSalt());
	}

	/**
	 * test grabbing a Profile by user name that does not exist
	 **/
	public function testGetProfileByInvalidProfileUserName() {
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileUserName($this->getPDO(), "That profile user name doesn't exist");
		$this->assertNull($pdoProfile);
	}

	/**
	 * test grabbing a Profile by profile email
	 **/
	public function testGetValidProfileByProfileEmail() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new Profile and insert it into mySQL
		$profile = new Profile(null, $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL, $this->hash, $this->salt);
		$profile->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfileByProfileEmail($this->getPDO(), $profile->getProfileEmail());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileUserName(), $profile->getProfileUserName());
		$this->assertEquals($pdoProfile->getProfileEmail(), $profile->getProfileEmail());
		$this->assertEquals($pdoProfile->getProfileHash(), $profile->getProfileHash());
		$this->assertEquals($pdoProfile->getProfileSalt(), $profile->getProfileSalt());
	}

	/**
	 * test grabbing a Profile by email that does not exist
	 **/
	public function testGetProfileByInvalidProfileEmail() {
		$pdoProfile = Profile::getProfileByProfileEmail($this->getPDO(), "This email doesn't exist");
		$this->assertNull($pdoProfile);
	}

}
