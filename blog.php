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
  $sql = sprintf(" SELECT blogs.id, url, title,CREATEd_at
  FROM  blog_photos
  JOIN  blogs
  ON blogs.id = blog_photos.fk_blog_id ORDER BY blogs.id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
  $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}


$stmt = $pdo->query("SELECT * FROM blog_types");
$raw_data = $stmt->fetchAll();

$first = [];

// // 把第一層的資料放到陣列裡
// foreach ($raw_data as $r) {
//   if ($r['parent_sid'] == 0) {
//     $first[] = $r;
//   }
// }


// echo json_encode($first);
// 
?>


<?php include __DIR__ . './layout/html-head.php'; ?>
<?php include __DIR__ . './layout/header.php'; ?>
<?php include __DIR__ . './layout/aside.php'; ?>
<img src="./bootstrap/js/" alt="">
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
    /* background-color: #F2F2F2; */
    border: 1px solid #000000;
    position: relative;
    top: 0px;
    border-radius: 10px;
  }

  .blog-form button {
    display: inline-block;
    font-size: 15px;
    /* text-align: center; */
    /* background-color: #EFECEA;
    color: #000000; */
    padding-top: 6px;
    padding-bottom: 6px;
    padding-left: 10px;
    padding-right: 10px;
    text-decoration: none;
    border-radius: 10px;
    margin-bottom: 2px;

  }

  .date01 {
    width: 50px;
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


        <div class="assort">
          <button class="btn btn-outline-secondary">新增主類別</button>
          <button class="btn btn-outline-secondary">修改主類別</button>
          <button class="btn btn-outline-secondary">刪除主類別</button>
        </div>
        <div class="sort">
          <span>主類別</span>

          <button class="btn btn-outline-secondary">咖啡篇</button>
          <button class="btn btn-outline-secondary">沖煮篇</button>
          <button class="btn btn-outline-secondary">咖啡豆篇</button>
          <button class="btn btn-outline-secondary">名人專欄篇</button>
          <button class="btn btn-outline-secondary">好物分享篇</button>
        </div>
        <br>
        <br>
        <br>
        <div>
          <button class="btn btn-outline-secondary"><a href="blog-content-add.php">新增文章</button>
          <button class="btn btn-outline-secondary">刪除文章</button>
        </div>


        <br>
        <table class="table">
          <thead>
            <tr>
              <th><input type="checkbox"></th>
              <th>縮圖</th>
              <th>標題</th>
              <th>時間</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $r) : ?>
              <tr>
                <td><input type="checkbox"></td>
                <td class="thumbnail"> <img style="width: 100px;" src="<?= $r['url'] ?>" alt="">
                <td>
                <td><?= $r['title'] ?></td>
                <td class="date01"><?= $r['CREATEd_at'] ?></td>
                <td><button type="button" class="btn btn-light"><a href="blog-content-edit.php?sid=<?= $r['id'] ?>">編輯文章</button></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>


        <ul class=" pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </form>
    </div>
  </div>
  </div>
</main>

<?php include __DIR__ . './layout/scripts.php'; ?>
<?php include __DIR__ . './layout//html-foot.php'; ?>