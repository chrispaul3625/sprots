	<div class="col-md-12">
		<div class="alert alert-info" ng-if="players.length === 0">
			<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Loading players&hellip;
		</div>
		<div class="content-box" ng-if="players.length > 0">
			<h2> Player Stats</h2>
			<form class="form-inline inline pull-right" name="searchForm" id="searchForm">
				<div class="form-group">
					<label for="search">Search</label>
					<div class="input-group">
						<input type="text" class="form-control" ng-model="pagination.search" ng-change="switchPlayerArray();"/>
						<div class="input-group-addon">
							<i class="fa fa-search" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</form>
			<div ng-repeat="player in pagination.filteredPlayers | filter: pagination.search">
				<p> Id {{ player.playerId }}
					{{player.playerName}}
					{{player.playerCity}}
				</p>
			</div>
			<uib-pagination
				ng-model="pagination.currentPage"
				total-items="players.length"
				items-per-page="pagination.pageSize"
				max-size="pagination.numPages"
				boundary-links="true"
				ng-disabled="pagination.searching"
				ng-hide="pagination.searching"
				ng-change="switchPlayerArray();">
			</uib-pagination>
		</div>
	</div>
</div>