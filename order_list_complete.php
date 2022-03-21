<?php
// 連接資料庫
require __DIR__ . '/layout/connect_db.php';

// 頁面資訊
$title = '訂單列表';
$pagename = 'order_list';

// 每一頁有幾筆
$perPage = 4;

// 用戶要看的頁碼
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: order_list.php?page=1');
    
}

// 取得總筆數
$t_sql = "SELECT COUNT(1) FROM orders where `fk_condition_id` IN (3)";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

// 預設沒有資料
$rows = [];
$totalPages = 0;

// if ($page > $totalPages) {
//     header("Location: order_list.php?page=$totalPages");
//     exit;
// }
if ($totalRows) {
    $totalPages = ceil($totalRows / $perPage);

    $sql = sprintf(
        "SELECT
        users.id AS u_id,
        user_name,
        orders.id AS o_id,
        pay,
        shipment,
        order_condition.id AS oc_id,
        orders.CREATEd_at AS otime,
        group_concat( DISTINCT detail.od_id ) AS `od_id`,
        group_concat( DISTINCT detail.p_id ) AS `p_id`,
        group_concat( p_name ) AS p_name,
        group_concat( qty) AS qty,
        group_concat( price) AS price
        from orders
        left join users on orders.id = users.id
        left join order_condition on order_condition.id = orders.fk_condition_id
        left join
        (SELECT
        order_detail.fk_order_id AS od_fkid,
        order_detail.id AS od_id,
        products.id AS p_id,
        p_name,
        qty,
        price
        FROM order_detail
        left join products on products.id = order_detail.fk_product_id) AS detail on detail.od_fkid = orders.id
        where `fk_condition_id` IN (3)
        GROUP BY orders.id 
       
        ORDER BY o_id LIMIT %s, %s ;",
        ($page - 1) * $perPage,
        $perPage
    );
    $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
}

?>

<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>
<style>
    .icon {
        background: #FFFFFF;
        /* border: #FFFFFF solid 1px; */
        border-radius: 5px;
        border-left: none;
    }

    .search {
        border: none;
        border-radius: 20px;
    }

    .pagetext a {
        color: black;
    }

    .addProduct {
        border-radius: 20px;
    }

    .act {
        display: none;
    }
    .select{
        width: 100px;
        border-radius: 10px;
        padding: 5px;
    }
</style>



<main class="admin-main px-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row py-1">

                    <div class="col-3">
                        <h4>訂單列表</h4>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2">
                        <select onChange="location = this.options[this.selectedIndex].value;" name="ship" id="ship" class="select">
                            <!-- <option >出貨狀態</option> -->
                            <option   value="order_list.php">全選</option>
                            <option  value="order_list_onship.php">已出貨</option>
                            <option  value="order_list_nonship.php">未出貨</option>
                            <option selected value="order_list_complete.php">完成訂單</option>
                            <option value="order_list_cancel.php">取消訂單</option>
                        </select>

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



                <!-- 假資料 -->
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item nonship">
                        <h2 class="accordion-header" id="flush-headingOne">
                
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <table class="table table-sm table-responsive ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>項次</th>
                                        <th>商品編號</th>
                                        <th>商品名稱</th>
                                        <th>數量</th>
                                        <th>金額</th>
                                        <th>小計</th>
                                        <th></th>
                                    </tr>
                                </thead>
                               
                            </table>
                        </div>
                    </div>
                    <?php $num=0; ?>
                    <?php foreach ($rows as $r) : ?>
                        <?php $num+=1?>
                        <?php $n=$num?>
                        <!-- 連接資料庫 -->
                        
                                      
                        <div class="accordion-item onship">
                            <h2 class="accordion-header" id="flush-heading<?= $n ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $n ?>" aria-expanded="false" aria-controls="flush-collapse<?= $n ?>">
                                    <table class="table  table-responsive table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">會員編號</th>
                                                <th scope="col">訂單編號</th>
                                                <th scope="col">付款方式</th>
                                                <th scope="col">運送方式</th>
                                                <th scope="col">訂單狀態</th>
                                                <th scope="col">建立時間</th>
                                                <th scope="col"><a href="order_detail_edit.php?id=<?= $r['o_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a> </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td><?= $r['u_id'] ?></td>
                                                <td><?= $r['o_id'] ?></td>
                                                <?php if ($r['pay'] == 1) { ?>
                                                    <td>信用卡</td>
                                                <?php } else { ?>
                                                    <td>匯款</td>
                                                <?php } ?>

                                                <?php if ($r['shipment'] == 1) { ?>
                                                    <td>宅配</td>
                                                <?php } else { ?>
                                                    <td>自取</td>
                                                <?php } ?>

                                                <?php if ($r['oc_id'] == 1) { ?>
                                                    <td>未出貨</td>
                                                <?php }   ?>
                                                    <?php if ($r['oc_id'] == 2) { ?>
                                                        <td>已出貨</td>
                                                    <?php }  ?>
                                                        <?php if ($r['oc_id'] == 3) { ?>
                                                            <td>完成訂單</td>
                                                        <?php }  ?>
                                                        <?php if ($r['oc_id'] == 4) { ?>
                                                            <td>取消訂單</td>
                                                        <?php } ?>
                                                    

                                                <td><?= $r['otime'] ?></td>
                                                <td></td>
                                            </tr>


                                        </tbody>

                                    </table>
                                </button>
                            </h2>
                            <div id="flush-collapse<?= $n ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $n ?>">
                                <table class="table table-sm table-responsive ">
                                  
                                    <thead>
                                        <tr>
                                            <th></th>
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
                                        <?php 
                                        $productid = explode(',', $r['p_id']) ?>
                                         <?php 
                                        $productname = explode(',', $r['p_name']) ?>
                                         <?php 
                                        $qty = explode(',', $r['qty']) ?>
                                        <?php 
                                        $price = explode(',', $r['price']) ?>
                                        <?php 
                                        $sum = 0 ?>
                                        <?php 
                                        for ($i=0; $i<count($productid); $i++) {
                                            $sum=$sum+($qty[$i]*$price[$i]);?>
                                        <tr>
                                            <th></th>
                                            <td><?= $i+1 ?></td>
                                            <td><?= $productid[$i] ?></td>
                                            <td><?= $productname[$i] ?></td>
                                            <td><?= $qty[$i] ?></td>
                                            <td><?= $price[$i] ?></td>
                                            <td><?= $qty[$i]*$price[$i] ?></td>
                                            <td></td>
                                            </tr>
                                            <?php  }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>總計</td>
                                            <td><?= $sum ?></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
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
            <div class="col-1"></div>
        </div>


</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    //給collapse
</script>
<script>
    
    
    // $(function() {
    //     $("#ship").change(function() {
    //         switch (
    //             $(this).val()
    //         ) {
    //             case "1": //全選
    //                 $(".nonship").removeClass("act");
    //                 $(".onship").removeClass("act");
    //                 $(".complete").removeClass("act");
    //                 $(".canceled").removeClass("act");
    //                 break;
    //             case "2": //未出貨
    //                 $(".nonship").addClass("act");
    //                 $(".onship").removeClass("act");
    //                 $(".complete").addClass("act");
    //                 $(".canceled").addClass("act");
    //                 break;
    //             case "3": //已出貨
    //                 $(".nonship").removeClass("act");
    //                 $(".onship").addClass("act");
    //                 $(".complete").addClass("act");
    //                 $(".canceled").addClass("act");
    //                 break;
    //             case "4": //完成訂單
    //                 $(".nonship").addClass("act");
    //                 $(".onship").addClass("act");
    //                 $(".complete").removeClass("act");
    //                 $(".canceled").addClass("act");
    //                 break;
    //             case "5": //取消
    //                 $(".nonship").addClass("active");
    //                 $(".onship").addClass("active");
    //                 $(".complete").addClass("active");
    //                 $(".canceled").removeClass("active");
    //                 break;
    //         }
    //     });
    // });
</script>

<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?>