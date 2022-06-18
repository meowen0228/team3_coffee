<?php
$title = '商品修改';
$pagename = 'revise';
?>

<?php include '../layout/html-head.php'; ?>
<?php include '../layout/header.php'; ?>
<link rel="stylesheet" href="../layout/css/admin.css">

<head>


    <style>
        .card {
            padding: 50px;
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

        .upImg {
            border: transparent;
            background-color: transparent;
        }

        .wrapper {
            height: 50px;
            /*This part is important for centering*/
            display: flex;
        }

        .typing-demo {
            width: 22ch;
            animation: typing 2s steps(22), blink .5s step-end infinite alternate;
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid;
            font-family: monospace;
            font-size: 2em;
        }

        @keyframes typing {
            from {
                width: 0
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent
            }
        }

        .img-up-btn1 {
            width: 250px;
            height: 250px;
            color: rgb(122, 122, 122);
            font-size: 60px;
            border: none;
            border-radius: 10px;
            position: relative;
        }

        .img-up-btn1 img {
            width: 250px;
            height: 250px;
            border: none;
            border-radius: 10px;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>

<body>
    <?php include '../layout/aside.php'; ?>
    <?php
    require '../layout/connect_db.php';
    $title = '新增資料';
    $pageName = 'ab-revise';

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $sql =
        sprintf("SELECT * FROM drink_menu where id=$id");

    $row = $pdo->query($sql)->fetch();
    // if (empty($row)) {
    //     header('Location: product_list1.php'); // 找不到資炓轉向列表頁
    //     exit;
    // }
    ?>

    <main class="admin-main px-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="wrapper">
                        <div class="typing-demo">菜單管理系統-管理菜單</div>
                    </div>
                    <div class="card">
                        <form name="form" class="form" method="post" novalidate onsubmit="checkForm(); return false;">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?= htmlentities($row['id']) ?>">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="productstatus2" value="1" <?php if ($row['status'] == 1) { ?> checked <?php } ?>>
                                    <label class="form-check-label" for="productstatus">上架</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="productstatus2" value="0" <?php if ($row['status'] == 0) { ?> checked <?php } ?>>
                                    <label class="form-check-label" for="productstatus2">下架</label>
                                </div>
                            </div>
                            <div class="mb-3"></div>
                            <div class="row g-4 mb-3 align-items-center">
                                <div class="col-1">名稱:</div>
                                <div class="col-8">
                                    <input type="text" class="form-control typing" id="name" name="drink_name" required value="<?= htmlentities($row['drink_name']) ?>">
                                </div>
                            </div>

                            <div class="row g-4 mb-3 align-items-center">
                                <div class="col-1">價格:</div>
                                <div class="col-8">
                                    <input type="int" id="price" name="price" class="form-control typing" value="<?= htmlentities($row['price']) ?>">
                                </div>
                            </div>

                            <div class="mb-4">圖片上傳：</div>
                            <div class="row g-4 mb-3 align-items-center">
                                <div class="col-10 mt-1 mx-auto ">
                                    <button id="imgUpBtn" type="button" class="img-up-btn1" onclick="img_url.click()">+<img id="preview_img1" src="<?= $row['url'] ?>" alt=""></button>
                                    <input type="hidden" id="img_url_post" name="img_url_post" value="<?= $row['url'] ?>">
                                </div>
                            </div>

                            <div class="row g-4 mt-4 mb-4 ">
                                <div class="col-1" id="content">介紹:</div>
                                <div class=" col-8 form-floating  ">
                                    <textarea class="form-control typing" placeholder="" name="content" id="textarea" style="height: 100px"><?= htmlentities($row['content']) ?></textarea>
                                    <label for="textarea"></label>
                                </div>
                            </div>

                            <div class="row g-4 mb-3 align-items-center">
                                <div class="col-10"></div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-secondary addProduct">上傳</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <form name="img_form" onsubmit="return false;" style="display: none;">
                    <input type="file" id="img_url" name="img_url" accept="image/jpeg,image/png">
                </form>
                <div class="col-1"></div>
            </div>
        </div>
    </main>
    <script>
        img_url.onchange = sendData;

        function sendData() {
            const fd = new FormData(document.img_form);
            fetch('drink_menu_add_img_api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success && obj.filename) {
                        preview_img1.src = './img/menu/' + obj.filename;
                        $("#img_url_post").val('./img/menu/' + obj.filename);
                    }
                });
        }

        function checkForm() {
            let isPass = true; // 有沒有通過檢查
            if (isPass) {
                const fd = new FormData(document.form);
                fetch('drink_menu_revie_api.php', {
                        method: 'POST',
                        body: fd
                    }).then(r => r.json())
                    .then(obj => {
                        console.log(obj);
                        if (obj.success) {
                            Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: '修改成功',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                .then(function() {
                                    location.href = "drink_menu.php"
                                })
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: '修改失敗',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
            }
        }
    </script>
</body>
<footer>
    <?php include '../layout/scripts.php'; ?>
    <?php include '../layout//html-foot.php'; ?>
</footer>