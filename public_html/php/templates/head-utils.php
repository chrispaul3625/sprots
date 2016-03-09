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
<html lang="en" ng-app="NgTemplate">
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

		<!-- Custom CSS  -->
		<link rel="stylesheet" href="<?php echo $PREFIX;?>css/style.css" type="text/css"/>

		<!--Angular JS-->
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-rc.0/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-route.js"></script>

		<!--Angular application files-->
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/app.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/main-controller.js"></script>
		<script type="text/javascript" src="<?php echo $PREFIX;?>angular/controllers/about-controller.js"></script>

		<title><?php echo $PAGE_TITLE;?></title>
	</head>
