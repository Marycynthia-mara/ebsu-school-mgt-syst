<?php 
$pageTitle = "Update Class";

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
    $term_dates = fetch_column4('id', 'term_dates', '1');
    if (isset($_POST['UpdTerm'])){
      if ($_POST['term_start'] !== "" and $_POST['term_end'] !== "" and $_POST['total_term_days'] !== "") {
          extract($_POST);
          $result = update_table3('term_dates', 'term_end', $term_end, 'term_start',  $term_start, 'total_term_days', $total_term_days, 'id', '1');
          if ($result === true) {
            $UpdMsg = true;
          }else{
            $errors['UpdTerm'] = true;
          }

      }else{
        $errors['UpdTerm'] = true;
      }
    }
      ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">

            <?php if (isset($UpdMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Class successfully Updated.
          </div><!-- alert -->

            <?php endif ?>

            <?php if (isset($errors['UpdTerm'])): ?>

          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Ouch !</strong> Something went wrong, ensure all fields are filed.
          </div><!-- alert -->

            <?php endif ?>

              <label class="section-title">UPDATE TERM DATES</label>


                <div class="row">
                  <label class="col-sm-4 form-control-label">Term ended: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="date" class="form-control" name="term_end"  style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="row">
                  <label class="col-sm-4 form-control-label">Term starts: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <input  type="date" class="form-control" name="term_start" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->


                <div class="row">
                  <label class="col-sm-4 form-control-label">Total Term days: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <div class="input-group">
                    <input  type="number" class="form-control" name="total_term_days" style="margin-bottom: 10px;">
                  </div><!-- input-group -->
                  </div>
                </div><!-- row -->

              </div>

               <div class="form-layout-footer mg-t-30">
                  <a class="btn btn-primary bd-0" href="#content1">Update Term</a>
                </div><!-- form-layout-footer -->
              
                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Update Term?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="UpdTerm"  >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>
              

            </div><!-- form-layout -->
            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>

   

       
    <?php require_once 'inc/page-footer.inc.php'; ?>