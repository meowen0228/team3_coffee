    <?php
    // 連接資料庫
    require '../layout/connect_db.php';

    // 頁面資訊
    $title = '商品列表';
    $pagename = 'product_list';

    // 每一頁有幾筆
    $perPage = 10;

    // 用戶要看的頁碼
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    if ($page < 1) {
        header('Location: product_list.php?page=1');
        exit;
    }

    // 取得總筆數
    $t_sql = "SELECT COUNT(1) FROM products";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

    // 預設沒有資料
    $rows = [];
    $totalPages = 0;

    if ($totalRows) {
        $totalPages = ceil($totalRows / $perPage);
        if ($page > $totalPages) {
            header("Location: product_list1.php?page=$totalPages");
            exit;
        }

        $sql = sprintf("SELECT * FROM products ORDER BY id  LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
        $rows = $pdo->query($sql)->fetchAll(); // 拿到分頁資料
    }

    ?>

    <?php include '../layout/html-head.php'; ?>
    <?php include '../layout/header.php'; ?>
    <?php include '../layout/aside.php'; ?>

    <style>
        .admin-main {
            background: #F2F2F2;
            /* padding: 10px; */
        }

        .list {
            background: #FFFFFF;
            padding: 20px;

        }

        .fa-magnifying-glass {
            color: #aaa;

        }

        .product-search {
            height: 26px;
            background: #fff;
            border-radius: 50px;
        }

        .productsearch {
            border: transparent;
            outline: none;
        }


        /* .icon {
            background: #FFFFFF;
            border: #FFFFFF solid 1px;
            border-radius: 5px;
            border-left: none;
        } */

        /* .search {
            border: none;
            border-radius: 20px;
        } */

        .pagetext a {
            color: black;
        }

        .addProduct {
            border-radius: 20px;
        }

        .act {
            display: none;
        }

        .select {
            width: 70px;
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
                            <h4>商品項目管理</h4>
                        </div>
                        <div class="col-3"></div>

                        <div class="col-2"><a href="product_new.php?>" class="btn btn-light addProduct">+新增商品</a></div>
                        <div class="col-1">
                        </div>
                        <div class="col-3 product-search">
                            &thinsp;
                            <input class="productsearch" size="19" name="search-for" placeholder="搜尋名稱或編號">
                            <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
                        </div>

                        <!-- <div class="col-4">
                            <div class="input-group form-outline ">
                                <input class="productsearch" name="search-for" placeholder="搜尋名稱或編號">
                                <button type="button" class="btn btn-light icon search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>

                    </div> -->


                        <div class="list ">

                            <table class="table">
                                <thead>
                                    <div class="row">
                                        <tr>
                                            <th class="col-2">商品編號</th>
                                            <th class="col-3">商品縮圖</th>
                                            <th class="col-4">商品名稱</th>
                                            <!-- <th class="col-2">商品狀態</th> -->
                                            <th class="col-2">
                                                <select onChange="location = this.options[this.selectedIndex].value;" name="status" id="status" class="select">
                                                    <!-- <option selected>商品狀態</option> -->
                                                    <option selected value="product_list.php">全選</option>
                                                    <option value="product_list_up.php">上架</option>
                                                    <option value="product_list_down.php">下架</option>
                                                </select>
                                            </th>
                                            <th class="col-2">編輯</th>
                                        </tr>
                                    </div>
                                </thead>
                                <tbody>
                                    <!-- 假資料 -->
                                    <!-- <tr class="up">
                                    <th>99</th>
                                    <td>淺中焙｜衣索比亞 耶加雪菲 孔加 日曬處理法 一公斤 咖啡豆</td>
                                    <td>上架</td>
                                    <td><a href=""><i class="fa-solid fa-pen-to-square"></i></a></td>
                                </tr> -->
                                    <!-- 連接資料庫 -->

                                    <tr class="up">
                                        <?php foreach ($rows as $r) : ?>
                                            <th><?= $r['id'] ?></th>
                                            <th><img style="width:100%;" src="<?= $r['url'] ?>" alt=""></th>
                                            <td><?= $r['p_name'] ?></td>
                                            <?php if ($r['status'] == 1) { ?>
                                                <td>上架</td>
                                            <?php } else { ?>
                                                <td>下架</td>
                                            <?php } ?>
                                            <td><a href="product_edit.php?id=<?= $r['id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i></a></td>

                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                            <div class="container">

                            </div>

                        </div>
                    </div>
                </div>
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
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        // $(function() {
        //     $("#status").change(function() {
        //         switch (
        //             $(this).val() //指到 select 自己的選項。
        //         ) {
        //             case "1": // 當選到 value 是 0 的時候，移除兩個 class。
        //                 $(".up").removeClass("act");
        //                 $(".down").removeClass("act");
        //                 break;
        //             case "2": // 當選到 value 是 1 的時候，新增 .table1，移除 .table2。
        //                 $(".up").removeClass("act");
        //                 $(".down").addClass("act");
        //                 break;
        //             case "3": // 當選到 value 是 2 的時候，新增 .table2，移除 .table1。
        //                 $(".down").removeClass("act");
        //                 $(".up").addClass("act");
        //                 break;
        //             default:
        //                 return;
        //         }
        //     });
        // });

        // function showAll(){
        //         // $(".ask").children(".ans:contains(已)").parent().css("display","");
        //         // $(".ask").children(".ans:contains(未)").parent().css("display","");
        //         window.location.href='product-all.php';
        //       }
        //       function showup(){

        //         window.location.href='product-up.php';
        //       }
        //       function showdown(){

        //         window.location.href='product-down.php';
        //       }
        $(".productsearch").on("keyup mouseup contextmenu", function() {
            let search = $(this).val();
            if (search != '') {
                $(this).next().attr("href", "product_list_search.php?search-for=" + search);
            }
        });
    </script>


    <?php include '../layout/scripts.php'; ?>
    <?php include '../layout/html-foot.php'; ?>