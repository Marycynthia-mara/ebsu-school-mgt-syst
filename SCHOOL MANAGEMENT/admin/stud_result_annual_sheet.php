 <?php 
 require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
  redirect_to("index.php");
}
if ($_SESSION['category'] !== 'staff') {
    redirect_to("dashboard.php");
}

if (!(isset($_GET['stud_id']) AND isset($_SESSION['exam_term_comt']) AND isset($_SESSION['Class_comt']) AND isset($_SESSION['AC_year_comt']))){
  redirect_to("result_comment.php");
}else{
$stud_id = $_GET['stud_id'];
}

$student = fetch_students($stud_id, 'students', 'student_id');
if($student){
  extract($student);
}else{
  redirect_to('dashboard.php');
}

$classes = fetch_class($class, 'classroom');

$term_dates = fetch_column4('id', 'term_dates', '1');
extract($term_dates);

    $results = fetch_stud_result4('annual_result', $_SESSION['Class_comt'], $_SESSION['AC_year_comt'], $stud_id);

    $no_of_studs = fetch_stud_result2('annual_result', $_SESSION['Class_comt'], $_SESSION['AC_year_comt']);
        
$stud_no = 0;
$studInClass = [];
foreach ($no_of_studs as $no_of_stud) {
  if (in_array($no_of_stud['student_id_fk'], $studInClass)) {
    // do nothing
  }else{
    $studInClass[] = $no_of_stud['student_id_fk'];
    $stud_no++;
  }
  // var_dump($studInClass);
}

  $stud_cls = $_SESSION['Class_comt'];
    $stud_term = $_SESSION['exam_term_comt'];
    $stud_year = $_SESSION['AC_year_comt'];
  $comment = fetch_column6($stud_id, $stud_term, $stud_year, $stud_cls);
  if ($comment) {
    $tea_comt = true;
  }else{
    $tea_comt = false;
  }

  if ($_SESSION['exam_term_comt'] === "third") {
    $positionArray = [];
    foreach ($studInClass as $positionMatch) {
      
      $curr_Stud_subSores = fetch_stud_result4('annual_result', $_SESSION['Class_comt'], $_SESSION['AC_year_comt'], $positionMatch);
      $overAllStudTtotal = 0;
      
      foreach ($curr_Stud_subSores as $curr_Stud_subSore) {

        if(is_array($curr_Stud_subSore)){
					$total = intval($curr_Stud_subSore['total_over_300']);
          $overAllStudTtotal+= $total;
				}else{
					echo "<script>alert('This student do not have enough record to comment on result yet')</script>";
					redirect_to('form-cls-stud-res.php');
				}
      }
      $positionArray[$positionMatch] = $overAllStudTtotal;
    }

    arsort($positionArray);//sorting the student array to make higher score come up

    $newStudents = array(); //an array to hold the sorted students and scores with position
    $pos = 0; //initialising position collector
    $count = 0; // initialising counter
    $holder = -1; // Assuming no negative scores.
    foreach($positionArray as $k=>$v){
        $count++;
        if($v < $holder || $holder == -1){ //checking scores and holder for negative value;
            $holder = $v;//assigning the student scores to holder
            $pos = $count;//assigning the student at each scores the current counter as position;
        }

        $newStudents[] = makeStudent($pos, $v, $k);//calling the function to make student id the array key.
        
    }

    $newStudents = fixLast($newStudents);//calling a function that will get students id, scores and position
    // var_dump($newStudents);

    foreach ($newStudents as $newStudent) {
      if ($newStudent->id == $stud_id) {
        $position = $newStudent->position;
        
      }
    }
    if (strlen($position) === 1) {
      if ($position === 1) {
        $positionExt = "st";
      }else if ($position === 2) {
        $positionExt = "nd";
      }else if ($position === 3) {
        $positionExt = "rd";
      }else {
        $positionExt = "th";
      }
    }else{
      if ($position >= 10 and $position <= 20) {
        $positionExt = "th";
      }else{
        if (substr($position, -1) === "1") {
        $positionExt = "st";
        }else if (substr($position, -1) === "2") {
          $positionExt = "nd";
        }else if (substr($position, -1) === "3") {
          $positionExt = "rd";
        }else {
          $positionExt = "th";
        }
      }
    }
}
 ?>


<!DOCTYPE html>
<html>
<head>
  <title>Result Sheet</title>
  <link rel="stylesheet" type="text/css" href="css/result.css">
  <link rel="stylesheet" type="text/css" href="css/special_action_confirm_style.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
  <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="container">
<form method="post" action="<?php echo "stud_result_annual_sheet.php?stud_id=$stud_id" ?>">



  <header>
    <img src="img/logo_name2.png" alt="School Logo">
    <h2>EBONYI STATE UNIVERSITY, ABAKALIKI</h2>
    <h1>STAFF SECONDARY SCHOOL</h1>
    <h4>CONTINUOUS ASSESSMENT FOR <?php echo strtoupper($_SESSION['exam_term_comt']) ?> TERM </h4>


    <table>
      <tr>
        <td>Student Name : </td>
        <td><input type="text" readonly="" name="" value="<?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?>"></td>
        <td>Class : </td>
        <td><input type="text" readonly="" name="" value="<?php echo $classes['classroom_name']; ?>"></td>
        <td>Year : </td>
        <td><input type="text" readonly="" name="" value="<?php echo $classes['academic_year']; ?>"></td>
      </tr>
    </table>
  </header>


  <div class="topResult">

    <table class="attendance">
      <caption>ATTENDANCE RECORD</caption>
        <tr>
          <td class="justified">No. of times School Opened</td>
          <td class="numberInput"><input type="text" name="" readonly="" value="<?php echo $total_term_days; ?>"></td>
        </tr>
        <tr>
          <td class="justified">No. of times Present</td>
          <td class="numberInput"><input type="text" name="student_attd_pre" <?php if($tea_comt){
            // echo "readonly";
          } ?> value="<?php if($tea_comt){
            echo $comment['student_attd_pre'];
          } ?>"></td>
        </tr>
        <tr>
          <td class="justified">No. of times Absent</td>
          <td class="numberInput"><input type="text" name="student_attd_abs" <?php if($tea_comt){
            // echo "readonly";
          } ?> value="<?php if($tea_comt){
            echo $comment['student_attd_abs'];
          } ?>"></td>
        </tr>
    </table>

    <table class="attendance term">
      <caption>TERM INFORMATION</caption>
        <tr>
          <td class="justified">Admission No.</td>
          <td class="textInput"><input type="text" name="" readonly="" value="EBSU/<?php echo substr($student['reg_no'], 0, 4) ?>"></td>
        </tr>
        <tr>
          <td class="justified">Term Ended</td>
          <td class="textInput"><input type="text" name="" readonly="" value="<?php echo $term_end; ?>"></td>
        </tr>
        <tr>
          <td class="justified">Next Term Begins</td>
          <td class="textInput"><input type="text" name="" readonly="" value="<?php echo $term_start; ?>"></td>
        </tr>
    </table>


  </div>

<div class="mainResult">
    <table>
      <caption>COGNITIVE DOMAIN</caption>
      <tr>
        <th rowspan="2" class="serialNum">S/N</th>
        <th rowspan="2" class="subjectName">SUBJECT</th>
        <th class="rotate">Contineous Assessment Score</th>
        <th class="rotate">Examination Score</th>
        <th class="rotate">Total Score</th>
        <th class="rotate">First & Second Term Total</th>
        <th class="rotate">First, Second & Third Term Total</th>
        <th class="rotate" style="">First, Second & Third Term Total %</th>
        <th class="rotate" rowspan="2">Grade</th>
        <!-- <th class="rotate" rowspan="2">Edit Row</th> -->
        <th rowspan="2" class="subjectTeacherComment">SUBJECT TEACHER'S COMMENT</th>
      </tr>

      <tr>
        <td><input type="text" name="" value="30" disabled></td>
        <td><input type="text" name="" value="70" disabled></td>
        <td><input type="text" name="" value="100" disabled></td>
        <td><input type="text" name="" value="200" disabled></td>
        <td><input type="text" name="" value="300" disabled></td>
        <td><input type="text" name="" value="100" disabled></td>
      </tr>


      <?php

      $totalScore = 0;
      $aveScore = 0;
      $counter = 0;

      ?>
      <?php foreach ($results as $result): ?>
      <?php extract($result) ;
      $subject_name = fetch_column4('subject_id', 'subjects', $subject_id_fk);
      $totalScore+= $total;
      $aveScore+= $total_in_percent;
      ?>  
      <tr class="Accounting">
        <td class="justified">
          <input type="hidden" name="serial_no<?php echo $counter; ?>" value="<?php echo $counter; ?>"><?php echo $counter; ?></td>

        <td class="justified"><?php echo ucwords($subject_name['subject_name']) ?></td>

        <td class="numberInput">
          <input type="text" value="<?php echo $asst_total ?> " name="" readonly >
        </td>

        <td class="numberInput">
          <input type="text" value="<?php echo $exam_total ?> " name="" readonly>
        </td>

        <td class="numberInput">
          <input type="text" value="<?php echo $total_over_100 ?> " name="" readonly>
        </td>

        <td class="numberInput">
          <input type="text" value="<?php echo $total_over_200 ?> " name="" readonly>
        </td>

        <td class="numberInput">
          <input type="text" value="<?php echo $total_over_300 ?> " name="" readonly>
        </td>

        <td class="numberInput">
          <input type="text" value="<?php echo $total_in_percent ?> " name="" readonly>
        </td>

        <td class="numberInput">
          <input type="text" value="<?php echo $grade ?> " name="" readonly>
        </td>

        <td >
          <input class="justified" type="text" value="<?php echo $sub_teacher_comt ?> " name="" readonly>
        </td>
      </tr>
      <?php
      $counter++; 
      endforeach ?>
    </table>



    <table>
      <tr>
        <td class="justified">GRADING SCALE</td>
        <td class="justified">80-100 = A (Excellent)</td>
        <td class="justified">70-79 = B (Very Good)</td>
        <td class="justified">60-69 = C (Good)</td>
        <td class="justified">50-59 = D (Credit)</td>
        <td class="justified">40-49 = E (Fair)</td>
        <td class="justified">0-39 = F (Fail)</td>
        </tr>
    </table>
  </div>

<div class="resultSum">
  <table>
    <tr>
      <td>Total : </td>
      <td><input type="text" class="totalScore" id="total" readonly="" value="<?php echo $totalScore ?>"></td>
      <td>Average: </td>
      <?php 
      $totalScore = intval($totalScore);
      $average = $aveScore/$counter."%";
       ?>
      <td><input type="text" name="" id="average" readonly="" value="<?php echo $average; ?>"></td>
      <td>No. of Students: </td>
      <td><input type="text" name="" readonly="" value="<?php echo $stud_no ?>"></td>
      <td>Position : </td>
      <td><input type="text" readonly="" name="position" id="position" value="<?php echo $position.$positionExt?>"></td>
    </tr>
    <tr >
       <td>Decision: </td>
      <td><input style="margin-top: 20px;" type="text" <?php if($tea_comt){
        // echo "readonly";
      } ?> name="decision" id="decision" value="<?php if($tea_comt){
            echo $comment['decision'];
          } ?>"></td>
          
    </tr>
  </table>

  <table>
    <tr>
      <td>Class Teacher's Comment : </td>
      <td><textarea style="width: 100%;" <?php if($tea_comt){
        // echo "readonly";
      } ?> name="teachers_comment"><?php if($tea_comt){
            echo $comment['teachers_comment'];
          } ?></textarea></td>
      <td style="border:none; width: 4em; vertical-align: bottom;">Date : </td>
      <td style="border:none; border-bottom: 1px solid #000; width: 8em;"><input type="date" <?php if($tea_comt){
        // echo "readonly";
      } ?> name="teachers_comt_date" value="<?php if($tea_comt){
            echo $comment['teachers_comt_date'];
          } ?>"></td>
    </tr>
  </table>



    <table> 
      <tr> 
        <td style="border: none; width: 4em; vertical-align: bottom;">Principal's Comment : </td> 
        <td style="border:none; border-bottom: 1px solid #000; width: 20em;"><input type="text" name="" <?php if($_SESSION['category'] == "staff"){
        echo "readonly";
      } ?> style="text-align: justify;  padding-left: 5px;"></td>
        <td style="border:none; width: 3em; vertical-align: bottom;">Signature : </td> 
        <td style="border:none; width: 3em;"><img src="img/p_sign.PNG"></td> 
        <td style="border:none; width: 3em; vertical-align: bottom;">Date : </td> 
        <td style="border:none; border-bottom: 1px solid #000; width: 5em;"><input <?php if($_SESSION['category'] == "staff"){
        echo "readonly";
      } ?> type="date" name=""></td> 
      </tr>
</table> 


</div>


<button class="back"><a class="" href="#content1">Upload Comment</a></button>
<button class="back"><a href="form-cls-stud-res.php"><- Back</a></button>


<div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to Upload Comment?</p></section><div class="btnn"><button type="submit" name="submit">Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>

<?php
 if (isset($_POST['submit'])) {
  extract($_POST);
    $result = val_fetch_form4($_POST);

    if ($result === true) {
      $msg = true;   
    }else {
        $errors = $result;
      
?>
      <?php if ($errors) { ?>
        <script>
            var sweetAlert = <?php echo json_encode($errors); ?>;
            var allAlerts = '<p style="color:#F27474;text-align:center;"><b>' + '<h4 style="text-align:center;color:#F27474;">' + 'UPLOAD NOT SUCCESSFUL.' + '</h4>'  + '<br>' + 'Read the below stated issue(s).' + '</b></p>';
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
    notifyWithToast('success', 'Upload successful');

    setTimeout(function refresh(){
		window.location = 'stud_result_annual_sheet.php?stud_id=<?php echo $stud_id?>';
	}, 1000);

</script> 
<?php endif; ?>


</form>
</div>
</body>
</html> 