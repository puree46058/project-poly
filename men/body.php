<div class="w3-content w3-display-container" style="max-width: 100%;"> <!-- max-width: 1400px; -->
  <img class="mySlides" src="img/img1.png" style="width:100%">
  <img class="mySlides" src="img/img2.png" style="width:100%">
  <!-- <img class="mySlides" src="img/img-top3.png" style="width:100%"> -->
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
    <!-- <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span> -->
  </div>
</div>
<div class="container">
  <h1><center><font class="font-kanit">สินค้ามาใหม่</font></center></h1>
  <br>
  <div class="w3-content w3-center">
    <a href="index.php" class="block-sex">เสื้อคอกลม</a>
    <!-- <a href="../women/index.php" class="block-sex">WOMEN</a> -->
  </div>
  <br><br>
  <br>
  <?php
      include('connect.php'); //limit 0,6
      $sql = "SELECT*FROM `pro_product` ORDER BY `create_time` DESC limit 0,6";
      $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
  ?>
  <div class="rowsor w3-content w3-row-padding">
    <?php while($row = mysqli_fetch_array($result)) { ?>
      <div class="column w3-row-padding">
        <!-- <a target="_blank" href="upload/<php echo $row['pro_img'] ?>">
          <img src="upload/<php echo $row['pro_img'] ?>" class="imgbox-shop">
        </a>-->
        <a href="detail-t-shirt.php?pro_id=<?php echo $row['pro_id']; ?>"><img src="upload/<?php echo $row['pro_img'] ?>" class="imgbox-shop"></a>
        <div class="text-nameshop">
          <a href="detail-t-shirt.php?pro_id=<?php echo $row['pro_id']; ?>" style="text-decoration:none;" class="font-prompt"><?php echo $row['pro_name'] ?></a>
        </div>
        <div class="price-shop">
          <?php
            if($row['price_s'] == '' || $row['qty_s'] == '0') {
              if($row['price_m'] == '' || $row['qty_m'] == '0') {
                if($row['price_l'] == '' || $row['qty_l'] == '0') {
                  if($row['price_xl'] == '' || $row['qty_xl'] == '0') {
                    if($row['price_s'] == '' || $row['price_m'] == '' || $row['price_l'] == '' || $row['price_xl'] == '' || $row['qty_s'] == '0' || $row['qty_m'] == '0' || $row['qty_l'] == '0' || $row['qty_xl'] == '0')
                    {
                      echo "<font color='red' class='font-prompt'>*สินค้าหมด*</font>";
                    }
                  } else {
                      echo $row['price_xl']." บาท";
                  }
                } else {
                    echo $row['price_l']." บาท";
                }
              } else {
                  echo $row['price_m']." บาท";
              }
            } else {
                echo $row['price_s']." บาท";
            }
          ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
