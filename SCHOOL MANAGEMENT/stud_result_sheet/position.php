<?php 

$students = array(1=>94,2=>94,3=>91, 4=>89, 5=>83, 6=>65, 7=>41, 8=>38,9=>37, 10=>37,11=>94);

arsort($students);//sorting the student array to make higher score come up

$newStudents = array(); //an array to hold the sorted students and scores with position
$pos = 0; //initialising position collector
$count = 0; // initialising counter
$holder = -1; // Assuming no negative scores.
foreach($students as $k=>$v){
    $count++;
    if($v < $holder || $holder == -1){ //checking scores and holder for negative value;
        $holder = $v;//assigning the student scores to holder
        $pos = $count;//assigning the student at each scores the current counter as position;
    }

    $newStudents[] = makeStudent($pos, $v, $k);//calling the function to make student id the array key.
    
}

$newStudents = fixLast($newStudents);//calling a function that will get students id, scores and position



function makeStudent($pos, $score,$student_id){
    $student = new stdClass();
    $student->position = $pos;
    $student->score = $score;
    $student->id = $student_id;

    return $student;
}



function fixLast($students){
    $length = count($students) -1;
    $count = 0;
    $i = $length;
    while($students[$i]->position == $students[--$i]->position){
        $count++;
    }

    for($i = 0; $i <= $count; $i++){
        $students[$length - $i]->position = $students[$length - $i]->position + $count;
    }
    return $students;

}


echo "<table border=1>";
foreach($newStudents as $v){
	echo "<tr>";
   echo "<td>student ID " . $v->id."</td>";
   echo "<td>position " . $v->position."</td>";
   echo "</tr>";
}
echo "</table>";


 ?>