<?php 
$pageTitle = "Update Students";

require_once 'inc/config.inc.php'; 
require_once 'mail-function2.inc.php';

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 
?>

<?php if (!isset($_SESSION['stringsOfStudsIds'])) {
  redirect_to('students-classes.php');
} ?>

<?php 
if (isset($_POST[''])) {
  # code...
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">   
    <div class="section-wrapper mg-t-20">
          <label class="section-title">Updating | Deleting | Fee confirmation of Students Classes</label>
          <p class="mg-b-20 mg-sm-b-40">Updating | Deleting | Fee confirmation of selected student(s).</p>


          <?php $result =  $_SESSION['stringsOfStudsIds']; 
            $counter = 0;
          ?>
           <?php foreach ($result as $student):
            $stud_data = fetch_students($result[$counter], "students", 'student_id');
            extract($stud_data);
            $counter++;
            // the $class in the below function is from extract($stud_data);
            if ($class !== "") {
              if (preg_match('/^\d+[,\d+]+$/', $class)) {
              $class = explode(',', $class);
              $class = array_unique($class);
              $class = end($class);

              $Stud_class = fetch_class($class, 'classroom');
              }else{
                $Stud_class = fetch_class($class, 'classroom');
              }
            }else{
              $Stud_class['classroom_id'] = "";
            }
            
           ?>
            <div class="">
              <!-- d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd pd-x-20 -->
              <div class="d-md-flex pd-y-20 pd-md-y-0" style="margin-bottom: 2px;">
                <input disabled="" type="text" class="form-control" value="<?php echo $reg_no; ?>" style="width: 23%; float: left;">
                <input disabled="" type="text" class="form-control" value="<?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '.ucfirst($surname); ?>" style="width: 50%">
                <?php $classes = fetch_column2('classroom_name', 'classroom', 'status', 'true');  ?>

                <?php if($_SESSION['update_cat'] === "update" or $_SESSION['update_cat'] === "delete"){ ?>
                  <select style="width: 17%; cursor: pointer;" id="select2-a" class="form-control "          name="new_class[]" data-placeholder="Select Class">
                   <?php if ($Stud_class['classroom_id'] != ""){ ?>
                     <option  selected="" value="<?php echo $Stud_class['classroom_id']  ?>"><?php echo $Stud_class['classroom_name'];  ?> </option>
                   <?php }else{ ?>
                   <option  selected="" value="none"><?php echo "none"  ?> </option>
                   <?php } ?>
                         <?php foreach ($classes as $class) { ?>
                             <option   class=""  value="<?php echo $class['classroom_id']  ?>"><?php echo $class['classroom_name'];  ?></option>
                       <?php } ?>  
                   </select>
                 <?php } ?>

                  <?php if($_SESSION['update_cat'] === "paid_fees"){ ?>
                   <select style="width: 17%; cursor: pointer;" id="select2-a" class="form-control "          name="select_confirm[]" data-placeholder="Select Class">
                    
                           <option  <?php if ($fees_paid === "true"){ ?>
                              selected
                             <?php } ?> value="true" >True</option>

                             <option  <?php if ($fees_paid === "false"){ ?>
                              selected
                             <?php } ?> value="false" >False</option>
                    </select>
                  <?php } ?>
                
              </div>
            </div><!-- d-flex -->

           
          <?php endforeach ?>
          <?php if ($_SESSION['update_cat'] == 'update'): ?>
            <a class="btn btn-primary pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0" style="margin-top: 20px;" href="#content1">Update student class</a>
          <?php endif ?>
          

          <?php if ($_SESSION['update_cat'] == "delete"): ?>
            <a class="btn btn-primary pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0" style="margin-top: 20px;" href="#content1">Delete student from this class</a>
          <?php endif ?>

          <?php if ($_SESSION['update_cat'] == "paid_fees"): ?>
            <a class="btn btn-primary pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0" style="margin-top: 20px;" href="#content1">Confirm Student's fees</a>
          <?php endif ?>

          <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to <?php if($_SESSION['update_cat'] == 'update'){echo 'Update student class';}if($_SESSION['update_cat'] == 'delete'){echo 'Delete student from this class';}if($_SESSION['update_cat'] == 'paid_fees'){echo "Confirm Student's fees";}?>?</p></section><div class="btnn"><?php if ($_SESSION['update_cat'] == 'update'): ?>
            <button class="btn btn-primary bd-0" type="submit" name="update_class">Proceed</button>
          <?php endif ?><?php if ($_SESSION['update_cat'] == "delete"): ?>
            <button class="btn btn-primary bd-0" type="submit" name="delete_class">Proceed</button>
          <?php endif ?><?php if ($_SESSION['update_cat'] == "paid_fees"): ?>
            <button class="btn btn-primary bd-0" type="submit" name="confirm_fees">Proceed</button>
          <?php endif ?><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>
          
            <?php 
            $a = "update".$student_id;
            if (isset($_POST["update_class"])) {
              $stud_id_array = $_SESSION['stringsOfStudsIds'];
                $count = count($stud_id_array);
                $counter2 = 0;
              for($i=0;$i<$count;$i++){
                  $prev_classes = getPrevClass($stud_id_array[$counter2]);
                  extract($prev_classes);

                  $upd_class = $all_classes.','.$_POST['new_class'][$counter2];
                  $result = update_table2('students','class', $_POST['new_class'][$counter2], 'all_classes', $upd_class, 'student_id', $stud_id_array[$counter2]);
                    $counter2++;
                  if ($result === true) {
                     $UpdMsg = true;
                  }else{
                    $errors['UpdStud'] = true;
                  }
                }
              
            } 


            if (isset($_POST["delete_class"])) {
              if ($Stud_class['classroom_id'] != "") {
                $stud_id_array = $_SESSION['stringsOfStudsIds'];
                $count = count($stud_id_array);
                $counter2 = 0;
              for($i=0;$i<$count;$i++){
                  $prev_classes = getPrevClass($stud_id_array[$counter2]);
                  extract($prev_classes);
                  
                  $upd_class = $all_classes.','.$_POST['new_class'][$counter2];
                  $result =  update_table('students', 'class', '', 'student_id', "$stud_id_array[$counter2]");
                  // $result = true;
                  $search = ",".$Stud_class['classroom_id'];
                  // echo "<script>confirm('Are you sure you want to make changes')</script>";
                  if ($result === true) {
                    $a = $Stud_class['classroom_id'];
                    $search = ",".$a;
                    if (strpos($all_classes, "$search") !== false) {
                      // echo "yheaaaa ";
                       $all_classes = str_replace($search, "", $all_classes);
                        $result2 = update_table('students', 'all_classes', $all_classes, 'student_id', "$stud_id_array[$counter2]");

                    }else{
                      // echo "yhea ";
                      // $all_classes = $all_classes;
                    }
                    // var_dump($prev_classes[0]);
                    // var_dump($search);
                     $UpdMsg = true;
                  }else{
                    $errors['delStud'] = true;
                    // echo "No"."<br>";
                  }
                  $counter2++;
                }
               
              }else{
                $errors['already_del_stud'] = true;
              }
            } 
            
            
            if (isset($_POST["confirm_fees"])) {
                                
              $operation = fetch_column7('all_operations');
              extract($operation);
              if ($ConfirmFees === 'deactivated') {
                $errors['ConfirmFees_operation'] = true; ?>

                <?php if ( isset($errors['ConfirmFees_operation'])): ?>
                <script>
              
                  function notifyWithToast(type, message) {
                      const Toast = Swal.mixin({
                          toast: true,
                          position: 'bottom-start',
                          showConfirmButton: false,
                          timer: 5000
                      });
              
                      Toast.fire({
                          type: type,
                          title: message,
                      })
                  }
                  notifyWithToast('error', 'This Operation is not available to You, port 587 blocked');
              </script> 
              <?php endif; ?>

              <?php  return;
              }

              $stud_id_array = $_SESSION['stringsOfStudsIds'];
                $count = count($stud_id_array);
                $counter2 = 0;
                $contains_true = [];
              for($i=0;$i<$count;$i++){

                if(isset($_POST['select_confirm'])){

                  // if($_POST['select_confirm'][$counter2] === "true"){

                    $category = 'students';
                    $current_stud = fetch_students($stud_id_array[$counter2], "students", 'student_id');
                    extract($current_stud);
                    // $subject = "Your pin for this term result check";
                    // $token = uniqid(rand(0,100));
                    // $body = get_email_template('./email_template2.php', $firstname, $email, $category, $token);
                    // $fullname = $firstname . " " . $lastname;
                    // $response = send_mail2($email, $fullname, $subject, $body);
                    // if ($response) {
                      // $result = update_table2('students', 'fees_paid', $_POST['select_confirm'][$counter2], 'pin', $token, 'student_id', $stud_id_array[$counter2]);
                      $result = update_table('students', 'fees_paid', $_POST['select_confirm'][$counter2], 'student_id', $stud_id_array[$counter2]);
                      // $contains_true[$counter2] = $_POST['select_confirm'][$counter2];
                    // }else{
                      // $errors['save_token'] = "Ooops!!! Something went wrong. ". "<br> "."Email not sent, ensure email exist " ."<br> "."ensure update your email and verify your account";
                      // return $errors;
                    // }

                  // }else{
                    // $result = update_table('students', 'fees_paid', $_POST['select_confirm'][$counter2], 'student_id', $stud_id_array[$counter2]);
                    // $contains_true[$counter2] = $_POST['select_confirm'][$counter2];
                  // }

                }
                    $counter2++;
                  if ($result) {
                     $UpdMsg = true;
                  }else{
                    $errors['confirm_fees'] = true;
                  }
                }
              
            } 
            
            
            
            ?>

     </div>
</form> 

<?php if ( isset($UpdMsg)): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 5000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', 'update successful');

    setTimeout(function refresh(){
		window.location = 'stud_update.php';
	}, 1000);

</script> 
<?php endif; ?>


<?php if ( isset($errors['UpdStud'])): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 5000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('error', 'Ensure you choose a new class to update to');
</script> 
<?php endif; ?>

<?php if ( isset($errors['delStud'])): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 5000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('error', 'Ensure you choose a new class for delete');
</script> 
<?php endif; ?>


<?php if ( isset($errors['already_del_stud'])): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 5000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('error', 'Student already deleted from this class');
</script> 
<?php endif; ?>

<?php require_once 'inc/page-footer.inc.php'; ?>