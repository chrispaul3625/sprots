<?php
/**
 * Get the relative path.
 * @see https://raw.githubusercontent.com/kingscreations/farm-to-you/master/php/lib/_header.php FarmToYou Header
 **/

// include the appropriate number of dirname() functions
// on line 8 to correctly resolve your directory's path
require_once(dirname(dirname(__DIR__)) . "/root-path.php");
$CURRENT_DEPTH = substr_count($CURRENT_DIR, "/");
$ROOT_DEPTH = substr_count($ROOT_PATH, "/");
$DEPTH_DIFFERENCE = $CURRENT_DEPTH - $ROOT_DEPTH;
$PREFIX = str_repeat("../", $DEPTH_DIFFERENCE);
?>
<!DOCTYPE html>
<html lang="en" ng-app="Sprots">
	<head>
		<!-- The 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- set base for relative links - to enable pretty URLs. -->
		<base href="<?php echo dirname($_SERVER["PHP_SELF"]) . "/"; ?>">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

		<!-- Custom CSS  -->
		<link rel="stylesheet" href="<?php echo $PREFIX;?>css/style.css" type="text/css"/>

		<!--Angular JS-->
		<?php $ANGULAR_VERSION = "1.5.0";?>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-messages.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION;?>/angular-route.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.2.4/ui-bootstrap-tpls.min.js"></script>

		<!--Angular application files-->
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/app.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/route-config.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/player-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/team-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/schedule-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/signup-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/login-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/playerStats-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/teamStats-service.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/services/statistic-service.js"></script>
<!--		controllers here -->
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/home-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/profile-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/player-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/schedule-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/sport-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/score-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/position-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/team-controller.js"></script>

		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/playerStats-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/teamStats-controller.js"></script>




		<title><?php echo $PAGE_TITLE;?></title>
	</head>
