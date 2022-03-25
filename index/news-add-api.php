<?php
require  '../layout/connect_db.php';

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

// var_dump($_POST);

if(empty($_POST['title'])){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

// TODO: 欄位檢查


// $sql = "INSERT INTO `address_book`(
//     `name`, `email`, `mobile`, `birthday`,
//     `address`, `created_at`
//       ) VALUES (?, ?, ?, ?, ?, NOW())";

$sql = "INSERT INTO `news`
    (`title`,`contents`,`CREATED_at`)  VALUES(?,?,NOW())";


// echo $sql;
$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['title'],
    $_POST['contents'],
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






// $sql = "INSERT INTO `banner`
//     (`photo`,`title`,`status`)  VALUES(?,?,'0')";


