<?php
require __DIR__ . '/connect_db.php';
$o_sql = "SELECT COUNT(1) FROM orders WHERE fk_condition_id IN ('1')";
$total_o = $pdo->query($o_sql)->fetch(PDO::FETCH_NUM)[0];

$u_sql = "SELECT COUNT(1) FROM user_ask WHERE ans IN ('')";
$total_u = $pdo->query($u_sql)->fetch(PDO::FETCH_NUM)[0];
?>
  <header class="admin-header d-flex shadow fixed-top row">
    <div class="col-1 admin-header">
        <a href="home_.php">
          <img src="./layout/icon/coffee_bean.png" alt="">
        </a>
    </div>
    <div class="col-10"></div>
   
          
    <div class="col-1 ">
      <i class="fa-solid fa-bell d-flex flex-column" >
      <div id="bell123"><?= $total_o+$total_u ?></div>
      </i>
      <div id="bell" >
        <a href="order_list.php" class="a_php">
        <div class="notify" onclick="od_no()">
          <div class="notify-1">尚有</div>
          <div class="sqlcon notify-1"><?= $total_o ?>筆</div>
          <div>訂單未出貨</div>
        </div>
        </a>
        <br>
        <a href="user_ask-bd-no.php" class="a_php">
        <div class="notify" onclick="ask_no()">
          <div class="notify-1">尚有</div>
          <div class="sqlcon notify-1"><?= $total_u ?>筆</div>
          <div>問題未回復</div>
        </div>
        </a>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
      <script>
   
        $(".fa-bell").click(function(event){
          $("#bell").css("display","block");
        })
        $("#bell").mouseleave(function(event){
          $("#bell").css("display","none");
        })
      
      </script>
    </div>
  </header>
