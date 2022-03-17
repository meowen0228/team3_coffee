<?php
  $title = '首頁/橫幅管理新增';
  $pagename = 'home/banner';
?>

<?php include __DIR__. '/layout/html-head.php';?>
<?php include __DIR__. '/layout/header.php';?>
<?php include __DIR__. '/layout/aside.php';?>
<img src="./bootstrap/js/" alt="">
<link rel="stylesheet" href="/layout/css/admin.css">



<main class="admin-main px-5 py-5 d-flex">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="d-flex justify-content-between">
        <div class="col-6">
          <h4>橫幅管理</h4>
        </div>
        <div class="add-button col-1">
            <button type="button" class="rounded-pill banner-add-btn btn btn-outline-secondary"><a href="">新增橫幅</a></button>
        </div>
        <div class="data-search col-2.5">
          <input class="data-search-input" list="" id="" >
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
      <div class="main-admin">
        <div class="mb-3">
        <h5><strong>新增橫幅項目</strong></h5>
        </div>
      <div class="grid rows-2 mb-3">
        <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;" action="">
          <div class="g-col-6">
            <div class="avtivity-photo">
                <label for="upload-photo">橫幅上傳：</label><br>
                <button class="upload-photo mb-3" style="height: 200px; width: 300px" ><i class="fa-solid fa-plus" style="font-size: 2em;"></i></button>
            </div>
          
          <div class="activity-textarea mb-3">
              <label for="content" class="form-label">內容：</label><br>
              <textarea class="form-control" name="contents" id="contents" rows="3"></textarea>
              <div class="form-text"></div>
            </div>
            <button type="submit" class="submut-btn btn btn-secondary">新增</button>          
        </form>
        </div>

    </div>
            
    </div> <!-- col-10 end  -->
    <div class="col-1"></div>
    
  </main>


  <?php include __DIR__. '/layout/scripts.php';?>
    <?php include __DIR__. '/layout//html-foot.php';?>