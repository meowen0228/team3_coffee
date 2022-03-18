<?php
require __DIR__ . '/php_part/connect_db.php';

$title = '商品管理';
$pageName = 'product_';

$sid = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM products WHERE id=$id";
$row = $pdo->query($sql)->fetch();
if(empty($row)){
    header('Location: product_.php'); // 找不到資炓轉向列表頁
    exit;
}
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
</style>

<main class="admin-main px-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">

                <h4>商品管理</h4>
                <form class="form">
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="productstatus" id="productstatus1" value="option1">
                            <label class="form-check-label" for="productstatus">上架</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="productstatus" id="productstatus2" value="option2">
                            <label class="form-check-label" for="productstatus2">下架</label>
                        </div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">名稱:
                        </div>
                        <div class="col-8"><input type="text" id="name" class="form-control typing" id="name" name="name" required
                            value="<?= htmlentities($row['p_name']) ?>"></div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">金額:
                        </div>
                        <div class="col-8"><input type="tel" id="name" class="form-control typing"></div>
                    </div>
                    <div class=" row g-4 mb-3 align-items-center">
                        <div class="col-1">分類：</div>
                        <div class="col-8">


                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="producttype" id="producttype1" value="option1">
                                <label class="form-check-label" for="producttype1">巴西</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="producttype" id="producttype2" value="option2">
                                <label class="form-check-label" for="producttype2">哥倫比亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="producttype" id="producttype3" value="option3">
                                <label class="form-check-label" for="producttype3">肯亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="producttype" id="producttype4" value="option4">
                                <label class="form-check-label" for="producttype4">衣索比亞</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="producttype" id="producttype5" value="option5">
                                <label class="form-check-label" for="producttype5">瓜地馬拉</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="producttype" id="producttype6" value="option6">
                                <label class="form-check-label" for="producttype6">其他</label>
                            </div>
                        </div>

                    </div>
                    <div class="mb-4">圖片上傳：</div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-3">
                            <div class="box">

                                <input type="file" onchange="readURL(this)" targetid="preview_img1" accept="image/gif, image/jpeg, image/png">
                                <img id="preview_img1" src="#" style="width: 100%;">
                            
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="box">
                                <input type="file" onchange="readURL(this)" targetid="preview_img2" accept="image/gif, image/jpeg, image/png">
                                <img id="preview_img2" src="#" style="width: 100%;">


                            </div>
                        </div>
                        <div class="col-3">
                            <div class="box">


                                <input type="file" onchange="readURL(this)" targetid="preview_img3" accept="image/gif, image/jpeg, image/png" multiple>
                                <img id="preview_img3" src="#" style="width: 100%;">



                            </div>
                        </div>
                        <div class="col-3">
                            <div class="box">


                                <input type="file" onchange="readURL(this)" targetid="preview_img4" accept="image/gif, image/jpeg, image/png" multiple>
                                <img id="preview_img4" src="#" style="width: 100%;">



                             
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4 mb-4 ">
                        <div class="col-1">介紹:
                        </div>
                        <div class=" col-8 form-floating  ">
                            <textarea class="form-control typing" placeholder="" id="textarea" style="height: 100px"></textarea>
                            <label for="textarea"></label>
                        </div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-10">
                        </div>
                        <div class="col-2"><button type="button" class="btn btn-secondary addProduct">上傳</button></div>
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
<?php include __DIR__ . '/layout//html-foot.php'; ?>