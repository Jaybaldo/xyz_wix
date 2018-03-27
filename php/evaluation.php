<?php

if(!isset($_POST['case'])){
    exit();
}

include_once("info.php");
include_once("updateDatabase.php");

$case = $_POST['case'];

switch ($case) {
    case 1: //Evaluations made as explorer
        $id = $_POST['id'];
        $query = "SELECT review.id as review_id, review.id_user_destiny as user_id, review.type, review.review, review.id_activity as id_activity,
                    (select user.name from user where user.id = user_id) as user_name,
                    (select status.time_stamp from status where id_element = review_id and name_table = 'review') as time_review,
                    (select activity.id from activity where activity.id = id_activity) as activity_name_spa,
                    (select activity.name_spa from activity where activity.id = id_activity) as activity_name_spa,
                    (select activity.name_eng from activity where activity.id = id_activity) as activity_name_eng,
                    (select images.source from images where images.id_element = user_id and images.name_table='user' and images.type = 1 order by id desc limit 1) as img
                    from review
                    where id_user_origin = ? and type = 1 order by review_id desc;";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    case 2: //Evaluations received as explorer
        $id = $_POST['id'];
        $query = "SELECT review.id as review_id, review.id_user_origin as user_id, review.type, review.review, review.id_activity as id_activity,
                    (select user.name from user where user.id = user_id) as user_name,
                    (select status.time_stamp from status where id_element = review_id and name_table = 'review') as time_review,
                    (select activity.name_spa from activity where activity.id = id_activity) as activity_name_spa,
                    (select activity.name_eng from activity where activity.id = id_activity) as activity_name_eng,
                    (select images.source from images where images.id_element = user_id and images.name_table='user' and images.type = 1 order by id desc limit 1) as img
                    from review
                    where id_user_destiny = ? and type = 2 order by review_id desc;";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    case 3: //Evaluations count of each type by id_user_origin
        $id = $_POST['id'];
        $query = "SELECT (select count(*) from review where review.id_user_destiny = ? and review.type = 1) as exp,
                        (select count(*) from review where review.id_user_destiny = ? and review.type = 2) as wix";
        $array = array();
        $array[0] = $id; $array[1] = $id;
        echo json_encode(info($query, $array));
    break;

    case 4: //Evaluations made as wixer
        $id = $_POST['id'];
        $query = "SELECT review.id as review_id, review.id_user_destiny as user_id, review.type, review.review, review.id_activity as id_activity,
                    (select user.name from user where user.id = user_id) as user_name,
                    (select status.time_stamp from status where id_element = review_id and name_table = 'review') as time_review,
                    (select activity.name_spa from activity where activity.id = id_activity) as activity_name_spa,
                    (select activity.name_eng from activity where activity.id = id_activity) as activity_name_eng,
                    (select images.source from images where images.id_element = user_id and images.name_table='user' and images.type = 1 order by id desc limit 1) as img
                    from review
                    where id_user_origin = ? and type = 2 order by review_id desc;";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    case 5: //Evaluations received as wixer
        $id = $_POST['id'];
        $query = "SELECT review.id as review_id, review.id_user_origin as user_id, review.type, review.review, review.id_activity as id_activity,
                    (select user.name from user where user.id = user_id) as user_name,
                    (select status.time_stamp from status where id_element = review_id and name_table = 'review') as time_review,
                    (select activity.name_spa from activity where activity.id = id_activity) as activity_name_spa,
                    (select activity.name_eng from activity where activity.id = id_activity) as activity_name_eng,
                    (select images.source from images where images.id_element = user_id and images.name_table='user' and images.type = 1 order by id desc limit 1) as img
                    from review
                    where id_user_destiny = ? and type = 1 order by review_id desc;";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    default:
        echo json_encode(array('Error' => "Invalid case" ));
    break;
}

?>
