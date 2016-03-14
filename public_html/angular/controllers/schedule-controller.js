app.controller('scheduleController', ["$scope", function($scope) {
	$scope.schedules = [];

	// pagination & search variables
	$scope.pagination = {
		filteredSchedules: [],
		currentPage: -1,
		pageSize: 10,
		numPages: 5,
		search: "",
		searching: false
	};

	$scope.getAllSchedules = function() {
		scheduleService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.scheduls = result.data.data;
					$scope.switchScheduleArray();
				}
			});

	};
	$scope.switchScheduleArray = function() {
		if($scope.pagination.search !== undefined && $scope.pagination.search !== "") {
			$scope.pagination.searching = true;
			$scope.pagination.currentPage = -1;
			$scope.pagination.filteredSchedules = $scope.schedules;
		} else {
			$scope.pagination.searching = false;
			var begin = ($scope.pagination.currentPage - 1) * $scope.pagination.pageSize;
			var end = begin + $scope.pagination.pageSize;
			$scope.pagination.filteredSchedules = $scope.schedules.slice(begin, end);
		}
	};

	if ($scope.schedules.length === 0) {
		$scope.schedules = $scope.getAllSchedules();
		$scope.pagination.currentPage = 1;
	}
}]);

