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



  <main class="admin-main px-5 py-5 d-flex">
    <div class="col-2"></div>
    <div class="col-8">
      <div class="d-flex justify-content-between">
        <div class="col-4">
          <h4>門市服務管理</h4>
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
                  <th scope="col" title="注意，請使用免費圖示!"><a href="https://fontawesome.com/search?m=free" target="_blank"><button type="button" class="btn btn-outline-secondary">圖示來源</button></a></th>
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
          <div>
            <button type="button" class="btn btn-outline-secondary" id="cancel_btn">返回</button>
            <button type="submit" class="btn btn-outline-secondary">儲存修改</button>
          </div>
        </form>
      </div>
      <br>
      </div>
    </div> <!-- col-10 end  -->
    <div class="col-2"></div>
  </main>

  <!-- dropdowns失效補用 -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  
  <!------------------------ script link ------------------------>

  <!-- jquery -->
  <script src="./jquery/jquery-3.6.0.min.js"></script>

  <!------------------------ script ------------------------>
  <script>

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