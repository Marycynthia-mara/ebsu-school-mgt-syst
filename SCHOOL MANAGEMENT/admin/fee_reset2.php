<?php 
$pageTitle = "Update Class Portal Fees Payment Status";

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
                 if (isset($_POST['fee_status'])) {
                  extract($_POST);
                  $result = update_table3('students', 'pin_status' , $fee_status, 'pin' , '', 'serial_no' , '', 'class', $_SESSION['class_id']);
                  if ($result === true) {
                   $UpdMsg = true;
                  }else{
                    $errors['fee_status_error'] = true;
                  }
                 }else{
                    $errors['fee_status'] = true;
                  }
              }
              ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">RESET STUDENT PORTAL FEES STATUS</label>

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
                      <strong>Oh snap!</strong>Something went wrong, ensure you choose a class to reset, and current academic year is activated. 
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>


              <?php if (isset($fetchClassMsg) ): ?>
                <h3>Details of class to Reset</h3>
                <P>NB: By clicking Reset sets the status of all the students to false, indicating that none have paid their portal fees for that term.</P>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Class name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="selected_cls" disabled="" value="<?php echo $fetched_class['classroom_name'] ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Academic year: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <input  type="text" class="form-control" disabled="" value="<?php echo $fetched_class['academic_year'] ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Form teacher: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">

                    <?php $formTeacher = fetchFormTeachers($fetched_class['teachers_id_fk']);
                    extract($formTeacher);
                     ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo $firstname .' '. $lastname .' '. $surname ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

                <div class="row">
                 <label class="col-sm-4 form-control-label">Portal Fee confirmation status: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control"  name="fee_status" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <!-- <option value="true">Approve All</option> -->
                        <option value="false">Disapprove All</option>
                        
                      </select>
                    </div>
                    <!-- form-group -->    

                   

                    <?php if (isset($errors['fee_status'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Select a status.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>

              </div>

               <div class="form-layout-footer mg-t-30">
                  <a class="btn btn-primary bd-0" href="#content1">Reset</a> 
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
              <?php endif ?>

              <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Reset?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="UpdClass" >proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

               <?php if (isset($errors['fee_status_error'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Reset not successfull.
                      <strong>Likly Reasons</strong> Students in this class are already disapproved.
                    </div><!-- alert -->
                    
                  <?php endif ?>

             <?php if (isset($UpdMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Reset successful.
          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>