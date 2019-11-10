<?php 
$pageTitle = "Edit Student";

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
if (!isset($_GET['stud_id'])) {
  redirect_to('manage-students.php');
}else{
  $stud_id = $_GET['stud_id'];
  $user = fetch_user('students', 'student_id', $stud_id);
  if($user){
    extract($user);
  }else{
    redirect_to('dashboard.php');
  }
}

if (isset($_POST['edit_stud'])) {
    $result = update_student_password($_POST, $stud_id);

   extract($_POST);
    if ($result === true) {
        $msg = true;
    } else {
        $errors = $result;
?>
			<?php if ($errors) { ?>
        <script>
            var sweetAlert = <?php echo json_encode($errors); ?>;
            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'UPDATE NOT SUCCESSFUL.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
            var i;
            var timer = 0;
            for(i in sweetAlert){
                sweetAlert[i] = '<p style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</p>';
            allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
            timer += + 3;
            }

    function notifyWithToast(type, message, timer) {
        var duration = timer * 1000;
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
            position: 'center',
            showConfirmButton: false,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', 'Update successful');
    
    setTimeout(function refresh(){
		window.location = 'manage-students.php';
	}, 2000);
</script> 
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?stud_id='."$student_id"; ?>">
	 <div class="section-wrapper mg-t-20">

          <label class="section-title">Students Password Recovery</label>
          <p class="mg-b-20 mg-sm-b-40">Note all the fields marked with <span class="tx-danger">*</span> are required.</p>
          <h3><?php if (isset($surname) && isset($firstname) && isset($lastname)) { echo $surname.' '. $firstname.' '.$lastname; } ?></h3>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              
               <div class="col-md-6 mg-t--1 mg-md-t-0 <?php if (isset($errors['student_password'])) {
                                echo "error";
                          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="student_password" value="<?php if (isset($student_password)) {
                                echo $student_password;
                            } ?>" placeholder="Enter Password">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-6 mg-t--1 mg-md-t-0 <?php if (isset($errors['student_password2'])) {
                                echo "error";
                          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Confirm Password : <span class="tx-danger">*</span></label>
                  <input class="form-control " type="password" name="student_password2" value="<?php if (isset($student_password2)) {
                                echo $student_password2;
                            } ?>" placeholder="Confirm Password">
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0" style="border: none;">
              <a class="btn btn-primary bd-0" href="#content1">Update password</a>
            </div><!-- form-group -->
            
            <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to update this Students password?</p></section><div class="btnn"><input class="btn btn-primary bd-0 popUp" type="submit" name="edit_stud" value="Proceed"><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>
            
          </div><!-- form-layout -->
        </div><!-- section-wrapper -->
    </form> 

    <?php require_once 'inc/page-footer.inc.php'; ?>