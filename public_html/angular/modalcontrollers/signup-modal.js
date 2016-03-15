/**
 * Created by dom on 3/15/16.
 */

app.controller("SignupModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.signupData = {profileName: "Name"};

	$scope.ok = function() {
		$uibModalInstance.close($scope.signupData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);