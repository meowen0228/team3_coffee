<?php
$title = '文章後台-新增文章';
$pagename = 'blog-content-add'; ?>

<?php include __DIR__ . './layout/html-head.php'; ?>
<?php include __DIR__ . './layout/header.php'; ?>
<?php include __DIR__ . './layout/aside.php'; ?>
<link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
<?php

?>
<style>
  .blog-content-add {

    border-collapse: separate;
    border-spacing: 5px 10px;
    margin: 30px 0px;

  }


  .blog-content-add-form {
    background: #FFFFFF;
    padding: 5rem;
    border-radius: 5px;
  }

  .blog-content-add-form div {
    margin: 0 20;
  }

  .blog-content-add-form label {
    width: 150px;
    font-size: 15px;
    margin: 0rem 1rem 0rem 0rem;
    background-color: #CFCFCF;
    border-radius: 10px;
    text-align: center;
    /* color: #000000; */

  }

  .thumbnail {
    line-height: 150px;
  }

  .upload-imgs {
    display: flex;

  }

  .upload-imgs div {
    margin: 0;
  }

  .upload-imgs label {
    line-height: 150px;
  }

  .thumbnail button,
  .upload-imgs button {
    width: 150px;
    height: 150px;
    position: relative;
  }

  .upload-img button::before {
    content: 'x';
    display: block;
    position: absolute;
    top: -5px;
    right: 5px;
  }

  .sort {
    display: flex;
    align-items: center;
  }

  .sort label {
    line-height: 52px;
    transform: matrix(1, 0, 0.01, 1, 0, 0);
  }

  .upload-imgs button {
    margin: 0px 20px 10px 0px;
    transform: matrix(1, 0, 0.01, 1, 0, 0);
  }

  .upload-imgs input,
  .tags input {
    width: 150px;
    height: 60px;
    margin: 0px 20px 0px 0px;
    font-size: smaller;
    border: 1px solid #000000;
    border-radius: 10px;
    text-align: center;
    transform: matrix(1, 0, 0.01, 1, 0, 0);
  }


  .title {
    line-height: 50px;
  }

  .title input {
    width: 300px;
    font-size: smaller;
    text-align: center;
    border: 1px solid #000000;
    border-radius: 10px;
  }

  .content {
    display: flex;
  }

  .content div {
    margin: 0;
  }

  .content label {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .tags {
    display: flex;
    line-height: 50px;
  }
</style>

<main class=" admin-main px-5 py-5">

  <div class="blog-content-add container col-20">
    <div class="row">
      <div>
        <h2>文章/類別管理/新增文章</h2>
        <input type="hidden" a href="blog-content-add.php?id=<?= $r['id'] ?>">

        <form class="blog-content-add-form" action="">


          <div class="thumbnail">
            <label for="" class="col-2">縮圖</label>
            <button type="button">+</button>
          </div>

          <br>

          <div class="sort">
            <label for="" class="col-2">類別</label>
            <button type="button" class="btn btn-outline-secondary">咖啡篇</button>
            <button type="button" class="btn btn-outline-secondary">沖煮篇</button>
            <button type="button" class="btn btn-outline-secondary">咖啡豆篇</button>
            <button type="button" class="btn btn-outline-secondary">名人專欄篇</button>
            <button type="button" class="btn btn-outline-secondary">好物分享篇</button>
          </div>
          <br>

          <div class="upload-imgs">
            <label for="" class="col-2">匯入圖庫</label>
            <div class="d-flex flex-column">
              <button>+</button>
              <img>
              <input type="text" placeholder="請填入圖片說明">
            </div>


            <div class="d-flex flex-column">
              <button>+</button>
              <img>
              <input type="text" placeholder="請填入圖片說明">
            </div>


            <div class="d-flex flex-column">
              <button>+</button>
              <img>
              <input type="text" placeholder="請填入圖片說明">
            </div>
          </div>
          <br>

          <div class="title">
            <label for="" class="col-2">標題</label>
            <input type="text" placeholder="請輸入文章標題" name="title" value="">
          </div>
          <br>

          <div class="date">
            <label for="" class="col-2" name="date" value="">發佈日期</label>
            <input type="datetime-local">
          </div>
          <br>


          <div class="content">
            <label for="" class="col-2" name="content" value="">文章內容</label>
            <textarea id="editor01"></textarea>
          </div>
          <br>


          <div class="tags">
            <label for="" class="col-2" name="tags" value="">標籤</label>
            <input type="text" placeholder="#請填入標籤" value="#咖啡好事">
            <input type="text" placeholder="#請填入標籤" value="">
            <input type="text" placeholder="#請填入標籤" value="">
          </div>
          <br>
          <div class="button">

            <button type="button" class=" btn btn-outline-secondary"><i class="back button fa-solid fa-arrow-rotate-left"></i> 返回</button>
            <button type="button" class=" btn btn-outline-secondary"><i class="back button fa-solid fa-arrow-rotate-left"></i> 新增</button>

          </div>



        </form>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . './layout/scripts.php'; ?>
<?php include __DIR__ . './layout//html-foot.php'; ?>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor01');

  // const mobile = document.blog-content-add-form.mobile; // DOM element
  // const mobile_msg = mobile.closest('.mb-3').querySelector('.form-text');

  // const name = document.form.name;
  // const name_msg = name.closest('.mb-3').querySelector('.form-text');

  function checkForm() {
    let isPass = true; // 有沒有通過檢查

    // name_msg.innerText = ''; // 清空訊息
    // mobile_msg.innerText = ''; // 清空訊息

    // TODO: 表單資料送出之前, 要做格式檢查

    // if (name.value.length < 2) {
    //   isPass = false;
    //   name_msg.innerText = '請填寫正確的姓名'
    // }


    if (isPass) {
      const fd = new FormData(document.form1);

      fetch('blog-content-add-api.php', {
          method: 'POST',
          body: fd
        }).then(r => r.json())
        .then(obj => {
          console.log(obj);
          if (obj.success) {
            alert('新增成功');
            // location.href = 'ab-list.php';
          } else {
            alert('新增失敗');
          }

        })


    }


  }
</script>