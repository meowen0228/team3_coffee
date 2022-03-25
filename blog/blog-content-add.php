<?php

require '../layout/connect_db.php';

$title = '文章後台-新增文章';
$pagename = 'blog-content-add';


?>

<?php include '../layout/html-head.php'; ?>
<?php include '../layout/header.php'; ?>
<?php include '../layout/aside.php'; ?>
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

  /* .sort input {
    visibility: hidden;
    align-items: center;
  } */

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
    display: inline-block;
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

        <form name="form1" class="blog-content-edit-form" method="post" novalidate onsubmit="checkForm(); return false;">

          <input type="hidden" name="blogs_id" value="">

          <div class="thumbnail d-flex">
            <label for="" class="col-2">縮圖</label>
            <button id="imgUpBtn" type="button" class="img-up-btn" onclick="img_url.click()">+<img id="preview_img1" src="" ></button>
            <button type="button" class="del-img"></button>
            <input type="hidden" id="img_url_post" name="img_url_post" value="">


            
          </div>
          <br>

          <div class="sort">
            <label for="" class="col-2">類別</label>
            <div class="m-2 btn btn-outline-secondary">
              <input type="radio" class="btn btn-outline-secondary" name="types" value="1" >咖啡篇</input>
            </div>
            <div class="m-2 btn btn-outline-secondary">
              <input type="radio" class="btn btn-outline-secondary" name="types" value="2" >沖煮篇</input>
            </div>
            <div class="m-2 btn btn-outline-secondary">
              <input type="radio" class="btn btn-outline-secondary" name="types" value="3" >咖啡豆篇</input>
            </div>
            <div class="m-2 btn btn-outline-secondary">
              <input type="radio" class="btn btn-outline-secondary" name="types" value="4" >名人專欄篇</input>
            </div>
            <div class="m-2 btn btn-outline-secondary">
              <input type="radio" class="btn btn-outline-secondary" name="types" value="5" >好物分享篇</input>
            </div>
          </div>
          <br>

          <div class="title">
            <label for="" class="col-2">標題</label>
            <input type="text" placeholder="請輸入文章標題" name="title" value="">
          </div>
          <br>

          <div class="date">
            <label for="" class="col-2">發佈日期</label>
            <input type="text" name="time" readonly value="">
          </div>
          <br>


          <div class="content">
            <label for="" class="col-2">文章內容</label>
            <textarea id="editor01" name="content" ></textarea>
          </div>
          <br>


          <br>

          <div class="down-button">

            <button type="button" class=" btn btn-outline-secondary col-3 back-btn"><i class="back button fa-solid fa-arrow-rotate-left">返回</i></button>
            <button type="submit" class=" btn btn-outline-secondary col-3"><i class="fa-solid fa-pencil"> 修改</i></button>

          </div>



        </form>


        <form name="img_form" onsubmit="return false;" style="display: none;">
          <input type="file" id="img_url" class="img_url" name="img_url" accept="image/jpeg,image/png">
        </form>
        <!-- <form name="img_form" onsubmit="return false;" style="display: none;">
          <input type="file" class="img_url" name="img_url" accept="image/jpeg,image/png">
        </form>
        <form name="img_form" onsubmit="return false;" style="display: none;">
          <input type="file" class="img_url" name="img_url" accept="image/jpeg,image/png">
        </form>
        <form name="img_form" onsubmit="return false;" style="display: none;">
          <input type="file" class="img_url" name="img_url" accept="image/jpeg,image/png">
        </form> -->
      </div>
    </div>
  </div>
</main>

<?php include '../layout/scripts.php'; ?>
<?php include '../layout//html-foot.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor01');


  // 上傳照片
  function sendData() {
    const fd = new FormData(document.img_form);

    fetch('blog-content-edit-img-api.php', {
        method: 'POST',
        body: fd
      }).then(r => r.json())
      .then(obj => {
        console.log(obj);
        if (obj.success && obj.filename) {
          $(".del-img").css("background", "rgb(82, 82, 82)");
          preview_img1.src = './img/' + obj.filename;
          $("#preview_img1").css("opacity", "1");
          $("#img_url_post").val('./img/' + obj.filename);
        }
      });
  }

  img_url.onchange = sendData;

  // 照片移除
  $(".del-img").on("click", function() {
    $(this).css("background", "transparent");
    $("#preview_img1").css("opacity", "0");
    $("#img_url_post").val('');
    $("#preview_img1").attr("src", "");
  })

  $(".back-btn").click(function() {
    location.href = 'blog.php';
  })

  $(".back-btn").click(function() {
    location.href = 'blog.php';
  })



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
            location.href = 'blog.php';

          } else {
            alert('新增失敗');
          }

        })


    }

  }




  // $(".img-up-btn").on("click", function() {
  //   // console.log($(this));
  //   let index = $(this).data("num");
  //   let this_img_src = $(".preview_img").eq(index);
  //   let this_input_value = $(this).next();
  //   console.log(index);
  //   console.log(this_img_src);
  //   console.log(this_input_value);

  //   $(".img_url").eq(index).change(function() {
  //     let fd = new FormData(document.img_form[index]);
  //     fetch('blog-content-edit-img-api.php', {
  //         method: 'POST',
  //         body: fd
  //       }).then(r => r.json())
  //       .then(obj => {
  //         console.log(obj);
  //         if (obj.success && obj.filename) {
  //           console.log(this_img_src);
  //           console.log(this_input_value);
  //           this_img_src.attr("src", "./img/" + obj.filename).css("opacity", "1");
  //           this_input_value.val('./img/' + obj.filename);
  //         }
  //       });
  //   })

  //   $(".img_url").eq(index).trigger("click");

  // })
</script>