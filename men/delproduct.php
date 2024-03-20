<?php
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
<?php
  include('connect.php');
  $pro_id = $_GET['pro_id'];

  $sql = "DELETE FROM pro_product WHERE pro_id='$pro_id' ";
  $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

  if($result) {
  	echo "<script type='text/javascript'>";
    echo "alert('delete Succesfuly');";
  	echo "window.location = 'manage_product.php?page=1'; ";
  	echo "</script>";
	}
	else {
  	echo "<script type='text/javascript'>";
  	echo "alert('Error back to delete again');";
  	echo "</script>";
  }
?>
<?php
  require 'template/front/footer.php';
?>
