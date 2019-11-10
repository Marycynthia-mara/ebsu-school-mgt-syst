<?php 
$pageTitle = "Creat Subject";

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
  if (isset($_POST['addSubject'])) {
    $result = addSubject($_POST);

    if ($result === true) {
      $msg = true;
    }else{
      $errors = $result;
    }
}


 ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
         <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">CREAT SUBJECT</label>

              <div class="form-layout form-layout-4">
                <div class="row">
                  <label class="col-sm-4 form-control-label">Subject name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" placeholder=" eg: English Language"  name="subjectname" style="margin-bottom: 10px;">

                     <?php if (isset($errors['subjectname']) OR isset($errors['invalid_subjectname']) OR isset($errors['dup_subjectname'])):  ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> subject name is empty or has a wrong format or subject name already exist
                    </div><!-- alert -->
                    
                  <?php endif ?>

                  </div>
                </div><!-- row -->


              <div class="row">
                 <label class="col-sm-4 form-control-label">Subject Category: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="subjectcat" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <option>Junior Subject</option>
                        <option>Senior Subject</option>
                        <option>Senior Sciences Subject</option>
                        <option>Senior Arts Subject</option>
                        <option>Junior and Senior Subject</option>
                        <option>Senior Science and Arts Subject</option>
                      </select>
                    </div><!-- form-group -->

                    <?php if (isset($errors['subjectcat'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Choose a Subject Category.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>

              </div>
                
                <div class="form-layout-footer mg-t-30">
                  <a class="btn btn-primary bd-0" href="#content1">Add Subject</a>
                </div><!-- form-layout-footer -->

                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Add Subject?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="addSubject" >proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

              </div><!-- form-layout -->

              <?php if (isset($msg)): ?>

                <div class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Well done!</strong> Subject successfully created.
                </div><!-- alert -->

               <?php endif ?>

                <?php if (isset($errors['dup_subject'])): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ooops!</strong> <?php echo $errors['dup_subject'];
                   ?>
                </div><!-- alert -->

               <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
      
  </form>  

       
    <?php require_once 'inc/page-footer.inc.php'; ?>