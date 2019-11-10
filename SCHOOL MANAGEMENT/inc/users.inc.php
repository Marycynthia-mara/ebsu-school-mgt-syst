<?php  
session_start();
require_once 'config.inc.php';
require_once './mail-function.inc.php';
// require_once './mail-function2.inc.php';


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

	if (!empty($student_email)) {
		$email_tmp_studt = sanitize_email($student_email);
		if ($email_tmp_studt) {
			if (!check_duplicate('students', 'email', $email_tmp_studt)) {
				$student_email = $email_tmp_studt;
			} else {
				$err_flag = true;
				$errors['dup_email_studt'] = 'Email have already been used.';
			}
		} else {
			$err_flag = true;
			$errors['student_email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = true;
		$errors['student_email'] = 'Enter Your Email.';
	}


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

	if (!empty($country)) {
		$country = sanitize($country);
	} else {
		$err_flag = true;
		$errors['country'] = 'Enter Your Country.';
	}

	if (!empty($state)) {
		$state = sanitize($state);
	} else {
		$err_flag = true;
		$errors['state'] = 'Enter Your State.';
	}

	if (!empty($LGA)) {
		$LGA = sanitize($LGA);
	} else {
		$err_flag = true;
		$errors['LGA'] = 'Enter Your LGA.';
	}

	if (!empty($home_town)) {
		$home_town = sanitize($home_town);
	} else {
		$err_flag = true;
		$errors['home_town'] = 'Enter Your home_town.';
	}

	if (!empty($Sphone_no)) {
		if (preg_match('/^(090||080||081||070)[1234567890]{8}$/', $Sphone_no)) {
			$Sphone_no = sanitize($Sphone_no);
		}else{
			$err_flag = true;
			$errors['invalid_Stel'] = "Enter a valid student's phone no.";
		}	
	} else {
		// $err_flag = false;
		// $errors['Sphone_no'] = "Enter student's phone no.";
	}

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

	if (!empty($fullname)) {
		$fullname = sanitize($fullname);
	} else {
		$err_flag = true;
		$errors['fullname'] = "Enter parent's Fullname.";
	}

	if (!empty($parent_email)) {
		$parent_email = sanitize($parent_email);
	} else {
		// $err_flag = false;
		// $errors['parent_email'] = "Enter parent's Fullname.";
	}

	if ($err_flag === false) {
		$sql1 = "INSERT INTO students (firstname, lastname, surname, reg_no, class, email, password, gender, birth_date, address, country, state, LGA, home_town, phone_no,parent_phone,parent_fullname,parent_email) VALUES ('$Sfirstname','$Slastname','$Ssurname','$reg_no','$student_class','$student_email','$password','$gender','$birth_date','$student_address','$country','$state','$LGA','$home_town','$Sphone_no','$Pphone_no','$fullname','$parent_email')";

		if (execute_iud($sql1)) {
			$subject = "Welcome to EBSU Staff Secondary School";
			$token = sha1(uniqid());
			$body = get_email_template('./email_template.php', $Sfirstname, $student_email, $category, $token);
			$fullname = $Sfirstname . " " . $Slastname;
			$response = send_mail($student_email, $fullname, $subject, $body);
			if ($response) {
				if (save_token($student_email, $token)) {
					return true;
				}
			}else{
				$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " ."<br> "."Ensure you have a good internet connection  and  try again. ". "<br> "."ensure you update your email and verify your account later";
				return $errors;
			}
		
		} else {
			$errors['DB'] = 'Sign up not successful.';
			return $errors;
		}
	}
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
		$form_class = sanitize($form_class);
	} else {
		$err_flag = true;
		$errors['form_class'] = 'Choose Your Form Class.';
	}

	if (!empty($subject_teaching)) {
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
				$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " ."<br> "."Ensure you have a good internet connection  and  try again. ". "<br> "."ensure you update your email and verify your account later";
				return $errors;
			}
		
		} else {
			$errors['DB'] = 'Sign up not successful.';
			return $errors;
		}
	}
	return $errors;
}

function fetch_column3($table, $Order){
	$sql = "SELECT * FROM $table ORDER BY $Order ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
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

function forgot_password($post){
	$err_flag = false;
	$errors = [];

	extract($post);
	if (!empty($user_logger)) {
		$user_logger = sanitize($user_logger);
	} else{
		$err_flag = true;
		$errors['user_logger'] = "Enter Your username/Reg-no";
	}


	if (!empty($email)) {
		$email_tmp = sanitize_email($email);
		if($email_tmp){
			$email = $email_tmp;
		}else{
			$errors['invalid_email'] = "Enter a valid email";
		}
	} else {
		$err_flag = true;
		$errors['email'] = "Enter Your email";
	}

	if (!empty($login_category)) {
		$login_category = sanitize($login_category);
	} else{
		$err_flag = true;
		$errors['login_category'] = "Choose Category";
	}
	if ($err_flag === false) {
		if ($login_category == 'student') {
			$sql = "SELECT * FROM students WHERE email = '$email' AND reg_no = '$user_logger'";
		}

		if ($login_category == 'staff') {
			$sql = "SELECT email, username FROM teachers WHERE email = '$email' AND username = '$user_logger'";
		}

		if ($login_category == 'admin') {
			$sql = "SELECT email, username FROM administrators WHERE email = '$email' AND username = '$user_logger'";
		}
		$result = execute_select($sql);

		if ($result) {
			if ($login_category == 'student') {


				if( ($result['status'] === '1')){
					$msg1 = true;
				}else {
					$errors['authentication'] = "You have not yet verified your account";
				}

				if(($result['fees_paid'] === 'true')){
					$msg2 = true;
				}else {
					$errors['fees_paid'] = "You have not Paid your school fees";
				}

				if( (isset($msg1)) AND (isset($msg2))){
					$category = 'students';
					$token = sha1(uniqid());
					$subject = "You Requested a change of password";
					$body =  $body = get_email_template4('email_template4.php', $user_logger, $email, $token,$category);
					$response = send_mail($email, 'Hello', $subject, $body);
					
					if($response){
						if (save_token2($email, $token)) {
							return true;
						}
					}
					$errors['mailNotSent'] = 'Something went wrong, mail not sent, try again';
					return $errors;
				}
				
				if( (isset($errors['authentication'])) or (isset($errors['fees_paid']))){
					return $errors;
				}

			}

			if ($login_category == 'staff') {
				$category = 'teachers';
				$token = sha1(uniqid());
				$subject = "You Requested a change of password";
				$body =  $body = get_email_template4('email_template4.php', $user_logger, $email, $token,$category);
				$response = send_mail($email, 'Hello', $subject, $body);
				
				if($response){
					if (save_token2($email, $token)) {
						return true;
					}
				}
				$errors['mailNotSent'] = 'Something went wrong, mail not sent, try again';
				return $errors;
			}

			if ($login_category == 'admin') {
				$category = 'administrators';
				$token = sha1(uniqid());
				$subject = "You Requested a change of password";
				$body =  $body = get_email_template4('email_template4.php', $user_logger, $email, $token,$category);
				$response = send_mail($email, 'Hello', $subject, $body);
				
				if($response){
					if (save_token2($email, $token)) {
						return true;
					}
				}
				$errors['mailNotSent'] = 'Something went wrong, mail not sent, try again';
				return $errors;
			}
			
		} else {
			$errors[] = "Incorrect details entered";
		}
	}
	return $errors;
}

function Reset_password($post, $category, $email, $logger){
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
	if ($category == 'students') {
		$sql = "UPDATE $category SET password = '$password' WHERE reg_no = '$logger' AND email = '$email'";
	}else{
		$sql = "UPDATE $category SET password = '$password' WHERE username = '$logger' AND email = '$email'";
	}

		$result = execute_iud($sql);
		if($result){
			echo "<script>alert('Password Reset Successful');</script>";
			redirect_to('signin.php');
		}else {
			$errors['psw'] = 'Password not sucessfully updated.';
		}
		
	}return $errors;
}

function fetch_column($column, $table){
	$sql = "SELECT * FROM $table";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function add_newsletter_email($post)
{
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($newsletter_email)) {
		$email_tmp = sanitize_email($newsletter_email);
		if ($email_tmp) {
			if (!check_duplicate('newsletter', 'subscribers_email', $email_tmp)) {
				$newsletter_email = $email_tmp;
			} else {
				$err_flag = true;
				$errors['dup_email'] = 'This email already suscribed to our newsletter.';
			}
		} else {
			$err_flag = true;
			$errors['email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = true;
		$errors['email'] = 'Enter Your Email.';

	}
	
	if ($err_flag === false) {
		$sql = "INSERT INTO newsletter (subscribers_email) VALUES ('$newsletter_email')";

		$subject = "Subscription to our newsletter";
		$body = get_email_template3('./email_template2.php', $newsletter_email, $subject);
		$fullname ='Welcome dear, ';
		$response = send_mail($newsletter_email, $fullname, $subject, $body);
		if ($response) {
			if (execute_iud($sql)) {
				return true;
			} else {
				$errors['DB'] = 'Sign up not successful.';
			}	
		}else{
			$errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " . "<br> "." Ensure you have a good internet connection and try again. " ;
		  return $errors;
		}

	} return $errors;
	
}

function send_us_a_mail($post)
{
	$err_flag = false;
	$errors = [];

	extract($post);

	if (!empty($Email)) {
		$email_tmp = sanitize_email($Email);
		if ($email_tmp) {
			$Email = $email_tmp;
		} else {
			$err_flag = true;
			$errors['email_sanitize'] = 'Enter a valid Email address.';
		}
	} else {
		$err_flag = true;
		$errors['email'] = 'Enter Your Email.';

	}

	if (!empty($Name)) {
		$Name = sanitize($Name);
	} else {
		$err_flag = true;
		$errors['Name'] = 'Enter Your Fullname.';
	}

	if (!empty($Subject)) {
		$Subject = sanitize($Subject);
	} else {
		$err_flag = true;
		$errors['Subject'] = 'Enter Your Subject.';
	}

	if (!empty($Message)) {
		$Message = sanitize($Message);
	} else {
		$err_flag = true;
		$errors['Message'] = 'Enter Your Message.';
	}
	
	if ($err_flag === false) {
		$sql = "INSERT INTO contact (contact_email,contact_name,contact_body,contact_subject) VALUES ('$Email','$Name','$Message','$Subject')";

		$email = $Email;
		$subject = "Thanks you for contacting us";
		$Subject = ucfirst($Subject);
		$Message = ucfirst($Message);
		$body = get_email_template2('./email_template3.php', $Name, $Email, $Subject, $Message);
		$response = send_mail("ebsustaffschoolcontact@gmail.com", $Name, $Subject, $body);
		if ($response) {
			if (execute_iud($sql)) {
				return true;
			} else {
				$errors['DB'] = 'Insert not successful.';
			}	
		}else{
		  $errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " . "<br> "." Ensure you have a good internet connection and try again. " ;
		  return $errors;
		}

	} return $errors;
	
}

function fetch_all_students_pin_number(){
	$sql = "SELECT students.`student_id`, `reg_no`, `firstname`, `lastname`, `surname`, `class`, `fees_paid`, `pin`, classroom.classroom_name FROM `students` INNER JOIN classroom ON students.class = classroom.classroom_id WHERE students.pin != 'NULL' ORDER BY classroom.classroom_id ASC"; 
	$result = execute_select($sql);

   if ($result) {
   return $result;
   } return false;
 }

?>