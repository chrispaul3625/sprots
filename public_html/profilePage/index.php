<!DOCTYPE html>
<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*set page title here*/
$PAGE_TITLE = "Profile";

/*load head-utils.php - edit path as needed*/
require_once(dirname(__DIR__)."/php/templates/head-utils.php");
?>
<html lang='en' xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- Bootstrap Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
				integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
				crossorigin="anonymous"/>
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
				integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r"
				crossorigin="anonymous"/>
		<!-- HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<!-- Latest compiled and minified Bootstrap JavaScript, all compiled plugins included -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
				  integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
				  crossorigin="anonymous"></script>
		<link rel="stylesheet" href="../css/style.css">

	</head>
	<body class="sfooter">
		<?php require_once (dirname(__DIR__)."/php/templates/header.php") ?>

		<div class="jumbotron">
			<div class="container">
				<h1>Profile</h1>
				<p>Hello World!</p>
			</div>
		</div>

		<div class="sfooter-content-2">
			<main>
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="content-box">
								<h2> Favorite Sport League Standing Table</h2>
								Follow your favorite teams on Sprots!  We bring you the latest news and stats for your team and every player in the league!
								If you like fantasy leagues, Sprots is for you, as you can research every player in the league and pick the best!
						</div>
				</div>
						<div class="col-md-4">
							<div class="content-box">
								<h2> Favorite Team Fixture Results for the Week </h2>
								Sprots delivers up-to-date sports news and statistics for your favorite teams and players.  If you're a sports fan, you'll love Sprots!
							</div>
						</div>
						<div class="col-md-4">
							<div class="content-box">
								<h2> Favorite Player Statistic Updates </h2>
								Sprots is fast becoming the go to site for avid sports fans!  They know they find the best and most in-depth news and statistics about their favorite team!
							</div>
						</div>
					</div>
				</div>
		</div>

		</main>


	</body>

	<footer class="container">
		<div class="col-md-12">
			<div class="content-box">
			</div>
		</div>
		<h2> Footer </h2>
		If you follow sports and have a fantasy team, you will love Sprots!  Follow your favorite player and teams!  Get the latest news and statistics for your favorite player!
	</footer>

</html>
