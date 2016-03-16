app.constant("STATISTIC_ENDPOINT", "php/api/Statistic/");
app.service("statisticService", function($http, STATISTIC_ENDPOINT) {
	function getUrl() {
		return(STATISTIC_ENDPOINT);
	}

	function getUrlForId(statisticId) {
		return(getUrl() + statisticId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetch = function(statisticId) {
		return($http.get(getUrlForId(statisticId)));
	};
});