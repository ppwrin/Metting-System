<?php 
header("Content-type: application/json; charset=utf-8");
session_start();
include_once('../db/connect.php');
if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
        case 'booking':

            $start = substr($_POST['booking_time'], 0, 16);
            $end = substr($_POST['booking_time'], 19, 35);
            $start_time = $start.':00';
            $end_time = $end.':00';

            $sql = "SELECT * FROM booking WHERE book_start_date >= '$start_time' AND book_end_date <= '$end_time'";
            $query = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($query);

            if($num == 1){
                $res['res_code'] = 403;
                echo json_encode($res);
                exit;
            }else{
                $sql = "INSERT INTO booking(`room_id`, `book_start_date`, `book_end_date`, `users_id`)
                VALUES ('".$_POST["room_id"]."', '".$start_time."', '".$end_time."', '".$_SESSION['users_id']."')";
                $query = mysqli_query($conn, $sql) or die('sql exist');
                $res['res_code'] = 200;
                echo json_encode($res);
                exit;
            }
            
        break;
        case 'app':
            $sql = "UPDATE booking SET book_status = 2, updated_at = current_timestamp() WHERE book_id = '".$_POST['book_id']."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            $res['res_code'] = 200;
            echo json_encode($res);
        break;
    }
}

?>