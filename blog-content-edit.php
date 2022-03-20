<?php
$title = '文章後台-新增文章';
$pagename = 'blog-content-edit'; ?>


<?php include __DIR__ . './layout/html-head.php'; ?>
<?php include __DIR__ . './layout/header.php'; ?>
<?php include __DIR__ . './layout/aside.php'; ?>
<link rel="stylesheet" href="bootstrap\css\bootstrap.min.css">
<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


 $sql=
 sprintf("SELECT* FROM `blog_types` where id=$id );


 $row = $pdo->query($sql1)->fetch();
-- // if (empty($id)) {
-- //   header('Location: blog.php'); // 找不到資炓轉向列表頁
-- //   exit;
-- // }
?>
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
    border-radius: 10px;
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
    line-height: 60px;
  }


  .img-up-btn {
    width: 150px;
    line-height: 150px;
    color: rgb(122, 122, 122);
    font-size: 60px;
    border: 1px solid #000000;
    border-radius: 10px;
    position: relative;
  }

  .img-up-btn00 img {
    width: 150px;
    height: 150px;
    border: 1px solid #000000;
    border-radius: 10px;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
  }

  .img-up-btn img {
    width: 150px;
    height: 150px;
    border: 1px solid #000000;
    border-radius: 10px;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
  }

  .thumbnail .del-img {
    width: 26px;
    height: 26px;
    background: rgb(82, 82, 82);
    border: 1px solid #000000;
    border-radius: 50%;
    position: absolute;
    top: 10px;
    right: 50px;
    opacity: 1;
    z-index: 8;
  }

  .del-img::after,
  .del-img::before {
    content: '';
    display: block;
    background: rgb(239, 239, 239);
    width: 4px;
    height: 20px;
    border: none;
    border-radius: 10px;
    transform: rotate(135deg);
    position: absolute;
    top: 3px;
    right: 8px;
    opacity: 1;
    z-index: 1;
  }


  .del-img::before {

    transform: rotate(45deg);
    position: absolute;

  }

  .down-button {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: smaller;
  }
</style>

<main class=" admin-main px-5 py-5">

  <div class="blog-content-edit container col-20">
    <div class="row">
      <div>
        <h2>文章/類別管理/編輯文章</h2>
        <input type="hidden" a href="blog-content-edit.php?id=<?= $r['id'] ?>">

        <form class="blog-content-edit-form" action="">

          <div class="thumbnail">
            <label for="" class="col-2">縮圖</label>
            <button style="top: 20px" id="imgUpBtn" type="button" class="img-up-btn" data-num="0">+<img class="preview_img" src="" alt=""></button>
            <button type="button" class="del-img"></button>
            <input type="hidden" id="img_url_post" name="img_url_post" value="">
          </div>

          <br>

          <div class="sort">
            <label for="" class="col-2">類別</label>

            <input type="radio" class="btn-check" name="types_name options-outlined" id="blog-type01" autocomplete="off" value="1" <?php if ($row['types_name'] == 1) { ?> checked <?php } ?>>
            <label class="btn btn-outline-light" for="blog-type01">咖啡篇</label>


            <input type="radio" class="btn-check" name="types_name options-outlined" id="blog-type02" autocomplete="off" value="2" <?php if ($row['types_name'] == 2) { ?> checked <?php } ?>>
            <label class="btn btn-outline-light" for="blog-type02">沖煮篇</label>


            <input type="radio" class="btn-check" name="types_name options-outlined" id="blog-type03" autocomplete="off" value="3" <?php if ($row['types_name'] == 3) { ?> checked <?php } ?>>
            <label class="btn btn-outline-light" for="blog-type03">咖啡豆篇</label>

            <input type="radio" class="btn-check" name="types_name options-outlined" id="blog-type04" autocomplete="off" value="4" <?php if ($row['types_name'] == 2) { ?> checked <?php } ?>>
            <label class="btn btn-outline-light" for="blog-type04">名人專欄篇</label>


            <input type="radio" class="btn-check" name="types_name options-outlined" id="blog-type05" autocomplete="off" value="5" <?php if ($row['types_name'] == 2) { ?> checked <?php } ?>>
            <label class="btn btn-outline-light" for="blog-type05">好物分享篇</label>
          </div>
          <br>

          <div class="upload-imgs">
            <label for="" class="col-2">匯入圖庫</label>
            <div class="d-flex flex-column">
              <button id="imgUpBtn" type="button" class="img-up-btn" data-num="1">+<img class="preview_img" src="" alt=""></button>
              <input type="hidden" id="img_url_post01" name="img_url_post01" value="">


              <input type="text" placeholder="請填入圖片說明">
            </div>


            <div class="d-flex flex-column">
              <button id="imgUpBtn" type="button" class="img-up-btn" data-num="2">+<img class="preview_img" src="" alt=""></button>
              <input type="hidden" id="img_url_post02" name="img_url_post02" value="">
              <input type="text" placeholder="請填入圖片說明">
            </div>


            <div class="d-flex flex-column">
              <button id="imgUpBtn" type="button" class="img-up-btn" data-num="3">+<img class="preview_img" src="" alt=""></button>
              <input type="hidden" id="img_url_post03" name="img_url_post03" value="">
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


          <!-- <div class="tags">
            <label for="" class="col-2" name="tags" value="">標籤</label>
            <input type="text" placeholder="#請填入標籤" value="#咖啡好事">
            <input type="text" placeholder="#請填入標籤" value="">
            <input type="text" placeholder="#請填入標籤" value="">
          </div>
          <br> -->
          <div class="down-button">

            <button type="button" class=" btn btn-outline-secondary col-3" onclick="history.back()" value="回到上一頁"><i class="back button fa-solid fa-arrow-rotate-left"> 返回</i></button>

            <button type="submit" class=" btn btn-outline-secondary  col-3"><i class="fa-solid fa-pencil"> 修改</i></button>

          </div>



        </form>


        <form name="img_form" onsubmit="return false;" style="display: none;">
          <input type="file" class="img_url" name="img_url" accept="image/jpeg,image/png">

          <form name="img_form" onsubmit="return false;" style="display: none;">
            <input type="file" class="img_url" name="img_url" accept="image/jpeg,image/png">
          </form>

          <form name="img_form" onsubmit="return false;" style="display: none;">
            <input type="file" class="img_url" name="img_url" accept="image/jpeg,image/png">

            <form name="img_form" onsubmit="return false;" style="display: none;">
              <input type="file" class="img_url" name="img_url" accept="image/jpeg,image/png">
            </form>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . './layout/scripts.php'; ?>
<?php include __DIR__ . './layout//html-foot.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor01');


  function checkForm() {
    let isPass = true;

    if (isPass) {
      const fd = new FormData(document.form1);

      fetch('blog-content-edit-api.php', {
          method: 'POST',
          body: fd
        }).then(r => r.json())
        .then(obj => {
          console.log(obj);
          if (obj.success) {
            alert('修改成功');
            location.href = 'blog.php';
          } else {
            alert('修改失敗');
          }

        })


    }

  }

  // function sendData() {
  //   const fd = new FormData(document.img_form);

  //   fetch('blog-content-add-img-api.php', {
  //       method: 'POST',
  //       body: fd
  //     }).then(r => r.json())
  //     .then(obj => {
  //       console.log(obj);
  //       if (obj.success && obj.filename) {
  //         $(".del-img").css("background", "rgb(82, 82, 82)");
  //         preview_img1.src = './img/' + obj.filename;
  //         $("#preview_img1").css("opacity", "1");
  //         $("#img_url_post").val('./img/' + obj.filename);
  //       }
  //     });
  // }

  // img_url.onchange = sendData;


  $(".img-up-btn").on("click", function() {
    // console.log($(this));
    let index = $(this).data("num");
    let this_img_src = $(".preview_img").eq(index);
    let this_input_value = $(this).next();
    console.log(index);
    console.log(this_img_src);
    console.log(this_input_value);

    $(".img_url").eq(index).change(function() {
      let fd = new FormData(document.img_form[index]);
      fetch('blog-content-edit-img-api.php', {
          method: 'POST',
          body: fd
        }).then(r => r.json())
        .then(obj => {
          console.log(obj);
          if (obj.success && obj.filename) {
            console.log(this_img_src);
            // console.log(this_input_value);
            this_img_src.attr("src", "./img/" + obj.filename).css("opacity", "1");
            this_input_value.val('./img/' + obj.filename);
          }
        });
    })

    $(".img_url").eq(index).trigger("click");

  })
</script>