<?php require_once 'inc/page-header.inc.php'; ?>
<?php require_once 'inc/config.inc.php'; ?>

<?php 
if (isset($_POST['submit'])) {
    $result = add_staff($_POST);

   extract($_POST);
    if ($result === true) {
        $msg = true;
    } else {
        $errors = $result;
?>
      <?php if ($errors) { ?>
        <script>
            var sweetAlert = <?php echo json_encode($errors); ?>;
            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'SIGN UP NOT SUCCESSFUL.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
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


<?php if ( isset($msg
  )): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', 'Sign Up successful');
</script> 
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
   <div class="section-wrapper mg-t-20">
          <label class="section-title">Staff Sign Up Form</label>
          <p class="mg-b-20 mg-sm-b-40">Note all the fields marked with <span class="tx-danger">*</span> are required.</p>

          
                <div class="col-md-4 <?php if (isset($errors['form_class'])) {
                                echo "error";
                          } ?>">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Select Form Class :<span class="tx-danger">*</span></label>
                  <?php $classes = fetch_column('classroom_name', 'classroom');  ?>
                  <select id="select2-a" class="form-control " name="form_class" data-placeholder="Select Class">
                    <option disabled="" selected=""> choose...</option>
                        <?php foreach ($classes as $class) { ?>
                            <option   class=""  value="<?php echo $class['classroom_id'] ?>"><?php echo $class['classroom_name'];  ?></option>
                      <?php } ?>  
                  </select>
                </div>
              </div><!-- col-4 -->
               
          </div><!-- row -->
            <div class="form-layout-footer bd pd-20 bd-t-0" style="border: none;">
              <input class="btn btn-primary bd-0" type="submit" name="submit" value="Sign Up">
            </div><!-- form-group -->
          </div><!-- form-layout -->
   </div><!-- section-wrapper -->
    </form> 

    <?php require_once 'inc/page-footer.inc.php'; ?>



     <div class="modal-body pd-0" style="width: 100%;">
                    <div class="row flex-row-reverse no-gutters">  
                        
                      <!-- <div class="col-xl-6 bg-primary"> -->
                        <div class="col-xl-6">
                        <div class="pd-30">
                          
                          <div class="pd-xs-x-30 pd-y-10" style="padding: 0;">
                            <p>Select a class to see students in it</p>
                            <br>
                            <div class=" <?php if (isset($errors['form_class'])) {
                                            echo "error";
                                           } ?>">
                              <div class="form-group mg-md-l--1 bd-t-0-force">
                                <label class="form-control-label mg-b-0-force">Select Form Class :<span class="tx-danger">*</span></label>
                                <?php $classes = fetch_column('classroom_name', 'classroom');  ?>
                                <select id="select2-a" class="form-control " name="form_class" data-placeholder="Select Class">
                                  <option disabled="" selected=""> choose...</option>
                                      <?php foreach ($classes as $class) { ?>
                                          <option   class=""  value="<?php echo $class['classroom_id'] ?>"><?php echo $class['classroom_name'];  ?></option>
                                    <?php } ?>  
                                </select>
                              </div>
                            </div><!-- col-4 -->
                            <button class="btn btn-primary btn-block">Sign In</button>
                          </div>
                        </div><!-- pd-20 -->
                      </div><!-- col-6 -->
                      <div class="col-xl-6">
                        <div class="pd-30">
                          <div class="pd-xs-x-30 pd-y-10" style="padding: 0;">
                            <h5 class="tx-xs-28 tx-inverse mg-b-5">Welcome back!</h5>
                            <p>Sign in to your account to continue</p>
                            <br>
                            <!-- <div class="section-wrapper mg-t-20"> -->
                             <!--  <label class="section-title">Bordered Right Label Alignment</label>
                              <p class="mg-b-20 mg-sm-b-40">A basic form where labels are aligned in right with bordered wrapper.</p> -->

                              <div class="form-layout form-layout-7">
                                <div class="row no-gutters">
                                  <div class="col-5 col-sm-4">
                                    Firstname:
                                  </div><!-- col-4 -->
                                  <div class="col-7 col-sm-8">
                                    <input class="form-control" type="text" name="fullname" placeholder="Enter your fullname">
                                  </div><!-- col-8 -->
                                </div><!-- row -->
                                <div class="row no-gutters">
                                  <div class="col-5 col-sm-4">
                                    Email Address:
                                  </div><!-- col-4 -->
                                  <div class="col-7 col-sm-8">
                                    <input class="form-control" type="text" name="firstname" placeholder="Enter your email address">
                                  </div><!-- col-8 -->
                                </div><!-- row -->
                              </div><!-- form-layout -->
                            <!-- </div> -->
                            <!-- section-wrapper -->
                            <button class="btn btn-primary btn-block">Sign In</button>

                            <div class="mg-t-30 mg-b-20 tx-12">Don't have an account yet? <a href="">Sign Up</a></div>
                          </div>
                        </div><!-- pd-20 -->
                      </div><!-- col-6 -->
                     
                    </div><!-- row -->
                  </div><!-- modal-body -->