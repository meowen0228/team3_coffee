<?php
$title = '上傳照片 ';
$pagename = 'upload-photo';
?>


<?php

// 過濾檔案並且決定副檔名
$exts = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];


$output = [
    'success' => false,
    'error' => '',
    'filename' => '',
];

if(empty($_FILES) or empty($_FILES['avatar'])){
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// 判斷是不是我們要的類型
$ext = $exts[ $_FILES['avatar']['type'] ];
if(empty($ext)){
    $output['error'] = '檔案類型錯誤';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$output['filename'] = sha1(uniqid(). $_FILES['avatar']['name']). $ext;

if(
    move_uploaded_file(
        $_FILES['avatar']['tmp_name'], 
        __DIR__. '/imgs/'. $output['filename']
        )
){
    $output['success'] = true;
} else {
    $output['error'] = '無法搬動檔案';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);


?>
<!-- <style>

</style>

<?php include __DIR__ . '/layout/html-head.php'; ?>
<?php include __DIR__ . '/layout/header.php'; ?>
<?php include __DIR__ . '/layout/aside.php'; ?>
<img src="./bootstrap/js/" alt="">

<main class="admin-main px-5 py-5 d-flex">
    <div class="row">
        <div class="col-1">
            <div class="col-10">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="file" name="uploadfile" value="" />

                    <div>
                        <button type="submit" name="upload" style="writing-mode: horizontal-tb;">
                            上傳
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


<?php include __DIR__ . '/layout/scripts.php'; ?>
<?php include __DIR__ . '/layout//html-foot.php'; ?> -->