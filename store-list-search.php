<?php
  // 連接資料庫
  require __DIR__ . '/layout/connect_db.php';
  
  // 頁面資訊
  $title = '門市管理';
  $pagename = 'store_list';

  // 抓取 search text
  $text = isset( $_GET['text'] ) ? strval($_GET['text']) : 0;
  
  $sql =
  "SELECT
  store.id,
  `store_name`,
  `city`,
  `address`,
  `phone`,
  group_concat( DISTINCT dow, ':', `status_name`, ' ', LEFT(start_time, 5), '-', LEFT(end_time, 5) ORDER BY store_time.id) AS `time`,
  group_concat( DISTINCT `icon` ORDER BY ss_ssi.ssi_id) AS `icon_group`,
  group_concat( DISTINCT `serve_name` ORDER BY ss_ssi.ssi_id) AS `serve_name`
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
  WHERE store_name  LIKE '%$text%' OR `address` LIKE '%$text%'
  GROUP BY store.id ORDER BY id";
  $rows = $pdo -> query($sql) -> fetchAll(); // 拿到分頁資料
  // $rowsNum = $rows -> rowCount();

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
            <a href="store-add.php">新增門市 +</a>
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
            <!-- 撈資料庫 -->
            <?php foreach ($rows as $r) : ?>
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
    }

    $('.store-search-input').keyup(function () {
      let search = $(this).val();
      if (search != '') {
        $(this).next().attr("href", "store-list-search.php?text=" + search);
      }
    });

  </script>
  
<?php include __DIR__. './layout/scripts.php';?>
<?php include __DIR__. './layout//html-foot.php';?>