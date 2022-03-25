<?php
$title = '菜單管理系統';
$pagename = 'home';
?>

<head>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<style>

.card{
    padding: 50px;
}
.card_content {
    width: 15vw;
    height: 100px;
    overflow:hidden;
    display: -webkit-box;
    -webkit-line-clamp: 5; 
    -webkit-box-orient: vertical;
    white-space: normal;
    text-overflow: ellipsis;
}
.card_id {
    width: 3vw;
    text-align: center;
}
.card_name {
    width: 10vw;
    text-align: center;
}
.card_status {
    width: 1.5vw;
    text-align: center;
}

.card_img {
    width: 7vw;
    text-align: center;
}
.card_price {
    /* width: 5vw; */
    text-align: center;
}

    /* 新增按鈕*/
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

/* 分頁pagination */

.pagination-outer{ text-align: center; }
.pagination{
    font-family: 'Work Sans', sans-serif;
    display: inline-flex;
}
.pagination li a.page-link{
    color: #555;
    background-color: #e7e7e7;
    font-size: 24px;
    font-weight: 600;
    padding: 6px 15px;
    margin: 0 7px;
    border: none;
    overflow: hidden;
    position: relative;
    z-index: 1;
}
.pagination li.active a.page-link,
.pagination li a.page-link:hover,
.pagination li.active a.page-link:hover{
    color: #fff;
    background-color: transparent;
    text-shadow: 0 0 2px #000;
}
.pagination li a.page-link:before,
.pagination li a.page-link:after{
    content: '';
    background-color: rgba(255, 171, 157, 0.5);
    height: 75%;
    width: 75%;
    opacity: 0;
    transform: translateX(-50%) translateY(-50%);
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: -1;
    transition: all 0.3s ease 0s;
}
.pagination li.active a.page-link:before,
.pagination li a.page-link:hover:before{
    opacity: 1;
    left: 43%;
    top: 43%;
}
.pagination li.active a.page-link:after,
.pagination li a.page-link:hover:after{
    opacity: 1;
    left: 57%;
    top: 57%;
}
@media only screen and (max-width: 480px){
    .pagination{ display: block; }
    .pagination li{
        display: inline-block;
        margin: 0 0 5px;
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
                    <h2 style="white-space:nowrap">菜單管理系統</h2>
                </div>
                <div class="col-3"></div>
                <div class="col-2">
                    <a href="drink_menu_add.php" class="cta">
                        <span>新增菜單</span>
                        <svg width="20px" height="20px" viewBox="0 0 13 10">
                            <path d="M1,5 L11,5"></path>
                            <polyline points="6 0 6 10"></polyline> 
                        </svg>
                    </a>
                </div>
                <div class="col-4">
                    <div class="input-group form-outline ">
                        <input type="search" class="form-control search" />
                        <button type="button" class="btn btn-light icon search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>  <!-- TODO: 搜尋功能 -->
                    </div>
                </div>
            </div>
        <br>
        <div class="row">
            <div class="card">
                <table class="table table-hover ">
                    <thead>  <!-- 菜單標題 -->
                        <tr class="oderTitle text-nowrap">
                            <!-- <th scope="col"><input type="checkbox" name="" id="">全選</th> -->
                            <th style="text-align: center">編號</th>
                            <th style="text-align: center">品名</th>
                            <th style="text-align: center">圖片</th>
                            <th style="text-align: center">價格</th>
                            <th style="text-align: center">介紹</th>
                            <th style="text-align: center">上架狀態</th>
                            <th style="text-align: center">修改 </th>
                        </tr>
                    </thead>    
                    <tbody>   <!--菜單內容 -->  
                    <?php foreach ($rows as $r) : ?>  
                        <tr> 
                            <!-- <td>
                                <input type="checkbox" name="" id="">
                            </td> -->
                            <th class="card_id"> <!--編號--> 
                                <div class="card_id">
                                    <?= $r['id'] ?>
                                </div>
                            </th> 
                            
                            <td class="card_name"> <!--飲料名稱-->
                                <div class="card_name">
                                    <?= $r['drink_name'] ?>
                                </div>
                            </td>      

                            <td class="card_img"> <!--商品圖片-->
                                <div class="card_img">
                                    <img style="width:100px;" src="<?= $r['url'] ?>" alt="">
                                </div>
                            </td>   

                            <td>  <!--價格-->
                                <div class="card_price">
                                    <?= $r['price'] ?></div>
                                </td> 

                            <td style="width: 300px">  <!--介紹-->
                                <div class="card_content">
                                    <?= $r['content'] ?>
                                </div>
                            </td>
                            
                            <?php if ($r['status']){?>   <!--上架狀態-->
                            <td class="card_status" style="color:blue">上架中</td>
                            <?php }else{?>
                            <td class="card_status" style="color:red">已下架</td>
                            <?php } ?>

                            <td style="text-align: center"><a href="drink_menu_revise.php?id= <?= $r['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td> <!--修改-->
                        </tr>
                    <?php endforeach ?>
                    </tbody>  
                </table>
            </div>
                                    <!-- 頁碼  -->
            <div class="d-flex justify-content-center mt-3">
                <nav class="pagination-outer" aria-label="Page navigation">
                    <ul class="pagination">
                        
                        <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>"><span aria-hidden="true">«</span></a>
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
                            <a class="page-link" href="?page=<?= $page + 1 ?>"><span aria-hidden="true">»</span></a>
                        </li>
                    </ul>
                </nav>  
            </div>
        </div>
    </div>
</main> 
</body>

    <!-- Bootstrap JavaScript Libraries -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<footer>
<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?>
</footer>