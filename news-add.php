<?php
  $title = '首頁/最新消息新增';
  $pagename = 'home/news';
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
          <h4>最新消息</h4>
        </div>
        <div class="add-button col-1">
            <button type="button" class="news-add-btn btn btn-outline-secondary"><a href="">新增消息</a></button>
        </div>
        <div class="data-search col-2.5">
          <input class="data-search-input" list="" id="" >
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
      <div class="main-admin">
        <div class="mb-3">
        <h5><strong>新增消息項目</strong></h5>
        </div>
      <div class="grid rows-2 mb-3">
        <form action="">
          <div class="g-col-6">
            <div class="mb-3">
            <label class="" for="title">標題：</label>
              <input type="text"> 
            </div>
            <div class="mb-3">
            <label for="date">公告時間：</label>
              <input type="date">
            </div>
          </div>
          <div class="g-col-6">
            <div class="activity-textarea mb-3">
              <label for="content">內容：</label><br>
              <textarea class="col-10" rows="5"></textarea>
            </div>
            <button type="button" class="submut-btn btn-dark"><a href="">新增</a></button>          
          </div>
        </form>
        </div>



        
          
      
        
              
              
              
   
     
              
       
    </div>
            
    </div> <!-- col-10 end  -->
    <div class="col-1"></div>
    
  </main>


  <?php include __DIR__. '/layout/scripts.php';?>
    <?php include __DIR__. '/layout//html-foot.php';?>