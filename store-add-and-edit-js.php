
<!------------------------ script link ------------------------>

<!-- jquery -->
<script src="./jquery/jquery-3.6.0.min.js"></script>

<!-- jquery timepicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<!------------------------ script ------------------------>
<script>

    // 上傳照片
    
    function sendData(){
        const fd = new FormData(document.img_form);

        fetch('store-img-api.php', {
            method: 'POST',
            body: fd
        }).then(r=>r.json())
        .then(obj=>{
            console.log(obj);
            if(obj.success && obj.filename){
                $(".del-img").css("background", "rgb(82, 82, 82)");
                preview_img1.src = './img/store'+ obj.filename;
                $("#preview_img1").css("opacity", "1");
                $("#img_url_post").val('./img/store'+ obj.filename);
            }
        });
    }
    
    img_url.onchange = sendData;

    // 照片刪除
    $(".del-img").on("click", function(){
        $(this).css("background", "transparent");
        $("#preview_img1").css("opacity", "0");
        $("#img_url_post").val('');
        $("#preview_img1").attr("src", "");
    })

    // timepicker
    $('.timepicker-start').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '00',
        maxTime: '23:30pm',

        startTime: '08:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    $('.timepicker-end').timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '00',
        maxTime: '23:30pm',
        
        startTime: '08:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    // 取消儲存按鈕
    $("#cancel_btn").click(function(){
        location.href='store-list.php'
    })
    
    // checkbox value = $r3['serve_EN_name'] 改變
    $(":checkbox").on("click", function(){
        let chk = $(this).prop("checked");
        console.log(chk);
        if(chk){
        $(this).attr("value", "1");
        $(this).prev().attr("value", "1");
        } else {
        $(this).attr("value", "0");
        $(this).prev().attr("value", "0");
        }
    })  
    
    // 營業時間選項改變
    $(".store-status-select").on("change", function(){
    let selectStatus = $(this).val();
    let changeSelect = $(this).nextAll();
    let statusName = $(this).closest("div").find("#status_name");

    // console.log(statusName);
    // console.log(changeSelect);

    if (selectStatus == 1){
        changeSelect.removeAttr("disabled");
        changeSelect.eq(0).val("08:00").css("background", "");
        changeSelect.eq(2).val("22:00").css("background", "");
        statusName.val("營業")
        } else {
        changeSelect.eq(0).val("00:00").css("background", "#F2F2F2");
        changeSelect.eq(2).val("00:00").css("background", "#F2F2F2");
        statusName.val("休息")
        }
    })
</script>
<script>
    let namePosts = <?php echo json_encode($name); ?>;
    let phonePosts = <?php echo json_encode($phone); ?>;

    // console.log(namePosts);
    // console.log(phonePosts);

    const store_name = document.form.store_name; // DOM element
    const city = document.form.city; // DOM element
    const address = document.form.address; // DOM element
    const phone = document.form.phone; // DOM element

    const store_name_msg = store_name.closest('.mb-3').querySelector('.form-text');
    const city_msg = city.closest('.mb-3').querySelector('.form-text');
    const address_msg = address.closest('.mb-3').querySelector('.form-text');
    const phone_msg = phone.closest('.mb-3').querySelector('.form-text');

    function checkForm(){
    let isPass = true; // 有沒有通過檢查

    store_name_msg.innerText = '';  // 清空訊息
    city_msg.innerText = '';  // 清空訊息
    address_msg.innerText = '';  // 清空訊息
    phone_msg.innerText = '';  // 清空訊息

    // TODO: 表單資料送出之前, 要做格式檢查

    if( store_name.value == "" || store_name.value.length < 2 || ! (store_name.value).includes('店') ){
        isPass = false;
        store_name_msg.innerText = '請填寫正確的門市名稱'
    } else if(namePosts.includes(store_name.value)) {
        isPass = false;
        store_name_msg.innerText = '門市名稱已存在'
    }
    if( city.value == "" || city.value.length < 2 || ! city.value.includes('市') ){
        isPass = false;
        city_msg.innerText = '請填寫正確的縣市名稱'
    }
    if( address.value == "" || address.value.length < 4 || ! address.value.includes('號') ){
        isPass = false;
        address_msg.innerText = '請填寫正確的地址'
    }

    const phone_re = /\d{2}-\d{3}-\d{4}$/; // new RegExp()
    if(phone.value || phone.value == ""){
        // 如果不是空字串就檢查格式
        if( ! phone_re.test(phone.value) ){
            isPass = false;
            phone_msg.innerText = '請輸入正確的電話號碼';
        }else if(phonePosts.includes(phone.value)) {
            isPass = false;
            phone_msg.innerText = '電話號碼已存在';
        }
    }
    }
    </script>