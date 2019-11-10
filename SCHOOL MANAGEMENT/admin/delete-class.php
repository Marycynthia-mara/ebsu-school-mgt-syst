<?php 
$pageTitle = "Delete Class";

require_once 'inc/config.inc.php'; 

redirect_to("dashboard.php");

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 
?>


<?php 
 if (isset($_POST['FetchClass2'])) {
      if (isset($_POST['deleteClassroom'])) {
        extract($_POST);
       
       $_SESSION['delclass_id'] = $deleteClassroom;
        $fetched_class = fetch_class($deleteClassroom, 'classroom');
        if ($fetched_class == true) {
           $fetchClass2Msg = true;
        }else{
          $errors['deleteClassroom'] = true;
          // $errors = $result;
        }
       }else{
      $errors['deleteClassroom'] = true;
      // $errors = $result;
    }   
}
?>
          <?php  if (isset($_POST['Del_Class'])) { ?>
             <!--  <script>
                if (confirm('Are you sure You want to delete the selected class') === true) {
                     <?php $confirm = true;  ?>
                  }else{
                    <?php $confirm = false;  ?>
                    alert('Class was not deleted');
                  }
              </script> -->
              <?php 
              // if ($confirm === true) {
                      $result = delete_table('classroom', 'classroom_id', $_SESSION['delclass_id']);
                      if ($result === true) {
                       $DelMsg = true;
                     }
              // } 
              ?>
          <?php } ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">DELETE STUDENT CLASSES</label>

              <div class="form-layout form-layout-4">

              <div class="row">
                 <label class="col-sm-4 form-control-label">Select class: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="deleteClassroom" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php $deleteClassroom = fetch_column2('classroom_name', 'classroom', 'status', 'true'); ?>

                        <?php foreach ($deleteClassroom as $UpdateClasses) { ?>
                            <option   class=""  value="<?php echo $UpdateClasses['classroom_id']; ?>"><?php echo $UpdateClasses['classroom_name'];  ?></option>
                      <?php } ?>    
                      </select>
                    </div><!-- form-group -->

                     <div class="form-layout-footer mg-t-30" style="float: left;">
                        <button class="btn btn-primary bd-0" name="FetchClass2" style="margin-bottom: 30px;">Fetch Class</button>
                       </div><!-- form-layout-footer -->
                     </div><!-- form-layout -->
              </div>

                  <?php if (isset($errors['deleteClassroom'])): ?>
                    
                  <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong>Something went wrong, ensure you choose a class to Delete.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>


              <?php if (isset($fetchClass2Msg) ): ?>
                <h3>Details of class to be deleted</h3>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Class name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="selected_cls2" disabled="" value="<?php echo $fetched_class['classroom_name'] ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Academic year: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <input type="text" class="form-control" disabled="" value="<?php echo $fetched_class['academic_year'] ?>" name="" style="margin-bottom: 10px;">
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
                    <input type="text" class="form-control" disabled="" value="<?php echo $firstname .' '. $lastname .' '. $surname ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Status: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <?php if ($fetched_class['status'] == "true") {
                      $status = "Activated";
                    }else{
                      $status = "Deactivated";
                    } ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo $status ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

               <div class="form-layout-footer mg-t-30">
                <a class="btn btn-primary bd-0" href="#content1">Delete Class</a>
                </div><!-- form-layout-footer -->

                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Delete Class?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="Del_Class" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

              </div><!-- form-layout -->
              <?php endif ?>

             <?php if (isset($DelMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Class successfully Deleted.
          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>