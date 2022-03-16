<?php
 require __DIR__ . '/layout/connect_db.php';
  $title = '提問列表';
  $pagename = 'askList';
  $perPage = 10; // 每一頁有幾筆
  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
  if ($page < 1) {
      header('Location: user_ask-bd.php?page=1');
      exit;
  }
  
  $t_sql = "SELECT COUNT(1) FROM users";
  // 取得總筆數
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  $rows = []; // 預設沒有資料
  $totalPages = 0;
  if ($totalRows) {
      // 總頁數
      $totalPages = ceil($totalRows / $perPage);
      if ($page > $totalPages) {
          header("Location: user_ask-bd.php?page=$totalPages");
          exit;
      }
      
      $sql = sprintf("SELECT * FROM user_ask  ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
      $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
  }
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
.userSearch{
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

.userSearchbox > .userSearch {
  width:70%;
  box-sizing:border-box; /* 使元素的寬度包括padding margin, border*/
  -moz-box-sizing:border-box;
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
                      <div class="col-3">
                            <input type="radio" name="ask" onclick="showAll()" value="全選" checked> 全選
                            <input type="radio" name="ask" onclick="showNo()" value="未回復"> 未回復
                            <input type="radio" name="ask" onclick="showYes()" value="已回答"> 已回答
                      </div>
                      
                      <div class="col-2">
                          <div class="box userSearchbox">
                          &thinsp;
                              <input type="text" size="6" class="userSearch">
                              <i class="fa-solid fa-magnifying-glass"></i>
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
            <th scope="col" class="col-2">會員編號</th>
            <th scope="col" class="col-2">主旨</th>
            <th scope="col" class="col-3">日期</th>
            <th scope="col" class="col-1">進度</th>
            <th scope="col" class="col-1">回復/查看</th>
        </tr>
        </thead>
        <tbody>
                  <?php foreach ($rows as $r) : ?>
                        <tr class="ask">
                            
                            <td><?= $r['id'] ?></td>
                            <td><?= $r['user_name'] ?></td>
                            <td><?= $r['main'] ?></td>
                            <td><?= $r['CREATEd_at'] ?></td>
                            <?php if ($r['ans'] == true) { ?>
                                        <td class="ans">已回復</td>
                                    <?php } else { ?>
                                        <td class="ans">未回覆</td>
                                    <?php } ?>
                        
                            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
        <!-- <tbody id="ak">
            <tr class="ask">
            <th scope="row">90001</th>
            <th>11001</th>
            <th>運費問題</th>
            <td>1997-01-01</td>
            <td class="ans">未回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90002</th>
            <th>11002</th>
            <th>QA2</th>
            <td>1997-01-01</td>
            <td class="ans">已回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90003</th>
            <th>11002</th>
            <th>QA3</th>
            <td>1997-01-01</td>
            <td class="ans">已回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90004</th>
            <th>11002</th>
            <th>QA4</th>
            <td>1997-01-01</td>
            <td class="ans">已回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90005</th>
            <th>11002</th>
            <th>QA5</th>
            <td>1997-01-01</td>
            <td class="ans">未回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90006</th>
            <th>11002</th>
            <th>QA6</th>
            <td>1997-01-01</td>
            <td class="ans">已回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90007</th>
            <th>11002</th>
            <th>QA7</th>
            <td>1997-01-01</td>
            <td class="ans">已回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90008</th>
            <th>11002</th>
            <th>QA8</th>
            <td>1997-01-01</td>
            <td class="ans">未回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90009</th>
            <th>11002</th>
            <th>QA9</th>
            <td>1997-01-01</td>
            <td class="ans">未回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>

            <tr class="ask">
            <th scope="row">90010</th>
            <th>11002</th>
            <th>QA10</th>
            <td>1997-01-01</td>
            <td class="ans">未回覆</td>
            <td><a href=""><i class="fa-solid fa-pen-to-square"></a></i></td>
            </tr>
            
 


  
         </tbody> -->
        </table>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script>
        //找到ask下一層ans中有包含"已"的元素，之後往同層下一個找到td向下找到a再找到i 刪除編輯class，新增眼睛class
        $(".ask").children(".ans:contains(已)").next().children().children().removeClass('fa-pen-to-square').addClass('fa-eye');  
        
        //找到ask下一層ans中有包含"已"的元素，更改CSS              
        $(".ask").children(".ans:contains(未)").css({"color":"red","font-weight":"bolder"});
        

            // $(".ask").children(".ans:contains(已)").next().remove();  
            // $(".ask").children(".ans:contains(已)").next().prepend("<i class="fa-solid fa-eye"></i>");
          function showAll(){
            $(".ask").children(".ans:contains(已)").parent().css("display","");
            $(".ask").children(".ans:contains(未)").parent().css("display","");
          }
          function showNo(){
            $(".ask").children(".ans:contains(已)").parent().css("display","none");
            $(".ask").children(".ans:contains(未)").parent().css("display","");
          }
          function showYes(){
            $(".ask").children(".ans:contains(已)").parent().css("display","");
            $(".ask").children(".ans:contains(未)").parent().css("display","none");
          }
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

    <?php include __DIR__. './layout/scripts.php';?>
    <?php include __DIR__. './layout//html-foot.php';?>