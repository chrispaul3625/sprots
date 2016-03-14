app.controller('playerController', ["$scope", "playerService", function($scope, playerService) {
	$scope.players = [];

	// pagination & search variables
	$scope.pagination = {
		filteredPlayers: [],
		currentPage: -1,
		pageSize: 10,
		numPages: 5,
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

	$scope.switchPlayerArray = function() {
		if($scope.search !== undefined && $scope.search !== "") {
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
