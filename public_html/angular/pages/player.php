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
<!--	<pre>{{ playerCollapse | json }}</pre>-->
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
						<td>
							<p ng-click="flipPlayerCollapsed($index);">
								{{ player.playerName }}
							</p>
							<p uib-collapse="isPlayerCollapsed($index);">
								<span>yay! content!</span>
<!--							<pre>{{ playerStats[$index] | json }}</pre>-->
							</p>
						</td>
					</tr>
				</tbody>
			</table>

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

