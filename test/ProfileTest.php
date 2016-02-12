<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\Profile;

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

	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();
		//create and insert a profile to own the test user
		$this->profile = new Profile(null );
		$this->profile ->insert($this->getPDO());
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
		$profile->setTweetContent($this->VALID_PROFILEUSERNAME);
		$profile->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT2);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}



