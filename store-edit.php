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

  // sql 語法 end ----------------------------------------------------------


  $row_1 = $pdo->query($store_sql)->fetch();
  $row_2 = $pdo->query($time_sql);
  $row_3 = $pdo->query($serve_sql)->fetchAll();

  if( empty($row_1) || empty($row_2) || empty($row_3) ){
      header('Location: store-list.php'); // 找不到資炓轉向列表頁
      exit;
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
        <h4 class="user-select-none">門市編輯</h4>
      </div>

      <div class="col-12 d-flex flex-column justify-content-between store-table">
        <div class="col-6 mx-auto">
          <!------------------------ 編輯 ------------------------>
          <div class="store-edit-form">
            <input type="hidden" name="id" value="<?= $row_1['id'] ?>">
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="store_name" class="form-label">門市名稱</label>
                <input type="text" class="form-control" id="store_name" name="store_name" required value="<?= htmlentities($row_1['store_name']) ?>">
              </div>
              <div class="form-text store-form-text"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="city" class="form-label">縣市</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= $row_1['city'] ?>">
              </div>
              <div class="form-text store-form-text"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="address" class="form-label">詳細地址</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $row_1['address'] ?>">
              </div>
              <div class="form-text store-form-text"></div>
            </div>
            <div class="mb-3 d-flex flex-column justify-content-between">
              <div class="mt-0">
                <label for="phone" class="form-label">電話</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $row_1['phone'] ?>">
              </div>
              <div class="form-text store-form-text"></div>
            </div>
          </div>
          <br>
          <!------------------------ 時間 ------------------------>
          <div class="store-edit-form">
            <p class="user-select-none">營業時間</p>
            <?php foreach ( $row_2 as $r2 ) : ?>
              <?php if ( $r2['status'] == "1" ){ ?>
                <div class="dow mt-0 mb-2 d-flex align-items-baseline">
                  <label for="store-status" class="form-label"><?= $r2['dow'] ?></label>
                  <input type="hidden" name="tid_last" value="<?= $r2['store_time_id'] ?>">
                  <input id="status_name" type="hidden" name="status_name[]" value="<?= $r2['status_name'] ?>">
                  
                  <select class="store-status-select" id="store-status" class="form-select" name="status[]" value="<?= $r2['status'] ?>">
                    <option type="hidden" value="<?= $r2['status'] ?>" selected hidden>營業</option>
                    <option value="1">營業</option>
                    <option value="0">休息</option>
                  </select>
                  <input type="text" class="timepicker-start store-time-select" name="start_time[]" value="<?= substr($r2['start_time'], 0, 5) ?>">
                  <p> 至 </p>
                  <input type="text" class="timepicker-end store-time-select" name="end_time[]" value="<?= substr($r2['end_time'], 0, 5) ?>">
                </div>
              <?php } else {?>
                <div class="dow mt-0 mb-2 d-flex align-items-baseline">
                  <label for="store-status" class="form-label"><?= $r2['dow'] ?></label>
                  <input type="hidden" name="tid_last" value="<?= $r2['store_time_id'] ?>">
                  <input id="status_name" type="hidden" name="status_name[]" value="<?= $r2['status_name'] ?>">

                  <select class="store-status-select" id="store-status" class="form-select" name="status[]" value="<?= $r2['status'] ?>">
                    <option type="hidden" value="<?= $r2['status'] ?>" selected hidden>休息</option>
                    <option value="1">營業</option>
                    <option value="0">休息</option>
                  </select>
                  <input type="text" class="timepicker-start store-time-select" name="start_time[]" value="<?= substr($r2['start_time'], 0, 5) ?>">
                  <p> 至 </p>
                  <input type="text" class="timepicker-end store-time-select" name="end_time[]" value="<?= substr($r2['end_time'], 0, 5) ?>">
                </div>
            <?php } endforeach ?>
          </div>
          <br>
          <!------------------------ 服務 ------------------------>
          <div class="mt-3">
            <p class="user-select-none">門市服務</p>
            <div class="store-serve-form">
              <?php foreach ( $row_3 as $r3 ) : ?>
                <?php if( $r3['serve_status'] == '1' ){ ?>
                  <div class="closest-div">
                    <input type="hidden" name="fk_store_id" value="<?= $r3['fk_store_id'] ?>">
                    <input type="hidden" name="fk_serve_id[]" value="<?= $r3['serve_status'] ?>" id="chk_api">

                    <input class="" type="checkbox" value="<?= $r3['serve_status'] ?>" id="<?= $r3['serve_EN_name'] ?>" checked>
                    <label class="" for="<?= $r3['serve_EN_name'] ?>">
                      <?= $r3['serve_name'] ?>
                    </label>
                  </div>
                <?php } else { ?>
                  <div class="closest-div">
                    <input type="hidden" name="fk_store_id" value="<?= $r3['fk_store_id'] ?>">
                    <input type="hidden" name="fk_serve_id[]" value="<?= $r3['serve_status'] ?>" id="chk_api">

                    <input class="" type="checkbox" value="<?= $r3['serve_status'] ?>" id="<?= $r3['serve_EN_name'] ?>">
                    <label class="" for="<?= $r3['serve_EN_name'] ?>">
                      <?= $r3['serve_name'] ?>
                    </label>
                  </div>
                <?php } endforeach ?>
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
      </div>

    </form>

    <!------------------------------------------------>
    <div class="col-1"></div>
  </main>

<!------------------------ script link ------------------------>

<!-- jquery -->
<script src="./jquery/jquery-3.6.0.min.js"></script>

<!-- jquery timepicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<!------------------------ script ------------------------>
<script>

  // timepicker
  $('.timepicker-start').timepicker({
      timeFormat: 'HH:mm',
      interval: 30,
      minTime: '00',
      maxTime: '23:30pm',

      startTime: '08:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
  });
  $('.timepicker-end').timepicker({
      timeFormat: 'HH:mm',
      interval: 30,
      minTime: '00',
      maxTime: '23:30pm',

      startTime: '08:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
  });

  // 取消儲存按鈕
  $("#cancel_btn").click(function(){
    location.href='store-list.php'
  })
  
  // checkbox value = $r3['serve_EN_name'] 改變
  $(":checkbox").on("click", function(){
    let chk = $(this).prop("checked");
    console.log(chk);
    if(chk){
    $(this).attr("value", "1");
    $(this).prev().attr("value", "1");
    } else {
    $(this).attr("value", "0");
    $(this).prev().attr("value", "0");
    }
  })  
  
  // 營業時間選項改變
  $(".store-status-select").on("change", function(){
    let selectStatus = $(this).val();
    let changeSelect = $(this).nextAll();
    let statusName = $(this).closest("div").find("#status_name");
    console.log(statusName);
    console.log(changeSelect);
    if (selectStatus == 1){
      changeSelect.removeAttr("disabled");
      changeSelect.eq(0).val("08:00").css("background", "");
      changeSelect.eq(2).val("22:00").css("background", "");
      statusName.val("營業")
    } else {
      changeSelect.eq(0).val("00:00").css("background", "#F2F2F2");
      changeSelect.eq(2).val("00:00").css("background", "#F2F2F2");
      statusName.val("休息")
    }
  })


</script>

<script>
    const store_name = document.form.store_name; // DOM element
    const city = document.form.city; // DOM element
    const address = document.form.address; // DOM element
    const phone = document.form.phone; // DOM element

    const store_name_msg = store_name.closest('.mb-3').querySelector('.form-text');
    const city_msg = city.closest('.mb-3').querySelector('.form-text');
    const address_msg = address.closest('.mb-3').querySelector('.form-text');
    const phone_msg = phone.closest('.mb-3').querySelector('.form-text');

    function checkForm(){
        let isPass = true; // 有沒有通過檢查

        store_name_msg.innerText = '';  // 清空訊息
        city_msg.innerText = '';  // 清空訊息
        address_msg.innerText = '';  // 清空訊息
        phone_msg.innerText = '';  // 清空訊息

        // TODO: 表單資料送出之前, 要做格式檢查

        if( store_name.value == "" || store_name.value.length < 2 || ! (store_name.value).includes('店') ){
            isPass = false;
            store_name_msg.innerText = '請填寫正確的門市名稱'
        }
        if( city.value == "" || city.value.length < 2 || ! city.value.includes('市') ){
            isPass = false;
            city_msg.innerText = '請填寫正確的縣市名稱'
        }
        if( address.value == "" || address.value.length < 4 || ! address.value.includes('號') || ! address.value.includes('路')){
            isPass = false;
            address_msg.innerText = '請填寫正確的地址'
        }

        const phone_re = /\d{2}-\d{3}-\d{4}$/; // new RegExp()
        if(phone.value){
            // 如果不是空字串就檢查格式
            if( ! phone_re.test(phone.value) ){
                phone_msg.innerText = '請輸入正確的電話號碼';
                isPass = false;
            }
        }
        if(isPass){
            const fd = new FormData(document.form);

            fetch('store-edit-api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.text())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    location.href = 'store-list.php';
                } else {
                    location.href = 'store-list.php';
                }
            })
        }
    }
    $(":checkbox").on("click", function(){
      let num = $('input:checkbox:checked').length;
      console.log(num);
    })
    
</script>
<?php include __DIR__. './layout/scripts.php';?>
<?php include __DIR__. './layout//html-foot.php' ?>