// configure our routes
app.config(function($routeProvider, $locationProvider) {
	$routeProvider
	// route for the home page
		.when('/', {
			controller: 'homeController',
			templateUrl: 'angular/pages/home.php'
		})

		// route for the player page
		.when('/player/', {
			controller: 'playerController',
			templateUrl: 'angular/pages/player.php'
		})

		//// route for the team page
		//.when('/team/', {
		//	controller: 'teamController',
		//	templateUrl: 'angular/pages/team.php'
		//})

		 //route for the sport page
		.when('/sport/', {
			controller: 'teamController',
			templateUrl: 'angular/pages/sport.php'
		})

		// route for the profile page
		.when('/profile/', {
			controller: 'profileController',
			templateUrl: 'angular/pages/profile.php'
		})

		// route for the schedule page
		.when('/schedule/', {
			controller: 'scheduleController',
			templateUrl: 'angular/pages/schedule.php'
		})

		.otherwise({
			redirectTo: "/"
		});

	//use the HTML5 History API
	$locationProvider.html5Mode(true);
});