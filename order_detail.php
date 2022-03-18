<?php
$title = '後台首頁';
$pagename = 'home';
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
                                <input type="text"  class="form-control" placeholder="000001" readonly="readyonly">
                            </div>
                    </div>
                    <div class="row mb-4 align-items-end">
                        <div class="col-2">訂單編號:
                        </div>
                            <div class="col-5">
                                <input type="text"  class="form-control" placeholder="000001" readonly="readyonly">
                            </div>
                    </div>
                    <div class="row mb-4 align-items-end">
                        <div class="col-2">建立時間:
                        </div>
                            <div class="col-5">
                                <input type="text"  class="form-control" placeholder="2022/03/01 13:20" readonly="readyonly">
                            </div>
                    </div>

                    <div class=" row mb-4 align-items-center">
                        <div class="col-2">付款方式：</div>
                        <div class="col-2">
                           
                                <input class="form-check-input" type="radio" name="pay" id="pay1" value="option1" disabled checked>
                                <label class="form-check-label" for="pay1">信用卡</label>
                          
                        </div>
                        <div class="col-2">
                       
                            <input class="form-check-input" type="radio" name="pay" id="pay2" value="option2" disabled>
                            <label class="form-check-label" for="pay2">匯款</label>
                      
                        </div>
                    </div>


                    <div class=" row mb-4 align-items-center">
                        <div class="col-2">運送方式：</div>
                        <div class="col-2">                           
                                <input class="form-check-input" type="radio" name="ship" id="ship1" value="option1" disabled checked>
                                <label class="form-check-label" for="ship1">自取</label>
                           
                        </div>
                        <div class="col-2">
                                <input class="form-check-input" type="radio" name="ship" id="ship2" value="option2" disabled>
                                <label class="form-check-label" for="ship2">宅配</label>
                           
                        </div>
                    </div>

                    <div class=" row mb-4 align-items-center">
                        <div class="col-2">訂單狀態：</div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status1" value="option1">
                                <label class="form-check-label" for="status1">未出貨</label>
                         
                        </div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status2" value="option2">
                                <label class="form-check-label" for="status2">已出貨</label>
                            
                        </div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status2" value="option2">
                                <label class="form-check-label" for="status2">訂單完成</label>
                            
                        </div>
                        <div class="col-2">                            
                                <input class="form-check-input" type="radio" name="status" id="status2" value="option2">
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
                            <tr>
                                <th>01</th>
                                <td>00000000</td>
                                <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                <td>1</td>
                                <td>999</td>
                                <td>999</td>

                            </tr>
                            <tr>
                                <th>02</th>
                                <td>00000000</td>
                                <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                <td>1</td>
                                <td>999</td>
                                <td>999</td>
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
                        <button type="button" class="btn btn-secondary addProduct">更新訂單</button>

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