<!-- staff -->
		<div class="input-group mul-input2">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="text" name="Tfirstname"  placeholder="*Firstname" class="<?php if (isset($errors['Tfirstname'])) {
                echo "error";
          } ?>">
		<input type="text" name="Tlastname"  placeholder="*Lastname" class="<?php if (isset($errors['Tlastname'])) {
                echo "error";
          } ?>">
		<input type="text" name="Tsurname"  placeholder="*Surname" class="<?php if (isset($errors['Tsurname'])) {
                echo "error";
          } ?>">
	</div>

	<!-- <input type="text" name="form_class" placeholder="Form class"> -->

	<div class="input-group mb-3 mul-input" >
		<div class="input-group-prepend " >
			<label class="input-group-text" for="form_class">Select Class</label>
		</div>

		<?php $classes = ['NONE','JSS1 A','JSS1 B','JSS1 C','JSS1 D','JSS2 A','JSS2 B','JSS2 C','JSS2 D','JSS3 A','JSS3 B','JSS3 C','JSS3 D','SS1 A','SS1 B','SS1 C','SS1 D','SS2 A','SS2 B','SS2 C','SS3 A','SS3 B','SS3 C']  ?>
		<select class="custom-select <?php if (isset($errors['form_class'])) {
                echo "error";
          } ?>" id="form_class" name="form_class">
			<option disabled="" selected=""> * choose...</option>
			<?php foreach ($classes as $class) { ?>
				<option   class=""  value="<?php echo $class ?>"><?php echo $class ?></option>
		<?php } ?>				
			
		</select>
	</div>

	<input type="email" name="staff_email" placeholder="Email"  class="<?php if (isset($errors['staff_email'])) {
                echo "error";
          } ?>">
	<input type="text" name="staff_username" placeholder="* Username"  class="<?php if (isset($errors['staff_username'])) {
                echo "error";
          } ?>">
	<!-- <input type="password" name="password" placeholder="Password" >
	<input type="password" name="confirm_password" placeholder="Confirm Password" > -->

	<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="password" name="staff_password" placeholder="* Password"  class="<?php if (isset($errors['staff_password'])) {
                echo "error";
          } ?>">
		<input type="password" name="staff_password2" placeholder="*Confirm Password"  class="<?php if (isset($errors['staff_password2'])) {
                echo "error";
          } ?>">
	</div>

	<input type="number" name="staff_tel" class="staff_tel <?php if (isset($errors['phone_no'])) {
                echo "error";
          } ?>" placeholder="* Phone" >

		<div class="form-check">
		<div class="gender <?php if (isset($errors['staff_gender'])) {
                echo "error";
          } ?>"  >
			<label class="input-group-text one">Gender</label>
		</div> 

		<div class="gender" >
			<input type="radio" name="staff_gender" class="form-check-input" id="Tmale" value="male">
			<label class="form-check-label" for="Tmale">* Male</label>
		</div> 

		<div class="gender" >
			<input type="radio" name="staff_gender" class="form-check-input" id="Tfemale" value="female">
			<label class="form-check-label" for="Tfemale">* Female</label>
		</div> 
		
	</div>

	<input type="submit" name="submit_staff" value="Sign Up">
<!-- /staff -->

		<p><a>Note that all fields with * is required else optional</a> </p>
		<p><a href="#"> By clicking Sign up, I agree to your terms</a></p>