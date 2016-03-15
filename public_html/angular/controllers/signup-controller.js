app.controller("SignupController", ["$scope", "$uibModal", "$window", "AlertService", "SignupService", function($scope, $uibMod, $window, AlertService, SignupService) {
	$scope.signupData = {};
	$scope.openSignupModal = function () {
		var signupModalInstance = $uibModal.open({
			templateUrl: "../views/signup-modal.php",
			controller: "SignupModal",
			resolve: {
				signupData: function () {
					return($scope.signupData);
				}
			}
		});
		signupModalInstance.result.then(function (signupData) {
			$scope.signupData = signupData;
			SignupService.signup(signupData)
				.then(function(reply) {
					if(reply.status === 200) {
						AlertService.addAlert({type: "success", msg: reply.message});
						} else {
						AlertService.addAlert({type: "danger", msg: reply.message});
					}
				});
		}, function() {
			$scope.signupData = {};
		});
	};
}]);