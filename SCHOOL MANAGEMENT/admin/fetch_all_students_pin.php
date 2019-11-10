<?php 
$pageTitle = "Students Pin Numbers";
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
$students_pin_numbers = fetch_all_students_pin_number();

?>


  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

   <div class="section-wrapper" style="margin: 20px 0">
       <label class="section-title">Students Pin Number</label>
       <p class="mg-b-20 mg-sm-b-40">View all student pin numbers and print from here.</p>
      

       <div class="table-wrapper">
           <table id="datatable1" class="table display responsive nowrap">
           <thead>
               <tr>
                  <th>S/N</th>
                  <th>Admission No</th>
                  <th>Full Name</th>
                  <th>Class</th>
                  <th>Serial Number</th>
                  <th>Pin Number</th>
              </tr>
           </thead>
           <tbody>

           <?php 
              $counter = 0;
               foreach ($students_pin_numbers as $students_pin_number) {
                 $counter++;
                   extract($students_pin_number);
                   if ($fees_paid == 'true') {
                       $fees_paid = "Paid";
                   }else{
                      $fees_paid = "Not Paid";
                   }                       
               ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $reg_no; ?></td>
                <td><?php echo $surname.' '.$firstname.' '.$lastname; ?></td>
                <td><?php echo $classroom_name; ?></td>
                <td><?php echo $serial_no; ?></td>
                <td><?php echo $pin ?></td>
            </tr>
       <?php }?>
               
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