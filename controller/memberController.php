<?php
session_start();
header("Content-type: application/json; charset=utf-8");
include_once '../db/connect.php';

if(isset($_POST["do"]) && $_POST["do"] != "" ){
    $do = $_POST["do"];
    switch($do){
        case 'del':
            $sql = "UPDATE users SET role = 3 WHERE users_id = '".$_POST['users_id']."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            $res['res_code'] = 200;
            echo json_encode($res);
        break;  
        case 'act':
            $sql = "UPDATE users SET role = 2 WHERE users_id = '".$_POST['users_id']."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            $res['res_code'] = 200;
            echo json_encode($res);
        break;  
    }
}

?>