app.controller('homeController', ["$scope", "$window", "$uibModal", "loginService", function($scope, $window, $uibModal, loginService) {

	$scope.loginData = {};

	$scope.openLogin = function() {
		var loginInstance = $uibModal.open({
			templateUrl: "angular/pages/login-modal.php",
			controller: "LoginModal",
			resolve: {
				loginData: function(){
					console.log("The problem cannot be resolved");
					return($scope.loginData);
				}
			}
		});
		loginInstance.result.then(function(loginData) {
			console.log(loginData);
			$scope.loginData = loginData;
			loginService.login(loginData)
				.then(function(reply) {
					if(reply.data.status === 200) {
						console.log("yay! you're logged in!");
						// NOTE: only the login should use $window; use $location anywhere else
						$window.location.href = "angular/pages/profile.php"
					} else {
						console.log("Tacos Findley shall never see the light here");
					}
				});
		});
	};

}]);

// embedded modal instance controller to create deletion prompt
app.controller("LoginModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.loginData = {};

	console.log("Entering modal mode...");
	$scope.ok = function() {
		//console.log("NO!!! IT'S NOT OK!!! :( :(");
		$uibModalInstance.close($scope.loginData);
	};

	$scope.cancel = function() {
		//console.log("Cancellation of cancellation canceled!");
		$uibModalInstance.dismiss('cancel');
	};
}]);