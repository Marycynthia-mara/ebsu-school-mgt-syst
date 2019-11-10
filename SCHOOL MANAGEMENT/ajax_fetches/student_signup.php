	<!-- <students> -->
	<div class="input-group mul-input2">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
	<!-- <input type="text" name="current_class" placeholder="Current class"> -->
		<input type="text" name="Sfirstname" value="<?php if (isset($Sfirstname)) {
              echo $Sfirstname;
          } ?>"  placeholder="*Firstname">
		<input type="text" name="Slastname" value="<?php if (isset($Slastname)) {
              echo $Slastname;
          } ?>"  placeholder="*Lastname">
		<input type="text" name="Ssurname" value="<?php if (isset($Ssurname)) {
              echo $Ssurname;
          } ?>"  placeholder="*Surname">
	</div>

	<input type="text" name="reg_no" value="<?php if (isset($reg_no)) {
              echo $reg_no;
          } ?>" placeholder="* Reg No" >
	<!-- <input type="text" name="current_class" placeholder="Current class"> -->

	<div class="input-group mb-3 mul-input" >
		<div class="input-group-prepend" >
			<label class="input-group-text" for="users_category_class">Select Class</label>
		</div>

		<?php $classes = ['JSS1 A','JSS1 B','JSS1 C','JSS1 D','JSS2 A','JSS2 B','JSS2 C','JSS2 D','JSS3 A','JSS3 B','JSS3 C','JSS3 D','SS1 A','SS1 B','SS1 C','SS1 D','SS2 A','SS2 B','SS2 C','SS3 A','SS3 B','SS3 C']  ?>
		<select class="custom-select" id="users_category_class" name="student_class">
			<option disabled="" selected=""> * choose...</option>
			<?php foreach ($classes as $class) { ?>
				<option   class=""  value="<?php echo $class ?>"><?php echo $class ?></option>
		<?php } ?>	
			
			
		</select>
	</div>

	<input type="email" name="student_email" value="<?php if (isset($student_email)) {
              echo $student_email;
          } ?>" placeholder="Student's Email" >
	<!-- <input type="password" name="password" placeholder="Password" >
	<input type="password" name="confirm_password" placeholder="Confirm Password" > -->
	

	<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="password" name="student_password" placeholder="* Password" >
		<input type="password" name="student_password2" placeholder="*Confirm Password" >
	</div>

	<div class="form-check">
		<div class="gender">
			<label class="input-group-text one" >Gender</label>
		</div> 

		<div class="gender" >
			<input type="radio" name="gender" class="form-check-input" id="Smale" value="male">
			<label class="form-check-label" for="Smale">* Male</label>
		</div> 

		<div class="gender" >
			<input type="radio" name="gender" class="form-check-input" id="Sfemale" value="female">
			<label class="form-check-label" for="Sfemale">* Female</label>
		</div> 
		
	</div>

	<div class="input-group mb-3 mul-input" >
		<div class="input-group-prepend" >
			<label class="input-group-text">*Date of Birth</label>
		</div>
		<input type="date" name="birth_date" class="birth" value="<?php if (isset($birth_date)) {
              echo $birth_date;
          } ?>" placeholder="*Date of Birth">
	</div>

	<input type="text" name="student_address" value="<?php if (isset($student_address)) {
              echo $student_address;
          } ?>" placeholder="* Student's address">

	<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="text" name="country" value="<?php if (isset($country)) {
              echo $country;
          } ?>"  placeholder="*Student's Country">
		<input type="text" name="state" value="<?php if (isset($state)) {
              echo $state;
          } ?>" placeholder="*Student's State">
	</div>

	<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="text" name="LGA" value="<?php if (isset($LGA)) {
              echo $LGA;
          } ?>"  placeholder="*Student's LGA">
		<input type="text" name="home_town" value="<?php if (isset($home_town)) {
              echo $home_town;
          } ?>" placeholder="*and Home town">
	</div>
<!-- </students> -->

<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="number" name="Sphone_no" class="tel" value="<?php if (isset($Sphone_no)) {
              echo $Sphone_no;
          } ?>" placeholder="Student's Tel" >
		<input type="number" name="Pphone_no" class="tel" value="<?php if (isset($Pphone_no)) {
              echo $Pphone_no;
          } ?>" placeholder="* parent's Tel" >
	</div>

<!-- <parents> -->
	<input type="text" name="fullname" value="<?php if (isset($fullname)) {
              echo $fullname;
          } ?>" placeholder="* Parent's Fullname">		
	<input type="email" name="parent_email" value="<?php if (isset($parent_email)) {
              echo $parent_email;
          } ?>" placeholder="Parent's Email" >
	
<!-- </parents> -->
	
	<input type="submit" name="submit_student" value="Sign Up" id="submit_student">

	<!-- end of students -->

	<p><a>Note that all fields with * is required else optional</a> </p>
	<p><a href="#"> By clicking Sign up, I agree to your terms</a></p>

	<script type="text/javascript">
		var submit_student = document.getElementById('submit_student');
		submit_student.addEventListener('click', function (e) {
			e.preventDefault()
		});
		
	</script>