app.controller('playerController', ["$scope", "playerService", "playerStatsService", function($scope, playerService, playerStatsService) {
	$scope.players = [];
	$scope.playerStats = {};

	// pagination & search variables
	$scope.pagination = {
		filteredPlayers: [],
		currentPage: -1,
		pageSize: 10,
		numPages: 5,
		search: "",
		searching: false
	};

	$scope.getAllPlayers = function () {
		playerService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.players = result.data.data;
					$scope.switchPlayerArray();
				}
			});
	};
	$scope.getAllPlayersStatisticsForId = function (playerId) {
		playerStatsService.getAllPlayersStatisticsForId(playerId)
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.playerStats.playerId = result.data.data;
				}
			});
	};
	$scope.switchPlayerArray = function() {
		if($scope.pagination.search !== undefined && $scope.pagination.search !== "") {
			$scope.pagination.searching = true;
			$scope.pagination.currentPage = -1;
			$scope.pagination.filteredPlayers = $scope.players;
		} else {
			$scope.pagination.searching = false;
			var begin = ($scope.pagination.currentPage - 1) * $scope.pagination.pageSize;
			var end = begin + $scope.pagination.pageSize;
			$scope.pagination.filteredPlayers = $scope.players.slice(begin, end);
		}
	};

	if ($scope.players.length === 0) {
		$scope.players = $scope.getAllPlayers();
		$scope.pagination.currentPage = 1;
	}
}]);
