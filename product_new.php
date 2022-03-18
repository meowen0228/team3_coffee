<?php
require __DIR__ . '/php_part/connect_db.php';

$title = '商品管理';
$pageName = 'product1_';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql1= "SELECT 
`status`,
p_name,
price,
fk_product_types,
content,
products.id
from products
join product_types on product_types.id = products.fk_product_types
join product_photos on product_photos.id = fk_product_photos_id
where products.id = $id";
$row = $pdo->query($sql1)->fetch();
// if (empty($row)) {
//     header('Location: product_list1.php'); // 找不到資炓轉向列表頁
//     exit;
// }

$sql2= "SELECT * FROM product_photos
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
                            <input class="form-check-input" type="radio" name="status" id="productstatus2" value="1" >
                            <label class="form-check-label" for="productstatus">上架</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="productstatus2" value="0" >
                            <label class="form-check-label" for="productstatus2">下架</label>
                        </div>
                    </div>
                    <div class="mb-3">



                        

                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">名稱:
                        </div>
                        <div class="col-8"><input type="text" id="name" class="form-control typing" name="p_name" required value=""></div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">金額:
                        </div>
                        <div class="col-8"><input type="tel" id="price" name="price" class="form-control typing" value=""></div>
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
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype3" value="3" >
                                <label class="form-check-label" for="producttype3">肯亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype4" value="4" >
                                <label class="form-check-label" for="producttype4">衣索比亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype5" value="5">
                                <label class="form-check-label" for="producttype5">瓜地馬拉</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fk_product_types" id="producttype6" value="6" >
                                <label class="form-check-label" for="producttype6">其他</label>
                            </div>
                        </div>

                    </div>
                    <div class="mb-4">圖片上傳：</div>
                    <div class="row g-4 mb-3 align-items-center">
                            <div class="col-3">
                                <div class="box">
                                    <input type="file" onchange="readURL(this)" targetid="preview_img1" name="url" accept="image/gif, image/jpeg, image/png">
                                    <img id="preview_img1" src="" style="width: 100%;">
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



<?php include __DIR__ . '/layout/scripts.php'; ?>
<script>
    const p_name = document.form1.p_name; // DOM element
    const p_name_msg = p_name.closest('.mb-3').querySelector('.form-text');

    const price = document.form1.price;
    const price_msg = price.closest('.mb-3').querySelector('.form-text');
    
    // const content = document.form.content;
    // const content_msg = content.closest('.mb-3').querySelector('.form-text');

    function checkForm(){
        let isPass = true; // 有沒有通過檢查

        // name_msg.innerText = '';  // 清空訊息
        // price_msg.innerText = '';  // 清空訊息

        // // TODO: 表單資料送出之前, 要做格式檢查

        // if(name.value.length<2){
        //     isPass = false;
        //     name_msg.innerText = '請填寫正確的姓名'
        // }

        

        if(isPass){
            const fd = new FormData(document.form1);

            fetch('product_new_api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('新增成功');
                    location.href = 'product_list1.php';
                } else {
                    alert('新增失敗');
                }

            })


        }


    }
</script>
<?php include __DIR__ . '/layout//html-foot.php'; ?>