<?php
session_start();
header("Content-type: application/json; charset=utf-8");
include_once '../db/connect_pdo.php';

if(isset($_POST["do"]) && $_POST["do"] != "" ){
    $do = $_POST["do"];
    switch($do){
        case 'login':

            if(isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                $query = "SELECT * FROM users WHERE `email` = ? LIMIT 0,1";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(1, $email);
                $stmt->execute();
                $num = $stmt->rowCount();

                if($num > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row['role'] == '3'){
                        $res['res_code'] = 402;
                        echo json_encode($res);
                        exit;  
                    }
                    $_SESSION['users_id']  = $row['users_id'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname']  = $row['lastname'];
                    $_SESSION['role']      = $row['role'];
                    $password_users        = $row['password'];

                    if(password_verify($password, $password_users)){
                        $res['res_code'] = 200;
                        $res['res_data'] = $_SESSION;
                        echo json_encode($res);
                    }else{
                        $res['res_code'] = 403;
                        echo json_encode($res);
                        exit;
                    }
                }
            }   
        break;
        case 'register':
            include_once '../db/connect.php';
            $sql = "SELECT email FROM users WHERE email = '".$_POST['email']."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            $num = mysqli_num_rows($result);
            if($num > 0){
                $res['res_code'] = 403;
                echo json_encode($res);
                exit;
            }else{   
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(firstname, lastname, email, password, role)
                VALUES ('".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['email']."', '$password', 2)"; 
                $result = mysqli_query($conn, $sql) or die(mysqli_error());
                $res['res_code'] = 200;
                echo json_encode($res);
            }
        break;  
    }
}

?>