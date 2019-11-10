<?php require_once 'inc/config.inc.php'; ?>

<?php if (!isset($_SESSION['sub-stud-fetch'])) {
	redirect_to('result_fetch.php');
} 

if ($_SESSION['category'] === 'student') {
    redirect_to("dashboard.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Result Sheet</title>
	<link rel="stylesheet" type="text/css" href="css/result1.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
	<script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

	<header>
		<img src="img/logo_name2.png" alt="School Logo">
		<h2>EBONYI STATE UNIVERSITY, ABAKALIKI</h2>
		<h1>STAFF SECONDARY SCHOOL</h1>
		<h4>CONTINEUOUS ASSESSMENT FOR 
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
				<th class="rotate">CAT 1</th>
				<th class="rotate">CAT 2</th>
				<th class="rotate">CAT 3</th>
				<th class="rotate">EXAM</th>
				<th class="rotate">TOTAL</th>
				<th class="rotate" rowspan="2">GRADE</th>
				<th class="rotate" rowspan="2">EDIT</th>
				<th rowspan="2" class="subjectTeacherComment">SUBJECT TEACHER'S COMMENT</th>
			</tr>

			<tr>
				<td><input type="number" name="" value="10" disabled></td>
				<td><input type="number" name="" value="10" disabled></td>
				<td><input type="number" name="" value="10" disabled></td>
				<td><input type="number" name="" value="70" disabled></td>
				<td><input type="number" name="" value="100" disabled></td>
			</tr>


			<?php $subjects =  $_SESSION['sub-stud-fetch']; 
			$counter = 1;
			?>

			<?php foreach ($subjects as $subject): 
				
				$subject_id_fk = $_SESSION['Subject'];
				$student_class_id_fk = $_SESSION['Class'];
				$term = $_SESSION['exam_term'];
				$ACyear = $_SESSION['AC_year'];
				$dub_result = check_duplicate_result('exam_result', $student_class_id_fk, $subject_id_fk, $ACyear, $term);
				if ($dub_result){
					$subjectscore = get_subjectscore('exam_result', $subject_id_fk, $student_class_id_fk, $term, $ACyear, $subject['student_id']);

					if($subjectscore){
						extract($subjectscore);
					}

				}
				
				?>
				
				<tr class="Accounting">
					<td class="justified"><input type="hidden" name="serial_no<?php echo $counter; ?>" value="<?php echo $counter; ?>"><?php echo $counter; ?></td>

					<td class="justified"><input type="hidden" name="student" value="<?php echo $subject['student_id'] ?>"><?php echo ucfirst($subject['firstname']) .' ' . ucfirst($subject['lastname']) .' '. ucfirst($subject['surname']) ?></td>

					<td class="numberInput"><input type="number" onclick="checkValue(this)" value="<?php if(isset($subjectscore)){
						echo($CAT1_score);
					} ?>" name="CATone<?php echo $counter;  ?>"   class="sub<?php echo $counter;  ?>" onblur="calcTotal(this, 'total<?php echo $counter;  ?>', 'grade<?php echo $counter;  ?>')"></td>

					<td class="numberInput"><input type="number" onclick="checkValue(this)" value="<?php if(isset($subjectscore)){
						echo($CAT2_score);
					} ?>" name="CATtwo<?php echo $counter;  ?>"  class="sub<?php echo $counter;  ?>" onblur="calcTotal(this, 'total<?php echo $counter;  ?>', 'grade<?php echo $counter;  ?>')"></td>

					<td 	class="numberInput"><input type="number" onclick="checkValue(this)" value="<?php if(isset($subjectscore)){
						echo($CAT3_score);
					} ?>" name="CATthree<?php echo $counter;  ?>"  class="sub<?php echo $counter;  ?>" onblur="calcTotal(this, 'total<?php echo $counter;  ?>', 'grade<?php echo $counter;  ?>')"></td>

					<td class="numberInput"><input type="number" onclick="checkValue(this)" value="<?php if(isset($subjectscore)){
						echo($EXAM_score);
					} ?>" name="EXAM<?php echo $counter;  ?>"  class="sub<?php echo $counter;  ?>" onblur="calcTotal(this, 'total<?php echo $counter;  ?>', 'grade<?php echo $counter;  ?>')" ></td>

					<td class="totalScore"><input type="number" onclick="checkValue(this)" readonly="" value="<?php if(isset($subjectscore)){
						echo($total);
					} ?>" name="TOTAL<?php echo $counsub_teacher_comtter;  ?>" class="totalScore" id="total<?php echo $counter;  ?>"></td>
					<td><input type="text" readonly="" value="<?php if(isset($subjectscore)){
						echo($grade);
					} ?>" name="GRADE<?php echo $counter;  ?>" id="grade<?php echo $counter;  ?>"></td>

					<td><button onclick="activateBtn(event, 'sub<?php echo $counter;  ?>', 'total<?php echo $counter;  ?>')">EDIT</button></td>
					<td><input class="justified" type="text" value="<?php if(isset($subjectscore)){
						echo($sub_teacher_comt);
					} ?>" name="sub_tea_comt<?php echo $counter;  ?>"></td>
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

	<?php if($dub_result === true){?>
		<input class="submitBtn" type="submit" name="submit" value="Update Scores">
	<?php }else{ ?>
		<input class="submitBtn" type="submit" name="submit" value="Upload Scores">
	<?php }?>
	
	<button class="back"><a href="result_fetch.php"><- Back</a></button>


</form>
</div>

</body>
</html>
<script type="text/javascript">
	function checkValue(currentElement){
		if(currentElement.value > 1){
			currentElement.value = "";
			inputElement.style.backgroundColor = "#ebebe4";
		}
	}

	function calcTotal(inputElement, totalField, grades){


		let total = document.getElementById(totalField);
		let score = parseInt(inputElement.value);
		let grading = document.getElementById(grades);
		let totalScore = total.value;


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



		if (total.value >= 80){
			grading.value = 'A';
		}else if (total.value >= 70){
			grading.value = 'B';
		}else if (total.value >= 60){
			grading.value = 'C';
		}else if (total.value >= 50){
			grading.value = 'D';
		}else if (total.value >= 40){
			grading.value = 'E';
		}else if (total.value >= 0){
			grading.value = 'F';
		}else{
			grading.value = '-';
		}

		inputElement.setAttribute("readonly", "");

	}

	function activateBtn(e, subInput, totals){
		e.preventDefault();
		let enable = document.getElementsByClassName(subInput);
		let clearer = document.getElementById(totals);

		for (var i = 0; i < enable.length; i++){
			enable[i].removeAttribute("readonly");
			enable[i].value = "";
			
		}
		clearer.value = "";
	}

</script>


<?php
if (isset($_POST['submit'])) {
	$result = add_result($_POST);

	if ($result === true) {
		$msg = true;
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
}
?>

<?php if ( isset($msg)): ?>
  <script>

    function notifyWithToast(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: true,
            timer: 10000
        });

        Toast.fire({
            type: type,
            title: message,
        })
    }
    notifyWithToast('success', 'Upload successful');
</script> 
<?php endif; ?>
