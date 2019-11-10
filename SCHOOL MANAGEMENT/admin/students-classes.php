<?php 
$pageTitle = "Manage Students in a class";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 
?>

<?php if (isset($_POST['Fetch_student'])) {
  extract($_POST);
  if (isset($form_class)) {
    $result = fetch_students($form_class, 'students', 'class');
    if ($result) {
      $msg = true;
    }else{
      $errors['Fetch_student'] = true;
    }
  }else{
      $errors['emptyFclass'] = true;
    }
  
} 

 if (isset($_POST['update'])) {
    if (!empty($_POST['stud_id'])) {
      // $_SESSION['stringsOfStudsIds'] = implode(',', $_POST['stud_id']);
      $_SESSION['stringsOfStudsIds'] = $_POST['stud_id'];
      $_SESSION['update_cat'] = "update";
      redirect_to('stud_update.php');
  }else{
    $errors['update'] = true;
  }
 } 

 if (isset($_POST['delete'])) {
    if (!empty($_POST['stud_id'])) {
      // $_SESSION['stringsOfStudsIds'] = implode(',', $_POST['stud_id']);
      $_SESSION['stringsOfStudsIds'] = $_POST['stud_id'];
      $_SESSION['update_cat'] = "delete";
      redirect_to('stud_update.php');
  }else{
    $errors['delete'] = true;
  }
 } 

 if (isset($_POST['paid_fees'])) {
    if (!empty($_POST['stud_id'])) {
      // $_SESSION['stringsOfStudsIds'] = implode(',', $_POST['stud_id']);
      $_SESSION['stringsOfStudsIds'] = $_POST['stud_id'];
      $_SESSION['update_cat'] = "paid_fees";
      redirect_to('stud_update.php');
  }else{
    $errors['paid_fees'] = true;
  }
 } 



?>

<?php if ( isset($errors['Fetch_student'])): ?>
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
    notifyWithToast('error', 'Sorry there are no students in this class');
</script> 
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">   
    <div class="section-wrapper mg-t-20">
          <label class="section-title">Students Classes</label>
          <p class="mg-b-20 mg-sm-b-40">Classes and student in them.</p>

        <?php if (isset($msg)): ?>
          <div class="section-wrapper mg-t-20">
            <div class="form-layout form-layout-7">
              <h5>CLASS : <?php echo fetch_class($form_class, 'classroom')['classroom_name'];  ?></h5>
              <div class="row no-gutters">
                <div class="col-5 col-sm-4 ">
                  <div class="stud_column-1">
                      <input  class="form-control" type="checkbox" name="checkAll" id="checkAll" >
                    </div><!-- col-4 -->
                    <div class="stud_column-2">
                      <h5 style="margin: 0;">Students Reg No</h5>
                    </div><!-- col-8 -->
                </div><!-- col-4 -->
                <div class="col-7 col-sm-8 ">
                  <h5 style="margin: 0; display: inline-block;">STUDENTS FULLNAME</h5>
                  <button name="update" type="submit" class="button">update</button>
                  <button name="delete" type="submit" class="button">delete</button>
                  <button name="paid_fees" type="submit" class="button">Fee confirmation</button>
                </div><!-- col-8 -->
              </div><!-- row -->

              <?php if(count($result) === count($result, COUNT_RECURSIVE)){ ?>
                  <div class="row no-gutters studs">
                  <div class="col-5 col-sm-4 stud_column" style="background-color: rgb(233, 236, 239)">
                      <div class="stud_column-1">
                        <input  class="form-control" type="checkbox" name="stud_id[]" value="<?php echo $result['student_id'];  ?>">
                      </div><!-- col-4 -->
                      <div class="stud_column-2">
                        <input disabled="" class="form-control" type="text" name="reg_no" value="<?php echo $result['reg_no']  ?>" >
                      </div><!-- col-8 -->
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-8 stud_column">
                    <input disabled="" class="form-control" type="text" name="names" value="<?php echo ucfirst($result['firstname']) .' '. ucfirst($result['lastname']) .' '. ucfirst($result['surname']);  ?>" >
                  </div><!-- col-8 -->
                </div><!-- row -->
              <?php }else{ ?>
                <?php foreach ($result as $student): ?>
                <?php extract($student); ?>
                  <div class="row no-gutters studs">
                  <div class="col-5 col-sm-4 stud_column" style="background-color: rgb(233, 236, 239)">
                      <div class="stud_column-1">
                        <input  class="form-control" type="checkbox" name="stud_id[]" value="<?php echo $student_id;  ?>">
                      </div><!-- col-4 -->
                      <div class="stud_column-2">
                        <input disabled="" class="form-control" type="text" name="reg_no" value="<?php echo $reg_no  ?>" >
                      </div><!-- col-8 -->
                  </div><!-- col-4 -->
                  <div class="col-7 col-sm-8 stud_column">
                    <input disabled="" class="form-control" type="text" name="names" value="<?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);  ?>" >
                  </div><!-- col-8 -->
                </div><!-- row -->
              <?php endforeach; ?>
              <?php }?>

              
              
            </div><!-- form-layout -->
          </div><!-- section-wrapper -->
        <?php endif ?>

          <div class="pd-y-30 tx-center bg-dark">

            <div style="display: inline-block;" class="col-md-4 <?php if (isset($errors['form_class'])) {
                                echo "error";
                          } ?>">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Select a class :<span class="tx-danger">*</span></label>
                  <?php $classes = fetch_column2('classroom_name', 'classroom', 'status', 'true');  ?>
                  <select id="select2-a" class="form-control " name="form_class" data-placeholder="Select Class">
                    <option disabled="" selected=""> choose...</option>
                        <?php foreach ($classes as $class) { ?>
                            <option   class=""  value="<?php echo $class['classroom_id'] ?>"><?php echo $class['classroom_name'].' '. $class['academic_year'];  ?></option>
                      <?php } ?>  
                  </select>
                </div>
              </div><!-- col-4 -->
              <button class="btn btn-primary pd-x-25" name="Fetch_student" type="submit">Fetch students</button>
          </div><!-- pd-y-30 -->
          <?php if (isset($errors['emptyFclass'])): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ooops!</strong> Choose a class to fetch;
                </div><!-- alert -->

               <?php endif ?>

               <?php if (isset($errors['update'])): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ooops!</strong> check the box(es) to update;
                </div><!-- alert -->

               <?php endif ?>

                <?php if (isset($errors['delete'])): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ooops!</strong> check the box(es) to delete;
                </div><!-- alert -->

               <?php endif ?>

               <?php if (isset($errors['paid_fees'])): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ooops!</strong> check box(es) for fee confirmation;
                </div><!-- alert -->

               <?php endif ?>
  </div><!-- section-wrapper -->
</form> 

<script>
 $(document).ready(function () {
   var checkAll = document.getElementById('checkAll');
   $('#checkAll').click(function () {
    if ($('#checkAll').attr("checked", false)) {
      $(':checkbox').attr("checked", true);
    }else{
     $(':checkbox').attr("checked", false);
    }
   });
 })
</script>

<?php require_once 'inc/page-footer.inc.php'; ?>