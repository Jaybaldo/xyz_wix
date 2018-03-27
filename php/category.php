<?php
	if(!isset($_POST['case'])){
	    exit();
	}

	include_once('info.php');
	include_once('updateDatabase.php');

	$case = ($_POST['case']);

	switch ($case) {
		case 1: //Obtenemos todas las categorías así sin pedos
			$query = "select * from category;";
			echo json_encode(info($query));
			break;
		
		default:
			# code...
			break;
	}


?>