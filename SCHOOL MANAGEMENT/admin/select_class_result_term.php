<?php 
$pageTitle = "Enter Result Details";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}else{
    $stud_id = $_SESSION['user_id'];
}

if ($_SESSION['category'] !== 'student') {
    redirect_to("dashboard.php");
}

if (!isset($_SESSION['pin_code']) && !isset($_SESSION['serial_number'])) {
    redirect_to("enter_pin.php");
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
        $CLASS = $class;
        $TERM = $exam_term;
        $YEAR = $ACyear;
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

  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
  <div class="section-wrapper mg-t-20">
          <label class="section-title">Select class and term below</label>
          <p class="mg-b-20 mg-sm-b-40">Select the class and term of the result your want your want to view below.</p>

          <div class="modal-wrapper-demo">
            <div class="modal d-block pos-static">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
                  <div class="modal-body pd-0">
                    <div class="row no-gutters">
                      <div class="col-lg-6 bg-primary">
                        <div class="pd-40">
                          <img src="img/model.jpg" />
                        </div>
                      </div><!-- col-6 -->
                      <div class="col-lg-6 bg-white">
                        <div class="pd-y-30 pd-xl-x-30">
                          <div class="pd-x-30 pd-y-10">
                            <h3 class="tx-gray-800 tx-normal mg-b-5">You are almost there!</h3>
                            <p>Select appropriately below</p>
                            <br>
                            <div class="form-group has-warning mg-b-0">
                                <select class="form-control" data-placeholder="Choose Browser" name="class" style="margin-bottom: 10px;">
                                <option disabled="" selected="">Select class...</option>
                                <?php $prev_classes = getPrevClass($stud_id); 
                                        extract($prev_classes);
                                        $prev_classes = str_replace('none,', '', $all_classes);
                                        $prev_classes = explode(',',  $prev_classes);
                                        $prev_classes = array_unique($prev_classes);
                                
                                ?>
        
                                <?php foreach ($prev_classes as $resultClass) {
                                    
                                    $result = fetch_column4('classroom_id', 'classroom', $resultClass);
                                    ?>
                                
                                    <option   class=""  value="<?php echo $result['classroom_id']; ?>"><?php echo $result['classroom_name'].' '.$result['academic_year'];  ?></option>
                                <?php } ?>    
                                </select>
                            </div><!-- form-group -->
                            <div class="form-group has-warning mg-b-0">
                                <select class="form-control" data-placeholder="Choose Browser" name="exam_term" style="margin-bottom: 10px;">
                                <option disabled="" selected="">Select term...</option>
                                <option value="first">First Term</option>
                                <option value="second">Second Term</option>
                                <option value="third">Third Term</option>
                                
                                </select>
                            </div><!-- form-group -->

                            <div class="form-group has-warning mg-b-0">
                                <select class="form-control"  name="ACyear" style="margin-bottom: 10px;">
                                <option disabled="" selected="">Select Academic Year    ...</option>
                                <?php $academic_Yr = fetch_ACyear('academic_year', 'classroom'); ?>
        
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
                            </div><!-- form-group -->
      
                            <button class="btn btn-primary pd-y-12 btn-block" type="submit" name="submit">Submit</button>
                          </div>
                        </div><!-- pd-20 -->
                      </div><!-- col-6 -->
                    </div><!-- row -->
                  </div><!-- modal-body -->
                </div><!-- modal-content -->
              </div><!-- modal-dialog -->
            </div><!-- modal -->
          </div><!-- modal-wrapper-demo -->
        </div><!-- section-wrapper -->
</form>

<?php 
if (isset($exam_term) && isset($msg)) {
$_SESSION['exam_term'] = $exam_term;
//   redirect_to('pricp-comm-stud-res.php');


   if ($exam_term === "first") {
       $isResultReady = fetch_column5('first_term_result', 'classroom', 'classroom_id', $CLASS);
       if($isResultReady['first_term_result'] === "ready"){
            $results = fetch_stud_result('exam_result', $CLASS, $TERM, $YEAR);
            if ($results === false) {
            echo"<script>alert('No result to display to you in this class')</script>";
        
            }else{
                redirect_to("result_sheet.php?stud_id=$stud_id");
            }
       }else{
        echo"<script>alert('Result not yet ready for display')</script>";
       }
        
    }

    if ($exam_term === "second") {
        $isResultReady = fetch_column5('second_term_result', 'classroom', 'classroom_id', $CLASS);
        if($isResultReady['second_term_result'] === "ready"){
        $results = fetch_stud_result('exam_result', $CLASS, $TERM, $YEAR);
        if ($results === false) {
        echo"<script>alert('No result to display to you in this class')</script>";
       
        }else{
             redirect_to("result_sheet.php?stud_id=$stud_id");
        }
    }else{
        echo"<script>alert('Result not yet ready for display')</script>";
       }  
    }
    
    if ($exam_term === "third"){
        $isResultReady = fetch_column5('third_term_result', 'classroom', 'classroom_id', $CLASS);
        if($isResultReady['third_term_result'] === "ready"){
        $results = fetch_stud_result2('annual_result', $CLASS, $YEAR);
        if ($results === false) {
            echo"<script>alert('No result to display to you in this class')</script>";
        }else{
            redirect_to("result_sheet_annual.php?stud_id=$stud_id");
        }
    }else{
        echo"<script>alert('Result not yet ready for display')</script>";
       }      
    }
}
  ?>

    <?php require_once 'inc/page-footer.inc.php'; ?>