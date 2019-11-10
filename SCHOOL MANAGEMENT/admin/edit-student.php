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
    $result = update_student($_POST, $stud_id);

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
            position: 'bottom-start',
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
		window.location = 'edit-student.php?stud_id=<?php echo $stud_id?>';
	}, 1000);
</script> 
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?stud_id='."$student_id"; ?>">
	 <div class="section-wrapper mg-t-20">
          <label class="section-title">Students Update page</label>
          <p class="mg-b-20 mg-sm-b-40">Note all the fields marked with <span class="tx-danger">*</span> are required.</p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-4 <?php if (isset($errors['firstname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group">
                  <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" value="<?php if (isset($firstname)) {
									              echo $firstname;
									          } ?>" name="firstname" placeholder="Enter firstname">
                </div>
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['lastname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" name="lastname" value="<?php if (isset($lastname)) {
									              echo $lastname;
									          } ?>" placeholder="Enter lastname">
                </div>   
              </div><!-- col-4 -->

              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['surname'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Surname: <span class="tx-danger">*</span></label>
                  <input class="form-control " type="text" name="surname" value="<?php if (isset($surname)) {
									              echo $surname;
									          } ?>" placeholder="Enter Surname">
                </div>
              </div><!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['reg_no'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Reg No: <span class="tx-danger">*</span></label>
                  <input class="form-control " disabled="" value="<?php if (isset($reg_no)) {
									              echo $reg_no;
									          } ?>" type="text" name="reg_no" placeholder="Enter Reg No">
                </div>
              </div><!-- col-4 -->
              
              <!-- col-4 -->
              <div class="col-md-4 <?php if (isset($errors['student_class'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Select Class :<span class="tx-danger">*</span></label>
                  <?php $classes = fetch_column2('classroom_name', 'classroom', 'status', 'true');  
                  ?>
                  <select id="select2-a" class="form-control " name="student_class" data-placeholder="Select Class">
                    <?php if ($class != ""){ ?>
                      <option value="<?php echo $class ?>" selected=""><?php $cls = fetch_class2($class, 'classroom', 'classroom_id'); echo $cls['classroom_name'].' '. $cls['academic_year'] ?></option>
                    <?php }else{ ?>
                      <option value="" selected="">None</option>
                    <?php } ?>
												<?php foreach ($classes as $class) { ?>
														<option   class=""  value="<?php echo $class['classroom_id'] ?>"><?php echo $class['classroom_name'].' '. $class['academic_year'];	 ?></option>
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
						<input type="radio" name="gender" class="form-check-input" id="Smale" value="male" <?php if ($gender == 'male') { ?>
              checked=""
          <?php  } ?>>
						<label class="form-check-label" for="Smale">Male</label>
					</div> 
					<div class="gender" style="float: right;">
						<input type="radio" name="gender" class="form-check-input" id="Sfemale" value="female" <?php if ($gender == 'female') { ?>
              checked=""
          <?php  } ?>>
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
              <div class="col-md-8 <?php if (isset($errors['address'])) {
								                echo "error";
								          } ?>">
                <div class="form-group bd-t-0-force">
                  <label class="form-control-label">Student's Address: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address" value="<?php if (isset($address)) {
									              echo $address;
									          } ?>" placeholder="* Student's address">
                </div>
              </div><!-- col-8 -->
              
              <!-- col-4 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0 <?php if (isset($errors['parent_phone'])) {
								                echo "error";
								          } ?>">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Parent's Tel : <span class="tx-danger">*</span></label>
                  <input class="form-control tel" type="number" name="parent_phone" value="<?php if (isset($parent_phone)) {
									              echo $parent_phone;
									          } ?>" placeholder="* parent's Tel">
                </div>
              </div><!-- col-4 -->
              
            </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0" style="border: none;">
              <a class="btn btn-primary bd-0" href="#content1">Update</a>
            </div><!-- form-group -->
            
            <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to sign up this Student?</p></section><div class="btnn"><input class="btn btn-primary bd-0 popUp" type="submit" name="edit_stud" value="Proceed"><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>
            
          </div><!-- form-layout -->
        </div><!-- section-wrapper -->
    </form> 

    <?php require_once 'inc/page-footer.inc.php'; ?>