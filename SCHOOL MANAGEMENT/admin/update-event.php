<?php 
$pageTitle = "Update Event";

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
 if (isset($_POST['FetchEvent'])) {
      if (isset($_POST['updateEvent'])) {
        extract($_POST);
       
       $_SESSION['event_id'] = $updateEvent;
        $fetched_event = fetch_column4('event_id', 'events', $updateEvent);
        if ($fetched_event == true) {
           $fetchEventMsg = true;
        }else{
          $errors['updateEvent'] = true;
        }
       }else{
      $errors['updateEvent'] = true;
    }   
}

              if (isset($_POST['UpdEvent'])) {
                 if (isset($_POST['title']) and isset($_POST['body'])) {
                  $result = update_post($_POST, $_FILES['pic']);
                  if ($result === true) {
                   $UpdMsg = true;
                  }else{
                    $errors['UEvent'] = true;
                  }
                 }else{
                    $errors['UEvent1'] = $result;
                  }
              }
              ?>

<form method="post" id="updateClass" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          <div class="row row-sm mg-t-20" style="background-color: #DCEBFA;">
          <div class="col-lg-6" style="margin: 20px auto">
            <div class="section-wrapper">
              <label class="section-title">UPDATE SUBJECT</label>

              <div class="form-layout form-layout-4">

              <div class="row">
                 <label class="col-sm-4 form-control-label">Select Event: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <div class="form-group has-warning mg-b-0">
                      <select class="form-control" data-placeholder="Choose Browser" name="updateEvent" style="margin-bottom: 10px;">
                        <option disabled="" selected="">Choose...</option>
                        <?php $updateEvent = fetch_column3('events', 'event_title'); ?>
                        <?php if (is_array($updateEvent)) { ?>
                          <?php if (count($updateEvent) === count($updateEvent, COUNT_RECURSIVE)): ?>
                           <option   class=""  value="<?php echo $events['event_id']; ?>"><?php  echo ucwords($updateEvent['event_title']);  ?></option>
                            <?php endif ?>

                            <?php if (count($updateEvent) !== count($updateEvent, COUNT_RECURSIVE)): ?>
                                 <?php foreach ($updateEvent as $events) { ?>
                                <option   class=""  value="<?php echo $events['event_id']; ?>"><?php  echo ucwords($events['event_title']);  ?></option>
                                 <?php } ?> 
                               <?php endif ?>   
                       <?php }else{ ?>
                        <option   class=""  value="">No Event Yet</option>
                       <?php } ?>
                      </select>
                    </div><!-- form-group -->

                     <div class="form-layout-footer mg-t-30" style="float: left;">
                        <button class="btn btn-primary bd-0" name="FetchEvent" style="margin-bottom: 30px;">Fetch Event</button>
                       </div><!-- form-layout-footer -->
                     </div><!-- form-layout -->
              </div>

                  <?php if (isset($errors['updateEvent'])): ?>
                    
                  <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Something went wrong, ensure you choose an event to update.
                    </div><!-- alert -->
                    
                  <?php endif ?>
                  </div>


              <?php if (isset($fetchEventMsg) ): ?>
                <h3>Details of Event to be updated</h3>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Event Tilte: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" name="title"  value="<?php echo $fetched_event['event_title'] ?>" style="margin-bottom: 10px;">
                  </div>
                </div><!-- row -->

                <div class="" style="margin-bottom: 20px;">
                  <div class="form-group has-success mg-b-0">
                    <textarea rows="3" class="form-control is-valid mg-t-20" name="body" placeholder="Event body" ><?php echo $fetched_event['event_desc'] ?></textarea>
                  </div><!-- form-group -->
                </div>

              <div class="row">
               <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile04" name="pic">
                    <label class="custom-file-label dripicons-paperclip" for="inputGroupFile04">Update poster for this event</label>
                  </div>
                </div>

               <div class="form-layout-footer mg-t-30">
                  <a class="btn btn-primary bd-0" href="#content1">Update Event</a>
                </div><!-- form-layout-footer -->

                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Update Event?</p></section><div class="btnn"><button class="btn btn-primary bd-0" name="UpdEvent" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>        

              </div><!-- form-layout -->
              <?php endif ?>

               <?php if (isset($errors['UEvent1'])): ?>
                    
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> <?php $errors['UEvent1']; ?>
                    </div>
                    <!-- alert -->
                    
                  <?php endif ?>
                  <?php if (isset($errors['UEvent'] )): ?>
                                      
                    <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> update not sucessful, ensure you made an update and required fields are not empty.
                    </div>
                    <!-- alert -->
                    
                  <?php endif ?>

             <?php if (isset($UpdMsg)): ?>

          <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Well done!</strong> Event successfully Updated.
          </div><!-- alert -->

            <?php endif ?>

            </div><!-- section-wrapper -->
          </div><!-- col-6 -->
         
        </div><!-- row -->
        
  </form>
     
    <?php require_once 'inc/page-footer.inc.php'; ?>