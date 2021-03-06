<?php
 require  '../layout/connect_db.php';
  $title = '提問列表';
  $pagename = 'askList';
  $perPage = 10; // 每一頁有幾筆
  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
  if ($page < 1) {
      header('Location: user_ask-bd.php?page=1');
      exit;
  }
  
  $t_sql = "SELECT COUNT(1) FROM user_ask WHERE ans IN ('')";
  // 取得總筆數
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  $rows = []; // 預設沒有資料
  $totalPages = 0;
  if ($totalRows) {
      // 總頁數
      $totalPages = ceil($totalRows / $perPage);
      if ($page > $totalPages) {
          header("Location: user_ask-bd-no.php?page=$totalPages");
          exit;
      }
      
      $sql = sprintf(
        "SELECT
        user_name,
        user_ask.id as uask_id,
        ans,
        main,
        ask,
        user_ask.CREATEd_at as uask_CA
        FROM users
        right join user_ask on user_ask.fk_user_id = users.id 
        WHERE ans IN ('') ORDER BY uask_id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
      $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
  }
  ?>
  


<?php include  '../layout/html-head.php';?>
<?php include  '../layout/header.php';?>
<?php include  '../layout/aside.php';?>

<style>


.userSearchbox{
    /* border: #333 solid 2px; */
    border-radius: 50px;
    outline: none;
    background: #fff;
}
.askSearch{
    border: none;
    outline: none;
}
.fa-magnifying-glass{
  color: #aaa;
  
}

.userNav{
  font-size: large;
  font-weight: bolder;
  box-sizing: border-box;
}
.userMain{
  background-color: #fff;
}

.userSearchbox > .askSearch {
  width:70%;
  box-sizing:border-box; /* 使元素的寬度包括padding margin, border*/
  -moz-box-sizing:border-box;
}
.askSearch{
    font-size: smaller;
}

.select {
    width: 100%;
    border-radius: 10px;
    padding: 5px;
}

  </style>



<main class="admin-main px-5 py-5">
            <!-- 請在此處撰寫程式     -->
           
              <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <div class="row userNav">
                      <div class="col-2 userNavlift">提問列表</div>
                      <div class="col-5"></div>
                      <div class="col-2">
                             <select onChange="location = this.options[this.selectedIndex].value;" name="status" id="status" class="select">                    
                                <option value="user_ask-bd-all.php">全選</option>
                                <option value="user_ask-bd-yes.php">已回覆</option>
                                <option selected value="user_ask-bd-no.php">未回覆</option>
                              </select>
                      </div>
                      <div class="col-1"></div>
                      <div class="col-2">
                         <div class="box userSearchbox">
                          &thinsp;
                              <input type="text" size="6" class="askSearch" name="search-for" placeholder="姓名 案件編號 主旨">
                              <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
                          </div>
                      </div>
                  </div>

                </div>
                <div class="col-1"></div>
              </div>
          
            <br>
            <!-- <div class="container"> -->
            <div class="row">
    <div class="col-1"></div>
    <div class="col-10 userMain">
        
          
       
        <table class="table">  
        <thead>
            <tr>
            <th scope="col" class="col-1">案件編號</th>
            <th scope="col" class="col-2">會員名稱</th>
            <th scope="col" class="col-2">主旨</th>
            <th scope="col" class="col-3">日期</th>
            <th scope="col" class="col-1">進度</th>
            <th scope="col" class="col-1">回復/查看</th>
        </tr>
        </thead>
        <tbody>
                  <?php foreach ($rows as $r) : ?>
                        <tr class="ask">
                            
                            <td><?= $r['uask_id'] ?></td>
                            <td><?= $r['user_name'] ?></td>
                            <td><?= $r['main'] ?></td>
                            <td><?= $r['uask_CA'] ?></td>
                            <?php if ($r['ans'] == true) { ?>
                                        <td class="ans">已回復</td>
                                    <?php } else { ?>
                                        <td class="ans">未回覆</td>
                                    <?php } ?>
                        
                                    <?php if ($r['ans'] == true) { ?> 
                                        <td  align="center"><a href="user_ask_ans-yes-bd.php?id=<?= $r['uask_id']?>"><i class="fa-solid fa-eye"></a></i></td>
                                    <?php } else { ?>
                                        <td  align="center"><a href="user_ask_ans-bd.php?id=<?= $r['uask_id']?>"><i class="fa-solid fa-pen-to-square"></a></i></td>
                                    <?php } ?> 
                        </tr>
                    <?php endforeach ?>
                </tbody>
      
        </table>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script>
        //找到ask下一層ans中有包含"已"的元素，之後往同層下一個找到td向下找到a再找到i 刪除編輯class，新增眼睛class
        $(".ask").children(".ans:contains(已)").next().children().children().removeClass('fa-pen-to-square').addClass('fa-eye');  
        
        //找到ask下一層ans中有包含"已"的元素，更改CSS              
        $(".ask").children(".ans:contains(未)").css({"color":"red","font-weight":"bolder"});
        

            

          $(".askSearch").on("keyup mouseup contextmenu", function () {
              let search = $(this).val();
              if (search != '') {
              $(this).next().attr("href", "ask-list-search.php?search-for=" + search);
              }
           });
        </script>
    </div>
    <div>
        <br>
    </div>
    <div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $page==1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>">
                        <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>
                    <?php for($i=$page-5; $i<=$page+5; $i++): 
                        if($i>=1 and $i<=$totalPages):
                        ?>
                    <li class="page-item <?= $page==$i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endif; endfor; ?>
                    <li class="page-item <?= $page==$totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>">
                        <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="col-1"></div>
  </div>
  <!-- </div> container--> 
    
</main>

    <?php include  '../layout/scripts.php';?>
    <?php include  '../layout//html-foot.php';?>