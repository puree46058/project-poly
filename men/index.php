<?php
  session_start();
  error_reporting(~E_NOTICE);
  require 'connect.php';
  if (!isset($_SESSION['id'])) {
  require 'template/front/header.php';
  } else {
    require 'template/back/header.php';
  }
?>
  <!-- เนื้อหา(content) -->
<?php
  require 'body.php';
?>
    <!-- <img class="dress-card-img-top" src="img/w1.jpg" alt=""> -->
<?php
  require 'template/front/footer.php';
?>
