<?php
namespace Edu\Cnm\Sprots\DataDesign\Test;

use Edu\Cnm\Sprots\DataDesign\{Sport};

// grab the project test parameters
require_once("DataDesignTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoload.php");

/**
* Full PHPUnit test for the Sport class
*
*This is a complete PHPUnit test for the Sport class. It is complete, becasue *ALL* mySQL/pdo enabled methods
* are tested for both invalid, and valid inputs.
*
* @see Sport
* @autho Dom Kratos <mr.kratos85@gmail.com>
**/
class SportTest extends DataDesignTest {
  /**
  * content for sport league
  * @var string $VALID_SPORTLEAGUE
  **/
  protected $VALID_SPORTLEAGUE = "PHPunit test passing";
  /**
  * content of the updated sport league
  * @var string $VALID_SPORTLEAGUE2
  **/
  protected $VALID_SPORTLEAGUE2 = "PHPUnit test still passing";
  /**
  * content for sport league
  * @var string $VALID_SPORTTEAM
  **/
  protected $VALID_SPORTTEAM = "PHPunit test passing";
  /**
  * content of the updated sport league
  * @var string $VALID_SPORTTEAM2
  **/
  protected $VALID_SPORTTEAM2 = "PHPUnit test still passing";
  /**
  * create dependent objects before running each test
  **/
  public final function setUp() {
    //run the default setup() method first
    parent::setup();

    //create and insert a Sport to own the test sport?
    $this->sport = new Sport(null, "@phpunit", "test@phpunit.de", "+")
  }
}
