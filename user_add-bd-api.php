<?php
require __DIR__ . '/layout/connect_db.php';

header('Content-Type: application/json');
// 輸出的資料格式
$output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'rowCount' => 0,
];
// var_dump($_POST);
$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

if(empty($_POST['user_name'])){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}



// TODO: 欄位檢查


$sql = "INSERT INTO `users`(
    `user_name`, `user_birth`, `user_phone`, `user_mail`,
    `user_mail2`,`user_address`,`user_address_2`,`user_address_3`,
    `user_password`,`user_nick`,`created_at`
      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,  NOW())";

$stmt = $pdo->prepare($sql); 

$stmt->execute([
    $_POST['user_name'],
    $_POST['user_birth'],
    $_POST['user_phone'],
    $_POST['user_mail'],
    $_POST['user_mail2'],
    $_POST['user_address'] ,
    $_POST['user_address_2'],
    $_POST['user_address_3'],
    $_POST['user_password'],
    $_POST['user_nick'],
]);


$output['insertId'] = $pdo->lastInsertId(); // 取得最近加入資料的 PK
$output['rowCount'] = $stmt->rowCount(); // 新增資料的筆數
if($stmt->rowCount()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有新增成功';
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);