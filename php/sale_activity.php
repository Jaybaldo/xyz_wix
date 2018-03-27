<?php

if(!isset($_POST['case'])){
    exit();
}

include_once('info.php');
include_once('updateDatabase.php');

$case = ($_POST['case']);

switch ($case) {
    case 1: //All sale activities
        $query = "SELECT sa.id id_sale_activity, sa.id_activity, a.name_spa, a.name_eng, a.id_wixer id_wixer, w.name wixer_name, 
            sa.id_explorer, e.name explorer_name, sa.num_persons, sa.total, sa.date_schedule activity_date, sa.payment_type, 
            rd.time_stamp reservation_date, sa.global_score, s.status status, s.time_stamp current_status_date,

            (SELECT i.source FROM images i WHERE i.id_element = sa.id_activity AND i.name_table = 'activity' AND i.type = 1 ORDER BY i.id DESC LIMIT 1) activity_img,
            (SELECT i.source FROM images i WHERE i.id_element = id_wixer AND i.name_table = 'user' AND i.type = 1 ORDER BY i.id DESC LIMIT 1) wixer_img,
            (SELECT i.source FROM images i WHERE i.id_element = sa.id_explorer AND i.name_table = 'user' AND i.type = 1 ORDER BY i.id DESC LIMIT 1) explorer_img

            FROM sale_activity sa
            INNER JOIN activity a ON sa.id_activity = a.id
            INNER JOIN user w ON id_wixer = w.id
            INNER JOIN user e ON sa.id_explorer = e.id
            INNER JOIN status rd ON sa.id = rd.id_element AND rd.name_table = 'sale_activity' AND rd.status = 'RESERVADO'
            INNER JOIN status s ON sa.id = s.id_element AND s.name_table = 'sale_activity'

            GROUP BY sa.id ORDER BY activity_date ASC";

        echo json_encode(info($query));
    break;

    case 2: //All sale activities of a user (as explorer and wixer) by idUser
        $id = $_POST['id'];
        $query = "SELECT sa.id id_sale_activity, sa.id_activity, a.name_spa, a.name_eng, a.id_wixer id_wixer, w.name wixer_name, 
            sa.id_explorer, e.name explorer_name, sa.num_persons, sa.total, sa.date_schedule activity_date, sa.payment_type, 
            rd.time_stamp reservation_date, sa.global_score, s.status status, s.time_stamp current_status_date,

            (SELECT i.source FROM images i WHERE i.id_element = sa.id_activity AND i.name_table = 'activity' AND i.type = 1 ORDER BY i.id DESC LIMIT 1) activity_img,
            (SELECT i.source FROM images i WHERE i.id_element = id_wixer AND i.name_table = 'user' AND i.type = 1 ORDER BY i.id DESC LIMIT 1) wixer_img,
            (SELECT i.source FROM images i WHERE i.id_element = sa.id_explorer AND i.name_table = 'user' AND i.type = 1 ORDER BY i.id DESC LIMIT 1) explorer_img

            FROM sale_activity sa
            INNER JOIN activity a ON sa.id_activity = a.id
            INNER JOIN user w ON id_wixer = w.id
            INNER JOIN user e ON sa.id_explorer = e.id
            INNER JOIN status rd ON sa.id = rd.id_element AND rd.name_table = 'sale_activity' AND rd.status = 'RESERVADO'
            INNER JOIN status s ON sa.id = s.id_element AND s.name_table = 'sale_activity'

            WHERE a.id_wixer = ? OR sa.id_explorer = ? GROUP BY sa.id ORDER BY activity_date ASC";
        $array = array();
        $array[0] = $id;
        $array[1] = $id;
        echo json_encode(info($query, $array));
    break;

    default:
        echo json_encode(array('Error' => "Invalid case" ));
    break;
}

?>