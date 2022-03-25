<?php
  require  '../layout/connect_db.php';
  $title = '會員列表';
  $pagename = 'userList';
  $perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
    header('Location: user_list-bd.php?page=1');
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
        header("Location: user_list-bd.php?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM users ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
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
                              <input type="text" size="6" class="userSearch"  name="search-for" placeholder="搜尋會員姓名或編號">
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
<?php include   '../layout//html-foot.php'; ?>