<?php
$title = '後台首頁';
$pagename = 'home';
?>

<head>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<style>
    .card_number {
            width: 300PX;
            text-align:center;
        }
    .card_name {
        width: 150PX;
        word-wrap:break-word;
    }
    .card_photo {
        width: 300px;
        text-align:center;
    }
    .card_price {
        width: 150px;
        text-align:center;

    }
    .card_content {
        width: 300px;
    }
    .card_condition {
        width: 300px;
        text-align:center;
    }
    .card_revise {
        width: 150px;
    }
    .solid {
        size: 30px;
    }


    a {
        text-decoration: none;
        color: inherit;
}

.cta {
        position: relative;
        margin: auto;
        padding: 19px 22px;
        transition: all .2s ease;
        }

.cta:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        border-radius: 28px;
        background: rgba(255, 171, 157, 0.5);
        width: 56px;
        height: 56px;
        transition: all .3s ease;
}

.cta span {
        position: relative;
        font-size: 16px;
        line-height: 18px;
        font-weight: 900;
        letter-spacing: .25em;
        text-transform: uppercase;
        vertical-align: middle;
}

.cta svg {
        position: relative;
        top: 0;
        margin-left: 10px;
        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke: black;
        stroke-width: 2;
        transform: translateX(-5px);
        transition: all .3s ease;
}

.cta:hover:before {
        width: 100%;
        background: rgba(255, 171, 157, 0.5);
}

.cta:hover svg {
        transform: translateX(0);
}

.cta:active {
        transform: scale(0.96);
}



.wrapper {
  height: 50px;
  /*This part is important for centering*/
  display: flex;
  align-items: center;
  justify-content: center;
}

.typing-demo {
  width: 22ch;
  animation: typing 2s steps(22), blink .5s step-end infinite alternate;
  white-space: nowrap;
  overflow: hidden;
  border-right: 3px solid;
  font-family: monospace;
  font-size: 2em;
}

@keyframes typing {
  from {
    width: 0
  }
}
    
@keyframes blink {
  50% {
    border-color: transparent
  }
}
</style>
</head>

<body>
<?php include __DIR__ . '/layout/aside.php'; ?>
<?php require __DIR__ . '/layout/connect_db.php';
$title = 'drink_menu';
$pageName = 'drink_menu';
$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼

if ($page < 1) {
    header('Location: drink_menu?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM drink_menu";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
    // 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: drink_menu.php?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM drink_menu ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}

?>

    <main class="admin-main px-5 py-5">
        
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row py-1">
                    <div class="col-3">
                    <div class="wrapper">
                        <div class="typing-demo">
                            菜單管理系統
                        </div>
            </div>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2">
                    <a href="drink_menu_add.php" class="cta">
  <span>新增菜單</span>
  <svg width="20px" height="20px" viewBox="0 0 13 10">
    <path d="M1,5 L11,5"></path>
    <polyline points="8 1 12 5 8 9"></polyline>
  </svg>
</a>
                        
                    </div>
                    <div class="col-4">
                        <div class="input-group form-outline ">
                            <input type="search" class="form-control search" />
                            <button type="button" class="btn btn-light icon search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>  <!-- 搜尋功能 -->
                        </div>
                    </div>
        </div>
        <br>

        <div class="row">
            <div class="col-10"></div>
            <div class="col-1"></div>
            <!-- <div class="col-1"></div> -->
        </div>
        <br>
        <div class="row">
            <div class="card">
                <table class="table table-hover ">

                    <thead>  
                        <tr class="oderTitle text-nowrap">
                            <!-- <th scope="col"><input type="checkbox" name="" id="">全選</th> -->
                            <th class="card_number">編號</th>
                            <th class="card_name">品名</th>
                            <th class="card_photo">圖片</th>
                            <th class="card_price">價格</th>
                            <th class="card_content">介紹</th>
                            <th class="card_condition">上架狀態</th>
                            
                        </tr>
                    </thead>    <!-- 菜單標題 -->

                    <tbody>     
                    <?php foreach ($rows as $r) : ?>  
                        <tr>
                            <!-- <td>
                                <input type="checkbox" name="" id="">
                            </td> -->  
                            <th class="card_number"><?= $r['id'] ?></th>  <!--編號-->
                            <td class="card_name"><?= $r['drink_name'] ?></td>      <!--飲料名稱-->
                            <td class="card_photo">
                                <img style="width:100px;" src="<?= $r['url'] ?>" alt="00">
                            </td>   
                            <td class="card_price"><?= $r['price'] ?></td> <!--價格-->
                            <td class="card_content"><?= $r['content'] ?></td>  <!--介紹-->
                            <!--上架狀態-->
                            <?php if ($r['status']){?>
                            <td class="card_condition" style="color:blue"><h5>上架中</h5></td>

                            <?php }else{?>
                            <td class="card_condition" style="color:red"><h5>已下架</h5></td>
                            <?php } ?>

                            <td class="card_revise" style="center "><a href="drink_menu_revise.php?id= <?= $r['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td> <!--修改-->
                        </tr>
                    <?php endforeach ?>
                </tbody>  <!--菜單內容 -->

                </table>

                <div class="d-flex justify-content-center mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                </li>
                <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                    if ($i >= 1 and $i <= $totalPages) :
                ?>
                        <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                <?php endif;
                endfor; ?>
                <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                </li>
            </ul>
        </nav>  <!-- 頁碼  -->
    </div>
            </div>
</div>

</main> 
</body>
    <!-- Bootstrap JavaScript Libraries -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

    </script>
</body>
<?php include __DIR__ . '/layout/scripts.php'; ?>
</body>

<footer>
<?php include __DIR__ . '/layout//html-foot.php'; ?>
</footer>