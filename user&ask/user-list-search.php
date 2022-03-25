<?php
  // 連接資料庫
  require  '../layout/connect_db.php';
  
  // 頁面資訊
  $title = '門市管理';
  $pagename = 'store_list';

  // 抓取 search text
  $text = isset( $_GET['search-for'] ) ? strval($_GET['search-for']) : 0;
  
  $sql =
  "SELECT * FROM users 
    WHERE id  LIKE '%$text%' OR `user_name` LIKE '%$text%'
    GROUP BY id ORDER BY id DESC ";
    
  $rows = $pdo -> query($sql) -> fetchAll(); // 拿到分頁資料
  // $rowsNum = $rows -> rowCount();

  $num = array();
  foreach($rows as $r) {
      array_push($num, $r['id']);
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
.fa-trash-can{
  color: red;
}
.imgin{
  width: 100px;
  height: 100px;
  text-align:center
}
.user_img{
  /* border-radius: 50%; */
  max-width: 100%;
  max-height:100% ;
  /* vertical-align : middle; */
}

a{
    color :black;
    text-decoration:none;
}
a:hover{
    color :black;
}
.userSearch{
    font-size: smaller;
}
  </style>



<main class="admin-main px-5 py-5">
            <!-- 請在此處撰寫程式     -->
           
              <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <div class="row userNav">
                      <div class="col-2 userNavlift">會員列表</div>
                      <div class="col-6"></div>
                      <div class="col-2">
                      <a href="user_add-bd.php"><button type="button" class="btn btn-light "> 會員新增 </button> </a>
                      </div>
                      
                      <div class="col-2">
                          <div class="box userSearchbox">
                          &thinsp;
                              <input type="text" size="6" class="userSearch"  name="search-for" placeholder="搜尋姓名或編號">
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
      <th scope="col" class="col-1">編號</th>
      <th scope="col" class="col-2">會員頭像</th>
      <th scope="col" class="col-2">會員姓名</th>
      <th scope="col" class="col-2">會員信箱</th>
      <th scope="col" class="col-2">加入日期</th>
      <th scope="col" class="col-1">編輯</th>
      <th scope="col" class="col-1">刪除</th>
    </tr>
  </thead>
                <tbody>
                  <?php foreach ($rows as $r) : ?>
                        <tr>
                            
                            <td><?= $r['id'] ?></td>
                            <td>
                                <div class="imgin">
                                    <?php if($r['user_url']==''){?>
                                    <img src="./img/user-A.jpeg" alt="" class="user_img">
                                    <?php } else{?>
                                      <img src="<?= $r['user_url'] ?>" alt="" class="user_img">
                                  <?php } ?>
                                </div>
                            </td>
                            <td><?= $r['user_name'] ?></td>
                            <td><?= $r['user_mail'] ?></td>
                            <td><?= $r['CREATEd_at'] ?></td>
                            <td>
                              <a href="user_edit-bd.php?id=<?= $r['id']?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td><a href="javascript: del_it(<?= $r['id'] ?>)">
                              <i class="fa-solid fa-trash-can"></i>
                              </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
        </table>
    </div>
            <br>
    <div class="col-1"></div>
  </div>
  <br>
  <center><button type="submit" class="btn btn-outline-secondary store-edit-btn"><a href="user_list-bd.php">回列表</a></button></center>
  </div>
  <!-- </div> container--> 
    
</main>

<script>
    function del_it(id){
        if(confirm(`確定要刪除編號為 ${id} 的資料嗎?`)){
            
            location.href = 'user_delete-bd.php?id=' + id;
        }
        
    }
    $(".userSearch").on("keyup mouseup contextmenu", function () {
        let search = $(this).val();
        if (search != '') {
            $(this).next().attr("href", "user-list-search.php?search-for=" + search);
        }
    });
    
    
</script>

<?php include  '../layout/scripts.php';?>
<?php include  '../layout//html-foot.php';?>