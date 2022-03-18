<?php
  // 連接資料庫
  require __DIR__ . '/layout/connect_db.php';
  
  // 頁面資訊
  $title = '門市管理';
  $pagename = 'store_list';

  // 每一頁有幾筆
  $perPage = 10;
  
  // 用戶要看的頁碼
  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
  if ($page < 1) {
      header('Location: store-list.php?page=1');
      exit;
  }

  // 取得總筆數
  $t_sql = "SELECT COUNT(1) FROM store";
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  
  // 預設沒有資料
  $rows = [];
  $totalPages = 0;

  if ($totalRows) {
      $totalPages = ceil($totalRows / $perPage);
      if ( $page > $totalPages ) {
          header( "Location: store-list.php?page=$totalPages" );
          exit;
      }

      $sql = sprintf("SELECT * FROM store ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
      $rows = $pdo -> query($sql) -> fetchAll(); // 拿到分頁資料
  }

  // 組合營業時間用資料庫語法
  $rowsTime = $pdo->query(
  "SELECT
  store.id,
  `store_name`,
  `city`,
  `address`,
  `phone`,
  group_concat( DISTINCT dow, ':', `status`, ' ', left(star_time, 5), '-', left(end_time, 5) order by store_time.id) AS `time`,
  group_concat( DISTINCT `icon` order by store_serve_icon.id) AS `icon_group`
  FROM `store`
  LEFT JOIN store_time ON store_time.fk_store_id = store.id
  LEFT JOIN store_serve ON store_serve.fk_store_id = store.id
  LEFT JOIN store_serve_icon ON store_serve.fk_serve_id = store_serve_icon.id
  WHERE store_serve.serve_status = 1
  GROUP BY store.id;") 
?>

<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>



  <main class="admin-main px-5 py-5 d-flex">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="d-flex justify-content-between">
        <div class="col-2">
          <h4>門市管理</h4>
        </div>
        <div class="store-search col-2.5">
          <input class="store-search-input" list="" id="" >
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
      <div class="store-table">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">門市名稱</th>
              <th scope="col">縣市</th>
              <th scope="col">詳細地址</th>
              <th scope="col">電話</th>
              <th class="store-t-center" scope="col">營業時間</th>
              <th class="store-t-center" scope="col">門市服務</th>
              <th class="store-t-center" scope="col">編輯</th>
              <th class="store-t-center" scope="col">刪除</th>
            </tr>
          </thead>
          <tbody>
            <!-- 假資料 固定 -->
            <tr>
              <td scope="col" style="display: none;">id</td>
              <td scope="row">sfdfsdf</td>
              <td>323</td>
              <td>dfsdf</td>
              <td>無連接資料庫測試用資料</td>
              <td>07-123-3333</td>
              <td class="store-time store-t-center">
                查看
                <i class="fa-solid fa-circle-info"></i>
                <div class="store-time-block text-start">
                  <p>星期一：休息</p>
                  <p>星期二：8:00-22:00</p>
                  <p>星期三：休息</p>
                  <p>星期四：8:00-22:00</p>
                  <p>星期五：8:00-22:00</p>
                  <p>星期六：8:00-22:00</p>
                  <p>星期日：8:00-22:00</p>
                </div>
              </td>
              <td class="store-t-center">
                <i class="fa-solid fa-wheelchair"></i>
                <i class="fa-solid fa-wifi"></i>
                <i class="fa-solid fa-paw"></i>
                <i class="fa-solid fa-baby"></i>
              </td>
              <td class="store-t-center"><a class="store-edit" href="store-edit.php"><i class="fa-solid fa-pen-to-square"></i></a></td>
              <td class="store-t-center"><a href="#"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>

            <!-- 假資料 撈資料庫 -->
            <?php foreach ($rowsTime as $r) : ?>
              <tr>
                <td scope="col"><?= $r['id'] ?></td>
                <td scope="row"><?= $r['store_name'] ?></td>
                <td><?= $r['city'] ?></td>
                <td><?= $r['address'] ?></td>
                <td><?= $r['phone'] ?></td>
                <td class="store-time store-t-center">
                  查看
                  <i class="fa-solid fa-circle-info"></i>
                  <div class="store-time-block">
                    <?php $t = explode(',', $r['time']) ?>
                    <?php foreach($t as $t) : ?>
                      <p><?= $t ?></p>
                    <?php endforeach ?>
                  </div>
                </td>
                <td class="store-t-center">
                    <?php $s = explode(',', $r['icon_group']) ?>
                    <?php foreach($s as $s) : ?>
                      <span><?= $s ?></span>
                    <?php endforeach ?>
                </td>
                <td class="store-t-center"><a class="store-edit" href="store-edit.php?id=<?= $r['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td class="store-t-center"><a href="#"><i class="fa-solid fa-trash-can"></i></a></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
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
    </div> <!-- col-10 end  -->
    <div class="col-1"></div>
  </main>

  <!-- dropdowns失效補用 -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<?php include __DIR__. './layout/scripts.php';?>
<?php include __DIR__. './layout//html-foot.php';?>