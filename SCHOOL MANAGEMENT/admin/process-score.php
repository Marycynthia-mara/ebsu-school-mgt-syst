<?php 
require_once 'inc/config.inc.php';

if (isset($_POST['ftst']) && isset($_POST['stst'])) {
	$ftst = sanitize($_POST['ftst']);
	$stst = sanitize($_POST['stst']);
	$data1 = $_SESSION[$ftst];
	$data2 = $_SESSION[$stst];
	$data1 = $data1['total'];
	$data2 = $data2['total'];

	$response = [];

	$response['data1'] = $data1;
	$response['data2'] = $data2;

	$data = json_encode($response);

	echo $data;
}