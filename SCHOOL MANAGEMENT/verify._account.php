<?php 
require_once 'inc/config.inc.php';

	if (isset($_GET['email']) && isset($_GET['token']) && isset($_GET['category'])) {
		if (preg_match('/[a-z0-9_.]+@[a-z0-9]+\.[a-z]{2,6}/i', $_GET["email"])) {
			$email = sanitize_email($_GET['email']);
			$token = sanitize($_GET['token']);
			$category = sanitize($_GET['category']);

			$sql = "SELECT * FROM reg_confirm WHERE email = '$email' AND token = '$token'";
			$result = execute_select($sql);
			if ($result) {
				$sql = "UPDATE $category SET status = true WHERE email = '$email'";
				$result = execute_iud($sql);
				if($result){
					echo "<script>alert('Account Activated Successfully')</script>";
					redirect_to('signin.php');
				}else{
					echo "<script>alert('Account Already activated')</script>";
					redirect_to('signin.php');
				}
				
			}else{
				redirect_to('error_page.php');
			}
		}else{
			redirect_to('error_page.php');
		}
	}else{
			redirect_to('error_page.php');
		}
 ?>