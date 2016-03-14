
<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Script Tutorials" />
		<title>sprots</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<!-- attach CSS styles -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	</head>








<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*set page title here*/
$PAGE_TITLE = "Home";

/*load head-utils.php - edit path as needed*/
require_once("php/templates/head-utils.php");
?>


<body class="sfooter">
	<?php require_once("php/templates/header.php") ?>

	<!--<div class="container">
		<div class="jumbotron">
			<h1>Welcome!</h1>
			<p>Follow your sports now!</p>
		</div>
	</div>

	<main class="container">
		<div ng-view></div>

	</main>
	<div class="sfooter-content">

	</div>-->


	<!-- first section - Home -->
	<div id="home" class="home">
		<div class="text-vcenter">
			<h1>Welcome!</h1>
			<h3>Find your Sport</h3>
			<a href="#about" class="btn btn-default btn-lg">Continue</a>
		</div>
	</div>
	<!-- /first section -->


	<!-- second section - About -->
	<div id="about" class="pad-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<!--images go here -->
				</div>
				<div class="col-sm-6 text-center">
					<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in sem cras amet.</h2>
					<p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed interdum metus et ligula venenatis, at rhoncus nisi molestie. Pellentesque porttitor elit suscipit massa laoreet metus.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- /second section -->


	<!-- third section - Services -->
	<div id="services" class="pad-section">
		<div class="container">
			<h2 class="text-center">Follow your favorite sports and teams!</h2> <hr />
			<div class="row text-center">
				<div class="col-sm-3 col-xs-6">
					<i class="glyphicon glyphicon-cloud"> </i>
					<h4>Service 1</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in sem cras amet. Donec in sem cras amet.</p>
				</div>
				<div class="col-sm-3 col-xs-6">
					<i class="glyphicon glyphicon-leaf"> </i>
					<h4>Service 2</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in sem cras amet. Donec in sem cras amet.</p>
				</div>
				<div class="col-sm-3 col-xs-6">
					<i class="glyphicon glyphicon-phone-alt"> </i>
					<h4>Service 3</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in sem cras amet. Donec in sem cras amet.</p>
				</div>
				<div class="col-sm-3 col-xs-6">
					<i class="glyphicon glyphicon-bullhorn"> </i>
					<h4>Service 4</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in sem cras amet. Donec in sem cras amet.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- /third section -->


	<!-- fourth section - Information -->
	<div id="information" class="pad-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">Additional information</h2>
						</div>
						<div class="panel-body lead">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit adipiscing blandit. Aliquam placerat, velit a fermentum fermentum, mi felis vehicula justo, a dapibus quam augue non massa. Duis euismod, augue et tempus consequat, lorem mauris porttitor quam, consequat ultricies mauris mi a metus. Phasellus congue, leo sed ultricies tristique, nunc libero tempor ligula, at varius mi nibh in nisi. Aliquam erat volutpat. Maecenas rhoncus, neque facilisis rhoncus tempus, elit ligula varius dui, quis amet.
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">Additional information</h2>
						</div>
						<div class="panel-body lead">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit adipiscing blandit. Aliquam placerat, velit a fermentum fermentum, mi felis vehicula justo, a dapibus quam augue non massa. Duis euismod, augue et tempus consequat, lorem mauris porttitor quam, consequat ultricies mauris mi a metus. Phasellus congue, leo sed ultricies tristique, nunc libero tempor ligula, at varius mi nibh in nisi. Aliquam erat volutpat. Maecenas rhoncus, neque facilisis rhoncus tempus, elit ligula varius dui, quis amet.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /fourth section -->

	<!-- fifth section -->
	<div id="services" class="pad-section">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<h3>Sign up</h3>
					<h4>er nah?</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- /fifth section -->






	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="//maps.google.com/maps/api/js?sensor=true"></script>
	<script src="js/main.js"></script>
</body>
<?php require_once ("php/templates/footer.php")?>
</html>