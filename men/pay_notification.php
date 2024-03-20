<?php
    session_start();
    require_once "connect.php";
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $nphone = $_POST['nphone'];
        $waddress = $_POST['waddress'];

        $bank = $_POST['bank'];
        $money_pay = $_POST['money_pay'];
        $date_pay = $_POST['date_pay'];
        $time_pay_hour = $_POST['time_pay_hour'];
        $time_pay_minute = $_POST['time_pay_minute'];
        $status_order = $_POST['status_order'];
        $img_pay = $_POST['img_pay'];

        /*$pro_id = $_POST['pro_id'];
        $product_name = $_POST['product_name'];
        $product_size = $_POST['product_size'];
        $product_price = $_POST['product_price'];
        $product_ammo = $_POST['product_ammo'];
        $product_total = $_POST['product_total'];
        $product_delivery = $_POST['product_delivery'];
        $total = $_POST['total'];*/

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

        $number_tracking = $_POST['$number_tracking'];

        //Upload img
        $ext = pathinfo(basename($_FILES['img_pay']['name']), PATHINFO_EXTENSION);
        $new_image_name = 'pay_'.uniqid().".".$ext;
        $image_path = 'upload/pay_notification/';
        $upload_path = $image_path.$new_image_name;

        $success = move_uploaded_file($_FILES['img_pay']['tmp_name'],$upload_path);
        if($success == FALSE) {
          echo "ไม่สามารถ Upload รูปภาพได้";
          exit();
        }
        $img_pay = $new_image_name;

        $i='1';
        if(isset($_SESSION['ses_pro_id']) && count($_SESSION['ses_pro_id'])>0){
        //$_SESSION['ses_pro_id'][$_POST['pro_id']]=$_POST['pro_id'];
          foreach($_SESSION['ses_pro_id'] as $key => $value){
        /*$query = "INSERT INTO pay_notification (fname, lname, nphone, waddress, bank, money_pay, date_pay, time_pay, img_pay)
                  VALUES ('$fname', '$lname','$nphone', '$waddress', '$bank', '$money_pay','$date_pay','$time_pay','$img_pay')";*/
        $sql = "INSERT INTO pay_notification (id_user,fname, lname, nphone, waddress, bank, money_pay, date_pay, time_pay_hour, time_pay_minute, img_pay, pro_img, product_name, product_size, product_price, product_ammo, product_total, product_delivery, total, order_number, status_order, number_tracking)
                  VALUES ('$id','$fname', '$lname','$nphone', '$waddress', '$bank', '$money_pay','$date_pay','$time_pay_hour','$time_pay_minute','$img_pay',
                    '".$_SESSION["ses_pro_img"][$key]."','".$_SESSION["ses_pro_name"][$key]."','".$_SESSION["ses_pro_size"][$key]."','".$_SESSION["ses_pro_price"][$key]."','".$_SESSION["ses_pro_qty"][$key]."','".$_SESSION["ses_pro_totalprice"][$key]."','$product_delivery','$total','$order_number','รอดำเนินการ','รอ 1-2วันทำการ')";
        /*$query = "INSERT INTO pay_notification(fname,lname,nphone,waddress) SELECT fname,lname,nphone,waddress FROM user WHERE id=$id";*/
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
    <td colspan="6"><b><font size="6" class="font-kanit">แจ้งโอนเงินผ่านธนาคาร</font></b></td>
  </tr>

  <tr>
    <td class="table_header">ธนาคาร</td>
    <td class="table_header">เลขบัญชี</td>
    <td class="table_header" colspan="2">สาขา</td>
    <td class="table_header" colspan="2">ชื่อบัญชี</td>
  </tr>
  <tr>
    <td class="table_div">ธนาคารกสิกร</td>
    <td class="table_div">xxx-x-xxxxx-x</td>
    <td class="table_div" colspan="2">หนองหอย</td>
    <td class="table_div" colspan="2">นายสมมุติ ขึ้นมา</td>
  </tr>

  <tr>
    <td colspan="6" height="15px"></td>
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
  <tr style="text-align:center;height:50px;background:#727070;color:white;margin:2px;">
    <td style="border: 1px solid black;">ลำดับ</td>
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
    <td style="border: 1px solid black;background-color:#F7F5E5;color:black;"><?php echo $total; ?> บาท<input type="hidden" name="total" value="<?= $total; ?>"></td>
    <?php
      } else {
        echo "<td style='border: 1px solid black;background-color:#F7F5E5;color:black;'></td>";
      }
    ?>
  </tr>
  <tr>
    <td colspan="6" height="20px"></td>
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
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <input type="hidden" name="id" value="<?=$id; ?>">
    <td colspan="6" style="line-height:26pt;">
      <b>ฃื่อ: </b><input type="text" name="fname" value="<?=$fname; ?>" style="line-height:15pt;" disabled>
      <font style="padding-left:80px;"><b>นามสกุล: </b></font><input type="text" name="lname" value="<?=$lname; ?>" style="line-height:15pt;" disabled> 
      <input type="hidden" name="fname" value="<?=$fname; ?>">
      <input type="hidden" name="lname" value="<?=$lname; ?>"> 
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <td colspan="6" style="line-height:26pt;"><b>เบอร์: </b><input type="text" name="nphone" value="<?=$nphone; ?>" style="line-height:15pt;" disabled>
    <input type="hidden" name="nphone" value="<?=$nphone; ?>">
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <td colspan="6" style="line-height:26pt;"><b>ที่อยู่: </b><br>
      <textarea type="text" name="waddress" value="<?=$waddress; ?>" style="line-height:15pt;" rows="3" cols="63" disabled><?=$waddress; ?></textarea>
      <input type="hidden" name="waddress" value="<?=$waddress; ?>">
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <td colspan="6" style="line-height:26pt;"><?php echo "<b>ธนาคารที่โอน:<font color='red'><b>*</b></font> </b>"?></td>
    <tr><td colspan="6" style="line-height:26pt;padding-left:2%;"><input type="radio" name="bank" value="KBANK" style="line-height:15pt;" required> <img src="icon/bank/kbank.png" wdith="25px" height="25px" style="padding-bottom:3px;">ธนาคารกสิกรไทย</tr></td>
  </tr>
  <tr>
    <td colspan="6" style="line-height:2pt;">__________________</td>
  </tr>
  <tr>
    <td colspan="6" style="height:20px"></td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <?php 
      if(!isset($_SESSION['ses_pro_id'])) { 
        echo "<td colspan='6'></td>";  
      }
      else { ?>
    <td colspan="6"><?php echo "<b>จำนวนเงินที่ชำระ: </b>"?><input type="text" style="left:-55px;" name="money_pay" value="<?= $total; ?>" size="5px" style="line-height:15pt;" disabled> บาท <font color="red"> (โปรดชำระเงินให้ถูกต้อง)</font>
    <input type="hidden" name="money_pay" value="<?= $total; ?>">
    <?php } ?>
    </td>
  </tr>
  <tr>
    <td colspan="6" style="line-height:26pt;"></td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <td colspan="6" style="line-height:26pt;"><?php echo "<b>วันที่ชำระเงิน:<font color='red'><b>*</b></font> </b>"?>
      <input type="date" name="date_pay" style="line-height:15pt;" required>
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <td colspan="6" style="line-height:26pt;"><?php echo "<b>เวลา(โดยประมาณ):</b><font color='red'><b>*</b></font>"?>
      <!--<input type="text" placeholder="hh:mm" size="4" name="time_pay" maxlength="5" style="line-height:15pt;" required>-->
      <select name="time_pay_hour" required> <!-- ชั่วโมง -->
        <option value="- ชม. -" name="time_pay_hour" class="pay-time-size">- ชม. -</option>
        <option value="00" name="time_pay_hour" class="pay-time-size">00</option>
        <option value="01" name="time_pay_hour" class="pay-time-size">01</option>
        <option value="02" name="time_pay_hour" class="pay-time-size">02</option>
        <option value="03" name="time_pay_hour" class="pay-time-size">03</option>
        <option value="04" name="time_pay_hour" class="pay-time-size">04</option>
        <option value="05" name="time_pay_hour" class="pay-time-size">05</option>
        <option value="06" name="time_pay_hour" class="pay-time-size">06</option>
        <option value="07" name="time_pay_hour" class="pay-time-size">07</option>
        <option value="08" name="time_pay_hour" class="pay-time-size">08</option>
        <option value="09" name="time_pay_hour" class="pay-time-size">09</option>
        <option value="10" name="time_pay_hour" class="pay-time-size">10</option>
        <option value="11" name="time_pay_hour" class="pay-time-size">11</option>
        <option value="12" name="time_pay_hour" class="pay-time-size">12</option>
        <option value="13" name="time_pay_hour" class="pay-time-size">13</option>
        <option value="14" name="time_pay_hour" class="pay-time-size">14</option>
        <option value="15" name="time_pay_hour" class="pay-time-size">15</option>
        <option value="16" name="time_pay_hour" class="pay-time-size">16</option>
        <option value="17" name="time_pay_hour" class="pay-time-size">17</option>
        <option value="18" name="time_pay_hour" class="pay-time-size">18</option>
        <option value="19" name="time_pay_hour" class="pay-time-size">19</option>
        <option value="20" name="time_pay_hour" class="pay-time-size">20</option>
        <option value="21" name="time_pay_hour" class="pay-time-size">21</option>
        <option value="22" name="time_pay_hour" class="pay-time-size">22</option>
        <option value="23" name="time_pay_hour" class="pay-time-size">23</option>
      </select>:
      <select name="time_pay_minute" required><!-- นาที -->
        <option value="- นาที -" name="time_pay_minute" class="pay-time-size">- นาที -</option>
        <option value="00" name="time_pay_minute" class="pay-time-size">00</option>
        <option value="01" name="time_pay_minute" class="pay-time-size">01</option>
        <option value="02" name="time_pay_minute" class="pay-time-size">02</option>
        <option value="03" name="time_pay_minute" class="pay-time-size">03</option>
        <option value="04" name="time_pay_minute" class="pay-time-size">04</option>
        <option value="05" name="time_pay_minute" class="pay-time-size">05</option>
        <option value="06" name="time_pay_minute" class="pay-time-size">06</option>
        <option value="07" name="time_pay_minute" class="pay-time-size">07</option>
        <option value="08" name="time_pay_minute" class="pay-time-size">08</option>
        <option value="09" name="time_pay_minute" class="pay-time-size">09</option>
        <option value="10" name="time_pay_minute" class="pay-time-size">10</option>
        <option value="11" name="time_pay_minute" class="pay-time-size">11</option>
        <option value="12" name="time_pay_minute" class="pay-time-size">12</option>
        <option value="13" name="time_pay_minute" class="pay-time-size">13</option>
        <option value="14" name="time_pay_minute" class="pay-time-size">14</option>
        <option value="15" name="time_pay_minute" class="pay-time-size">15</option>
        <option value="16" name="time_pay_minute" class="pay-time-size">16</option>
        <option value="17" name="time_pay_minute" class="pay-time-size">17</option>
        <option value="18" name="time_pay_minute" class="pay-time-size">18</option>
        <option value="19" name="time_pay_minute" class="pay-time-size">19</option>
        <option value="20" name="time_pay_minute" class="pay-time-size">20</option>
        <option value="21" name="time_pay_minute" class="pay-time-size">21</option>
        <option value="22" name="time_pay_minute" class="pay-time-size">22</option>
        <option value="23" name="time_pay_minute" class="pay-time-size">23</option>
        <option value="24" name="time_pay_minute" class="pay-time-size">24</option>
        <option value="25" name="time_pay_minute" class="pay-time-size">25</option>
        <option value="26" name="time_pay_minute" class="pay-time-size">26</option>
        <option value="27" name="time_pay_minute" class="pay-time-size">27</option>
        <option value="28" name="time_pay_minute" class="pay-time-size">28</option>
        <option value="29" name="time_pay_minute" class="pay-time-size">29</option>
        <option value="30" name="time_pay_minute" class="pay-time-size">30</option>
        <option value="31" name="time_pay_minute" class="pay-time-size">31</option>
        <option value="32" name="time_pay_minute" class="pay-time-size">32</option>
        <option value="33" name="time_pay_minute" class="pay-time-size">33</option>
        <option value="34" name="time_pay_minute" class="pay-time-size">34</option>
        <option value="35" name="time_pay_minute" class="pay-time-size">35</option>
        <option value="36" name="time_pay_minute" class="pay-time-size">36</option>
        <option value="37" name="time_pay_minute" class="pay-time-size">37</option>
        <option value="38" name="time_pay_minute" class="pay-time-size">38</option>
        <option value="39" name="time_pay_minute" class="pay-time-size">39</option>
        <option value="40" name="time_pay_minute" class="pay-time-size">40</option>
        <option value="41" name="time_pay_minute" class="pay-time-size">41</option>
        <option value="42" name="time_pay_minute" class="pay-time-size">42</option>
        <option value="43" name="time_pay_minute" class="pay-time-size">43</option>
        <option value="44" name="time_pay_minute" class="pay-time-size">44</option>
        <option value="45" name="time_pay_minute" class="pay-time-size">45</option>
        <option value="46" name="time_pay_minute" class="pay-time-size">46</option>
        <option value="47" name="time_pay_minute" class="pay-time-size">47</option>
        <option value="48" name="time_pay_minute" class="pay-time-size">48</option>
        <option value="49" name="time_pay_minute" class="pay-time-size">49</option>
        <option value="50" name="time_pay_minute" class="pay-time-size">50</option>
        <option value="51" name="time_pay_minute" class="pay-time-size">51</option>
        <option value="52" name="time_pay_minute" class="pay-time-size">52</option>
        <option value="53" name="time_pay_minute" class="pay-time-size">53</option>
        <option value="54" name="time_pay_minute" class="pay-time-size">54</option>
        <option value="55" name="time_pay_minute" class="pay-time-size">55</option>
        <option value="56" name="time_pay_minute" class="pay-time-size">56</option>
        <option value="57" name="time_pay_minute" class="pay-time-size">57</option>
        <option value="58" name="time_pay_minute" class="pay-time-size">58</option>
        <option value="59" name="time_pay_minute" class="pay-time-size">59</option>
      </select> น.
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:17px;">
    <td colspan="6" style="line-height:26pt;"><?php echo "<b>รูปถ่ายสลิปการโอน: </b>"?><input type="file" name="img_pay" class="form-control" style="line-height:15pt;" required> <i><font color="red" style="left:-13%;position:relative;">*จำเป็น*</font></i></td>
  </tr>
  <tr>
      <td height="25px" colspan="6">
        <font color='red' class="font-kanit" style="font-size:15px;padding-left:150px;">* ฟิลต์ที่จำเป็น</font>
      </td>
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
    echo "<input type='hidden' name='order_number' value='".alphanumeric_rand(13)."'>";

    ?>
    <td colspan="6"><input type="submit" name="submit" value="ยืนยัน" class="w3-button w3-green"></td>
  </tr>
</table>
</form>
<!-- <img class="dress-card-img-top" src="img/w1.jpg" alt=""> -->
<?php
  require 'template/front/footer.php';
?>
