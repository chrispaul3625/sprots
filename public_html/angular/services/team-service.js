app.constant("TEAM_ENDPOINT", "php/api/Team/");
app.service("teamService", function($http, TEAM_ENDPOINT) {
	function getUrl() {
		return(TEAM_ENDPOINT);
	}

	function getUrlForId(teamId) {
		return(getUrl() + teamId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetch = function(teamId) {
		return($http.get(getUrlForId(teamId)));
	};
});