app.constant("PLAYER-ENDPOINT", "php/apiPlayer");
app.services("playerStatsServices", function($http, PLAYER_ENDPOINT) {
	function getAllPlayerStatistics(){
		return(PLAYER_ENDPOINT);
	}

	function getAllPlayersStatisticsForId(playerId) {
		return(getAllPlayerStatistics() + playerId);
	}

	this.all = function() {
		return($http.get(getAllPlayerStatistics()));
	}

	this.fetch = function(playerId) {
		return($http.get(getAllPlayersStatisticsForId(playerId)));
	};
});
