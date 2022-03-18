<?php
require __DIR__ . '/php_part/connect_db.php';

$title = '訂單細項管理';
$pageName = 'orderdetail1_';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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
    WHERE orders.id = $id
    GROUP BY orders.id ORDER BY od_id;"
);

$row = $pdo->query($sql)->fetch();


?>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>

<style>
    .admin-main {
        background: #F2F2F2;
        /* padding: 10px; */
    }

    .form {

        background: #FFFFFF;
        padding: 20px;
    }

    .box {
        border: 1px solid black;
        width: 200px;
        height: 200px;
        background: #F2F2F2;
    }

    .addProduct {
        border-radius: 20px;
    }

    .typing {
        background: #F2F2F2;
    }

    .addProduct {
        border-radius: 20px;
    }
</style>

<main class="admin-main px-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

                <h4>訂單管理</h4>
                <form class="form pt-1">
                    <div class="row mt-2 mb-4 align-items-end">
                        <div class="col-2">會員編號:
                        </div>
                            <div class="col-5">
                                <input type="text"  class="form-control" placeholder="<?= $row['u_id']?>" readonly="readyonly">
                            </div>
                    </div>
                    <div class="row mb-4 align-items-end">
                        <div class="col-2">訂單編號:
                        </div>
                            <div class="col-5">
                                <input type="text"  class="form-control" placeholder="<?= $row['o_id']?>" readonly="readyonly">
                            </div>
                    </div>
                    <div class="row mb-4 align-items-end">
                        <div class="col-2">建立時間:
                        </div>
                            <div class="col-5">
                                <input type="text"  class="form-control" placeholder="<?= $row['otime'] ?>" readonly="readyonly">
                            </div>
                    </div>

                    <div class=" row mb-4 align-items-center">
                        <div class="col-2">付款方式：</div>
                        <div class="col-2">
                           
                                <input class="form-check-input" type="radio" name="pay" id="pay1" value="1" <?php if ($row['pay'] == 1) { ?> checked <?php } ?> disabled  >
                                <label class="form-check-label" for="pay1">信用卡</label>
                          
                        </div>
                        <div class="col-2">
                       
                            <input class="form-check-input" type="radio" name="pay" id="pay2" value="2"<?php if ($row['pay'] == 0) { ?> checked <?php } ?> disabled>
                            <label class="form-check-label" for="pay2">匯款</label>
                      
                        </div>
                    </div>


                    <div class=" row mb-4 align-items-center">
                        <div class="col-2">運送方式：</div>
                        <div class="col-2">                           
                                <input class="form-check-input" type="radio" name="ship" id="ship1" value="1" <?php if ($row['shipment'] == 0) { ?> checked <?php } ?> disabled >
                                <label class="form-check-label" for="ship1">自取</label>
                           
                        </div>
                        <div class="col-2">
                                <input class="form-check-input" type="radio" name="ship" id="ship2" value="2" <?php if ($row['shipment'] == 1) { ?> checked <?php } ?> disabled>
                                <label class="form-check-label" for="ship2">宅配</label>
                           
                        </div>
                    </div>

                    <div class=" row mb-4 align-items-center">
                        <div class="col-2">訂單狀態：</div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status1" value="1" <?php if ($row['oc_id'] == 1) { ?> checked <?php } ?> >
                                <label class="form-check-label" for="status1">未出貨</label>
                         
                        </div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status2" value="2" <?php if ($row['oc_id'] == 2) { ?> checked <?php } ?> >
                                <label class="form-check-label" for="status2">已出貨</label>
                            
                        </div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status2" value="3" <?php if ($row['oc_id'] == 3) { ?> checked <?php } ?> >
                                <label class="form-check-label" for="status2">完成訂單</label>
                            
                        </div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status2" value="4" <?php if ($row['oc_id'] == 4) { ?> checked <?php } ?> >
                                <label class="form-check-label" for="status2">訂單取消</label>
                            
                        </div>

                    </div>
                    
                    

                    <div class="mb-4"> 訂購商品:</div>
                    <table class="table table-sm table-responsive align-items-center ">
                        <thead>
                            <tr>
                                <th>項次</th>
                                <th>商品編號</th>
                                <th>商品名稱</th>
                                <th>數量</th>
                                <th>金額</th>
                                <th>小計</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                        $productid = explode(',', $row['p_id']) ?>
                                         <?php 
                                        $productname = explode(',', $row['p_name']) ?>
                                         <?php 
                                        $qty = explode(',', $row['qty']) ?>
                                        <?php 
                                        $price = explode(',', $row['price']) ?>
                                        <?php 
                                        for ($i=0; $i<count($productid); $i++) {?>
                                        <tr>
                                            <td><?= $i+1 ?></td>
                                            <td><?= $productid[$i] ?></td>
                                            <td><?= $productname[$i] ?></td>
                                            <td><?= $qty[$i] ?></td>
                                            <td><?= $price[$i] ?></td>
                                            <td>999</td>
                                            <td></td>
                                            </tr>
                                            <?php  }?>

                            </tr>   
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>總計</td>
                                <td>999</td>

                            </tr>

                        </tfoot>
                    </table>
                    

                    <div class="d-flex justify-content-end ">
                        <button type="submit" class="btn btn-secondary addProduct">更新訂單</button>

                    </div>

                </form>
            </div>
        </div>


        <div class="col-1"></div>
    </div>
    </div>

</main>



<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?>