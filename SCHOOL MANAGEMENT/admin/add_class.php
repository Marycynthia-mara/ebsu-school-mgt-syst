<?php 
$pageTitle = "Creat Class";

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
  if (isset($_POST['addClass'])) {
    $result = addClass($_POST);

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

          <?php if (isset($msg)): ?>

                <div class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Well done!</strong> Class successfully created.
                </div><!-- alert -->

               <?php endif ?>


               <?php if (isset($errors['dup_class'])): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ooops!</strong> <?php echo $errors['dup_class'];
                   ?>
                </div><!-- alert -->

               <?php endif ?>   

            <div class="section-wrapper">
              <label class="section-title">CREAT STUDENT CLASSES</label>

              <div class="form-layout form-layout-4">
                <div class="row">
                  <label class="col-sm-4 form-control-label">Class name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" placeholder="eg : JSS1A" name="classname" style="margin-bottom: 10px;">

                     <?php if (isset($errors['classname'])):  ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> <?php echo $errors['classname'] ?>
                    </div><!-- alert -->
                    
                  <?php endif ?>

                  <?php if (isset($errors['invalid_classname'])):  ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> <?php echo $errors['invalid_classname'] ?>
                    </div><!-- alert -->
                    
                  <?php endif ?>

                  <?php if (isset($errors['dup_classname'])):  ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> <?php echo $errors['dup_classname'] ?>
                    </div><!-- alert -->
                    
                  <?php endif ?>

                  </div>
                </div><!-- row -->

                 <div class="row">
                  <label class="col-sm-4 form-control-label">Academic year: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <input id="phoneMask" type="text" class="form-control" placeholder="eg : 2019/2020" name="academicYear" style="margin-bottom: 10px;">
                  </div><!-- input-group -->


                     <?php if (isset($errors['academicYear']) OR isset($errors['invalid_academicYear'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Academic Year is empty or has a wrong format.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>
                </div><!-- row -->

              <div class="row">
                 <label class="col-sm-4 form-control-label">Form teacher: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="formTeacher_id" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php $teachers = fetchTeachers();

                        foreach ($teachers as $teacher) {
                          extract($teacher); ?>


                          <option value="<?php echo $teachers_id ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname); ?></option> 
                     <?php  }
                         ?>
                         
                      </select>
                    </div><!-- form-group -->

                    <?php if (isset($errors['formTeacher_id'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Choose a Form Teacher.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>

              </div>
                
                <div class="form-layout-footer mg-t-30">
                  <!-- <button class="btn btn-primary bd-0" name="addClass" style="margin-bottom: 30px;">Add Class</button> -->

                  <a class="btn btn-primary bd-0" href="#content1">Add Class</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->

              <div class="special_action_confirm"><div id="content1" class="popup-effect"><div    class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to add class?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="addClass" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>               

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
      
  </form>  

       
    <?php require_once 'inc/page-footer.inc.php'; ?>