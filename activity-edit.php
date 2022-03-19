<?php
require __DIR__ . '/layout/connect_db.php';

$title = '首頁/活動修改';
$pageName = 'activity-edit';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM activity WHERE id = $id ";
$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: activity-list.php'); // 找不到資炓轉向列表頁
    exit;
}
?>
<style>
    form .mb-3 .form-text {
        color: red;
    }
</style>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>


<main class="admin-main px-5 py-5 d-flex">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="d-flex justify-content-between">
            <div class="col-6">
                <h4>優惠活動</h4>
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
                <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;" action="">
                    <div class="g-col-6">
                        <div class="mb-3">
                            <label class="form-label" for="title">標題：</label>
                            <input type="text" class="form-control" id="title" name="title" required value="<?= $row['title'] ?>">
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">公告期間：</label>
                            <input type="date" class="form-control" id="start-time" name="start-time" value="<?= $row['start_time'] ?>" required> 
                            <input type="date" class="form-control" id="end-time" name="end-time" value="<?= $row['end_time'] ?>" required>
                            <div class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">優惠代碼：</label>
                            <input type="text" class="form-control" id="discount" name="discount" value="<?= $row['discount'] ?>" required>
                            <div class="form-text"></div>
                        </div>
                    </div>

                    <div class="activity-textarea mb-3">
                        <label for="contents" class="form-label">內容：</label><br>
                        <textarea class="form-control" name="contents" id="contents" rows="3"><?= $row['contents'] ?></textarea>
                        <div class="form-text"></div>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="submut-btn btn btn-secondary">修改</button>
                    <button type="button" class="submut-btn btn btn-secondary me-2"><a href="javascript: back()"> 取消</button>

                </form>
            </div>

        </div>

    </div> <!-- col-10 end  -->
    <div class="col-1"></div>

</main>


<?php include __DIR__ . '/layout/scripts.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script>
    const title = document.form1.title; // DOM element
    const title_msg = title.closest('.mb-3').querySelector('.form-text');

    const discount = document.form1.discount;
    const discount_msg = discount.closest('.mb-3').querySelector('.form-text');

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

            fetch('activity-edit-api.php', {
                    method: 'POST',
                    body: fd
                }).then(r => r.json())
                .then(obj => {
                    console.log(obj);
                    if (obj.success) {
                        alert('修改成功');
                        location.href = 'activity-list.php';
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
            location.href = 'activity-list.php';
        }
    }
</script>
<?php include __DIR__ . '/layout/html-foot.php'; ?>