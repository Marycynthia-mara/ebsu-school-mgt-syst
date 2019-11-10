<?php 
$pageTitle = "Manage Teacher";

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
$category = "teachers";
$counter = 0;
?>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

   <div class="section-wrapper" style="margin: 20px 0">
       <label class="section-title">Manage Teachers</label>
       <p class="mg-b-20 mg-sm-b-40">View teachers profile and edit teachers from here.</p>
       
       <?php 
       
       $results = fetch_column7('teachers');
       
       ?>

       <div class="table-wrapper">
           <table id="datatable1" class="table display responsive nowrap">
           <thead>
               <tr>
                <th class="wd-15p">#</th>
                <th class="wd-15p">Teachers Name</th>
                <th class="wd-15p">Username</th>
                <th class="wd-15p">Gender</th>
                <th class="wd-15p">Phone</th>
                <th class="wd-15p">Form Class</th>
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
              <td><?php echo ++$counter; ?></td>
              <td><a href="profile.php?user_id=<?php echo $teachers_id; ?>&category=<?php echo $category; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
              <td><a href="profile.php?user_id=<?php echo $teachers_id; ?>&category=<?php echo $category; ?>"><?php echo $username; ?></a></td>
              <td><?php echo $gender; ?></td>
              <td><?php echo $phone; ?></td>
              <td> <?php  if ($form_class == "NONE") {
                echo "NONE";
              }else{ ?>
                <?php $classes = fetch_class($form_class, 'classroom'); ?>
              <?php foreach ($classes as $class): 
              
                echo $classes['classroom_name'];
                  break;
              ?>
              <?php endforeach ?>
              <?php  } ?></td>
              <td><a href="edit-teachers.php?teacher_id=<?php echo $teachers_id; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>
           </tr>
       <?php }else{?>
               
           <?php
           foreach($results as $result):
               extract($result);
               ?>
               <tr>
                  <td><?php echo ++$counter; ?></td>
                  <td><a href="profile.php?user_id=<?php echo $teachers_id; ?>&category=<?php echo $category; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
                  <td><a href="profile.php?user_id=<?php echo $teachers_id; ?>&category=<?php echo $category; ?>"><?php echo $username; ?></a></td>
                  <td><?php echo $gender; ?></td>
                  <td><?php echo $phone; ?></td>
                  <td> <?php  if ($form_class == "NONE") {
                    echo "NONE";
                  }else{ ?>
                    <?php 
                          $classes = explode(',', $form_class);
                    ?>
                  <?php 
                  $counter = 0;
                  foreach ($classes as $class): 
                    $currentFormClass = fetch_class($classes[$counter], 'classroom') ;
                    echo $currentFormClass['classroom_name'] .' ';
                    $counter++;
                      // break;
                  ?>
                  <?php endforeach ?>
                  <?php  } ?></td>
                  <td><a href="edit-teachers.php?teacher_id=<?php echo $teachers_id; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>
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