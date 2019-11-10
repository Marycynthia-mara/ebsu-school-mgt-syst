<?php 
$pageTitle = "Enter Pin";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'student') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 
?>

<?php 

if (isset($_POST['submit'])) {
    $current_student = $_SESSION['user_id'];
    $result = fetch_column8('all_pin_code', 'student_id', 'students', $current_student, $_POST);
    if ($result === true) {
        $result =  fetch_column5('fees_paid', 'students', 'student_id', $current_student);
        if($result['fees_paid'] === "true"){
          $msg = true;
          redirect_to('select_class_result_term.php');
        }else{
          echo "<script>alert('Your fees have not paid your school fees')</script>";
        }
        
    } else {
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
          <label class="section-title">Enter pin here</label>
          <p class="mg-b-20 mg-sm-b-40">Enter the pin sent to your mail here.</p>

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
                          
                          <?php 
                          $stud_id = $_SESSION['user_id'];
                          $result = fetch_column5('pin_status', 'students', 'student_id', "$stud_id");
                          ?>
                          <?php if($result[0] === 'true'){?>
                            <div class="pd-x-30 pd-y-10">
                              <h3 class="tx-gray-800 tx-normal mg-b-5">One step more to view your result!</h3>
                              <p>Enter your Pin and Serial Number below</p>
                              <br>
                              <div class="form-group">
                                <input type="text" name="pin_code" class="form-control pd-y-12" placeholder="Enter your pin">
                              </div><!-- form-group -->

                              <div class="form-group">
                                <input type="text" name="serial_no" class="form-control pd-y-12" placeholder="Enter your Serial Number">
                              </div><!-- form-group -->
                              <button class="btn btn-primary pd-y-12 btn-block" type="submit" name="submit">Submit</button>
                            </div>
                          <?php }else{?> 
                            <h1>You have not been verified for Portal fee payment</h1> 
                          <?php }?>
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

    <?php require_once 'inc/page-footer.inc.php'; ?>