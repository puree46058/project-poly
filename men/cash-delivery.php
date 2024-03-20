<?php
    session_start();
    require_once "connect.php";
    if (isset($_POST['submit'])) {
        $id = $_POST['id']; //id_user
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $nphone = $_POST['nphone'];
        $waddress = $_POST['waddress'];
        $bank = $_POST['bank'];
        $pro_id = $_POST['pro_id'];
        $pro_img = $_POST['pro_img'];
        $product_name = $_POST['product_name'];
        $product_size = $_POST['product_size'];
        $product_price = $_POST['product_price'];
        $product_ammo = $_POST['product_ammo'];
        $product_total = $_POST['product_total'];
        $product_delivery = $_POST['product_delivery'];
        $total = $_POST['total'];
        $order_number = $_POST['order_number'];
        $number_tracking = $_POST['number_tracking'];

        $i='1';
        if(isset($_SESSION['ses_pro_id']) && count($_SESSION['ses_pro_id'])>0){
          foreach($_SESSION['ses_pro_id'] as $key => $value){
        $sql = "INSERT INTO `order`(`id_user`, `pro_img`, `product_name`, `product_size`, `product_price`, `product_ammo`, `product_total`, `product_delivery`, `total`, `order_number`, `bank`, `fname`, `lname`, `nphone`, `waddress`, `status_order`, `number_tracking`) 
                  VALUES ('$id','".$_SESSION["ses_pro_img"][$key]."','".$_SESSION["ses_pro_name"][$key]."','".$_SESSION["ses_pro_size"][$key]."','".$_SESSION["ses_pro_price"][$key]."',
                  '".$_SESSION["ses_pro_qty"][$key]."','".$_SESSION["ses_pro_totalprice"][$key]."','$product_delivery','$total','$order_number','$bank','$fname', '$lname','$nphone', '$waddress','รอดำเนินการ','$number_tracking')";
        $result = mysqli_query($conn, $sql);
          $i++; }
        }
        if ($result)
        {
            $_SESSION['success'] = "successfully";
            header("Location: index.php");
        }
        else
        {
            $_SESSION['error'] = "Something went wrong";
            header("Location: index.php");
        }
    }
?>
<?php
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
    //require 'template/front/header.php';
    header("Location: login.php");
  } else {
    require 'template/back/header.php';
  }
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table class="w3-content" border="0" width="70%" height="20%" style="border-collapse: collapse;">
  <tr>
    <td colspan="6"><b><font size="6" class="font-kanit">เก็บเงินปลายทาง</font></b></td>
  </tr>
  <tr>
    <td colspan="6" height="15px"></td>
  </tr>
  <?php
    session_start();
    include('connect.php');
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $nphone = $_SESSION['nphone'];
    $waddress = $_SESSION['waddress'];

    //$sql = "SELECT*FROM user WHERE id=$id";
    $sql = "SELECT * FROM user WHERE id=$id";
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
    <input type="hidden" name="id" value="<?=$id; ?>">
    <td colspan="6" style="line-height:26pt;">
      <b>ฃื่อ: </b><input type="text" name="fname" value="<?=$fname; ?>" style="line-height:15pt;" disabled>
      <font style="padding-left:80px;"><b>นามสกุล: </b></font><input type="text" name="lname" value="<?=$lname; ?>" style="line-height:15pt;" disabled> 
      <input type="hidden" name="fname" value="<?=$fname; ?>">
      <input type="hidden" name="lname" value="<?=$lname; ?>"> 
    </td>
  </tr>
  <tr>
    <td colspan="6" style="line-height:26pt;"><b>เบอร์: </b><input type="text" name="nphone" value="<?=$nphone; ?>" style="line-height:15pt;" disabled>
    <input type="hidden" name="nphone" value="<?=$nphone; ?>"></td>
  </tr>
  <tr>
    <td colspan="6" style="line-height:26pt;"><b>ที่อยู่: </b><br>
      <textarea type="text" name="waddress" value="<?=$waddress; ?>" style="line-height:15pt;" rows="3" cols="63" disabled><?=$waddress; ?></textarea>
      <input type="hidden" name="waddress" value="<?=$waddress; ?>">
    </td>
    <input type="hidden" name="bank" value="เก็บเงินปลายทาง">
  </tr>
  <tr>
    <td colspan="6" height="20px"></td>
  </tr>
  <?php
    session_start();
    if(isset($_POST['pro_id'])){
      $_SESSION['ses_pro_id'][$_POST['pro_id']]=$_POST['pro_id'];
      $_SESSION['ses_pro_img'][$_POST['pro_id']]=$_POST['pro_img'];
      $_SESSION['ses_pro_name'][$_POST['pro_id']]=$_POST['pro_name'];
      $_SESSION['ses_pro_size'][$_POST['pro_id']]=$_POST['product_size'];
      $_SESSION['ses_pro_price'][$_POST['pro_id']]=$_POST['product_price'];
      $_SESSION['ses_pro_qty'][$_POST['pro_id']]=$_POST['qty'];
      $_SESSION['ses_pro_totalprice'][$_POST['pro_id']]=$_POST['product_price']*$_POST['qty'];
    }
  ?>
  <tr style="text-align:center;height:50px;background:#727070;color:white;">
    <td style="border: 1px solid black;" width="20px">ลำดับ</td>
    <td style="border: 1px solid black;">ชื่อสินค้า</td>
    <td style="border: 1px solid black;">ไซส์</td>
    <td style="border: 1px solid black;">ราคา</td>
    <td style="border: 1px solid black;">จำนวน</td>
    <td style="border: 1px solid black;">ราคารวม</td>
  </tr>
  <?php
    $i='1';
    $qty = 0;
    $total = 0;
    //foreach($_SESSION['ses_pro_id'] as $key => $value){
    if(isset($_SESSION['ses_pro_id']) && count($_SESSION['ses_pro_id'])>0){
    //$_SESSION['ses_pro_id'][$_POST['pro_id']]=$_POST['pro_id'];
      foreach($_SESSION['ses_pro_id'] as $key => $value){
  ?>

  <tr style="text-align:center;height:40px;background-color:#D1D0D0;">
    <td style="border: 1px solid black;"><?=$i?>
      <input type="hidden" name="pro_id" value="<?= $_SESSION['ses_pro_id'][$key]; ?>">
      <input type="hidden" name="pro_img" value="<?= $_SESSION['ses_pro_img'][$key]; ?>">
    </td> <!-- ลำดับ -->
    <td style="border: 1px solid black;text-align: left;padding-left:10px;"><?=$_SESSION['ses_pro_name'][$key]?><input type="hidden" name="product_name" value="<?= $_SESSION['ses_pro_name'][$key]; ?>"></td><!-- ชื่อสินค้า -->
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_size'][$key]?><input type="hidden" name="product_size" value="<?= $_SESSION['ses_pro_size'][$key]; ?>"></td><!-- ไซส์ -->
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_price'][$key]?><input type="hidden" name="product_price" value="<?= $_SESSION['ses_pro_price'][$key]; ?>"></td><!-- ราคา -->
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_qty'][$key]?><input type="hidden" name="product_ammo" value="<?= $_SESSION['ses_pro_qty'][$key]; ?>"></td><!-- จำนวน -->
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_totalprice'][$key]?><input type="hidden" name="product_total" value="<?= $_SESSION['ses_pro_totalprice'][$key]; ?>"></td><!-- ราคา(รวม) -->
  </tr>
  <?php
        $i++;
        $qty = $qty+($_SESSION['ses_pro_qty'][$key]);
        $total = $total+($_SESSION['ses_pro_totalprice'][$key]);
      }
    }
    else {
      echo "<td colspan='6' style='text-align: center;color:#3F3F3F;border: 1px solid black;height:40px;background-color:B8B4B4;'><i>ไม่พบรายการสินค้าของคุณ</i></td>";
    }
  ?>
  <tr>
    <?php
      $qty = number_format($qty);
      $price_delivery = 50+(($qty-1)*10);
      if(isset($_SESSION['ses_pro_id']) && count($_SESSION['ses_pro_id'])>0) {
    ?>
    <td colspan="2"><font style="color:#1C1C1C;"><i>**ค่าขนส่งคิดตัวแรก +50 บาท ตัวถัดไปบวกเพิ่ม 10 บาท* จัดส่งแบบด่วน EMS 1-3วัน</i></font></td>
    <td colspan="4" style="text-align:right;font-size: 18px;">ค่าขนส่ง: +<?php echo $price_delivery; ?> บาท<input type="hidden" name="product_delivery" value="<?= $price_delivery; ?>"></td>
    <?php
      } else {
        echo "<td colspan='6' style='text-align:right;font-size: 18px;'>ค่าขนส่ง: 0</td>";
      }
    ?>
  </tr>
  <tr style="text-align:center;height:50px;color:white;">
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2" style="border: 1px solid black;background:#727070;">รวมทั้งหมด</td>
    <?php
      $total = number_format($total+$price_delivery, 2);
      if(isset($_SESSION['ses_pro_id']) && count($_SESSION['ses_pro_id'])>0) {
    ?>
    <td style="border: 1px solid black;background-color:#F7F5E5;color:black;"><?php echo $total; ?><input type="hidden" name="total" value="<?= $total; ?>"></td>
    <?php
      } else {
        echo "<td style='border: 1px solid black;background-color:#F7F5E5;color:black;'></td>";
      }
    ?>
  </tr>
  <tr>
    <td colspan="6" height="20px"></td>
  </tr>
  <tr>
    <?php

    function alphanumeric_rand($num_require=8) {
    	$alphanumeric = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W',
      'X','Y','Z',0,1,2,3,4,5,6,7,8,9);
    	if($num_require > sizeof($alphanumeric)){
    		echo "Error alphanumeric_rand(\$num_require) : \$num_require must less than " . sizeof($alphanumeric) . ", $num_require given";
    		return;
    	}
      $randomString ='';
    	$rand_key = array_rand($alphanumeric , $num_require);
    	for($i=0;$i<sizeof($rand_key);$i++) $randomString .= $alphanumeric[$rand_key[$i]];
    	return $randomString;
    }
    echo "<input type='hidden' name='number_tracking' value='รอ 1-2วันทำการ'>";
    echo "<input type='hidden' name='order_number' value='".alphanumeric_rand(13)."'>";

    ?>
    <td colspan="6"><input type="submit" name="submit" value="ยืนยันการสั่งซื้อ" class="w3-green w3-button" style="border:1px solid black;float:right;display: inline-block;margin-left:10px;margin-top:8px;"></td>
  </tr>
</table>
</form>
<!-- <img class="dress-card-img-top" src="img/w1.jpg" alt=""> -->
<?php
  require 'template/front/footer.php';
?>
