app.constant("TEAMSTATISTIC_ENDPOINT", "php/api/Teamstatistic/");
app.service("teamStatsService", function($http, TEAMSTATISTIC_ENDPOINT) {
	function getAllTeamStatistics() {
		return(TEAMSTATISTIC_ENDPOINT);
	}

	this.getAllTeamsStatisticsForId = function(teamId) {
		return($http.get(getAllTeamStatistics() + "?teamId=" + teamId));
	};

	this.all = function() {
		return($http.get(getAllTeamStatistics()));
	};

	this.fetch = function(teamId) {
		return($http.get(getAllTeamsStatisticsForId(teamId)));
	};
});
