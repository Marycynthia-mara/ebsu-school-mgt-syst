<?php 
$pageTitle = "Add Student";
 
require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php';
?>

<?php 
if (isset($_POST['submit'])) {
    $result = add_student($_POST);

   extract($_POST);
    if ($result === true) {
        $msg = true;
    } else {
        $errors = $result;
?>
			<?php if ($errors) { ?>
        <script>
            var sweetAlert = <?php echo json_encode($errors); ?>;
            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'SIGN UP NOT SUCCESSFUL.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
            var i;
            var timer = 0;
            for(i in sweetAlert){
                sweetAlert[i] = '<p style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</p>';
            allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
            timer += + 3;
            }

    function notifyWithToast(type, message, timer) {
        var duration = timer * 3000;
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: true,
            timer: duration
        });

        Toast.fire({
            type: type,
            // title: 'Something went wrong',
            html: '<p>' + message + '</p>'
        })
    }
    notifyWithToast('error', allAlerts, timer);
</script> 


<?php } ?>
<?php
    }
} ?>


<?php if ( isset($msg
	)): ?>
	<script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', 'Sign Up successful');
</script> 
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	 <div class="section-wrapper mg-t-20">
          <label class="section-title">Students Sign Up Form</label>
          <p class="mg-b-20 mg-sm-b-40">Note all the fields marked with <span class="tx-danger">*</span> are required.</p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4 <?php if (isset($errors['Sfirstname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group">
                  <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" value="<?php if (isset($Sfirstname)) {
									              echo $Sfirstname;
									          } ?>" name="Sfirstname" placeholder="Enter firstname">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Slastname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" name="Slastname" value="<?php if (isset($Slastname)) {
									              echo $Slastname;
									          } ?>" placeholder="Enter lastname">
                </div>   
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Ssurname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Surname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" name="Ssurname" value="<?php if (isset($Ssurname)) {
									              echo $Ssurname;
									          } ?>" placeholder="Enter Surname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['reg_no'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Reg No: <span class="tx-danger">*</span></label>
                  <input class="form-control " value="<?php if (isset($reg_no)) {
									              echo $reg_no;
									          } ?>" type="text" name="reg_no" placeholder="Enter Reg No">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['student_password'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="student_password" value="<?php if (isset($student_password)) {
									              echo $student_password;
									          } ?>" placeholder="Enter Password">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['student_password2'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Confirm Password : <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="student_password2" value="<?php if (isset($student_password2)) {
									              echo $student_password2;
									          } ?>" placeholder="Confirm Password">
                </div>
              </div><!-- col-4 -->
              <!-- <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['student_email']) OR isset($errors['dup_email_studt']) OR isset($errors['student_email_sanitize'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Student's Email :</label>
                  <input class="form-control " type="email" value="<?php if (isset($student_email)) {
									              echo $student_email;
									          } ?>" name="student_email" placeholder="Student's Email">
                </div>
              </div> -->
              <!-- col-4 -->
              <div class="col-md-4 <?php if (isset($errors['student_class'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Select Class :<span class="tx-danger">*</span></label>
                  <?php $classes = fetch_column2('classroom_name', 'classroom', 'status', 'true');  ?>
                  <select id="select2-a" class="form-control " name="student_class" data-placeholder="Select Class">
                    <option disabled="" selected=""> choose...</option>
												<?php foreach ($classes as $class) { ?>
														<option   class=""  value="<?php echo $class['classroom_id'] ?>"><?php echo $class['classroom_name'] .' '. $class['academic_year'];	 ?></option>
											<?php } ?>	
                  </select>
                </div>
              </div><!-- col-4 -->
            	 <div class="col-md-4 mg-t--1 mg-md-t-0 gender <?php if (isset($errors['gender'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Gender :<span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="form-check">
					<div class="gender" style="float: left;">
						<input type="radio" name="gender" class="form-check-input" id="Smale" value="male">
						<label class="form-check-label" for="Smale">Male</label>
					</div> 
					<div class="gender" style="float: right;">
						<input type="radio" name="gender" class="form-check-input" id="Sfemale" value="female">
						<label class="form-check-label" for="Sfemale">Female</label>
					</div> 				
				</div>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['birth_date'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Date of Birth : <span class="tx-danger">*</span></label>
                  <input class="form-control birth " value="<?php if (isset($birth_date)) {
									              echo $birth_date;
									          } ?>" type="date" name="birth_date" placeholder="Date of Birth">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-8 <?php if (isset($errors['student_address'])) {
								                echo "error";
								          } ?>">
                <div class="form-group bd-t-0-force">
                  <label class="form-control-label">Student's Address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="student_address" value="<?php if (isset($student_address)) {
									              echo $student_address;
									          } ?>" placeholder="* Student's address">
                </div>
              </div><!-- col-8 -->
              <!-- <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['country'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Country : <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" value="<?php if (isset($country)) {
									              echo $country;
									          } ?>" name="country" placeholder="Student's Country">
                </div>
              </div> -->
              <!-- col-4 -->
              <!-- <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['state'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">State : <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="state" value="<?php if (isset($state)) {
									              echo $state;
									          } ?>" placeholder="*Student's State">
                </div>
              </div> -->
              <!-- col-4 -->
              <!-- <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['LGA'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">LGA : <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" value="<?php if (isset($LGA)) {
									              echo $LGA;
									          } ?>" name="LGA" placeholder="Student's LGA">
                </div>
              </div> -->
              <!-- col-4 -->
              <!-- <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['home_town'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Home Town : <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="home_town" value="<?php if (isset($home_town)) {
									              echo $home_town;
									          } ?>" placeholder="Student's Home Town">
                </div>
              </div> -->
              <!-- col-4 -->
              <!-- <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Sphone_no'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Student's Tel : </label>
                  <input class="form-control tel" type="number" name="Sphone_no" value="<?php if (isset($Sphone_no)) {
									              echo $Sphone_no;
									          } ?>" placeholder="Student's Tel">
                </div>
              </div> -->
              <!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Pphone_no'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Parent's Tel : <span class="tx-danger">*</span></label>
                  <input class="form-control tel" type="number" name="Pphone_no" value="<?php if (isset($Pphone_no)) {
									              echo $Pphone_no;
									          } ?>" placeholder="* parent's Tel">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['fullname'])) {
								                echo "error";
								          } ?>">
                <!-- <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Parent's Fullname : <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="fullname" value="<?php if (isset($fullname)) {
									              echo $fullname;
									          } ?>" placeholder="* Parent's Fullname">
                </div>
              </div> -->
              <!-- col-4 -->
              <!-- <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['parent_email'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Parent's Email : </label>
                  <input class="form-control" type="email" name="parent_email" value="<?php if (isset($parent_email)) {
									              echo $parent_email;
									          } ?>" placeholder="Parent's Email">
                </div>
              </div> -->
              <!-- col-4 -->
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0" style="border: none;">
              <a class="btn btn-primary bd-0" href="#content1">Sign Up</a>
            </div><!-- form-group -->

            <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to sign up this student?</p></section><div class="btnn"><input class="btn btn-primary bd-0 popUp" type="submit" name="submit" value="Proceed"><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>              

          </div><!-- form-layout -->
        </div><!-- section-wrapper -->
    </form> 

    <?php require_once 'inc/page-footer.inc.php'; ?>