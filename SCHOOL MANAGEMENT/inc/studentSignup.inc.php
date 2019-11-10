<!-- <students> -->
	<div class="input-group mul-input2">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
	<!-- <input type="text" name="current_class" placeholder="Current class"> -->
		<input type="text" name="Sfirstname" class="<?php if (isset($errors['Sfirstname'])) {
		echo "error";
	} ?>" value="<?php if (isset($Sfirstname)) {
			echo $Sfirstname;
		} ?>"  placeholder="*Firstname">
		<input type="text" name="Slastname" class="<?php if (isset($errors['Slastname'])) {
		echo "error";
	} ?>" value="<?php if (isset($Slastname)) {
			echo $Slastname;
		} ?>"  placeholder="*Lastname">
		<input type="text" name="Ssurname" class="<?php if (isset($errors['Ssurname'])) {
		echo "error";
	} ?>" value="<?php if (isset($Ssurname)) {
			echo $Ssurname;
		} ?>"  placeholder="*Surname">
	</div>

	<input type="text" name="reg_no" class="<?php if (isset($errors['reg_no'])) {
		echo "error";
	} ?>" value="<?php if (isset($reg_no)) {
			echo $reg_no;
		} ?>" placeholder="* Reg No" >
	<!-- <input type="text" name="current_class" placeholder="Current class"> -->

	<div class="input-group mb-3 mul-input" >
		<div class="input-group-prepend" >
			<label class="input-group-text" for="users_category_class">Select Class</label>
		</div>

		<?php $classes = fetch_column2('classroom_name', 'classroom', 'status', 'true');  ?>

		<select class="custom-select <?php if (isset($errors['student_class'])) {
		echo "error";
	} ?>" id="users_category_class" name="student_class" >
			<option disabled="" selected=""> * choose...</option>
			<?php foreach ($classes as $class) { ?>
					<option   class=""  value="<?php echo $class['classroom_id'] ?>"><?php echo $class['classroom_name'];	 ?></option>
		<?php } ?>	
			
			
		</select>
	</div>

	<input type="email" name="student_email" class="<?php if (isset($errors['student_email']) OR isset($errors['dup_email_studt']) OR isset($errors['student_email_sanitize'])) {
		echo "error";
	} ?>" value="<?php if (isset($student_email)) {
			echo $student_email;
		} ?>" placeholder="*Student's Email" >
	<!-- <input type="password" name="password" placeholder="Password" >
	<input type="password" name="confirm_password" placeholder="Confirm Password" > -->
	

	<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="password" name="student_password" class="<?php if (isset($errors['student_password'])) {
		echo "error";
	} ?>"  value="<?php if (isset($student_password)) {
			echo $student_password;
		} ?>" placeholder="* Password" >
		<input type="password" name="student_password2" class="<?php if (isset($errors['student_password2'])) {
		echo "error";
	} ?>"  value="<?php if (isset($student_password2)) {
			echo $student_password2;
		} ?>" placeholder="*Confirm Password" >
	</div>

	<div class="form-check">
		<div class="gender <?php if (isset($errors['gender'])) {
		echo "error";
	} ?>">
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
		<input type="date" name="birth_date" class="birth <?php if (isset($errors['birth_date'])) {
		echo "error";
	} ?>" value="<?php if (isset($birth_date)) {
			echo $birth_date;
		} ?>" placeholder="*Date of Birth">
	</div>

	<input type="text" name="student_address" class="<?php if (isset($errors['student_address'])) {
		echo "error";
	} ?>" value="<?php if (isset($student_address)) {
			echo $student_address;
		} ?>" placeholder="* Student's address">

	<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="text" name="country" class="<?php if (isset($errors['country'])) {
		echo "error";
	} ?>" value="<?php if (isset($country)) {
			echo $country;
		} ?>"  placeholder="*Student's Country">
		<input type="text" name="state" class="<?php if (isset($errors['state'])) {
		echo "error";
	} ?>" value="<?php if (isset($state)) {
			echo $state;
		} ?>" placeholder="*Student's State">
	</div>

	<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="text" name="LGA" class="<?php if (isset($errors['LGA'])) {
		echo "error";
	} ?>" value="<?php if (isset($LGA)) {
			echo $LGA;
		} ?>"  placeholder="*Student's LGA">
		<input type="text" name="home_town" class="<?php if (isset($errors['home_town'])) {
		echo "error";
	} ?>" value="<?php if (isset($home_town)) {
			echo $home_town;
		} ?>" placeholder="*and Home town">
	</div>
<!-- </students> -->

<div class="input-group mul-input3">
		<!-- <div class="input-group-prepend">
			<span class="input-group-text" for="users_category">Select category</span>
		</div> -->
		<input type="number" name="Sphone_no" class="tel <?php if (isset($errors['Sphone_no'])) {
		echo "error";
	} ?>" value="<?php if (isset($Sphone_no)) {
			echo $Sphone_no;
		} ?>" placeholder="Student's Tel" >
		<input type="number" name="Pphone_no" class="tel <?php if (isset($errors['Pphone_no'])) {
		echo "error";
	} ?>" value="<?php if (isset($Pphone_no)) {
			echo $Pphone_no;
		} ?>" placeholder="* parent's Tel" >
	</div>

<!-- <parents> -->
	<input type="text" name="fullname" class="<?php if (isset($errors['fullname'])) {
		echo "error";
	} ?>" value="<?php if (isset($fullname)) {
			echo $fullname;
		} ?>" placeholder="* Parent's Fullname">		
	<input type="email" name="parent_email" class="<?php if (isset($errors['parent_email'])) {
		echo "error";
	} ?>" value="<?php if (isset($parent_email)) {
			echo $parent_email;
		} ?>" placeholder="Parent's Email" >
	
<!-- </parents> -->
	
	<input type="submit" name="submit_student" value="Sign Up" id="submit_student">

	<!-- end of students -->

	<p><a>Note that all fields with * is required else optional</a> </p>
	<p><a href="#"> By clicking Sign up, I agree to your terms</a></p>