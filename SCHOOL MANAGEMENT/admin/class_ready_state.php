<?php 
$pageTitle = "Class Result Ready State";

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
 if (isset($_POST['FetchClass'])) {
      if (isset($_POST['updateClassroom'])) {
        extract($_POST);
       
       $_SESSION['class_id'] = $updateClassroom;
        $fetched_class = fetch_class($updateClassroom, 'classroom');
        if ($fetched_class == true) {
           $fetchClassMsg = true;
        }else{
          $errors['updateClassroom'] = true;
          // $errors = $result;
        }
       }else{
      $errors['updateClassroom'] = true;
      // $errors = $result;
    }   
}
              if (isset($_POST['UpdClass'])) {

                $operation = fetch_column7('all_operations');
              extract($operation);
              if ($ReadyState === 'deactivated') {
                $errors['ReadyState'] = true; 
              }else{
                  if (isset($_POST['FTRS']) and isset($_POST['STRS']) and isset($_POST['TTRS'])) {
                    extract($_POST); ?>

                    <script>

                      $.ajax({
                            url : 'confrim_action.php',
                            type : 'post',
                            // async : false,
                            data : data,
                            success : function() {
                            result = JSON.parse(data);
                            data1 = result.data1;
                            data2 = result.data2;
                            }
                          })

                    </script>

                  <?php
                  //   $confirm = <script>confirm('Are you sure you want to perform an update')</script>;
                  //   echo $confirm;
                  //   var_dump($confirm);


                  // if($_POST['FTRS'] === "ready"){
                  //   $mails = fetch_column5('email', 'students', 'class', $_SESSION['class_id']);
                  //     if($mails){
                  //       $subject = "Your Result for this term is ready";
                  //       $body =  $body = file_get_contents('email_template4.php');
                  //       foreach ($mails as $mail){
                  //         extract($mail);
                  //         $response = send_mail($email, 'Hello', $subject, $body);
                  //       }
                  //     }  
                  // } 

                  // if($_POST['STRS'] === "ready"){
                  //   $mails = fetch_column5('email', 'students', 'class', $_SESSION['class_id']);
                  //     if($mails){
                  //       $subject = "Your Result for this term is ready";
                  //       $body =  $body = file_get_contents('email_template4.php');
                  //       foreach ($mails as $mail){
                  //         extract($mail);
                  //         $response = send_mail($email, 'Hello', $subject, $body);
                  //       }
                  //     }  
                  // } 

                  // if($_POST['TTRS'] === "ready"){
                  //   $mails = fetch_column5('email', 'students', 'class', $_SESSION['class_id']);
                  //     if($mails){
                  //       $subject = "Your Result for this term is ready";
                  //       $body =  $body = file_get_contents('email_template4.php');
                  //       foreach ($mails as $mail){
                  //         extract($mail);
                  //         $response = send_mail($email, 'Hello', $subject, $body);
                  //       }
                  //     }  
                  // } 
                  
                    $result = update_table3('classroom','first_term_result', $FTRS, 'second_term_result', $STRS,  'third_term_result', $TTRS, 'classroom_id', $_SESSION['class_id']);
                    if ($result === true) {
                    $UpdMsg = true;
                    }else{
                      $errors['readystate'] = true;
                  }
                }
              }

            }
              ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">UPDATE STUDENT CLASSES</label>

              <div class="form-layout form-layout-4">

              <div class="row">
                 <label class="col-sm-4 form-control-label">Select class: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="updateClassroom" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php $updateClassroom = fetch_column2('classroom_name', 'classroom', 'status', 'true'); ?>

                        <?php foreach ($updateClassroom as $UpdateClasses) { ?>
                            <option   class=""  value="<?php echo $UpdateClasses['classroom_id']; ?>"><?php echo $UpdateClasses['classroom_name'] .' '. $UpdateClasses['academic_year'];  ?></option>
                      <?php } ?>    
                      </select>
                    </div><!-- form-group -->

                     <div class="form-layout-footer mg-t-30" style="float: left;">
                        <button class="btn btn-primary bd-0" name="FetchClass" style="margin-bottom: 30px;">Fetch Class</button>
                       </div><!-- form-layout-footer -->
                     </div><!-- form-layout -->
              </div>

                  <?php if (isset($errors['updateClassroom'])): ?>
                    
                  <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong>Something went wrong, ensure you choose a class to update.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>


              <?php if (isset($fetchClassMsg) ): ?>
                <h3>Details of class term ready state</h3>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Class name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="selected_cls" disabled="" value="<?php echo $fetched_class['classroom_name'] ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">First Term Ready State: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <?php if ($fetched_class['first_term_result'] == "ready") {
                      $status = "Ready";
                      $state1 = "Ready";
                    }else{
                      $status = "Not Ready";
                      $state1 = "Not Ready";
                    } ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo $status ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Second Term Ready State: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <?php if ($fetched_class['second_term_result'] == "ready") {
                      $status = "Ready";
                      $state2 = "Ready";
                    }else{
                      $status = "Not Ready";
                      $state2 = "Not Ready";
                    } ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo $status ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Third Term Ready State: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <?php if ($fetched_class['third_term_result'] == "ready") {
                      $status = "Ready";
                      $state3 = "Ready";
                    }else{
                      $status = "Not Ready";
                      $state3 = "Not Ready";
                    } ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo $status ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

               <div class="row">
                   <label class="col-sm-4 form-control-label">First Term Ready State: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="FTRS"  class="form-control" id="ready1" value="ready" <?php if ($state1 === "Ready"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="ready1">Ready</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="FTRS" class="form-control"  id="notReady1" value="not ready" <?php if ($state1 === "Not Ready"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="notReady1">Not Ready</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

              <div class="row">
                   <label class="col-sm-4 form-control-label">Second Term Ready State: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="STRS"  class="form-control" id="ready2" value="ready" <?php if ($state2 === "Ready"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="ready2">Ready</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="STRS" class="form-control"  id="notReady2" value="not ready" <?php if ($state2 === "Not Ready"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="notReady2">Not Ready</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

              <div class="row">
                   <label class="col-sm-4 form-control-label">Third Term Ready State: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="TTRS"  class="form-control" id="ready3" value="ready" <?php if ($state3 === "Ready"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="ready3">Ready</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="TTRS" class="form-control"  id="notReady3" value="not ready" <?php if ($state3 === "Not Ready"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="notReady3">Not Ready</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

               <div class="form-layout-footer mg-t-30">
                  <a class="btn btn-primary bd-0" href="#content1">Update Ready State</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
              <?php endif ?>
               
              <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Update Ready State?</p></section><div class="btnn"> <button class="btn btn-primary bd-0" name="UpdClass" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

              <?php if (isset($errors['readystate'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Update not successful, ensure you made an change else never mind.
                    </div><!-- alert -->
                    
                  <?php endif ?>       
            
             <?php if (isset($UpdMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Well done ready state successfully updated.
          </div><!-- alert -->

            <?php endif ?>

            <?php if ( isset($errors['ReadyState'])): ?>
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

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>