app.controller('playerController', ["$scope", "playerService", "playerStatsService", function($scope, playerService) {
	$scope.players = [];
	$scope.playerCollapse = {};

	// pagination & search variables
	$scope.pagination = {
		filteredPlayers: [],
		currentPage: -1,
		pageSize: 10,
		numPages: 5,
		search: "",
		searching: false
	};

	$scope.isPlayerCollapsed = function(index) {
		return($scope.playerCollapse[index]);
	};

	$scope.flipPlayerCollapsed = function(index) {
		$scope.playerCollapse[index] = !($scope.playerCollapse[index]);
	};

	$scope.getAllPlayers = function () {
		playerService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.players = result.data.data;
					console.log($scope.players);
					for(index in $scope.players) {
						$scope.playerCollapse[index] = true;
					}
					$scope.switchPlayerArray();
				}
			});
	};
	$scope.getAllPlayerStatistics = function () {
		playerService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.players = result.data.data;
					$scope.switchPlayerArray();
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
