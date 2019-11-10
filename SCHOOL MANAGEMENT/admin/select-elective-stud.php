<?php 
$pageTitle = "Select Students";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] === 'student') {
    redirect_to("dashboard.php");
}

if (!(isset($_SESSION['exam_term']) AND isset($_SESSION['Class']) AND isset($_SESSION['AC_year']) AND isset($_SESSION['Subject'])) AND $_SESSION['category'] === 'staff' ){
    redirect_to("result_fetch.php");
}

if (!(isset($_SESSION['exam_term']) AND isset($_SESSION['Class']) AND isset($_SESSION['AC_year']) AND isset($_SESSION['Subject'])) AND $_SESSION['category'] === 'admin' ){
    redirect_to("result_fetch_admin.php");
}  

require_once 'inc/page-header.inc.php'; 
?>

<?php 

$category = "students";
 
?>
  
    </head>
<body class="top-navbar-fixed">
<div class="main-wrapper">

<div class="main-page">
    <div class="container-fluid">
        <div class="row page-title-div">
            <div class="col-md-6">
                <h2 class="title">Select Student(s) to enter scores for</h2>
                <?php $classroom = fetch_class($_SESSION['Class'], 'classroom') ?>
                <h2 class="title"><?php echo $classroom['classroom_name'] .' '. $classroom['academic_year']; ?></h2>
            
            </div>
            
            <!-- /.col-md-6 text-right -->
        </div>
    </div>
    <!-- /.container-fluid -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<section class="section">
    <div class="container-fluid">

    <div class="row">
        
    </div>

        <div class="row">
            <div class="col-md-12">

                <div class="panel">
                    <div class="panel-body p-20">

                        <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                    <div class="stud_column-1">
                                        <input  class="form-control" type="checkbox" name="checkAll" id="checkAll" >
                                    </div>
                                    Select Students</th>
                                    <th>Student Name</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Select Students</th>
                                    <th>Student Name</th>
                                </tr>
                            </tfoot>

                            <?php   
                                
                            if ($_SESSION['exam_term'] === "first" or $_SESSION['exam_term'] === "second") {

                            
                                $results = fetch_stud_result('exam_result', $_SESSION['Class'], $_SESSION['exam_term'], $_SESSION['AC_year']);

                            }if ($_SESSION['exam_term'] === "third"){

                                $results = fetch_stud_result2('annual_result', $_SESSION['Class'], $_SESSION['AC_year']);
                                    
                            }

                            $counter = 0;
                            ?>

                            <?php
                            $students = [];

                                if(is_array($results)){
                                    foreach ($results as $result): 
                                        if (in_array($result['student_id_fk'], $students)) {
                                        # do nothing...
                                        }else{
                                        $students[] = $result['student_id_fk'];
                                        }
                            ?>

                                    <?php endforeach; } ?>

                            <?php 
                            $count = 0;
                            foreach ($students as $student): 
                            $each_Stud = fetch_students($students[$count], 'students', 'student_id');
                            
                            ?>
                                <tbody id="tbody1">
                                <tr>
                                    <td><?php echo ++$counter; ?></td>
                                    
                                    <!-- <td><a href="<?php if ($_SESSION['exam_term'] === 'first' or $_SESSION['exam_term'] === 'second' ): ?>
                                    stud_result_sheet.php?stud_id=<?php echo $each_Stud['student_id']; ?>
                                    <?php endif ?>

                                    <?php if($_SESSION['exam_term'] === 'third'): ?>
                                    stud_result_annual_sheet.php?stud_id=<?php echo $each_Stud['student_id']; ?>
                                    <?php endif ?>"><i class="fa fa-edit" title="Comment result"></i> </a> </td> -->

                                    <td>
                                        <div class="stud_column-1">
                                            <input  class="form-control" type="checkbox" name="stud_id[]" value="<?php echo $each_Stud['student_id'];  ?>">
                                        </div>
                                        <?php echo $each_Stud['reg_no'];  ?>
                                    </td>

                                    <td><a href=""><?php echo ucfirst($each_Stud['firstname']) .' '. ucfirst($each_Stud['lastname']) .' '. ucfirst($each_Stud['surname']);?></a></td>
                            
                                </tr>
                                </tbody>
                            <?php 
                            $count++;
                            endforeach ?>

                                
                            
                            
                        </table>
                        <!-- /.col-md-12 -->
                    </div>
                </div>

                <div class="row pagination-section" style="margin: 0 auto">
                        
                        <div class="col-xs-4 col-md-4 col-lg-2 col-md-offset-1 col-lg-offset-3 text-center vspacer-lg"></div>
                        <!-- <button class="btn btn-primary">Edit</button> -->
            </div>
            </div>

            <!-- /.col-md-6 --> 
            </div>
            <!-- /.col-md-12 -->
        </div>
    </section>
    <!-- /.section -->
</div>
    <!-- /.panel -->

    <a class="btn btn-primary bd-0" href="#content1">GO</a>

    <div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to update or upload scores for the selected students</p></section><div class="btnn"><button type="submit" name="submit">Proceed</button><button class="">Cancel</button><br></div></form></div></div></div></div>

</form>

    <?php 
        if(isset($_POST['submit'])){

            if (!empty($_POST['stud_id'])) {
                // $_SESSION['stringsOfStudsIds'] = implode(',', $_POST['stud_id']);
                $_SESSION['elective_stud'] = $_POST['stud_id'];

                  if ($_SESSION['exam_term'] == 'first' or $_SESSION['exam_term'] == 'second'){
                  redirect_to('subject_upload.php');
                }

                if ($_SESSION['exam_term'] == 'third'){
                  redirect_to('subject_upload_annual.php');
                }

            }else{
              $errors['elective_stud'] = true;
            }

        }
    ?>

<?php if ( isset($errors['elective_stud'])): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: True,
            timer: 5000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('error', 'Select Student(s) to enter result for.');
</script> 
<?php endif; ?>


<script>
 $(document).ready(function () {
   var checkAll = document.getElementById('checkAll');
   $('#checkAll').click(function () {
    if ($('#checkAll').attr("checked", false)) {
      $(':checkbox').attr("checked", true);
    }else{
     $(':checkbox').attr("checked", false);
    }
   });
 })
</script>


<?php require_once 'inc/page-footer.inc.php'; ?>
  </body>
</html>