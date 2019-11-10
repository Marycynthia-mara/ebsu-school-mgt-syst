<?php 
$pageTitle = "Manage Student";

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
$category = "students";
$counter = 0;
?>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

   <div class="section-wrapper" style="margin: 20px 0">
       <label class="section-title">Manage Students</label>
       <p class="mg-b-20 mg-sm-b-40">View student profile and edit student from here.</p>
       
       <?php 
       
       $results = fetch_column7('students');
       
       ?>

       <div class="table-wrapper">
           <table id="datatable1" class="table display responsive nowrap">
           <thead>
               <tr>
                <th class="wd-15p">S/N</th>
                <th class="wd-15p">Student Name</th>
                <th class="wd-15p">Student Reg No</th>
                <th class="wd-15p">Class</th>
                <th class="wd-15p">Edit</th>
                <th class="wd-15p">Lost Password</th>
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
              <td><a href="profile.php?user_id=<?php echo $student_id; ?>&category=<?php echo $category; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
              <td><a href="profile.php?user_id=<?php echo $student_id; ?>&category=<?php echo $category; ?>"><?php echo $reg_no ?></a></td>
              <?php if ($class !== ""){ ?>
                <?php $classes = fetch_class($class, 'classroom'); ?>
              <td><?php foreach ($classes as $class): 
                  echo $classes['classroom_name'];
                  break;
              ?>
                
              <?php endforeach ?></td>
              <?php }else{ ?>
                
              <td>
                None
              </td>
              <?php } ?>
              <td><a href="edit-student.php?stud_id=<?php echo $student_id; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>
           </tr>
       <?php }else{?>
               
           <?php
           foreach($results as $result):
               extract($result);
               ?>
               <tr>
                  <td style="width:30px;"><?php echo ++$counter; ?></td>
                  <td><a href="profile.php?user_id=<?php echo $student_id; ?>&category=<?php echo $category; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
                  <td><a href="profile.php?user_id=<?php echo $student_id; ?>&category=<?php echo $category; ?>"><?php echo $reg_no ?></a></td>
                  <?php if ($class !== ""){ ?>
                    <?php $classes = fetch_class($class, 'classroom'); ?>
                  <td><?php foreach ($classes as $class): 
                      echo $classes['classroom_name'];
                      break;
                  ?>
                    
                  <?php endforeach ?></td>
                  <?php }else{ ?>
                    
                  <td>
                    None
                  </td>
                  <?php } ?>
                  <td><a href="edit-student.php?stud_id=<?php echo $student_id; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>

                  <td style="text-align: center;"><a href="edit-students-password.php?stud_id=<?php echo $student_id; ?>"><i class="fa fa-key" title="Recover Password"></i> </a> </td>
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