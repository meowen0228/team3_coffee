<?php
  require __DIR__ . '/layout/coffee_db.php';
  $title = '提問回復';
  $pagename = 'askAns';
  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $sql = sprintf(
    "SELECT
    user_name,
    user_ask.id as usas_id,
    ans,
    main,
    ask,
    user_ask.CREATEd_at as uask_CA
    FROM users
    right join user_ask on user_ask.fk_user_id = users.id 
    where user_ask.id =$id"); 
    $row = $pdo->query($sql)->fetch();

    if(empty($row)){
        header('Location: user_ask-bd-all.php'); // 找不到資炓轉向列表頁
        exit;
    }  
?>

<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>

<style>

::placeholder{
    color: #555;
    font-weight: bold;
}

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

.ansInput{
    border:3px black solid ;
    
}
.ansNo{
    border:3px #555 solid ;
}
.btn{
    background: #aaa;
    width: 60%;
    font-weight: bolder;
    border-radius: 10px;
    margin: auto;
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
.ask{
    margin: 30px 0;
    
}
.askArea{
    margin: 15px 0;
    
}


hr{
    margin-top: 30px; 
}
.askTi{
    text-align: center;
    font-weight: bolder;
}
.btnBox{
    margin: auto;
}
textarea {
    display: block;
    margin-left: auto;
    margin-right: auto;
    resize: none;
    border-radius: 10px;
}

  </style>



<main class="admin-main px-5 py-5">
            <!-- 請在此處撰寫程式     -->
            
              <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                  <div class="row userNav">
                      <div class="col-2 userNavlift">問題回復</div>
                      <div class="col-7"></div> 
                      <div class="col-3">
               
                      </div>
                      
                      
                  </div>

                </div>
                <div class="col-1"></div>
              </div>
            
            <br>
            
            <div class="row">
    <div class="col-1"></div>
    <div class="col-10 userMain">
            <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
        <div class="row ask">

            <div class="col-3"></div>
            <div class="col-3 askTi ta"> 案件編號</div>
            <div class="col-3 askMa ta" name="id"><?= $row['usas_id'] ?></div>
            <div class="col-3"></div>
        </div>
        <hr>

        <div class="row ask">

            <div class="col-3"></div>
            <div class="col-3 askTi ta"> 會員姓名</div>
            <div class="col-3 askMa ta"><?= $row['user_name'] ?></div>
            <div class="col-3"></div>
        </div>
        <hr>

        <div class="row ask">

            <div class="col-3"></div>
            <div class="col-3 askTi ta"> 提問日期</div>
            <div class="col-3 askMa ta"><?= $row['uask_CA'] ?></div>
            <div class="col-3"></div>
        </div>
        <hr>

        <div class="row ask">

            <div class="col-3"></div>
            <div class="col-3 askTi ta"> 主旨</div>
            <div class="col-3 askMa ta"><?= $row['main'] ?></div>
            <div class="col-3"></div>
        </div>
        <hr>

        <div class="row askArea">

            <div class="col-3"></div>
            <div class="col-3 askTi ta"> 問題內容</div>
            <div class="col-3 askMa ta"></div>
            <div class="col-3"></div>
        </div>
        
        <div class="row askArea">

            <div class="col-3"></div>
            <div class="col-6 ">
            <textarea name="ask" id="ask" class="ansNo"  cols="45" rows="4"  readonly="readonly"><?= $row['ask']?></textarea>
             </div>
            <div class="col-3"></div>
        </div>
        <hr>

        <div class="row askArea">

            <div class="col-3"></div>
            <div class="col-3 askTi ta">客服答覆</div>
            <div class="col-3 askMa ta"></div>
            <div class="col-3"></div>
           
        </div>
        
        <div class="row askArea">

            <div class="col-3"></div>
            <div class="col-6 ">
            <textarea name="ans" id="ans" class="ansInput" readonly="readonly" cols="45" rows="4" ><?= $row['ans'] ?></textarea>
             </div>
            <div class="col-3"></div>
        </div>
        <input type="hidden" name="id" id="id" value="<?= $row['usas_id'] ?>">
        <hr>

      
       
       
        <br>
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                    <center><button type="button" class="btn" onclick="goback()">返回</button> </center>
                </div>
            
            <div class="col-4"></div>
        </div>
        <br>
        </div>
    </from>
    <div class="col-1"></div> 
  </div>
  <!-- </div> container--> 
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        function goback(){
                window.history.back();
            }

    
    </script>
    
</main>

    <?php include __DIR__. './layout/scripts.php';?>
    <?php include __DIR__. './layout//html-foot.php';?>