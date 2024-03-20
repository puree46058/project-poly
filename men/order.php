<?php
  session_start();
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
    header("Location: login.php");
  } else {
    require 'template/back/header.php';
  }
?>
<table class="w3-content" border="0" width="70%" height="20%" style="border-collapse: collapse;">
  <tr>
    <td colspan="4"><h2><font class="font-kanit">คำสั่งซื้อของฉัน</font></h2></td>
  </tr>
  <?php
      include('connect.php');
      $id_user = $_SESSION['id'];

      $sql = "SELECT * FROM ((select id_user,fname,lname,nphone,waddress,bank,pro_img,product_name,product_size,product_price,product_ammo,
      product_total,product_delivery,total,order_number,status_order,number_tracking,Date_Current from `pay_notification`) 
              union (select id_user,fname,lname,nphone,waddress,bank,pro_img,product_name,product_size,product_price,product_ammo,
      product_total,product_delivery,total,order_number,status_order,number_tracking,Date_Current from `order`)) 
              as o WHERE `id_user`='$id_user' GROUP BY `order_number` ORDER BY `Date_Current` DESC";
      $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
      //echo "<pre>", print_r($row) , "</pre>";
      if($row ) {
        foreach ($row as $key => $value):
          $fname = $value['fname'];
          $lname = $value['lname'];
          $nphone = $value['nphone'];
          $waddress = $value['waddress'];
          $bank =  $value['bank'];

          $pro_img = $value['pro_img'];
          $product_name = $value['product_name'];
          $product_size = $value['product_size'];
          $product_price = $value['product_price'];
          $product_ammo = $value['product_ammo'];
          $product_total = $value['product_total'];
          $product_delivery = $value['product_delivery'];
          $total = $value['total'];
          $order_number = $value['order_number'];
          $status_order = $value['status_order'];
          $number_tracking = $value['number_tracking'];
          $Date_Current = $value['Date_Current'];

          echo "<br>";
          echo "<table class='w3-content box-order' border='0' width='70%' height='20%' style=''>";
            echo "<tr>";
              echo "<input type='hidden' name='id_user' value='".$id_user."'>";
              echo "<td colspan='5' style='padding-bottom:10px;letter-spacing: 0.6px;'><b>หมายเลขคำสั่งซื้อ:</b> ".$order_number."</td>";
              echo "<td style='text-align:right;' colspan='2'><b>ค่าขนส่ง:</b> +".$product_delivery." บาท</td>";
            echo "</tr>";
    
            $id_user = $_SESSION['id'];
            $sql = "SELECT * FROM ((select id_user,fname,lname,nphone,waddress,bank,pro_img,product_name,product_size,product_price,product_ammo,
            product_total,product_delivery,total,order_number,status_order,number_tracking,Date_Current from `pay_notification`) 
                    union (select id_user,fname,lname,nphone,waddress,bank,pro_img,product_name,product_size,product_price,product_ammo,
            product_total,product_delivery,total,order_number,status_order,number_tracking,Date_Current from `order`)) 
                    as o WHERE order_number='$order_number' AND id_user='$id_user'";
            $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
            while($row = mysqli_fetch_array($result)) {
            echo "<tr style='letter-spacing: 0.6px;'>";
              echo "<td width='130px'><img src='upload/".$row['pro_img']."' width='130px'></td>";
              echo "<td colspan='2'>".$row['product_name']."</td>";
              echo "<td align='center'>Qty: ".$row['product_ammo']."</td>";
              echo "<td align='center'>ไซส์: ".$row['product_size']."</td>";
              echo "<td align='center'>ราคา: ".$row['product_price']." บาท</td>";
              echo "<td align='center'>ราคารวม: ".$row['product_total']." บาท</td>";
            echo "</tr>";
            }
            echo "<tr>";
              echo "<td colspan='6' style='padding-top:10px;letter-spacing: 0.6px;'><b>การชำระ:</b> ".$bank."</td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td colspan='5' style='padding-top:5px;letter-spacing: 0.6px;'><b>เลขพัสดุ:</b> ".$number_tracking."</td>";
              echo "<td style='text-align:right;letter-spacing: 0.6px;' colspan='2'><b>ยอดรวม</b> ".$total." บาท</td>";
            echo "</tr>";
            echo "<tr>";
              echo "<td colspan='5' style='padding-top:5px;letter-spacing: 0.6px;'><b>วันที่สั่งซื้อ:</b> ".$Date_Current."</td>";
              echo "<td style='text-align:right;letter-spacing: 0.6px;' colspan='2'><b>สถานะ</b> ".$status_order."</td>";
            echo "</tr>";
          echo "</table>";
        endforeach;
      } else {
        echo "<td style='border: 1px solid black;text-align:center;background:#8C8989;'><i>คุณยังไม่มีคำสั่งซื้อใดๆ</i></td>";
      }
    ?>
</table>
<?php
  require 'template/front/footer.php';
?>
