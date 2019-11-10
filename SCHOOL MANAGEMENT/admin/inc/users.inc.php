<?php  
session_start();
require_once 'config.inc.php';
require_once './mail-function.inc.php'; 


function fetchTeachers(){
	$sql = "SELECT * FROM teachers ORDER BY firstname ASC";
	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetchFormTeachers($T_id){
	$sql = "SELECT * FROM teachers WHERE teachers_id = $T_id";
	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetchsubject_cats($S_id){
	$sql = "SELECT * FROM subjects WHERE subject_id = $S_id";
	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function add_user($post){
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($firstname)) {
		$firstname = sanitize($firstname);
	} else {
		$err_flag = true;
		$errors['firstname'] = true;
	}


	if (!empty($lastname)) {
		$lastname = sanitize($lastname);
	} else {
		$err_flag = true;
		$errors['lastname'] = true;
	}


	if (!empty($email)) {
		$email_tmp = sanitize($email);
		if ($email_tmp) {
			if (!check_duplicate('users', 'email', $email_tmp)) {
				$email = $email_tmp;
			} else {
				$err_flag = true;
				$errors['dup_email'] = true;
			}
		} else {
			$err_flag = true;
			$errors['email'] = true;
		}
	} else {
		$err_flag = true;
		$errors['email'] = true;
	}


	if (!empty($password1)) {
		$password1 = sanitize($password1);
	} else {
		$err_flag = true;
		$errors['password1'] = true;
	}


	if (!empty($password2)) {
		$password2 = sanitize($password2);
	} else {
		$err_flag = true;
		$errors['password2'] = true;
	}


	if (isset($password1) AND isset($password2)) {
		if ($password1 == $password2) {
			$password = sha1($password1);
		} else {
			$err_flag = true;
			$errors['mismatch'] = true;
		}
	}


	if (!empty($profile_desc)) {
		$profile_desc = sanitize($profile_desc);
	} else {
		$err_flag = true;
		$errors['profile_desc'] = true;
	}


	if ($err_flag === false) {
		$sql = "INSERT INTO users (firstname, lastname, email, password, profile_desc) VALUES ('$firstname', '$lastname', '$email', '$password', '$profile_desc')";

		if (execute_iud($sql)) {
			return true;
		} else {
			$errors['DB'] = true;
		}	
	}
	return $errors;
}

function addClass($post){
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($classname)) {
				if (preg_match('/^(JSS||SS)[123][A-Z]$/', $classname)) {
					$classname = sanitize($classname);	
				}else{
					$err_flag = true;
					$errors['invalid_classname'] = 'Invalid classname';
				}	
				} else {
					$err_flag = true;
					$errors['classname'] = 'Empty classname';
				}

			if (!empty($academicYear)) {
				$academicYear = trim($academicYear);
				if(preg_match('/\d{4}\/\d{4}/', $academicYear)) {
						$academicYear = sanitize($academicYear);
					}else{
						$err_flag = true;
						$errors['invalid_academicYear'] = "Invalid academic year";
					}	
				} else {
					$err_flag = true;
					$errors['academicYear'] = "Enter academic year";
				}


				if (!empty($formTeacher_id)) {
					$formTeacher_id = sanitize($formTeacher_id);
				} else {
					$err_flag = true;
					$errors['formTeacher_id'] = true;
				}

			if (isset($classname) and isset($academicYear)) {
				if (!check_duplicate_class($classname, $academicYear, 'classroom_name', 'academic_year', 'classroom')) {
					$err_flag === false;
				}else{
					$err_flag = true;
					$errors['dup_class'] = "The classroom" . " $classname" . " $academicYear" . " already exist";;
				}
			}

				if ($err_flag === false) {

					$sql = "INSERT INTO classroom (classroom_name, academic_year, teachers_id_fk) VALUES ('$classname', '$academicYear', '$formTeacher_id')";

					if (execute_iud($sql)) {
						return true;
					} else {
						$errors['DB'] = true;
					}	
				}
				return $errors;
}

function addSubject($post){
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($subjectname)) {
				// if (preg_match('/^(\w)\1+$/i', $subjectname)) {
					if (!check_duplicate('subjects', 'subject_name', $subjectname)) {
						$subjectname = sanitize($subjectname);	
						$err_flag === false;
					}else{
						$err_flag = true;
						$errors['dup_subjectname'] = "The subject" . " $subjectname "  . "already exist";;
					}
				// }else{
				// 	$err_flag = true;
				// 	$errors['invalid_subjectname'] = 'Invalid subjectname';
				// }	
	} else {
		$err_flag = true;
		$errors['subjectname'] = 'Empty subjectname';
	}


	if (!empty($subjectcat)) {
			$subjectcat = sanitize($subjectcat);
		} else {
			$err_flag = true;
			$errors['subjectcat'] = true;
		}

	if ($err_flag === false) {

		$sql = "INSERT INTO subjects (subject_name, subject_cat) VALUES ('$subjectname', '$subjectcat')";

		if (execute_iud($sql)) {
			return true;
		} else {
			$errors['DB'] = true;
		}	
	}
	return $errors;
}

function login_user($post){
	$err_flag = false;
	$errors = [];

	extract($post);
	if (!empty($user_logger)) {
		$user_logger = sanitize($user_logger);
	} else{
		$err_flag = true;
		$errors['user_logger'] = "Enter Reg No / Username";
	}


	if (!empty($user_password)) {
		$user_password = sha1(sanitize($user_password));
	} else {
		$err_flag = true;
		$errors['user_password'] = "Enter password";
	}

	if (!empty($login_category)) {
		$login_category = sanitize($login_category);
	} else{
		$err_flag = true;
		$errors['login_category'] = "Choose Category";
	}
	if ($err_flag === false) {
		if ($login_category == 'student') {
			$sql = "SELECT * FROM students WHERE reg_no = '$user_logger' AND password = '$user_password'";
		}

		if ($login_category == 'staff') {
			$sql = "SELECT * FROM teachers WHERE username = '$user_logger' AND password = '$user_password'";
		}

		if ($login_category == 'admin') {
			$sql = "SELECT * FROM administrators WHERE username = '$user_logger' AND password = '$user_password'";
		}
		$result = execute_select($sql);

		if ($result) {
			if ($login_category == 'student') {

				// if( ($result['status'] === '1')){
				// 	$msg1 = true;
				// }else {
				// 	$errors['authentication'] = "You have not yet verified your account";
				// }

				if(($result['fees_paid'] === 'true')){
					$msg2 = true;
				}else {
					$errors['fees_paid'] = "You have not Paid your school fees";
				}

				// if( (isset($msg1)) AND (isset($msg2))){
				// 	$_SESSION['user_id'] = $result['student_id'];
				// 	$_SESSION['category'] = 'student';
				// }

				if( isset($msg2)){
					$_SESSION['user_id'] = $result['student_id'];
					$_SESSION['category'] = 'student';
				}
				
				// if( (isset($errors['authentication'])) or (isset($errors['fees_paid']))){
				// 	return $errors;
				// }else {
				// 	return true;
				// }

				if(isset($errors['fees_paid'])){
					return $errors;
				}else {
					return true;
				}
			}

			if ($login_category == 'staff') {
				$_SESSION['user_id'] = $result['teachers_id'];
				$_SESSION['category'] = 'staff';
				// echo $result['teachers_id'];
				return true;
			}

			if ($login_category == 'admin') {
				$_SESSION['user_id'] = $result['admin_id'];
				$_SESSION['category'] = 'admin';
				return true;
			}
			
		} else {
			$errors[] = "Invalid login details, ensure that you choose the right Category";
		}
	}
	return $errors;
}

function change_psw($post, $category, $user_id){
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($curr_password)) {
		$curr_password = sha1(sanitize($curr_password));
	} else {
		$err_flag = true;
		$errors['curr_password'] = "Enter password";
	}


	if ($err_flag === false){

		if($category === 'student'){
			$sql = "SELECT password FROM students WHERE student_id = '$user_id'";
		}

		if($category === 'admin'){
			$sql = "SELECT password FROM administrators WHERE admin_id = '$user_id'";
		}

		if($category === 'staff'){
			$sql = "SELECT password FROM teachers WHERE teachers_id = '$user_id'";
		}
		
		$result = execute_select($sql);
			
			if ($result) {
				extract($result);
				if($curr_password == $password){
					return true;
				}else{
					$errors['password'] = "Incorrect password";
					return $errors;
				}
			}
			$errors['psw'] = "something went wrong!";
			 return $errors;
	}return $errors;
}

function Reset_password($post, $category, $user_id){
	$err_flag = false;
	$errors = [];
	extract($post);

	if (!empty($password)) {
		$password = sanitize($password);
	} else {
		$err_flag = true;
		$errors['password'] = 'Enter a password.';
	}


	if (!empty($confirm_password)) {
		$confirm_password = sanitize($confirm_password);
	} else {
		$err_flag = true;
		$errors['confirm_password'] = 'Confirm Your password.';
	}

	if (isset($password) AND isset($confirm_password)) {
		if ($password == $confirm_password) {
			$password = sha1($password);
		} else {
			$err_flag = true;
			$errors['password_mismatch'] = 'Password do not match.';
		}
	}

	if ($err_flag === false) {

	if ($category == 'student') {
		$sql = "UPDATE students SET password = '$password' WHERE student_id = '$user_id'";
	}

	if ($category == 'staff') {
		$sql = "UPDATE teachers SET password = '$password' WHERE teachers_id = '$user_id'";
	}

	if ($category == 'admin') {
		$sql = "UPDATE administrators SET password = '$password' WHERE admin_id = '$user_id'";
	}

		$result = execute_iud($sql);
		if($result){
			return true;
		}else {
			$errors['psw'] = 'Password not sucessfully updated.';
		}
		
	}return $errors;
}

function fetch_user($table, $column, $userID){
	$sql = "SELECT * FROM $table WHERE $column = '$userID'";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function upload_profile_image($file, $post, $column, $id)
{
	$err_flag = false;
	$user_id = $post['userid'];
	$result = get_image_path($file);
	if ($result) {
		$image_path = $result;
	}else{
		$err_flag = true;
	}

	if ($err_flag === false) {
		$sql = "UPDATE $column SET profile_img_path = '$image_path' WHERE $id = '$user_id'";

		if (execute_iud($sql)) {
			return true;
		}return false;
	}
}

function add_student($post){
	$category = "students";
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($SignUp === 'deactivated') {
		$err_flag = true;
		$errors['signup_operation'] = 'This Operation is not available to You, port 587 blocked';
		return $errors;
	}

	extract($post);

	if (!empty($Sfirstname)) {
		$Sfirstname = sanitize($Sfirstname);
	} else {
		$err_flag = true;
		$errors['Sfirstname'] = 'Enter Your Firstname.';
	}


	if (!empty($Slastname)) {
		$Slastname = sanitize($Slastname);
	} else {
		$err_flag = true;
		$errors['Slastname'] = 'Enter Your Lastname.';
	}

	if (!empty($Ssurname)) {
		$Ssurname = sanitize($Ssurname);
	} else {
		$err_flag = true;
		$errors['Ssurname'] = 'Enter Your Surname.';
	}

	

	if (!empty($reg_no)) {
		$reg_no_tmp = sanitize($reg_no);
		if ($reg_no_tmp) {
			$academicYear = date('Y');
			$academicYear = intval($academicYear);
			$academicYear2 = $academicYear + 1;
			$academicYear = "$academicYear" . "/" . "$academicYear2";
			$reg_no_tmp = $reg_no_tmp . '-' . "$academicYear";
			if (!check_duplicate('students', 'reg_no', $reg_no_tmp)) {
				$reg_no = $reg_no_tmp;
			} else {
				$err_flag = true;
				$errors['dup_reg_no'] = 'Reg No already exist.';
			}
		} else {
			$err_flag = true;
			$errors['reg_no_sanitize'] = 'Enter a valid Reg No.';
		}
	} else {
		$err_flag = true;
		$errors['reg_no'] = 'Enter Your Reg No.';
	}


	if (!empty($student_class)) {
		$student_class = sanitize($student_class);
	} else {
		$err_flag = true;
		$errors['student_class'] = 'Choose Your Class.';
	}

	// if (!empty($student_email)) {
	// 	$email_tmp_studt = sanitize_email($student_email);
	// 	if ($email_tmp_studt) {
	// 		if (!check_duplicate('students', 'email', $email_tmp_studt)) {
	// 			$student_email = $email_tmp_studt;
	// 		} else {
	// 			$err_flag = true;
	// 			$errors['dup_email_studt'] = 'Email have already been used.';
	// 		}
	// 	} else {
	// 		$err_flag = true;
	// 		$errors['student_email_sanitize'] = 'Enter a valid Email address.';
	// 	}
	// } else {
	// 	$err_flag = true;
	// 	$errors['student_email'] = 'Enter Your Email.';
	// }


	if (!empty($student_password)) {
		$student_password = sanitize($student_password);
	} else {
		$err_flag = true;
		$errors['student_password'] = 'Enter a password.';
	}


	if (!empty($student_password2)) {
		$student_password2 = sanitize($student_password2);
	} else {
		$err_flag = true;
		$errors['student_password2'] = 'Confirm Your password.';
	}


	if (isset($student_password) AND isset($student_password2)) {
		if ($student_password == $student_password2) {
			$password = sha1($student_password);
		} else {
			$err_flag = true;
			$errors['password_mismatch'] = 'Password do not match.';
		}
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

	if (!empty($student_address)) {
		$student_address = sanitize($student_address);
	} else {
		$err_flag = true;
		$errors['student_address'] = 'Enter Your Address.';
	}

	// if (!empty($country)) {
	// 	$country = sanitize($country);
	// } else {
	// 	$err_flag = true;
	// 	$errors['country'] = 'Enter Your Country.';
	// }

	// if (!empty($state)) {
	// 	$state = sanitize($state);
	// } else {
	// 	$err_flag = true;
	// 	$errors['state'] = 'Enter Your State.';
	// }

	// if (!empty($LGA)) {
	// 	$LGA = sanitize($LGA);
	// } else {
	// 	$err_flag = true;
	// 	$errors['LGA'] = 'Enter Your LGA.';
	// }

	// if (!empty($home_town)) {
	// 	$home_town = sanitize($home_town);
	// } else {
	// 	$err_flag = true;
	// 	$errors['home_town'] = 'Enter Your home_town.';
	// }

	// if (!empty($Sphone_no)) {
	// 	if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $Sphone_no)) {
	// 		$Sphone_no = sanitize($Sphone_no);
	// 	}else{
	// 		$err_flag = true;
	// 		$errors['invalid_Stel'] = "Enter a valid student's phone no.";
	// 	}	
	// } else {
	// 	// $err_flag = false;
	// 	// $errors['Sphone_no'] = "Enter student's phone no.";
	// }

	if (!empty($Pphone_no)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $Pphone_no)) {
			$Pphone_no = sanitize($Pphone_no);
		}else{
			$err_flag = true;
			$errors['invalid_Ptel'] = "Enter a valid parent's phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['Pphone_no'] = "Enter parent's phone no.";
	}

	// if (!empty($fullname)) {
	// 	$fullname = sanitize($fullname);
	// } else {
	// 	$err_flag = true;
	// 	$errors['fullname'] = "Enter parent's Fullname.";
	// }

	// if (!empty($parent_email)) {
	// 	$parent_email = sanitize($parent_email);
	// } else {
	// 	// $err_flag = false;
	// 	// $errors['parent_email'] = "Enter parent's Fullname.";
	// }

	if ($err_flag === false) {
		$sql1 = "INSERT INTO students (firstname, lastname, surname, reg_no, class, password, gender, birth_date, address,parent_phone) VALUES ('$Sfirstname','$Slastname','$Ssurname','$reg_no','$student_class','$password','$gender','$birth_date','$student_address','$Pphone_no')";

		// $sql1 = "INSERT INTO students (firstname, lastname, surname, reg_no, class, email, password, gender, birth_date, address, country, state, LGA, home_town, phone_no,parent_phone,parent_fullname,parent_email) VALUES ('$Sfirstname','$Slastname','$Ssurname','$reg_no','$student_class','$student_email','$password','$gender','$birth_date','$student_address','$country','$state','$LGA','$home_town','$Sphone_no','$Pphone_no','$fullname','$parent_email')";

		if (execute_iud($sql1)) {
			// $subject = "Welcome to EBSU Staff Secondary School";
			// $token = sha1(uniqid());
			// $body = get_email_template('./email_template.php', $Sfirstname, $student_email, $category, $token);
			// $fullname = $Sfirstname . " " . $Slastname;
			// $response = send_mail($student_email, $fullname, $subject, $body);
			// if ($response) {
				// if (save_token($student_email, $token)) {
					return true;
				// }
			}
			// else{
			// 	$errors['save_token'] = "Registeration successfull, but Something went wrong. ". "<br> "."Email not sent, ensure email exist, " ."<br> "."Ensure you have a good internet connection. ". "<br> "."ensure you update your email if it does not exist and verify your account later";
			// 	return $errors;
			// }
		
		} else {
			$errors['DB'] = 'Sign up not successful.';
			return $errors;
		}
	// }
	return $errors;	
}

function add_staff($post){
	$category = "teachers";
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($SignUp === 'deactivated') {
		$err_flag = true;
		$errors['signup_operation'] = 'This Operation is not available to You, port 587 blocked';
		return $errors;
	}

	extract($post);

	if (!empty($Tfirstname)) {
		$Tfirstname = sanitize($Tfirstname);
	} else {
		$err_flag = true;
		$errors['Tfirstname'] = 'Enter Your Firstname.';
	}


	if (!empty($Tlastname)) {
		$Tlastname = sanitize($Tlastname);
	} else {
		$err_flag = true;
		$errors['Tlastname'] = 'Enter Your Lastname.';
	}

	if (!empty($Tsurname)) {
		$Tsurname = sanitize($Tsurname);
	} else {
		$err_flag = true;
		$errors['Tsurname'] = 'Enter Your Surname.';
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

	if (!empty($staff_email)) {
		$email_tmp_staff = sanitize_email($staff_email);
		if ($email_tmp_staff) {
			if (!check_duplicate('teachers', 'email', $email_tmp_staff)) {
				$staff_email = $email_tmp_staff;
			} else {
				$err_flag = true;
				$errors['dup_email_staff'] = 'Email have already been used.';
			}
		} else {
			$err_flag = true;
			$errors['staff_email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = true;
		$errors['staff_email'] = 'Enter Your Email.';
	}

	if (!empty($staff_username)) {
		$staff_username_tmp = sanitize($staff_username);
		if ($staff_username_tmp) {
			if (!check_duplicate('teachers', 'username', $staff_username_tmp)) {
				$staff_username = $staff_username_tmp;
			} else {
				$err_flag = true;
				$errors['dup_staff_username'] = 'Username already used by another staff.';
			}
		} else {
			$err_flag = true;
			$errors['staff_username_sanitize'] = 'Enter a valid Username.';
		}
	} else {
		$err_flag = true;
		$errors['staff_username'] = 'Enter Your Username.';
	}

	if (!empty($staff_password)) {
		$staff_password = sanitize($staff_password);
	} else {
		$err_flag = true;
		$errors['staff_password'] = 'Enter a password.';
	}


	if (!empty($staff_password2)) {
		$staff_password2 = sanitize($staff_password2);
	} else {
		$err_flag = true;
		$errors['staff_password2'] = 'Confirm Your password.';
	}


	if (isset($staff_password) AND isset($staff_password2)) {
		if ($staff_password == $staff_password2) {
			$password = sha1($staff_password);
		} else {
			$err_flag = true;
			$errors['password_mismatch'] = 'Password do not match.';
		}
	}


	if (!empty($staff_gender)) {
		$staff_gender = sanitize($staff_gender);
	} else {
		$err_flag = true;
		$errors['staff_gender'] = 'Choose Your Gender.';
	}


	if (!empty($staff_tel)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $staff_tel)) {
			$staff_tel = sanitize($staff_tel);
		}else{
			$err_flag = true;
			$errors['invalid_tel'] = "Enter a valid phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['staff_tel'] = "Enter Your phone no.";
	}


	if ($err_flag === false) {
		$sql = "INSERT INTO teachers (firstname, lastname, surname, form_class, email, username, password, gender, phone,subject_teaching,subject_teaching_classes) VALUES ('$Tfirstname','$Tlastname','$Tsurname','$form_class','$staff_email', '$staff_username','$password','$staff_gender','$staff_tel','$subject_teaching','$subject_class')";

		
		if (execute_iud($sql)) {
			$subject = "Welcome to EBSU Staff Secondary School";
			$token = sha1(uniqid());
			$body = get_email_template('./email_template.php', $Tfirstname, $staff_email, $category, $token);
			$fullname = $Tfirstname . " " . $Tlastname;
			$response = send_mail($staff_email, $fullname, $subject, $body);
			if ($response) {
				if (save_token($staff_email, $token)) {
					return true;
				}
			}else{
				$errors['save_token'] = "Registeration successfull, but Something went wrong. ". "<br> "."Email not sent, ensure email exist, " ."<br> "."Ensure you have a good internet connection. ". "<br> "."ensure you update your email if it does not exist and verify your account later";
				return $errors;
			}
		
		} else {
			$errors['DB'] = 'Sign up not successful.';
			return $errors;
		}
	}
	return $errors;
}

function add_admin($post){
	$category = "administrators";
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($SignUp === 'deactivated') {
		$err_flag = true;
		$errors['signup_operation'] = 'This Operation is not available to You, port 587 blocked';
		return $errors;
	}

	extract($post);

	if (!empty($Afirstname)) {
		$Afirstname = sanitize($Afirstname);
	} else {
		$err_flag = true;
		$errors['Afirstname'] = 'Enter Your Firstname.';
	}


	if (!empty($Alastname)) {
		$Alastname = sanitize($Alastname);
	} else {
		$err_flag = true;
		$errors['Alastname'] = 'Enter Your Lastname.';
	}

	if (!empty($Asurname)) {
		$Asurname = sanitize($Asurname);
	} else {
		$err_flag = true;
		$errors['Asurname'] = 'Enter Your Surname.';
	}

	if (!empty($Astaff_email)) {
		$email_tmp_staff = sanitize_email($Astaff_email);
		if ($email_tmp_staff) {
			if (!check_duplicate('administrators', 'email', $email_tmp_staff)) {
				$Astaff_email = $email_tmp_staff;
			} else {
				$err_flag = true;
				$errors['dup_email_staff'] = 'Email have already been used.';
			}
		} else {
			$err_flag = true;
			$errors['Astaff_email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = true;
		$errors['Astaff_email'] = 'Enter Your Email.';
	}

	if (!empty($Astaff_username)) {
		$Astaff_username_tmp = sanitize($Astaff_username);
		if ($Astaff_username_tmp) {
			if (!check_duplicate('administrators', 'username', $Astaff_username_tmp)) {
				$Astaff_username = $Astaff_username_tmp;
			} else {
				$err_flag = true;
				$errors['dup_Astaff_username'] = 'Username already used by another admin.';
			}
		} else {
			$err_flag = true;
			$errors['Astaff_username_sanitize'] = 'Enter a valid Username.';
		}
	} else {
		$err_flag = true;
		$errors['Astaff_username'] = 'Enter Your Username.';
	}

	if (!empty($Astaff_password)) {
		$Astaff_password = sanitize($Astaff_password);
	} else {
		$err_flag = true;
		$errors['Astaff_password'] = 'Enter a password.';
	}


	if (!empty($Astaff_password2)) {
		$Astaff_password2 = sanitize($Astaff_password2);
	} else {
		$err_flag = true;
		$errors['Astaff_password2'] = 'Confirm Your password.';
	}


	if (isset($Astaff_password) AND isset($Astaff_password2)) {
		if ($Astaff_password == $Astaff_password2) {
			$password = sha1($Astaff_password);
		} else {
			$err_flag = true;
			$errors['password_mismatch'] = 'Password do not match.';
		}
	}


	if (!empty($admin_gender)) {
		$admin_gender = sanitize($admin_gender);
	} else {
		$err_flag = true;
		$errors['admin_gender'] = 'Choose Your Gender.';
	}


	if (!empty($admin_tel)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $admin_tel)) {
			$admin_tel = sanitize($admin_tel);
		}else{
			$err_flag = true;
			$errors['invalid_tel'] = "Enter a valid phone no.";
		}	
	} else {
		$err_flag = true;
		$errors['admin_tel'] = "Enter Your phone no.";
	}


	if ($err_flag === false) {
		$sql = "INSERT INTO administrators (firstname, lastname, surname, email, username, password, gender, phone) VALUES ('$Afirstname','$Alastname','$Asurname','$Astaff_email', '$Astaff_username','$password','$admin_gender','$admin_tel')";
		

		if (execute_iud($sql)) {
			$subject = "Welcome to EBSU Staff Secondary School";
			$token = sha1(uniqid());
			$body =  get_email_template('./email_template.php', $Afirstname, $Astaff_email, $category, $token);
			$fullname = $Afirstname . " " . $Alastname;
			$response = send_mail($Astaff_email, $fullname, $subject, $body);
			if ($response) {
				if (save_token($Astaff_email, $token)) {
					return true;
				}
			}else{
				$errors['save_token'] = "Registeration successfull, but Something went wrong. ". "<br> "."Email not sent, ensure email exist, " ."<br> "."Ensure you have a good internet connection. ". "<br> "."ensure you update your email if it does not exist and verify your account later";
				return $errors;
			}
		
		} else {
			$errors['DB'] = 'Sign up not successful.';
			return $errors;
		}

			// $subject = "Welcome to EBSU Staff Secondary School";
			// $token = sha1(uniqid());
			// $body = get_email_template('./email_template.php', $Afirstname, $Astaff_email, $category, $token);
			// $fullname = $Afirstname . " " . $Alastname;
			// $response = send_mail($Astaff_email, $fullname, $subject, $body);
			// if ($response) {
			// 	if (execute_iud($sql)) {
			// 		if (save_token($Astaff_email, $token)) {
			// 			return true;
			// 		}
			// 	} else {
			// 		$errors['DB'] = 'Sign up not successful.';
			// 		return $errors;
			// 	}	

			// }else{
			// 	$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " ."<br> "."ensure update your email and verify your account";
			// 	return $errors;
			// }
		
	}
	return $errors;
}

function add_result($post){
	$err_flag = false;
	$errors = [];
	extract($post);

	$counter = 1;
	foreach ($_SESSION['sub-stud-fetch'] as $score) {
		if(in_array($score['student_id'], $_SESSION['elective_stud'])){
			$CAT1 = "CATone"."$counter";
			if (!empty($_POST[$CAT1])) {
				if (preg_match('/^[0-9]{1,2}$/', $_POST[$CAT1]) && $_POST[$CAT1] < 11) {
					$_POST[$CAT1] = sanitize($_POST[$CAT1]);
				}else{
					$err_flag = true;
					$errors[$CAT1] = "Enter a valid CAT1 score for student at S/N " ."$counter" ."<br>";
				}	
			} else {
				$CAT1 = "";
			}

			$CAT2 = "CATtwo"."$counter";
			if (!empty($_POST[$CAT2])) {
				if (preg_match('/[0-9]{1,2}/', $_POST[$CAT2]) && $_POST[$CAT2] < 11 ) {
					$_POST[$CAT2] = sanitize($_POST[$CAT2]);
				}else{
					$err_flag = true;
					$errors[$CAT2] = "Enter a valid CAT2 score for student at S/N " ."$counter" ."<br>";
				}	
			} else {
				$CAT2 = "";
			}

			$CAT3 = "CATthree"."$counter";
			if (!empty($_POST[$CAT3])) {
				if (preg_match('/[0-9]{1,2}/', $_POST[$CAT3]) && $_POST[$CAT3] < 11 ) {
					$_POST[$CAT3] = sanitize($_POST[$CAT3]);
				}else{
					$err_flag = true;
					$errors[$CAT3] = "Enter a valid CAT3 score for student at S/N " ."$counter" ."<br>";
				}	
			} else {
				$CAT3 = "";
			}

			$EXAM = "EXAM"."$counter";
			if (!empty($_POST[$EXAM])) {
				if (preg_match('/[0-9]{1,2}/', $_POST[$EXAM]) && $_POST[$EXAM] < 71) {
					$_POST[$EXAM] = sanitize($_POST[$EXAM]);
				}else{
					$err_flag = true;
					$errors[$EXAM] = "Enter a valid EXAM score for student at S/N " ."$counter" ."<br>";
				}	
			} else {
				$EXAM = "";
			}

			$TOTAL = "TOTAL"."$counter";
			if (!empty($_POST[$TOTAL])) {
				if (preg_match('/[0-9]{1,3}/', $_POST[$TOTAL]) && $_POST[$TOTAL] < 101) {
					$_POST[$TOTAL] = sanitize($_POST[$TOTAL]);
				}else{
					$err_flag = true;
					$errors[$TOTAL] = "Invalid TOTAL score for student at S/N " ."$counter" ."<br>";
				}	
			} else {
				$TOTAL = "";
			}

			$GRADE = "GRADE"."$counter";
			if (!empty($_POST[$GRADE])) {
				if (preg_match('/[A-Z]{1}/', $_POST[$GRADE])) {
					$_POST[$GRADE] = sanitize($_POST[$GRADE]);
				}else{
					$err_flag = true;
					$errors[$GRADE] = "Invalid GRADE score for student at S/N " ."$counter" ."<br>";
				}	
			} else {
				$GRADE = "";
			}

			$sub_tea_comt = "sub_tea_comt"."$counter";
			if (!empty($_POST[$sub_tea_comt])) {
					$_POST[$sub_tea_comt] = sanitize($_POST[$sub_tea_comt]);
				}else{
					$sub_tea_comt = "";
				}
				$counter++;		
		}
	}

	if ($err_flag === false) {
		$student_id_fk = $_SESSION['sub-stud-fetch'];
		$subject_id_fk = $_SESSION['Subject'];
		$student_class_id_fk = $_SESSION['Class'];
		$term = $_SESSION['exam_term'];
		$ACyear = $_SESSION['AC_year'];
		$lopper = 1;
		$upload_counter = 0;
		$count = 0;
			if ($_SESSION['exam_term'] == "first"  or $_SESSION['exam_term'] == "second") {
				
				$sql = "INSERT INTO exam_result (student_id_fk, subject_id_fk, student_class_id_fk, exam_term, academic_session, CAT1_score, CAT2_score, CAT3_score, EXAM_score, total, grade, sub_teacher_comt)"; 

				foreach ($student_id_fk as $stud_id) {
					if(in_array($stud_id['student_id'], $_SESSION['elective_stud'])){
						$cat1 = "CATone"."$lopper";
						$cat2 = "CATtwo"."$lopper";
						$cat3 = "CATthree"."$lopper";
						$exam = "EXAM"."$lopper";
						$total = "TOTAL"."$lopper";
						$grade = "GRADE"."$lopper";
						$sub_tea_comm = "sub_tea_comt"."$lopper";
						$catOne = $_POST[$cat1];
						$catTwo = $_POST[$cat2];
						$catThree = $_POST[$cat3];
						$Exam = $_POST[$exam];
						$Total = $_POST[$total];
						$Grade = $_POST[$grade];
						$sub_tea_comment = $_POST[$sub_tea_comm];
						$Student = $stud_id['student_id'];
					
						$sql.= " ('$Student','$subject_id_fk','$student_class_id_fk','$term','$ACyear','$catOne','$catTwo','$catThree','$Exam','$Total','$Grade','$sub_tea_comment')," ;

						// if ($count == count($student_id_fk)) {
							$trim = rtrim($sql, '');
							$trim = str_replace('VALUES',"",$trim);
							$sql = substr_replace($trim, ' VALUES ', 184, 0);
							// $trim =	substr_replace($trim, ' VALUES ', 166, 0);
						// }
					// }

					if (!check_duplicate_record('exam_result', $student_class_id_fk, $subject_id_fk, $ACyear, $term, $Student)) {
						$upload_counter++;
					}else{
						
						$sql = "UPDATE exam_result SET student_id_fk = '$Student', subject_id_fk = '$subject_id_fk', student_class_id_fk = '$student_class_id_fk', exam_term = '$term', academic_session = '$ACyear', CAT1_score = '$catOne', CAT2_score = '$catTwo', CAT3_score = '$catThree', EXAM_score = '$Exam', total = '$Total', grade = '$Grade', sub_teacher_comt = '$sub_tea_comment' WHERE student_id_fk = '$Student' and academic_session = '$ACyear' and subject_id_fk = '$subject_id_fk' and student_class_id_fk = '$student_class_id_fk' and exam_term = '$term'";
						
						$result = execute_iud($sql);
						if ($result) {
							$update = true;
						} else {
							$errors['DB'] = 'Update not successful. Ensure You made some changes';
							return $errors;
						}

					}
					$lopper++;
					$count++;
				}
			}

			if($upload_counter === count($_SESSION['elective_stud'])){
				$sql = rtrim($sql, ',');
				if (execute_iud($sql)) {
					$upload = true;
				} else {
					$errors['DB'] = 'insert not successful.';
					global $conn;
					return $errors;
				}
			}
			
			if (isset($upload)) {
				if ($upload === true) {
					return true;
				}
			}
			
			if (isset($update)) {
				if ($update === true) {
					return 'updated';
				}
			}		
		}
	}	
	return $errors;
}

function add_annual_result($post){
	$err_flag = false;
	$errors = [];
	extract($post);

	$counter = 1;
	foreach ($_SESSION['sub-stud-fetch'] as $score) {
        if(in_array($score['student_id'], $_SESSION['elective_stud'])){
            $CAS = "CAS"."$counter";
            if (!empty($_POST[$CAS])) {
                if (preg_match('/^[0-9]{1,2}$/', $_POST[$CAS]) && $_POST[$CAS] < 31) {
                    $_POST[$CAS] = sanitize($_POST[$CAS]);
                }else{
                    $err_flag = true;
                    $errors[$CAS] = "Enter a valid Contineous Assessment Score score for student at S/N " ."$counter" ."<br>";
                }	
            } else {
                $CAS = "";
            }

            $EXS = "EXS"."$counter";
            if (!empty($_POST[$EXS])) {
                if (preg_match('/^[0-9]{1,2}$/', $_POST[$EXS]) && $_POST[$EXS] < 71) {
                    $_POST[$EXS] = sanitize($_POST[$EXS]);
                }else{
                    $err_flag = true;
                    $errors[$EXS] = "Enter a valid Examination Score score for student at S/N " ."$counter" ."<br>";
                }	
            } else {
                $EXS = "";
            }

            $TOS = "TOS"."$counter";
            if (!empty($_POST[$TOS])) {
                if (preg_match('/^[0-9]{1,3}$/', $_POST[$TOS]) && $_POST[$TOS] < 101) {
                    $_POST[$TOS] = sanitize($_POST[$TOS]);
                }else{
                    $err_flag = true;
                    $errors[$TOS] = "Enter a valid Total Score score for student at S/N " ."$counter" ."<br>";
                }	
            } else {
                $TOS = "";
            }

            $FSTT = "FSTT"."$counter";
            if (!empty($_POST[$FSTT])) {
                if (preg_match('/[0-9]{1,3}/', $_POST[$FSTT]) && $_POST[$FSTT] < 201 ) {
                    $_POST[$FSTT] = sanitize($_POST[$FSTT]);
                }else{
                    $err_flag = true;
                    $errors[$FSTT] = "Invalid First & Second Term Total score for student at S/N " ."$counter" ."<br>";
                }	
            } else {
                $FSTT = "";
            }

            $FSTTTP = "FSTTTP"."$counter";
            if (!empty($_POST[$FSTTTP])) {
                if (preg_match('/[0-9]{1,3}/', $_POST[$FSTTTP]) && $_POST[$FSTTTP] < 101 ) {
                    $_POST[$FSTTTP] = sanitize($_POST[$FSTTTP]);
                }else{
                    $err_flag = true;
                    $errors[$FSTTTP] = "Invalid First, Second & Third Term Total % score for student at S/N " ."$counter" ."<br>";
                }	
            } else {
                $FSTTTP = "";
            }

            $FSTTT = "FSTTT"."$counter";
            if (!empty($_POST[$FSTTT])) {
                if (preg_match('/[0-9]{1,3}/', $_POST[$FSTTT]) && $_POST[$FSTTT] < 301) {
                    $_POST[$FSTTT] = sanitize($_POST[$FSTTT]);
                }else{
                    $err_flag = true;
                    $errors[$FSTTT] = "Invalid First, Second & Third Term Total score for student at S/N " ."$counter" ."<br>";
                }	
            } else {
                $FSTTT = "";
            }

            $GRD = "GRD"."$counter";
            if (!empty($_POST[$GRD])) {
                if (preg_match('/[A-Z]{1}/', $_POST[$GRD])) {
                    $_POST[$GRD] = sanitize($_POST[$GRD]);
                }else{
                    $err_flag = true;
                    $errors[$GRD] = "Invalid GRD score for student at S/N " ."$counter" ."<br>";
                }	
            } else {
                $GRD = "";
            }

            $STC = "STC"."$counter";
            if (!empty($_POST[$STC])) {
                    $_POST[$STC] = sanitize($_POST[$STC]);
                }else{
                    $STC = "";
                }	
		    $counter++;
        }
	}

	if ($err_flag === false) {
		$student_id_fk = $_SESSION['sub-stud-fetch'];
		$subject_id_fk = $_SESSION['Subject'];
		$student_class_id_fk = $_SESSION['Class'];
		$term = $_SESSION['exam_term'];
		$ACyear = $_SESSION['AC_year'];
		$lopper = 1;
		$count = 0;
        $upload_counter = 0;
			if ($_SESSION['exam_term'] == "third") {
				
			    $sql = "INSERT INTO annual_result (student_id_fk, subject_id_fk, student_class_id_fk, academic_session, asst_total, exam_total, total_over_100, total_over_200, total_over_300, total_in_percent, grade, sub_teacher_comt)"; 
				
                foreach ($student_id_fk as $stud_id) {
                    if(in_array($stud_id['student_id'], $_SESSION['elective_stud'])){
                        $cas = "CAS"."$lopper";
                        $exs = "EXS"."$lopper";
                        $tos = "TOS"."$lopper";
                        $fstt = "FSTT"."$lopper";
                        $fsttt = "FSTTT"."$lopper";
                        $fstttp = "FSTTTP"."$lopper";
                        $grd = "GRD"."$lopper";
                        $stc = "STC"."$lopper";
                        $CAS = $_POST[$cas];
                        $EXS = $_POST[$exs];
                        $TOS = $_POST[$tos];
                        $FSTT = $_POST[$fstt];
                        $FSTTT = $_POST[$fsttt];
                        $FSTTTP = $_POST[$fstttp];
                        $GRD = $_POST[$grd];
                        $STC = $_POST[$stc];
                        $Student = $stud_id['student_id'];        
                            
                        
                        $sql.= " ('$Student','$subject_id_fk','$student_class_id_fk','$ACyear','$CAS','$EXS','$TOS','$FSTT','$FSTTT','$FSTTTP','$GRD','$STC')," ;

                        // if ($count == count($student_id_fk)) {
                            $trim = rtrim($sql, '');
                            $trim = str_replace('VALUES',"",$trim);
                            $sql = substr_replace($trim, ' VALUES ', 210, 0);
                            // $trim =	substr_replace($trim, ' VALUES ', 166, 0);
                        // }
                
                        // $sql = "INSERT INTO administrators (firstname, lastname, surname, email, username, password, gender, phone) VALUES ('$sub_tea_comt','$Alastname','$Asurname','$Astaff_email', '$Astaff_username','$password','$admin_gender','$CATone')";

                        if (!check_duplicate_record2('annual_result', $student_class_id_fk, $subject_id_fk, $ACyear,$Student)) {
                            $upload_counter++;
                        }else{
                                
                                $sql = "INSERT INTO annual_result (,,, , asst_total, exam_total, total_over_100, total_over_200, total_over_300, total_in_percent, grade, sub_teacher_comt)"; 

                                $sql.= " ('','','','','$','$','$','$','$','$','$GRD','$STC')," ;

                                
                                $sql = "UPDATE annual_result SET student_id_fk = '$Student', subject_id_fk = '$subject_id_fk', student_class_id_fk = '$student_class_id_fk', academic_session = '$ACyear', asst_total = '$CAS',exam_total = '$EXS', total_over_100 = '$TOS', total_over_200 = '$FSTT', total_over_300 = '$FSTTT', total_in_percent = '$FSTTTP', grade = '$GRD', sub_teacher_comt = '$STC' WHERE student_id_fk = '$Student' and academic_session = '$ACyear' and subject_id_fk = '$subject_id_fk' and student_class_id_fk = '$student_class_id_fk'";
                                
                                
                                $result = execute_iud($sql);
                                if ($result) {
                                    $update = true;
                                } else {
									$errors['DB'] = 'Update not successful. Ensure You made some changes';
									return $errors;
                                }
                            }
                            $lopper++;
                            $count++;
                    }
                } 
                if($upload_counter === count($_SESSION['elective_stud'])){
                    $sql = rtrim($sql, ',');
                    if (execute_iud($sql)) {
                        $upload = true;

                    } else {
                        $errors['DB'] = 'insert not successful.';
                        global $conn;
                        return $errors;
                    }
                }
                
                if (isset($upload)) {
                    if ($upload === true) {
                        return true;
                    }
                }
                
                if (isset($update)) {
                    if ($update === true) {
                        return 'updated';
                    }
                }
            } 
		}
		
	return $errors;
}

function compose_mail($post)
{
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($subject)) {
		$subject = sanitize($subject);
	} else {
		$err_flag = true;
		$errors['subject'] = 'Enter Your subject.';
	}

	if (!empty($message)) {
		$message = sanitize($message);
	} else {
		$err_flag = true;
		$errors['message'] = 'Enter Your message.';
	}
	
	if ($err_flag === false) {
		$sql = "SELECT subscribers_email FROM newsletter";
		$result = execute_select($sql);
		if($result){
			if(count($result) === count($result, COUNT_RECURSIVE)){ 
				extract($result);
				$name = 'Hello dear';
				$body = get_email_template2('./email_template3.php',$subject, $message);
				$response = send_mail($subscribers_email, $name, $subject, $body);
				if ($response) {
						return true;
				}else{
				  $errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, Ensure you have a good internet connection and  try again. ";
				  return $errors;
				}
			 }else{
				  
			  foreach($result as $mail){
				extract($mail);
				$name = 'Hello dear';
				$subject = ucfirst($subject);
				$message = ucfirst($message);
				$body = get_email_template2('./email_template3.php',$subject, $message);
				$response = send_mail($subscribers_email, $name, $subject, $body);
			  }
			  if ($response) {
				return true;
				}else{
					$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, Ensure you have a good internet connection and try again. ";
					return $errors;
				}
			} 
	  
		} else {
			$errors['mail'] = 'Mail(s) could not be fetched.';
		}

	} return $errors;
	
}

function verify_user($firstname, $email, $lastname,$category)
{

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($VerifyUser === 'deactivated') {
	  $errors['VerifyUser_operation'] = 'This Operation is not available to You, port 587 blocked';
	  return $errors;
	}

		$subject = "Welcome to EBSU Staff Secondary School";
		$token = sha1(uniqid());
		$body =  get_email_template('./email_template.php', $firstname, $email, $category, $token);
		$fullname = $firstname . " " . $lastname;
		if(!check_duplicate('reg_confirm', 'email', $email)){
			$response = send_mail($email, $fullname, $subject, $body);
			if ($response) {
				if (save_token($email, $token)) {
					return true;
				}
			}else{
				$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " ."<br> "."Ensure you have a good internet connection  and  try again.";
				return $errors;
			}
	}else {
		$err_flag = true;
		$errors['dup_email'] = 'Email already sent to this mail earlier, check your mail for verification.';
		return $errors;
	}	
}

function fetch_all_students_pin_number(){
	$sql = "SELECT students.`student_id`, `reg_no`, `firstname`, `lastname`, `surname`, `class`, `fees_paid`, `serial_no`, `pin`, classroom.classroom_name FROM `students` INNER JOIN classroom ON students.class = classroom.classroom_id WHERE students.pin != 'NULL' AND students.pin != '' ORDER BY classroom.classroom_id ASC"; 
	$result = execute_select($sql);

   if ($result) {
   return $result;
   } return false;
}

function  update_student_password($post, $stud_id){
	$category = "students";
	$err_flag = false;
	$errors = [];

	$operation = fetch_column7('all_operations');
	extract($operation);
	if ($SignUp === 'deactivated') {
		$err_flag = true;
		$errors['signup_operation'] = 'This Operation is not available to You, port 587 blocked';
		return $errors;
	}

	extract($post);


	if (!empty($student_password)) {
		$student_password = sanitize($student_password);
	} else {
		$err_flag = true;
		$errors['student_password'] = 'Enter a password.';
	}


	if (!empty($student_password2)) {
		$student_password2 = sanitize($student_password2);
	} else {
		$err_flag = true;
		$errors['student_password2'] = 'Confirm Your password.';
	}


	if (isset($student_password) AND isset($student_password2)) {
		if ($student_password == $student_password2) {
			$password = sha1($student_password);
		} else {
			$err_flag = true;
			$errors['password_mismatch'] = 'Password do not match.';
		}
	}


	if ($err_flag === false) {
		$sql1 = "UPDATE students SET password = '$password' WHERE student_id = '$stud_id'";
		if (execute_iud($sql1)) {
					return true;
			}		
		} else {
			$errors['DB'] = 'password not changed successfully.';
			return $errors;
		}
	return $errors;	
}
?>