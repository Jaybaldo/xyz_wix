<?php
	include_once('info.php');
	include_once('updateDatabase.php');

	if(!isset($_POST['case'])){
		exit();
	}

	$case = $_POST['case'];

	switch ($case) {
		case 1: //Update description spa
			$id = $_POST['id'];
			$description = $_POST['description'];
			$query = "UPDATE wixer w SET w.description_spa = ? WHERE w.id_user = $id";
			$array = array();
			$array[0] = $description;
			echo json_encode(updateDatabase($query, $array));
		break;

		case 2: //Update description eng
			$id = $_POST['id'];
			$description = $_POST['description'];
			$query = "UPDATE wixer w SET w.description_eng = ? WHERE w.id_user = $id";
			$array = array();
			$array[0] = $description;
			echo json_encode(updateDatabase($query, $array));
		break;

		default:
			echo json_encode(array("Error" => "Invalid Case" ));
		break;
	}
?>
