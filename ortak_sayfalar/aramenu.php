<li class="dropdown messages-menu">  
	<?php if(isset($_SESSION['login'])=="true"){  ?>	
	<li><a href="liste.php"><i class="fa fa-binoculars" title="Kitap Ara.."></i></a></li> 	
	<?php } ELSE { ?>	
	<li><a href="#"><i class="fa fa-binoculars" title="Önce Giriş"></i></a></li>			
   <?php } ?>	
	     </li>		  
		 