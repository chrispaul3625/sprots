<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\Profile;

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
		$this->user = new Profile(null,  "@phpunit", "test@phpunit.de", "+12125551212");
		$this->user->insert($this->getPDO());
	}





}