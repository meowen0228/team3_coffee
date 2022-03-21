<?php
  $title = '後台首頁';
  $pagename = 'home';
?>
<style>
        .title {
            position: absolute;
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 22px;
            line-height: 130%;
        }

        .card {
            position: absolute;
            background: #FFFFFF;
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 130%;
        }

        .commodityImg {
            max-width: 60px;
        }

        /* .newBotton,
        .deleteBotton {
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
        } */
    </style>
</style>
<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>
<?php
require __DIR__ . '/layout/connect_db.php';
$title = 'drink_oder';
$pageName = 'drink_oder';
$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // 用戶要看的頁碼
if ($page < 1) {
    header('Location: drink_oder_body.php?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM drink_order";
// 取得總筆數
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$rows = []; // 預設沒有資料
$totalPages = 0;
if ($totalRows) {
    // 總頁數
    $totalPages = ceil($totalRows / $perPage);
    if ($page > $totalPages) {
        header("Location: drink_oder_body.php?page=$totalPages");
        exit;
    }
$sql = sprintf("SELECT users.id AS u_id,
                drink_order.id AS do_id, 
                pay,
                store_name, 
                drink_order.`status`,
                drink_order.CREATEd_at,     -- 訂單管理資料
                total.fk_drink_order_id AS total_do_id,
                total.fk_drink_menu_id AS drink_menu_id,
                group_concat( total.fk_drink_order_id) AS `doId`,
                group_concat( total.qty) AS ` total_qty`,
                group_concat( total.price) AS `total_price`,
                group_concat( total.drink_name) AS `drink_name`,
                group_concat( total.fk_drink_menu_id) AS `total_fk_drink_menu_id` 
                from drink_order
                left join  users
                on users.id = drink_order.fk_user_id
                left join store
                on store.id = drink_order.fk_store_id
                left join
                (SELECT
                drink_order_detail.fk_drink_order_id as dod_id,
                drink_name,
                price,
                `status`,
                fk_drink_order_id,
                fk_drink_menu_id,
                qty
                from drink_menu
                join drink_order_detail
                on drink_order_detail.fk_drink_menu_id = drink_menu.id) as total
                on total.dod_id = drink_order.id group by do_id
                ORDER BY  drink_order.id  LIMIT %s, %s", ($page - 1) * $perPage, $perPage); //抓SQL資料



    $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
    
}
?>



<main class="admin-main px-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row py-1">

                    <div class="col-3">
                        <h4>訂單管理</h4>
                    </div>
                    <div class="col-5"></div>

                    <div class="col-4">
                        <div class="input-group form-outline ">
                            <input type="search" class="form-control search" />
                            <button type="button" class="btn btn-light icon search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                </div>
                <?php $num=0; ?>
                <?php foreach ($rows as $r) : ?> 
                    <?php $num +=1?>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item nonship">
                        <h2 class="accordion-header" id="flush-heading<?= $num ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $num ?>" aria-expanded="false" aria-controls="flush-collapse<?= $num ?>">
                                <table class="table  table-responsive table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">會員編號</th>
                                            <th scope="col">訂單編號</th>
                                            <th scope="col">付款方式</th>
                                            <th scope="col">用餐地點</th>
                                            <th scope="col">餐點狀態</th>
                                            <th scope="col">建立時間</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th><?= $r['u_id'] ?></th>
                                            <td><?= $r['do_id'] ?></td>
                                            <td><?= $r['pay'] ?></td>
                                            <td><?= $r['store_name'] ?></td>
                                            <?php if ($r['status']){?>
                                            <td  style="color:blue">準備中</td>
                                            <?php }else{?>
                                            <td style="color:red">可取餐</td>
                                            <?php } ?>
                                            <td><?= $r['CREATEd_at'] ?></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </button>
                        </h2>
                        <div id="flush-collapse<?= $num ?>" class=" collapse" aria-labelledby="flush-heading<?= $num ?>" data-bs-parent="#accordionFlushExample">
                            <table class="table table-sm table-responsive ">
                                <thead>
                                    <tr>
                                        <th>項次</th>
                                        <th>商品編號</th>
                                        <th>商品名稱</th>
                                        <th>數量</th>
                                        <th>金額</th>
                                        <th>小計</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $a = 1  ?>
                                    <?php $menuId = explode (',',$r['drink_name']) ?>
                                    <?php $total_fk_drink_menu_id = explode (',',$r['total_fk_drink_menu_id']) ?>
                                    <?php $total_qty = explode (',',$r['total_qty']) ?>
                                    <?php $total_price = explode (',',$r['total_price']) ?>
                                    <?php $sum=0;
                                    for ($i=0; $i<count($menuId); $i++) { 
                                        $sum=$sum+($total_qty[$i] * $total_price[$i])?>
                                        
                                        <tr>
                                        <td><?= $a+$i ?></td>
                                        <td><?= $total_fk_drink_menu_id[$i] ?></td>
                                        <td><?= $menuId[$i] ?></td>
                                        <td><?= $total_qty[$i] ?></td>
                                        <td><?= $total_price[$i] ?></td>
                                        <td><?= $total_qty[$i] * $total_price[$i]?>
                                        </tr>
                                        <?php  } ?>
                                        
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>總計</td>
                                        <td><?= $sum ?></td>
                                </tbody>   
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
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
            <div class="col-1"></div>
        </div>
    </div>


</main>

</main>

    <?php include __DIR__. './layout/scripts.php';?>
    <?php include __DIR__. './layout//html-foot.php';?>