<?php 
$pageTitle = "Update Class";

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
        }
       }else{
      $errors['updateClassroom'] = true;
    }   
}

              if (isset($_POST['UpdClass'])) {
                 if (isset($_POST['UformTeacher'])) {
                  extract($_POST);
                  $result = update_table2('classroom','teachers_id_fk', $UformTeacher, 'status', $status, 'classroom_id', $_SESSION['class_id']);
                  if ($result === true) {
                   $UpdMsg = true;
                  }else{
                    $errors['UformTeacher'] = true;
                  }
                 }else{
                    $errors['UformTeacher'] = true;
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
                            <option   class=""  value="<?php echo $UpdateClasses['classroom_id']; ?>"><?php echo $UpdateClasses['classroom_name'];  ?></option>
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
                <h3>Details of class to be updated</h3>
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
                  <label class="col-sm-4 form-control-label">Status: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <?php if ($fetched_class['status'] == "true") {
                      $status = "Activated";
                      $stat = "Activated";
                    }else{
                      $status = "Deactivated";
                      $stat = "Deactivated";
                    } ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo $status ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

               <div class="row">
                 <label class="col-sm-4 form-control-label">Change Form teacher: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control"  name="UformTeacher" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php $Fteachers = fetchTeachers();

                        foreach ($Fteachers as $Fteacher) {
                          extract($Fteacher); ?>


                          <option value="<?php echo $teachers_id ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname); ?></option> 
                     <?php  }
                         ?>
                         
                      </select>
                    </div><!-- form-group -->

                   

                    <?php if (isset($errors['UformTeacher'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Choose a Form Teacher.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>

              </div>

               <div class="row">
                   <label class="col-sm-4 form-control-label">Status: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="status"  class="form-control" id="activate"  value="true" <?php if ($stat === "Activated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="activate">Activate</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="status" class="form-control" id="deactivate"  value="false" <?php if ($stat === "Deactivated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="deactivate">Deactivate</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

               <div class="form-layout-footer mg-t-30">
                  <a class="btn btn-primary bd-0" href="#content1">Update Class</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
              <?php endif ?>


              <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want update class?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="UpdClass">Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>            

               <?php if (isset($errors['UformTeacher'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Choose a Form Teacher to update.
                    </div><!-- alert -->
                    
                  <?php endif ?>

             <?php if (isset($UpdMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Class successfully Updated.
          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>