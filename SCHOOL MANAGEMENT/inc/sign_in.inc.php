<?php 
// require_once 'inc/config.inc.php';

if (isset($_SESSION['user_id'])) {
    redirect_to("admin/dashboard.php");
}

if (isset($_POST['SignIn'])) {
		$result = login_user($_POST);

    if ($result === true) {
        redirect_to('admin/dashboard.php');
    }else {
        $errors = $result;
			foreach ($errors as $error) {
				echo "$error" . "<br>"; 
			}
    }
}
?>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<div class="signin-form profile">

						<div class="login-m_page_img">

							<img src="images/model.jpg" alt=" " class="img-responsive" />

						</div>
						<div class="login-m_page">
							<h3 class="sign">Sign In</h3>
							<div class="login-form-wthree-agile">
								<form action="#" method="post">
									<input type="text" name="user_logger" placeholder="Reg No / Username">
									<input type="password" name="user_password" placeholder="Password">
									<div class="input-group mb-3 mul-input" >
										<div class="input-group-prepend" >
											<label class="input-group-text" for="users_category_signin">Select category</label>
										</div>
										<select class="custom-select" id="users_category_signin" name="login_category">
											<option disabled="" selected="">choose...</option>
											<option value="student">Student</option>
											<option value="staff">Staff</option>
											<option value="admin">Admin</option>
										</select>
									</div>

									<div class="tp">
										<input type="submit" value="Sign In" id="SignIn" name="SignIn">
									</div>
								</form>

							</div>
							
							<p><a href="#" data-toggle="modal" data-target="#myModal3"> Don't have an account? SignUp here</a></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <script type="text/javascript">
		var SignIn = document.getElementById('SignIn');
		SignIn.addEventListener('click', function(e) {
			e.preventDefault()
		});
		
	</script> -->