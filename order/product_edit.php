<?php
require '../layout/connect_db.php';

$title = '商品管理';
$pageName = 'product1_';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql1= "SELECT 
`status`,
p_name,
price,
fk_product_types,
content,
`url`, 
products.id as products_id
from products
join product_types on product_types.id = products.fk_product_types
where products.id = $id";

$row = $pdo->query($sql1)->fetch();
if (empty($id )) {
    header('Location: product_list1.php'); // 找不到資炓轉向列表頁
    exit;
}

// $sql2= "SELECT * FROM product_photos
// where fk_product_id = $id;";
// $row2 = $pdo->query($sql2)->fetchAll();
?>

<?php include '../layout/html-head.php'; ?>
<?php include '../layout/header.php'; ?>
<?php include '../layout/aside.php'; ?>
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
    .upImg{
        border: transparent;
        background-color: transparent;
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
                            <input class="form-check-input" type="radio" name="status" id="productstatus" value="1" <?php if ($row['status'] == 1) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="productstatus">上架</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="productstatus2" value="0" <?php if ($row['status'] == 0) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="productstatus2">下架</label>
                        </div>
                    </div>
                    <div class="mb-3">



                        <!-- <?php if ($row['status'] == 1) { ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="productstatus" id="productstatus1" value="option1" checked>
                                <label class="form-check-label" for="productstatus">上架</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="productstatus" id="productstatus1" value="option2">
                                <label class="form-check-label" for="productstatus2">下架</label>
                            </div>
                        <?php } else { ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="productstatus" id="productstatus1" value="option1">
                                <label class="form-check-label" for="productstatus">上架</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="productstatus" id="productstatus1" value="option2" checked>
                                <label class="form-check-label" for="productstatus2">下架</label>
                            </div>
                        <?php } ?> -->

                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">名稱:
                        </div>
                        <div class="col-8"><input type="text" id="name" class="form-control typing" name="p_name" required value="<?= htmlentities($row['p_name']) ?>">
                    <div class="form-text"></div>
                    </div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">金額:
                        </div>
                        <div class="col-8"><input type="tel" id="price" name="price" class="form-control typing" value="<?= htmlentities($row['price']) ?>"></div>
                    </div>
                    <div class=" row g-4 mb-3 align-items-center">
                        <div class="col-1">分類：</div>
                        <div class="col-8">


                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype1" value="1" <?php if ($row['fk_product_types'] == 1) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="producttype1">巴西</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype2" value="2" <?php if ($row['fk_product_types'] == 2) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="producttype2">哥倫比亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype3" value="3" <?php if ($row['fk_product_types'] == 3) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="producttype3">肯亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype4" value="4" <?php if ($row['fk_product_types'] == 4) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="producttype4">衣索比亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype5" value="5" <?php if ($row['fk_product_types'] == 5) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="producttype5">瓜地馬拉</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype6" value="6" <?php if ($row['fk_product_types'] == 6) { ?> checked <?php } ?>>
                                <label class="form-check-label" for="producttype6">其他</label>
                            </div>
                        </div>

                    </div>
                    <div class="mb-4">圖片上傳：</div>
                        <div class="row g-4 mb-3 align-items-center">
                       
                            <div class="col-3">
                                <div class="box upImg">
                                <button type="button" onclick="img_url.click()">上傳圖片</button>

                                <img id="preview_img1" src="<?=$row['url'] ?>"   style="width: 100%;">
                                <input type="hidden" id="img_url_post" name="img_url_post" value="<?=$row['url']?>">

                            </div>
                        </div>
                     
                       
                    </div>
                    <div class="row g-4 mt-4 mb-4 ">
                        <div class="col-1" id="content">介紹:
                        </div>
                        <div class=" col-8 form-floating  ">

                            <textarea class="form-control typing" placeholder="" name="content" id="textarea" style="height: 100px"><?= htmlentities($row['content']) ?></textarea>
                            <label for="textarea"></label>
                        </div>
                    </div>
                    <input type="text" name="id" value="<?= $row['products_id']?>" hidden>
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var imageTagID = input.getAttribute("targetID");
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.getElementById(imageTagID);
                img.setAttribute("src", e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php include '../layout/scripts.php'; ?>
<script>

    function sendData(){
        const fd = new FormData(document.img_form);

        fetch('product_new_img_api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json())
        .then(obj=>{
            console.log(obj);
            if(obj.success && obj.filename){
                preview_img1.src = './img/shop'+ obj.filename;
                // console.log('./img/' + obj.filename);
                $("#img_url_post").val('./img/shop'+ obj.filename);
                // img_url_post.value = './img/'+ obj.filename;
            }
        });
    }
    img_url.onchange = sendData;

    const name = document.form1.name; // DOM element
    const name_msg = name.closest('.mb-3').querySelector('.form-text');

    const price = document.form1.price;
    const price_msg = price.closest('.mb-3').querySelector('.form-text');
    
   
    function checkForm(){
        let isPass = true; 
        if(name.value == ''){
            isPass = false;
            name_msg.innerText = '請輸入'
        }

        

        if(isPass){
            const fd = new FormData(document.form1);

            fetch('product_edit_api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('修改成功');

                    location.href = 'product_list.php';

                    
                } else {
                    alert('沒有修改');
                }

            })




    }
}
</script>


<?php include '../layout//html-foot.php'; ?>