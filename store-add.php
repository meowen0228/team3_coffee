<?php
  // 連接資料庫
  require __DIR__ . '/layout/connect_db.php';
  
  // 頁面資訊
  $title = '門市新增';
  $pagename = 'store_add';
  
  // sql 語法 start ----------------------------------------------------------

  $time_sql =
    "SELECT
    `dow`
    FROM `store_time` WHERE `fk_store_id` = 1";

  $serve_sql =
    "SELECT
    `fk_store_id`,
    store_serve_icon.id AS ssi_id,
    `serve_status`,
    `serve_name`,
    `serve_EN_name`
    FROM `store_serve`
    LEFT JOIN `store_serve_icon` ON store_serve.fk_serve_id = store_serve_icon.id
    WHERE `fk_store_id` = 1";

  // sql 語法 end ----------------------------------------------------------

  $time_row = $pdo->query($time_sql);
  $serve_row = $pdo->query($serve_sql)->fetchAll();
  
  // 取值供 js 驗證使用

  $check ="SELECT `store_name`, `phone` FROM `store`";
  $ck = $pdo->query($check)->fetchAll();

  $name = array();
  foreach($ck as $n) {
      array_push($name, $n['store_name']);
  }

  $phone = array();
  foreach($ck as $p) {
      array_push($phone, strval($p['phone']));
  }
  
?>

<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>


  <main class="admin-main px-5 py-5 d-flex">
    <div class="col-1"></div>
    <!------------------------------------------------>

    <form name="form" class="col-10 d-flex flex-column justify-content-between" method="post" novalidate onsubmit="checkForm(); return false;">
      <div class="">
        <h4 class="user-select-none">門市新增</h4>
      </div>

      <div class="col-12 d-flex flex-row justify-content-between store-table">
        <div class="col-6 mx-auto">
          <!------------------------ 編輯 ------------------------>
          <div class="store-edit-form">
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="store_name" class="form-label">門市名稱</label>
                <input type="text" class="form-control" id="store_name" name="store_name" required>
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="city" class="form-label">縣市</label>
                <input type="text" class="form-control" id="city" name="city">
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="address" class="form-label">詳細地址</label>
                <input type="text" class="form-control" id="address" name="address">
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="phone" class="form-label">電話</label>
                <input type="text" class="form-control" id="phone" name="phone">
              </div>
              <div class="form-text store-form-text justify-content-end"></div>
            </div>
          </div>
          <br>
          <!------------------------ 時間 ------------------------>
          <div class="store-edit-form">
            <p class="user-select-none">營業時間</p>
            <?php foreach ( $time_row as $tr ) : ?>
              <div class="dow mt-0 mb-2 d-flex align-items-baseline">
                <label for="store-status" class="form-label"><?= $tr['dow'] ?></label>
                <input type="hidden" name="dow[]" value="<?= $tr['dow'] ?>">
                <input id="status_name" type="hidden" name="status_name[]" value="營業">

                <select class="store-status-select" id="store-status" class="form-select" name="status[]">
                  <option value="1">營業</option>
                  <option value="0">休息</option>
                </select>
                <input type="text" class="timepicker-start store-time-select" name="start_time[]" value="08:00">
                <p> 至 </p>
                <input type="text" class="timepicker-end store-time-select" name="end_time[]" value="22:00">
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
                  <input type="hidden" name="serve_id[]" value="<?= $sr['ssi_id'] ?>">
                  <input type="hidden" name="serve_status[]" value="<?= $sr['serve_status'] ?>" id="chk_api">
                  <input class="" type="checkbox" value="<?= $sr['serve_status'] ?>" id="<?= $sr['serve_EN_name'] ?>">
                  <label class="" for="<?= $sr['serve_EN_name'] ?>">
                  

                    <?= $sr['serve_name'] ?>
                  </label>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>
        <div class="col-6 mt-4 mx-auto text-center">
          <button id="imgUpBtn" type="button" class="img-up-btn" onclick="img_url.click()">+<img id="preview_img1" src="" alt=""></button>
          <input type="hidden" id="img_url_post" name="img_url_post" value="">
        </div>
      </div>
      

      <br>
      <br>
      <div class="col-12 d-flex justify-content-evenly">
        <div class="col-4 d-flex justify-content-evenly">
          <button type="submit" class="btn btn-outline-secondary">儲存</button>
          <button type="button" class="btn btn-outline-secondary" id="cancel_btn">取消</button>
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

        fetch('store-add-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json())
        .then(obj => {
            console.log(obj);
            if(obj.success){
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