<?php
  include('connect.php');

  $id = $_POST['id'];
  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $nphone = $_POST['nphone'];
  $waddress = $_POST['waddress'];

  $sql = "UPDATE user SET
  username='$username',
  fname='$fname',
  lname='$lname',
  nphone='$nphone',
  waddress='$waddress'
  WHERE id=$id";

  $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

  mysqli_close($conn);
  if($result) {
    echo "<script type='text/javascript'>";
    echo "alert('แก้ไขข้อมูลสำเร็จ!');";
    echo "window.location = 'account.php';";
    echo "</script>";
    //header("Location: account.php");
  } else {
    echo "<script type='text/javascript'>";
    echo "window.location = 'account.php';";
    echo "</script>";
  }
?>
