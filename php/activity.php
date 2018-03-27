<?php

if(!isset($_POST['case'])){
    exit();
}

include_once('info.php');
include_once('updateDatabase.php');

$case = ($_POST['case']);

switch ($case) {
    case 1: //All activities with wixer information (given status(es))
        $status = $_POST['status'];
        $query = "SELECT activity.*, user.id as user_id, user.name, user.email, user.mobile, activity.id as id_activity_unused, activity.id_city as city_unused,
                    wixer.description_eng as wixer_desc_en, wixer.description_spa as wixer_desc_es,
                    (select count(*) from sale_activity where sale_activity.id_activity = id_activity_unused and sale_activity.global_score != 0) as num_rat,
                    (select category.name_spa from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_spa,
                    (select category.name_eng from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_eng,
                    (select images.source from images where images.id_element = id_activity_unused and images.name_table='activity' and images.type = 1) as img_src,
                    (select city.name from city where city.id = city_unused) as city,
                    (select source from images where name_table = 'user' and type = 1 and id_element = user_id order by id desc limit 1) as user_main_img,
                    (select status.status from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as status
                    from activity, user, wixer
                    where activity.id_wixer = wixer.id_user and wixer.id_user=user.id
                    group by activity.id having status in (?)";
        $array = array();
        $array[0] = $status;
        echo json_encode(info($query, $array));
    break;

    case 2: //All activities with wixer id (given status(es))
        $id = $_POST['id'];
        $status = $_POST['status'];
        $query = "SELECT activity.*, user.id as user_id, user.name, user.email, user.mobile, activity.id as id_activity_unused, activity.id_city as city_unused,
                    wixer.description_eng as wixer_desc_en, wixer.description_spa as wixer_desc_es,
                    (select count(*) from sale_activity where sale_activity.id_activity = id_activity_unused and sale_activity.global_score != 0) as num_rat,
                    (select category.name_spa from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_spa,
                    (select category.name_eng from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_eng,
                    (select images.source from images where images.id_element = id_activity_unused and images.name_table='activity' and images.type = 1) as img_src,
                    (select city.name from city where city.id = city_unused) as city,
                    (select source from images where name_table = 'user' and type = 1 and id_element = user_id order by id desc limit 1) as user_main_img,
                    (select status.status from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as status,
                    (select status.time_stamp from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as time_stamp
                    from activity, user, wixer
                    where activity.id_wixer = wixer.id_user and wixer.id_user=user.id and user.id=?
                    group by activity.id having status in (?)";
        $array = array();
        $array[0] = $id;
        $array[1] = $status;
        echo json_encode(info($query, $array));
    break;

    case 3: //Activity by id
        $id = $_POST['id'];
        $status = $_POST['status'];
        $query = "SELECT activity.*, user.id as user_id, user.name, user.email, user.mobile,  activity.id as id_activity_unused, activity.id_city as city_unused,
                    wixer.description_eng as wixer_desc_en, wixer.description_spa as wixer_desc_es,
                    (select count(*) from sale_activity where sale_activity.id_activity = id_activity_unused and sale_activity.global_score != 0) as num_rat,
                    (select category.name_spa from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_spa,
                    (select category.name_eng from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_eng,
                    (select images.source from images where images.id_element = id_activity_unused and images.name_table='activity' and images.type = 1) as img_src,
                    (select city.name from city where city.id = city_unused) as city,
                    (select source from images where name_table = 'user' and type = 1 and id_element = user_id order by id desc limit 1) as user_main_img,
                    (select status.status from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as status,
                    (select status.time_stamp from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as time_stamp
                    from activity, user, wixer
                    where activity.id_wixer = wixer.id_user and wixer.id_user=user.id and activity.id in (?)";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    case 4: //All activities from city with city id
        $id = $_POST['id'];
        $status = $_POST['status'];
        $query = "SELECT activity.*, user.id as user_id, user.name, user.email, user.mobile, activity.id as id_activity_unused, activity.id_city as city_unused,
                wixer.description_eng as wixer_desc_en, wixer.description_spa as wixer_desc_es,
                (select count(*) from sale_activity where sale_activity.id_activity = id_activity_unused and sale_activity.global_score != 0) as num_rat,
                (select category.name_spa from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_spa,
                (select category.name_eng from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_eng,
                (select images.source from images where images.id_element = id_activity_unused and images.name_table='activity' and images.type = 1) as img_src,
                (select city.name from city where city.id = city_unused) as city,
                (select source from images where name_table = 'user' and type = 1 and id_element = user_id order by id desc limit 1) as user_main_img,
                (select status.status from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as status,
                (select status.time_stamp from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as time_stamp
                from activity, user, wixer
                where activity.id_wixer = wixer.id_user and wixer.id_user=user.id and activity.id_city = ?
                group by activity.id having status in (?)";
        $array = array();
        $array[0] = $id;
        $array[1] = $status;
        echo json_encode(info($query, $array));
    break;

    case 5: //A specific number of activities by cityID
        $id = $_POST['id'];
        $status = $_POST['status'];
        $limit = $_POST['limit'];
        $query = "SELECT activity.*, user.id as user_id, user.name, user.email, user.mobile, activity.id as id_activity_unused, activity.id_city as city_unused,
                wixer.description_eng as wixer_desc_en, wixer.description_spa as wixer_desc_es,
                (select count(*) from sale_activity where sale_activity.id_activity = id_activity_unused and sale_activity.global_score != 0) as num_rat,
                (select city.name from city where city.id = city_unused) as city,
                (select source from images where name_table = 'user' and type = 1 and id_element = user_id order by id desc limit 1) as user_main_img,
                (select category.name_spa from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_spa,
                (select category.name_eng from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_eng,
                (select images.source from images where images.id_element = id_activity_unused and images.name_table='activity' and images.type = 1) as img_src,
                (select status.status from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as status,
                (select status.time_stamp from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as time_stamp
                from activity, user, wixer
                where activity.id_wixer = wixer.id_user and wixer.id_user=user.id and activity.id_city in (?) group by activity.id having status in (?) LIMIT 0, 12";
        $array = array();
        $array[0] = $id;
        $array[1] = $status;
        echo json_encode(info($query, $array));
    break;

    case 6: //Activity covers by activity id
        $id = $_POST['id'];
        $query = "SELECT activity_covers.*, covers.name_spa, covers.name_eng
                from activity_covers, covers
                where activity_covers.id_cover = covers.id and activity_covers.id_activity in (?);";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    case 7: //Activity requirement by activity id
        $id = $_POST['id'];
        $query = "SELECT * from requierements where id_activity in (?);";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    case 8: //Section for Filters

        $categories = $_POST['categories'];
        $city = $_POST['city'];
        $price = $_POST['price'];
        $lang = $_POST['lang'];
        $reservation = $_POST['reservation'];
        $array = array();

        $categories_query = " ";

        if($categories != "null"){
            array_push($array, $categories);
            array_push($array, $categories);
            $categories_query = $categories_query . "and (activity.id_category in (?) or activity.id_category_secondary in (?)) ";
        }
        if($city != "null"){
            array_push($array, $city);
            $categories_query = $categories_query . "and activity.id_city = ? ";
        }
        if($price != "null"){
            array_push($array, $price);
            $categories_query = $categories_query . "and activity.price <= ? ";
        }
        if($lang != "null"){
            array_push($array, $lang);
            $categories_query = $categories_query . "and activity.id = activity_lang.id_activity and activity_lang.id_lang in (?) ";
        }

        if($reservation != "null"){
            if($reservation == "automatic"){
                $reservation = 1;
                array_push($array, $reservation);
                $categories_query = $categories_query . " and activity_reservation_type = ? ";
            }


        }

        $query = "SELECT activity.*, user.id as user_id, user.name, user.email, user.mobile, activity.id as id_activity_unused, activity.id_city as city_unused,
                wixer.description_eng as wixer_desc_en, wixer.description_spa as wixer_desc_es,
                (select count(*) from sale_activity where sale_activity.id_activity = id_activity_unused and sale_activity.global_score != 0) as num_rat,
                (select city.name from city where city.id = city_unused) as city,
                (select source from images where name_table = 'user' and type = 1 and id_element = user_id order by id desc limit 1) as user_main_img,
                (select category.name_spa from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_spa,
                (select category.name_eng from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_eng,
                (select images.source from images where images.id_element = id_activity_unused and images.name_table='activity' and images.type = 1) as img_src,
                (select status.status from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as status,
                (select status.time_stamp from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as time_stamp
                from activity, user, wixer, activity_lang where activity.id_wixer = wixer.id_user and wixer.id_user=user.id " . $categories_query . " group by activity.id having status in (?)";

        $status = $_POST['status'];
        array_push($array, $status);
        echo json_encode(info($query, $array));
    break;

    case 9: //
        $id = $_POST['id'];
        $status = $_POST['status'];
        $query = "SELECT activity.*, user.id as user_id, user.name, user.email, user.mobile, activity.id as id_activity_unused, activity.id_city as city_unused,
                    wixer.description_eng as wixer_desc_en, wixer.description_spa as wixer_desc_es,
                    (select count(*) from sale_activity where sale_activity.id_activity = id_activity_unused and sale_activity.global_score != 0) as num_rat,
                    (select category.name_spa from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_spa,
                    (select category.name_eng from category, activity where category.id = activity.id_category and activity.id = id_activity_unused) as main_category_eng,
                    (select images.source from images where images.id_element = id_activity_unused and images.name_table='activity' and images.type = 1) as img_src,
                    (select city.name from city where city.id = city_unused) as city,
                    (select source from images where name_table = 'user' and type = 1 and id_element = user_id order by id desc limit 1) as user_main_img,
                    (select status.status from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as status,
                    (select status.time_stamp from status where status.id_element = id_activity_unused and status.name_table = 'activity' ORDER BY status.id DESC LIMIT 1) as time_stamp
                    from activity, user, wixer, favorite
                    where activity.id_wixer = wixer.id_user and wixer.id_user=user.id and favorite.id_activity = activity.id and favorite.id_explorer = $id;
                    group by activity.id having status in (?)";
        $array = array();
        $array[0] = $status;
        echo json_encode(info($query, $array));
    break;

    default:
        echo json_encode(array('Error' => "Invalid case" ));
    break;
}

?>
