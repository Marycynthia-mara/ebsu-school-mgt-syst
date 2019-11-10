<?php
$pageTitle = "Result Fetch";
 
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

if (isset($_POST['submit'])) {
  extract($_POST);
    $result = val_fetch_form2($_POST);


    if ($result === false) {

      echo "<script>alert('There are no students in this class');</script>";     
    }elseif( count($result) !== count($result, COUNT_RECURSIVE)) {
      $_SESSION['sub-stud-fetch'] = $result;
        $msg = true;
    }else {
        $errors = $result;
      
?>
      <?php if ($errors) { ?>
        <script>
            var sweetAlert = <?php echo json_encode($errors); ?>;
            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'SOMETHING WENT WRONG.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
            var i;
            var timer = 0;
            for(i in sweetAlert){
                sweetAlert[i] = '<p style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</p>';
            allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
            timer += + 3;
            }

              function notifyWithToast(type, message, timer) {
                  var duration = timer * 1000;
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'bottom-start',
                      showConfirmButton: true,
                      timer: duration
                  });

                  Toast.fire({
                      type: type,
                      // title: 'Something went wrong',
                      html: '<p>' + message + '</p>'
                  })
              }
              notifyWithToast('error', allAlerts, timer);
        </script> 


<?php } ?>
<?php
    }
} ?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
   <div class="section-wrapper mg-t-20">
          <label class="section-title">Student Subject Upload</label>
          <p class="mg-b-20 mg-sm-b-40">Note all the fields marked with <span class="tx-danger">*</span> are required.</p>

          <div class="form-layout form-layout-2">
            <div class="row no-gutters">

              

               <div class="col-md-4 <?php if (isset($errors['class'])) {
                                echo "error";
                          } ?>">
                  <div class="form-group mg-md-l--1 bd-t-0-force">
                    <label class="form-control-label mg-b-0-force">Select Class :<span class="tx-danger">*</span></label>
                    <?php $form_class = fetch_column2('classroom_name', 'classroom', 'status', 'true');                    
                     ?>
                    <select id="select2-a" class="form-control " name="class" data-placeholder="Select Class">
                      <option disabled="" selected=""> choose...</option>
                          <?php foreach ($form_class as $classes) { ?>
                            <option   class=""  value="<?php echo $classes['classroom_id']; ?>"><?php echo $classes['classroom_name'] .' '. $classes['academic_year'];  ?></option>
                      <?php } ?>   
                    </select>
                  </div>
              </div><!-- col-4 -->
              <div class="col-md-4 <?php if (isset($errors['exam_term'])) {
                                echo "error";
                          } ?>">
                  <div class="form-group mg-md-l--1 bd-t-0-force">
                    <label class="form-control-label mg-b-0-force">Select Term :<span class="tx-danger">*</span></label>
                    <select id="select2-a" class="form-control " name="exam_term" data-placeholder="Select Class">
                      <option disabled="" selected=""> choose...</option>
                      <option value="first">First</option>          
                      <option value="second">Second</option> 
                      <option value="third">Third</option> 
                    </select>
                  </div>
              </div><!-- col-4 -->    

              <div class="col-md-4 <?php if (isset($errors['ACyear'])) {
                                echo "error";
                          } ?>">
                  <div class="form-group mg-md-l--1 bd-t-0-force">
                    <label class="form-control-label mg-b-0-force">Select Academic Year:<span class="tx-danger">*</span></label>
                    <select class="form-control"  name="ACyear" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php 
                          $academic_Yr = fetch_column2('academic_year', 'classroom', 'status', 'true'); 
                        ?>

                          <?php 
                          
                            $ACyearSorting = [];
                            $ACyearSorted = [];
                            foreach ($academic_Yr as $ACyear){
                               
                              extract($ACyear);
                              $result = array_push($ACyearSorting, $academic_year);
                            }

                            for($i = 0; $i < sizeof($ACyearSorting); $i++){
                              if(!(in_array($ACyearSorting[$i] ,$ACyearSorted))){
                                $academicYrs = array_push($ACyearSorted, $ACyearSorting[$i]);
                              }
                            }
                      ?>

                        <?php for($i = 0; $i < sizeof($ACyearSorted); $i++) { ?>
                            <option   class=""  value="<?php echo $ACyearSorted[$i]; ?>"><?php echo $ACyearSorted[$i];  ?></option>
                      <?php } ?>      


                      </select>
                  </div>
              </div><!-- col-4 -->    
          </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0" style="border: none;">
              <input class="btn btn-primary bd-0" type="submit" name="submit" value="Fetch Students">
            </div><!-- form-group -->
          </div><!-- form-layout -->
        </div><!-- section-wrapper -->
</form> 

<?php 
if (isset($exam_term) && isset($msg)) {
$_SESSION['exam_term'] = $exam_term;
  redirect_to('pricp-comm-stud-res.php');
}
  ?>

    <?php require_once 'inc/page-footer.inc.php'; ?>