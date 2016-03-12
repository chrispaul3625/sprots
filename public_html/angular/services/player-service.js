app.constant("PLAYER_ENDPOINT", "../php/api/Player/");
app.service("playerService", function($http, PLAYER_ENDPOINT) {
	function getUrl() {
		return(PLAYER_ENDPOINT);
	}

	function getUrlForId(playerId) {
		return(getUrl() + playerId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetch = function(playerId) {
		return($http.get(getUrlForId(playerId)));
	};
});