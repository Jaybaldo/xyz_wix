<?php
	include_once('info.php');
	include_once('updateDatabase.php');
	
	if(!isset($_POST['case'])){
		exit();
	}

	$case = $_POST['case'];


	switch ($case) {
		case 1: // Get all cities
			$query = "SELECT * FROM city";
			echo json_encode(info($query));
		break;

		default:
			echo "Error";
		break;
	}
?>