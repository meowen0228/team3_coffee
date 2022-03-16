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

var_dump($_POST);
$output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致





// store table insert ----------------------------------------------------------

$store_sql =
"INSERT INTO
`store` (`store_name`, `city`, `address`, `phone`, `created_at`)
VALUES (?, ?, ?, ?, NOW());";

$stmt_1 = $pdo -> prepare($store_sql);

$stmt_1 -> execute([
  $_POST['store_name'],
  $_POST['city'],
  $_POST['address'],
  $_POST['phone'],
]);

$output['insertId'] = $pdo->lastInsertId();


// 存取 最新store_id 供 time_table 及 serve_table 內 sql 語法做新增
$id = $pdo->lastInsertId();





// time table insert ----------------------------------------------------------

$i = 0;
for ( $i = 0; $i < count($_POST['dow']); $i++ ){
  $dow = $_POST['dow'][$i];
  $status = $_POST['status'][$i];
  $status_name = $_POST['status_name'][$i];
  $start_time = $_POST['start_time'][$i];
  $end_time = $_POST['end_time'][$i];
  $time_sql =
  "INSERT INTO `store_time` (`fk_store_id`, `dow`, `status`, `status_name`, `start_time`, `end_time`)
  VALUES ('" . $id . "', '" . $dow . "', '" . $status . "', '" . $status_name . "', '" . str_replace(":", "", $start_time) . "00', '" . str_replace(":", "", $end_time) . "00');";
  // echo $time_sql;
  $stmt_time = $pdo->query($time_sql)->fetchAll();
};





// serve table insert ----------------------------------------------------------

$i = 0;
for ( $i = 0; $i < count($_POST['fk_serve_id']); $i++ ){
  $fk_serve_id = $_POST['fk_serve_id'][$i];
  $ii = $i + 1;
  $serve_sql =
  "INSERT INTO `store_serve` (`fk_store_id`, `fk_serve_id`, `serve_status`)
  VALUES ('" . $id . "', '" . $ii . "', '" . $fk_serve_id . "');";
  echo $serve_sql;
  $stmt_serve = $pdo->query($serve_sql)->fetchAll();
};


$output['rowCount'] = $stmt_1->rowCount(); // 修改資料的筆數
if($stmt_1->rowCount()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);