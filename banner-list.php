<?php
require __DIR__ . '/layout/connect_db.php';
$title = '首頁/橫幅管理清單';
$pagename = 'home/banner';
$perPage = 100; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
  header('Location: banner-list.php?page=1');
  exit;
}

$t_sql = "SELECT COUNT(1) FROM `banner`";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
  // 總頁數
  $totalPages = ceil($totalRows / $perPage);
  if ($page > $totalPages) {
    header("Location: banner-list.php?page=$totalPages");
    exit;
  }

  $sql = sprintf("SELECT * FROM banner ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}
?>

<style>

</style>

<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>
<img src="./bootstrap/js/" alt="">
<link rel="stylesheet" href="/layout/css/admin.css">

<main class="admin-main px-5 py-5 d-flex">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="d-flex justify-content-between">
      <div class="col-2">
        <h4>橫幅管理</h4>
      </div>
      <div class="d-flex flex-row">
      <div class="add-btn col-2 d-block me-2"><a class="" href="banner-add.php">新增活動</a></div>
      <div class="data-search col-2.5">
          <input class="data-search-input" list="" id="" >
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
    </div>
    <div class="main-admin">
      <table class="mb-3 table">
        <thead>
          <tr>
            <th class="contents-align" scope="col">上架/下架</th>
            <th class="contents-align" scope="col">圖片</th>
            <th class="contents-align" scope="col">橫幅標題</th>
            <th class="contents-align" class="activity-icon" scope="col">編輯</th>
            <th class="contents-align" class="activity-icon" scope="col">刪除</th>
          </tr>
        </thead>
        <tbody>
          <!-- 一筆固定的假資料 -->
          <?php foreach ($rows as $r) : ?>
            <tr>
              <td scope="col" style="display: none;"><?= $r['id'] ?></td>
              <td scope="row">
                <form action="">
                  <input type="checkbox" class="newupload" name="newupload">
                </form>
              </td>
              <td><?= $r['title'] ?></td>
              <td class="contents-align"><img style="width: 100px;" src="<?= $r['photo'] ?>" alt=""></td>
              <td class="banner-icon"><a class="banner-edit" href="banner-edit.php?id=<?= $r['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
              <td class="banner-icon"><a href=" javascript: del_it(<?= $r['id'] ?>)"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>


    </div> <!-- col-10 end  -->
    <div class="col-1"></div>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function del_it(id){
        if(confirm(`確定要刪除編號為 ${id} 的資料嗎?`)){
            location.href = 'banner-delete.php?id=' + id;
        }
    }
</script>

<script>
  //限制選取四個checkbox
  $('input[type=checkbox]').change(function(e) {
    if ($('input[type=checkbox]:checked').length > 4) {
      $(this).prop('checked', false);
      alert("allowed only 4");
    }
  })
</script>

<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?>