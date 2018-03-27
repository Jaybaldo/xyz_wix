<?php
	include_once('info.php');
	include_once('updateDatabase.php');

	if(!isset($_POST['case'])){
		exit();
	}

	$case = $_POST['case'];

	switch ($case) {
		case 1: // Add user img_profile and identification
			$id_element = $_POST['id_element'];
			$img_profile = $_FILES['imagen']['name'];
			$img_profile_temp = $_FILES['imagen']['tmp_name'];
			$img_identification = $_FILES['identification']['name'];
			$img_identification_temp = $_FILES['identification']['tmp_name'];

			$dir_img_profile = "../assets/img/users/$id_element/profile/";
			$dir_img_identification = "../assets/img/users/$id_element/identification/";

			//Saca extensión
			$arreglo_img_profile = explode(".", $img_profile);
			$len_img_profile = count($arreglo_img_profile);
			$ext_img_profile = $arreglo_img_profile[$len_img_profile-1];

			$arreglo_img_identification = explode(".", $img_identification);
			$len_img_identification = count($arreglo_img_identification);
			$ext_img_identification = $arreglo_img_identification[$len_img_identification-1];

			//Encripta nombre
			$val_img_profile = md5_file($img_profile_temp);
			$val_img_identification = md5_file($img_identification_temp);

			//Sube imagen
			if($img_profile != ''){
				$fileName_img_profile = $val_img_profile . ".$ext_img_profile";
				$source_img_profile = "assets/img/users/$id_element/profile/$fileName_img_profile";
				@copy($img_profile_temp, $dir_img_profile.$fileName_img_profile);
			}

			if($img_identification != ''){
				$fileName_img_identification = $val_img_identification . ".$ext_img_identification";
				$source_img_identification = "assets/img/users/$id_element/identification/$fileName_img_identification";
				@copy($img_identification_temp, $dir_img_identification.$fileName_img_identification);
			}

			$query = "INSERT INTO images (id_element, name_table, source, type) VALUES ($id_element, 'user', '$source_img_profile', 1);
				INSERT INTO images (id_element, name_table, source, type) VALUES ($id_element, 'identification', '$source_img_identification', 1)";
			echo json_encode(updateDatabase($query));
		break;

		case 2: // Add user img_profile
			$id_element = $_POST['id_element'];
			$img_profile = $_FILES['imagen']['name'];
			$img_profile_temp = $_FILES['imagen']['tmp_name'];

			$dir_img_profile = "../assets/img/users/$id_element/profile/";

			//Saca extensión
			$arreglo_img_profile = explode(".", $img_profile);
			$len_img_profile = count($arreglo_img_profile);
			$ext_img_profile = $arreglo_img_profile[$len_img_profile-1];

			//Encripta nombre
			$val_img_profile = md5_file($img_profile_temp);

			//Sube imagen
			if($img_profile != ''){
				$fileName_img_profile = $val_img_profile . ".$ext_img_profile";
				$source_img_profile = "assets/img/users/$id_element/profile/$fileName_img_profile";
				@copy($img_profile_temp, $dir_img_profile.$fileName_img_profile);
			}

			$query = "INSERT INTO images (id_element, name_table, source, type) VALUES ($id_element, 'user', '$source_img_profile', 1)";
			echo json_encode(updateDatabase($query));
		break;

		case 3: // Add user identification
			$id_element = $_POST['id_element'];
			$img_identification = $_FILES['identification']['name'];
			$img_identification_temp = $_FILES['identification']['tmp_name'];

			$dir_img_identification = "../assets/img/users/$id_element/identification/";

			//Saca extensión
			$arreglo_img_identification = explode(".", $img_identification);
			$len_img_identification = count($arreglo_img_identification);
			$ext_img_identification = $arreglo_img_identification[$len_img_identification-1];

			//Encripta nombre
			$val_img_identification = md5_file($img_identification_temp);

			//Sube imagen
			if($img_identification != ''){
				$fileName_img_identification = $val_img_identification . ".$ext_img_identification";
				$source_img_identification = "assets/img/users/$id_element/identification/$fileName_img_identification";
				@copy($img_identification_temp, $dir_img_identification.$fileName_img_identification);
			}

			$query = "INSERT INTO images (id_element, name_table, source, type) VALUES ($id_element, 'identification', '$source_img_identification', 1)";
			echo json_encode(updateDatabase($query));
		break;

		case 4: //Get img profile
			$id = $_POST['id'];
			$query = "SELECT * FROM images i WHERE i.name_table = 'user' AND i.id_element = $id AND i.type = 1 ORDER BY i.id DESC LIMIT 1";
			echo json_encode(info($query));
		break;

		case 5: //Get all images of actv by actv id
			$id = $_POST['id'];
			$query = "SELECT * from images where images.name_table='activity' and images.type = 2 and id_element in (?)";
			$array = array();
			$array[0] = $id;
			echo json_encode(info($query, $array));
		break;

		case 6: //Get all images of actv by actv id (and img principal)
			$id = $_POST['id'];
			$query = "SELECT * from images where images.name_table='activity' and id_element in (?)";
			$array = array();
			$array[0] = $id;
			echo json_encode(info($query, $array));
		break;

		default:
			echo json_encode(array('Error' => "Invalid case"));
		break;
	}
?>
