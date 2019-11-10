<!-- staff -->
	<div class="input-group mul-input2">
	<!-- <div class="input-group-prepend">
		<span class="input-group-text" for="users_category">Select category</span>
	</div> -->
	<input type="text" name="Tfirstname" value="<?php if (isset($Tfirstname)) {
				echo $Tfirstname;
			} ?>"  placeholder="*Firstname" class="<?php if (isset($errors['Tfirstname'])) {
			echo "error";
		} ?>">
	<input type="text" name="Tlastname" value="<?php if (isset($Tlastname)) {
				echo $Tlastname;
			} ?>"  placeholder="*Lastname" class="<?php if (isset($errors['Tlastname'])) {
			echo "error";
		} ?>">
	<input type="text" name="Tsurname" value="<?php if (isset($Tsurname)) {
				echo $Tsurname;
			} ?>"  placeholder="*Surname" class="<?php if (isset($errors['Tsurname'])) {
			echo "error";
		} ?>">
</div>

<!-- <input type="text" name="form_class" placeholder="Form class"> -->

<div class="input-group mb-3 mul-input" >
	<div class="input-group-prepend " >
		<label class="input-group-text" for="form_class">Form Class</label>
	</div>

	<?php $form_classes = fetch_column2('classroom_name', 'classroom', 'status', 'true');  ?>
	<select class="custom-select <?php if (isset($errors['form_class'])) {
			echo "error";
		} ?>" id="form_class" name="form_class">
		<option disabled="" selected=""> * choose...</option>
		<option value="NONE">NONE</option>
			<?php foreach ($form_classes as $classes) { ?>
					<option   class=""  value="<?php echo $classes['classroom_id'] ?>"><?php echo $classes['classroom_name'];	 ?></option>
		<?php } ?>				
		
	</select>

</div>

<div class="input-group mb-3 mul-input" >
	<div class="input-group-prepend " >
		<label class="input-group-text" for="subject_teaching">Your Subject</label>
	</div>

		<?php $subjects = fetch_column3('subjects', 'subject_name');  ?>
		<select id="subject_teaching" class="custom-select <?php if (isset($errors['subject_teaching'])) {
			echo "error";
			} ?>" name="subject_teaching"  data-placeholder="Select your subject" >
		<option disabled="" selected=""> * choose...</option>
				<?php foreach ($subjects as $subject) { ?>
						<option   class=""  value="<?php echo $subject['subject_id'] ?>"><?php echo ucwords($subject['subject_name']);  ?></option>
				<?php } ?>  
	</select>

</div>

<div style="height: 65px;" class="input-group mb-3 mul-input" title="Note : To select more than one class hold down 'Ctrl' the key on your windows pc or 'Cmd' key on your mac pc while clicking on the multiple classses.">
	<div class="input-group-prepend " >
		<label class="input-group-text" for="subject_class">Class(es) you teach</label>
	</div>

		<?php $classes = fetch_column2('classroom_name', 'classroom', 'status', 'true');  ?>
		<select id="subject_class" class="custom-select <?php if (isset($errors['subject_class'])) {
			echo "error";
			} ?>" name="subject_class[]"  data-placeholder="Select class(es) you teach" multiple="" size="2">
		<option disabled="" selected=""> * choose...</option>
				<?php foreach ($classes as $class) { ?>
					<option   class=""  value="<?php echo $class['classroom_id'] ?>"><?php echo $class['classroom_name'];	 ?></option>
		<?php } ?>	
	</select>

</div>	

<input type="email" name="staff_email" value="<?php if (isset($staff_email)) {
				echo $staff_email;
			} ?>" placeholder="*Email"  class="<?php if (isset($errors['staff_email']) OR isset($errors['dup_email_staff']) OR isset($errors['staff_email_sanitize'])) {
			echo "error";
		} ?>">
<input type="text" name="staff_username" value="<?php if (isset($staff_username)) {
				echo $staff_username;
			} ?>" placeholder="* Username"  class="<?php if (isset($errors['staff_username'])) {
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
		} ?>" value="<?php if (isset($staff_password)) {
				echo $staff_password;
			} ?>">
	<input type="password" name="staff_password2" placeholder="*Confirm Password"  class="<?php if (isset($errors['staff_password2'])) {
			echo "error";
		} ?>" value="<?php if (isset($staff_password2)) {
				echo $staff_password2;
			} ?>">
</div>

<input type="number" name="staff_tel" value="<?php if (isset($staff_tel)) {
				echo $staff_tel;
			} ?>" class="staff_tel <?php if (isset($errors['staff_tel'])) {
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
		<input type="radio" name="staff_gender"  class="form-check-input" id="Tfemale" value="female">
		<label class="form-check-label" for="Tfemale">* Female</label>
	</div> 
	
</div>

<input type="submit" name="submit_staff" value="Sign Up">
<!-- /staff -->

	<p><a>Note that all fields with * is required else optional</a> </p>
	<p><a href="#"> By clicking Sign up, I agree to your terms</a></p>