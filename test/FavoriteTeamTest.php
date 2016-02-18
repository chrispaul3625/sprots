<?php
namespace Edu\Cnm\Sprots\Test;

use Edu\Cnm\Sprots\{Profile, Sport, Team, FavoriteTeam}

require_once("SprotsTest.php");

//grab the project test parameters
require_once(dirname(__DIR__) . "/public_html/php/classes/autoload.php");

/**
* Full PHPUnit test for the FavoriteTeam stdClass
*
* This is a complete PHPunit test of the FavoriteTeam class. It is complete because *ALL* mySQL/PDO enabled methods are tested
* for both invalid, and valid inputs.
*
* @see FavoriteTeam
* @author Dom Kratos <mr.kratos85@gmail.com>
**/
class FavoriteTeamTest extends SprotsTest {
  /**
  * profile that has the favorite team this is a foreign key relation to profile
  * @var favoriteTeamProfileId1 $favoriteTeamProfileId
  */
  protected $favoriteTeamProfileId1 = null;
  /**
  * profile that has the favorite team this is a foreign key relation to profile
  * @var favoriteTeamProfileId2 $favoriteTeamProfileId2
  */
  protected $favoriteTeamProfileId2 = null;
  /**
  * team that is being favorited. This is a foreign key relation to team
  * @var favoriteTeamTeamId1 $favoriteTeamProfileId2
  */
  protected $favoriteTeamTeamId1 = null;
  /**
  * team that is being favorited. This is a foreign key relation to team
  * @var favoriteTeamTeamId2 $favoriteTeamProfileId2
  */
  protected $favoriteTeamTeamId2 = null;
  /**
	 * @var string $VALID_SALT
	 */
	protected $VALID_SALT;
	/**
	 * @var string $VALID_HASH
	 */
	protected $VALID_HASH;

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
    $this->team = new Team(null, "teamName", "teamCity", "teamApiId");
    $this->team->insert($this->getPDO());
    // create and insert a Profile to own the FavoriteTeam
    $this->profile = new Profile(null, "@phpunit", "test@phpunit.de");
    $this->profile->insert($this->getPDO());
    }
    /**
    * test inserting a valid Favorited team and verify that the actual DB data matches
    **/
    public function testInsertValidFavoriteTeam() {
      //count the numbr of rows, and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team, and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId1, $this->favoriteTeamTeamId1);
      $favoriteTeam->insert($this->getPDO());

      // grab the data from the db, and enforce the fields match our expectations
      $pdoFavoriteTeam = FavoriteTeam::getFavoriteTeamByFavoriteTeamProfileId($this->getPDO(), $favoriteTeam->getFavoriteTeamProfileId());
      $this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("favoriteTeam"));
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamProfileId(), $this->favoriteTeamProfileId1);
      $this->assertEquals($pdoFavoriteTeam->getFavoriteTeamTeamId(), $this->favoriteTeamTeamId1);
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
    * test inserting a favoriteTeam, editing it, and then updating it.
    */
    /**public function testUpdateValidFavoriteTeam() {
      // cont the numbr of rows and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team and update it in the db
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId1, $this->favoriteTeamTeamId1);
      $favoriteTeam->insert($this->getPDO());

      // edit the favorite team, and update it in the db
      $favoriteTeam->setFavoriteTeamProfileId($this->favoriteTeamProfileId2,)
    }
    */

    /**
    * test favoriting a team and then deleting it.
    */
    public function testDeleteFavoriteTeam() {
      // count the number of rows and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team, and insert it into the db
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId1, $this->favoriteTeamTeamId1);
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
      $favoriteTeam = new FavoriteTeam($this->favoriteTeamProfileId1, $this->favoriteTeamTeamId1);
      $favoriteTeam->delete($this->getpdo());
    }

    /**
    * Test inserting a new favorite team, and regrabbing it from mysql
    **/
    public function testGetValidFavoriteTeam()

}
