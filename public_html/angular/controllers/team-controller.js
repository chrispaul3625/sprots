app.controller('teamController', ["$scope", "teamService", "teamStatsService", "statisticService", function($scope, teamService, teamStatsService, statisticService) {
	$scope.teams = [];
	$scope.teamCollapse = {};
	$scope.teamStats = {};
	$scope.statistics = {};

	// pagination & search variables
	$scope.pagination = {
		filteredTeams: [],
		currentPage: -1,
		pageSize: 10,
		numPages: 5,
		search: "",
		searching: false
	};

	$scope.isTeamCollapsed = function(index) {
		return($scope.teamCollapse[index]);
	};

	$scope.flipTeamCollapsed = function(index) {
		console.log(index);
		$scope.teamCollapse[index] = !($scope.teamCollapse[index]);
		if($scope.teamStats[index] === undefined) {
			//console.log($scope.teamStats[index]);
			teamStatsService.getAllTeamsStatisticsForId($scope.teams[index].teamId)
				.then(function(result) {
					console.log(result);
					if(result.data.status === 200) {
						$scope.teamStats[index] = result.data.data;
						console.log(result.data.data);
					}
				});
		}
	};

	$scope.getAllStatistics = function() {
		statisticService.all()
			.then(function(result) {
				if(result.data.status === 200) {
					result.data.data.forEach(function(statistic) {
						$scope.statistics[statistic.statisticId] = statistic;
					});
				}
			});
	};

	$scope.getAllTeams = function () {
		teamService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.teams = result.data.data;
					for(index in $scope.teams) {
						$scope.teamCollapse[index] = true;
					}
					$scope.switchTeamArray();
				}
			});
	};
	$scope.getAllTeamsStatisticsForId = function (teamId) {
		teamStatsService.getAllTeamsStatisticsForId(teamId)
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.teamStats.teamId = result.data.data;
				}
			});
	};
	$scope.switchTeamArray = function() {
		if($scope.pagination.search !== undefined && $scope.pagination.search !== "") {
			$scope.pagination.searching = true;
			$scope.pagination.currentPage = -1;
			$scope.pagination.filteredTeams = $scope.teams;
		} else {
			$scope.pagination.searching = false;
			var begin = ($scope.pagination.currentPage - 1) * $scope.pagination.pageSize;
			var end = begin + $scope.pagination.pageSize;
			$scope.pagination.filteredTeams = $scope.teams.slice(begin, end);
		}
	};

	if ($scope.teams.length === 0) {
		$scope.getAllTeams();
		$scope.getAllStatistics();
		$scope.pagination.currentPage = 1;
	}
}]);
