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

    .list {
        background: #FFFFFF;
        padding: 20px;

    }

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
</style>


<main class="admin-main px-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row py-1">

                    <div class="col-3">
                        <h4>訂單項目管理</h4>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2"><button type="button" class="btn btn-light addProduct">＋新增商品</button></div>
                    <div class="col-4">
                        <div class="input-group form-outline ">
                            <input type="search" class="form-control search" />
                            <button type="button" class="btn btn-light icon search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                </div>


                <div class="list ">

                    <table class="table ">
                        <thead>
                            <div class="row">
                                <tr>
                                    <th class="col-1">商品編號</th>
                                    <th class="col-6">商品名稱</th>
                                    <th class="col-3">
                                        <!-- <select name="status" id="status" onclick="aaa()">
                                        <option selected>商品狀態</option>
                                        <option value="1" onchange ="statusall()">全選</option>
                                        <option value="2" onchange ="statusup()">上架</option>
                                        <option value="3" onchange ="statusdown()">下架</option>
                                    </select> -->
                                        <input type="radio" name="aaaa" onclick="statusall()" value="全選" checked> 全選
                                        <input type="radio" name="aaaa" onclick="statusup()" value="上架"> 上架
                                        <input type="radio" name="aaaa" onclick="statusdown()" value="下架"> 下架
                                    </th>
                                    <th class="col-1">編輯</th>
                                </tr>
                            </div>
                        </thead>
                        <tbody>
                            <tr class="statuss">
                                <th>000001</th>
                                <td>淺中焙｜衣索比亞 耶加雪菲 孔加 日曬處理法 一公斤 咖啡豆</td>
                                <td class="ud">上架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000002</th>
                                <td>中 焙｜蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                <td class="ud">上架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000003</th>
                                <td>淺中焙｜宏都拉斯 聖文森 諾亞小農 厭氧慢乾日曬 咖啡豆</td>
                                <td class="ud">上架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000004</th>
                                <td>中焙｜哥倫比亞 薇拉 雙重發酵水洗 咖啡豆</td>
                                <td class="ud">上架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000005</th>
                                <td>淺中焙｜宏都拉斯 聖文森 諾亞小農 厭氧慢乾日曬 咖啡豆</td>
                                <td class="ud">上架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000006</th>
                                <td>淺中焙｜宏都拉斯 聖文森 諾亞小農 厭氧慢乾日曬 咖啡豆</td>
                                <td class="ud">上架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000007</th>
                                <td>淺中焙｜哥倫比亞 特殊處理法 咖啡豆</td>
                                <td class="ud">下架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000008</th>
                                <td>淺中焙｜宏都拉斯 聖文森 諾亞小農 厭氧慢乾日曬 咖啡豆</td>
                                <td class="ud">下架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000009</th>
                                <td>蒲隆地 卡揚扎 赤日處理廠 水洗處理法 咖啡豆 半磅</td>
                                <td class="ud">下架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>
                            <tr class="statuss">
                                <th>000010</th>
                                <td>淺中焙｜宏都拉斯 聖文森 諾亞小農 厭氧慢乾日曬 咖啡豆</td>
                                <td class="ud">下架</td>
                                <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                            </tr>

                        </tbody>
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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    //console.log($(".statuss").children(".ud:contains(上)"));


    function statusall() {
        $(".statuss").children(".ud:contains(上)").parent().css("display", "");
        $(".statuss").children(".ud:contains(下)").parent().css("display", "");
    }

    function statusup() {
        $(".statuss").children(".ud:contains(上)").parent().css("display", "");
        $(".statuss").children(".ud:contains(下)").parent().css("display", "none");
    }

    function statusdown() {
        $(".statuss").children(".ud:contains(上)").parent().css("display", "none");
        $(".statuss").children(".ud:contains(下)").parent().css("display", "");
    }
</script>


<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?>