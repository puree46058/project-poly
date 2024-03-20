<?php
    //$conn = mysqli_connect("localhost", "stupolyIT", "datastupolyIT@291117", "db_skytshirt"); //ยืม host วิลัย 1 Days
    //$conn = mysqli_connect("localhost", "skytshir", "7k!Z[4mNgJ06pM", "skytshir_database");
    $conn = mysqli_connect("localhost", "root", "", "db_skytshirt"); //host ตัวเองแสดง OfFline
    mysqli_set_charset($conn, 'utf8');
    if (!$conn) {
        die("Failed to connec to database" . mysqli_error($conn));
    }
?>
