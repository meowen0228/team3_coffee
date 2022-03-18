<?php
  require __DIR__ . '/layout/connect_db.php';

  header('Content-Type: application/json');


echo json_encode($_POST); exit;

  // 輸出的資料格式
  $output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'rowCount' => 0,
  ];

// var_dump($_POST);
// echo $_POST['status'][3];

$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致

// TODO: 欄位檢查
if( empty($_POST['id']) ){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}



// store table update ----------------------------------------------------------

$store_sql =
"UPDATE `store`
SET  
`store_name` = ?,
`city` = ?,
`address` = ?,
`phone` = ?
WHERE `id` = ?";

$store_stmt = $pdo -> prepare($store_sql);

$store_stmt -> execute([
  $_POST['store_name'],
  $_POST['city'],
  $_POST['address'],
  $_POST['phone'],
  $_POST['id'],
]);

$output['rowCount'] = $store_stmt->rowCount(); // 修改資料的筆數

// time table update ----------------------------------------------------------

$time_sql = 
"UPDATE `store_time`
SET
`status` = ?,
`status_name` = ?,
`start_time` = ?,
`end_time` = ?
WHERE `fk_store_id` = ? AND `id` = ?";

$time_stmt = $pdo->prepare($time_sql);

for( $i = 0; $i < count($_POST['store_time_id']); $i++ ){
  $time_stmt -> execute([
    $_POST['status'][$i],
    $_POST['status_name'][$i],
    $_POST['start_time'][$i],
    $_POST['end_time'][$i],
    $_POST['fk_store_id'],
    $_POST['store_time_id'][$i],
  ]);
  
  $timeCount = $time_stmt->rowCount();
}

$output['rowCount'] = $timeCount;


// serve table update ----------------------------------------------------------

$serve_sql = 
"UPDATE `store_serve`
SET
`status` = ?,
`status_name` = ?,
`start_time` = ?,
`end_time` = ?
WHERE `fk_store_id` = ? AND `id` = ?";
$time_stmt = $pdo->prepare($time_sql);

for( $i = 0; $i < count($_POST['store_time_id']); $i++ ){
  $time_stmt -> execute([
    $_POST['status'][$i],
    $_POST['status_name'][$i],
    $_POST['start_time'][$i],
    $_POST['end_time'][$i],
    $_POST['fk_store_id'],
    $_POST['store_time_id'][$i],
  ]);
  
  $timeCount = $time_stmt->rowCount();
}

$output['rowCount'] = $timeCount;
// 產生語法變數
// $serve_sql = "";
// $stmt_3 = "";

// // echo ($id); // <-檢查用

// // 利用 foreach 產生多條 資料庫更新 語法
// foreach ($_POST['fk_serve_id'] as $key => $value){
  //   $key += 1;
  //   $serve_sql = "UPDATE `store_serve` SET `serve_status` = " . $value . " WHERE `fk_store_id` = ". $id . " AND `fk_serve_id` =" . $key . ";";
  //   $stmt_3 = $pdo->query($serve_sql)->fetchAll();
  // }
  
  
  // 判斷修改資料 ----------------------------------------------------------
  
  if( $output['rowCount'] > 0 ){
      $output['error'] = '';
      $output['success'] = true;
  } else {
      $output['error'] = '資料沒有修改成功';
  }
  
  
  
  
  
  
  
  
  echo json_encode($output, JSON_UNESCAPED_UNICODE);