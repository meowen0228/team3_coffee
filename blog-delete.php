<?php
// $arr = $_POST["item"];

require 'connect-db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "DELETE FROM `blogs`  WHERE id = $id";

$stmt = $pdo->query($sql);

// echo $stmt->rowCount(); // 刪除幾筆
if (!empty($_SERVER['HTTP_REFERER'])) {
    // 從哪裡來回哪裡去
    header('Location: blog.php' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location:blog.php');
}


// $db_host = 'localhost';
// $db_user = 'root';
// $db_pass = 'Passw0rd!';
// $db_name = 'house_coffee';

// $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8";

// echo json_encode($_POST);
// exit;

// $check = $_POST['checkbox'];
// echo $check;
// print_r($check);
// $check = $_POST['checkbox'];
// foreach ($check as $value) {
//     $sql_query("delete from `blogs` where `id` = $value");
// }
// if ($db->query($sql)) {
//     header("location:blog.php");
// }
