<?php 
$pageTitle = "Verify Admin";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 
?>

   
 <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
 
    <div class="section-wrapper" style="margin: 20px 0">
        <label class="section-title">Verify Admin</label>
        <p class="mg-b-20 mg-sm-b-40">Verify Admin's account here.</p>
        
        <?php 
        
        $results = fetch_column7('administrators');
        
        ?>

        <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
            <thead>
                <tr>
                <th class="wd-15p">Name</th>   
                <th class="wd-15p">Email</th>
                <th class="wd-15p">Verify</th>
                </tr>
            </thead>
            <tbody>

            <?php if(count($results) === count($results, COUNT_RECURSIVE)){ 
                extract($results);
                ?>
            <tr>

                <?php if($admin_rank === 'third' or $admin_rank === 'second'): ?>

                <td><?php echo ucfirst($firstname) ." ". ucfirst($lastname)  ." ". ucfirst($surname) ?></td>
                <td><?php echo $email; ?></td>
                <td>
                    <div class="btn-demo">
                        <button class="btn btn-primary btn-sm mg-b-10" style="margin-bottom:0;">Verify</button>
                    </div>
                </td>

            <?php endif; ?>
                
            </tr>
        <?php }else{?>
                
            <?php
            $counter = 0;
            foreach($results as $result):
                extract($result);
                ?>
                <tr>
                    <?php if($admin_rank === 'third' or $admin_rank === 'second'): ?>
                        <td><?php echo ucfirst($firstname) ." ". ucfirst($lastname)  ." ". ucfirst($surname) ?></td>
                        <td><?php echo $email; ?></td>
                        <td>
                            <div class="btn-demo">
                                <button class="btn btn-primary btn-sm mg-b-10" type="submit" name="verify<?php echo $counter ?>" >Verify</button>
                                <!-- <a class="btn btn-primary btn-sm mg-b-10" href="#content<?php echo $counter ?>" style="margin-bottom:0;">Verify</a> -->
                            </div>
                        </td>

                    <?php endif; ?>
                
                </tr>
                
                <div class="special_action_confirm"><div id="content<?php echo $counter ?>" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Verify this Admin ?</p></section><div class="btnn"><button class="btn btn-primary bd-0" type="submit" name="verify<?php echo $counter ?>" >Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

                <?php 
                    $verify = "verify".$counter;
                    if (isset($_POST[$verify])) {

                        $category = "administrators";
                        $result = verify_user($firstname, $email, $lastname,$category);
                        if ($result === true) {
                        $msg = true;
                    } else {
                        $errors = $result;
                ?>
                      <?php if ($errors) { ?>
                        <script>
                            var sweetAlert = <?php echo json_encode($errors); ?>;
                            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'MAIL NOT SENT.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
                            var i;
                            var timer = 0;
                            for(i in sweetAlert){
                                sweetAlert[i] = '<p style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</p>';
                            allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
                            timer += + 3;
                            }
                
                    function notifyWithToast(type, message, timer) {
                        var duration = timer * 3000;
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
                    notifyWithToast('success', 'Mail Sent');
                </script> 
                <?php endif; ?>



            <?php 
             $counter++; 
             endforeach; }?>

            </tbody>
            </table>
        </div><!-- table-wrapper -->
    </div><!-- section-wrapper -->     
 
 </form> 



        <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
       
    <?php require_once 'inc/page-footer.inc.php'; ?>