<?php
require  '../layout/connect_db.php';


$title = '首頁/橫幅修改';
$pageName = 'banner-edit';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM banner WHERE id = $id ";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: banner-list.php'); // 找不到資炓轉向列表頁
    exit;
}

?>
<?php include  '../layout/html-head.php'; ?>
<?php include  '../layout/header.php'; ?>
<?php include  '../layout/aside.php'; ?>
<link rel="stylesheet" href="../layout/css/admin.css">

<style>
    .form .mb-3 .form-text {
        color: red;
    }

    .box {
        border: 1px solid black;
        width: 200px;
        height: 200px;
        background: #F2F2F2;
    }

    .box button {
        position: absolute;
        background: transparent;
    }
</style>






<main class="admin-main px-5 py-5 d-flex">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="d-flex justify-content-between">
            <div class="col-6">
                <h4>橫幅管理</h4>
            </div>
            <!-- <div class="add-button col-1">
        <button type="button" class="index-add-btn btn btn-outline-secondary"><a href="">新增活動</a></button>
      </div> -->
            <div class="data-search col-2.5">
                <input class="data-search-input" list="" id="">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="main-admin">
            <div class="mb-3">
                <h5><strong>修改活動項目</strong></h5>
            </div>


            <div class="grid rows-2 mb-3">
                <form name="form1" class="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                    <div class="g-col-6">
                        <div class="mb-3">
                            <div class="mb-4">圖片上傳：</div>
                            <div class="row g-4 mb-3 align-items-center">
                                <div class="col-3">
                                    <button type="button" onclick="img_url.click()">上傳圖片</button>
                                    <div class="box">
                                        <img id="preview_img1" src="<?= $row['photo'] ?>" style="width: 100%;">
                                        <input type="hidden" id="img_url_post" name="img_url_post" value="<?= $row['photo'] ?>">
                                    </div>
                                </div>


                            </div>

                            <div class="mb-3">
                                <label for="title" class="form-label">標題：</label><br>
                                <input type="text" class="form-control" name="title" id="title" value="<?= $row['title'] ?>" required>
                                <div class="form-text"></div>
                            </div>
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="submut-btn btn btn-secondary">修改</button>
                            <button type="button" class="submut-btn btn btn-secondary me-2"><a href="javascript: back()">取消</button>
                </form>
                <form name="img_form" onsubmit="return false;" style="display: none;">
                    <input type="file" id="img_url" name="img_url" accept="image/jpeg,image/png">
                </form>
            </div>

        </div>

    </div> <!-- col-10 end  -->
    <div class="col-1"></div>

</main>


<?php include  '../layout/scripts.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script>
    function sendData() {
        const fd = new FormData(document.img_form);

        fetch('banner-photo-api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success && obj.filename) {
                    preview_img1.src = './img/banner' + obj.filename;
                    // console.log('./img/' + obj.filename);
                    $("#img_url_post").val('./img/banner' + obj.filename);
                    // img_url_post.value = './img/'+ obj.filename;
                }
            });
    }
    img_url.onchange = sendData;

    const title = document.form1.title; // DOM element
    const title_msg = title.closest('.mb-3').querySelector('.form-text');

    function checkForm() {
        let isPass = true; // 有沒有通過檢查

        // title_msg.innerText = '';  // 清空訊息
        // discount_msg.innerText = '';  // 清空訊息

        // TODO: 表單資料送出之前, 要做格式檢查

        // if(name.value.length<2){
        //     isPass = false;
        //     name_msg.innerText = '請填寫正確的姓名'
        // }

        // const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/; // new RegExp()
        // if(mobile.value){
        //     // 如果不是空字串就檢查格式
        //     if(! mobile_re.test(mobile.value)){
        //         mobile_msg.innerText = '請輸入正確的手機號碼';
        //         isPass = false;
        //     }
        // }


        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('banner-edit-api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('修改成功');
                        location.href = 'banner-list.php';
                    } else {
                        alert('沒有修改');
                    }
                })
        }
    }
</script>
<script>
    function back() {
        if (confirm(`確定要取消修改嗎?`)) {
            location.href = 'banner-list.php';
        }
    }
</script>
<?php include  '../layout/html-foot.php'; ?>