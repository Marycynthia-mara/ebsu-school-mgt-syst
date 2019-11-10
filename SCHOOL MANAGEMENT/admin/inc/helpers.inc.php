<?php  
require_once 'config.inc.php';
function check_duplicate($table, $column, $data){

	$sql = "SELECT $column FROM $table WHERE $column = '$data'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}

function check_duplicate_result($table, $class, $subject, $ACyear, $term){

	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and subject_id_fk = '$subject' and academic_session = '$ACyear' and exam_term = '$term'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}

function check_duplicate_record($table, $class, $subject, $ACyear, $term, $stud_id){
	
		$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and subject_id_fk = '$subject' and academic_session = '$ACyear' and exam_term = '$term' and student_id_fk = '$stud_id'";
	
		$result = execute_select($sql);
	
		if ($result) {
			return true;
		}return false;
}

function check_duplicate_result2($table, $class, $subject, $ACyear){

	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and subject_id_fk = '$subject' and academic_session = '$ACyear'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}

function check_duplicate_record2($table, $class, $subject, $ACyear,$stud_id){
	
		$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and subject_id_fk = '$subject' and academic_session = '$ACyear' and student_id_fk = '$stud_id'";
	
		$result = execute_select($sql);
	
		if ($result) {
			return true;
		}return false;
}

function check_duplicate_result3($table, $class, $student, $ACyear, $term){

	$sql = "SELECT * FROM $table WHERE class = '$class' and student_id_fk = '$student' and academic_year = '$ACyear' and term = '$term'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}

function check_duplicate_class( $data1, $data2, $column1, $column2, $table){
	$sql = "SELECT * FROM $table WHERE $column1 = '$data1' and $column2 = '$data2'";

	$result = execute_select($sql);

	if ($result) {
		return true;
	}return false;
}

function redirect_to($url){
	// $url = urlencode($url);
	// header("Location: $url");
	// exit();
	echo '<script language="javascript">window.location.href="'.$url.'"</script>';
}

function format_date($date){
	$date = date('F j, Y', $date);
	return $date;
}

function userRole($roleValue){
	if ($roleValue == 0) {
		return "Subscriber";
	} else if ($roleValue == 1) {
		return "Editor";
	} return "Administrator";
}

function get_image_path($file){
	$err_flag = false;
	extract($file);
	if ($size > 1022976) {
		$err_flag = true;
		return false;
	}

	$allowed_extensions = ['png', 'jpg', 'jpeg', 'svg', 'gif'];
	$split = explode('/', $type);
	$endofarray = end($split);
	$image_ext = strtolower($endofarray);

	// in_array(needle, haystack)
	if (!in_array($image_ext, $allowed_extensions)) {
	$err_flag = true;
	return false;		
	}

	$file_destn = 'uploads/';
	$image_name = $file_destn. 'ebsu_' .sha1(uniqid()).'.'.$image_ext;

		// move_uploaded_file(filename, destination)
	if (move_uploaded_file($tmp_name, $image_name)) {
		return $image_name;
	}return false;
}

function fetch_column($column, $table){
	$sql = "SELECT * FROM $table ORDER BY classroom_name ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_ACyear($column, $table){
	$sql = "SELECT academic_year FROM $table ORDER BY classroom_name ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column2($column, $table, $column1, $value){
	$sql = "SELECT * FROM $table WHERE $column1 = '$value'  ORDER BY classroom_name ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column4($column, $table, $value){
	$sql = "SELECT * FROM $table WHERE $column = '$value'";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column6($value1, $value2, $value3, $value4){
	$sql = "SELECT * FROM student_attd WHERE student_id_fk = '$value1' and term = '$value2' and academic_year = '$value3' and class = '$value4' ";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column5($data, $table, $column, $user_id){
	$sql = "SELECT $data FROM $table WHERE $column = $user_id";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column3($table, $Order){
	$sql = "SELECT * FROM $table ORDER BY $Order ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column10($table, $Order){
	$sql = "SELECT * FROM $table ORDER BY $Order DESC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column7($table){
	$sql = "SELECT * FROM $table";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_column8($table, $column,  $table1, $value, $post){
	$errors = [];
	extract($post);

	if(($pin_code != '' && $pin_code != NULL) && ($serial_no != '' && $serial_no != NULL)){
		$sql = "SELECT * FROM $table WHERE pin_code = '$pin_code' AND serial_number = '$serial_no'";
		$result = execute_select($sql);

		if ($result) {
			
					$sql = "SELECT * FROM $table1 WHERE pin = '$pin_code' AND serial_no = '$serial_no' AND NOT student_id = '$value'";
					$result = execute_select($sql);
					if ($result) {
						$errors['used_details'] = "The serial number and pin already Belongs to another student";
						return $errors;
					}else{
						global $conn;
						$pin_code = sanitize($pin_code);
						$serial_no = sanitize($serial_no);
						$_SESSION['pin_code'] = $pin_code;
						$_SESSION['serial_number'] = $serial_no;
						$sql = "UPDATE $table1 SET pin = '$pin_code', serial_no = '$serial_no' WHERE $column = '$value'";
						// var_dump($sql);
						// die(mysqli_error($conn, $sql));
						$result = execute_iud($sql);
						if ($result) {
							redirect_to('select_class_result_term.php');
						}else{
							$errors['pin_update'] = "The serial number and pin already identfied with student";
							// return $errors;
							redirect_to('select_class_result_term.php');
						}
					}
				}else{
					$errors['no_record'] = "invalid detail(s) entered";
					return $errors;
				} 

	}else{
		$errors['empty_fields'] = "Ensure You fill out all fields";
		return $errors;
	}
}

function fetch_column11($table, $column,  $table1, $value, $pin_code, $serial_no){
	$errors = [];

	if(($pin_code != '' && $pin_code != NULL) && ($serial_no != '' && $serial_no != NULL)){
		$sql = "SELECT * FROM $table WHERE pin_code = '$pin_code' AND serial_number = '$serial_no'";
		$result = execute_select($sql);

		if ($result) {
			
					$sql = "SELECT * FROM $table1 WHERE pin = '$pin_code' AND serial_no = '$serial_no' AND NOT student_id = '$value'";
					$result = execute_select($sql);
					if ($result) {
						redirect_to('dashboard.php');
						$errors['used_details'] = "The serial number and pin already Belongs to another student";
						return $errors;
					}
				}else{
					redirect_to('dashboard.php');
					$errors['no_record'] = "invalid detail(s) entered";
					return $errors;
				} 

	}else{
		redirect_to('dashboard.php');
		$errors['empty_fields'] = "Ensure You fill out all fields";
		return $errors;
	}
}

function fetch_column9($table, $column1, $value, $Order){
	$sql = "SELECT * FROM $table WHERE $column1 = '$value'  ORDER BY $Order ASC";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_class($class_id, $table){
	$sql = "SELECT * FROM $table WHERE classroom_id =  $class_id";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_subject($subject_id, $table){
	$sql = "SELECT * FROM $table WHERE subject_id =  $subject_id";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_class2($class_id, $table, $column){

	$sql = "SELECT * FROM $table WHERE $column =  '$class_id'";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function fetch_students($class_id, $table, $column){
	$sql = "SELECT * FROM $table WHERE $column =  $class_id";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function getPrevClass($student_id){
	$sql = "SELECT all_classes FROM students WHERE student_id =  $student_id";

	$result = execute_select($sql);
	if ($result) {
		return $result;
	} return false;
}

function update_table($table, $column1, $value, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column1 = '$value' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function update_table2($table, $column, $value, $column1, $value1, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column = '$value', $column1 = '$value1' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function update_table3($table, $column, $value, $column1, $value1, $column3, $value3, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column = '$value', $column1 = '$value1', $column3 = '$value3' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function update_table4($table, $column, $value, $column1, $value1, $column3, $value3, $column4, $value4, $column5, $value5, $column2, $table_id)
{
	$sql = "UPDATE $table SET $column = '$value', $column1 = '$value1', $column3 = '$value3' , $column4 = '$value4' , $column4 = '$value4' , $column5 = '$value5' WHERE $column2 = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function delete_table($table, $column, $table_id)
{

	$sql = "DELETE FROM $table WHERE $column = $table_id";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function delete_all_records($table)
{

	$sql = "DELETE FROM $table";
	$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return false;
	}
}

function find_search_result($post, $table, $column)
{
	extract($post);
	$sql = "SELECT *  FROM $table WHERE $column LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_search_result($post)
{
	extract($post);
	// SELECT students.*, classroom.classroom_name FROM students INNER JOIN classroom ON students.class = classroom.classroom_name WHERE student_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or reg_no LIKE '%$SearchString%' or class LIKE '%$SearchString%'
	$sql = "SELECT * FROM students WHERE student_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or reg_no LIKE '%$SearchString%' or class LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_search_result2($post)
{
	extract($post);
	$sql = "SELECT * FROM teachers WHERE teachers_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or gender LIKE '%$SearchString%' or username LIKE '%$SearchString%' or form_class LIKE '%$SearchString%' or phone LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_search_result3($post)
{
	extract($post);
	$sql = "SELECT * FROM administrators WHERE admin_id LIKE '$SearchString' or firstname LIKE '%$SearchString%' or lastname LIKE '%$SearchString%' or surname LIKE '%$SearchString%' or gender LIKE '%$SearchString%' or username LIKE '%$SearchString%' or phone LIKE '%$SearchString%'";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_limited_user($column, $table, $limit, $offset)
{
	$sql = "SELECT * FROM $table ORDER BY $column ASC limit $limit, $offset";
	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function getTermTotal($Student, $term, $ACyear, $class, $subject){

	$sql = "SELECT total FROM exam_result WHERE student_class_id_fk = '$class' and subject_id_fk = '$subject' and academic_session = '$ACyear' and exam_term = '$term' and student_id_fk = '$Student'";

	$result = execute_select($sql);

	if ($result) {
		return $result;
	}return false;
}

function val_fetch_form($post)
{
	$err_flag = false;
	$errors = [];
	extract($post);
    
    if (!empty($subject)) {
      $_SESSION['Subject'] = $subject;
      
    }else{
    	$err_flag = true;
      $errors['subject'] = 'Choose Subject';
    }

    if (!empty($class)) {
      $_SESSION['Class'] = $class;
    }else{
    	$err_flag = true;
      $errors['class'] = 'Choose Class';
    }

    if (!empty($exam_term)) {
      $_SESSION['exam_term'] = $exam_term;
    }else{
    	$err_flag = true;
      $errors['exam_term'] = 'Choose Term';
    }

    if (!empty($ACyear)) {
      $_SESSION['AC_year'] = $ACyear;
    }else{
    	$err_flag = true;
      $errors['ACyear'] = "Choose academic Year";
    }
   
   if ($err_flag === false) {
   	$term = $_SESSION['Class'];
   	// $academic_YR = %
	//    $sql = "SELECT * FROM students WHERE class =  $term and reg_no LIKE '%$ACyear'";
	   $sql = "SELECT * FROM students WHERE class =  $term";
   	// var_dump($sql);
   	// die();

   		$result = execute_select($sql);

		if ($result) {
			return $result;
		}else{
			return false;
		}
		
   }return $errors;
}

function val_fetch_form2($post)
{
	$err_flag = false;
	$errors = [];
	extract($post);
    

    if (!empty($class)) {
      $_SESSION['Class_comt'] = $class;
    }else{
    	$err_flag = true;
      $errors['class'] = 'Choose Class';
    }

    if (!empty($exam_term)) {
      $_SESSION['exam_term_comt'] = $exam_term;
    }else{
    	$err_flag = true;
      $errors['exam_term'] = 'Choose Term';
    }

    if (!empty($ACyear)) {
      $_SESSION['AC_year_comt'] = $ACyear;
    }else{
    	$err_flag = true;
      $errors['ACyear'] = "Choose academic Year";
    }
   
   if ($err_flag === false) {
   	$stud_cls = $_SESSION['Class_comt'];
   	$sql = "SELECT * FROM students WHERE class =  $stud_cls";

   		$result = execute_select($sql);

		if ($result) {
			return $result;
		}else{
			return false;
		}
		
   }return $errors;
}

function val_fetch_form3($post)
{
	$err_flag = false;
	$errors = [];
	extract($post);
    

    if (!empty($student_attd_pre)) {
      $student_attd_pre = sanitize($student_attd_pre);
    }else{
    	$err_flag = true;
      $errors['student_attd_pre'] = 'Input No of days student was absent';
    }

    if (!empty($student_attd_abs)) {
      $student_attd_abs = sanitize($student_attd_abs);
    }else{
    	$err_flag = true;
      $errors['student_attd_abs'] = 'Input No of days student was absent';
    }

    if (!empty($teachers_comment)) {
      $teachers_comment = sanitize($teachers_comment);
    }else{
    	$err_flag = true;
      $errors['teachers_comment'] = "Comment on this students result";
    }

     if (!empty($teachers_comt_date)) {
      $teachers_comt_date = sanitize($teachers_comt_date);
    }else{
    	$err_flag = true;
      $errors['teachers_comt_date'] = "Enter students comment date";
    }

    if (!empty($position)) {
      $position = sanitize($position);
    }else{
    	$err_flag = true;
      $errors['position'] = "Enter position";
    }
   
   if ($err_flag === false) {

   	$stud_cls = $_SESSION['Class_comt'];
   	$stud_term = $_SESSION['exam_term_comt'];
   	$stud_year = $_SESSION['AC_year_comt'];
   	$stud_id = $_GET['stud_id'];

   	if (!check_duplicate_result3('student_attd', $stud_cls, $stud_id, $stud_year, $stud_term)) {
   		$sql = "INSERT INTO student_attd (student_attd_pre, student_id_fk, student_attd_abs, term, academic_year, class, position, teachers_comment, teachers_comt_date) VALUES ('$student_attd_pre', '$stud_id', '$student_attd_abs', '$stud_term', '$stud_year', '$stud_cls',  '$position',  '$teachers_comment',  '$teachers_comt_date')";


	if (execute_iud($sql)) {
			return true;
		} else {
			$errors['DB'] = true;
		}	
   	}else{
   		
   		$sql = "UPDATE student_attd SET student_attd_pre = '$student_attd_pre', student_id_fk = '$stud_id', student_attd_abs = '$student_attd_abs', term = '$stud_term', academic_year = '$stud_year', class = '$stud_cls', position = '$position', teachers_comment = '$teachers_comment',teachers_comt_date = '$teachers_comt_date' WHERE student_id_fk = $stud_id and term = '$stud_term' and academic_year = '$stud_year' and class = '$stud_cls'";
		$result = execute_iud($sql);
		if ($result > 0) {
			return true;
		}else{
			$errors['dup_record'] = "This student already have a comment";
   			return $errors;
			// return false;
		}
   	}

   	
		
   }return $errors;
}

function val_fetch_form4($post)
{
	$err_flag = false;
	$errors = [];
	extract($post);
    

    if (!empty($student_attd_pre)) {
      $student_attd_pre = sanitize($student_attd_pre);
    }else{
    	$err_flag = true;
      $errors['student_attd_pre'] = 'Input No of days student was absent';
    }

    if (!empty($student_attd_abs)) {
      $student_attd_abs = sanitize($student_attd_abs);
    }else{
    	$err_flag = true;
      $errors['student_attd_abs'] = 'Input No of days student was absent';
    }

    if (!empty($decision)) {
      $decision = sanitize($decision);
    }else{
    	$err_flag = true;
      $errors['decision'] = "make decision for this student";
    }

    if (!empty($teachers_comment)) {
      $teachers_comment = sanitize($teachers_comment);
    }else{
    	$err_flag = true;
      $errors['teachers_comment'] = "Comment on this students result";
    }

     if (!empty($teachers_comt_date)) {
      $teachers_comt_date = sanitize($teachers_comt_date);
    }else{
    	$err_flag = true;
      $errors['teachers_comt_date'] = "Enter students comment date";
    }

    if (!empty($position)) {
      $position = sanitize($position);
    }else{
    	$err_flag = true;
      $errors['position'] = "Enter position";
    }
   
   if ($err_flag === false) {

   	$stud_cls = $_SESSION['Class_comt'];
   	$stud_term = $_SESSION['exam_term_comt'];
   	$stud_year = $_SESSION['AC_year_comt'];
   	$stud_id = $_GET['stud_id'];

   	if (!check_duplicate_result3('student_attd', $stud_cls, $stud_id, $stud_year, $stud_term)) {
   		$sql = "INSERT INTO student_attd (student_attd_pre, student_id_fk, student_attd_abs, term, academic_year, class, position, teachers_comment, teachers_comt_date, decision) VALUES ('$student_attd_pre', '$stud_id', '$student_attd_abs', '$stud_term', '$stud_year', '$stud_cls',  '$position',  '$teachers_comment',  '$teachers_comt_date', '$decision')";


	if (execute_iud($sql)) {
			return true;
		} else {
			$errors['DB'] = true;
		}	
   	}else{
   		
   		$sql = "UPDATE student_attd SET student_attd_pre = '$student_attd_pre', student_id_fk = '$stud_id', student_attd_abs = '$student_attd_abs', term = '$stud_term', academic_year = '$stud_year', class = '$stud_cls', position = '$position', decision = '$decision', teachers_comment = '$teachers_comment',teachers_comt_date = '$teachers_comt_date' WHERE student_id_fk = $stud_id and term = '$stud_term' and academic_year = '$stud_year' and class = '$stud_cls'";
		$result = execute_iud($sql);
		if ($result > 0) {
			return true;
		}else{
			$errors['dup_record'] = "This student already have a comment";
   			return $errors;
			// return false;
		}
   	}

   	
		
   }return $errors;
}

function val_fetch_form5($post)
{
	$err_flag = false;
	$errors = [];
	extract($post);
    

    if (!empty($p_comm)) {
      $p_comm = sanitize($p_comm);
    }else{
    	$err_flag = true;
      $errors['p_comm'] = "Principal's comment required";
    }

    if (!empty($p_comm_date)) {
      $p_comm_date = sanitize($p_comm_date);
    }else{
    	$err_flag = true;
      $errors['p_comm_date'] = "Principal's comment date required";
    }
   
   if ($err_flag === false) {

   	$stud_cls = $_SESSION['Class_comt'];
   	$stud_term = $_SESSION['exam_term_comt'];
   	$stud_year = $_SESSION['AC_year_comt'];
   	$stud_id = $_GET['stud_id'];

   	if (!check_duplicate_result3('student_attd', $stud_cls, $stud_id, $stud_year, $stud_term)) {
   		$sql = "INSERT INTO student_attd (principals_comment, principals_comt_date) VALUES ('$p_comm', '$p_comm_date')";


	if (execute_iud($sql)) {
			return true;
		} else {
			$errors['DB'] = true;
		}	
   	}else{
   		
   		$sql = "UPDATE student_attd SET principals_comment = '$p_comm', principals_comt_date = '$p_comm_date' WHERE student_id_fk = $stud_id and term = '$stud_term' and academic_year = '$stud_year' and class = '$stud_cls'";
		$result = execute_iud($sql);
		if ($result > 0) {
			return true;
		}else{
			$errors['dup_record'] = "This student already have Principal's comment";
   			return $errors;
			// return false;
		}
   	}

   	
		
   }return $errors;
}

function get_total($table, $column)
{
		$sql = "SELECT $column FROM $table";
		$results = execute_select($sql);
		$counter = 0;
		if ($results) {
			foreach ($results as $result) {
				$counter += 1;
			}return $counter;
		}else{
			echo "no";
			return false;
		}
}

function fetch_stud_result($table, $class, $term, $year)
{
	
	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and exam_term = '$term' and academic_session = '$year'";
		
	$result = execute_select($sql);
	
	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_stud_result3($table, $class, $term, $year, $user_id)
{
	
	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and exam_term = '$term' and academic_session = '$year' and student_id_fk  = '$user_id'";
		
	$result = execute_select($sql);
	
	if ($result) {
		return $result;
	}else{
		return false;
	}
}


function get_subjectscore($table, $curr_subject, $class, $term, $year, $user_id)
{
	
	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and exam_term = '$term' and subject_id_fk = '$curr_subject' and academic_session = '$year' and student_id_fk  = '$user_id'";
		
	$result = execute_select($sql);
	
	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function get_subjectscore2($table, $curr_subject, $class, $year, $user_id)
{
	
	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and subject_id_fk = '$curr_subject' and academic_session = '$year' and student_id_fk  = '$user_id'";
		
	$result = execute_select($sql);
	
	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_stud_result2($table, $class, $year)
{
	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and  academic_session = '$year'";

	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fetch_stud_result4($table, $class, $year, $user_id)
{
	$sql = "SELECT * FROM $table WHERE student_class_id_fk = '$class' and  academic_session = '$year' and student_id_fk  = '$user_id'";

	$result = execute_select($sql);

	if ($result) {
		return $result;
	}else{
		return false;
	}
}

function fixLast($positionArray){
    $length = count($positionArray) -1;
    $count = 0;
    $i = $length;
    while($positionArray[$i]->position == $positionArray[--$i]->position){
        $count++;
    }

    for($i = 0; $i <= $count; $i++){
        $positionArray[$length - $i]->position = $positionArray[$length - $i]->position + $count;
    }
    return $positionArray;
}

function makeStudent($pos, $score,$student_id){
    $studentPosition = new stdClass();
    $studentPosition->position = $pos;
    $studentPosition->score = $score;
    $studentPosition->id = $student_id;

    return $studentPosition;
}

function add_post($post_array, $file_array = null)
{
	$error_flag = false;
	$errors = [];

	extract($post_array);

	if (!empty($title)) {
		$title = sanitize($title);
	}else{
		$error_flag = true;
		$errors['title'] = "Event title required";
	}

	if (!empty($body)) {
		$body = sanitize($body);
	}else{
		$error_flag = true;
		$errors['post'] = "Event body cannot be empty";
	}

	if ($file_array['name'] != "") {
		$image_path = get_image_path($file_array);
		if ($image_path === false) {
			$error_flag = true;
			$errors['file_size'] = "File size of selected image might be too large";
			$errors['file_ext'] = "File extension of selected image might not be supported";
		}
	}else{
		$image_path = null;
	}

	if ($error_flag === false) {
		$post_date = time();
		$sql = "INSERT INTO events (event_title, event_desc, event_image) VALUES ('$title', '$body', '$image_path')";

		$result = execute_iud($sql);

		if ($result) {
		 	return true;
		 } 
	} return $errors;
}

function update_post($post_array, $file_array = null)
{
	$error_flag = false;
	$errors = [];

	extract($post_array);

	if (!empty($title)) {
		$title = sanitize($title);
	}else{
		$error_flag = true;
		$errors['title'] = "Event title required";
	}

	if (!empty($body)) {
		$body = sanitize($body);
	}else{
		$error_flag = true;
		$errors['post'] = "Event body cannot be empty";
	}

	if ($file_array['name'] != "") {
		$image_path = get_image_path($file_array);
		if ($image_path === false) {
			$error_flag = true;
			$errors['file_size'] = "File size of selected image might be too large";
			$errors['file_ext'] = "File extension of selected image might not be supported";
		}
	}else{
		$image_path = null;
	}

	if ($error_flag === false) {
		$post_date = time();
		$event_id = $_SESSION['event_id'];

		if ($file_array['name'] != "") {
			$sql = "UPDATE events SET event_title = '$title', event_desc = '$body', event_image = '$image_path' WHERE event_id = $event_id";
		}else{
			$sql = "UPDATE events SET event_title = '$title', event_desc = '$body' WHERE event_id = $event_id";
		}
		
		$result = execute_iud($sql);
	if ($result > 0) {
		return true;
	}else{
		return $errors;
	}
 }
}

function get_email_template($file_path, $name, $email, $category, $token){
	$body = file_get_contents($file_path);
	$body = str_replace('#firstname#', $name, $body);
	$body = str_replace("#email#", $email, $body);
	$body = str_replace("#category#", $category, $body);
	$body = str_replace("#token#", $token, $body);
	return $body;
}

function get_email_template2($file_path, $subject, $message){
	$body = file_get_contents($file_path);
	$body = str_replace("#Subject#", $subject, $body);
	$body = str_replace("#Message#", $message, $body);
	return $body;
}


function save_token($email, $token){
	global $conn;
	$sql = "INSERT INTO  reg_confirm (token, email) VALUES ('$token', '$email')";
	$query = mysqli_query($conn, $sql);
	if ($query) {
	return true;
	}return false;
}


function generate_pin($no_of_pins){
	$result = false;
	$no_of_pins = intval($no_of_pins);
	for ($x = 0; $x < $no_of_pins; $x++) {
		$rand1 = rand(1000000, 9999999); 
		$rand2 = rand(1000000, 9999999);
		$pin = $rand1.$rand2;
		$serial_no  = FLOOR(RAND(100000, 999999));
		// uniqid(rand(0,100));

		if(check_duplicate('all_pin_code', 'pin_code', $pin) || check_duplicate('all_pin_code', 'serial_number', $serial_no)){
			$x-=1; 
		}else{
		$sql = "INSERT INTO all_pin_code (pin_code, serial_number) VALUES ('$pin', '$serial_no')";
		$result = execute_iud($sql);
		
		}
	}

	if($result){
		return true;
	}else{
		return false;
	}
}