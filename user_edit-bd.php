<?php
require __DIR__ . '/layout/coffee_db.php';
  $title = '會員編輯';
  $pagename = 'userEdit';
  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM users WHERE id=$id";
// $t_sql = "SELECT COUNT(*) FROM users";


$row = $pdo->query($sql)->fetch();
if(empty($row)){
    header('Location: user_list-bd.php'); // 找不到資炓轉向列表頁
    exit;
}
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

.editInput{
    
    border-radius: 10px;
    border-color: rgba(118, 118, 118, 0.3);
}
.editNo{
    border-radius: 10px;
}
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
td{
    vertical-align:middle;
    height: 60px;
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
                      <div class="col-2 userNavlift">會員編輯</div>
                      <div class="col-7"></div> 
                      <div class="col-3">
                        <i class="star">*</i>
                        為不可修改資料
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
  
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2">
              
              <div class="iconBox"><i class="star">*</i></div>
              <label for="user_id"> 會員編號</label></th>
             
          <td class="col-6">
              <input type="text" id="user_id" name="user_id"class="editNo" readonly="readonly" value="<?= $row['id'] ?>">
              <div class="form-text"></div>
          </td>
      </tr>
     
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_name">會員姓名</label></th>
          <td class="col-6">
              <input type="text" id="user_name"name="user_name" class="editInput"  readonly="readonly" value="<?= htmlentities($row['user_name']) ?>">
              <div class="form-text"></div>  
            </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2">
              <div class="iconBox"><i class="star">*</i></div>
              <label for="user_birth">會員生日</label></th>
              
          <td class="col-6">
              <input type="text" id="user_birth" name="user_birth" class="editNo" readonly="readonly" value="<?= $row['user_birth'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="star">*</i></div>
          <label for="CREATEd_at">建立時間</label></th>
          <td class="col-6">
              <input type="text" id="CREATEd_at" name="CREATEd_at" class="editNo" readonly="readonly"  value="<?= $row['CREATEd_at'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_phone">會員電話</label></th>
          <td class="col-6">
              <input type="text" id="user_phone" name="user_phone" class="editInput" readonly="readonly" value="<?= $row['user_phone'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="star">*</i></div>
          <label for="user_mail">會員信箱</label></th>
          <td class="col-6">
              <input type="email" id="user_mail" name="user_mail" class="editNo" readonly="readonly" size="25" value="<?= $row['user_mail'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_mail2">會員備用信箱</label></th>
          <td class="col-6">
              <input type="email" id="user_mail2" name="user_mail2" class="editInput" readonly="readonly" size="25" value="<?= $row['user_mail2'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_address">會員地址1</label></th>
          <td class="col-6">
              <input type="text" id="user_address"name="user_address" class="editInput" readonly="readonly" size="35" value="<?= $row['user_address'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_address_2">會員地址2</label></th>
          <td class="col-6">
              <input type="text" id="user_address_2" name="user_address_2"class="editInput" readonly="readonly" size="35" value="<?= $row['user_address_2'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_address_3">會員地址3</label></th>
          <td class="col-6">
              <input type="text" id="user_address_3"name="user_address_3" class="editInput" readonly="readonly" size="35" value="<?= $row['user_address_3'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_password">會員密碼</label></th>
          <td class="col-6">
              <input type="text" id="user_password" name="user_password"class="editInput" readonly="readonly"  value="<?= $row['user_password'] ?>">
              <div class="form-text"></div>  
          </td>
      </tr>
      <tr class="tbbox">
          <td class="col-4"></td>
          <th class="col-2"><div class="iconBox"><i class="fa-solid fa-lock "></i></div>
          <label for="user_nick">會員暱稱</label> </th>
          <td class="col-6">
              <input type="text" id="user_nick" name="user_nick"class="editInput" readonly="readonly" value="<?= $row['user_nick'] ?>">
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
                <button type="submit" class="btn">修改</button> 
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
      
    //   $(".fa-lock").click(function(){
          
    //       $(this).removeClass('fa-lock').addClass('fa-unlock');
              
    //         $(this).parent().nextAll().children("input").prop('disabled', false);
    //         $(this).parent().nextAll().children("input").css("border","2px black solid");
    //         $(this).parent().parent().css("background-color","#aaa")
    //     });
    //   $(".fa-unlock").click(function(){
          
    //       $(this).removeClass('fa-unlock').addClass('fa-lock');
              
    //         $(this).parent().nextAll().children("input").prop('disabled', false);
    //         $(this).parent().nextAll().children("input").css("border","2px black solid");
    //         $(this).parent().parent().css("background-color","#aaa")
    //     });

      $("#aaa").on("click",".fa-lock",function(){
        $(this).removeClass('fa-lock').addClass('fa-lock-open');
            
            $(this).parent().parent().nextAll().children("input").prop('readonly', false);
            $(this).parent().parent().nextAll().children("input").css("border","2px black solid");
            $(this).parent().parent().parent().css("background-color","#aaa")
            })

      $("#aaa").on("click",".fa-lock-open",function(){
        $(this).removeClass('fa-lock-open').addClass('fa-lock');
            
            $(this).parent().parent().nextAll().children("input").prop('readonly', true);
            $(this).parent().parent().nextAll().children("input").css("border-color", "rgba(118, 118, 118, 0.3)");
            $(this).parent().parent().parent().css("background-color","#fff")
            })
            function gobake(){
                window.history.back();
            }

            const user_phone = document.form1.user_phone; // DOM element
    const user_phone_msg = user_phone.closest('.tbbox').querySelector('.form-text');
  

    const user_name = document.form1.user_name;
    const user_name_msg = user_name.closest('.tbbox').querySelector('.form-text');

    function checkForm(){
        let isPass = true; // 有沒有通過檢查

        // user_name_msg.innerText = '';  // 清空訊息
        // user_phone_msg.innerText = '';  // 清空訊息

        // // TODO: 表單資料送出之前, 要做格式檢查

        // if(name.value.length<2){
        //     isPass = false;
        //     user_name.innerText = '請填寫正確的姓名'
        // }

        // const user_phone_re = /^09\d{8}$/; // new RegExp()
        // if(user_phone.value){
        //     // 如果不是空字串就檢查格式
        //     if(! user_phone_re.test(user_phone.value)){
        //         user_phone_msg.innerText = '請輸入正確的手機號碼';
        //         isPass = false;
        //     }
        // }

        if(isPass){
            const fd = new FormData(document.form1);

            fetch('user_edit-bd-api.php', {
                method: 'POST',
                body: fd
            }).then(r => r.json())
            .then(obj => {
                console.log(obj);
                if(obj.success){
                    alert('修改成功');
                    location.href = 'user_list-bd.php';
                } else {
                    alert('沒有修改');
                }

            })


        }


    }

      
      


   
    
  </script>
    
</main>

    <?php include __DIR__. './layout/scripts.php';?>
    <?php include __DIR__. './layout//html-foot.php';?>