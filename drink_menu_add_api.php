<?php
require __DIR__ . '/layout/connect_db.php';

header('Content-Type: application/json');
// 輸出的資料格式
$output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'insertId' => 0,
    'rowCount' => 0,
];
// echo json_encode($_POST); exit;

// if(empty($_POST['drink_name'])){
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

// TODO: 欄位檢查


$sql = "INSERT INTO `drink_menu`(
    `status`, `drink_name`, `price`, `url`,
    `content`
      ) VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

// var_dump($_POST);

$stmt->execute([
    $_POST['productstatus1'],
    $_POST['drink_name'] ,
    $_POST['price'] ,
    $_POST['img_url_post'] ,
    $_POST['content']  ,
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