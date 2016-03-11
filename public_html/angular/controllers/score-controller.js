app.controller('scoreController', ["$scope", function($scope) {
	$scope.scores = [
		{
			teamId: 56,
			teamName: "Broncos",
			teamCity: "Denver",
			result: "30",
			teamId2: 65,
			teamName2: "Cowboys",
			teamCity2: "Dallas",
			result2: "14"
		},
		{
			teamId: 32,
			teamName: "Seahawks",
			teamCity: "Seattle",
			result: "28",
			teamId2: 89,
			teamName2: "Bears",
			teamCity2: "Chicago",
			result2: "14"
		},
		{
			teamId: 72,
			teamName: "Packers",
			teamCity: "Green Bay",
			result: "16",
			teamId2: 21,
			teamName2: "Dolphins",
			teamCity2: "Miami",
			result2: "24"
		}
	];
}]);