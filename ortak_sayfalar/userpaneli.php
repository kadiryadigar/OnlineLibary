<div class="user-panel">
        <div class="pull-left image">
				
		<?php if(isset($_SESSION['login'])=="true") {   ?>
		<img src="images/uyeler/<?php echo $_SESSION['uye_resim'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
    	<p><?php echo $_SESSION['adi_soyadi'];?></p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	    
		
		 <?php }else {  ?>
		
		<img src="images/31.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
    	<p>Hosgeldiniz</p><a href="#"><i class="fa fa-circle text-success"></i>Kitap Kiralamak Icin Ara</a>
	    
		 <?php }  ?>
		
		</div>
      </div>
	  