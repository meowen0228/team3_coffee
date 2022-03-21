<?php
$title = '後台首頁';
$pagename = 'home';
?>

<head>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>




<style>
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
    .upImg{
        border: transparent;
        background-color: transparent;
    }
    .form-text{
        display: inline;
        color: red;
    }
</style>



</head>

<body>
<?php include __DIR__ . '/layout/aside.php'; ?>
<?php
require __DIR__ . '/layout/connect_db.php';
$title = '新增資料';
$pageName = 'ab-add';


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = 
sprintf("SELECT * FROM drink_menu where id=$id");


$row = $pdo->query($sql)->fetchAll();
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

                <h4>菜單管理</h4>
                <form name="form" class="form" method="post" novalidate onsubmit="checkForm(); return false;">
                <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="productstatus1" id="productstatus2" value="1">
                            <label class="form-check-label" for="productstatus">上架</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="productstatus1" id="productstatus2" value="0">
                            <label class="form-check-label" for="productstatus2">下架</label>
                        </div>
                    </div>
                    <div class="mb-3">
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">
                            名稱:
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control typing" id="name" name="drink_name" required value="" >
                            <div class="form-text"></div>
                        </div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">
                            價格:
                        </div>
                        <div class="col-8">
                            <input type="int" id="price" name="price" class="form-control typing" value="">
                            <div class="form-text"></div>
                        </div>
                    </div>
                    <div class="mb-4">圖片上傳：</div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-3">
                            <button type="button" onclick="img_url.click()">上傳圖片</button>
                            <div class="box">
                                <img id="preview_img1" src="" style="width: 100%;">
                                <input type="hidden" id="img_url_post" name="img_url_post" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4 mb-4 ">
                        <div class="col-1" id="content">
                            介紹:
                        </div>
                        <div class=" col-8 form-floating  ">
                            <textarea class="form-control typing" placeholder="" id="textarea" name="content" style="height: 100px"></textarea>
                            <label for="textarea"></label>
                        </div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-10">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-secondary addProduct">
                            上傳
                            </button>
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

    function sendData(){
        const fd = new FormData(document.img_form);

        fetch('drink_menu_add_img_api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json())
        .then(obj=>{
            console.log(obj);
            if(obj.success && obj.filename){
                preview_img1.src = './img/menu/'+ obj.filename;
                $("#img_url_post").val('./img/menu/'+ obj.filename);
            }
        });
    } 


        const name = document.form.name; // DOM element
        const name_msg = name.closest('.mb-3').querySelector('.form-text');
        const price = document.form.price;
        const price_msg = price.closest('.mb-3').querySelector('.form-text');

        // $('#name');
        // console.log($('#name'));


    function checkForm(){
        let isPass = true; // 有沒有通過檢查

        if(name.value == ''){
            isPass = false;
            name_msg.innerText = '請入正確的姓名'
            location = '#';
        }

        if(price.value == ''){
            isPass = false;
            price_msg.innerText = '請輸入價格'
            location = '#';
        }

        // name_msg.innerText

        if(isPass){
            const fd = new FormData(document.form);
            fetch('drink_menu_add_api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('新增成功');
                    location.href = 'drink_menu.php';
                } else {
                    alert('新增失敗');
                }
            })
        }
    }


</script>
<?php include __DIR__ . '/layout/scripts.php'; ?>
</body>

<footer>
<?php include __DIR__ . '/layout//html-foot.php'; ?>
</footer>