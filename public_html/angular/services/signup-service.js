/**
 * Created by dom on 3/15/16.
 */

app.service("SignupService", function ($http) {
	this.SIGNUP_ENDPOINT = "/php/api/signup/signup.php";
	this.signup = function (signupData) {
		console.log(singupData);
		return ($http.post(this.SIGNUP_ENDPOINT, signupData)
			.then(function (reply) {
				console.log(reply.data);
				return (reply.data);
			}));
	};
});