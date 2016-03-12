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
							<p> |Id{{ score.teamId }}|
								{{score.teamCity}}
								{{score.teamName}} |
								{{score.result}} |
								________VS___________
								|Id{{ score.teamId2 }}|
								{{score.teamCity2}}
								{{score.teamName2}} |
								{{score.result2}} |
								{{score.date}}
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="content-box">
						<div class="content-box" ng-controller="scheduleController">
							<h2> Upcoming Games/Fixtures for the week</h2>
							<div ng-repeat="schedule in schedules">
								<p> |Id{{ schedule.teamId }}|
									{{schedule.teamCity}}
									{{schedule.teamName}}
									________VS___________
									|Id{{ schedule.teamId2 }}|
									{{schedule.teamCity2}}
									{{schedule.teamName2}} |
									{{schedule.date}} |

								</p>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
	</main>

<?php require_once ("php/templates/footer.php")?>

</body>
</html>