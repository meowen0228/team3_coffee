<?php
  $title = '後台首頁';
  $pagename = 'home';
?>
<style>
        .title {
            position: absolute;
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 22px;
            line-height: 130%;
        }

        .card {
            position: absolute;
            background: #FFFFFF;
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 130%;
        }

        .commodityImg {
            max-width: 60px;
        }

        /* .newBotton,
        .deleteBotton {
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.25);
            border-radius: 20px;
        } */
    </style>
</style>
<?php include __DIR__. './layout/html-head.php';?>
<?php include __DIR__. './layout/header.php';?>
<?php include __DIR__. './layout/aside.php';?>
<?php include __DIR__. './layout/drink_menu_body.php';?>
</main>

    <?php include __DIR__. './layout/scripts.php';?>
    <?php include __DIR__. './layout//html-foot.php';?>