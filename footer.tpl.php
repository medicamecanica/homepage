 </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
	  <p class="m-0 text-white text-sm-left">
		 <ul  class=" text-white ">
			 <li class="name text-sm-left pt-1">
			 <img src="icons/phone.svg " style="filter: invert(1);" class="text-white" alt="" width="32" height="32" title="Telefono">
		 <?php global $mysoc;print $mysoc->phone?>
		  </li>
		 <li ">
		  <img src="icons/envelope-fill.svg " style="filter: invert(1);" class="text-white" alt="" width="32" height="32" title="Telefono">
		 <?php global $mysoc;print $mysoc->email?>
		  </li>
			   <li >
		  <?php dol_include_once('core/lib/company.lib.php')?>
		  <img src="icons/geo.svg " style="filter: invert(1);" class="text-white" alt="" width="32" height="32" title="Telefono">
		 <?php global $mysoc;print $mysoc->address.', '.$mysoc->town.'  '.getState($mysoc->state_id).' '.$mysoc->country?>
		  </li>
		 </ul>
		 </p>
	
      <p class="m-0 text-center text-white">Copyright &copy; <?php global $mysoc;print $mysoc->name.'  '. date('Y')?></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
