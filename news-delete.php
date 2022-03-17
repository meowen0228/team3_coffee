<?php
require __DIR__ . '/layout/connect_db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "DELETE FROM `news` WHERE id = $id";

$stmt = $pdo->query($sql);

// echo $stmt->rowCount(); // 刪除幾筆
if(! empty($_SERVER['HTTP_REFERER'])){
    // 從哪裡來回哪裡去
    header('Location: '. $_SERVER['HTTP_REFERER']);
} else {
    header('Location: news.php');
}