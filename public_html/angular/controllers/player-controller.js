app.controller('playerController', ["$scope", "playerService", function($scope, playerService) {
	$scope.players = [];

	// pagination & search variables
	$scope.filteredPlayers = [];
	$scope.currentPage = 1;
	$scope.pageSize = 10;
	$scope.numPages = 5;
	$scope.searching = false;

	$scope.getAllPlayers = function () {
		playerService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.players = result.data.data;
					$scope.$watch("currentPage + pageSize", function() {
						var begin = ($scope.currentPage - 1) * $scope.pageSize;
						var end = begin + $scope.pageSize;
						$scope.filteredPlayers = $scope.players.slice(begin, end);
					});
				}
			});
	};

	$scope.switchPlayerArray = function() {
		if($scope.search !== undefined && $scope.search !== "") {
			$scope.searching = true;
			$scope.currentPage = -1;
			$scope.filteredPlayers = $scope.players;
		} else {
			$scope.searching = false;
			$scope.currentPage = 1;
		}
	};

	if ($scope.players.length === 0) {
		$scope.players = $scope.getAllPlayers();
	}
}]);
