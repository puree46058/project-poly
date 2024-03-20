<?php
  session_start();
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
    //require 'template/front/header.php';
    require 'template/front/header.php';
  } else {
    echo "<script>";
    echo "window.history.back();";
    echo "</script>";
  }
?>
    <div class="bbcolor w3-content">
      <center><img src="img/logo-box.png" width="100%;" height="150px;" style="overflow: ;">
      <div class="reg-text">
        <div class="little-reg">
            <font class="font-kanit"><b>Login เข้าสู่ระบบ</b></font>
        </div>
        <div style="text-align:center;">
          <form action="checklogin.php" method="post">
          <font class="font-kanit" style="padding-right:285px;">ชื่อผู้ใช้:<font color="red">*</font> </font><br><input type="text" name="username" maxlength="30" size="30" required><br><br>
          <font class="font-kanit" style="padding-right:270px;">รหัสผ่าน:<font color="red">*</font> </font><br><input type="password" name="password" maxlength="30" size="30" required><br><br>
          
          <font color="red" class="font-kanit" style="font-size:15px;padding-left:270px;">* ฟิลต์ที่จำเป็น</font>
          <br><br><br>
          <input type="submit" value="เข้าสู่ระบบ" class="button-ok" name="submit">
        </div>
        </form>
      </div>
    </div>
    <!-- <img class="dress-card-img-top" src="img/w1.jpg" alt=""> -->
<?php
  require 'template/front/footer.php';
?>
