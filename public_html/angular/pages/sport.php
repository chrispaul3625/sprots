<div class="col-md-10">
	<div class="alert alert-info" ng-if="teams.length === 0">
		<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Loading teams&hellip;
	</div>
	<div class="content-box" ng-if="teams.length > 0">
		<h2> Team Stats</h2>
		<form class="form-inline inline pull-right" name="searchForm" id="searchForm">
			<div class="form-group">
				<label for="search">Search</label>
				<div class="input-group">
					<input type="text" class="form-control" ng-model="search" ng-change="switchTeamArray();"/>
					<div class="input-group-addon">
						<i class="fa fa-search" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</form>
		<div ng-repeat="team in filteredTeams | filter: search">
			<p> Id {{ team.teamId }}
				{{position.teamCity}}
				{{position.teamName}}
			</p>
		</div>
		<uib-pagination
			ng-model="currentPage"
			total-items="teams.length"
			items-per-page="pageSize"
			max-size="numPages"
			boundary-links="true"
			ng-disabled="searching"
			ng-hide="searching">
		</uib-pagination>
	</div>
</div>
</div>
