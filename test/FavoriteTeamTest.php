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
class FavortieTeamTest extends SprotsTest {
  /**
  * Sport that the team is from
  * @var Sport $VALID_SPORT
  */
  protected $VALID_SPORT = null;
  /**
  * to confirm team name is accurate
  * @var Team $VALID_TEAM
  **/
  protected $VALID_TEAM = null;
  /**
  *name of the favorite team
  * @var FavoriteTeam $VALID_FAVORITETEAM
  **/
  protected $VALID_FAVORITETEAM = null;
  /**
  * profile that is favorting teams
  * @var Profile profile
  **/
  protected $profile = null;

  /**
  * Create dependent objects before running each test
  **/
  public final function setUp() {
    //run the default setup() method first
    parent::setUp();

    // create and insert a sport that the team would be in
    $this->sport = new Sport(null, "sportteam", "sportleague");
    $this->sport->insert($this->getPDO());
    // create and insert a team that would be favorited
    $this->team = new Team("teamname", , null, "teamCity",);
    $this->team->insert($this->getPDO());
    // create and insert a Profile to own the FavoriteTeam
    $this->profile = new Profile(null, "@phpunit", "test@phpunit.de");
    $this->profile->insert($this->getPDO());
    }
    /** test inserting a valid sport team and
    /**
    * test inserting a valid Favorited team and verify that the actual DB data matches
    **/
    public function testInsertValidFavoriteTeam() {
      //count the numbr of rows, and save it for later
      $numRows = $this->getConnection()->getRowCount("favoriteTeam");

      // create a new favorite team, and insert it into the db
      $favoriteTeam = new FavoriteTeam(null, $this-)
    }
}
