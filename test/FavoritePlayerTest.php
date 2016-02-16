<?php

namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\FavoritePlayer;

require_once ("SprotsTest.php");

require_once (dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
 * Full PHPUnit test for the Favorite Player class
 *
 * This is a complete PHPUnit test of the FavoritePlayer class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Favorite Player
 * @author Mike Prinz <mnprinz@gmail.com>
 **/

Class FavoritePlayerTest extends SprotsTest {
	/**
	 * content of
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