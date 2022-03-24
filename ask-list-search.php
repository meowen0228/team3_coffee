<?php
  // 連接資料庫
  require __DIR__ . '/layout/connect_db.php';
  
  // 頁面資訊
  $title = '門市管理';
  $pagename = 'store_list';

  // 抓取 search text
  $text = isset( $_GET['search-for'] ) ? strval($_GET['search-for']) : 0;
  
  
  $sql =
  "SELECT
  user_name,
  user_ask.id as uask_id,
  ans,
  main,
  ask,
  user_ask.CREATEd_at as uask_CA
  FROM users
  right join user_ask on user_ask.fk_user_id = users.id
  WHERE user_ask.id LIKE '%$text%' OR `user_name` LIKE '%$text%' OR `main` LIKE '%$text%'
  GROUP BY uask_id ORDER BY uask_id DESC ";
    
  $rows = $pdo -> query($sql) -> fetchAll(); // 拿到分頁資料
  // $rowsNum = $rows -> rowCount();

//   $num = array();
//   foreach($rows as $r) {
//       array_push($num, $r['id']);
//   }

?>

<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>



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

a{
    color :black;
    text-decoration:none;
}
a:hover{
    color :black;
}
.askSearch{
    font-size: smaller;
}


  </style>



<main class="admin-main px-5 py-5">
            
           
              <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <div class="row userNav">
                      <div class="col-2 userNavlift">提問列表</div>
                      <div class="col-5"></div>
                      <div class="col-3">
                            
                      </div>
                      
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
       
            
 


  
         </tbody> 
        </table>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script>
        
        $(".ask").children(".ans:contains(未)").css({"color":"red","font-weight":"bolder"});
        

            
            function showAll(){
          
            window.location.href='user_ask-bd-all.php';
          }
          function showNo(){
           
            window.location.href='user_ask-bd-no.php';
          }
          function showYes(){
          
            window.location.href='user_ask-bd-yes.php';
          }
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
        <center><button type="submit" class="btn btn-outline-secondary store-edit-btn"><a href="user_ask-bd-all.php">回列表</a></button></center>
   
  </div>
  <!-- </div> container--> 
    
</main>

    <?php include __DIR__. './layout/scripts.php';?>
    <?php include __DIR__. './layout//html-foot.php';?>