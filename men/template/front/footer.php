
</body>
<div class="footer-bottom">
      <div class="w3-content w3-center">
        <a href="#"><img class="img-icons" src="icon/fb-icon.png"></a>
        <a href="#"><img class="img-icons" src="icon/ig-icon.png"></a>
      </div>
      <div class="footer-copyright">
        Copyright © 2020 Sky T-shirt
      </div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="js/app.js"></script>
  <!-- JS -->
  <script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
      showDivs(slideIndex += n);
    }

    function currentDiv(n) {
      showDivs(slideIndex = n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-white", "");
      }
      x[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " w3-white";
    }

    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }

    function myFunctionClick() {
      var x = document.getElementById("Demo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }

    /*function myFunctionSize() {
      var coffee = document.forms[0];
      var txt = "";
      var i;
      for (i = 0; i < coffee.length; i++) {
        if (coffee[i].checked) {
          txt = txt + coffee[i].value + " ";
        }
      }
      var x = document.getElementById("sizet").value = "" + txt;
      document.getElementById("sizet").innerHTML = x;
    }*/

    function myFunctionSize(size) {
      var s = document.forms[0];
      var txt = "";
      var i;
      for (i = 0; i < s.length; i++) {
        if (s[i].checked) {
          txt = txt + s[i].value + " ";
        }
      }
      var x = document.getElementById("psize").value = "" + txt;
      document.getElementById("psize").innerHTML = x;
      document.getElementById("product_size").value = size;
    }

    function QtyClick() {
      document.getElementById("qty").value--;
      var qty = document.getElementById("qty").value;
      if (qty < 1) {      
        document.getElementById("qty").value = "1";      
      }
    }
    /*function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
    }*/
  </script>
</html>
