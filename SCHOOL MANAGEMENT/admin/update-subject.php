<?php 
$pageTitle = "Update Subject";

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
 if (isset($_POST['FetchSubject'])) {
      if (isset($_POST['updateSubject'])) {
        extract($_POST);
       
       $_SESSION['subject_id'] = $updateSubject;
        $fetched_subject = fetch_subject($updateSubject, 'subjects');
        if ($fetched_subject == true) {
           $fetchSubjectMsg = true;
        }else{
          $errors['updateSubject'] = true;
        }
       }else{
      $errors['updateSubject'] = true;
    }   
}

              if (isset($_POST['UpdSubject'])) {
                 if (isset($_POST['USubject'])) {
                  extract($_POST);
                  $result = update_table('subjects','subject_cat', $USubject, 'subject_id', $_SESSION['subject_id']);
                  if ($result === true) {
                   $UpdMsg = true;
                  }else{
                    $errors['USubject'] = true;
                  }
                 }else{
                    $errors['USubject1'] = true;
                  }
              }
              ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">UPDATE SUBJECT</label>

              <div class="form-layout form-layout-4">

              <div class="row">
                 <label class="col-sm-4 form-control-label">Select Subject: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="updateSubject" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php $updateSubject = fetch_column3('subjects', 'subject_name'); ?>

                        <?php foreach ($updateSubject as $subjects) { ?>
                            <option   class=""  value="<?php echo $subjects['subject_id']; ?>"><?php echo ucwords($subjects['subject_name']);  ?></option>
                      <?php } ?>    
                      </select>
                    </div><!-- form-group -->

                     <div class="form-layout-footer mg-t-30" style="float: left;">
                        <button class="btn btn-primary bd-0" name="FetchSubject" style="margin-bottom: 30px;">Fetch Subject</button>
                       </div><!-- form-layout-footer -->
                     </div><!-- form-layout -->
              </div>

                  <?php if (isset($errors['updateSubject'])): ?>
                    
                  <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Something went wrong, ensure you choose a subject to update.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>


              <?php if (isset($fetchSubjectMsg) ): ?>
                <h3>Details of subject to be updated</h3>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Subject name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="selected_cls" disabled="" value="<?php echo $fetched_subject['subject_name'] ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Subject category: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">

                    <?php $subject_cat = fetchsubject_cats($fetched_subject['subject_id']);
                    extract($subject_cat);
                     ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo ucwords($subject_cat)?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

               <div class="row">
                 <label class="col-sm-4 form-control-label">Change Subject category: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control"  name="USubject" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <option>Junior Subject</option>
                        <option>Senior Subject</option>
                        <option>Senior Sciences Subject</option>
                        <option>Senior Arts Subject</option>
                        <option>Junior and Senior Subject</option>
                        <option>Senior Science and Arts Subject</option>
                        <!-- <?php $Fteachers = fetchTeachers();

                        foreach ($Fteachers as $Fteacher) {
                          extract($Fteacher); ?>
                          <option value="<?php echo $teachers_id ?>"><?php echo ucwords($firstname) .' '. ucwords($lastname) .' '. ucwords($surname); ?></option> 
                     <?php  }
                         ?> -->
                         
                      </select>
                    </div><!-- form-group -->

                   

                    <?php if (isset($errors['USubject'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Update not successful, try again.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>

              </div>

               <div class="form-layout-footer mg-t-30">
               <a class="btn btn-primary bd-0" href="#content1">Update Subject</a>
                </div><!-- form-layout-footer -->

                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Update Subject?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="UpdSubject" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>          

              </div><!-- form-layout -->
              <?php endif ?>

               <?php if (isset($errors['USubject1'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Choose a Subject category to update.
                    </div>
                    <!-- alert -->
                    
                  <?php endif ?>

             <?php if (isset($UpdMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Subject successfully Updated.
          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>