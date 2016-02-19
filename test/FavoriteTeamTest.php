<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{Profile, Sport, Team, FavoriteTeam};

//grab the project test parameters
require_once("SprotsTest.php");

require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
* Full PHPUnit test for the FavoriteTeam stdClass
*
* This is a complete PHPunit test of the FavoriteTeam class. It is complete because * ALL* mySQL/PDO enabled methods are tested
* for both invalid, and valid inputs.
*
* @see FavoriteTeam
* @author Dom Kratos <mr.kratos85@gmail.com>
**/
class FavoriteTeamTest extends SprotsTest {
  /**
  * profile that has the favorite team this is a foreign key relation to profile
  * @var favoriteTeamProfileId $favoriteTeamProfileId
  */
  protected $favoriteTeamProfileId = null;
  /**
  * team that is being favorited. This is a foreign key relation to team
  * @var favoriteTeamTeamId $favoriteTeamTeamId
  */
  protected $favoriteTeamTeamId = null;
  /**
   * content of Team
   * @var int $VALID_TEAMAPIID
   */
  protected $VALID_TEAMAPIID = 42;
  /**
	 * content for teamCity
	 * @var string  $VALID_TEAMCITY
	 */
	protected $VALID_TEAMCITY = "Nashville";
	/**
	 * content for teamName
	 * @var string $VALID_TEAMNAME
	 */
	protected $VALID_TEAMNAME = "Titans";
	/**
	 * content for teamName
	 * @var string $VALID_TEAMNAME2
	 */
	protected $VALID_TEAMNAME2 = "Cowboys";
	/**
	 * Sport that the Player is playing
	 * @var string $sport
	 */
  /**
	 * @var string $VALID_SALT
	 */
	protected $VALID_SALT;
	/**
	 * @var string $VALID_HASH
	 */
	protected $VALID_HASH;

  protected $team = null;
  protected $sport = null;
  protected $profile = null;

  /**
  * Create dependent objects before running each test
  **/
  public final function setUp() {
    // run the default setup() method first
    parent::setUp();

    // create and insert a sport that the team would be in
    $this->sport = new Sport(null, "sportLeague", "sportName");
    $this->sport->insert($this->getPDO());
    // create and insert a team that would be favorited
    $this->team = new Team(null, $this->sport->getSportId(), $this->VALID_TEAMAPIID, $this->VALID_TEAMCITY, $this->VALID_TEAMNAME);
    $this->team->insert($this->getPDO());
    // create a valid salt and hash test
    $this->VALID_SALT = bin2hex(openssl_random_pseudo_bytes(32));
		$this->VALID_HASH = $this->VALID_HASH = hash_pbkdf2("sha512", "password4321", $this->VALID_SALT, 262144, 128);
    // create and insert a Profile to own the FavoriteTeam
    $this->profile = new Profile(null, $this-> getProfileUserName(), $this->getProfileEmail(), $this->VALID_SALT, $this->VALID_HASH);
    $this->profile->insert($this->getPDO());
    }
    /**
    * test inserting a valid Favorited team and verify that the actual DB data matches
    **/
    public function testInsertValidFavoriteTeam() {
      //count the numbr of rows, and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team, and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId, $this->favoriteTeamTeamId);
      $favoriteTeam->insert($this->getPDO());

      // grab the data from the db, and enforce the fields match our expectations
      $pdoFavoriteTeam = FavoriteTeam::getFavoriteTeamByFavoriteTeamProfileId($this->getPDO(), $favoriteTeam->getFavoriteTeamTeamId());
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamProfileId(), $this->favoriteTeamProfileId);
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamTeamId(), $this->favoriteTeamTeamId);
    }

    /**
    * test inserting a favorite team, that already exists
    *
    * @expectedException PDOException
    **/
    public function testInsertInvalidFavoriteTeam() {
      // create a favorite team with a non null favorite team id, and watch it fail
      $favoriteTeam = new FavoriteTeam(SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
      $favoriteTeam->insert($this->getPDO());
    }

    /**
    * test favoriting a team and then deleting it.
    */
    public function testDeleteValidFavoriteTeam() {
      // count the number of rows and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team, and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId, $this->favoriteTeamTeamId);
      $favoriteTeam->insert($this->getPDO());

      // delete the favorite team from profiles favorite teams
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $favoriteTeam->delete($this->getPDO());

      // grab the data from the db, and enforce that the favorite team doesn't exist
      $pdoFavoriteTeam = FavoriteTeam::getFavoriteTeamByFavoriteTeamTeamId($this->getPDO(), $favoriteTeam->getFavoriteTeamTeamId());
      $this->assertNull($pdoFavoriteTeam);
      $this->assertEquals($numRows, $this->getConnection()->getRowCount("favoriteTeam"));
    }

    /**
    * test deleting an invalid favorite team.
    */
    public function testDeleteInvalidFavoriteTeam() {
      // create a favorite team, and try to delete it without actually inserting it
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId, $this->favoriteTeamTeamId);
      $favoriteTeam->delete($this->getpdo());
    }
    /**
    * Test inserting a new favorite team, and regrabbing it from mysql
    **/
    public function testGetValidFavoriteTeamsByFavoriteTeamProfileId() {
      // count the number of rows and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      //create a new favorite team and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId, $this->favoriteTeamTeamId);
      $favoriteTeam->insert($this->getPDO());

      // grab the data from the db and enforce the fields match our expectations
      $pdoFavoriteTeam = FavoriteTeam::getFavoriteTeamsByFavoriteTeamProfileId($this->getPDO());
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamProfileId(), $this->favoriteTeamProfileId);
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamTeamId(), $this->$favoriteTeamTeamId);
    }

    /**
    * test grabbing a favorite team from favoriteTeamProfileId
    **/
    public function testGetInvalidFavoriteTeamByFavoriteTeamProfileId() {
      // grab a favorite team that exceeds the maximum allowable favoriteteamteamid length
      $favoriteTeamTeamId = FavoriteTeam::getFavoriteTeamsByFavoriteTeamProfileId($this->getPDO(), SprotsTest::INVALID_KEY);
      $this->assertNull($favoriteTeamTeamId);
    }
    /**
    * Test inserting a new favorite team, and regrabbing it from mysql
    **/
    public function testGetValidFavoriteTeamsByFavoriteTeamTeamId() {
      // count the number of rows and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      //create a new favorite team and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamTeamId);
      $favoriteTeam->insert($this->getPDO());

      // grab the data from the db and enforce the fields match our expectations
      $pdoFavoriteTeam = FavoriteTeam::getFavoriteTeamByFavoriteTeamTeamId($this->getPDO());
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamTeamId(), $this->$favoriteTeamTeamId);
    }

    /**
    * test grabbing a favorite team that doesn't exist
    **/
    public function testGetInvalidFavoriteTeamByFavoriteTeamTeamId() {
      // grab a favorite team that exceeds the maximum allowable favoriteteamteamid length
      $favoriteTeamTeamId = FavoriteTeam::getFavoriteTeamTeamId($this->getPDO(), SprotsTest::INVALID_KEY);
      $this->assertNull($favoriteTeamTeamId);
    }

}
