<?php 
$pageTitle = "Form Teacher's Comment";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'staff') {
    redirect_to("dashboard.php");
}

if (!(isset($_SESSION['exam_term_comt']) AND isset($_SESSION['Class_comt']) AND isset($_SESSION['AC_year_comt']))){
    redirect_to("result_comment.php");
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
                <h2 class="title">Comment on Students Result</h2>
                <?php $classroom = fetch_class($form_class, 'classroom') ?>
                <h2 class="title"><?php echo $classroom['classroom_name']; ?></h2>
            
            </div>
            
            <!-- /.col-md-6 text-right -->
        </div>
    </div>
    <!-- /.container-fluid -->

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
                                    <!-- <th>Select</th> -->
                                    <th>Student Name</th>
                                    <th>Comment result</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <!-- <th>Select</th> -->
                                    <th>Student Name</th>
                                    <th>Comment result</th>
                                </tr>
                            </tfoot>

                            <?php   
                                
                            if ($_SESSION['exam_term_comt'] === "first" or $_SESSION['exam_term_comt'] === "second") {

                            
                                $results = fetch_stud_result('exam_result', $_SESSION['Class_comt'], $_SESSION['exam_term_comt'], $_SESSION['AC_year_comt']);

                            }if ($_SESSION['exam_term_comt'] === "third"){

                                $results = fetch_stud_result2('annual_result', $_SESSION['Class_comt'], $_SESSION['AC_year_comt']);
                                    
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
                                    
                                    <td><a href=""><?php echo ucfirst($each_Stud['firstname']) .' '. ucfirst($each_Stud['lastname']) .' '. ucfirst($each_Stud['surname']);?></a></td>
                            
                                    <td><a href="<?php if ($_SESSION['exam_term'] === 'first' or $_SESSION['exam_term'] === 'second' ): ?>
                                    stud_result_sheet.php?stud_id=<?php echo $each_Stud['student_id']; ?>
                                    <?php endif ?>

                                    <?php if($_SESSION['exam_term'] === 'third'): ?>
                                    stud_result_annual_sheet.php?stud_id=<?php echo $each_Stud['student_id']; ?>
                                    <?php endif ?>"><i class="fa fa-edit" title="Comment result"></i> </a> </td>
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
     

<?php require_once 'inc/page-footer.inc.php'; ?>
  </body>
</html>