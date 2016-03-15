app.controller('sportController', ["$scope", "sportService", function($scope, sportService) {
	$scope.sports = [];

	// pagination & search variables
	$scope.pagination = {
		filteredSports: [],
		currentPage: -1,
		pageSize: 10,
		numPages: 5,
		search: "",
		searching: false
	};

	$scope.getAllSports = function () {
		sportService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.sports = result.data.data;
					$scope.switchSportArray();
				}
			});
	};

	$scope.switchSportArray = function() {
		if($scope.pagination.search !== undefined && $scope.pagination.search !== "") {
			$scope.pagination.searching = true;
			$scope.pagination.currentPage = -1;
			$scope.pagination.filteredSports = $scope.sports;
		} else {
			$scope.pagination.searching = false;
			var begin = ($scope.pagination.currentPage - 1) * $scope.pagination.pageSize;
			var end = begin + $scope.pagination.pageSize;
			$scope.pagination.filteredSports = $scope.sports.slice(begin, end);
		}
	};

	if ($scope.sports.length === 0) {
		$scope.sports = $scope.getAllSports();
		$scope.pagination.currentPage = 1;
	}
}]);
