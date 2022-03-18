<?php
require __DIR__ . '/connect_db.php';
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
        header("Location: drink_menu_body.php?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM drink_menu ORDER BY id DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}

?>
<body>
    <main class="admin-main px-5 py-5">
        <div class="row">
        <div class="col-1"></div>
            <div class="col-10">
                <div class="row py-1">

                    <div class="col-3">
                        <h4>訂單列表</h4>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2">
                        <button class="rounded-pill text-nowrap">+新增訂單</button>


                    </div>

                    <div class="col-4">
                        <div class="input-group form-outline ">
                            <input type="search" class="form-control search" />
                            <button type="button" class="btn btn-light icon search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
        </div>
        <br>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-1">

                    <button class="rounded-pill   text-nowrap px-3">刪除</button>

            </div>
            <!-- <div class="col-1"></div> -->
        </div>
        <br>
        <div class="row">
            <div class="card">
                <table class="table table-hover ">
                    <thead>
                        <tr class="oderTitle text-nowrap">
                            <th scope="col"><input type="checkbox" name="" id="">全選</th>
                            <th scope="col">編號</th>
                            <th scope="col">品名</th>
                            <th scope="col">圖片</th>
                            <th scope="col">價格</th>
                            <th scope="col">介紹</th>
                            <!-- <th scope="col">選擇</th> -->
                            <th scope="col">上架狀態</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rows as $r) : ?>  
                        <tr>
                            <td><input type="checkbox" name="" id=""></td>
                            <th scope="row"><?= $r['id'] ?></th>
                            <td><?= $r['drink_name'] ?></td>
                            <td><img style="width:100px;" src=".<?= $r['url'] ?>" alt=""></td>
                            <td><?= $r['price'] ?></td>
                            <td><?= $r['content'] ?></td>
                            <!-- <td><?= $r[''] ?></td> -->
                            <?php if ($r['status']){?>
                            <td>已上架</td>
                            <?php }else{?>
                            <td>已下架</td>
                            <?php } ?>
                            <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
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

    </script>
</body>
