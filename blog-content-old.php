<?php
$title = '文章後台';
$pagename = 'blog-content';
?>

<?php include __DIR__ . './layout/html-head.php'; ?>
<?php include __DIR__ . './layout/header.php'; ?>
<?php include __DIR__ . './layout/aside.php'; ?>
<img src="./bootstrap/js/" alt="">


<style>
  @import url('https://fonts.googleapis.com/css?family=Work+Sans:300,400');

  .classify02 {
    display: inline-block;
    width: 100%;
    padding-top: 10px;
    padding-bottom: 10px;
    background-color: #f2f2f2;
    border: 1px solid #cccccc;
    position: relative;
    top: 0px;
    border-radius: 8px;
  }

  .classify02 a {
    display: inline-block;
    font-size: 15px;
    text-align: center;
    background-color: #EFECEA;
    color: #000000;
    padding-top: 6px;
    padding-bottom: 6px;
    padding-left: 15px;
    padding-right: 15px;
    text-decoration: none;
    margin-right: 0px;
    margin-bottom: 2px;
    cursor: pointer;
  }

  a:hover {
    background-color: #A3A0A0;
    color: white;
  }

  table {
    display: table-cell;
    border-collapse: separate;
    border: none;
    text-indent: initial;
    border-spacing: 5px 10px;
    margin: 30px 0px;
  }

  .tr04 input {
    width: 100%;
    height: 25px;
    border: 1px solid #cccc;
    border-radius: 6px;
  }

  td {
    display: table-cell;
    vertical-align: middle;
    height: 30px;
    text-align: justify;
  }

  .td01 {
    width: 120px;
    font-size: 15px;
    background-color: #CFCFCF;
    border-radius: 5px;
    text-align: center;
    color: #000000;


  }

  .td01img {
    width: 50px;
    height: 50px;
  }

  .tag-container {
    display: flex;
    flex-flow: row wrap;
  }

  .tag {
    pointer-events: none;
    background-color: #242424;
    color: white;
    padding: 6px;
    margin: 5px;
  }

  .tag::before {
    pointer-events: all;
    display: inline-block;
    content: 'x';
    height: 20px;
    width: 20px;
    margin-right: 6px;
    text-align: center;
    color: #ccc;
    background-color: #111;
    cursor: pointer;
  }
</style>

<main class=" admin-main px-5 py-5">
  <h2>文章/類別管理/編輯文章</h2>
  <br>
  <br>
  <div class="container">
    <div class="row">
      <table class="tr00">
        <tbody>
          <tr class="tr01">
            <td class="td01 ">縮圖</td>
            <td>
              <div><img class="td01img" src="..." class="img-thumbnail" alt="..."></div>
              <input type="file" class="form-control" id="tdimginput01">
            </td>
          </tr>


          <tr class="tr02">
            <td class="td01">類別</td>
            <td>
              <div class="classify02">

                <a>咖啡篇</a>
                <a>沖煮篇</a>
                <a>咖啡豆篇</a>
                <a>名人專欄篇</a>
                <a>好物分享篇</a>
              </div>
            </td>
          </tr>


          <tr class="tr03 ">
            <td class="td01 ">匯入圖庫</td>
            <td>
              <div><img src="..." class="img-thumbnail" alt="..."></div>
              <input id="alt01">

            </td>
          </tr>


          <tr class="tr04">
            <td class="td01">標題</td>
            <td>
              <input type="text">
            </td>
          </tr>



          <tr class="tr05 ">
            <td class="td01 ">發佈日期</td>
            <td id="date">
              <input type="datetime-local">
            </td>
          </tr>


          <tr class="tr06 ">
            <td class="td01 ">文章內容</td>
            <td>
              <textarea id="editor">

            </textarea>
            </td>
          </tr>


          <tr class="tr07">
            <td class="td01 ">標籤</td>
            <td>
              <div class="wrapper">
                <input type="text" id="hashtags" autocomplete="off">
                <div class="tag-container">
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</main>


<?php include __DIR__ . './layout/scripts.php'; ?>
<?php include __DIR__ . './layout//html-foot.php'; ?>

<script src="/build/ckeditor.js"></script>
<script>
  ClassicEditor.create(document.querySelector('#editor'), {
      // 這裡可以設定 plugin
    })
    .then(editor => {
      console.log('Editor was initialized', editor);
    })
    .catch(err => {
      console.error(err.stack);
    });



  let input, hashtagArray, container, t;

  input = document.querySelector('#hashtags');
  container = document.querySelector('.tag-container');
  hashtagArray = [];

  input.addEventListener('keyup', () => {
    if (event.which == 13 && input.value.length > 0) {
      var text = document.createTextNode(input.value);
      var p = document.createElement('p');
      container.appendChild(p);
      p.appendChild(text);
      p.classList.add('tag');
      input.value = '';

      let deleteTags = document.querySelectorAll('.tag');

      for (let i = 0; i < deleteTags.length; i++) {
        deleteTags[i].addEventListener('click', () => {
          container.removeChild(deleteTags[i]);
        });
      }
    }
  });
</script>