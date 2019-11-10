<?php require_once 'inc/config.inc.php'; ?>

<?php 

if ($_SESSION['category'] === 'student') {
    redirect_to("dashboard.php");
}

if (!isset($_SESSION['sub-stud-fetch'])) {

	if ($_SESSION['category'] === 'admin') {
		redirect_to("result_fetch_admin.php");
	}
	
	if ($_SESSION['category'] === 'staff') {
		redirect_to("result_fetch.php");
	}
} 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Result Sheet</title>
	<link rel="stylesheet" type="text/css" href="css/result2.css">
	<link rel="stylesheet" type="text/css" href="css/special_action_confirm_style.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
	<script src="lib/jquery/js/jquery.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>

</head>
<body>
<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

	<header>
		<img src="img/logo_name2.png" alt="School Logo">
		<h2>EBONYI STATE UNIVERSITY, ABAKALIKI</h2>
		<h1>STAFF SECONDARY SCHOOL</h1>
		<h4>CONTINUOUS ASSESSMENT FOR 
			<?php echo strtoupper($_SESSION['exam_term']) ?> 
			TERM 
			<?php echo strtoupper($_SESSION['AC_year']); 
			echo(" ");
			$class = fetch_class($_SESSION['Class'], 'classroom') ;
			echo(strtoupper($class['classroom_name']));
			?> </h4>
		<h4><?php $subj = fetch_subject($_SESSION['Subject'], 'subjects'); 
				echo(strtoupper($subj['subject_name']));	
		?></h4>
	</header>

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
				<th class="rotate">First, Second & Third Term Total %</th>
				<th class="rotate" rowspan="2">Grade</th>
				<th class="rotate" rowspan="2">Edit Row</th>
				<th rowspan="2" class="subjectTeacherComment">SUBJECT TEACHER'S COMMENT</th>
			</tr>

			<tr>
				<td><input type="number" name="" value="30" disabled></td>
				<td><input type="number" name="" value="70" disabled></td>
				<td><input type="number" name="" value="100" disabled></td>
				<td><input type="number" name="" value="200" disabled></td>
				<td><input type="number" name="" value="300" disabled></td>
				<td><input type="number" name="" value="100" disabled></td>
			</tr>


			<?php $subjects =  $_SESSION['sub-stud-fetch'];
			$looper = 0; 
			$counter = 1;
			?>
			<?php foreach ($subjects as $subject): 
			if(in_array($subject['student_id'], $_SESSION['elective_stud'])):
				
				$subject_id_fk = $_SESSION['Subject'];
				$student_class_id_fk = $_SESSION['Class'];
				$term = $_SESSION['exam_term'];
				$ACyear = $_SESSION['AC_year'];
				$curr_student = $subject['student_id'];
				$dub_result = check_duplicate_record2('annual_result', $student_class_id_fk, $subject_id_fk, $ACyear,$curr_student);
				
				if ($dub_result){
					$subjectscore = get_subjectscore2('annual_result', $subject_id_fk, $student_class_id_fk, $ACyear, $subject['student_id']);

					if($subjectscore){
						extract($subjectscore);
					}

				}
				
			?>
			<tr class="Accounting">
				<td class="justified">
					<input type="hidden" name="serial_no<?php echo $counter; ?>" value="<?php echo $counter; ?>"><?php echo $counter; ?></td>

				<td class="justified"><input type="hidden" name="student" value="<?php echo $subject['student_id'] ?>"><?php echo ucfirst($subject['surname']) .' ' . ucfirst($subject['firstname']) .' '. ucfirst($subject['lastname']) ?></td>

				<td class="numberInput">
					<input type="hidden" name="" id="FTST<?php echo $counter;  ?>" value="first<?php echo $counter;  ?>">
					<input type="number" value="<?php if(isset($subjectscore)){
						echo($asst_total);
					} ?>" name="CAS<?php echo $counter;  ?>"   class="sub<?php echo $counter;  ?>" onblur="calcTotal('FTST<?php echo $counter;  ?>', 'first<?php echo $counter;  ?>', 'second<?php echo $counter;  ?>', this, 'total<?php echo $counter;  ?>', 'firstSecond<?php echo $counter;  ?>', 'firstSecondThird<?php echo $counter;  ?>', 'overallTotal<?php echo $counter;  ?>', 'grade<?php echo $counter;  ?>')" onclick="makeInputReadonly(this)"></td>

				<td class="numberInput">
					<input type="hidden" name="" id="STST<?php echo $counter;  ?>" value="second<?php echo $counter;  ?>">
					<input type="number" value="<?php if(isset($subjectscore)){
						echo($exam_total);
					} ?>" name="EXS<?php echo $counter;  ?>"   class="sub<?php echo $counter;  ?>" onblur="calcTotal('STST<?php echo $counter;  ?>', 'first<?php echo $counter;  ?>', 'second<?php echo $counter;  ?>', this, 'total<?php echo $counter;  ?>', 'firstSecond<?php echo $counter;  ?>', 'firstSecondThird<?php echo $counter;  ?>', 'overallTotal<?php echo $counter;  ?>', 'grade<?php echo $counter;  ?>')" onclick="makeInputReadonly(this)"></td>

				<td class="totalScore"><input type="number" value="<?php if(isset($subjectscore)){
						echo($total_over_100);
					} ?>" name="TOS<?php echo $counter;  ?>" readonly="" class="totalScore" id="total<?php echo $counter;  ?>"></td>

				<td class="numberInput"><input type="number" value="<?php if(isset($subjectscore)){
						echo($total_over_200);
					} ?>" name="FSTT<?php echo $counter;  ?>" readonly=""  id="firstSecond<?php echo $counter;  ?>"></td>

				<td class="numberInput"><input type="number" value="<?php if(isset($subjectscore)){
						echo($total_over_300);
					} ?>" name="FSTTT<?php echo $counter;  ?>" readonly=""  id="firstSecondThird<?php echo $counter;  ?>"></td>

				<td class="totalScore"><input type="number" value="<?php if(isset($subjectscore)){
						echo($total_in_percent);
					} ?>" name="FSTTTP<?php echo $counter;  ?>" readonly="" class="totalScore" id="overallTotal<?php echo $counter;  ?>"></td>

				<td><input type="text" value="<?php if(isset($subjectscore)){
						echo($grade);
					} ?>" name="GRD<?php echo $counter;  ?>" readonly=""  id="grade<?php echo $counter;  ?>"></td>

				<td><button onclick="activateBtn(event, 'sub<?php echo $counter;  ?>', 'total<?php echo $counter;  ?>', 'firstSecond<?php echo $counter;  ?>', 'firstSecondThird<?php echo $counter;  ?>', 'overallTotal<?php echo $counter;  ?>', 'grade<?php echo $counter;  ?>')">EDIT</button></td>

				<td><input class="justified" type="text"  value="<?php if(isset($subjectscore)){
						echo($sub_teacher_comt);
					} ?>" name="STC<?php echo $counter;  ?>"></td>
			</tr>
			<?php 
			$_SESSION['first'.$counter] = getTermTotal($subject['student_id'],'first',$_SESSION['AC_year'],$_SESSION['Class'],$_SESSION['Subject']);

			$_SESSION['second'.$counter] = getTermTotal($subject['student_id'],'second',$_SESSION['AC_year'],$_SESSION['Class'],$_SESSION['Subject']);
			$counter++;
			$looper++;
			endif;
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


	<?php if($dub_result === true){?>
		<button class="back"><a class="" href="#content1">Update Scores</a></button>
	<?php }else{ ?>
		<button class="back"><a class="" href="#content1">Upload Scores</a></button>
	<?php }?>	

	<?php if($_SESSION['category'] == 'admin'){?>
		<button class="back"><a href="result_fetch_admin.php"><- Back</a></button>
	<?php }else{ ?>
		<button class="back"><a href="result_fetch.php"><- Back</a></button>
	<?php }?>

	


<div class="special_action_confirm"><div id="content1" class="popup-effect"><div class="popup"><div class="letter-w3ls"><form method="post"><h1 class="ebsu">EBSU STAFF SECONDARY SCHOOL ABAKALIKI.</h1><section><p>Are you sure you want to <?php if($dub_result === true){echo 'Update Upload';}else{echo 'Upload Upload';}?>?</p></section><div class="btnn"><button type="submit" name="submit">Proceed</button><button class="btn btn-primary bd-0">Cancel</button><br></div></form></div></div></div></div>


</form>
</div>
</body>



<script type="text/javascript">
	function makeInputReadonly(e){
		// alert('hi');
		if(e.value !== ""){
			e.setAttribute("disabled", "");
		}else{
			e.removeAttribute("disabled");
		}
	}

	function calcTotal(currElmt,FTST, STST, inputElement, totalField, firstSecond, firstSecondThird, overallTotal, grade){

		let data1 = null;
		let data2 = null;
		let result = {};
		
		$.ajax({
			url : 'process-score.php',
			type : 'post',
			async : false,
			data : "ftst="+FTST+"&stst="+STST,
			success : function(data) {
				result = JSON.parse(data);
				data1 = result.data1;
				data2 = result.data2;
			}
		})

		let first = parseInt(data1);
		let second = parseInt(data2);
		let score = parseInt(inputElement.value);
		let total = document.getElementById(totalField);
		let totalScore = total.value;
		let first_second = document.getElementById(firstSecond);
		let first_second_third = document.getElementById(firstSecondThird);
		let overall = document.getElementById(overallTotal);
		let grading = document.getElementById(grade);


		if (isNaN(score)){
			score = 0;
			totalScore = parseInt(totalScore);
			total.value = eval(totalScore + score);
		}

		if (totalScore == "" || isNaN(totalScore)){
			totalScore = 0;
			totalScore = parseInt(totalScore);
			score = parseInt(score);
			total.value = eval(score + totalScore);

		}else{
			total.value = "";
			totalScore = parseInt(totalScore);
			score = parseInt(score);
			total.value = eval(totalScore + score);
		}

		// first_second.value = eval(first + second);

		// first_second_third.value = eval((parseInt(first_second.value)) + (parseInt(total.value)));

		// let divider = eval((parseInt(first_second_third.value)) / (3));
		// overall.value = parseInt(divider);

		if (!first && second) {
			first_second.value = eval(second);
		}else if(first && !second){
			first_second.value = eval(first);
		}else if(!first && !second){
			first_second.value = '';
		}else{
			first_second.value = eval(first + second);
		}

		if(first_second.value > 0 && (!first || !second)){
			first_second_third.value = eval((parseInt(first_second.value)) + (parseInt(total.value)));
			let divider = eval((parseInt(first_second_third.value)) / (2));
			overall.value = parseInt(divider);
		}else if(first_second.value > 0 && (first || second)){
			first_second_third.value = eval((parseInt(first_second.value)) + (parseInt(total.value)));
			let divider = eval((parseInt(first_second_third.value)) / (3));
			overall.value = parseInt(divider);
		}else{
			first_second_third.value =  parseInt(total.value);
			first_second.value = '-';
			let divider = parseInt(total.value);
			overall.value = parseInt(divider);
		}



		if (overall.value >= 80){
			grading.value = 'A';
		}else if (overall.value >= 70){
			grading.value = 'B';
		}else if (overall.value >= 60){
			grading.value = 'C';
		}else if (overall.value >= 50){
			grading.value = 'D';
		}else if (overall.value >= 40){
			grading.value = 'E';
		}else if (overall.value >= 0){
			grading.value = 'F';
		}else{
			grading.value = '-';
		}


		inputElement.setAttribute("readonly", "");
	}


	function activateBtn(e, subInput, totals, firstSecond, firstSecondThird, overallTotal, grade){
		e.preventDefault();
		let enable = document.getElementsByClassName(subInput);
		let clearer = document.getElementById(totals);
		let grading = document.getElementById(grade);
		let firstSec = document.getElementById(firstSecond);
		let firstSecThir = document.getElementById(firstSecondThird);
		let ovrTot = document.getElementById(overallTotal);


		for (var i = 0; i < enable.length; i++){
			enable[i].removeAttribute("readonly");
			enable[i].removeAttribute("disabled");
			enable[i].value = "";			
		}

		
		clearer.value = "";
		firstSec.value = "";
		firstSecThir.value = "";
		ovrTot.value = "";
		grading.value = "";
		cleaner.removeAttribute("disabled");
	}

</script>

<?php
if (isset($_POST['submit'])) {
	$result = add_annual_result($_POST);

	if ($result === true) {
		$msg = true;
	}elseif($result === 'updated'){
		$msg2 = true;
	}else{
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
                  var duration = timer * 2000;
                  const Toast = Swal.mixin({
                      toast: true,
                      position: 'center',
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

			  setTimeout(function refresh(){
				window.location = 'subject_upload_annual.php';
			  }, 6000);
    </script> 


<?php } ?>
<?php

	}
}
?>

<?php if ( isset($msg)): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: true,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', 'Upload successful');
	setTimeout(function refresh(){
		window.location = 'subject_upload_annual.php';
	}, 1000);
</script> 
<?php endif; ?>

<?php if ( isset($msg2)): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: true,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', 'Update successful');

	setTimeout(function refresh(){
		window.location = 'subject_upload_annual.php';
	}, 1000);
</script> 
<?php endif; ?>

