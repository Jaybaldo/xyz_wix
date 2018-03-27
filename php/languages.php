<?php
	include_once('info.php');
	include_once('updateDatabase.php');
	
	if(!isset($_POST['case'])){
		exit();
	}

	$case = $_POST['case'];


	switch ($case) {
		case 1: // Get all languages
			$query = "SELECT * FROM lang";
			echo json_encode(info($query));
		break;

		case 2: // Update languages of an specific user
			$id = $_POST['id'];
			$will_be_added = $_POST['will_be_added'];
			$will_be_removed = $_POST['will_be_removed'];

			$query = "";

			if(count($will_be_added) >= 1){
				$query = "INSERT INTO user_lang (id_user, lang) VALUES ";

				for($i = 0; $i < count($will_be_added); $i++){
					$query = $query . "(";
					$query = $query . $id . ", " . "'$will_be_added[$i]'";
					$query = $query . "),";
				}

				$query = substr($query, 0, -1);
				$query = $query . ";";
			}

			if(count($will_be_removed) >= 1){
				$query = $query . "DELETE FROM user_lang WHERE user_lang.lang IN (";

				for($i = 0; $i < count($will_be_removed); $i++){
					$query = $query . "'$will_be_removed[$i]'";
					$query = $query . ",";
				}

				$query = substr($query, 0, -1);
				$query = $query . ")";
				$query = $query . " AND user_lang.id_user = $id;";
			}

			echo json_encode(updateDatabase($query));
		break;

		default:
			echo "Error";
		break;
	}
?>