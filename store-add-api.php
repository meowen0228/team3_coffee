<?php
  require __DIR__ . '/layout/connect_db.php';

  header('Content-Type: application/json');


  // echo json_encode($_POST); exit;
  
  // 輸出的資料格式
  $output = [
    'success' => false,
    'error' => '沒有表單資料',
    'code' => 0,
    'postData' => [],
    'insertId' => 0,
    'rowCount' => 0,
  ];

$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致





// store table insert ----------------------------------------------------------
$store_sql =
"INSERT INTO
`store` (`store_name`, `city`, `address`, `phone`, `photo`, `created_at`)
VALUES (?, ?, ?, ?, ?, NOW());";

$store_stmt = $pdo -> prepare($store_sql);

$store_stmt -> execute([
  $_POST['store_name'],
  $_POST['city'],
  $_POST['address'],
  $_POST['phone'],
  $_POST['img_url_post'],
]);

$output['insertId'] = $pdo->lastInsertId();
$output['rowCount'] = $store_stmt->rowCount(); // 修改資料的筆數

// 存取 最新store_id 供 time_table 及 serve_table 內 sql 語法做新增
$id = $pdo->lastInsertId();





// time table insert ----------------------------------------------------------
$time_sql =
"INSERT INTO `store_time` (`fk_store_id`, `dow`, `status`, `status_name`, `start_time`, `end_time`)
VALUES (?, ?, ?, ?, ?, ?);";

$time_stmt = $pdo -> prepare($time_sql);

for ( $i = 0; $i < count($_POST['dow']); $i++ ){
  $time_stmt -> execute([
    $id,
    $_POST['dow'][$i],
    $_POST['status'][$i],
    $_POST['status_name'][$i],
    $_POST['start_time'][$i],
    $_POST['end_time'][$i],
  ]);
};

$output['rowCount'] = $time_stmt->rowCount(); // 修改資料的筆數



// serve table insert ----------------------------------------------------------
$serve_sql =
"INSERT INTO `store_serve` (`fk_store_id`, `fk_serve_id`, `serve_status`)
VALUES (?, ?, ?);";

$serve_stmt = $pdo -> prepare($serve_sql);

for ( $i = 0; $i < count($_POST['serve_status']); $i++ ){
  $serve_stmt -> execute([
    $id,
    $_POST['serve_id'][$i],
    $_POST['serve_status'][$i],
  ]);
};

$output['rowCount'] = $serve_stmt->rowCount(); // 修改資料的筆數

// $i = 0;
// for ( $i = 0; $i < count($_POST['fk_serve_id']); $i++ ){
//   $fk_serve_id = $_POST['fk_serve_id'][$i];
//   $ii = $i + 1;
//   $serve_sql =
//   "INSERT INTO `store_serve` (`fk_store_id`, `fk_serve_id`, `serve_status`)
//   VALUES ('" . $id . "', '" . $ii . "', '" . $fk_serve_id . "');";
//   echo $serve_sql;
//   $stmt_serve = $pdo->query($serve_sql)->fetchAll();
// };


if( $output['rowCount'] > 0 ){
  $output['error'] = '';
  $output['success'] = true;
} else {
  $output['error'] = '資料沒有修改成功';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);