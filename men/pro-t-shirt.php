<?php
  session_start();
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
  require 'template/front/header.php';
  } else {
    require 'template/back/header.php';
  }
?>
  <!-- เนื้อหา(content) -->
    <!-- Pagination -->
    <?php
      include('connect.php');
      $perpage = 12;
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }

      $start = ($page - 1) * $perpage;

      $sqlpro = "SELECT*FROM pro_product where pro_category_id='1' ORDER BY create_time DESC limit {$start} , {$perpage}";
      $result = mysqli_query($conn, $sqlpro) or die (mysqli_error($conn));
    ?>
    <?php
      $sqlpro2 = "SELECT*FROM pro_product";
      $result2 = mysqli_query($conn, $sqlpro2);
      $total_record = mysqli_num_rows($result2);
      $total_page = ceil($total_record / $perpage);
    ?>
    <div class="pagination">
        <a href="pro-t-shirt.php?page=1" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
        <?php for($i=1;$i<=$total_page;$i++) { ?>
        <a href="pro-t-shirt.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php } ?>
        <a href="pro-t-shirt.php?page=<?php echo $total_page;?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
    </div>
    <!-- while($row = mysqli_fetch_array($result)) -->
    <div class="rowsor w3-content w3-row-padding">
          <?php while($row = mysqli_fetch_array($result)) { ?>
          <div class="column w3-row-padding">
            <!-- <a target="_blank" href="upload/<php echo $row['pro_img'] ?>">
              <img src="upload/<php echo $row['pro_img'] ?>" class="imgbox-shop">
            </a> -->
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
<?php
  require 'template/front/footer.php';
?>
