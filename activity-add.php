<?php
$title = '首頁/優惠活動新增';
$pagename = 'activity-add';
?>

<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>
<img src="./bootstrap/js/" alt="">
<link rel="stylesheet" href="./layout/css/admin.css">
 



<main class="admin-main px-5 py-5 d-flex">
  <div class="col-1"></div>
  <div class="col-10">
    <div class="d-flex justify-content-between">
      <div class="col-6">
        <h4>優惠活動</h4>
      </div>
      <!-- <div class="add-button col-1">
        <button type="button" class="index-add-btn btn btn-outline-secondary"><a href="">新增活動</a></button>
      </div> -->
      <div class="data-search col-2.5">
        <input class="data-search-input" list="" id="">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>
    </div>
    <div class="main-admin">
      <div class="mb-3">
        <h5><strong>新增活動項目</strong></h5>
      </div>


      <div class="grid rows-2 mb-3">
        <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;" action="">
          <div class="g-col-6">
            <div class="mb-3">
              <label class="form-label" for="title">標題：</label>
              <input type="text" class="form-control" id="title" name="title" required>
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="date" class="form-label">公告期間：</label>
              <input type="date" class="form-control" id="start-time" name="start-time" required>  <input type="date" class="form-control" id="end-time" name="end-time"  required>
              <div class="form-text"></div>
            </div>
            <div class="mb-3">
              <label for="discount" class="form-label">優惠代碼：</label>
              <input type="text" class="form-control" id="discount" name="discount" required>
              <div class="form-text"></div>
            </div>
          </div>
          
            <div class="activity-textarea mb-3">
              <label for="content" class="form-label">內容：</label><br>
              <textarea class="form-control" name="contents" id="contents" rows="3"></textarea>
              <div class="form-text"></div>
            </div>
            <input type="hidden" name="status" value="0">
            <button type="submit" class="submut-btn btn btn-secondary">新增</button>
         
        </form>
      </div>

    </div>

  </div> <!-- col-10 end  -->
  <div class="col-1"></div>

</main>


<script>
  const title = document.form1.title; // DOM element
  const title_msg = title.closest('.mb-3').querySelector('.form-text');

  const discount = document.form1.discount;
  const discount_msg = discount.closest('.mb-3').querySelector('.form-text');

  function checkForm() {
    let isPass = true; // 有沒有通過檢查

    title_msg.innerText = ''; // 清空訊息
    discount_msg.innerText = ''; // 清空訊息

    // TODO: 表單資料送出之前, 要做格式檢查

    // if (title.value.length > 20) {
    //   isPass = false;
    //   title_msg.innerText = '請重新填寫標題欄位'
    // }

    // const dicount_re = "^＃\d{5,7}$/"; // new RegExp()
    // if (discount.value) {
    //   //如果不是空字串就檢查格式
    //   if (!discount_re.test(discount.value)) {
    //     discount_msg.innerText = '請輸入正確的手機號碼';
    //     isPass = false;
    //   }
    // }

    if (isPass) {
      const fd = new FormData(document.form1);

      fetch('activity-add-api.php', {
          method: 'POST',
          body: fd
        }).then(r => r.json())
        .then(obj => {
          console.log(obj);
          if (obj.success) {
            alert('新增成功');
            location.href = 'activity-list.php';
          } else {
            alert('新增失敗');
          }

        })


    }


  }
</script>

<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?>