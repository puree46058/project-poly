<?php
  session_start();
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
  <table border="0" style="margin-left:150px;padding: 15px;border-collapse: collapse;">
    <tr>
      <td colspan="16"><font size="6" class="font-kanit">แก้ไข/ลบ รายการสินค้า</font></td>
    </tr>
    <tr align="center" style="background-color: #262626;color: #F5E474;font-size:14px;">
      <td style="border: 1px solid grey;"><b><i>ID</i></b></td>
      <td style="border: 1px solid grey;"><b><i>ประเภทสินค้า</i></b></td>
      <td style="border: 1px solid grey;"><b><i>ชื่อสินค้า</i></b></td>
      <td style="border: 1px solid grey;"><b><i>สี</i></b></td>
      <td style="border: 1px solid grey;"><b><i>จำนวนไซส์ S</i></b></td>
      <td style="border: 1px solid grey;"><b><i>ราคาไซส์ S</i></b></td>
      <td style="border: 1px solid grey;"><b><i>จำนวนไซส์ M</i></b></td>
      <td style="border: 1px solid grey;"><b><i>ราคาไซส์ M</i></b></td>
      <td style="border: 1px solid grey;"><b><i>จำนวนไซส์ L</i></b></td>
      <td style="border: 1px solid grey;"><b><i>ราคาไซส์ L</i></b></td>
      <td style="border: 1px solid grey;"><b><i>จำนวนไซส์ XL</i></b></td>
      <td style="border: 1px solid grey;"><b><i>ราคาไซส์ XL</i></b></td>
      <td style="border: 1px solid grey;"><b><i>รูปภาพสินค้า</i></b></td>
      <td colspan="3" style="border: 1px solid grey;"><b><i>รายละเอียด</i></b></td>
      <!-- <td></td>
      <td></td> -->
    </tr>
    <?php
      include('connect.php');
      //$sql = "SELECT pp.*,pc.pro_category_name FROM pro_product as pp INNER JOIN pro_category as pc ON pc.pro_category_id = pp.pro_category_id";
      $perpage = 12;
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }

      $start = ($page - 1) * $perpage;


      $sql = "SELECT*FROM pro_product";
      $result2 = mysqli_query($conn, $sql);
      $total_record = mysqli_num_rows($result2);
      $total_page = ceil($total_record / $perpage);


    //  $sqlpro = "SELECT*FROM pro_product where pro_id limit {$start} , {$perpage}";
      $sql = "SELECT pp.*,pc.pro_category_name FROM pro_product as pp INNER JOIN pro_category as pc ON pc.pro_category_id = pp.pro_category_id where pro_id limit {$start} , {$perpage}";
      $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      //$result = mysqli_query($conn, $sqlpro) or die (mysqli_error($conn));
      $row = mysqli_fetch_array($result);
      //extract($row);
    ?>
    <?php  while($row = mysqli_fetch_array($result)) { ?>
    <tr align="center" style="background:snow;font-family: 'Karla', sans-serif;">
      <input type="hidden" name="pro_id" value="<?php echo $row['pro_id']; ?>">
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['pro_id']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['pro_category_name']; ?></td>
      <td align="left" style="border-bottom: 1px solid #C2BBA4"><?php echo $row['pro_name']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['pro_color']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['qty_s']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['price_s']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['qty_m']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['price_m']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['qty_l']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['price_l']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['qty_xl']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['price_xl']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><img src="upload/<?php echo $row['pro_img'] ?>" class="imgbox-shop-manage"></td>
      <td style="border-bottom: 1px solid #C2BBA4"><?php echo $row['pro_detail']; ?></td>
      <td style="border-bottom: 1px solid #C2BBA4"><a href='editproduct.php?pro_id=<?php echo $row['pro_id']; ?>' style="width:50px;background:#E9CF3F;display: inline-block;text-decoration:none;border:1px solid;padding:3px;">แก้ไข</a></td>
      <td style="border-bottom: 1px solid #C2BBA4"><a href='delproduct.php?pro_id=<?php echo $row['pro_id']; ?>' style="width:40px;background:#D42E1E;display: inline-block;text-decoration:none;border:1px solid;padding:3px;">ลบ</a></td>
      <!-- onclick=\"return confirm('Do you want to delete product? !!!')" -->
    </tr>
    <?php } ?>
  </table>
  <div class="pagination">
      <a href="manage_product.php?page=1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
      <?php for($i=1;$i<=$total_page;$i++) { ?>
      <a href="manage_product.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
      <?php } ?>
      <a href="manage_product.php?page=<?php echo $total_page;?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
  </div>
<?php
  require 'template/front/footer.php';
?>
