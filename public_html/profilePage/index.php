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
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
								the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
								of type and scrambled it to make a type specimen book. It has survived not only five centuries,
								but also the leap into electronic typesetting, remaining essentially unchanged.
						</div>
				</div>
						<div class="col-md-4">
							<div class="content-box">
								<h2> Favorite Team Fixture Results for the Week </h2>
								It is a long established fact that a reader will be distracted by the readable content of a page
								when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
								distribution of letters, as opposed to using 'Content here, content here', making it look like
								readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as
								their default model text, and a search for 'lorem ipsum' will uncover many web sites still in
								their infancy.
							</div>
						</div>
						<div class="col-md-4">
							<div class="content-box">
								<h2> Favorite Player Statistic Updates </h2>
								Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
								classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a
								Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin
								words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in
								classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32
								and 1.10.33 of "de
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
		There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some
		form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a
		passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All
		the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first
		true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model
		sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always
		free from repetition, injected humour, or non-characteristic words etc
	</footer>

</html>
