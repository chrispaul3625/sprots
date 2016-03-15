<div class="row">
	<div class="col-md-2">
		<div class="content-box">
			<h2> Favorited Teams </h2>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
			standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
			make a type specimen book. It has survived not only five centuries, but also the leap into electronic
			typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
			sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker
			including versions of Lorem Ipsum.
		</div>
	</div>

	<div class="col-md-10">
		<div class="alert alert-info" ng-if="teams.length === 0">
			<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Loading teams&hellip;
		</div>
		<div class="content-box" ng-if="teams.length > 0">
			<h2> Team List</h2>
			<form class="form-inline inline pull-right" name="searchForm" id="searchForm">
				<div class="form-group">
					<label for="search">Search</label>
					<div class="input-group">
						<input type="text" class="form-control" ng-model="pagination.search" ng-change="switchTeamArray();"/>
						<div class="input-group-addon">
							<i class="fa fa-search" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</form>
			<table class="table table-bordered table-hover table-responsive table-word-wrap">
				<tbody>
					<tr>
						<th>Team City </th>
						<th>Team Name</th>
					</tr>
					<tr ng-repeat="team in pagination.filteredTeams | filter: pagination.search">
						<td>{{ team.teamCity }}</td>
							<td>{{ team.teamName }}</td>
					</tr>
				</tbody>
			</table>
			</div>
			<uib-pagination
				ng-model="pagination.currentPage"
				total-items="teams.length"
				items-per-page="pagination.pageSize"
				max-size="pagination.numPages"
				boundary-links="true"
				ng-disabled="pagination.searching"
				ng-hide="pagination.searching"
				ng-change="switchTeamArray();">
			</uib-pagination>
		</div>
	</div>
</div>