app.constant("SCHEDULE_ENDPOINT", "php/api/Game/");
app.service("scheduleService", function($http, SCHEDULE_ENDPOINT) {
	function getUrl() {
		return (SCHEDULE_ENDPOINT);
	}

	function getUrlForId(gameId) {
		return (getUrl() + gameId);
	}

	this.all = function() {
		return ($http.get(getUrl()));
	};

	this.fetch = function(gameId) {
		return ($http.get(getUrlForId(gameId)));
	};

});