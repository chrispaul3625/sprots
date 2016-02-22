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

  protected $sport = null;
  protected $team = null;
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
		$this->VALID_HASH = hash_pbkdf2("sha512", "password4321", $this->VALID_SALT, 262144, 128);
    // create and insert a Profile to own the FavoriteTeam
    $this->profile = new Profile(null, "sheshenene", "dom@dodgeit.com", $this->VALID_HASH, $this->VALID_SALT);
    $this->profile->insert($this->getPDO());
    }
    /**
    * test inserting a valid Favorited team and verify that the actual DB data matches
    **/
    public function testInsertValidFavoriteTeam() {
      //count the numbr of rows, and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team, and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->profile->getProfileId(), $this->team->getTeamId());
      $favoriteTeam->insert($this->getPDO());

      // grab the data from the db, and enforce the fields match our expectations
      $pdoFavoriteTeam = FavoriteTeam::getFavoriteTeamByFavoriteTeamProfileIdAndFavoriteTeamTeamId($this->getPDO(), $this->profile->getProfileId(), $this->team->getTeamId());
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamProfileId(), $this->profile->getProfileId());
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamTeamId(), $this->team->getTeamId());
    }

    /**
    * test inserting a favorite team, that already exists
    *
    * @expectedException \PDOException
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
      $favoriteTeam = new FavoriteTeam($this->profile->getProfileId(), $this->team->getTeamId());
      $favoriteTeam->insert($this->getPDO());

      // delete the favorite team from profiles favorite teams
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $favoriteTeam->delete($this->getPDO());

      // grab the data from the db, and enforce that the favorite team doesn't exist
      $pdoFavoriteTeam = FavoriteTeam::getFavoriteTeamByFavoriteTeamProfileIdAndFavoriteTeamTeamId($this->getPDO(), $this->profile->getProfileId(), $this->team->getTeamId());
      $this->assertNull($pdoFavoriteTeam);
      $this->assertEquals($numRows, $this->getConnection()->getRowCount("favoriteTeam"));
    }

    /**
    * test deleting an invalid favorite team.
    */
    public function testDeleteInvalidFavoriteTeamByFavoriteTeamProfileId() {
      // create a favorite team, and try to delete it without actually inserting it
      $favoriteTeam = new FavoriteTeam($this->profile->getProfileId(), $this->team->getTeamId());
      $favoriteTeam->delete($this->getPDO());
    }
    /**
    * Test showing all teams favorited by a profile
    **/
    public function testGetValidFavoriteTeamByFavoriteTeamProfileId() {
      // count the number of rows and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team, and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->profile->getProfileId(), $this->team->getTeamId());
      $favoriteTeam->insert($this->getPDO());

      // grab the data from the db, and enforce the fields match our expectations
      $results = FavoriteTeam::getFavoriteTeamsByFavoriteTeamProfileId($this->getPDO(), $this->profile->getProfileId(), $this->team->getTeamId());
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $this->assertCount(1, $results);
      $this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Sprots\\FavoriteTeam", $results);
      //grab the results from teh array and validate it
      $pdoFavoriteTeam = $results[0];
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamProfileId(), $this->profile->getProfileId());
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamTeamId(), $this->team->getTeamId());
    }

    /**
    * test grabbing a favorite team from favoriteTeamProfileId
    **/
    public function testGetInvalidFavoriteTeamByFavoriteTeamProfileId() {
      // grab a favorite team that exceeds the maximum allowable favoriteteamteamid length
      $favoriteTeamTeamId = FavoriteTeam::getFavoriteTeamsByFavoriteTeamProfileId($this->getPDO(), SprotsTest::INVALID_KEY, SprotsTest::INVALID_KEY);
      $this->assertEquals(0, 0);
    }
}
