 <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			
			<?php if(isset($_SESSION['login'])=="true") {   ?>
			
			  <img src="images/uyeler/<?php echo $_SESSION['uye_resim'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['adi_soyadi'];?></span>
			
			  <?php }else {  ?>
			  <img src="images/uyeler/kadir.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Kadir Yadigar</span>
			  <?php }  ?>
			</a>
            
			
			
			<ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">

			  
			  	<?php if(isset($_SESSION['login'])=="true") {   ?>
                 <img src="images/uyeler/<?php echo $_SESSION['uye_resim'];?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['adi_soyadi'];?>
                  <small><?php echo $_SESSION['kayit_tarihi'];?></small>
                </p>
			  
			   <?php }else {  ?>
			  
                 <img src="images/uyeler/kadir.jpg" class="img-circle" alt="User Image">
                <p>
                  Kadir Yadigar - Yıldırım Beyazıt University
                  <small>Member since Nov. 2020</small>
                </p>
			    <?php }  ?>
			  
			  
			  
			  
			  
			  </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">

    				<div class="col-xs-4 text-center">
					<?PHP if(isset($_SESSION['login'])=="true"){  ?>
					<a href="liste.php?baslik_resim=<?php echo $_SESSION['uye_resim'];?>&komut=okunanlar&baslik=<?php echo $_SESSION['adi_soyadi']." ÜYENİN OKUDUĞU KİTAPLAR"; ?>&uye_id=<?php echo $_SESSION['uye_id']; ?>"><img src="images/kitapoku.png" title="<?php echo $_SESSION['adi_soyadi']." ÜYENİN OKUDUĞU KİTAPLAR"; ?>"  class="btn btn-default btn-flat">Kitapların</a>
					<?PHP }else{ ?>
				
				<a href="#"><img src="images/kitapoku.png" title="Okuduğun Kitaplar"  class="btn btn-default btn-flat">Kitapların</a>
				
						
					<?php  } ?>
                   </div>
                  
				  
				  <div class="col-xs-4 text-center">
	              <?PHP if(isset($_SESSION['login'])=="true"){  ?>
                  <a href="uyeguncelleme.php?uye_id=<?php echo $_SESSION['uye_id']; ?>"><img src="images/guncelle.png" title="<?php echo $_SESSION['adi_soyadi']."  PROFİLİNİ GÜNCELLE"; ?>"  class="btn btn-default btn-flat">Güncelle</a>
 				  <?PHP }else{ ?>
				
				<a href="#"><img src="images/guncelle.png" title="Profil Güncelle"; class="btn btn-default btn-flat">Güncelle</a>
				 
				 
				 <?php  } ?>
				  </div>
				 				  
				  <div class="col-xs-4 text-center">
                   
				   <a href="cikis.php"><img src="images/exit.png"  class="btn btn-default btn-flat">Çıkış</a>
				   
                  </div>
				    
                </div>
                </li>
			  
			  
              <!-- Menu Footer-->
              
            </ul>
          </li>
		  