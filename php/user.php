<?php
	include_once('info.php');
	include_once('updateDatabase.php');

	if(!isset($_POST['case'])){
		exit();
	}

	$case = $_POST['case'];

	switch ($case) {
		case 1: // Add user
			$email = $_POST['email'];
			$name = $_POST['name'];
			$password = $_POST['password'];
            $mobile = $_POST['mobile'];
            $send_promos = $_POST['send_promos'];

			$query = "INSERT INTO user (email, name, password, mobile, send_promos, is_validate) VALUES (?, ?, ?, ?, ?, 1)";
			$array = array();
			$array[0] = $email;
			$array[1] = $name;
			$array[2] = $password;
			$array[3] = $mobile;
			$array[4] = $send_promos;

			$added = updateDatabase($query, $array);

			if($added == 1){
				$query = "SELECT u.id FROM user u ORDER BY u.id DESC LIMIT 1";
				$newUserID = info($query);
				$newUserID = $newUserID[0]['id'];

				$dir_profile = "../assets/img/users/$newUserID/profile/";
				mkdir($dir_profile, 0755, true);

				$dir_identification = "../assets/img/users/$newUserID/identification/";
				mkdir($dir_identification, 0755, true);

				echo 1;
			}else echo 0;
		break;

		case 2: //get user by email
			$email = $_POST['email'];
			$query = "SELECT u.id user_id, u.city, u.name, u.email, u.type, u.mobile, u.additional_phone, u.birthdate, u.send_promos, u.is_validate, u.city, u.gender, u.currency, u.id_preference_language, (SELECT s.status FROM status s WHERE s.name_table = 'user' AND s.id_element = user_id ORDER BY s.id DESC LIMIT 1) status_user, (SELECT s_exp.status FROM status s_exp WHERE s_exp.name_table = 'explorer' AND s_exp.id_element = user_id ORDER BY s_exp.id DESC LIMIT 1) status_explorer, (SELECT s_wix.status FROM status s_wix WHERE s_wix.name_table = 'wixer' AND s_wix.id_element = user_id ORDER BY s_wix.id DESC LIMIT 1) status_wixer, (SELECT i.source FROM images i WHERE i.id_element = user_id AND i.name_table = 'user' ORDER BY i.id DESC LIMIT 1) img FROM user u WHERE u.email = ?";
			$array = array();
			$array[0] = $email;

			echo json_encode(info($query, $array));
		break;

		case 3: //get user by mobile
			$mobile = $_POST['mobile'];
			$query = "SELECT COUNT(*) count FROM user u WHERE u.mobile = ?";
			$array = array();
			$array[0] = $mobile;

			echo json_encode(info($query, $array));
		break;

		case 4: //Get last identification
			$id = $_POST['id'];
			$query = "SELECT * FROM images i WHERE id_element = ? AND i.name_table = 'identification' ORDER BY i.id DESC LIMIT 1";
			$array = array();
			$array[0] = $id;
			echo json_encode(info($query, $array));
		break;

		case 5: //get user by id (for cookie)
			$id = $_POST['id'];
			$query = "SELECT u.id user_id, u.city, u.name, u.email, u.type, u.mobile, u.additional_phone, u.birthdate, u.send_promos, u.is_validate, u.city, u.gender, u.currency, u.id_preference_language, (SELECT s.status FROM status s WHERE s.name_table = 'user' AND s.id_element = user_id ORDER BY s.id DESC LIMIT 1) status_user, (SELECT s_exp.status FROM status s_exp WHERE s_exp.name_table = 'explorer' AND s_exp.id_element = user_id ORDER BY s_exp.id DESC LIMIT 1) status_explorer, (SELECT s_wix.status FROM status s_wix WHERE s_wix.name_table = 'wixer' AND s_wix.id_element = user_id ORDER BY s_wix.id DESC LIMIT 1) status_wixer, (SELECT i.source FROM images i WHERE i.id_element = user_id AND i.name_table = 'user' ORDER BY i.id DESC LIMIT 1) img FROM user u WHERE u.id = ?";
			$array = array();
			$array[0] = $id;

			echo json_encode(info($query, $array));
		break;

		case 6: //get user by email and password and valid status = 1
			$email = $_POST['email'];
			$password = $_POST['password'];
			$query = "SELECT u.id user_id, u.city, u.name, u.email, u.type, u.mobile, u.additional_phone, u.birthdate, u.send_promos, u.is_validate, u.city, u.gender, u.currency, u.id_preference_language, (SELECT s.status FROM status s WHERE s.name_table = 'user' AND s.id_element = user_id ORDER BY s.id DESC LIMIT 1) status_user, (SELECT s_exp.status FROM status s_exp WHERE s_exp.name_table = 'explorer' AND s_exp.id_element = user_id ORDER BY s_exp.id DESC LIMIT 1) status_explorer, (SELECT s_wix.status FROM status s_wix WHERE s_wix.name_table = 'wixer' AND s_wix.id_element = user_id ORDER BY s_wix.id DESC LIMIT 1) status_wixer, (SELECT i.source FROM images i WHERE i.id_element = user_id AND i.name_table = 'user' ORDER BY i.id DESC LIMIT 1) img FROM user u WHERE u.email = ? AND u.password = ? AND u.is_validate = 1";
			$array = array();
			$array[0] = $email;
			$array[1] = $password;

			echo json_encode(info($query, $array));
		break;

		case 7: //Get languages spoken by user id
			$id = $_POST['id'];
			$query = "SELECT user_lang.id_user, lang.id_lang, lang.lang_name
					from user_lang, lang
					where user_lang.lang = lang.id_lang and user_lang.id_user in (?);";
			$array = array();
			$array[0] = $id;
			echo json_encode(info($query, $array));
		break;

		case  8:
			$id = $_POST['id'];
			$query = "SELECT user.id, user.id as id_in_tables, user.name, user.email, user.type, user.mobile, user.additional_phone, user.birthdate, user.id_facebook, user.is_validate, user.session, user.city, user.gender, user.currency, user.id_preference_language,
				(select images.source from images where images.id_element = id_in_tables and images.name_table='user' and images.type = 1 order by id desc limit 1) as img,
				(select explorer.description_spa from explorer where explorer.id_user = id_in_tables) as exp_desc_spa,
				(select explorer.description_eng from explorer where explorer.id_user = id_in_tables) as exp_desc_eng,
				(select wixer.description_spa from wixer where wixer.id_user = id_in_tables) as wix_desc_spa,
				(select wixer.description_eng from wixer where wixer.id_user = id_in_tables) as wix_desc_eng,
				(select status.status from status where status.name_table = 'wixer' and status.id_element = id_in_tables ORDER BY status.id DESC LIMIT 1) as status_wixer,
				(select status.status FROM status WHERE status.name_table = 'user' AND status.id_element = id_in_tables ORDER BY status.id DESC LIMIT 1) status_user, 
				(select status.status FROM status WHERE status.name_table = 'explorer' AND status.id_element = id_in_tables ORDER BY status.id DESC LIMIT 1) status_explorer,
				(select time_stamp from status where id_element = id_in_tables and name_table = 'user' order by id asc limit 1) as time_joined,
				(select GROUP_CONCAT(lang.lang_name SEPARATOR ', ') FROM user_lang, lang  where lang.id_lang = user_lang.lang and user_lang.id_user = id_in_tables) as us_langs,
				(select images.id from images where name_table = 'identification' and id_element = id_in_tables order by id desc limit 1) as img_id_in_table,
				(select status from status where name_table = 'images' and id_element = img_id_in_table order by id asc limit 1) as status_identificacion
				from user where user.id = ?;";
			$array = array();
			$array[0] = $id;
			echo json_encode(info($query, $array));
		break;

		case 9: //Get descriptions by user id
			$id = $_POST['id'];
			$query = "SELECT e.description_spa explorer_description_spa, e.description_eng explorer_description_eng, w.description_spa wixer_description_spa, w.description_eng wixer_description_eng FROM explorer e, wixer w WHERE e.id_user = ? AND w.id_user = ?";
			$array = array();
			$array[0] = $id;
			$array[1] = $id;
			echo json_encode(info($query, $array));
		break;

		case 10: //Update name
			$id = $_POST['id'];
			$name = $_POST['name'];
			$query = "UPDATE user u SET u.name = ? WHERE u.id = $id";
			$array = array();
			$array[0] = $name;
			echo json_encode(updateDatabase($query, $array));
		break;

		case 11: //Update email
			$id = $_POST['id'];
			$name = $_POST['email'];
			$query = "UPDATE user u SET u.email = ? WHERE u.id = $id";
			$array = array();
			$array[0] = $name;
			echo json_encode(updateDatabase($query, $array));
		break;

		case 12: //Update mobile
			$id = $_POST['id'];
			$mobile = $_POST['mobile'];
			$query = "UPDATE user u SET u.mobile = ? WHERE u.id = $id";
			$array = array();
			$array[0] = $mobile;
			echo json_encode(updateDatabase($query, $array));
		break;

		case 13: //Update mobile
			$id = $_POST['id'];
			$city = $_POST['city'];
			$query = "UPDATE user u SET u.city = ? WHERE u.id = $id";
			$array = array();
			$array[0] = $city;
			echo json_encode(updateDatabase($query, $array));
		break;

		case 14: //Update gender
			$id = $_POST['id'];
			$gender = $_POST['gender'];
			$query = "UPDATE user u SET u.gender = ? WHERE u.id = $id";
			$array = array();
			$array[0] = $gender;
			echo json_encode(updateDatabase($query, $array));
		break;

		case 15: //Update birthdate
			$id = $_POST['id'];
			$birthdate = $_POST['birthdate'];
			$query = "UPDATE user u SET u.birthdate = ? WHERE u.id = $id";
			$array = array();
			$array[0] = $birthdate;
			echo json_encode(updateDatabase($query, $array));
		break;

		default:
			echo json_encode(array("Error" => "Invalid Case" ));
		break;
	}
?>
