<?php

require 'connect-db.php';

// echo var_dump($_POST);
// echo json_encode($_POST); exit;

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

if (empty($_POST['id'])) {
  echo json_encode($output, JSON_UNESCAPED_UNICODE);
  exit;
}


$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

// TODO: 欄位檢查

$sql =
  "UPDATE `blogs`
SET  
`blogs.id` = ?,
`title` = ?,
`content` = ?
`url` = ?
WHERE `id` = ?";


$stmt = $pdo->prepare($sql);

$stmt->execute([
  $_POST['id'],
  $_POST['types'],
  $_POST['title'],
  $_POST['content'],


]);
$count_1 = $stmt->rowCount();

$sql_add = "INSERT INTO `blogs` (`blogs.id`, `url`) VALUES (?, ?)";
$stmt_add = $pdo->prepare($sql_add);


$stmt_add->execute([
  $_POST['id'],
  $_POST['img_url_post'],
]);
$count_2 = $stmt->rowCount();


$output['rowCount'] = $count_1 + $count_2; // 新增資料的筆數
// echo $output['rowCount'];exit;
if ($output['rowCount'] > 0) {
  $output['error'] = '';
  $output['success'] = true;
} else {
  $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
