<?php
    session_start();
    if (isset($_POST['username'])) {
        include('connect.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordenc = md5($password);
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$passwordenc'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            //$_SESSION['user'] = $row['fname'] . " " . $row['lname'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['nphone'] = $row['nphone'];
            $_SESSION['waddress'] = $row['waddress'];
            $_SESSION['userlevel'] = $row['userlevel'];
            if ($_SESSION['userlevel'] == '2') { //admin
                header("Location: admin_control.php");
            }
            if ($_SESSION['userlevel'] == '1') { //user
                header("Location: index.php");
            }
        } else {
            echo "<script>";
            echo "alert(\" user หรือ  password ไม่ถูกต้อง\");";
            echo "window.history.back()";
            echo "</script>";
        }
    } else {
        header("Location: index.php");
    }
?>
