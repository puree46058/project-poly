<?php
  session_start();
  require_once "connect.php";
  if (isset($_POST['submit'])) {
    //$pro_id = $_POST['pro_id'];
    $pro_id = $_POST['pro_id'];
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
    /*$ext = pathinfo(basename($_FILES['pro_img']['name']), PATHINFO_EXTENSION);
    $new_image_name = 'img_'.uniqid().".".$ext;
    $image_path = 'upload/';
    $upload_path = $image_path.$new_image_name;
    $success = move_uploaded_file($_FILES['pro_img']['tmp_name'],$upload_path);

    $pro_img = $new_image_name;*/

    if($_FILES['pro_img']['name']!=""){ // มีอัพโหลดไฟล์
        //โฟลเดอร์ที่เก็บไฟล์
        $path="upload/";

        //ตัวขื่อกับนามสกุลภาพออกจากกัน
        $arrType = explode(".",$_FILES['pro_img']['name']); // แยกชื่อไฟล์ด้วย . เป็น array
        $type = array_pop($arrType);     // เอา array ตัวสุดท้ายมาเป็น นามสกุลไฟล์
        $numrand = "img_".uniqid();  // กำหนดชื่อรูปแบบไฟล์ใหม่ที่ต้องการ
        $nawe = $numrand.".".$type;  // สร้่างรูปแบบชื่อไฟล์ใหม่ โดยต่อเข้ากับนามสกุล

        $path_copy = $path.$nawe;  // กำหนด path ไฟล์ที่จะจัดเก็บ
            //คัดลอกไฟล์ไปยังโฟลเดอร์

        // หรือจะใส่เงื่อนไขอีกก็ได้
        if(!move_uploaded_file($_FILES['pro_img'] ['tmp_name'],$path_copy)){ // อัพโหลดไม่สำเร็จ
            $nawe = $_POST['pro_img']; // ใช้ชื่อเดิม จาก input hidden ที่ส่งมา
        }else{ // อัพโหลดรูปผ่าน
            // อาจทำคำสัี่งลบรูปเดิม
            @unlink($path.$_POST['pro_img']);
        }
    }else{ // ไม่มีการอัพโหลดไฟล์
        $nawe = $_POST['pro_img']; // ใช้ชื่อเดิม จาก input hidden ที่ส่งมา
    }

    $sql = "UPDATE pro_product SET
    pro_category_id='$pro_category_id',
    pro_name='$pro_name',
    pro_color='$pro_color',
    qty_s='$qty_s',
    price_s='$price_s',
    qty_m='$qty_m',
    price_m='$price_m',
    qty_l='$qty_l',
    price_l='$price_l',
    qty_xl='$qty_xl',
    price_xl='$price_xl',
    pro_img='$nawe',
    pro_detail='$pro_detail'
    WHERE pro_id='$pro_id'";

    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    mysqli_close($conn);
    if($result) {
      echo "<script type='text/javascript'>";
      echo "alert('แก้ไขสินค้าสำเร็จ!');";
      echo "window.location = 'manage_product.php?page=1';";
      echo "</script>";
    } else {
      echo "<script type='text/javascript'>";
      echo "window.location = 'manage_product.php?page=1';";
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

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
  <table style="margin-left:150px;padding: 60px;" border="0">
    <tr>
      <td colspan="2"><font size="6" class="font-kanit"><b>แก้ไขสินค้า</b></font></td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td colspan="1">ID: </td>
      <td><input type="text" name="pro_id" size="7" value="<?php echo $_GET['pro_id']; ?>" disabled></td></td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td colspan="1">ประเภทสินค้า: </td>
      <td>
        <?php
          $sql = "SELECT*FROM `pro_category` ORDER BY `pro_category_id` ASC";
          $result = mysqli_query($conn, $sql);
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
      include('connect.php');
      /*if($_GET["pro_id"]== '') {
        require 'template/front/header.php';
      }
      $pro_id = mysqli_real_escape_string($conn,$_GET['pro_id']);*/
      $pro_id = $_GET['pro_id'];
      /*$pro_category_id = $_GET['pro_category_id'];
      $pro_name = $_GET['pro_name'];
      $pro_color = $_GET['pro_color'];
      $qty_s = $_GET['qty_s'];
      $price_s = $_GET['price_s'];
      $qty_m = $_GET['qty_m'];
      $price_m = $_GET['price_m'];
      $qty_l = $_GET['qty_l'];
      $price_l = $_GET['price_l'];
      $qty_xl = $_GET['qty_xl'];
      $price_xl = $_GET['price_xl'];
      $pro_img = $_GET['pro_img'];
      $pro_detail = $_GET['pro_detail'];*/


      $sql = "SELECT * FROM `pro_product` WHERE `pro_id`='$pro_id'";
      $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      $row = mysqli_fetch_array($result);
      //extract($row);

      /*$pro_category_id = $row['pro_category_id'];
      $pro_name = $row['pro_name'];
      $pro_color = $row['pro_color'];
      $qty_s = $row['qty_s'];
      $price_s = $row['price_s'];
      $qty_m = $row['qty_m'];
      $price_m = $row['price_m'];
      $qty_l = $row['qty_l'];
      $price_l = $row['price_l'];
      $qty_xl = $row['qty_xl'];
      $price_xl = $row['price_xl'];
      $pro_img = $row['pro_img'];
      $pro_detail = $row['pro_detail'];*/
    ?>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <input type="hidden" name="pro_id" value="<?php echo $row['pro_id']; ?>">
      <td colspan="1">ชื่อสินค้า: </td>
      <td><input type="text" name="pro_name" size="30px" maxlength="250" value="<?php echo $row['pro_name']; ?>" required></td></td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td>สี:</td>
      <td><input type="checkbox" name="pro_color" value="ขาว"> ขาว</td>
      <td></td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td>ไซส์: </td> <!-- <input type="checkbox" name="pro_size_s" value="pro_size_s"> -->
      <td colspan="2">S จำนวน: <input type="text" name="qty_s" size="3px" maxlength="4" value="<?php echo $row['qty_s']; ?>">
      ราคา/ตัว: <input type="text" name="price_s" size="7px" maxlength="7" value="<?php echo $row['price_s']; ?>">บาท
      </td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td></td>
      <td colspan="2">M จำนวน: <input type="text" name="qty_m" size="3px" maxlength="4" value="<?php echo $row['qty_m']; ?>">
        ราคา/ตัว: <input type="text" name="price_m" size="7px" maxlength="7" value="<?php echo $row['price_m']; ?>">บาท
      </td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td></td>
      <td colspan="2">L จำนวน: <input type="text" name="qty_l" size="3px" maxlength="4" value="<?php echo $row['qty_l']; ?>">
        ราคา/ตัว: <input type="text" name="price_l" size="7px" maxlength="7" value="<?php echo $row['price_l']; ?>">บาท
      </td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td></td>
      <td colspan="2">XL จำนวน: <input type="text" name="qty_xl" size="3px" maxlength="4" value="<?php echo $row['qty_xl']; ?>">
        ราคา/ตัว: <input type="text" name="price_xl" size="7px" maxlength="7" value="<?php echo $row['price_xl']; ?>">บาท
      </td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td colspan="3"><hr color="black" width="190px"></td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td></td>
      <td><img src="upload/<?php echo $row['pro_img'] ?>" width="140px" height="150px"></td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td colspan="1">รูปภาพประกอบ: </td>
      <td>
        <input type="file" name="pro_img">
        <input type="hidden" name="pro_img" class="form-control" value="<?php echo $row['pro_img']; ?>">
      </td>
    </tr>
    <tr style="font-family: 'Karla', sans-serif;font-size:18px;">
      <td colspan="1">รายละเอียด:</td>
      <td colspan="2"><textarea name="pro_detail" class="form-control"  rows="4" cols="40" value="<?php echo $row['pro_detail']; ?>" required></textarea></td>
    </tr>
    <tr>
      <td colspan="2" height="25px"></td>
    </tr>
    <tr>
      <td><!-- <a href="addproduct_check.php" style="width:25px;height:20px;background:#09B607;color:snow;padding: 8px;
      text-align: center;text-decoration:none;border: 2px solid black;">เพิ่มสินค้า</a> -->
        <input type="submit" name="submit" value="บันทึกสินค้า" style="background:#09B607;color:snow;padding: 8px;
        text-align: center;text-decoration:none;border: 2px solid black;">
      </td>
    </tr>
  </table>
</form>

<?php
  require 'template/front/footer.php';
?>
