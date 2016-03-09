var app = angular.module("NgTemplate", ["ngRoute"]);

// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	// route for the home page
		.when('/', {
			controller  : 'mainController',
			templateUrl : 'angular/pages/home.php'
		})

		// route for the sport page
		.when('/sport', {
			controller  : 'sportController',
			templateUrl : 'angular/pages/sport.php'
		})

		// route for the profile page
		.when('/profile', {
			controller  : 'profileController',
			templateUrl : 'angular/pages/profile.php'
		})

		// route for the schedule page
		.when('/schedule', {
			controller  : 'scheduleController',
			templateUrl : 'angular/pages/schedule.php'
		})

		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});