<?php
    session_start();
    require_once "connect.php";
    if (isset($_POST['submit'])) {
        $pro_category_id = $_POST['pro_category_id'];
        $pro_name = $_POST['pro_name'];
        $pro_color = $_POST['pro_color'];
        $qty_s = $_POST['qty_s'];
        $price_s = $_POST['price_s'];
        $qty_m = $_POST['qty_m'];
        $price_m = $_POST['price_m'];
        $qty_l = $_POST['qty_l'];
        $price_l = $_POST['price_l'];
        $qty_xl = $_POST['qty_xl'];
        $price_xl = $_POST['price_xl'];
        $pro_img = $_POST['pro_img'];
        $pro_detail = $_POST['pro_detail'];

        //Upload img
        $ext = pathinfo(basename($_FILES['pro_img']['name']), PATHINFO_EXTENSION);
        $new_image_name = 'img_'.uniqid().".".$ext;
        $image_path = 'upload/';
        $upload_path = $image_path.$new_image_name;

        $success = move_uploaded_file($_FILES['pro_img']['tmp_name'],$upload_path);
        if($success == FALSE) {
          echo "ไม่สามารถ Upload รูปภาพได้";
          exit();
        }
        $pro_img = $new_image_name;


        //$addpro = "SELECT * FROM pro_product";
        //$result = mysqli_query($conn, $addpro);

        //$user = mysqli_fetch_assoc($result);
        /*if ($user['username'] === $username) {
            echo "<script>alert('Username already exists');</script>";*/
        //} else {
        $query = "INSERT INTO pro_product (pro_category_id,pro_name, pro_color, qty_s, price_s, qty_m, price_m, qty_l, price_l, qty_xl, price_xl, pro_img, pro_detail)
                  VALUES ('$pro_category_id','$pro_name', '$pro_color', '$qty_s', '$price_s', '$qty_m','$price_m','$qty_l','$price_l','$qty_xl','$price_xl','$pro_img','$pro_detail')";
        $result = mysqli_query($conn, $query);
        if ($result)
        {
            $_SESSION['success'] = "add product successfully";
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
    if($_SESSION['userlevel'] != 2) {
      echo "<script>";
      echo "window.history.back();";
      echo "</script>";
    } 
  }
?>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<table style="margin-left:150px;padding: 60px;" border="0">
  <tr>
    <td colspan="2"><font size="6" class="font-kanit"><b>เพิ่มสินค้า</b></font></td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td colspan="1">ประเภทสินค้า: </td>
    <td>
      <?php
        //include ('connect.php');
        //$pro_c = "SELECT * FROM pro_category";
        //$pro_c = "SELECT*FROM pro_category ORDER BY pro_category_id ASC"; เดิมใช้อันนี้ เปิดดูว่า ไอดีนี้มีกี่แบบ
        $pro_c = "SELECT*FROM pro_category WHERE pro_category_id='1'";
        //$pro_c = "SELECT pp.pro_category_id,pc.pro_category_name FROM pro_category as pc INNER JOIN pro_product as pp ON pc.pro_category_id = pp.pro_category_id";
        $result = mysqli_query($conn, $pro_c);
      ?>
      <select name="pro_category_id">
        <?php
          while($row = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo $row['pro_category_id'] ?>"><?php echo $row['pro_category_name'] ?></option>
        <?php } ?>
      </select>
    </td>
  </tr>
  <?php
    
  ?>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td colspan="1">ชื่อสินค้า: </td>
    <td><input type="text" name="pro_name" size="30px" maxlength="250" required placeholder=""></td></td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td>สี:</td>
    <td><input type="checkbox" name="pro_color" value="ขาว" required> ขาว</td>
    <td></td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td>ไซส์: </td> <!-- <input type="checkbox" name="pro_size_s" value="pro_size_s"> -->
    <td colspan="2">S จำนวน: <input type="text" name="qty_s" size="3px" maxlength="4" placeholder="">
    ราคา/ตัว: <input type="text" name="price_s" size="7px" maxlength="7" placeholder="ระบุ/ตัว">บาท
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td></td>
    <td colspan="2">M จำนวน: <input type="text" name="qty_m" size="3px" maxlength="4" placeholder="">
      ราคา/ตัว: <input type="text" name="price_m" size="7px" maxlength="7" placeholder="ระบุ/ตัว">บาท
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td></td>
    <td colspan="2">L จำนวน: <input type="text" name="qty_l" size="3px" maxlength="4" placeholder="">
      ราคา/ตัว: <input type="text" name="price_l" size="7px" maxlength="7" placeholder="ระบุ/ตัว">บาท
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td></td>
    <td colspan="2">XL จำนวน: <input type="text" name="qty_xl" size="3px" maxlength="4" placeholder="">
      ราคา/ตัว: <input type="text" name="price_xl" size="7px" maxlength="7" placeholder="ระบุ/ตัว">บาท
    </td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td colspan="3"><hr color="black" width="190px"></td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td colspan="1">รูปภาพประกอบ:</td>
    <td><input type="file" name="pro_img" class="form-control" required></td>
  </tr>
  <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
    <td colspan="1">รายละเอียด:</td>
    <td colspan="2"><textarea name="pro_detail" class="form-control"  rows="4" cols="40" required placeholder="รายละเอียดสินค้า"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" height="25px"></td>
  </tr>
  <tr>
    <td><!-- <a href="addproduct_check.php" style="width:25px;height:20px;background:#09B607;color:snow;padding: 8px;
    text-align: center;text-decoration:none;border: 2px solid black;">เพิ่มสินค้า</a> -->
      <input type="submit" name="submit" value="เพิ่มสินค้า" style="background:#09B607;color:snow;padding: 8px;
      text-align: center;text-decoration:none;border: 2px solid black;">
    </td>
  </tr>
</table>
</form>
<?php
  require 'template/front/footer.php';
?>
