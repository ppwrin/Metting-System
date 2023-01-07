<?php
$dsn = 'mysql:host=multiinnovation_db_1;dbname=meeting';
$username = 'root';
$password = 'root';
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
try {
    $conn = new PDO($dsn, $username, $password, $options);
// echo 'ติดต่อฐานข้อมูลสำเร็จ';
} catch (Exception $e) {
// echo 'เชื่อมต่อไม่ได้'.$e->getMessage();
}
?>