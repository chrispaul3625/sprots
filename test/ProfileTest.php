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
	 * profile
	 */

	/**
	 * profile email
	 * @var $VALID_PROFILEEMAIL
	 */
	protected $VALID_PROFILEEMAIL = "PHPUnit test pass";

	/**
	 * profile hash
	 * @var string $VALID_PROFILEHASH
	 */
	protected $VALID_PROFILEHASH = "PHPUnit test pass";





}