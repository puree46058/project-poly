<?php
    session_start();
    require_once "connect.php";
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $birthday = $_POST['birthday'];
        $nphone = $_POST['nphone'];
        $waddress = $_POST['waddress'];
        $user_check = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);
        if ($user['username'] === $username) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $passwordenc = md5($password);
            $query = "INSERT INTO user (username, password, fname, lname , birthday, nphone, waddress, userlevel)
                        VALUE ('$username', '$passwordenc', '$fname', '$lname', '$birthday','$nphone','$waddress','1')";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $_SESSION['success'] = "Insert user successfully";
                header("Location: login.php");
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: index.php");
            }
        }
    }
?>
<?php
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
    //require 'template/front/header.php';
    require 'template/front/header.php';
  } else {
    echo "<script>";
    echo "window.history.back();";
    echo "</script>";
  }
?>
    <div class="bbcolor w3-content">
        <center><img src="img/logo-box.png" width="100%;" height="150px;">
        <div class="reg-text">
            <div class="little-reg">
                <font class="font-kanit"><b>สมัครสมาชิก</b></font>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <font class="font-kanit">ชื่อผู้ใช้:<font color="red">*</font> </font><br><input type="text" name="username" maxlength="30" size="30" required><br><br>
            <font class="font-kanit">รหัสผ่าน:<font color="red">*</font> </font><br><input type="password" name="password" maxlength="30" size="30" required><br><br>
            <font class="font-kanit">ชื่อ:<font color="red">*</font> </font><br><input type="text" maxlength="30" size="30" name="fname" required>
            <div class="right-reg">
                <font class="font-kanit">นามสกุล:<font color="red">*</font> </font><br><input type="text" maxlength="30" size="30" name="lname" required>
            </div>
            <div class="reg-birth">
                <font class="font-kanit">วันเกิด:<font color="red">*</font> </font><br><input type="date" name="birthday" required>
            </div>
            <div class="right-reg-2">
                <font class="font-kanit">เบอร์โทรศัพท์:<font color="red">*</font> </font><br><input type="text" maxlength="10" size="30" name="nphone" required>
            </div>
            <div class="reg-address">
                <font class="font-kanit">ที่อยู่:<font color="red">*</font> </font><br><textarea rows="3" cols="87" name="waddress" required></textarea>
            </div>
            <br>
            <font color="red" class="font-kanit" style="font-size:15px;padding-left:805px;">* ฟิลต์ที่จำเป็น</font>
            <div style="height:8px;"></div>
            <input type="submit" value="ยืนยัน" class="button-ok" name="submit">
            </form>
        </div>
    </div>
    <div style="height:30%;"></div>
    <!-- <img class="dress-card-img-top" src="img/w1.jpg" alt=""> -->
<?php
  require 'template/front/footer.php';
?>
