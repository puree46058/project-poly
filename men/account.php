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
<table class="table-manager" border="0" width="70%" height="40%">
  <tr>
    <td colspan="3" style="padding-top:25px"><b><font size="6" class="font-kanit">ข้อมูลส่วนตัว</font></b></td>
  </tr>
  <tr>
    <td height="20px"></td>
  </tr>
  <?php
    include('connect.php');
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $nphone = $_SESSION['nphone'];
    $waddress = $_SESSION['waddress'];

    //$sql = "SELECT*FROM user WHERE id=$id";
    $sql = "SELECT u.*,p.po_name FROM user as u INNER JOIN user_pos as p ON p.userlevel = u.userlevel WHERE id=$id";
    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    extract($row);

    $username = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $nphone = $row['nphone'];
    $waddress = $row['waddress'];
  ?>
  <tr>
    <td>
      <?php
        echo "<b>สถานะ: </b>".$row["po_name"];
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><?php echo "<b>ชื่อผู้ใช้: </b>".$row["username"]; ?></td>
  </tr>
  <tr>
    <td width="20%"><?php echo "<b>ชื่อ: </b>".$row["fname"]; ?></td>
    <td><?php echo "<b>นามสกุล: </b>".$row["lname"]; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo "<b>เบอร์: </b>".$row["nphone"]; ?></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo "<b>ที่อยู่: </b>".$row["waddress"]; ?></td>
  </tr>
  <tr>
    <td height="22px"></td>
  </tr>
  <tr>
    <td colspan="3"><a href="edit.php?id=<?php echo $row['id'] ?>"><button>แก้ไขข้อมูลส่วนตัว</button></a></td>
  </tr>
</table>
<!-- <img class="dress-card-img-top" src="img/w1.jpg" alt=""> -->
<?php
  require 'template/front/footer.php';
?>
