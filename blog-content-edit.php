<?php
$title = '文章後台-編輯文章';
$pagename = 'blog-content-edit';
?>

<?php include __DIR__ . './layout/html-head.php'; ?>
<?php include __DIR__ . './layout/header.php'; ?>
<?php include __DIR__ . './layout/aside.php'; ?>
<link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">



<style>
  .blog-content-edit {

    border-collapse: separate;
    border-spacing: 5px 10px;
    margin: 30px 0px;

  }


  .blog-content-edit-form {
    background: #FFFFFF;
    padding: 5rem;
    border-radius: 5px;
  }

  .blog-content-edit-form div {
    margin: 0 20;
  }

  .blog-content-edit-form label {
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

  .back button {
    display: flex;
    align-items: center;
  }
</style>

<main class=" admin-main px-5 py-5">

  <div class="blog-content-edit container col-20">
    <div class="row">
      <div>
        <h2>文章/類別管理/文章</h2>
        <input type="hidden" a href="blog-content-edit.php?sid=<?= $r['id'] ?>">

        <form class="blog-content-edit-form" action="">


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
            <input type="text" placeholder="請輸入文章標題">
          </div>
          <br>

          <div class="date">
            <label for="" class="col-2">發佈日期</label>
            <input type="datetime-local">
          </div>
          <br>


          <div class="content">
            <label for="" class="col-2">文章內容</label>
            <textarea id="editor01"></textarea>
          </div>
          <br>


          <div class="tags">
            <label for="" class="col-2">標籤</label>
            <input type="text" placeholder="#請填入標籤" value="#咖啡好事">
            <input type="text" placeholder="#請填入標籤" value="">
            <input type="text" placeholder="#請填入標籤" value="">
          </div>
          <br>

          <div class="button">

            <button type="button" class=" btn btn-outline-secondary"><i class="back button fa-solid fa-arrow-rotate-left"></i> 返回</button>
            <button type="button" class=" btn btn-outline-secondary"><i class="back button fa-solid fa-arrow-rotate-left"></i> 修改</button>

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
</script>