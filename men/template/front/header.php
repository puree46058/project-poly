<html>
  <head>
    <meta charset="UTF-8">
    <title>Home Sky T-shirt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,300;1,300;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <!-- Logo title website -->
    <link rel = "icon" href ="img/logo.png" type = "image/x-icon">
    <!-- -->
    <style>

      .show-img:hover {
        opacity:0.5;
      }
      
      .carousel {
        margin-bottom: 0;
        padding: 0 40px 30px 40px;
      }
      /* Reposition the controls slightly */
      .carousel-control {
        left: 50px;
      }
      .carousel-control.right {
        right: -14px;
      }
      /* Changes the position of the indicators */
      .carousel-indicators {
        right: 50%;
        top: auto;
        bottom: 0px;
        margin-right: -19px;
      }
      /* Changes the colour of the indicators */
      .carousel-indicators li {
        background: #c0c0c0;
      }
      .carousel-indicators .active {
      background: #333333;
      }

      * {box-sizing: border-box;}

      .img-zoom-container {
        position: relative;
        display: flex;
      }
      .img-zoom-lens {
        position: absolute;
        border: 1px solid #d4d4d4;
        width: 210px;
        height: 210px;
      }
      .img-zoom-result {
        border: 1px solid #d4d4d4;
        width: 550px;
        height: 500px;
        /*position: absolute; /* อันเดิม
        left:460px;
        top:-20px;*/
        position: fixed;
        left:970px;
        top:110px;
        z-index:999;
      }

      .imgshowsize {
        position: relative;
        bottom: -90px;
        left: -150px;
      }

      .text-line-hight {
        line-height: 30px;
      }

      .pagination {
        display: inline-block;
        position: relative;
        left: -235px;
      }

      .pagination a {
        color: black;
        float: left;
        padding: 8px 8px;
        text-decoration: none;
        position: relative;
        top: 20px;
        left: 450px;
      }

      .pagination a:hover {
        background-color: #ddd;
      }

      .button-ok {
        width: 100%;
        height: 45px;
        background-color: #252424;
        color: #FCEC7B;
        font-size: 18px;
        font-family: 'Kanit', sans-serif;
      }

      .code-order {
        text-align: center;
        margin: 5px;
        color: #6B6B6A;
        font-family: 'Roboto', sans-serif;
      }

      a.addcart:hover {
        background-color: #2FAC40;
        color: #F9FBD0;
      }
      .addcart {
        text-align: center;
        margin: 10px;
        width: 120px;
        height: 30px;
        color: #F8F9F4;
        padding: 3px;
        left: 0px;
        border-radius: 5px;
        background-color: #0B801A;
        font-family: 'Karla', sans-serif;
        border: 2px solid #108437;
        display: inline-block;
        text-decoration: none;
        /*box-shadow: 0 1px 5px 1px rgba(255, 255, 0, 0.4);*/
        position: relative;
      }
      .bbcolor {
        /*background-color: #FFFFF7;*/
        height: 100%;
        width: 100%;
        padding-top:22px;
        float:inherit;
      }

      .setmenu-top {
        position: relative;
        color: white;
        top: 30px;
        left: 70px;
      }

      a.dropbtn {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }

      .dropdown {
        display: inline-block;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
      }

      .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
      }

      .dropdown-content .dropdown-order a:hover {background-color: #f1f1f1;}

      .dropdown-order {
        margin-left: 150px;
        top:2px;
        min-width: 150px;
        position: absolute;
        display: none;
        background-color: #f9f9f9;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      }

      .dropdown-order a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
      }

      .dropdown-content:hover .dropdown-order {
        display: block;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }

      .menutop-right {
        float: right;
        color: white;
        display: block;
        position: relative;
        top: -45px;
        font-family: 'Bai Jamjuree', sans-serif;
      }

      .icon-menutop-right {
        position: relative;
        right: 5px;
        margin-top: -4px;
        height: 12px;
        width: 12px;
      }

      .font-kanit {
        font-family: 'Kanit', sans-serif;
      }

      .font-prompt {
        font-family: 'Prompt', sans-serif;
      }

      .little-reg {
        text-align: center;
        font-size: 33px;
        font-family: arial;
        padding-bottom:30px;
      }

      .reg-text {
        text-align: left;
        font-size: 20px;
        font-family: arial;
        margin: auto auto;
        padding: 20px;
        position: relative;
        left: 0px;
        background: #FAFAF8;
        box-shadow: 1px 2px 2px 5px #F0F0E8;
      }

      .reg-birth {
        text-align: left;
        font-size: 20px;
        font-family: arial;
        position: relative;
      }

      .right-reg {
        text-align: left;
        top: -67px;
        margin-left: 540px;
        /*right: 90px;*/
        position: relative;
      }
      .right-reg-2 {
        text-align: left;
        top: -69px;
        margin-left: 540px;
        /*right: 90px;*/
        position: relative;
      }

      .reg-address {
        text-align: left;
        font-size: 20px;
        font-family: arial;
        position: relative;
      }

      .dress-card-img-top {
        width:50%;
        border-radius: 5px 5px 0 0;
        margin: auto auto;
        display: block;
      }

      .dress-card-body {
        padding:1rem;
        background: #fff;
        border-radius: 0 0 5px 5px;
        text-align: center;
      }

      .dress-card-title {
        line-height: 0.5rem;
        text-align: center;
      }

      .dress-card-crossed {
        text-decoration: line-through;
      }

      .dress-card-price {
        font-size: 1rem;
        font-weight: bold;
      }

      .dress-card-off {
        color: #E06C9F;
      }

      .dress-card-para {
        margin-bottom: 0.2rem;
        font-size: 1.0rem;
        margin-bottom: 0rem;
      }

      .dress-card {
        /*border-radius: 14px;*/
        float: left;
      }

      .dress-card-heart {
        font-size: 1em;
        color: #DB2763;
        margin: 4.5px;
        position: absolute;
        left: 4px;
        top: 0px;

      }

      .surprise-bubble {
        position: absolute;
        bottom: 12rem;
        right: 2rem;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        background: #fff;
        padding: 1rem;
        color: white;
        -webkit-transition: all 0.55s cubic-bezier(0.645, 0.045, 0.355, 1);
        transition: all 0.55s cubic-bezier(0.645, 0.045, 0.355, 1);
      }

      .surprise-bubble a {
        font-size: 0.65em;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        font-family: arial;
        text-decoration: none;
        position: absolute;
        top: 9px;
        left: 20px;
        opacity: 0;
        -webkit-transition-delay: 2s;
        /* Safari */
        transition-delay: 2s;
        -webkit-transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
        transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
      }

      .surprise-bubble:hover {
        border-radius: 999rem;
        padding: 1rem;
        width: 26%;
        height: 30px;
        background: #DB2763;
        color: white;
        -webkit-transition: all 0.55s cubic-bezier(0.645, 0.045, 0.355, 1);
        transition: all 0.55s cubic-bezier(0.645, 0.045, 0.355, 1);
      }

      .surprise-bubble:hover a {
        opacity: 1;
        -webkit-transition-delay: 2s;
        /* Safari */
        transition-delay: 2s;
        -webkit-transition: opacity 1s cubic-bezier(0.645, 0.045, 0.355, 1);
        transition: opacity 1s cubic-bezier(0.645, 0.045, 0.355, 1);
      }

      .card-button {
        text-align: center;
        text-transform: uppercase;
        font-size: 15px;
        padding: 9px;
      }
      .card-button a {
        text-decoration: none;
      }

      .card-button-inner {
        padding: 10px;
        border-radius: 3px;
      }

      .bag-button {
        background: #351168;
        color: #F6F09D;
      }

      .bag-button :hover{
        background: #e299b9;
      }

      .block-sex {
        width: 180px;
        padding: 8px;
        text-align: center;
        color: #190D01;
        /*border: 3px solid gray;*/
        /*background: lightyellow;*/
        background: #DDDF6A;
        margin: auto;
        font-size: 20px;
        display: inline-block;
        text-decoration: none;
      }

      a.block-sex:hover {
        background: #FCF6B3;
        color: #271302;
      }

      .banner {
        background-color: #171717; /* #171717*/
        width:100wh;
        color:#F6F09D;
        height:80px;
        /*position: relative;*/
      }

      .mySlides {
        display:none;
        height:350px;
      }
      .w3-left, .w3-right, .w3-badge {cursor:pointer;}
      .w3-badge {height:13px;width:13px;padding:0;}

      .column {
        float: left;
        width: 300px;
        height: 470px;
        margin: 10px;
        padding: 15px;
        /*border: 1px solid;*/
        /*box-shadow: 1px 1px 1px 1px #888888;*/
      }

      /* Clear floats after the columns */
      .rowsor:after {
        content: "";
        display: table;
        clear: both;
      }

      .imgbox-shop-detail {
        width: 550px;
        height: 600px;
        margin-left: -150px;
      }

      .imgbox-shop {
        width: 268px;
        height: 300px;
      }
      .imgbox-shop img {
        width: 100%;
        height: auto;
      }
      .imgbox-shop:hover {
        opacity:0.5;
        filter:alpha(opacity=55)
      }

      .imgbox-shop-choi {
        background: green;
        width: 150px;
        height: 50px;
        display: block;
        text-align: center;
        padding: 15px;
        margin: 60px;
        text-decoration: none;
        position: absolute;
        opacity:0.0;
        filter:alpha(opacity=0)
      }

      .imgbox-shop-choi:hover {
        background: green;
        width: 150px;
        height: 50px;
        display: block;
        text-align: center;
        padding: 15px;
        margin: 60px;
        text-decoration: none;
        position: absolute;
        opacity:0.5;
        filter:alpha(opacity=100)
      }

      .text-nameshop-detail {
        font-family: "Comic Sans MS", cursive, sans-serif;
        left: 420px;
        top: -620px;
        font-size: 22px;
        position: relative;
      }

      .text-nameshop {
        font-family: "Comic Sans MS", cursive, sans-serif;
        text-align: center;
      }

      .price-shop-detail {
        color: #37332C;
        font-size:25px;
        top: -630px;
        margin-left:420px;
        position: relative;
        font-family: Lucida Sans;
      }

      .price-shop {
        text-align: center;
        color: #37332C;
        font-size:16px;
        font-family: Comic Sans MS;
      }

      .topnav {
        overflow: hidden;
        top: 18;
        margin-left: 300px;
        position: relative;
      }

      .topnav a {
        float: left;
        color: #fff;
        padding: 25px 18px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
      }

      .topnav a:hover {
        /*background-color: #4D4D4C;*/
        color: #F9F7C4;
      }

      .topnav .icon {
        display: none;
      }

      .footer-bottom {
        width:100vw;
        height:180px;
        bottom: -190px;
        position: relative;
        background-color: #171717;
      }

      .footer-copyright {
        padding: 15px;
        color: white;
        font-family: Comic Sans MS;
        font-size: 17px;
        top: 35;
        position: relative;
        text-align: center;
      }
      .icon {
        top: 80px;
      }

      .img-icons {
        width: 60px;
        height: 60px;
        text-align: center;
        margin: 15px;
        top: 40px;
        position: relative;
      }

      .logo {
        float: left;
        text-decoration: none;
        left: 25px;
        position: relative;
        top: 10px;
        padding: 0px;
        margin: 0px;
        display: block;
        height: 55px;
        width: 240px;
      }

      .size-detail {
        margin-left: 495px;
        top: -682px;
        position: relative;
        font-size: 20px;
      }

      .showsize {
        top: -200px;
        margin-left: -345px;
        position: relative;
      }

      @media screen and (max-width:1400px) {
        .footer-bottom {
          position:relative;
          float: left;
          top: 300px;
        }
      }
      /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
      @media screen and (max-width:620px) {
        .column {
          width: 100%;
        }
        .imgbox-shop {
          width: 100%;
        }
        .topnav a:not(:last-child) {display: none;}
        .topnav a.icon {
          float: right;
          display: block;
        }
        .topnav.responsive {position: relative;top: 75px;}
        .topnav.responsive .icon {
          position: absolute;
          right: 0;
          top: 0;
          margin-left: 0;
        }
        .topnav.responsive a {
          float: none;
          display: block;
          text-align: left;
          background-color: #424242;
        }
        .menutop-right {
          right: 0px;
          position: absolute;
        }

        .right-reg {
          position:relative;
          float:left;
          top: 22px;
          left: 50px;
          margin-left: -50px;
        }
        .reg-birth {
          position:relative;
          float:left;
          top: 113px;
          left: 50px;
          margin-left: -350px;
        }
        .right-reg-2 {
          position:relative;
          float:left;
          top: 138px;
          left: 50px;
          margin-left: -50px;
        }
        .reg-address {
          position:relative;
          float: left;
          top: 165px;
          left: 50px;
          margin-left: -50px;
        }
        .reg-text {
          height:880px;
        }
        .footer-bottom {
          position:relative;
          float: left;
          top: 250px;
        }
        .button-ok {
          position: relative;
          width: 100%;
          top: 150px;
        }
      }
    </style>
  </head>
  <body>
    <div class="banner">
      <!-- <div class="w3-container">
       <h1>Street Clothes</h1>
      </div> -->
      <a href="index.php" class="logo"><img src="img/logo.png"></a>
      <!-- <div class="topnav" id="myTopnav"> -->
      <div class="setmenu-top">
        <a href="index.php" style="text-decoration: none;">หน้าแรก</a>
        <div class="dropdown">
          <a href="#" class="dropbtn">สินค้า</a>
          <div class="dropdown-content">
            <a href="#">เสื้อยืด</a>
            <div class="dropdown-order">
            <a href="pro-t-shirt.php?page=1">
              <?php
                include('connect.php');
        
                $sql = "SELECT*FROM pro_category WHERE pro_category_id='1'";
                $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                $row = mysqli_fetch_array($result);

                echo $row['pro_category_name'];
              ?>
              </a>
              <!--<a href="pro-v-t-shirt.php?page=1">
              <php 
                  include('connect.php');

                  $sql = "SELECT*FROM pro_category WHERE pro_category_id='2'";
                  $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
                  $row = mysqli_fetch_array($result);

                  echo $row['pro_category_name'];
              ?>
              </a>-->
            </div>
            <!-- <a href="#">อุปกรณ์เสริม</a> -->
          </div>
        </div>
      </div>
        <!-- <ul>
        <li><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="#order" class="dropbtn">Order</a>
          <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
          </div>
        </li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
        </ul> -->
        <div class="menutop-right"><a href="login.php" style="text-decoration: none; margin-left:20px;margin-right:20px;"><img src="icon/icon-login.png" class="icon-menutop-right"></img>ล็อกอิน</a></div>
        <div class="menutop-right"><a href="reg_form.php" style="text-decoration: none;margin-right:20px;"><img src="icon/icon-register.png" class="icon-menutop-right"></img>สมัครสมาชิก</a></div>
        <!-- <a href="javascript:void(0);" class="icon" onclick="myFunction()"> -->
          <!-- <i class="fa-bars"></i> -->
          <!-- <button class="w3-button w3-xlarge">&#9776;</button>
        </a> -->
      <!-- </div> -->
    </div>
