app.controller('teamController', ["$scope", "teamService", function($scope, teamService) {
	$scope.teams = [];

	// pagination & search variables
	$scope.pagination = {
		filteredTeams: [],
		currentPage: -1,
		pageSize: 10,
		numPages: 5,
		search: "",
		searching: false
	};

	$scope.getAllTeams = function() {
		teamService.all()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.teams = result.data.data;
					$scope.switchTeamArray();
				}
			});
	};

	$scope.switchTeamArray = function() {
		if($scope.pagination.search !== undefined && $scope.pagination.search !== "") {
			$scope.pagination.searching = true;
			$scope.pagination.currentPage = -1;
			$scope.paginationfilteredTeams = $scope.teams;
		} else {
			$scope.pagination.searching = false;
			var begin = ($scope.pagination.currentPage - 1) * $scope.pagination.pageSize;
			var end = begin + $scope.pagination.pageSize;
			$scope.pagination.filteredTeams = $scope.teams.slice(begin, end);
		}
	};

	if($scope.teams.length === 0) {
		$scope.team = $scope.getAllTeams();
		$scope.pagination.currentPage = 1;
	}
}]);
