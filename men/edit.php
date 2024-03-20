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
<?php
  include('connect.php');
  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $nphone = $_SESSION['nphone'];
  $waddress = $_SESSION['waddress'];

  $sql = "SELECT*FROM user WHERE id=$id";
  $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
  $row = mysqli_fetch_array($result);
  extract($row);

  $username = $row['username'];
  $fname = $row['fname'];
  $lname = $row['lname'];
  $nphone = $row['nphone'];
  $waddress = $row['waddress'];
?>
<form method="POST" action="process.php" enctype="multipart/form-data">
<table class="table-manager" border="0" width="70%" height="40%" style="font-family: 'Karla', sans-serif;font-size:18px;">
  <tr>
    <td colspan="3" style="padding-top:25px"><b><font size="6" class="font-kanit">แก้ไขข้อมูลส่วนตัว</font></b></td>
  </tr>
  <tr>
    <td height="30px"></td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      ชื่อผู้ใช้: <input type="text" name="username" maxlength="30" size="30" value="<?php echo $row['username']; ?>">
    </td>
  </tr>
  <tr>
    <td width="45%">
      ชื่อ: <input type="text" name="fname" maxlength="30" size="30" value="<?php echo $row['fname']; ?>">
    </td>
    <td>
      นามสกุล: <input type="text" name="lname" maxlength="30" size="30" value="<?php echo $row['lname']; ?>">
    </td>
  </tr>
  <tr>
    <td colspan="2">
      เบอร์: <input type="text" name="nphone" maxlength="10" size="30" value="<?php echo $row['nphone']; ?>">
    </td>
  </tr>
  <tr>
    <td colspan="2">
      ที่อยู่: <input type="text" name="waddress"  size="30" value="<?php echo $row['waddress']; ?>">
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="submit" name="Submit" value="บันทึก" class="savebutton">
      <input type="reset" name="cancel" value="ยกเลิก" class="rebutton">
    </td>
  </tr>
  <tr>
    <td colspan="3">
      <div class="backedit">
      <a href="account.php" style="text-decoration:none;"><< ย้อนกลับ</a>
      </div>
    </td>
  </tr>
</table>
</form>
<?php
  require 'template/front/footer.php';
?>
