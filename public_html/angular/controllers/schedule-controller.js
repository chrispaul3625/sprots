app.controller('scheduleController', ["$scope", function($scope) {
	$scope.schedules = [
		{
			teamId: 56,
			teamName: "Broncos",
			teamCity: "Denver",
			result: "30",
			teamId2: 89,
			teamName2: "Bears",
			teamCity2: "Chicago",

			date:"03/17/2016"

		},
		{
			teamId: 32,
			teamName: "Seahawks",
			teamCity: "Seattle",
			result: "28",
			teamId2: 65,
			teamName2: "Cowboys",
			teamCity2: "Dallas",
			date:"03/18/2016"

		},
		{
			teamId: 72,
			teamName: "Packers",
			teamCity: "Green Bay",
			result: "16",
			teamId2: 22,
			teamName2: "Chargers",
			teamCity2: "San Diego",
			date:"03/20/2016"
		}
	];
}]);