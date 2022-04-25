<script>
      window.onscroll = function() {myFunction()};

      var header = document.getElementById("myHeader");
      var sticky = header.offsetTop;

      function myFunction() {
        if (window.pageYOffset > sticky) {
          header.classList.add("sticky");
        } else {
          header.classList.remove("sticky");
        }
      }
    </script>
    <footer>
			<img src="https://uh.edu/marcom/_images/brand/logo-interlocking-uh-red.svg" alt="logo" width=70 height=70>
			<h1>Created by Rodolfo C., Justin J., Hunter M., and Elinnoel N. </h1>
		</footer>
  </body>
</html>
