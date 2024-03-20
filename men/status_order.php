<?php
  session_start();
  require_once "connect.php";
  if (isset($_POST['submit'])) {
    $No = $_POST['No'];
    $id_user = $_POST['id_user'];
    $pro_img = $_POST['pro_img'];
    $product_name = $_POST['product_name'];
    $product_size = $_POST['product_size'];
    $product_price = $_POST['product_price'];
    $product_ammo = $_POST['product_ammo'];
    $product_total = $_POST['product_total'];
    $product_delivery = $_POST['product_delivery'];
    $total = $_POST['total'];
    $order_number = $_POST['order_number'];
    $bank = $_POST['bank'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $nphone = $_POST['nphone'];
    $waddress = $_POST['waddress'];
    $status_order = $_POST['status_order'];
    $number_tracking = $_POST['number_tracking'];

    //$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    $sql = "SELECT * FROM `order` WHERE order_number='$order_number'";
    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    foreach( $result as $value ) {
      if($status_order == 'รอดำเนินการ') {
        $sql = "UPDATE `order` SET `status_order` = '$status_order' WHERE order_number = '$No'";
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      }
      if($status_order == 'รอการจัดส่ง') {
        $sql = "UPDATE `order` SET `status_order` = '$status_order' , `number_tracking` = '$number_tracking' WHERE order_number = '$No'";
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      } 
      if($status_order == 'กำลังจัดส่ง') {
        $sql = "UPDATE `order` SET `status_order` = '$status_order' , `number_tracking` = '$number_tracking' WHERE order_number = '$No'";
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      } 
      if($status_order == 'จัดส่งแล้ว') {
        $sql = "UPDATE `order` SET `status_order` = '$status_order' , `number_tracking` = '$number_tracking' WHERE order_number = '$No'";
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      } 
      if($status_order == 'ยกเลิก') {
        $sql = "UPDATE `order` SET `status_order` = '$status_order' , `number_tracking` = '$number_tracking' WHERE order_number = '$No'";
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      } 
    }
    //$sql = "UPDATE `pay_notification` SET `status_order` = '$status_order' WHERE `order_number` = '$No'";

    mysqli_close($conn);
    if($result) {
      echo "<script type='text/javascript'>";
      echo "alert('บันทึก/เปลี่ยนค่าข้อมูลสำเร็จ!');";

      echo "</script>";
      /*echo $No;
      echo $status_order;*/
    } else {
      echo "<script type='text/javascript'>";
      echo "window.location = 'status_order.php?page=1';";
      echo "</script>";
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
    if($_SESSION['userlevel'] != 2) {
      echo "<script>";
      echo "window.history.back();";
      echo "</script>";
    } 
  }
?>
<table style="margin-left:150px;padding: 15px;" border="0">
  <tr>
    <td colspan="12"><h2><font class="font-kanit"><b>จัดการสถานะจัดส่งสินค้า</b></font></h2></td>
  </tr>
  <table style="margin-left:150px;padding: 15px;border-collapse: collapse;">
  <tr style="text-align:center;font-size: 17px;background:#3D3B3A;color:#FFFDFB;font-family: 'Kodchasan', sans-serif;">
    <td style="border: 1px solid black;width:auto auto;"><b>วันที่สั่งซื้อ</b></td>
    <td style="border: 1px solid black;"><b>คำสั่งซื้อ</b></td>
    <td style="border: 1px solid black;"><b>ชื่อ</b></td>
    <td style="border: 1px solid black;"><b>นามสกุล</b></td>
    <td style="border: 1px solid black;"><b>เบอร์ติดต่อ</b></td>
    <td style="border: 1px solid black;"><b>ที่อยู่</b></td>
    <td style="border: 1px solid black;"><b>การชำระ</b></td>
    <td style="border: 1px solid black;"><b>รายละเอียด</b></td>
    <td style="border: 1px solid black;"><b>หมายเลขพัสดุ</b></td>
    <td style="border: 1px solid black;"><b>สถานะสินค้า</b></td>
    <td style="border: 1px solid black;"><b></b></td>
  <?php
    include('connect.php');
    $perpage = 20;
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }

    $start = ($page - 1) * $perpage;

    $sql = "SELECT*FROM `order`";
    $result2 = mysqli_query($conn, $sql);
    $total_record = mysqli_num_rows($result2);
    $total_page = ceil($total_record / $perpage);

    $sql = "SELECT*FROM `order` WHERE No GROUP BY order_number ORDER BY Date_Current DESC limit {$start} , {$perpage}";
    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

    //$row = mysqli_fetch_array($result);
  ?>
  <?php  
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if($row) {
      foreach ($row as $key => $value):
        
      echo "<form method='POST' action='".$_SERVER['PHP_SELF']."' enctype='multipart/form-data'>";

        $id_user = $value['id_user'];
        $pro_img = $value['pro_img'];
        $product_name = $value['product_name'];
        $product_size = $value['product_size'];
        $product_price = $value['product_price'];
        $product_ammo = $value['product_ammo'];
        $product_total = $value['product_total'];
        $product_delivery = $value['product_delivery'];
        $total = $value['total'];
        $order_number = $value['order_number'];
        $bank = $value['bank'];
        $fname = $value['fname'];
        $lname = $value['lname'];
        $nphone = $value['nphone'];
        $waddress = $value['waddress'];
        $status_order = $value['status_order'];
        $number_tracking = $value['number_tracking'];
        $Date_Current = $value['Date_Current'];
  ?>
  
    <!-- <php 
        if($order_status == 'รอการจัดส่ง' || $order_status == 'กำลังจัดส่ง' || $order_status == 'จัดส่งแล้ว' || $order_status == 'ยกเลิก') {
            echo "<td style='border: 1px solid black;'>";
                echo "หมายเลขพัสดุ";
            echo "</td>";
            echo "<td style='border: 1px solid black;'>";
                echo "<b>สถานะสินค้า</b>";
            echo "</td>";
            echo "<td style='border: 1px solid black;'>";
                echo "<b></b>";
            echo "</td>";
        } else {
            echo "<td colspan='2' style='border: 1px solid black;'>";
                echo "<b>สถานะสินค้า</b>";
            echo "</td>";
            echo "<td style='border: 1px solid black;'>";
                echo "<b></b>";
            echo "</td>";
        }
    ?> -->
    <!-- <td style="border: 1px solid black;"><b>สถานะสินค้า</b></td> -->
  </tr>
  <tr align="center" style="background:#F8FDD7;font-family: 'Karla', sans-serif;font-size:18px;"">
    <input type="hidden" name="No" value="<?= $order_number; ?>">
    <input type="hidden" name="id_user" value="<?= $id_user; ?>">
    <input type="hidden" name="number_tracking" value="<?= $number_tracking; ?>">
    <td style="border-bottom: 1px solid #E7EFB6;"><?= $Date_Current; ?></td>
    <td style="border-bottom: 1px solid #E7EFB6;"><?= $order_number; ?><input type="hidden" name="order_number" value="<?= $order_number; ?>"></td>
    <td style="text-align:left;border-bottom: 1px solid #E7EFB6;"><?= $fname; ?><input type="hidden" name="fname" value="<?= $fname; ?>"></td>
    <td style="text-align:left;border-bottom: 1px solid #E7EFB6;"><?= $lname; ?><input type="hidden" name="lname" value="<?= $lname; ?>"></td>
    <td style="border-bottom: 1px solid #E7EFB6;"><?= $nphone; ?><input type="hidden" name="nphone" value="<?= $nphone; ?>"></td>
    <td style="text-align:left;border-bottom: 1px solid #E7EFB6;"><?= $waddress; ?><input type="hidden" name="waddress" value="<?= $waddress; ?>">
    <td style="border-bottom: 1px solid #E7EFB6;"><?= $bank; ?><input type="hidden" name="bank" value="<?= $bank; ?>"></td>
    <td style="border-bottom: 1px solid #E7EFB6;">
      <a id="myBtn" href="#" class="modal-btn bi bi-search" style="text-decoration:none;background:#1262E6;color:#ECEDEF;border-bottom: 1px solid #E7EFB6;position:relative;display: inline-block;width:80px;height:32px;padding:5px;border-radius: 20px 20px 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
        View
      </a>
      <!-------------------------------------------------------------------------------------------------------------------------------------->
      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <!-----------------------------[ CONTENT ]------------------------------------------------------------------------------------------>
          <?php 
            echo "หมายเลขคำสั่งซื้อ: $order_number<br><br>";
            $i='1';
            $sql = "SELECT * FROM `order` WHERE order_number='$order_number'";
            $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
            foreach( $result as $value ) :
          ?>
          <?php echo $i; ?>.
          <input type="hidden" name="pro_img" value="<?php echo $value['pro_img']; ?>">
          <?php echo $value['product_name']; ?> | <input type="hidden" name="product_name" value="<?php echo $value['product_name']; ?>">
          <b>x<?php echo $value['product_ammo']; ?><input type="hidden" name="product_ammo" value="<?php echo $value['product_ammo']; ?>"></b>
          <b>(Size: <?php echo $value['product_size']; ?>)<input type="hidden" name="product_size" value="<?php echo $value['product_size']; ?>"></b>
          <input type="hidden" name="product_price" value="<?php echo $value['product_price']; ?>">
          <i><?php echo $value['product_total']; ?>.-<input type="hidden" name="product_total" value="<?php echo $value['product_total']; ?>"></i>
          <br>
          <?php $i++; ?>
          <?php endforeach; ?> <br>
          <b>ค่าขนส่ง: </b><?= $product_delivery; ?> บาท<input type="hidden" name="product_delivery" value="<?= $product_delivery; ?>"><br>
          <b>ยอดรวม: </b><i><font style="font-size:20px;"><b><?= $total; ?></font></b></i> บาท<input type="hidden" name="total" value="<?= $total; ?>">
          <!----------------------------------------------------------------------------------------------------------------------------------->
       </div>
      </div>
    </td>
    <?php 
        if($status_order == 'รอการจัดส่ง' || $status_order == 'กำลังจัดส่ง' || $status_order == 'จัดส่งแล้ว' || $status_order == 'ยกเลิก') {
            echo "<td style='border-bottom: 1px solid #E7EFB6;'>";
                echo "<input type='text' name='number_tracking' value='".$number_tracking."' size='13'>";
            echo "</td>";
            echo "<td style='border-bottom: 1px solid #E7EFB6;'>";
                echo "<select name='status_order'>";
                    echo "<option value='".$status_order."' name='status_order'>".$status_order."</option>";
                    echo "<option value='รอการจัดส่ง' name='status_order'>รอการจัดส่ง</option>";
                    echo "<option value='กำลังจัดส่ง' name='status_order'>กำลังจัดส่ง</option>";
                    echo "<option value='จัดส่งแล้ว' name='status_order'>จัดส่งแล้ว</option>";
                    echo "<option value='ยกเลิก' name='status_order'>ยกเลิก</option>";
                echo "</select>";
            echo "</td>";
            echo "<td style='border-bottom: 1px solid #E7EFB6;'>";
                echo "<input type='submit' name='submit' value='บันทึก' class='w3-green w3-button' style='text-decoration:none;background:#1262E6;color:#ECEDEF;border: 1px solid #A7A4A4;position:relative;display: inline-block;height:32px;padding:0px 16px;border-radius:5px;'>";
            echo "</td>";
        } else {
            echo "<td colspan='2' style='border-bottom: 1px solid #E7EFB6;'>";
                echo "<select name='status_order'>";
                    echo "<option value='".$status_order."' name='order_status'>".$status_order."</option>";
                    echo "<option value='รอการจัดส่ง' name='status_order'>รอการจัดส่ง</option>";
                    echo "<option value='กำลังจัดส่ง' name='status_order'>กำลังจัดส่ง</option>";
                    echo "<option value='จัดส่งแล้ว' name='status_order'>จัดส่งแล้ว</option>";
                    echo "<option value='ยกเลิก' name='status_order'>ยกเลิก</option>";
                echo "</select>";
            echo "</td>";
            echo "<td style='border-bottom: 1px solid #E7EFB6;'>";
                echo "<input type='submit' name='submit' value='บันทึก' class='w3-green w3-button' style='text-decoration:none;background:#1262E6;color:#ECEDEF;border: 1px solid #A7A4A4;position:relative;display: inline-block;height:32px;padding:0px 16px;border-radius:5px;'>";
            echo "</td>";
        }
    ?>
    <!-- <td style="border: 1px solid black;">
      <select name='order_status'>
        <option value="<= $order_status; ?>" name='order_status'><= $order_status; ?></option>
        <option value="รอการจัดส่ง" name='order_status'>รอการจัดส่ง</option>
        <option value="กำลังจัดส่ง" name='order_status'>กำลังจัดส่ง</option>
        <option value="จัดส่งแล้ว" name='order_status'>จัดส่งแล้ว</option>
        <option value="ยกเลิก" name='order_status'>ยกเลิก</option>
      </select>
    </td> -->
  </tr>
  </form>
  <!-- <tr>
    <td style="padding-left:5px;text-align:left;padding-bottom:11px;border: 1px solid black;background:#C24212;color:#FFFFFD;" colspan="12"><b>รายการสินค้า:</b></td>
  </tr>
  <php 
      $i='1';
      $sql = "SELECT * FROM `order` WHERE order_number='$order_number'";
      $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      foreach( $result as $value ) {
  ?>
  <tr style="background:#F9B399;border: 1px solid black;">
    <td colspan="15">
      <php echo $i; ?>.
      <input type="hidden" name="order_img" value="<php echo $value['order_img']; ?>">
      <php echo $value['order_name']; ?> | <input type="hidden" name="order_name" value="<php echo $value['order_name']; ?>">
      <b>x<php echo $value['order_ammo']; ?><input type="hidden" name="order_ammo" value="<php echo $value['order_ammo']; ?>"></b>
      <b>Size: <php echo $value['order_size']; ?><input type="hidden" name="order_size" value="<php echo $value['order_size']; ?>"></b>
      <input type="hidden" name="order_price" value="<php echo $value['order_price']; ?>">
      <i><php echo $value['order_total']; ?>.-<input type="hidden" name="order_total" value="<php echo $value['order_total']; ?>"></i>
    </td>
  </tr>
        
  ?php $i++; } ?>
  <tr style="line-height:25px; background:#F9B399;border: 1px solid black;">
    <td colspan="15" style="padding-top:15px;">
    <b>ค่าขนส่ง: </b><= $order_delivery; ?><input type="hidden" name="order_delivery" value="<= $order_delivery; ?>"><br>
    <b>ยอดรวมที่ต้องชำระ: </b><i><= $total; ?></i> บาท<input type="hidden" name="total" value="<= $total; ?>">
    </td>
  </tr>
  <tr>
    <td colspan="15" style="height:20px;"></td>
  </tr>
  <php 
      echo "<tr>";
      echo "<td colspan='11'><input type='submit' name='submit' value='บันทึก'></td>";
      echo "</tr>"; 
      echo "</form>"; 
       
      endforeach; 
    } 
  ?> -->
  <?php endforeach; } ?>
  </table>
</table>
<div class="pagination">
    <a href="status_order.php?page=1" aria-label="Previous">
      <span aria-hidden="true">&laquo;</span>
    </a>
    <?php for($i=1;$i<=$total_page;$i++) { ?>
    <a href="status_order.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php } ?>
    <a href="status_order.php?page=<?php echo $total_page;?>" aria-label="Next">
      <span aria-hidden="true">&raquo;</span>
    </a>
</div>

<script>

  [].forEach.call(document.querySelectorAll(".modal-btn"), (el, i) => {
    el.addEventListener("click", (e) => {
      el.nextElementSibling.style.display = "block";
    });
  });

  [].forEach.call(document.querySelectorAll(".close"), (el, i) => {
    el.addEventListener("click", (e) => {
      el.parentElement.parentElement.style.display = "none";
    });
  });
</script>
<?php
  require 'template/front/footer.php';
?>
