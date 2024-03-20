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
  session_start();
  if(isset($_POST['pro_id'], $_POST['product_price'], $_POST['product_size']/*, $_POST['product_price'], $_POST['product_size'], $_POST['qty']*/)){
    $_SESSION['ses_pro_id'][$_POST['pro_id']]=$_POST['pro_id'];
    $_SESSION['ses_pro_img'][$_POST['pro_id']]=$_POST['pro_img'];
    $_SESSION['ses_pro_name'][$_POST['pro_id']]=$_POST['pro_name'];
    if($_POST['product_size'] || $_POST['product_price'] || $_POST['qty']) {
      $_SESSION['ses_pro_size'][$_POST['pro_id']]=$_POST['product_size'];
      $_SESSION['ses_pro_price'][$_POST['pro_id']]=$_POST['product_price'];
      $_SESSION['ses_pro_qty'][$_POST['pro_id']]=$_POST['qty'];
      $_SESSION['ses_pro_totalprice'][$_POST['pro_id']]=$_POST['product_price']*$_POST['qty'];
    } else {
      echo "<script>";
      echo "alert(\" โปรดเลือกไซส์กับจำนวนสินค้าที่ต้องการ\");";
      echo "window.history.back()";
      echo "</script>";
    } 
  } 
  
  /*session_start();
  session_register('cart');
  $pro_id = $_REQUEST['pro_id'];
  $act = $_REQUEST['act'];

  if($act=='add' && !empty($pro_id))
  {
    if(!isset($_SESSION['cart']))
		{
			$_SESSION['cart']=array();
		}else{
    }
    if(isset($_SESSION['cart'][$pro_id]))
    {
      $_SESSION['cart'][$pro_id]++;
    }
    else
    {
      $_SESSION['cart'][$pro_id]=1;
    }
  }

  if($act=='remove' && !empty($pro_id))  //ยกเลิกการสั่งซื้อ
  {
    unset($_SESSION['cart'][$pro_id]);
  }

  if($act=='update')
  {
    $amount_array = $_POST['amount'];
    foreach($amount_array as $pro_id=>$amount)
    {
      $_SESSION['cart'][$pro_id]=$amount;
    }
  }*/
?>
<form id="form_checkbox1" name="form_checkbox1" method="post" action="">
<table class="w3-content" width="100%" border="0" style="border-collapse: collapse;">
  <tr>
    <td colspan="6"><h2><font class="font-kanit">ตระกร้าสินค้า</font></h2></td>
  </tr>
  <tr style="text-align:center;height:50px;background:#4A4747;color:white;">
    <td style="border: 1px solid black;">ลำดับ</td>
    <td style="border: 1px solid black;" width="55%">ชื่อสินค้า</td>
    <td style="border: 1px solid black;">ไซส์</td>
    <td style="border: 1px solid black;">ราคา</td>
    <td style="border: 1px solid black;">จำนวน</td>
    <td style="border: 1px solid black;">ราคารวม</td>
  </tr>
  <?php
    $i='1';
    //foreach($_SESSION['ses_pro_id'] as $key => $value){
    if(isset($_SESSION['ses_pro_id']) && count($_SESSION['ses_pro_id'])>0){
    //$_SESSION['ses_pro_id'][$_POST['pro_id']]=$_POST['pro_id'];
    foreach($_SESSION['ses_pro_id'] as $key => $value){
  ?>
  <tr style="text-align:center;height:40px;background-color:B8B4B4;">
    <td style="border: 1px solid black;"><?=$i?></td> <!-- ลำดับ -->
    <td style="border: 1px solid black;text-align: left;padding-left:10px;"><?=$_SESSION['ses_pro_name'][$key]?></td><!-- ชื่อสินค้า -->
    <?php if($_SESSION['ses_pro_size'][$key] || $_SESSION['ses_pro_price'][$key] || $_SESSION['ses_pro_qty'][$key] || $_SESSION['ses_pro_totalprice'][$key]) { ?>
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_size'][$key]?></td><!-- ไซส์ -->
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_price'][$key]?></td><!-- ราคา -->
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_qty'][$key]?></td><!-- จำนวน -->
    <td style="border: 1px solid black;"><?=$_SESSION['ses_pro_totalprice'][$key]?></td><!-- ราคา(รวม) -->
    <?php } 
      else {
        unset($_SESSION['ses_pro_id'][$key]);
      }
    ?>
  </tr>
  <?php $i++; } }
    else {
      echo "<td colspan='6' style='text-align: center;color:#3F3F3F;border: 1px solid black;height:40px;background-color:B8B4B4;'><i>ไม่พบรายการสินค้าของคุณ</i></td>";
    }
  ?>
  <tr>
    <td colspan="4"></td>
    <td colspan="2">
      <a href="payments.php" onclick="return confirm('ยืนยันการสั่งซื้อ')"><input type="button" name="Submit2" value="สั่งซื้อ" class="w3-green w3-button" style="border:1px solid black;float:right;display: inline-block;margin-left:10px;margin-top:8px;"></a>
      <!--<input type="submit" name="button" id="button" value="ปรับปรุง" class="w3-button" style="background:lightgrey;border: 1px solid #A7A4A4;position:relative;display: inline-block;float:right;margin-top:8px;"> -->
      <!-- onclick="window.location='confirm_order.php';" -->
    </td>
  </tr>
</table>
</form>
<?php
  require 'template/front/footer.php';
?>
