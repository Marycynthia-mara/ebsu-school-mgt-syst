	<div class="input-group">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="text" name="firstname" class="form-control" placeholder="Firstname">
		<input type="text" name="lastname" class="form-control" placeholder="Lastname">
		<input type="text" name="surname" class="form-control" placeholder="Surname">
	</div>

	<input type="email" name="email" placeholder="Email" required="">
	<input type="text" name="username" placeholder="Username" required="">
	<input type="password" name="password" placeholder="Password" required="">
	<input type="password" name="confirm_password" placeholder="Confirm Password" required="">
	<input type="number" name="phone_no" placeholder="Phone" required="">

	<div class="form-check">
		<input type="radio" name="gender" class="form-check-input" id="Amale" value="male">
		<label class="form-check-label" for="Amale">Male</label>

		<input type="radio" name="gender" class="form-check-input" id="Afemale" value="female">
		<label class="form-check-label" for="Afemale">Female</label>
	</div>

	<input type="submit" value="Sign Up">