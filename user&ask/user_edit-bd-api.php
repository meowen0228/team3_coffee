<?php
require  '../layout/connect_db.php';

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

if(empty($_POST['user_id']) or empty($_POST['user_name'])){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}



// TODO: 欄位檢查


$sql = "UPDATE `users` SET  
        `user_url`=?,
        `user_name`=?,
        `user_birth`=?,
        `user_phone`=?,
        `user_mail`=?,
        `user_mail2`=?,
        `user_address`=?,
        `user_address_2`=?,
        `user_address_3`=?,
        `user_password`=?,
        `user_nick`=?
        WHERE `id`=?";

$stmt = $pdo->prepare($sql); 

$stmt->execute([
    $_POST['img_url_post'] ,
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
    $_POST['user_id'],
]);


$output['rowCount'] = $stmt->rowCount(); // 修改資料的筆數
if($stmt->rowCount()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);