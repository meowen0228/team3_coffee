<?php
require __DIR__ . '/layout/connect_db.php';

$title = '商品管理';
$pageName = 'product1_';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql1 = "SELECT 
`status`,
p_name,
price,
fk_product_types,
content,
`url`,
products.id
from products
join product_types on product_types.id = products.fk_product_types
where products.id = $id";

$row = $pdo->query($sql1)->fetch();
// if (empty($row)) {
//     header('Location: product_list1.php'); // 找不到資炓轉向列表頁
//     exit;
// }

$sql2 = "SELECT * FROM product_photos
where fk_product_id = $id;";
$row2 = $pdo->query($sql2)->fetchAll();
?>

<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>
<style>
    .admin-main {
        background: #F2F2F2;
        /* padding: 10px; */
    }

    .form1 {

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
</style>

<main class="admin-main px-5 py-5 ">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

                <h4>商品管理</h4>
                <form name="form1" class="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="productstatus1" value="1"> 
                            
                            <label class="form-check-label" for="productstatus">上架</label>
                            
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="productstatus2" value="0">   
                            <label class="form-check-label" for="productstatus2">下架</label>
                            
                        </div>
                        <div class="form-text form-check form-check-inline"></div>
                       
                    </div>
                    <div class="mb-3">





                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">名稱:
                        </div>
                        <div class="col-8"><input type="text" id="name" class="form-control typing" name="p_name" required value="">
                            <div class="form-text"></div>
                        </div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">金額:
                        </div>
                        <div class="col-8"><input type="tel" id="price" name="price" class="form-control typing" value="">
                        <div class="form-text"></div></div>
                    </div>
                    <div class=" row g-4 mb-3 align-items-center">
                        <div class="col-1">分類：</div>
                        <div class="col-8">


                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype1" value="1">
                                <label class="form-check-label" for="producttype1">巴西</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype2" value="2">
                                <label class="form-check-label" for="producttype2">哥倫比亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype3" value="3">
                                <label class="form-check-label" for="producttype3">肯亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype4" value="4">
                                <label class="form-check-label" for="producttype4">衣索比亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype5" value="5">
                                <label class="form-check-label" for="producttype5">瓜地馬拉</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype6" value="6">
                                <label class="form-check-label" for="producttype6">其他</label>
                            </div>
                            <div class="form-text form-check form-check-inline"></div>
                        </div>

                    </div>
                    <div class="mb-4">圖片上傳：</div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-3">
                            <div class="box">
                                <button type="button" onclick="img_url.click()">上傳圖片</button>
                                <img id="preview_img1" src="" style="width: 100%;">
                                <input type="hidden" id="img_url_post" name="img_url_post" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4 mb-4 ">
                        <div class="col-1" id="content">介紹:
                        </div>
                        <div class=" col-8 form-floating  ">
                            <textarea class="form-control typing" placeholder="" name="content" id="textarea" style="height: 100px"></textarea>
                            <label for="textarea"></label>
                        </div>
                    </div>
                    <input type="text" name="id" value="1" hidden>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-10">
                        </div>
                        <div class="col-2"><button type="submit" class="btn btn-secondary addProduct">上傳</button></div>
                    </div>
                </form>
                <form name="img_form" onsubmit="return false;" style="display: none;">
                    <input type="file" id="img_url" name="img_url" accept="image/jpeg,image/png">
                </form>
            </div>
        </div>



        <div class="col-1"></div>
    </div>
    </div>

</main>
<script>
    // function readURL(input) {
    //     if (input.files && input.files[0]) {
    //         var imageTagID = input.getAttribute("targetID");
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             var img = document.getElementById(imageTagID);
    //             img.setAttribute("src", e.target.result)
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php include __DIR__ . '/layout/scripts.php'; ?>
<script>
    function sendData() {
        const fd = new FormData(document.img_form);

        fetch('product_new_img_api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success && obj.filename) {
                    preview_img1.src = './img/shop' + obj.filename;
                    // console.log('./img/shop/' + obj.filename);
                    $("#img_url_post").val('./img/shop' + obj.filename);
                    // img_url_post.value = './img/shop/'+ obj.filename;
                }
            });
    }
    img_url.onchange = sendData;

    const name = document.form1.name; // DOM element
    const name_msg = name.closest('.mb-3').querySelector('.form-text');

    const price = document.form1.price;
    const price_msg = price.closest('.mb-3').querySelector('.form-text');

    const productstatus2 = document.form1.productstatus2;
    const productstatus1 = document.form1.productstatus1;
    const productstatus_msg = productstatus1.closest('.mb-3').querySelector('.form-text');

    const producttype1 = document.form1.producttype1;
    const producttype2 = document.form1.producttype2;
    const producttype3 = document.form1.producttype3;
    const producttype4 = document.form1.producttype4;
    const producttype5 = document.form1.producttype5;
    const producttype6 = document.form1.producttype6;
    const producttype_msg = producttype1.closest('.mb-3').querySelector('.form-text');





    function checkForm() {
        let isPass = true;

        if (name.value == '') {
            isPass = false;
            name_msg.innerText = '請輸入名稱';
            location.href = '#';
        }else{
            name_msg.innerText ="";
        }

        if (price.value == '') {
            isPass = false;
            price_msg.innerText = '請輸入金額';
            location.href = '#';
        }else{
            price_msg.innerText ="";
        }
        

        // var f = document.forms[0];
           var $pro= $("input[name='status']:checked").val();
           console.log($pro);
           if($pro === undefined){
            productstatus_msg.innerText = '請選擇';
            location.href = '#';
           }else{
            productstatus_msg.innerText = '';
           }
        //    if(productstatus2 productstatus1 check)
        //    if (!(f.productstatus2[0].checked || f.productstatus1[1].checked)) {  
        //     productstatus_msg.innerText = '請選擇'
        //     location.href = '#'
        // return false; 
        //    }

        var $type = $("input[name='fk_product_types']:checked").val();
           console.log($pro);
           if($type === undefined){
            producttype_msg.innerText = '請選擇';
            location.href = '#';
           }else{
            producttype_msg.innerText = '';
           }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('product_new_api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('新增成功');
                        location.href = 'product_list.php';
                    } else {
                        alert('新增失敗');
                    }

                })


        }


    }
</script>
<?php include __DIR__ . '/layout//html-foot.php'; ?>