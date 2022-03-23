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

      $sql = sprintf(
      "SELECT
      store.id,
      `store_name`,
      `city`,
      `address`,
      `phone`,
      group_concat( DISTINCT dow, ':', `status_name`, ' ', LEFT(start_time, 5), '-', LEFT(end_time, 5) ORDER BY store_time.id) AS `time`,
      group_concat( DISTINCT `icon` order by ss_ssi.ssi_id) AS `icon_group`,
      group_concat( DISTINCT `serve_name` order by ss_ssi.ssi_id) AS `serve_name`
      FROM `store`
      LEFT JOIN `store_time` ON store_time.fk_store_id = store.id
      LEFT JOIN 
      (SELECT
      `fk_store_id`,
      store_serve_icon.id as ssi_id,
      `icon`,
      `serve_name`
      FROM `store_serve`
      LEFT JOIN `store_serve_icon` on `fk_serve_id` = store_serve_icon.id
      WHERE serve_status = 1) AS ss_ssi ON ss_ssi.fk_store_id = store.id
      GROUP BY store.id ORDER BY id LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
      $rows = $pdo -> query($sql) -> fetchAll(); // 拿到分頁資料

      // 存取 store_name 進入陣列提供 js 做驗證使用
      
  }


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
        <div class="d-flex flex-row">
          <div class="col-2.5 store-add-btn">
            <a href="store-add.php">新增門市 <i class="fa-solid fa-plus"></i></a>
          </div>
          <div class="col-2.5 store-add-btn">
            <a href="store-serve.php">服務管理 <i class="fa-solid fa-pen"></i></a>
          </div>
          <div class="col-2.5 store-search">
            <input class="store-search-input" name="search-for" placeholder="搜尋門市名稱或地址">
            <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
          </div>
        </div>
      </div>
      <div class="store-table">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">編號</th>
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
            <!-- 撈資料庫 -->
            <?php $num = 0 ?>
            <?php foreach ($rows as $r) : ?>
              <?php $num += 0 ?>
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
                    <?php $time = explode(',', $r['time']) ?>
                    <?php foreach($time as $t) : ?>
                      <?php if ( strpos($t, '休息') ){ ?>
                        <p><?= substr($t, 0, 16) ?></p>
                      <?php } else { ?>
                        <p><?= $t ?></p>
                      <?php } ?>
                    <?php endforeach ?>
                  </div>
                </td>
                <td class="store-t-center">
                    <?php $s = explode(',', $r['icon_group']) ?>
                    <?php $sn = explode(',', $r['serve_name']) ?>
                    <?php foreach( array_combine($s, $sn) as $s => $sn ) : ?>
                      <span title="<?= $sn ?>"><?= $s ?></span>
                    <?php endforeach ?>
                </td>
                <td class="store-t-center"><a href="store-edit.php?id=<?= $r['id'] ?>" class="store-edit" ><i class="fa-solid fa-pen-to-square"></i></a></td>
                <td class="store-t-center"><a href="javascript: del_it(<?= $r['id'] ?>)"><i class="fa-solid fa-trash-can"></i></a></td>
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
  
  <!------------------------ script link ------------------------>

  <!-- jquery -->
  <script src="./jquery/jquery-3.6.0.min.js"></script>

  <!------------------------ script ------------------------>
  <script>

    function del_it(id){
      if(confirm(`確定要刪除編號為 ${id} 的資料嗎?`)){
          location.href = 'store-delete.php?id=' + id;
      }
    };

    // $(".store-search-input").keyup(function () {
    //   let search = $(this).val();
    //   if (search != '') {
    //     $(this).next().attr("href", "store-list-search.php?search-for=" + search);
    //   }
    // });

    $(".store-search-input").on("keyup mouseup contextmenu", function () {
      let search = $(this).val();
      if (search != '') {
        $(this).next().attr("href", "store-list-search.php?search-for=" + search);
      }
    });

    // $(document).ready(function () {
    //   load_data();
    //   function load_data(query) {
    //     $.ajax({
    //         url: "store-list-search.php",
    //         method: "GET",
    //         data: {
    //             s: query
    //         }
    //     });
    //   }
    // });
  </script>
  
<?php include __DIR__. './layout/scripts.php';?>
<?php include __DIR__. './layout//html-foot.php';?>