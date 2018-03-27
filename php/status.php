<?php
	include_once('info.php');
	include_once('updateDatabase.php');

	if(!isset($_POST['case'])){
		exit();
	}

	$case = $_POST['case'];

	switch ($case) {
		case 1: // Add status
			$name_table = $_POST['name_table'];
			$id_element = $_POST['id_element'];
			$status = $_POST['status'];

			$query = "INSERT INTO status (name_table, id_element, status) VALUES (?, ?, ?)";
			$array = array();
			$array[0] = $name_table;
			$array[1] = $id_element;
			$array[2] = $status;

			echo json_encode(updateDatabase($query, $array));
		break;

		default:
			echo "Error";
		break;
	}
?>
