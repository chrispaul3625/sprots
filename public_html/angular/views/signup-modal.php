<div class="modal-header">
	<h2>Sign Up!</h2>
</div>
<div ng-controller="SignupModal">
<div class="modal-body">
	<form ng-submit="ok();" id="signupForm" name="signupForm">
		<!--first name-->
		<div class="form-group" ng-class="{ 'has-error' : signupForm.profileFirstName.$touched && signupForm.profileFirstName.$invalid }">
		<h5>
			<label class="control-label" for="name">Name</label>
		</h5>

			<label class="control-label sr-only" for="profileFirstName">First Name</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="profileFirstName" name="profileName" placeholder="Name"
						 ng-model="signupData.profileFirstName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.profileFirstName.$error"
				  ng-if="signupForm.profileFirstName.$touched" ng-hide="signupForm.profileFirstName.$valid">
				<p ng-message="required">Please enter your first name</p>
			</div>
		</div>



		<!--email-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.profileEmail.$touched && signupForm.profileEmail.$invalid }">
			<h5>
			<label class="control-label" for="profileEmail">Email</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="profileEmail" name="profileEmail" placeholder="Email"
						 ng-model="signupData.profileEmail" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert"
				  ng-messages="signupForm.profileEmail.$error"
				  ng-if="signupForm.profileEmail.$touched"
				  ng-hide="signupForm.profileEmail.$valid">
				<p ng-message="email"> Email is invalid.</p>
				<p ng-message="required">Please enter your email.</p>
			</div>
		</div>

		<!--password-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.password.$touched && signupForm.password.$invalid }">
			<h5>
			<label class="control-label" for="password">Password</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<input type="password" class="form-control" id="profilePassword" name="profilePassword" placeholder="Password&hellip;"
						 ng-model="signupData.password" ng-minlength="8" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.password.$error"
				  ng-if="signupForm.password.$touched" ng-hide="signupForm.password.$valid">
				<p ng-message="minlength">Password must be at least 8 characters.</p>
				<p ng-message="required">Please enter your password.</p>
			</div>
		</div>
		<div class="form-group"
			  ng-class="{ 'has-error': signupForm.password_confirmation.$touched && signupForm.password_confirmation.$invalid }">
			<h5>
			<label class="control-label">Confirm Password</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
						 placeholder="Confirm Password&hellip;" match-password="password"
						 ng-model="signupData.password_confirmation" ng-minlength="8" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.password_confirmation.$error"
				  ng-if="signupForm.password_confirmation.$touched" ng-hide="signupForm.password_confirmation.$valid">

				<p ng-message="passwordMatch">Password and confirmation do not match.</p>

			</div>
		</div>
</div>
	</div>
<div class="modal-footer">
	<button type="submit" class="btn btn-primary" ng-click="ok();" ng-disabled="signupForm.$invalid"><i
			class="fa fa-check" aria-hidden="true"></i>Submit
	</button>
	<button type="reset" class="btn btn-warning" ng-click="cancel();"><i class="fa fa-ban"
																								aria-hidden="true"></i> Cancel
	</button>
	</form>
</div>