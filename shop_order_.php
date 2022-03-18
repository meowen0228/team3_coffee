<?php
$title = '後台首頁';
$pagename = 'home';
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

    .active {
        display: none;
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
                        <select name="ship" id="ship">
                            <option selected>出貨狀態</option>
                            <option value="ship1">全選</option>
                            <option value="ship2">已出貨</option>
                            <option value="ship3">未出貨</option>
                            <option value="ship4">完成訂單</option>
                            <option value="ship5">取消訂單</option>
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


                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item nonship">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <table class="table  table-responsive table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">會員編號</th>
                                            <th scope="col">訂單編號</th>
                                            <th scope="col">付款方式</th>
                                            <th scope="col">運送方式</th>
                                            <th scope="col">訂單狀態</th>
                                            <th scope="col">建立時間</th>
                                            <th scope="col"><a href=""><i class="fa-solid fa-pen-to-square"></i></a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>000001</th>
                                            <td>000001</td>
                                            <td>信用卡</td>
                                            <td>宅配</td>
                                            <td>未出貨</td>
                                            <td>2022/01/31 15:20</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </button>
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
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <td>01</td>
                                        <td>00000000</td>
                                        <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                        <td>1</td>
                                        <td>999</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>01</td>
                                        <td>00000000</td>
                                        <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                        <td>1</td>
                                        <td>999</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>01</td>
                                        <td>00000000</td>
                                        <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                        <td>1</td>
                                        <td>999</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>總計</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                    <div class="accordion-item onship">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <table class="table  table-responsive table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">會員編號</th>
                                            <th scope="col">訂單編號</th>
                                            <th scope="col">付款方式</th>
                                            <th scope="col">運送方式</th>
                                            <th scope="col">訂單狀態</th>
                                            <th scope="col">建立時間</th>
                                            <th scope="col"><a href=""><i class="fa-solid fa-pen-to-square"></i></a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>000001</th>
                                            <td>000001</td>
                                            <td>信用卡</td>
                                            <td>宅配</td>
                                            <td>已出貨</td>
                                            <td>2022/01/31 15:20</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
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
                                    <tr>
                                        <th></th>
                                        <td>01</td>
                                        <td>00000000</td>
                                        <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                        <td>1</td>
                                        <td>999</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>01</td>
                                        <td>00000000</td>
                                        <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                        <td>1</td>
                                        <td>999</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>01</td>
                                        <td>00000000</td>
                                        <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                        <td>1</td>
                                        <td>999</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>總計</td>
                                        <td>999</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <div class="accordion-item complete">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <table class="table  table-responsive table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">會員編號</th>
                                                <th scope="col">訂單編號</th>
                                                <th scope="col">付款方式</th>
                                                <th scope="col">運送方式</th>
                                                <th scope="col">訂單狀態</th>
                                                <th scope="col">建立時間</th>
                                                <th scope="col"><a href=""><i class="fa-solid fa-pen-to-square"></i></a> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>000001</th>
                                                <td>000001</td>
                                                <td>信用卡</td>
                                                <td>宅配</td>
                                                <td>完成訂單</td>
                                                <td>2022/01/31 15:20</td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
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
                                        <tr>
                                            <th></th>
                                            <td>01</td>
                                            <td>00000000</td>
                                            <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                            <td>1</td>
                                            <td>999</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>01</td>
                                            <td>00000000</td>
                                            <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                            <td>1</td>
                                            <td>999</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>01</td>
                                            <td>00000000</td>
                                            <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                            <td>1</td>
                                            <td>999</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>總計</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        <div class="accordion-item canceled">
                            <h2 class="accordion-header" id="flush-headingfour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
                                    <table class="table  table-responsive table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">會員編號</th>
                                                <th scope="col">訂單編號</th>
                                                <th scope="col">付款方式</th>
                                                <th scope="col">運送方式</th>
                                                <th scope="col">訂單狀態</th>
                                                <th scope="col">建立時間</th>
                                                <th scope="col"><a href=""><i class="fa-solid fa-pen-to-square"></i></a> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>000001</th>
                                                <td>000001</td>
                                                <td>信用卡</td>
                                                <td>宅配</td>
                                                <td>取消訂單</td>
                                                <td>2022/01/31 15:20</td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </button>
                            </h2>
                            <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
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
                                        <tr>
                                            <th></th>
                                            <td>01</td>
                                            <td>00000000</td>
                                            <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                            <td>1</td>
                                            <td>999</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>01</td>
                                            <td>00000000</td>
                                            <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                            <td>1</td>
                                            <td>999</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td>01</td>
                                            <td>00000000</td>
                                            <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                            <td>1</td>
                                            <td>999</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>總計</td>
                                            <td>999</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>





                    <div class="d-flex justify-content-center py-2">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination gap-2 pagetext">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>


</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    //給collapse
</script>
<script>
    $(function() {
        $(ship).change(function() {
            switch (
                $(this).val()
            ) {
                case "ship1": //全選
                    $(".nonship").removeClass("active");
                    $(".onship").removeClass("active");
                    $(".complete").removeClass("active");
                    $(".canceled").removeClass("active");
                    break;
                case "ship2": //未出貨
                    $(".nonship").addClass("active");
                    $(".onship").removeClass("active");
                    $(".complete").addClass("active");
                    $(".canceled").addClass("active");
                    break;
                case "ship3": //已出貨
                    $(".nonship").removeClass("active");
                    $(".onship").addClass("active");
                    $(".complete").addClass("active");
                    $(".canceled").addClass("active");
                    break;
                case "ship4": //完成訂單
                    $(".nonship").addClass("active");
                    $(".onship").addClass("active");
                    $(".complete").removeClass("active");
                    $(".canceled").addClass("active");
                    break;
                case "ship5": //取消
                    $(".nonship").addClass("active");
                    $(".onship").addClass("active");
                    $(".complete").addClass("active");
                    $(".canceled").removeClass("active");
                    break;
            }

        });
    });
    $(function() {
        $("#ship").change(function() {
                switch (
                    $(this).val() //指到 select 自己的選項。
                ) {
                    case "ship1": //全選
                        $(".nonship").removeClass("active");
                        $(".onship").removeClass("active");
                        $(".complete").removeClass("active");
                        $(".canceled").removeClass("active");
                        break;
                    case "ship2": //未出貨
                        $(".nonship").addClass("active");
                        $(".onship").removeClass("active");
                        $(".complete").addClass("active");
                        $(".canceled").addClass("active");
                        break;
                    case "ship3": //已出貨
                        $(".nonship").removeClass("active");
                        $(".onship").addClass("active");
                        $(".complete").addClass("active");
                        $(".canceled").addClass("active");
                        break;
                    case "ship4": //完成訂單
                        $(".nonship").addClass("active");
                        $(".onship").addClass("active");
                        $(".complete").removeClass("active");
                        $(".canceled").addClass("active");
                        break;
                    case "ship5": //取消
                        $(".nonship").addClass("active");
                        $(".onship").addClass("active");
                        $(".complete").addClass("active");
                        $(".canceled").removeClass("active");
                        break;
                    default:
                        return;
                }
            }
        });
    });
</script>

<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?>