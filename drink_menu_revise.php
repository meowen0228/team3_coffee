<?php
$title = '商品修改';
$pagename = 'revise';
?>

<head>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
</head>

<body>
<?php include __DIR__ . '/layout/aside.php'; ?>
<?php
require __DIR__ . '/connect_db.php';
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

                <h4>菜單管理</h4>
                <form name="form" class="form" method="post" novalidate onsubmit="checkForm(); return false;">
                <div class="mb-3">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="productstatus2" value="1" <?php if ($row['status'] == 1) { ?> checked <?php } ?>>
                            <label class="form-check-label" for="productstatus">上架</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="productstatus2" value="0" <?php if ($row['status'] == 0) { ?> checked <?php } ?>>
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
                            <input type="text" class="form-control typing" id="name" name="drink_name" required value="<?= htmlentities($row['drink_name']) ?>" >
                        </div>
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-1">
                            價格:
                        </div>
                        <div class="col-8">
                            <input type="int" id="price" name="price" class="form-control typing" value="<?= htmlentities($row['price']) ?>">
                        </div>
                    </div>
                    <div class="mb-4">
                        圖片上傳：
                    </div>
                    <div class="row g-4 mb-3 align-items-center">
                        <div class="col-3">
                            <div class="box">
                                <!-- <input type="file"  onchange="readURL(this)" targetid="preview_img1" accept="image/gif, image/jpeg, image/png" >
                                <img id="preview_img1" name="url" src="" style="width: 100%;"> -->
                                <input type="text" name="url" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4 mb-4 ">
                        <div class="col-1" id="content">
                            介紹:
                        </div>
                        <div class=" col-8 form-floating  ">
                        <textarea class="form-control typing" placeholder="" name="content" id="textarea" style="height: 100px"><?= htmlentities($row['content']) ?></textarea>
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



        <div class="col-1"></div>
    </div>
    </div>

</main>
<script>
    // const drink_name = document.form.drink_name; // DOM element
    // const drink_name_msg = drink_name.closest('.mb-3').querySelector('.form-text');

    // const price = document.form.price;
    // const price_msg = price.closest('.mb-3').querySelector('.form-text');

    // const content = document.form.content;
    // const content_msg = content.closest('.mb-3').querySelector('.form-text');

        function checkForm(){
        let isPass = true; // 有沒有通過檢查

        // drink_name_msg.innerText = '';  // 清空訊息
        // price_msg.innerText = '';  // 清空訊息
        // content_msg.innerText = ''; // 清空訊息
        // TODO: 表單資料送出之前, 要做格式檢查

        // if(drink_name.value.length<1){
        //     isPass = false;
        //     drink_name_msg.innerText = '商品名稱不能為空'
        // }

        // const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()
        // if(mobile.value){
        //     // 如果不是空字串就檢查格式
        //     if(! mobile_re.test(mobile.value)){
        //         mobile_msg.innerText = '請輸入正確的手機號碼';
        //         isPass = false;
        //     }
        // }

        function sendData(){
        const fd = new FormData(document.img_form);

        fetch('product_new_img_api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json())
        .then(obj=>{
            console.log(obj);
            if(obj.success && obj.filename){
                preview_img1.src = './img/shop/'+ obj.filename;
                // console.log('./img/shop/' + obj.filename);
                $("#img_url_post").val('./img/shop/'+ obj.filename);
                // img_url_post.value = './img/shop/'+ obj.filename;
            }
        });
    }
    img_url.onchange = sendData;







        if(isPass){
            const fd = new FormData(document.form);

            fetch('drink_menu_revie_api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('修改成功');
                    location.href = 'drink_menu.php';
                } else {
                    alert('修改失敗');
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