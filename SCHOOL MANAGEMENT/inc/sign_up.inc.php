<?php 
// require_once 'config.inc.php';

if (isset($_POST['submit_student'])) {
    $result = add_student($_POST);

   extract($_POST);
    if ($result === true) {
        $msg = true;
    } else {
        $errors = $result;
			foreach ($errors as $error) {
				echo "$error" . "<br>"; 
			}

			echo "<script>
			notifyWithToast('error', allAlerts);
			</script>";
    }
}


if (isset($_POST['submit_staff'])) {
    $result = add_staff($_POST);

   extract($_POST);
    if ($result === true) {
        $msg = true;
    } else {
        $errors = $result;
        foreach ($errors as $error) {
				echo "$error" . "<br>"; 
			}

			echo "<script>
			notifyWithToast('error', allAlerts);
			</script>";
    }
}

 ?>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog">
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
							<h3 class="sign">Sign Up</h3>
							<div class="login-form-wthree-agile">
								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
									<div class="input-group mb-3 mul-input" >
										<div class="input-group-prepend" >
											<label class="input-group-text" for="users_category_signup">Select category</label>
										</div>
										<select class="custom-select" id="users_category_signup">
											<option disabled="" selected="">choose...</option>
											<option value="student" id="fetchStudents">Student</option>
											<option value="staff" id="fetchTeachers">Staff</option>
										</select>
									</div>
									<div id="imported_form"></div>

									<script>
										var cat_select = document.getElementById('users_category_signup');
										var fetchStudents = document.getElementById('fetchStudents');	
										var fetchTeachers = document.getElementById('fetchTeachers');	

										var imported_form = document.getElementById('imported_form');	

										function fetchForm() {

											if (cat_select.value == "student") {
												var url = 'ajax_fetches/student_signup.php';
											}else{
												var url = 'ajax_fetches/staff_signup.php';
											}
											

											var xhr = new XMLHttpRequest();
											xhr.open('GET', url, true);

											xhr.onreadystatechange = function () {
												if (xhr.readyState == 4 && xhr.status == 200) {
													imported_form.innerHTML = xhr.responseText;
												}
											}
											xhr.send();
										}

										fetchStudents.addEventListener('click', fetchForm);
										fetchTeachers.addEventListener('click', fetchForm);
									</script>

								</form>
							</div>
							
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
    // $(document).ready(function () {
    //     $('#submit').click(function (e) {
    //         e.preventDefault();
    //         if ($('#message').val() != "") {
    //             $.ajax({
    //                 // alert($('#contact_form'))
    //                 type : 'post',
    //                 url :  'proccess-comment.php',
    //                 data : $('#contact_form').serialize(),
    //                 success : function (data) {
    //                     notifyWithToast('success', data);
    //                 }
                    
    //             })
    //             notifyWithToast('error', 'Comment cannot be empty!');
    //         }else{
    //              notifyWithToast('error', 'Comment cannot be empty!');
    //         }
    //     })
    // })


			var sweetAlert = <?php echo json_encode($errors); ?>;
			var allAlerts = "read the below stated issues";
			for (var i = 0; i < sweetAlert.length; i++) {
			allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
	}
			notifyWithToast('error', allAlerts);

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: 'Something went wrong',
            text: message
        })
    }
</script> 

