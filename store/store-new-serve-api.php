<?php
  require  '../layout/connect_db.php';

  header('Content-Type: application/json');


// echo json_encode($_POST); exit;

  // 輸出的資料格式
  $output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'rowCount' => 0,
  ];
  
$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

// TODO: 欄位檢查
if( empty($_POST['new_serve_name']) ){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// $integerIDs = array_map('intval', $_POST['id']);

// serve icon table update ----------------------------------------------------------
$new_serve_icon_sql =
"INSERT INTO `store_serve_icon` (`serve_name`, `icon`)
VALUE(?, ?)";

$new_serve_icon_stmt = $pdo -> prepare($new_serve_icon_sql);

$new_serve_icon_stmt -> execute([
  $_POST['new_serve_name'],
  $_POST['new_icon'],
]);

$icon_id = $pdo->lastInsertId();

// new_store_serve ----------------------------------------------------------
$store_sql = "SELECT `id` FROM store order by `id`;";
$store_stmt = $pdo -> query($store_sql) -> fetchAll();

$new_store_serve_sql =
"INSERT INTO `store_serve` (`fk_store_id`, `fk_serve_id`, `serve_status`)
VALUE(?, ?, 0)";

$new_store_serve_stmt = $pdo -> prepare($new_store_serve_sql);

foreach ( $store_stmt as $si ){
  $new_store_serve_stmt -> execute([
    $si['id'],
    $icon_id,
  ]);
}

// 判斷修改資料 ----------------------------------------------------------
  
$output['rowCount'] = $new_serve_icon_stmt->rowCount(); // 修改資料的筆數

if( $output['rowCount'] > 0 ){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}
  
echo json_encode($output, JSON_UNESCAPED_UNICODE);