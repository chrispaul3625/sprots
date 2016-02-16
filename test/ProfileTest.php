<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\Profile;

//Generate Php 7 hash and salt //
$password = "abc123";
$salt = bin2hex(random_bytes(16));
$hash = hash_pbkdf2("sha512", $password, $salt, 262144);

require_once ("SprotsTest.php");

require_once (dirname(__DIR__) . "/public_html/php/classes/autoload.php");

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
	 * content of user name
	 * @var string $VALID_PROFILEUSERNAME
	 */
	protected $VALID_PROFILEUSERNAME = "PHPUnit test pass";
	/**
	 * content of updated user
	 * @var string $VALID_PROFILEUSERNAME2
	 */
	protected $VALID_PROFILEUSERNAME2 = "PHPUnit test still passing";
	/**
	 * content of profile email
	 * @var $VALID_PROFILEEMAIL
	 */
	protected $VALID_PROFILEEMAIL = "PHPUnit test pass";

	/**
	 * content of profile hash
	 * @var string $VALID_PROFILEHASH
	 */
	protected $VALID_PROFILEHASH = "PHPUnit test pass";

	/**
	 * content of profile salt
	 * @var $VALID_PROFILESALT
	 */
	protected $VALID_PROFILESALT = "PHPUnit test pass";

	protected $profile = null;

	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();
		//create and insert a profile to own the test user
		$this->profile = new Profile(null);
		$this->profile->insert($this->getPDO());
	}

	/**
	 * test inserting a valid profile and verify that the actual mySQL data matches
	 **/
	public function testInsertValidProfile() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		//create a new profile and insert it into mySQL
		$profile = new Profile(null, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME);
		$profile->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectation
		$pdoProfile = Profile::getProfilebyProfileId($this->$PDO(), $profile->getProfileid());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileFirstName(), $this->VALID_PROFILEUSERNAME);
	}

	/**
	 * test inserting a Profile that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidProfile() {
		//create new profile with a null profile Id and watch it fail
		$profile = new Profile(SprotsTest::INVALID_KEY, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME);
		$profile->$this->insert($this->getPDO());
	}

	/**
	 * test inserting a Profile, editing it, and then updating it
	 **/
	public function testUpdateValidProfile() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new Profile and insert to into mySQL
		$profile = new Profile(null, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL);
		$profile->insert($this->getPDO());

		// edit the Profile and update it in mySQL
		$profile->setProfile($this->VALID_PROFILEUSERNAME2);
		$profile->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfilebyProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileUserName(), $this->VALID_PROFILEUSERNAME);

	}

	/**
	 * test updating a Profile that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidProfile() {
		// create a Profile with a non null profile id and watch it fail
		$profile = new Profile(null, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL);
		$profile->update($this->getPDO());
	}

	/**
	 * test creating a Profile and then deleting it
	 **/
	public function testDeleteValidProfile() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new Profile and insert to into mySQL
		$profile = new Profile(null, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL);
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
		$profile = new Profile(null, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL);
		$profile->delete($this->getPDO());
	}
	/**
	 * test inserting a Profile and re-grabbing it from mySQL
	 **/
	public function testGetValidProfileByProfileId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new Tweet and insert to into mySQL
		$profile = new Profile(null, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL);
		$profile->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoProfile = Profile::getProfilebyProfileId($this->getPDO(), $profile->getProfileId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertEquals($pdoProfile->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileUserName(), $this->VALID_PROFILEUSERNAME);
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL);
	}


	/**
	 * test grabbing a Profile that does not exist
	 **/
	public function testGetInvalidProfileByProfileId() {
		//grab a profile id that exceeds the maximum allowable user id
		$profile = User::getProfileByProfileId($this->getPDO(),SprotsTest::INVALID_KEY);
		$this->assertNull($profile);
	}

	/**
	 * test grabbing a Profile by profile user name
	 **/
	public function testGetValidProfileByProfileUserName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("profile");

		// create a new Profile and insert it into mySQL
		$profile = new Profile(null, $this->profile->getProfileId(), $this->VALID_PROFILEUSERNAME, $this->VALID_PROFILEEMAIL);
		$profile->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Profile::getProfileByProfileUserName($this->getPDO(), $profile->getProfileUserName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("profile"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\SprotsTest\\Profile", $results);

		// grab the result from the array and validate it
		$pdoProfile = $results[0];
		$this->assertEquals($pdoProfile->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoProfile->getProfileUserName(), $this->VALID_PROFILEUSERNAME;
		$this->assertEquals($pdoProfile->getProfileEmail(), $this->VALID_PROFILEEMAIL);
	}

	/**
	 * test grabbing a Profile by user name that does not exist
	 **/
	public function testGetInvalidProfileByProfileUserName() {
		// grab a profile user name that exceeds the maximum allowable
		$tweet = Tweet::getTweetByTweetContent($this->getPDO(), "nobody ever tweeted this");
		$this->assertCount(0, $tweet);
	}
}