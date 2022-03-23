<?php
  // 連接資料庫
  require __DIR__ . '/layout/connect_db.php';
  
  // 頁面資訊
  $title = '門市服務管理';
  $pagename = 'store_serve';
  
  $sql ="SELECT * FROM store_serve_icon";

  $rows = $pdo -> query($sql) -> fetchAll(); 

?>

<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>

<style>
.popup-wrap {
  width: 100%;
  height: 100%;
  display: none;
  position: fixed;
  top: 0px;
  left: 0px;
  background: rgba(0, 0, 0, 0.4);
}
.popup-box {
  padding: 50px 50px;
  -webkit-transform: translate(-50%, -50%) scale(.6);
  transform: translate(-50%, -50%) scale(.6);
  position: absolute;
  top: 50%;
  left: 50%;
  box-shadow: 0px 2px 16px rgba(0, 0, 0, 0.5);
  border-radius: 5px;
  background: #fff;
  text-align: center;
}
.close-btn {
  width: 50px;
  line-height: 50px;
  display: inline-block;
  position: absolute;
  top: 0px;
  right: 0px;
  text-decoration: none;
  color: black;
  line-height: 40px;
  font-size: 32px;
}

.transform-in, .transform-out {
  display: block;
  -webkit-transition: all ease 0.5s;
  transition: all ease 0.5s;
}

.transform-in {
  -webkit-transform: translate(-50%, -50%) scale(1);
  transform: translate(-50%, -50%) scale(1);
}

.transform-out {
  -webkit-transform: translate(-50%, -50%) scale(.6);
  transform: translate(-50%, -50%) scale(.6);
}
.new_form input{
  padding: .5rem 2rem;
  background: #F2F2F2;;
  border: none;
  border-radius: 50px;
  outline: none;
  transition: var(--store-transition);
}
.new_form input:focus{
  outline: 1.5px solid gray;
}
</style>

  <main class="admin-main px-5 py-5 d-flex">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="d-flex justify-content-between">
        <div class="col-12 d-flex justify-content-between">
          <div>
            <h4>門市服務管理</h4>
          </div>
          <div class="col-2.5 store-add-btn d-flex me-0">
            <a href="#popup-wrap" class="popup-btn">新增服務 <i class="fa-solid fa-plus"></i></a>
          </div>
        </div>
      </div>
      <div class="store-table">
        <form name="old_form" method="post" novalidate onsubmit="checkForm(); return false;">
          <div>
            <table class="table">
              <thead class="store-t-center">
                <tr>
                  <th scope="col">編號</th>
                  <th scope="col">名稱</th>
                  <th scope="col" title="注意，請使用免費圖示!"><a href="https://fontawesome.com/search?m=free" target="_blank"><button type="button" class="btn btn-outline-secondary store-edit-btn">圖示來源</button></a></th>
                  <th scope="col">圖示</th>
                </tr>
              </thead>
              <tbody class="store-t-center">
                <!-- 撈資料庫 -->
                <?php foreach ($rows as $r) : ?>
                  <tr class="serve_input">
                    <td scope="col" class="num"><?= $r['id'] ?><input type="hidden" name="id[]" value="<?= $r['id'] ?>"></td>
                    <td scope="row">
                    <input type="text" class="serve_name" name="serve_name[]" value="<?= $r['serve_name'] ?>">
                    </td>
                    <td class="icon_i" scope="row">
                    <input type="text" name="icon[]" value="<?= htmlentities($r['icon']) ?>">
                    </td>
                    <td class="icon"><?= $r['icon'] ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              <button type="button" class="btn btn-outline-secondary store-edit-btn" id="cancel_btn">返回</button>
              <button type="submit" class="btn btn-outline-secondary store-edit-btn">儲存修改</button>
            </div>
          </div>
        </form>
      </div>
      <br>
      </div>
    </div> <!-- col-10 end  -->
    <div class="col-2"></div>

    <div class="popup-wrap" id="popup-wrap">
      <div class="popup-box">
        <form name="new_form" class="new_form d-flex flex-column text-start">
          <h5>新增服務項目</h5>
          <div class="mt-3">
            <label for="new_serve_name" class="me-3">服務名稱</label>
            <input type="text" name="new_serve_name">
          </div>
          <div class="mt-3">
            <label for="new_icon" class="me-3">圖示來源</label>
            <input type="text" name="new_icon">
          </div>
          <div class="mt-5 mb-5">
            <label for="" class="me-3">圖示</label>
            <p></p>
          </div>
          <a class="close-btn popup-close text-center" href="#"><i class="fa-solid fa-xmark"></i></a>
          <div class="text-center">
            <button type="submit" class="btn btn-outline-secondary store-edit-btn">新增</button>
          </div>
        </form>
      </div>
    </div>

  </main>

  <!-- dropdowns失效補用 -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  
  <!------------------------ script link ------------------------>

  <!-- jquery -->
  <script src="./jquery/jquery-3.6.0.min.js"></script>

  <!------------------------ script ------------------------>
  <script>

    // pop up
    $(".popup-btn").click(function() {
      let href = $(this).attr("href")
      $(href).fadeIn(250);
      $(".popup-box").removeClass("transform-out").addClass("transform-in");
      event.preventDefault();
    });

    $(".popup-close").click(function() {
      closeWindow();
    });
    // $(".popup-wrap").click(function(){
    //   closeWindow();
    // })
    function closeWindow(){
      $(".popup-wrap").fadeOut(200);
      $(".popup-box").removeClass("transform-in").addClass("transform-out");
      event.preventDefault();
    }

    // 取消儲存按鈕
    $("#cancel_btn").click(function(){
        location.href='store-list.php'
    })

    // 輸入新的圖示來源
    $(".icon_i").on("keyup paste", function(){
      let change_input = $(this).find("input").val();
      $(this).next().html(change_input);
    });
    
    // 新增類別 row
    // $("#add-row").on("click", function(){
    //   let num = $("tbody").find("tr").last().find(".num").text();
    //   num = parseInt(num) + 1;
    //   console.log(num);
    //   let newRow =
    //     `<tr class="serve_input">
    //     <td scope="col" class="num">${num}</td>
    //     <td scope="row">
    //     <input type="text" class="serve_name" name="new_serve_name[]">
    //     </td>
    //     <td class="icon_i" scope="row">
    //     <input type="text" name="new_icon[]">
    //     </td>
    //     <td class="icon"></td>
    //     <td class="store-t-center"><i class="fa-solid fa-trash-can del-row"></i></td>
    //   </tr>`;

    //   $("tbody").append(newRow);

    //   $(".icon_i").on("keyup paste", function(){
    //   let change_input = $(this).find("input").val();
    //   console.log(change_input);
    //   $(this).next().html(change_input);
    //   });

    //   $("tbody").on("click", ".del-row", function(){
    //     $(this).closest("tr").remove();
    //   });
      
    //   $(".serve_name").on("keyup paste click", function(){
    //     console.log($(this));
    //     let newName = $(this).val();
    //     console.log(newName);
    //   // arr = push();
    //   });

    // });

    // 刪除資料
    // function del_it(id){
    //   if(confirm(`確定要刪除編號為 ${id} 的資料嗎?`)){
    //       location.href = 'store-delete.php?id=' + id;
    //   }
    // };
      
    //
    // let arr = $.map($(".serve_name"), function (el) { return el.value; });
    // $(".serve_name").on("keyup paste click", function(){
    //   console.log($(this));
    //   // let newName = $(this).val();
    //   // console.log(newName);
    //   // arr = push();
    // });


    function checkForm(){
      let isPass = true; // 有沒有通過檢查
      if(isPass){
          const fd = new FormData(document.old_form);

          fetch('store-serve-api.php', {
              method: 'POST',
              body: fd
          }).then(r => r.json())
          .then(obj => {
              console.log(obj);
              if(obj.success){
                  alert("修改成功");
                  location.href = 'store-serve.php';
              } else {
                  alert("沒有修改");
              }
          })
        }
    }

  </script>
  
<?php include __DIR__. './layout/scripts.php';?>
<?php include __DIR__. './layout//html-foot.php';?>