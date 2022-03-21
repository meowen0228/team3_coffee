<?php
$title = '後台首頁';
$pagename = 'home';
?>

<head>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<style>
    /* .card_number{
        width: 3rem;
    }
    .card_name{
        width: 11rem;
    }
    .card_photo{
        width: 5rem;
    }
    .card_price{
        width: 2rem;
    }
    .card_content{
        width: 15rem;
        word-wrap
        :break-word;
    }
    .card_condition{
        width: 5rem;
    }
     */
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
                        <h4>菜單管理</h4>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2">
                        
                            <a href="drink_menu_add.php" class="btn btn-light rounded-pill"> 新增菜單</a>
                        
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
                            <th><?= $r['id'] ?></th>  <!--編號-->
                            <td><?= $r['drink_name'] ?></td>      <!--飲料名稱-->
                            <td>
                                <img style="width:100px;" src="<?= $r['url'] ?>" alt="">
                            </td>   
                            <td><?= $r['price'] ?></td> <!--價格-->
                            <td><?= $r['content'] ?></td>  <!--介紹-->
                            <!--上架狀態-->
                            <?php if ($r['status']){?>
                            <td style="color:blue"><h5>上架中</h5></td>

                            <?php }else{?>
                            <td style="color:red"><h5>已下架</h5></td>
                            <?php } ?>

                            <td style="center "><a href="drink_menu_revise.php?id= <?= $r['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td> <!--修改-->
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