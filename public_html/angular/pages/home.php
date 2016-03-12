<div class="sfooter-content">
	<div class="container">
		<main>
			<div class="col-md-6">
				<div class="content-box">
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
					<div class="content-box">
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