app.controller('positionController', ["$scope", function($scope) {
	$scope.positions = [
		{
			teamId: 32,
			teamName: "Seahawks",
			teamCity: "Seattle",
			wins: "15",
			losses:"3",
			ties:"2"
		},
		{
			teamId: 56,
			teamName: "Broncos",
			teamCity: "Denver"

		},
		{
			teamId: 45,
			teamName: "Chargers",
			teamCity: "San Diego"
		},
		{
			teamId: 26,
			teamName: "Dolphins",
			teamCity: "Miami"
		},
		{
			teamId: 13,
			teamName: "Steelers",
			teamCity: "Pittsburg"
		},
		{
			teamId: 55,
			teamName: "Raiders",
			teamCity: "Oakland"
		},
		{
			teamId: 19,
			teamName: "Panthers",
			teamCity: "Carolina"
		}
	];
}]);