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
if( empty($_POST['id']) ){
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


// serve icon table update ----------------------------------------------------------
$serve_icon_sql =
"UPDATE `store_serve_icon`
SET  
`serve_name` = ?,
`icon` = ?
WHERE `id` = ?";

$serve_icon_stmt = $pdo -> prepare($serve_icon_sql);


$serveIconCount = 0;
for( $i = 0; $i < count($_POST['serve_name']); $i++ ){
  $serve_icon_stmt -> execute([
    $_POST['serve_name'][$i],
    $_POST['icon'][$i],
    $_POST['id'][$i],
  ]);
  $serveIconCount += $serve_icon_stmt->rowCount();
}



// 判斷修改資料 ----------------------------------------------------------
  
$output['rowCount'] = $serveIconCount; // 修改資料的筆數

if( $output['rowCount'] > 0 ){
    $output['error'] = '';
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改成功';
}
  
echo json_encode($output, JSON_UNESCAPED_UNICODE);