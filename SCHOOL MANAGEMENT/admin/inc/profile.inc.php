<?php 

function update_student($post, $stud_id){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($firstname)) {
		$firstname = sanitize($firstname);
	} else {
		$err_flag = true;
		$errors['firstname'] = 'Enter Your Firstname.';
	}


	if (!empty($lastname)) {
		$lastname = sanitize($lastname);
	} else {
		$err_flag = true;
		$errors['lastname'] = 'Enter Your Lastname.';
	}

	if (!empty($surname)) {
		$surname = sanitize($surname);
	} else {
		$err_flag = true;
		$errors['surname'] = 'Enter Your Surname.';
	}


	if (!empty($student_class)) {
		$student_class = sanitize($student_class);
	} else {
		$err_flag = true;
		$errors['student_class'] = 'Choose Your Class.';
	}


	if (!empty($gender)) {
		$gender = sanitize($gender);
	} else {
		$err_flag = true;
		$errors['gender'] = 'Choose Your Gender.';
	}

	if (!empty($birth_date)) {
		$birth_date = sanitize($birth_date);
	} else {
		$err_flag = true;
		$errors['birth_date'] = 'Enter Your Birth Date.';
	}

	if (!empty($address)) {
		$address = sanitize($address);
	} else {
		$err_flag = true;
		$errors['address'] = 'Enter Your Address.';
	}


	if (!empty($parent_phone)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $parent_phone)) {
			$parent_phone = sanitize($parent_phone);
		}else{
			$err_flag = true;
			$errors['invalid_Ptel'] = "Enter a valid parent's phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['parent_phone'] = "Enter parent's phone no.";
	}


	$prev_classes = getPrevClass($stud_id);
	extract($prev_classes);

	$upd_class = $all_classes.','.$_POST['student_class'];
	

	if ($err_flag === false) {
		
		$sql1 = "UPDATE students SET firstname = '$firstname', lastname = '$lastname', surname = '$surname', class = '$student_class', all_classes = '$upd_class', gender = '$gender', birth_date = '$birth_date', address = '$address', parent_phone = '$parent_phone' WHERE student_id = $stud_id";
		// var_dump($sql1);
		// die();


		// $sql1 = "UPDATE students SET firstname='$firstname', lastname='$lastname', surname='$surname', class='$student_class', all_classes='$upd_class', email='$email', gender='$gender', birth_date='$birth_date', address='$address', country='$country', state='$state', LGA='$LGA', home_town='$home_town', phone_no='$phone_no', parent_phone='$parent_phone', parent_fullname='$parent_fullname', parent_email='$parent_email' WHERE student_id = $stud_id";

		if (execute_iud($sql1)) {
			return true;
		} else {
			$errors['DB'] = 'update not successful.';
		}	
	}
	return $errors;	
}

function update_teacher($post, $teacher_id){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($firstname)) {
		$firstname = sanitize($firstname);
	} else {
		$err_flag = true;
		$errors['firstname'] = 'Enter Your Firstname.';
	}


	if (!empty($lastname)) {
		$lastname = sanitize($lastname);
	} else {
		$err_flag = true;
		$errors['lastname'] = 'Enter Your Lastname.';
	}

	if (!empty($surname)) {
		$surname = sanitize($surname);
	} else {
		$err_flag = true;
		$errors['surname'] = 'Enter Your Surname.';
	}

	if (!empty($form_class)) {
		$form_class = implode(',', $form_class);
		$form_class = sanitize($form_class);
	} else {
		$err_flag = true;
		$errors['form_class'] = 'Choose Your Form Class.';
	}

	if (!empty($subject_teaching)) {
		$subject_teaching = implode(',', $subject_teaching);
			$subject_teaching = sanitize($subject_teaching);
		} else {
			$err_flag = true;
			$errors['subject_teaching'] = 'Choose The subject you are teaching.';
		}

		if (!empty($subject_class)) {
			$subject_class = implode(',', $subject_class);
			$subject_class = sanitize($subject_class);

		} else {
			$err_flag = true;
			$errors['subject_class'] = 'Choose the class(es) that you teach.';
		}

	if (!empty($email)) {
		$email_tmp_studt = sanitize_email($email);
		if ($email_tmp_studt) {
			if (!check_duplicate('teachers', 'email', $email_tmp_studt)) {
				$email = $email_tmp_studt;
			} else {
				// $err_flag = true;
				// $errors['dup_email_studt'] = 'Email have already been used.';
			}
		} else {
			$err_flag = true;
			$errors['email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = false;
		$errors['email'] = 'Enter Your Email.';
	}


	// if (!empty($password)) {
	// 	$password = sanitize($password);
	// } else {
	// 	$err_flag = true;
	// 	$errors['password'] = 'Enter a password.';
	// }


	// if (!empty($comfirm_password)) {
	// 	$comfirm_password = sanitize($comfirm_password);
	// } else {
	// 	$err_flag = true;
	// 	$errors['comfirm_password'] = 'Confirm Your password.';
	// }


	// if (isset($password) AND isset($comfirm_password)) {
	// 	if ($password == $comfirm_password) {
	// 		$password = sha1($comfirm_password);
	// 	} else {
	// 		$err_flag = true;
	// 		$errors['password_mismatch'] = 'Password do not match.';
	// 	}
	// }


	if (!empty($gender)) {
		$gender = sanitize($gender);
	} else {
		$err_flag = true;
		$errors['gender'] = 'Choose Your Gender.';
	}

	if (!empty($username)) {
		$username = sanitize($username);
	} else {
		$err_flag = true;
		$errors['username'] = 'Enter Your username.';
	}

	if (!empty($phone)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $phone)) {
			$phone = sanitize($phone);
		}else{
			$err_flag = true;
			$errors['invalid_Ptel'] = "Enter a valid  phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['phone'] = "Enter  phone no.";
	}

	if ($err_flag === false) {
		if (!check_duplicate('reg_confirm', 'email', $email)) {
			$sql = "UPDATE teachers SET status = 'false' WHERE teachers_id = $teacher_id";
			if (execute_iud($sql)) {
				$category = "teachers";
				verify_user($firstname, $email, $lastname, $category);
			} else {
				$errors['verify'] = 'could not update status.';
			}
		}
		$sql1 = "UPDATE teachers SET firstname='$firstname', lastname='$lastname', surname='$surname', form_class='$form_class', subject_teaching_classes='$subject_class',  subject_teaching='$subject_teaching',email='$email', gender='$gender', username='$username', phone='$phone' WHERE teachers_id = $teacher_id";

		if (execute_iud($sql1)) {
			return true;
		} else {
			$errors['DB'] = 'update not successful.';
		}	
	}
	return $errors;	
}

function update_admin($post, $admin_id){
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($ManageUser === 'deactivated') {
	  $err_flag = true;
	  $errors['ManageUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

	extract($post);

	if (!empty($firstname)) {
		$firstname = sanitize($firstname);
	} else {
		$err_flag = true;
		$errors['firstname'] = 'Enter Your Firstname.';
	}


	if (!empty($lastname)) {
		$lastname = sanitize($lastname);
	} else {
		$err_flag = true;
		$errors['lastname'] = 'Enter Your Lastname.';
	}

	if (!empty($surname)) {
		$surname = sanitize($surname);
	} else {
		$err_flag = true;
		$errors['surname'] = 'Enter Your Surname.';
	}

	if (!empty($email)) {
		$email_tmp_studt = sanitize_email($email);
		if ($email_tmp_studt) {
			if (!check_duplicate('administrators', 'email', $email_tmp_studt)) {
				$email = $email_tmp_studt;
			} else {
				// $err_flag = true;
				// $errors['dup_email_studt'] = 'Email have already been used.';
			}
		} else {
			$err_flag = true;
			$errors['email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = false;
		$errors['email'] = 'Enter Your Email.';
	}


	// if (!empty($password)) {
	// 	$password = sanitize($password);
	// } else {
	// 	$err_flag = true;
	// 	$errors['password'] = 'Enter a password.';
	// }


	// if (!empty($comfirm_password)) {
	// 	$comfirm_password = sanitize($comfirm_password);
	// } else {
	// 	$err_flag = true;
	// 	$errors['comfirm_password'] = 'Confirm Your password.';
	// }


	// if (isset($password) AND isset($comfirm_password)) {
	// 	if ($password == $comfirm_password) {
	// 		$password = sha1($comfirm_password);
	// 	} else {
	// 		$err_flag = true;
	// 		$errors['password_mismatch'] = 'Password do not match.';
	// 	}
	// }


	if (!empty($gender)) {
		$gender = sanitize($gender);
	} else {
		$err_flag = true;
		$errors['gender'] = 'Choose Your Gender.';
	}

	if (!empty($username)) {
		$username = sanitize($username);
	} else {
		$err_flag = true;
		$errors['username'] = 'Enter Your username.';
	}

	if (!empty($phone)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $phone)) {
			$phone = sanitize($phone);
		}else{
			$err_flag = true;
			$errors['invalid_Ptel'] = "Enter a valid  phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['phone'] = "Enter  phone no.";
	}

	if ($err_flag === false) {
		if (!check_duplicate('reg_confirm', 'email', $email)) {
			$sql = "UPDATE administrators SET status = 'false' WHERE admin_id = $admin_id";
			if (execute_iud($sql)) {
				$category = "administrators";
				verify_user($firstname, $email, $lastname, $category);
			} else {
				$errors['verify'] = 'could not update status.';
			}
		}
		$sql1 = "UPDATE administrators SET firstname='$firstname', lastname='$lastname', surname='$surname', email='$email', gender='$gender', username='$username', phone='$phone' WHERE admin_id = $admin_id";

		if (execute_iud($sql1)) {
			return true;
		} else {
			$errors['DB'] = 'update not successful.';
		}	
	}
	return $errors;	
}
 ?>