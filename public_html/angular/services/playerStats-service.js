app.constant("PLAYER_ENDPOINT", "php/api/Player/PlayerStatistic");
app.service("playerStatsService", function($http, PLAYER_ENDPOINT) {
	function getAllPlayerStatistics(){
		return(PLAYER_ENDPOINT);
	}

	function getAllPlayersStatisticsForId(playerId) {
		return(getAllPlayerStatistics() + "&playerId=" + playerId);
	}

	this.all = function() {
		return($http.get(getAllPlayerStatistics()));
	};

	this.fetch = function(playerId) {
		return($http.get(getAllPlayersStatisticsForId(playerId)));
	};
});
