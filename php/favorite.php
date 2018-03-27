<?php

if(!isset($_POST['case'])){
    exit();
}
include_once("info.php");
include_once("updateDatabase.php");

$case = $_POST['case'];

switch ($case) {
    case 1: //add favorite

        $id_explorer = $_POST['id_user'];
        $id_activity = $_POST['id_activity'];

        $query = "SELECT count(*) exist from favorite where id_explorer = ? and id_activity=?";
        $array_pre = array();
        $array_pre[0] = $id_explorer;
        $array_pre[1] = $id_activity;

        $response = info($query, $array_pre);


        if($response[0]['exist'] == 0){
            $query = "INSERT into favorite (id_explorer, id_activity) values (?,?)";
            $array = array();
            $array[0] = $id_explorer;
            $array[1] = $id_activity;
            echo json_encode(updateDatabase($query, $array));
        }
        else {
            $query = "DELETE from favorite where id_explorer = ? and id_activity = ?";
            $array = array();
            $array[0] = $id_explorer;
            $array[1] = $id_activity;

            $response = updateDatabase($query, $array);
            $array_to_return = array('Deleted' =>"true");
            array_push($array_to_return,$response);
            echo json_encode($array_to_return);
        }

    break;

    case 2: //All user faaavorites
        $id = $_POST['id'];
        $query = "SELECT favorite.id_activity from favorite where id_explorer = ?";
        $array = array();
        $array[0] = $id;
        echo json_encode(info($query, $array));
    break;

    default: break;
}

?>
