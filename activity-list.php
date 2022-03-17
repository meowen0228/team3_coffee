<?php
require __DIR__ . '/layout/connect_db.php';
$title = '首頁/優惠活動清單';
$pagename = 'home/activity';
$perPage = 100; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
  header('Location: activity-list.php?page=1');
  exit;
}

$t_sql = "SELECT COUNT(1) FROM `activity`";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
  // 總頁數
  $totalPages = ceil($totalRows / $perPage);
  if ($page > $totalPages) {
    header("Location: activity-list.php?page=$totalPages");
    exit;
  }

  $sql = sprintf("SELECT * FROM activity ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}
?>

<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>
<img src="./bootstrap/js/" alt="">
<link rel="stylesheet" href="/layout/css/admin.css">


<main class="admin-main px-5 py-5 d-flex">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="d-flex justify-content-between">
      <div class="col-6">
        <h4>優惠活動</h4>
      </div>
      <div class="col-1">
        <button type="button" class="activity-add"><a href="activity-add.php">新增活動</a></button>
      </div>
      <div class="data-search col-2.5">
        <input class="data-search-input" list="" id="">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
    </div>
    <div class="main-admin mb-3">
      <table class="table">
        <thead>
          <tr>
            <th class="contents-align" scope="col">上架/下架</th>
            <th class="contents-align" scope="col">活動標題</th>
            <th class="contents-align" scope="col">公告時間</th>
            <th class="contents-align" scope="col">優惠代碼</th>
            <th class="contents-align" scope="col" style="width: 250px;">內容</th>
            <th class="contents-align activity-icon" scope="col">編輯</th>
            <th class="contents-align activity-icon" scope="col">刪除</th>
          </tr>
        </thead>
        <tbody>
          <!-- 一筆固定的假資料 -->
          <?php foreach ($rows as $r) : ?>
            <tr>
              <td scope="col" style="display: none;"><?= $r['id'] ?></td>
              <td scope="row">
                <form class="contents-align" action="">
                  <input type="checkbox" class="contents-align" name="activityupload" value="1">
                </form>
              </td>
              <td class="contents-align"><?= $r['title'] ?></td>
              <td class="contents-align"><?= $r['start_time'] ?><br>|<br><?= $r['end_time'] ?></td>
              <td class="contents-align"> <?= $r['discount'] ?> </td>
              <td><?= $r['contents'] ?></td>
              <td scope="col" style="display: none;"><?= $r['CREATEd_at'] ?></td>
              <td class="edit-icon"><a href="activity-edit.php?id=<?= $r['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
              <td class="edit-icon"><a href="javascript: del_it(<?= $r['id'] ?>)"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
            <tr>

            <?php endforeach ?>
        </tbody>
      </table>

      <!-- <div class="page-nav d-flex justify-content-center"> -->
        <!-- <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
      </a>
    </li>
    
  </ul>
</nav> -->
        <!-- <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page - 1 ?>">
                <i class="fa-solid fa-angle-left"></i>
              </a>
            </li>
            <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
              if ($i >= 1 and $i <= $totalPages) :
            ?>
                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endif;
            endfor; ?>
            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page + 1 ?>">
                <i class="fa-solid fa-angle-right"></i>
              </a>
            </li>
          </ul>
        </nav> -->
      </div>

    </div> <!-- col-10 end  -->
    <div class="col-1"></div>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function del_it(id){
        if(confirm(`確定要刪除第 ${id} 筆的資料嗎?`)){
            location.href = 'activity-delete.php?id=' + id;
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