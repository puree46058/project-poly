<?php
  session_start();
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
    //require 'template/front/header.php';
    header("Location: login.php");
  } else {
    require 'template/back/header.php';
  }
?>
<div class="w3-content w3-center" style="top:100px;position:relative;">
  <h2><font class="font-kanit"><b>เลือกช่องทางการชำระ</b></font></h2>
</div>
<div class="w3-content w3-center">
  <a href="cash-delivery.php" class="box-shiping-payments"><img src="icon/icon-delivery.png" width="30px" height="35px" style="padding-bottom:5px;"><b> เก็บเงินปลายทาง</b></a>
  <a href="pay_notification.php" class="box-shiping-payments"><img src="icon/icon-pay.png" width="30px" height="35px" style="padding-bottom:5px;"><b> โอนชำระ</b></a>
</div>
<div style="height:30%;"></div>
<?php
  require 'template/front/footer.php';
?>
