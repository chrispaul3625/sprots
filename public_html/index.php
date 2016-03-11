<!DOCTYPE html>
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
	<div class="sfooter-content">
		<div class="container">
			<main>
				<div class="col-md-6">
					<div class="content-box" ng-controller="scoreController">
						<h2> Scores </h2>
						<div ng-repeat="score in scores">
							<p> ID{{ score.teamId }}|
								{{score.teamCity}}
								{{score.teamName}}
								{{score.result}}
								________VS___________
								ID{{ score.teamId2 }}|
								{{score.teamCity2}}
								{{score.teamName2}}
								{{score.result2}}
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="content-box">
							<div class="content-box" ng-controller="scheduleController">
								<h2> Upcoming Games/Fixtures for the week</h2>
								<div ng-repeat="schedule in schedules">
									<p> ID {{ score.teamId }}|
										{{schedule.teamCity}}
										{{schedule.teamName}}|
										{{schedule.date}}|
										________VS___________
										ID {{ schedule.teamId2 }}|
										{{schedule.teamCity2}}
										{{schedule.teamName2}}|
										{{schedule.date}}|

								</p>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
	</main>


	<footer class="container">
		<div class="col-md-12">
			<div class="content-box">
			</div>
		</div>
		<h2> Footer </h2>
		&copy; Sprots 2016
	</footer>
</body>
</html>