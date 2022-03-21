<?php
require __DIR__ . '/layout/connect_db.php';
  $title = '新增會員';
  $pagename = 'userAdd';
//   $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM users WHERE id=$id";
// $row = $pdo->query($sql)->fetch();
// if(empty($row)){
//     header('Location: user_list-bd.php'); // 找不到資炓轉向列表頁
//     exit;
// }
?>

<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>

<style>



.fa-magnifying-glass{
  color: #aaa;
  
}

.star{
    color: red;
}
.userNav{
  font-size: large;
  font-weight: bolder;
  box-sizing: border-box;
}
.userMain{
  background-color: #fff;
}
input{
    display: inline-block;
    border-radius: 10px;   
    border-color: rgba(118, 118, 118, 0.3); 
}
/* .editInput{
    
    border-radius: 10px;
    border-color: rgba(118, 118, 118, 0.3);
}
.editNo{
    border-radius: 10px;
} */
.btn{
    background: #aaa;
    width: 60%;
    font-weight: bolder;
    border-radius: 10px;
}
.iconBox{
    display: inline-block;
    width: 20px;
    
}
.form-text{
    display: inline-block;
    color:red;
    vertical-align:bottom;
    font-weight:bolder ;
}
td{
    vertical-align:middle;
    height: 80px;
}
th{
    vertical-align:middle;  
    
}

  </style>



<main class="admin-main px-5 py-5">
            <!-- 請在此處撰寫程式     -->
            
              <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <div class="row userNav">
                      <div class="col-2 userNavlift">會員新增</div>
                      <div class="col-7"></div> 
                      <div class="col-3">
                        <i class="star">*</i>
                        為必填資料
                      </div>
                      
                      
                  </div>

                </div>
                <div class="col-1"></div>
              </div>
            
            <br>
            
            <div class="row">
    <div class="col-1"></div>
    <div class="col-10 userMain">
        
          
       
        <table class="table" id="aaa">  
        <!-- <thead>
     <tr>
      <th scope="col" class="col-1"></th>
      <th scope="col" class="col-2"></th>
      <th scope="col" class="col-9"></th>
     
    </tr>
    </thead> -->
    <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
    <tbody >
  
      <!-- <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2">
              
              <div class="iconBox"><i class="star">*</i></div>
              <label for="user_id"> 會員編號</label></th>
             
          <td class="col-6">
              <input type="text" id="user_id" name="user_id"class="editNo" required>
              <div class="form-text"></div>
          </td>
      </tr> -->
     
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="star">*</i></div>
          <label for="user_name">會員姓名</label></th>
          <td class="col-6">
              <input type="text" id="user_name"name="user_name" maxlength="50" required>
              <div class="form-text"></div>  
            </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2">
              <div class="iconBox"><i class="star">*</i></div>
              <label for="user_birth">會員生日</label></th>
              
          <td class="col-6">
              <input type="date" id="user_birth" name="user_birth"   required>
              <div class="form-text"></div>  
          </td>

      <tr class="tbbox">
          
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="star">*</i></div>
          <label for="user_phone">會員電話</label></th>
          <td class="col-6">
              <input type="text" id="user_phone" name="user_phone" maxlength="10"  required>
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="star">*</i></div>
          <label for="user_mail">會員信箱</label></th>
          <td class="col-6">
              <input type="email" id="user_mail" name="user_mail" maxlength="255" required>
              
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"></div>
          <label for="user_mail2">會員備用信箱</label></th>
          <td class="col-6">
              <input type="email" id="user_mail2" name="user_mail2"  maxlength="255">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="star">*</i> </div>
          <label for="user_address">會員地址1</label></th>
          <td class="col-6">
              <input type="text" id="user_address"name="user_address" maxlength="100" required>
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"></div>
          <label for="user_address_2">會員地址2</label></th>
          <td class="col-6">
              <input type="text" id="user_address_2" name="user_address_2" maxlength="100">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"></div>
          <label for="user_address_3">會員地址3</label></th>
          <td class="col-6">
              <input type="text" id="user_address_3"name="user_address_3" maxlength="100" >
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="star">*</i>  </div>
          <label for="user_password">會員密碼</label></th>
          <td class="col-6">
              <input type="text" id="user_password" name="user_password" maxlength="20" required>
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"></i></div>
          <label for="user_nick">會員暱稱</label> </th>
          <td class="col-6">
              <input type="text" id="user_nick" name="user_nick" maxlength="20" >
              <div class="form-text"></div>  
          </td>
      </tr>
      
  </tbody>
         
        </table>
        <br>
        <div class="row">
            <div class="col-4"></div>
                <div class="col-2">
                    <button type="button" onclick="gobake()" class="btn ">取消</button> 
                </div>
             <div class="col-2">
                <button type="submit" class="btn">新增</button> 
            </div>
            <div class="col-4"></div>
        </div>
        </form>
        <br>
    </div>
    
    <div class="col-1"></div>
  </div>
  <!-- </div> container--> 
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script>

      

    const user_phone = document.form1.user_phone; // DOM element
    const user_phone_msg = user_phone.closest('.tbbox').querySelector('.form-text');
  

    const user_name = document.form1.user_name;
    const user_name_msg = user_name.closest('.tbbox').querySelector('.form-text');

    const user_birth = document.form1.user_birth;
    const user_birth_msg = user_birth.closest('.tbbox').querySelector('.form-text');

    const user_mail = document.form1.user_mail;
    const user_mail_msg = user_mail.closest('.tbbox').querySelector('.form-text');

    const user_address = document.form1.user_address;
    const user_address_msg = user_address.closest('.tbbox').querySelector('.form-text');

    const user_password = document.form1.user_password;
    const user_password_msg = user_password.closest('.tbbox').querySelector('.form-text');

    function checkForm(){
        let isPass = true; // 有沒有通過檢查


        // TODO: 表單資料送出之前, 要做格式檢查

        if(user_name.value == ''){
            isPass = false;
            user_name_msg.innerText = '請填寫姓名';
            location.href = '#';
        }else{
            user_name_msg.innerText ="";
        }
        
        if(user_birth.value == ''){
            isPass = false;
            user_birth_msg.innerText = '請輸入生日';
            location.href = '#';
        }else{
            user_birth_msg.innerText ="";
        }

        const user_phone_re = /^09[0-9]{8}$/; 
        if(user_phone.value==''){
            isPass = false;
            user_phone_msg.innerText = '請輸入手機號碼';
            location.href = '#';
            
        }else{
                user_phone_msg.innerText ="";
        }

        if(user_phone.value){
            if(! user_phone_re.test(user_phone.value)){
                isPass = false;
                user_phone_msg.innerText = '請輸入正確的手機號碼格式 ';
                location.href = '#';
            }else{
                user_phone_msg.innerText ="";
        }
        }
        
        if(user_mail.value==''){
            isPass = false;
            user_mail_msg.innerText = '請輸入電子信箱';
            location.href = '#'; 
        }else{
                user_mail_msg.innerText ="";
        }
       
        
        const user_mail_re = /[\w-]+@([\w-]+\.)+[\w-]+/;; 
        if(user_mail.value){
            if(! user_mail_re.test(user_mail.value)){
                isPass = false;
                user_mail_msg.innerText = '請輸入正確的電子信箱格式 ';
                location.href = '#';
            }else{
                user_mail_msg.innerText ="";
        }
        }
        
        if(user_address.value==''){
            isPass = false;
            user_address_msg.innerText = '請輸入地址';
            location.href = '#';
            
        }else{ 
            user_address_msg.innerText ="";
        }
        
        if(user_password.value==''){
            isPass = false;
            user_password_msg.innerText = '請輸入密碼';
            location.href = '#';
            
        }else{
            user_password_msg.innerText ="";
        }
        
        const user_password_re =/^(?=.*[0-9\!@#\$%\^&amp;\*])(?=.*[a-zA-Z]).{6,20}$/; 
        if(user_password.value){
            if(! user_password_re.test(user_password.value)){
                isPass = false;
                user_password_msg.innerText = '密碼需6~20碼，至少由英文數字組成';
                location.href = '#';
            }else{
            user_password_msg.innerText ="";
        }
        }

        if(isPass){
            const fd = new FormData(document.form1);

            fetch('user_add-bd-api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('新增成功');
                    location.href = 'user_list-bd.php';
                } else {
                    alert('新增失敗');
                }

            })


        }

    }
    

      
      


   
    
  </script>
    
</main>

    <?php include __DIR__. './layout/scripts.php';?>
    <?php include __DIR__. './layout//html-foot.php';?>