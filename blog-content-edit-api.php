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
$sql_photo_del = "DELETE FROM `blog_photos` WHERE `fk_blog_id` = ?";
$stmt_photo_del = $pdo->prepare($sql_photo_del);

$stmt_photo_del->execute([
  $_POST['id'],
]);


$sql =
  "UPDATE `blogs`
SET  
`fk_type_id` = ?,
`title` = ?,
`content` = ?
WHERE `id` = ?";


$stmt = $pdo->prepare($sql);

$stmt->execute([
  $_POST['types'],
  $_POST['title'],
  $_POST['content'],
  $_POST['id'],
]);
$count_1 = $stmt->rowCount();

echo $_POST['img_url_post'][0];

$sql_photo_add = "INSERT INTO `blog_photos` (`fk_blog_id`, `url`, `photo_alt`) VALUES (?, ?, ?)";
$stmt_photo_add = $pdo->prepare($sql_photo_add);

for ($i = 0; $i < $_POST['img_url_post']; $i++) {
  $stmt_photo_add->execute([
    $_POST['id'],
    $_POST['img_url_post'][$i],
    $_POST['photo_alt'][$i]
  ]);
  $count_2 += $stmt->rowCount();
}

$output['rowCount'] = $count_1 + $count_2; // 新增資料的筆數
// echo $output['rowCount'];exit;
if ($output['rowCount'] > 0) {
  $output['error'] = '';
  $output['success'] = true;
} else {
  $output['error'] = '資料沒有修改';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
