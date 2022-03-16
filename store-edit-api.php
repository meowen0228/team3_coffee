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
    'count' => 0,
  ];
var_dump($_POST);
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

$stmt_1 = $pdo -> prepare($store_sql);

$stmt_1 -> execute([
  $_POST['store_name'],
  $_POST['city'],
  $_POST['address'],
  $_POST['phone'],
  $_POST['id'],
]);

// 存取 store_id 供 time_table 及 serve_table 內 sql 語法做查詢
$id = $_POST['id'];





// time table update ----------------------------------------------------------

// 存取 store_time_id 對應 store_id 的起值 供 $serve_sql 語法做查詢
$tid_first = $_POST['tid_last'] - 6;

// echo $tid_first; // 檢查 store_time_id

foreach ($_POST['status'] as $key => $value){
  $time_sql = "UPDATE `store_time` SET `status` = " . $value . " WHERE `fk_store_id` = ". $id . " AND `id` =" . $tid_first . ";";
  $stmt_21 = $pdo->query($time_sql)->fetchAll();
  $tid_first += 1;
}

$tid_first = $_POST['tid_last'] - 6; // 起始值重設
foreach ($_POST['status_name'] as $key => $value){
  $time_sql = "UPDATE `store_time` SET `status_name` = '" . $value . "' WHERE `fk_store_id` = ". $id . " AND `id` =" . $tid_first . ";";
  $stmt_22 = $pdo->query($time_sql)->fetchAll();
  $tid_first += 1;
}

$tid_first = $_POST['tid_last'] - 6; // 起始值重設
foreach ($_POST['start_time'] as $key => $value){
  $time_sql = "UPDATE `store_time` SET `start_time` = " . str_replace(":", "", $value) . "00 WHERE `fk_store_id` = ". $id . " AND `id` =" . $tid_first . ";";
  $stmt_23 = $pdo->query($time_sql)->fetchAll();
  $tid_first += 1;
}

$tid_first = $_POST['tid_last'] - 6; // 起始值重設
foreach ($_POST['end_time'] as $key => $value){
  $time_sql = "UPDATE `store_time` SET `end_time` = " . str_replace(":", "", $value) . "00 WHERE `fk_store_id` = ". $id . " AND `id` =" . $tid_first . ";";
  $stmt_24 = $pdo->query($time_sql)->fetchAll();
  $tid_first += 1;
}





// serve table update ----------------------------------------------------------

// 檢視二維陣列資料
// echo($_POST['fk_serve_id'][0]);

// 產生語法變數
$serve_sql = "";
$stmt_3 = "";

// echo ($id); // <-檢查用

// 利用 foreach 產生多條 資料庫更新 語法
foreach ($_POST['fk_serve_id'] as $key => $value){
  $key += 1;
  $serve_sql = "UPDATE `store_serve` SET `serve_status` = " . $value . " WHERE `fk_store_id` = ". $id . " AND `fk_serve_id` =" . $key . ";";
  $stmt_3 = $pdo->query($serve_sql)->fetchAll();
}



// 判斷修改資料 ----------------------------------------------------------

$output['rowCount'] = $stmt_1->rowCount(); // 修改資料的筆數
if($stmt_1->rowCount()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}

$output['count'] = $stmt_21->count(); // 修改資料的筆數
if($stmt_21->count()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}

$output['count'] = $stmt_22->count(); // 修改資料的筆數
if($stmt_22->count()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}

$output['count'] = $stmt_23->count(); // 修改資料的筆數
if($stmt_23->count()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}

$output['count'] = $stmt_24->count(); // 修改資料的筆數
if($stmt_24->count()){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}





echo json_encode($output, JSON_UNESCAPED_UNICODE);