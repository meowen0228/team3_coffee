<?php
  require __DIR__ . '/layout/connect_db.php';

  header('Content-Type: application/json');

  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

  var_dump($_POST);
  $output['postData'] = $_POST;  // 讓前端做資料查看,資料是否一致


  $sql_1 = "DELETE FROM `store_time` WHERE `fk_store_id` = $id;";
  $sql_2 = "DELETE FROM `store_serve` WHERE `fk_store_id` = $id;";
  $sql_3 = "DELETE FROM `store` WHERE `id` = $id;";

  $stmt = $pdo->query($sql_1);
  $stmt = $pdo->query($sql_2);
  $stmt = $pdo->query($sql_3);

  if(! empty($_SERVER['HTTP_REFERER'])){
    // 從哪裡來回哪裡去
    header('Location: '. $_SERVER['HTTP_REFERER']);
  } else {
      header('Location: store-list.php');
  }