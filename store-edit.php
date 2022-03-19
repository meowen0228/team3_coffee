<?php
  // 連接資料庫
  require __DIR__ . '/layout/connect_db.php';
  
  // 頁面資訊
  $title = '門市編輯';
  $pagename = 'store_edit';

  // 抓取id
  $id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
  
  // sql 語法 start ----------------------------------------------------------

  $store_sql ="SELECT * FROM `store` WHERE store.id = $id";

  $time_sql =
    "SELECT
    `id` AS `store_time_id`,
    `status`,
    `status_name`,
    `dow`,
    `start_time`,
    `end_time`
    FROM `store_time` WHERE `fk_store_id` = $id";

  $serve_sql =
    "SELECT
    `fk_store_id`,
    store_serve_icon.id AS ssi_id,
    `serve_status`,
    `serve_name`,
    `serve_EN_name`
    FROM `store_serve`
    LEFT JOIN `store_serve_icon` ON store_serve.fk_serve_id = store_serve_icon.id
    WHERE `fk_store_id` = $id";

  
  $store_row = $pdo->query($store_sql)->fetch();
  $time_row = $pdo->query($time_sql);
  $serve_row = $pdo->query($serve_sql)->fetchAll();

  if( empty($store_row) || empty($time_row) || empty($serve_row) ){
      header('Location: store-list.php'); // 找不到資炓轉向列表頁
      exit;
  }
  // 取值供 js 驗證使用

  $check ="SELECT `store_name`, `phone` FROM `store`";
  $ck = $pdo->query($check)->fetchAll();

  $name = array();
  foreach($ck as $n) {
      array_push($name, $n['store_name']);
  }
  unset($name[$id-1]);
  $name = array_values($name);

  $phone = array();
  foreach($ck as $p) {
      array_push($phone, strval($p['phone']));
  }
  unset($phone[$id-1]);
  $phone = array_values($phone);
  
?>

<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>


  <main class="admin-main px-5 py-5 d-flex">
    <div class="col-1"></div>
    <!------------------------------------------------>

    <form name="form" class="col-10 d-flex flex-column justify-content-between" method="post" novalidate onsubmit="checkForm(); return false;">
      <div class="">
        <h4 class="user-select-none">門市編輯</h4>
      </div>

      <div class="col-12 d-flex flex-row justify-content-between store-table">
        <div class="col-6 mx-auto">
          <!------------------------ 編輯 ------------------------>
          <div class="store-edit-form">
            <input type="hidden" name="id" value="<?= $store_row['id'] ?>">
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="store_name" class="form-label">門市名稱</label>
                <input type="text" class="form-control" id="store_name" name="store_name" required value="<?= htmlentities($store_row['store_name']) ?>">
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="city" class="form-label">縣市</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= $store_row['city'] ?>">
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="address" class="form-label">詳細地址</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $store_row['address'] ?>">
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="phone" class="form-label">電話</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $store_row['phone'] ?>">
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
          </div>
          <br>
          <!------------------------ 時間 ------------------------>
          <div class="store-edit-form">
            <p class="user-select-none">營業時間</p>
            <?php foreach ( $time_row as $tr ) : ?>
              <input type="hidden" name="store_time_id[]" value="<?= $tr['store_time_id'] ?>">
              <div class="dow mt-0 mb-2 d-flex align-items-baseline">
                <label for="store-status" class="form-label"><?= $tr['dow'] ?></label>
                <input id="status_name" type="hidden" name="status_name[]" value="<?= $tr['status_name'] ?>">
                
                <?php if ( $tr['status'] == "1" ){ ?>
                  <select class="store-status-select" id="store-status" class="form-select" name="status[]">
                    <option value="1" selected>營業</option>
                    <option value="0">休息</option>
                <?php } else {?>
                  <select class="store-status-select" id="store-status" class="form-select" name="status[]">
                    <option value="1">營業</option>
                    <option value="0" selected>休息</option>
                <?php } ?>
                  </select>
                  <input type="text" class="timepicker-start store-time-select" name="start_time[]" value="<?= substr($tr['start_time'], 0, 5) ?>">
                  <p> 至 </p>
                  <input type="text" class="timepicker-end store-time-select" name="end_time[]" value="<?= substr($tr['end_time'], 0, 5) ?>">
                </div>
            <?php endforeach ?>
          </div>
          <br>
          <!------------------------ 服務 ------------------------>
          <div class="mt-3">
            <p class="user-select-none">門市服務</p>
            <div class="store-serve-form">
              <?php foreach ( $serve_row as $sr ) : ?>
                <div class="closest-div">
                  <input type="hidden" name="fk_store_id" value="<?= $sr['fk_store_id'] ?>">
                  <input type="hidden" name="serve_id[]" value="<?= $sr['ssi_id'] ?>">
                  <input type="hidden" name="serve_status[]" value="<?= $sr['serve_status'] ?>" id="chk_api">
                  
                  <?php if( $sr['serve_status'] == '1' ){ ?>
                    <input class="" type="checkbox" value="<?= $sr['serve_status'] ?>" id="<?= $sr['serve_EN_name'] ?>" checked>
                  <?php } else { ?>
                    <input class="" type="checkbox" value="<?= $sr['serve_status'] ?>" id="<?= $sr['serve_EN_name'] ?>">
                  <?php } ?>
                    <label class="" for="<?= $sr['serve_EN_name'] ?>">
                      <?= $sr['serve_name'] ?>
                    </label>
                  </div>
                <?php endforeach ?>
            </div>
          </div>
          <br>
          <br>
          <br>
          <div class="d-flex justify-content-evenly">
            <button type="submit" class="btn btn-outline-secondary store-edit-btn">儲存</button>
            <button type="button" class="btn btn-outline-secondary store-edit-btn" id="cancel_btn">取消</button>
          </div>
        </div>
        <div class="col-5 mt-4 mx-auto text-center position-relative">
          <?php if ($store_row['photo']== '') { ?>
            <button id="imgUpBtn" type="button" class="img-up-btn" onclick="img_url.click()">+<img id="preview_img1" src="<?= $store_row['photo'] ?>" style=""></button>
          <?php } else { ?>
            <button id="imgUpBtn" type="button" class="img-up-btn" onclick="img_url.click()">+<img id="preview_img1" src="<?= $store_row['photo'] ?>" style="opacity: 1"></button>
          <?php } ?>
          <button type="button" class="del-img"></button>
          <input type="hidden" id="img_url_post" name="img_url_post" value="">
        </div>
      </div>

    </form>

    <form name="img_form" onsubmit="return false;" style="display: none;">
      <input type="file" id="img_url" name="img_url" accept="image/jpeg,image/png">
    </form>

    <!------------------------------------------------>
    <div class="col-1"></div>
  </main>


<?php include __DIR__. './store-add-and-edit-js.php';?>

    if(isPass){
        const fd = new FormData(document.form);

        fetch('store-edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json())
        .then(obj => {
            console.log(obj);
            if(obj.success){
                alert("修改成功");
                location.href = 'store-list.php';
            } else {
                <!-- location.href = 'store-list.php'; -->
            }
        })
    }
}
</script>
<?php include __DIR__. './layout/scripts.php';?>
<?php include __DIR__. './layout//html-foot.php' ?>