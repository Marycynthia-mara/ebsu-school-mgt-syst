<?php 
$pageTitle = "Creat Event";

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
    $response = add_post($_POST, $_FILES['pic']);
    if ($response === true) {
        $msg = true;
    } else {
        $errors = $response;
?>
      <?php if ($errors) { ?>
        <script>
            var sweetAlert = <?php echo json_encode($errors); ?>;
            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'PUBLISH NOT SUCCESSFUL.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
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
    notifyWithToast('success', 'Publish successful');
</script> 
<?php endif; ?>
    <div class="form-control" style="width: 70%;" >
           <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                
                <div class="form-group">
                <label for="title">Title</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Event Title" style="margin-top: 10px;" name="title" id="title">
                </div>

                <!-- <div class="form-group">
                <label for="time">Time</label>
                  <input type="time" class="form-control" id="exampleInputEmail1" placeholder="Event Time" style="margin-top: 10px;" name="time" id="time">
                </div> -->

                <!-- <div class="form-group">
                <label for="date">Date</label>
                  <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Event Date" style="margin-top: 10px;" name="date" id="date">
                </div> -->

                <!-- <div class="form-group">
                <label for="venue">Venue</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Event Venue" style="margin-top: 10px;" name="venue" name="venue">
                </div> -->

                <div class="form-group">
                <label for="body">Body</label>
                  <textarea name="body" id="body" class="form-control"  placeholder="Enter body of Event here..." style="width: 100%;resize: none;height: 300px;"></textarea>
                </div>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile04" name="pic">
                    <label class="custom-file-label dripicons-paperclip" for="inputGroupFile04">Attach a poster for this event</label>
                  </div>

                </div>
              
                <div class="text-center" style="margin-top: 8px;">
                    <a class="btn btn-success waves-effect waves-light" href="#content1" style="width: 100%;padding: 5px;font-size: 20px;">Publish Event</a>
                </div>

                <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Publish Event?</p></section><div class="btnn"><button type="submit" class="btn btn-primary bd-0" name="submit" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>
         </form>
      
      </div><!-- /.modal-content -->
      
      
      
      </div> <!-- end col -->
    </div>
      </div><!-- container -->
    </div><!-- slim-mainpanel -->

       
    <?php require_once 'inc/page-footer.inc.php'; ?>