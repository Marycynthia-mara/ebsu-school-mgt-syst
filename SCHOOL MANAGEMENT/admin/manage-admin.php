<?php 
$pageTitle = "Manage Admin";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 

$category = "administrators";
$counter = 0;
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

   <div class="section-wrapper" style="margin: 20px 0">
       <label class="section-title">Manage an Admin</label>
       <p class="mg-b-20 mg-sm-b-40">View Admin profile and edit admin from here.</p>
       
       <?php 
       
       $results = fetch_column7('administrators');
       
       ?>

       <div class="table-wrapper">
           <table id="datatable1" class="table display responsive nowrap">
           <thead>
               <tr>
               <th class="wd-15p">#</th>
               <th class="wd-15p">Admins Name</th>   
               <th class="wd-15p">Username</th>
               <th class="wd-15p">Gender</th>
               <th class="wd-15p">Phone</th>
               <th class="wd-15p">Edit</th>
               </tr>
           </thead>
           <tbody>

           <?php 
           if($results !== false){
           if(count($results) === count($results, COUNT_RECURSIVE)){ 
               extract($results);
               ?>
           <tr>
           <?php if($admin_rank === 'third' or $admin_rank === 'second'): ?>

                <td><?php echo ++$counter; ?></td>
                <td><a href="profile.php?user_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
                <td><a href="profile.php?user_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><?php echo $username; ?></a></td>
                <td><?php echo $gender; ?></td>
                <td><?php echo $phone; ?></td>
                <td><a href="edit-admin.php?admin_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>

           <?php endif; ?>
              
           </tr>
       <?php }else{?>
               
           <?php
           foreach($results as $result):
               extract($result);
               ?>
               <tr>
               <?php if($admin_rank === 'third' or $admin_rank === 'second'): ?>
               
                    <td><?php echo ++$counter; ?></td>
                    <td><a href="profile.php?user_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
                    <td><a href="profile.php?user_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><?php echo $username; ?></a></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $phone; ?></td>
                    <td><a href="edit-admin.php?admin_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>
    
                <?php endif; ?>
               </tr>

           <?php endforeach; }
        }?>

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