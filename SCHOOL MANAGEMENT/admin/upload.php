<?php 
require_once 'inc/config.inc.php';
if (isset($_POST['submit']) && isset($_FILES['profile_img'])) {
$category = $_POST['user_cat'];

if ($category == 'students') {
  $id = "student_id";
}

if ($category == 'teachers') {
  $id = "teachers_id";
 }

if ($category == 'administrators') {
  $id = "admin_id";
}

	$result = upload_profile_image($_FILES['profile_img'], $_POST, $category, $id);
	$user_id = $_POST['userid'];
	$url = "profile.php?user_id=$user_id&category=$category";

	if ($result) {
		redirect_to($url);
	}else{
		$_SESSION['err_msg'] = true;
		redirect_to($url);
	}
}else{
	$_SESSION['err_msg'] = true;
	redirect_to($url);
}
 ?>
