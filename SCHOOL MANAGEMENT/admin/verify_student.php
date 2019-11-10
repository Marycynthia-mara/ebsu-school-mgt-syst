<?php 
$pageTitle = "Verify Student";

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
        <label class="section-title">Verify Student Pin Payment</label>
        <p class="mg-b-20 mg-sm-b-40">Verify Student's account here.</p>
        
        <?php 
        
        $results = fetch_column7('students');
        
        ?>

        <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
            <thead>
                <tr>
                <th class="wd-15p">Name</th>   
                <th class="wd-15p">Reg No</th>
                <th class="wd-15p">Approve / Disapprove</th>
                </tr>
            </thead>
            <tbody>

            <?php if(count($results) === count($results, COUNT_RECURSIVE)){ 
                extract($results);
                $counter = 0;
                ?>
            <tr>
            <td><?php echo ucfirst($surname) ." ". ucfirst($firstname)  ." ". ucfirst($lastname) ?></td>
                <td><?php echo $reg_no; ?></td>
                <td>
                    <div class="btn-demo">
                    <?php if($pin_status === false){ ?>
                    <?php }else{?>
                    <?php } ?>
                        <button class="btn btn-primary btn-sm mg-b-10" type="submit" name="verify<?php echo $counter ?>" style="margin-bottom:0;"><?php if($pin_status === 'false'){echo 'Approve';}else{echo 'Disapprove';} ?></button>
                    </div>
                </td>
            </tr>
        <?php }else{?>
                
            <?php
            $counter = 0;
            foreach($results as $result):
                extract($result);
                ?>
                <tr>
                    <td><?php echo ucfirst($surname) ." ". ucfirst($firstname)  ." ". ucfirst($lastname) ?></td>
                    <td><?php echo $reg_no; ?></td>
                    <td>
                        <div class="btn-demo">
                        <button class="btn btn-primary btn-sm mg-b-10" type="submit" name="verify<?php echo $counter ?>" style="margin-bottom:0;"><?php if($pin_status === 'false'){echo 'Approve';}else{echo 'Disapprove';} ?></button>
                        </div>
                    </td>
                </tr>

                <?php 
                    $verify = "verify".$counter;
                    if (isset($_POST[$verify])) {
                    if($pin_status === 'false'){ 
                        $result = update_table('students', 'pin_status', 'true', 'student_id', $student_id);
                    }else{
                        $result = update_table('students', 'pin_status', 'false', 'student_id', $student_id);
                    } 

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
                    notifyWithToast('success', 'Update Successful');

                    setTimeout(function refresh(){
		            window.location = 'verify_student.php';
	                }, 1000);
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