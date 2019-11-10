<?php  

require_once 'config.inc.php';

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);

function execute_stmt($statement)
{
	global $conn;
	$query = mysqli_query($conn, $statement);
	return $query;
}

function execute_select($sql){
	$data = false;
	$result = execute_stmt($sql);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		$data = mysqli_fetch_array($result);
		return $data;
	}

	if ($count > 1) {

		$data = [];
		while ($row = mysqli_fetch_assoc($result)){
				$data[] = $row;
		}
	}

	return $data;
}

function execute_iud($sql){

	global $conn;
	$result = execute_stmt($sql);

	return mysqli_affected_rows($conn);
}


function sanitize($input){

	global $conn;
	$input = htmlentities(strip_tags(trim($input)));
	$input = mysqli_real_escape_string($conn, $input);

	return $input;
}


function sanitize_email($input){

	global $conn;
	$input = filter_var($input, FILTER_VALIDATE_EMAIL);
	
	if ($input) {
		$input = mysqli_real_escape_string($conn, $input);
		return $input;
	}
	return false;
}

?>