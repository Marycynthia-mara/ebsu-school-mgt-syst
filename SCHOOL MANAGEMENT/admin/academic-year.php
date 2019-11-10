<?php 
$pageTitle = "Academic Year Update";
require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; ?>

<?php 
 if (isset($_POST['UpdACyear'])) {
      if (isset($_POST['updateACyear'])) {
        extract($_POST);
       
        $fetched_ACyear =fetch_class2($updateACyear, 'classroom', 'academic_year');
        $_SESSION['ACyear'] = $fetched_ACyear;
        if ($fetched_ACyear == true) {
           $UpdACyearMsg = true;
        }else{
          $errors['updateACyear'] = true;
        }
       }else{
      $errors['issetACY'] = true;
    }   
}

              if (isset($_POST['toggleStatusyear'])) {
                 if (isset($_POST['status'])) {
                  extract($_POST);
                  $counter = 0;
                  foreach ($_SESSION['ACyear'] as $academicYear) {
                     $result = update_table('classroom','status',  $status, 'classroom_id', $academicYear['classroom_id']);
                    
                  }
                   
                     if ($result === true) {
                        if ($_POST['status'] == "true") {
                          $UpdMsg = "Activation successful";
                        }else{
                            $UpdMsg = "Deactivation successful";
                        }
                      }else{
                        if ($_POST['status'] == "true") {
                          $errors['status_status'] = "Academic Year Already Activated";
                        }else{
                           $errors['status_status'] = "Academic Year Already Deactivated";
                        }
                      }
                  } else{
                    $errors['status'] = true;
                  }
              }
              ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">UPDATE ACADEMIC YEAR</label>

              <div class="form-layout form-layout-4">

              <div class="row">
                 <label class="col-sm-4 form-control-label">Select Academic Year: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                    <?php $updateACyear = fetch_ACyear('academic_year', 'classroom');
                            $ACyearSorting = [];
                            $ACyearSorted = [];
                            foreach ($updateACyear as $ACyear){
                               
                              extract($ACyear);
                              $result = array_push($ACyearSorting, $academic_year);
                            }

                            for($i = 0; $i < sizeof($ACyearSorting); $i++){
                              if(!(in_array($ACyearSorting[$i] ,$ACyearSorted))){
                                $academicYrs = array_push($ACyearSorted, $ACyearSorting[$i]);
                              }
                            }
                              // var_dump($ACyearSorted) ;
                              // $updateACyear = array_unique($updateACyear, SORT_STRING);    
                      ?>
                      <select class="form-control"  name="updateACyear" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>

                        <?php for($i = 0; $i < sizeof($ACyearSorted); $i++) { ?>
                            <option   class=""  value="<?php echo $ACyearSorted[$i]; ?>"><?php echo $ACyearSorted[$i];  ?></option>
                      <?php } ?>    
                      </select>
                    </div><!-- form-group -->
                          
                     <div class="form-layout-footer mg-t-30" style="float: left;">
                        <button class="btn btn-primary bd-0" name="UpdACyear" style="margin-bottom: 30px;">Fetch Academic Year</button>
                       </div><!-- form-layout-footer -->
                     </div><!-- form-layout -->
              </div>

                  <?php if (isset($errors['updateACyear'])): ?>
                    
                  <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Something went wrong, ensure you choose an academic year.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>


              <?php if (isset($UpdACyearMsg) ): ?>
                <h3>Details of selected academic year</h3>
              
                <div class="row">
                  <label class="col-sm-4 form-control-label">Academic year: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <input  type="text" class="form-control" disabled="" value="<?php echo  $_SESSION['ACyear'][0]['academic_year'] ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Status: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <?php if ( $_SESSION['ACyear'][0]['status'] == "true") {
                      $status = "Activated";
                    }else{
                      $status = "Deactivated";
                    } ?>
                    <input  type="text" class="form-control" disabled="" value="<?php echo $status ?>" name="" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

               <div class="row">
                   <label class="col-sm-4 form-control-label">Status: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="radio"> -->
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="status-one" >
                    <input type="radio" name="status"  class="form-control" id="activate" value="true" <?php if ($status === "Activated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="activate">Activate</label>
                  </div> 
                  <div class="status-two" >
                    <input type="radio" name="status" class="form-control" id="deactivate" value="false" <?php if ($status === "Deactivated"): ?>
                      checked=""
                    <?php endif ?>>
                    <label class="form-check-label" for="deactivate">Deactivate</label>
                  </div>        
                </div>
              </div><!-- col-4 -->

               <div class="form-layout-footer mg-t-30">
                  <a class="btn btn-primary bd-0" href="#content1">Update Academic Year</a>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
              <?php endif ?>

              <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Update Academic Year?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="toggleStatusyear">Procced</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

             <?php if (isset($UpdMsg)): ?>

                <div class="alert alert-success" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Well done!</strong> <?php echo $UpdMsg ?>.
                </div><!-- alert -->

            <?php endif ?>

             <?php if (isset($errors['status'] )): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ouch! </strong> Updated Not successfully.
                </div><!-- alert -->

            <?php endif ?>

             <?php if (isset($errors['status_status'] )): ?>

                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>Ouch! </strong> <?php echo $errors['status_status']  ?>.
                </div><!-- alert -->

            <?php endif ?>

            <?php if (isset($errors['issetACY'] )): ?>

                            <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <strong>Ouch! </strong> Choose Academic Year.
                            </div><!-- alert -->

                        <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>