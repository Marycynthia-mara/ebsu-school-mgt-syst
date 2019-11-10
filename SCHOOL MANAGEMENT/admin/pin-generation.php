<?php 
$pageTitle = "All Geneerated Pins";
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
if(isset($_POST['submit'])){
    extract($_POST);
    if(isset($no_of_pins) && $no_of_pins !== '' && is_numeric(intval($no_of_pins)) ){
        $result = generate_pin($no_of_pins);    
        
        if($result === true){
            echo "<script>alert('Pin(s) succesfully generated.')</script>";
        }else{
            // var_dump($no_of_pins);
            echo "<script>alert('Ooops! something went wrong, Pin(s) not successfully Generated.')</script>";
        }
    
    }else{
        echo "<script>alert('Enter the number of pin(s) to generate.')</script>";
    }
}

if(isset($_POST['delete'])){
        $result = delete_all_records('all_pin_code');
        
        if($result === true){
            $msg = true;
        }else{
            $msg2 = true;
        }
}

$students_pin_numbers = fetch_column3('all_pin_code', 'pin_id');

?>

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
    notifyWithToast('success', "All Pin(s) succesfully Deleted");
    
    setTimeout(function refresh(){
		window.location = 'pin-generation.php';
	}, 2000);

</script> 
<?php endif; ?>


<?php if ( isset($msg2
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
    notifyWithToast('success', "Ooops! something went wrong, Pin(s) not successfully Deleted");
    
    setTimeout(function refresh(){
		window.location = 'pin-generation.php';
	}, 2000);

</script> 
<?php endif; ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

   <div class="section-wrapper" style="margin: 20px 0">
       <label class="section-title">All Geneerated Pins</label>
       <p class="mg-b-20 mg-sm-b-40">All Generated student pin numbers and serial numbers.</p>
      
       <div class="col-lg-4 mg-t-20 mg-lg-t-0">
       <div class="input-group" style="margin-bottom:30px;">
         <input type="text" class="form-control" name="no_of_pins" placeholder="Enter No of pins to generate">
         <div class="input-group-append">
            <a class="btn btn-primary" href="#content1"  style="margin-bottom:0;">Submit</a>
         </div>
       </div><!-- input-group -->
       <a class="btn btn-primary" href="#content2"  style="margin-bottom:30px;">Delete All pins</a>
     </div><!-- col-4 -->


       <div class="table-wrapper">
           <table id="datatable1" class="table display responsive nowrap">
           <thead>
               <tr>
                  <th>S/N</th>
                  <th>Pin Id</th>
                  <th>Serial Number</th>
                  <th>Pin Number</th>
              </tr>
           </thead>
           <tbody>

           <?php 
              $counter = 0;
              if($students_pin_numbers != ''){
               foreach ($students_pin_numbers as $students_pin_number) {
                 $counter++;
                   extract($students_pin_number);
               ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $pin_id; ?></td>
                <td><?php echo $serial_number; ?></td>
                <td><?php echo $pin_code ?></td>
            </tr>
       <?php }}?>
               
           </tbody>
           </table>
       </div><!-- table-wrapper -->
   </div><!-- section-wrapper -->  
   
   <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Generate Pin?</p></section><button class="btn btn-primary bd-0" type="submit" name="submit">Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

     <div class="special_action_confirm"><div id="content2" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Delete All Pins?</p></section><button class="btn btn-primary bd-0" type="submit" name="delete">Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

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