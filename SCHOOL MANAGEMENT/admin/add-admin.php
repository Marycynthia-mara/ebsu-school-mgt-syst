<?php 
$pageTitle = "Add Admin";

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
    $result = add_admin($_POST);

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
          <label class="section-title">Admin Sign Up Form</label>
          <p class="mg-b-20 mg-sm-b-40">Note all the fields marked with <span class="tx-danger">*</span> are required.</p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4 <?php if (isset($errors['Afirstname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group">
                  <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" value="<?php if (isset($Afirstname)) {
									              echo $Afirstname;
									          } ?>" name="Afirstname" placeholder="Enter firstname">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Alastname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" name="Alastname" value="<?php if (isset($Alastname)) {
									              echo $Alastname;
									          } ?>" placeholder="Enter lastname">
                </div>   
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Asurname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Surname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" name="Asurname" value="<?php if (isset($Asurname)) {
									              echo $Asurname;
									          } ?>" placeholder="Enter Surname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Astaff_username'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Username : <span class="tx-danger">*</span></label>
                  <input class="form-control " value="<?php if (isset($Astaff_username)) {
									              echo $Astaff_username;
									          } ?>" type="text" name="Astaff_username" placeholder="Enter Username">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Astaff_password'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="Astaff_password" value="<?php if (isset($Astaff_password)) {
									              echo $Astaff_password;
									          } ?>" placeholder="Enter Password">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Astaff_password2'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Confirm Password : <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="Astaff_password2" value="<?php if (isset($Astaff_password2)) {
									              echo $Astaff_password2;
									          } ?>" placeholder="Confirm Password">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['Astaff_email']) OR isset($errors['dup_email_studt']) OR isset($errors['Astaff_email_sanitize'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Email :</label>
                  <input class="form-control " type="email" value="<?php if (isset($Astaff_email)) {
									              echo $Astaff_email;
									          } ?>" name="Astaff_email" placeholder=" Email">
                </div>
              </div><!-- col-4 -->
            	 <div class="col-md-4 mg-t--1 mg-md-t-0 gender <?php if (isset($errors['admin_gender'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Gender :<span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="form-check">
					<div class="gender" style="float: left;">
						<input type="radio" name="admin_gender" class="form-check-input" id="Smale" value="male">
						<label class="form-check-label" for="Smale">Male</label>
					</div> 
					<div class="gender" style="float: right;">
						<input type="radio" name="admin_gender" class="form-check-input" id="Sfemale" value="female">
						<label class="form-check-label" for="Sfemale">Female</label>
					</div> 				
				</div>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['admin_tel'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Enter Phone No : <span class="tx-danger">*</span></label>
                  <input class="form-control tel" type="number" name="admin_tel" value="<?php if (isset($admin_tel)) {
									              echo $admin_tel;
									          } ?>" placeholder="Phone No">
                </div>
              </div><!-- col-4 -->
          </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0" style="border: none;">
            <a class="btn btn-primary bd-0" href="#content1">Sign Up</a>  
            </div><!-- form-group -->

            <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to sign up this Admin?</p></section><div class="btnn"><input class="btn btn-primary bd-0 popUp" type="submit" name="submit" value="Proceed"><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>                                  

          </div><!-- form-layout -->
        </div><!-- section-wrapper -->
    </form> 

    <?php require_once 'inc/page-footer.inc.php'; ?>