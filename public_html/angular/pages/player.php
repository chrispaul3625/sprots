<div class="sfooter-content-2">
<div class="row">
	<div  class="col-md-2 border">
		<div class="content-box">
			<h2> Favorited Teams </h2>
			<p><button><img src="images/Pittsburgh_Steelers_logo.svg.png" class="img-responsive">
			Pittsburg Steelers</button></p>
			<p><button><img src="images/Dallas_Cowboys.svg.png" class="img-responsive">
				Dallas Cowboys</button></p>
			<p><button><img src="images/Boston_Bruins_1948.gif" class="img-responsive">
				Boston Bruins</button></p>
			<p><button><img src="images/BostonRedSox_CapLogo.svg.png" class="img-responsive">
					Boston Red Sox</button></p>
		</div>
	</div>

	<div class="col-md-10">
		<div class="alert alert-info" ng-if="players.length === 0">
			<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Loading players&hellip;
		</div>
		<div class="content-box" ng-if="players.length > 0">
			<h2> Player Stats</h2>
			<form class="form-inline inline pull-right" name="searchForm" id="searchForm">
				<div class="form-group">
					<label for="search">Search</label>
					<div class="input-group">
						<input type="text" class="form-control" ng-model="pagination.search"
								 ng-change="switchPlayerArray();"/>
						<div class="input-group-addon">
							<i class="fa fa-search" aria-hidden="true"></i>
						</div>
					</div>
				</div>

			</form>
			<!--			<div ng-controller="CollapseDemoCtrl">-->
			<table class="table table-bordered table-hover table-responsive table-word-wrap">
				<tbody>
					<tr>
						<th>Player Name</th>
					</tr>

					<tr ng-repeat="player in pagination.filteredPlayers | filter: pagination.search">
						<td ng-click="flipPlayerCollapsed($index);">
							<p>
								{{ player.playerName }}
							</p>
							<ul uib-collapse="isPlayerCollapsed($index);">
								<li ng-repeat="stat in playerStats[$index]">{{ statistics[stat.playerStatisticStatisticId].statisticName }}: {{ stat.playerStatisticValue }}</li>
							</ul>

						</td>
					</tr>
				</tbody>
			</table>

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


