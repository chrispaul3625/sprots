app.controller('teamController', ["$scope", "teamService", function($scope, teamService) {
	$scope.teams = [];

	// pagination & search variables
	$scope.filteredTeams = [];
	$scope.currentPage = 1;
	$scope.pageSize = 10;
	$scope.numPages = 5;
	$scope.searching = false;

	$scope.getAllTeams = function () {
		teamService.all()
			.then(function (result) {
				if (result.data.status === 200) {
					$scope.teams = result.data.data;
					$scope.$watch("currentPage + pageSize", function() {
						var begin = ($scope.currentPage - 1) * $scope.pageSize;
						var end = begin + $scope.pageSize;
						$scope.filteredTeams = $scope.teams.slice(begin, end);
					});
				}
			});
	};

	$scope.switchTeamArray = function() {
		if($scope.search !== undefined && $scope.search !== "") {
			$scope.searching = true;
			$scope.currentPage = -1;
			$scope.filteredTeams = $scope.teams;
		} else {
			$scope.searching = false;
			$scope.currentPage = 1;
		}
	};

	if ($scope.teams.length === 0) {
		$scope.teams = $scope.getAllteams();
	}
}]);
