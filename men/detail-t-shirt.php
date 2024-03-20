<?php
  session_start();
  error_reporting(~E_NOTICE);
  if (!isset($_SESSION['id'])) {
  require 'template/front/header.php';
  } else {
    require 'template/back/header.php';
  }
?>
<?php
  include('connect.php');
  $pro_id = $_GET['pro_id'];

  $sql = "SELECT * FROM pro_product WHERE pro_id=$pro_id";
  $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
  $row = mysqli_fetch_array($result);
?>
<script>
function imageZoom(imgID, resultID) {
  var img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /*create lens:*/
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /*insert lens:*/
  img.parentElement.insertBefore(lens, img);
  /*calculate the ratio between result DIV and lens:*/
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /*set background properties for the result DIV:*/
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
  /*execute a function when someone moves the cursor over the image, or the lens:*/
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  /*and also for touch screens:*/
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  
  /*initialise and hide lens result*/
  result.style.display = "none";
  /*Reveal and hide on mouseover or out*/
  lens.onmouseover = function(){result.style.display = "block";};
  lens.onmouseout = function(){result.style.display = "none";};
  
  function moveLens(e) {
    var pos, x, y;
    /*prevent any other actions that may occur when moving over the image:*/
    e.preventDefault();
    /*get the cursor's x and y positions:*/
    pos = getCursorPos(e);
    /*calculate the position of the lens:*/
    x = pos.x - (lens.offsetWidth / 2);
    y = pos.y - (lens.offsetHeight / 2);
    /*prevent the lens from being positioned outside the image:*/
    if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
    if (x < 0) {x = 0;}
    if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
    if (y < 0) {y = 0;}
    /*set the position of the lens:*/
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /*display what the lens "sees":*/
    result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
  }
  function getCursorPos(e) {
    var a, x = 0, y = 0;
    e = e || window.event;
    /*get the x and y positions of the image:*/
    a = img.getBoundingClientRect();
    /*calculate the cursor's x and y coordinates, relative to the image:*/
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /*consider any page scrolling:*/
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
};

//imageZoom("myimage", "myresult");
</script>
<form id="form_checkbox1" name="form_checkbox1" method="POST" action="mycart.php">
<table class="w3-content" border="0" width="100%" height="800px" >
  <tr height="35px">
    <td colspan="2"></td>
  </tr>
  <tr height="5px">
    <td width="450px" rowspan="8">
      <input type="hidden" name="pro_id" value="<?php echo $row['pro_id']; ?>">
      <div class="img-zoom-container">
        <div id="myCarousel" class="carousel slide" data-interval="false">

          <div class="carousel-inner">
            <div class="item active">        
              <img id="myimage" src="upload/<?php echo $row['pro_img'] ?>" width="450px">
              <div id="myresult" class="img-zoom-result" style=""></div>
            </div>
            <div class="item">
              <img src="img/men-tshirt/back-tshirt.png" width="450px" height="500px">
            </div>
            <div class="item">
              <img src="img/men-tshirt/size-t-shirt.png" width="450px" height="500px">
            </div>
          </div>
        </div>
      </div>
      <script>
        imageZoom("myimage", "myresult");
      </script><!-- <img src="http://placehold.it/1600x700?text=Product+01"> /*ภาพตัวอย่าง 01*/-->
      

      <div class="row">
        <div class="span5">
          <div class="well"> 
            <div id="myCarousel" class="carousel slide" data-interval="false">
              
              <!--<ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              </ol> -->
              
              <!-- Carousel items -->
              <div class="carousel-inner">
                  
                <div class="item active">
                  <div class="row-fluid" style="padding-left:66px;">
                    <div class="span4"><a data-target="#myCarousel" data-slide-to="0" class="active"><img src="upload/<?php echo $row['pro_img'] ?>" style="max-width:100%;height:110px;" class="show-img"/></a></div>
                    <div class="span4"><a data-target="#myCarousel" data-slide-to="1"><img src="img/men-tshirt/back-tshirt.png" style="max-width:100%;height:110px;" class="show-img"/></a></div>
                    <div class="span4"><a data-target="#myCarousel" data-slide-to="2"><img src="img/men-tshirt/size-t-shirt.png" style="max-width:100%;height:110px;" class="show-img"/></a></div>   	  
                  </div><!--/row-fluid-->
                </div><!--/item-->
                
                <!--<div class="item">
                  <div class="row-fluid">
                    <div class="span4"><img src="http://placehold.it/1600x700?text=Product+04" style="max-width:100%;height:110px;" class="show-img" /></div>
                    <div class="span4"><img src="http://placehold.it/1600x700?text=Product+05" style="max-width:100%;height:110px;" class="show-img" /></div>
                    <div class="span4"><img src="http://placehold.it/1600x700?text=Product+06" style="max-width:100%;height:110px;"  class="show-img"/></div>
                  </div>
                </div>-->
      
              </div>
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
            </div>
          </div>
        </div>
      </div>
      <!--<script>
        $(document).ready(function() {
            $('#myCarousel').carousel({
              interval: 10000
          })
        });
      </script>-->

      <input type="hidden" name="pro_img" value="<?php echo $row['pro_img']; ?>">
    </td>
    <td class="text-line-hight"><input type="hidden" name="pro_name" value="<?php echo $row['pro_name']; ?>"><font size="5" class="font-prompt"><b><?php echo $row['pro_name']; ?></b></font></td>
  </tr>
  <?php
    if($row['qty_s'] > 0 || $row['qty_m'] > 0  || $row['qty_l'] > 0  || $row['qty_xl'] > 0 ) {
      echo "<tr height='30px'><td><font class='font-prompt'>สถานะสินค้า: </font><font color='green'> สินค้าพร้อมส่ง</font></td></tr>";
  ?>
  <tr height="5px">
    <td><font class="font-prompt"><b>สี: </b></font><input style="line-height:10pt;" type="text" name="pro_color" size="1" value="<?php echo $row['pro_color']; ?>" disabled></td>
  </tr>
  <tr height="5px">
    <td class="text-line-hight font-prompt"><b>ไซส์: </b>
      <?php
          if($row['qty_s'] >= '1') {
            ?>
            <input type='radio' value='<?php echo $row['price_s']; ?>' name='product_price' id='product_price' style='margin-left:8px;line-height:10pt;' onclick='myFunctionSize("S")'> S
            <?php
          } else {
            if($row['qty_s'] < '1' || $row['price_s'] == '') {
              echo "<input type='hidden'>"." ";
            }
          }
          if($row['qty_m'] >= '1') {
            ?>
            <input type='radio' value='<?php echo $row['price_m']; ?>' name='product_price' id='product_price' onclick='myFunctionSize("M")'style='margin-left:8px;line-height:10pt;'> M
            <?php
          } else {
            if($row['qty_m'] < '1' || $row['price_m'] == '') {
              echo "<input type='hidden'>"." ";
            }
          }
          if($row['qty_l'] >= '1') {
            ?>

            <input type='radio' value='<?php echo $row['price_l']; ?>' name='product_price' id='product_price' style='margin-left:8px;line-height:10pt;' onclick='myFunctionSize("L")'> L
            <?php
          } else {
            if($row['qty_l'] < '1' || $row['price_l'] == '') {
              echo "<input type='hidden'>"." ";
            }
          }
          if($row['qty_xl'] >= '1') {
            ?>

            <input type='radio' value='<?php echo $row['price_xl']; ?>' name='product_price' id='product_price' style='margin-left:8px;line-height:10pt;' onclick='myFunctionSize("XL")'> XL
            <?php
          } else {
            if($row['qty_xl'] < '1' || $row['price_xl'] == '') {
            echo "<input type='hidden'>"." ";
            }
          }
      ?>
    </td>
  </tr>
  <tr height='5px'>
    <td><font class="font-prompt"><b>จำนวน: </b></font>
      <input type='text' name='qty' id='qty' size='1' value="1" style="line-height:10pt;" require>
      <input type='button' style="line-height:15pt;" name='add' onclick='javascript:document.getElementById("qty").value++;' value='+'/>
      <input type='button' style="line-height:15pt;" name='subtract' onclick='QtyClick()' value='-'/>
    </td>
  </tr>
  <tr height="5px">
    <td class="text-line-hight"><font class="font-prompt"><b>ราคา:</b></font>
      <!-- <font id="sizet"></font> -->
      <font id="psize"></font>
    </td>
  </tr>
  <?php
    } else {
      echo "<tr><td><font class='font-prompt'><b>สี: </b></font><input style='line-height:10pt;' type='text' name='pro_color' size='1' value='".$row['pro_color']."' disabled></td></tr>";
      echo "<tr><td><font class='font-prompt'>สถานะสินค้า: </font><font color='red'> สินค้าหมด</font></td></tr>";
    }
  ?>
  <tr height="5px">
    <td>
      <?php
        include('connect.php');

        if (!isset($_SESSION['id'])) {
          if($row['qty_s'] > 0 || $row['qty_m'] > 0  || $row['qty_l'] > 0  || $row['qty_xl'] > 0 ) {
            echo "<a href='login.php' class='addcart'>หยิบใส่ตระกร้า</a>";
          } else {

          }
        } else {
          $id = $_SESSION['id'];
          $username = $_SESSION['username'];
          $fname = $_SESSION['fname'];
          $lname = $_SESSION['lname'];
          $nphone = $_SESSION['nphone'];
          $waddress = $_SESSION['waddress'];

          //$sql = "SELECT*FROM user WHERE id=$id";
          $sql = "SELECT * FROM user WHERE id=$id";
          $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
          $row = mysqli_fetch_array($result);
          extract($row);

          $username = $row['username'];
          $fname = $row['fname'];
          $lname = $row['lname'];
          $nphone = $row['nphone'];
          $waddress = $row['waddress'];
          //echo "<a href='mycart.php?id=$id' class='addcart'>หยิบใส่ตระกร้า</a>";
          //echo "<a href='mycart.php?pro_id=$pro_id&act=add' class='addcart'>หยิบใส่ตระกร้า";
          $sqlpro = "SELECT*FROM pro_product WHERE pro_id=$pro_id";
          $result2 = mysqli_query($conn, $sqlpro);
          $row2 = mysqli_fetch_array($result2);
          if($row2['qty_s'] > 0 || $row2['qty_m'] > 0  || $row2['qty_l'] > 0  || $row2['qty_xl'] > 0 ) {
            echo "<input type='submit' name='submit' class='addcart' value='หยิบใส่ตระกร้า'>";
          } else {

          }
        }
      ?>
    </td>
  </tr>
  <tr>
    <td valign="top"><b><font class="font-prompt">รายละเอียด:</font></b>
      <br>
      <?php
        include('connect.php');
        $pro_id = $_GET['pro_id'];

        $sql = "SELECT * FROM pro_product WHERE pro_id=$pro_id";
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
        $row = mysqli_fetch_array($result);
      ?>
      <?php echo $row['pro_detail']; ?>
    </td>
  </tr>
</table>
<input type='hidden' name='product_size' id='product_size'>
</form>
<?php
  require 'template/front/footer.php';
?>
