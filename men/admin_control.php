<?php
  session_start();
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
    //require 'template/front/header.php';
    header("Location: login.php");
  } else {
    require 'template/back/header.php';
    if($_SESSION['userlevel'] != 2) {
      echo "<script>";
      echo "window.history.back();";
      echo "</script>";
    } 
  }
?>
<div class="container w3-center" style="padding-top:22px;">
  <h2><font class="font-kanit"><b>เมนูแอดมิน</b></font>
</div>
<div class="container w3-center" style="padding-top:50px;">
  <a href="addproduct.php" style="text-decoration:none;">
    <div class="admin-box icon-admin-box">
      <div class="">
        <img src="img/admin-icons/admin-box-addpro.png" width="60px" height="60px"></img>
      </div>
      เพิ่มสินค้า
    </div>
  </a>
  <a href="manage_product.php?page=1" style="text-decoration:none;">
    <div class="admin-box icon-admin-box">
      <div class="">
        <img src="img/admin-icons/admin-box-editdel.png" width="60px" height="60px"></img>
      </div>
      แก้ไข/ลบ สินค้า
    </div>
  </a>
  <a href="check_order.php?page=1" style="text-decoration:none;">
    <div class="admin-box icon-admin-box">
      <div class="">
        <img src="img/admin-icons/admin-box-checkpay.png" width="60px" height="60px"></img>
      </div>
      ตรวจสอบการแจ้งชำระ(โอน)
    </div>
  </a>
  <a href="status_order.php?page=1" style="text-decoration:none;">
    <div class="admin-box icon-admin-box">
      <div class="">
        <img src="img/admin-icons/admin-box-managestatus.png" width="60px" height="60px"></img>
      </div>
      จัดการสถานะจัดส่ง
    </div>
  </a>
</div>
<?php
  require 'template/front/footer.php';
?>
