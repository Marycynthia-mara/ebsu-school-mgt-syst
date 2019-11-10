<?php 
$pageTitle = "All Operations";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
  redirect_to("dashboard.php");
}

$results = fetch_column5('admin_rank', 'administrators', 'admin_id', $_SESSION['user_id']);
extract($results);

if ($admin_rank !== 'first') {
  redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 
?>


<?php 
    $result = fetch_column7 ('all_operations');
    extract($result);
    if (isset($_POST['UpdOperate'])) {
        if (isset($_POST['SignUp']) and isset($_POST['VerifyUser']) and isset($_POST['ReadyState']) and isset($_POST['ConfirmFees']) and isset($_POST['ManageUser'])) {
        extract($_POST);
    //   $confirm = <script>confirm('Are you sure you want to perform an update')</script>;
    //   echo $confirm;
    //   var_dump($confirm);
        $result = update_table4('all_operations','SignUp', $SignUp, 'ConfirmFees', $ConfirmFees, 'ManageUser', $ManageUser, 'ReadyState', $ReadyState, 'VerifyUser', $VerifyUser, 'id', $id);
        if ($result === true) {
        $UpdMsg = true;
        }else{
        $errors['operation'] = true;
        }
    }
}
              ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">UPDATE ALL OPERATIONS</label>

              <div class="form-layout form-layout-4">

             


                <h3>Details of All Operations</h3>
                <div class="row">
                  <label class="col-sm-4 form-control-label">SIGN UP: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="signup" disabled="" value="<?php echo $SignUp ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->


                <div class="row">
                  <label class="col-sm-4 form-control-label">CONFIRM FEES: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="confirm_fees" disabled="" value="<?php echo $ConfirmFees ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">MANAGE USER: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="manage_user" disabled="" value="<?php echo $ManageUser ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">VERIFY USER: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="verify_user" disabled="" value="<?php echo $VerifyUser ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">READY STATE: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="ready_state" disabled="" value="<?php echo $ReadyState ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

               <div class="row">
                   <label class="col-sm-4 form-control-label">SIGN UP: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="SignUp"  class="form-control" id="ready1" value="activated" <?php if ($SignUp === "activated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="ready1">Activated</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="SignUp" class="form-control"  id="notReady1" value="deactivated" <?php if ($SignUp === "deactivated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="notReady1">deactivated</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

              <div class="row">
                   <label class="col-sm-4 form-control-label">VERIFY USER: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="VerifyUser"  class="form-control" id="ready2" value="activated" <?php if ($VerifyUser === "activated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="ready2">Activated</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="VerifyUser" class="form-control"  id="notReady2" value="deactivated" <?php if ($VerifyUser === "deactivated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="notReady2">deactivated</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

              <div class="row">
                <label class="col-sm-4 form-control-label">READY STATE: <span class="tx-danger">*</span></label>
                <!-- <input class="form-control" type="radio"> -->
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <div class="status-one" >
                <input type="radio" name="ReadyState"  class="form-control" id="ready3" value="activated" <?php if ($ReadyState === "activated"): ?>
                    checked=""
                <?php endif ?>>
                <label class="form-check-label" for="ready3">Activated</label>
                </div> 
                <div class="status-two" >
                <input type="radio" name="ReadyState" class="form-control"  id="notReady3" value="deactivated" <?php if ($ReadyState === "deactivated"): ?>
                    checked=""
                <?php endif ?>>
                <label class="form-check-label" for="notReady3">deactivated</label>
                </div>        
            </div>
         </div><!-- col-4 -->

              <div class="row">
                   <label class="col-sm-4 form-control-label">CONFIRM FEES: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="ConfirmFees"  class="form-control" id="ready4" value="activated" <?php if ($ConfirmFees === "activated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="ready4">Activated</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="ConfirmFees" class="form-control"  id="notReady4" value="deactivated" <?php if ($ConfirmFees === "deactivated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="notReady4">deactivated</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

              <div class="row">
                   <label class="col-sm-4 form-control-label">MANAGE USER: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="ManageUser"  class="form-control" id="ready5" value="activated" <?php if ($ManageUser === "activated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="ready5">Activated</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="ManageUser" class="form-control"  id="notReady5" value="deactivated" <?php if ($ManageUser === "deactivated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="notReady5">deactivated</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

               <div class="form-layout-footer mg-t-30">
               <a class="btn btn-primary bd-0" href="#content1">Update</a>
                </div><!-- form-layout-footer -->

                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Update All Operations?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="UpdOperate" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

              </div><!-- form-layout -->


              <?php if (isset($errors['operation'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Update not successful, ensure you made an change else never mind.
                    </div><!-- alert -->
                    
                  <?php endif ?>       
            
             <?php if (isset($UpdMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Well done operations successfully updated.
          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>