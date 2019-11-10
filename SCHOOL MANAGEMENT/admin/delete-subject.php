<?php 
$pageTitle = "Delete Subject";

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
 if (isset($_POST['FetchSubject2'])) {
      if (isset($_POST['deleteSubjects'])) {
        extract($_POST);
       
       $_SESSION['delsub_id'] = $deleteSubjects;
        $fetched_subject = fetch_subject($deleteSubjects, 'subjects');
        if ($fetched_subject == true) {
           $fetchSubject2Msg = true;
        }else{
          $errors['deleteSubjects'] = true;
          // $errors = $result;
        }
       }else{
      $errors['deleteSubjects'] = true;
      // $errors = $result;
    }   
}
?>
          <?php  if (isset($_POST['Del_subject'])) { ?>
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
                      $result = delete_table('subjects', 'subject_id', $_SESSION['delsub_id']);
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
              <label class="section-title">DELETE SUBJECT</label>

              <div class="form-layout form-layout-4">

              <div class="row">
                 <label class="col-sm-4 form-control-label">Select Subject: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="deleteSubjects" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php $deleteSubjects = fetch_column3('subjects', 'subject_name'); ?>

                        <?php foreach ($deleteSubjects as $subjects) { ?>
                            <option   class=""  value="<?php echo $subjects['subject_id']; ?>"><?php echo $subjects['subject_name'];  ?></option>
                      <?php } ?>    
                      </select>
                    </div><!-- form-group -->

                     <div class="form-layout-footer mg-t-30" style="float: left;">
                        <button class="btn btn-primary bd-0" name="FetchSubject2" style="margin-bottom: 30px;">Fetch Subject</button>
                       </div><!-- form-layout-footer -->
                     </div><!-- form-layout -->
              </div>

                  <?php if (isset($errors['deleteSubjects'])): ?>
                    
                  <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Something went wrong, ensure you choose a subject to Delete.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>


              <?php if (isset($fetchSubject2Msg) ): ?>
                <h3>Details of Subject to be deleted</h3>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Subject name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="selected_cls2" disabled="" value="<?php echo $fetched_subject['subject_name'] ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Subject Category: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <input type="text" class="form-control" disabled="" value="<?php echo $fetched_subject['subject_cat'] ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

               <div class="form-layout-footer mg-t-30">

               <a class="btn btn-primary bd-0" href="#content1">Delete Subject</a>
                  
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
              <?php endif ?>

              <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Delete Subject?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="Del_subject">Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

             <?php if (isset($DelMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Subject successfully Deleted.
          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>