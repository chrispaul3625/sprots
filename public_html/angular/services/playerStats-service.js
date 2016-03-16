app.constant("PLAYERSTATISTIC_ENDPOINT", "php/api/PlayerStatistic/");
app.service("playerStatsService", function($http, PLAYERSTATISTIC_ENDPOINT) {
	function getAllPlayerStatistics(){
		return(PLAYERSTATISTIC_ENDPOINT);
	}

	this.getAllPlayersStatisticsForId = function(playerId) {
		return($http.get(getAllPlayerStatistics() + "?playerId=" + playerId));
	};

	this.all = function() {
		return($http.get(getAllPlayerStatistics()));
	};

	this.fetch = function(playerId) {
		return($http.get(getAllPlayersStatisticsForId(playerId)));
	};
});
