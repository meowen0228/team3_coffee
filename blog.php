<?php
require __DIR__ . '/connect-db.php';
$title = '文章後台';
$pagename = 'blog';
$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
  header('Location: blog.php?page=1');
  exit;
}

$t_sql = "SELECT COUNT(1) FROM blogs";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
  // 總頁數
  $totalPages = ceil($totalRows / $perPage);
  if ($page > $totalPages) {
    header("Location: blog.php?page=$totalPages");
    exit;
  }
  // SELECT * FROM blog_photos.fk_blog_id ORDER BY url
  $sql = sprintf(" SELECT blogs.id as id, url, title,CREATEd_at
  FROM  blog_photos
  JOIN  blogs
  ON blogs.id = blog_photos.fk_blog_id ORDER BY blogs.id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}


$stmt = $pdo->query("SELECT * FROM blog_types");
$raw_data = $stmt->fetchAll();

$first = [];


?>


<?php include __DIR__ . './layout/html-head.php'; ?>
<?php include __DIR__ . './layout/header.php'; ?>
<?php include __DIR__ . './layout/aside.php'; ?>
<img src="./bootstrap/js/" alt="">
<!-- <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<style>
  .blog-form {
    background: #FFFFFF;
    border-radius: 5px;
  }


  .assort {
    display: inline-block;
    width: 100%;
    padding-top: 10px;
    padding-bottom: 10px;
    position: relative;
    top: 0px;
  }


  .sort {
    display: inline-block;
    width: 100%;
    padding-top: 10px;
    padding-bottom: 10px;
    border: 1px solid #000000;
    position: relative;
    top: 0px;
    border-radius: 10px;

  }

  .sort li {
    list-style: none;

  }

  .blog-form button {
    display: inline-block;
    font-size: 15px;
    padding-top: 6px;
    padding-bottom: 6px;
    padding-left: 10px;
    padding-right: 10px;
    text-decoration: none;
    border-radius: 10px;
    margin-bottom: 2px;

  }

  .date01 {
    width: 200px;
  }

  .table {
    width: 100%;
    padding-left: 20px;
    padding-right: 20px;
    text-indent: initial;
    border-spacing: 5px;
    border: 1px solid #cccccc;
  }

  .thumbnail {
    max-width: 100px;
    max-height: 100px;
  }
</style>

<main class=" admin-main px-5 py-5">
  <div class="blog container">
    <div class="row">
      <h2>文章/類別管理</h2>


      <form class="blog-form">


        <!-- <div class="assort">
          <button class="btn btn-outline-secondary">新增主類別</button>
          <button class="btn btn-outline-secondary">修改主類別</button>
          <button class="btn btn-outline-secondary">刪除主類別</button>
        </div> -->
        <br />
        <div class="sort" id="head-tabs">
          <ul class="list-group list-group-horizontal-md">
            <span>主類別</span>

            <li><button class=" btn btn-outline-secondary"><a href="#tab-1" data-target="tab01">咖啡篇</a></button></li>
            <li><button class="btn btn-outline-secondary"><a href="#tab-2" data-target="tab02">沖煮篇</a></button></li>
            <li><button class="btn btn-outline-secondary"><a href="#tab-3" data-target="tab03">咖啡豆篇</a></button></li>
            <li> <button class="btn btn-outline-secondary"><a href="#tab-4" data-target="tab04">名人專欄篇</a></button></li>
            <li><button class="btn btn-outline-secondary"><a href="#tab-5" data-target="tab05">好物分享篇</a></button></li>
          </ul>
        </div>


        <br>
        <br>

        <div>
          <button class="btn btn-outline-secondary"><a href="blog-content-add.php">新增文章</a></button>
          <button type="submit" class="btn btn-outline-secondary">刪除文章</button>
        </div>


        <br>
        <form method="post" name="table" id="table" action="blog-delete.php">
          <table class="table">
            <thead>
              <tr>
                <th><input class="ck" type="checkbox" name="checkbox[]" value="全選" id="checkbox_0"></th>
                <th>縮圖</th>
                <th>標題</th>
                <th>時間</th>
                <th>編輯</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $r) : ?>
                <tr>
                  <td><input type="checkbox" name="checkbox[]" value="單項" id="checkbox-1"></td>
                  <td class="thumbnail"> <img style="width: 100px;" src="<?= $r['url'] ?>" alt=""></td>
                  <td><?= $r['title'] ?></td>
                  <td class="date01"><?= $r['CREATEd_at'] ?></td>
                  <td>
                    <button type="button" class="btn btn-light">
                      <a href="blog-content-edit.php?id=<?= $r['id'] ?>">編輯文章</a>
                    </button>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </form>

        <div class="d-flex justify-content-center mt-3">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item <?= $page==1 ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= $page-1 ?>"><i class="fa-solid fa-angle-left"></i></a>
              </li>
              <?php for($i=$page-5; $i<=$page+5; $i++): 
                  if($i>=1 and $i<=$totalPages):
                  ?>
              <li class="page-item <?= $page==$i ? 'active' : '' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
              <?php endif; endfor; ?>
              <li class="page-item <?= $page==$totalPages ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= $page+1 ?>"><i class="fa-solid fa-angle-right"></i></a>
              </li>
            </ul>
          </nav>
        </div>
    </div>
  </div>
  </div>
</main>

<?php include __DIR__ . './layout/scripts.php'; ?>
<?php include __DIR__ . './layout//html-foot.php'; ?>

<script>
  $(document).ready(function() {
    $("#tabs").head - tabs();
  });

  function checkbox_0(qx) {
    var ck = document.getElementsByClassName("ck");
    if (qx.checked) {
      for (i = 0; i < ck.length; i++) {
        ck[i].setAttribute("checked", "checked");
      }
    } else {
      for (var i = 0; i < ck.length; i++) {
        ck[i].removeAttribute("checked");
      }
    }
  }
</script>