<?php
$nmesaj=0;
if(isset($_SESSION['login'])=="true"){
$sorgu=mysqli_query($baglanti,"select * from mesajlar where ana_id='".$_SESSION['uye_id']."' or yazan_id='".$_SESSION['uye_id']."' or ana_id='".$_SESSION['uye_id']."' or cevap_id=0");
	 while($fetch = mysqli_fetch_array($sorgu))  {
	 $nmesaj++;
	 }
	 }
	if ($nmesaj>=1){ ?>





<li class="dropdown messages-menu">  
  
 
 <?php		
	if(isset($_SESSION['login'])=="true"){
	    $mesajsayisi = 0 ; 

		
		
	
	$sorgu=mysqli_query($baglanti,"select * from mesajlar where ana_id='".$_SESSION['uye_id']."' or yazan_id='".$_SESSION['uye_id']."' or ana_id='".$_SESSION['uye_id']."' or cevap_id=0");
	
	
	  $mesajsayisi = mysqli_num_rows($sorgu); 
	
	
	
    ?>
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
			  <span class="label label-success"><?php echo $mesajsayisi;?></span>
            </a>
		
		
		
		
		
			<ul class="dropdown-menu"><li class="header">
						
			<?php
			if ($mesajsayisi>0){ 
			echo $mesajsayisi.' adet özel mesajınız var';
			} ?> 
			
			</li>
            <li>
            <ul class="menu">					  	   
   
			   
			   
			   
 <?php						



$sorgum = "SELECT uy.uye_id, uy.adi_soyadi, uy.eposta,uy.telefon,uy.kayit_tarihi,uy.uye_resim,msj.mesaj,msj.zaman1,msj.zaman2,msj.yazan_id,msj.cevap_id,msj.mesaj_id,msj.ana_id,msj.durum 
FROM uyeler uy 
INNER JOIN mesajlar msj 
ON uy.uye_id=msj.yazan_id 
where yazan_id='".$_SESSION['uye_id']."' or cevap_id='".$_SESSION['uye_id']."' or ana_id='".$_SESSION['uye_id']."' or cevap_id=0
ORDER BY mesaj_id ASC";



$sorgu=mysqli_query($baglanti,$sorgum);

	 
	 while($mesajj = mysqli_fetch_array($sorgu))   {
       
	   $okundu="mesajguncelle";
		$sil="mesajsil";
		$cevapla="mesajyaz";
		
	   
       ?>             				  
               

			   
			     <li>
				 			 
                     
					 
					 
					<?php 
					if($_SESSION['uye_id']==$mesajj['yazan_id']){ ?>					
					<div class="direct-chat-msg left">
					  <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $mesajj['adi_soyadi']; ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $mesajj['zaman1']; ?></span>
                      </div>					  
				<?php } else {	?>
				      <div class="direct-chat-msg right">
				      <div class="direct-chat-info clearfix">
					  <span class="direct-chat-name pull-right"><?php echo $mesajj['adi_soyadi']; ?></span>
                        <span class="direct-chat-timestamp pull-left"><?php echo $mesajj['zaman1']; ?></span>
                       </div>

				<?php } ?>
							  
					  
                       <img class="direct-chat-img" src="images/uyeler/<?php echo $mesajj['uye_resim']; ?>" alt="message user image">
                       <div class="direct-chat-text">
                        <?php echo $mesajj['mesaj']; ?>
                      </div>
                     </div>
					 
					 
					 
					 
					 
					 
					 
					 
	     
		 <div>									
		<?php
		if ($mesajj['durum']=="0" and $mesajj['yazan_id']!=$_SESSION['uye_id']){ 			
	     } else  {       ?>       
		
		
		
			
			 <div class="box-footer">
			 
			<?php  if ($mesajj['yazan_id']!=$_SESSION['uye_id']){ ?>			
			 
			 
				 <form action="ismerkezi.php" method="POST">
                    <div class="input-group">
					<input type="text" name="newmesaj" placeholder="Cevabınızı bura yaz gönder ..." class="form-control">
					<input type="text" style="display:none" name="cevap_id" value="<?php echo $mesajj['yazan_id'];?>" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
                    <input type="text" style="display:none" name="komut" value="cevapyaz" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
					<input type="text" style="display:none" name="mesaj_id" value="<?php echo $mesajj['mesaj_id'];?>" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
				   <span class="input-group-btn">
                   <button type="submit" class="btn btn-primary btn-block btn-flat">Cevapla</button>
				</span>
                    </div>
                  </form>
			  <?php } ?>	
				  </div>	
				  
			<!--	******************************* -->
			 
			 
			 <?php } ?>
			 
			 
                  </li>
		<?php } ?>              
			   
			   </ul>
              </li>
              <li class="footer"><a href="echat.php">Bütün Mesajlar</a></li>
            </ul>
		
	 <?php 
	 } else  {  
 	
		
	  $omesajsayisi = 0 ; 
	$sorgu=mysqli_query($baglanti,"select * from mesajlar where  ana_id=0 or cevap_id=0"); 
	
	 while($fetch = mysqli_fetch_array($sorgu))
     {
	  $omesajsayisi++;
	 } 
	 ?>
	
		 
	 
    
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
			  <span class="label label-success"><?php echo $omesajsayisi;?></span>
            </a>
	 
	 
	 
	
            	
			<ul class="dropdown-menu"><li class="header">
						
			<?php
			if ($omesajsayisi>0){ 
			echo $omesajsayisi.' adet mesaj var';
			} ?> 
			
			</li>
            <li>
            <ul class="menu">					  	   
   
			   
			   
			   
 <?php				


 
 

$sorgum = "SELECT uy.uye_id, uy.adi_soyadi, uy.eposta,uy.telefon,uy.kayit_tarihi,uy.uye_resim,msj.mesaj,msj.zaman1,msj.zaman2,msj.yazan_id,msj.cevap_id,msj.mesaj_id,msj.ana_id,msj.durum 
FROM uyeler uy 
INNER JOIN mesajlar msj 
ON uy.uye_id=msj.yazan_id 
where ana_id=0 or cevap_id=0
ORDER BY mesaj_id ASC";
 
 
 
 
	$sorgu=mysqli_query($baglanti,$sorgum);
	 
	 while($mesajj = mysqli_fetch_array($sorgu)) {   ?>             				  
               

			   
			     <li>
				 
				 
                 <div class="direct-chat-msg left">
					  <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $mesajj['adi_soyadi']; ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $mesajj['zaman1']; ?></span>
                      </div>					  
                       <img class="direct-chat-img" src="images/uyeler/<?php echo $mesajj['uye_resim']; ?>" alt="message user image">
                       <div class="direct-chat-text">
                        <?php echo $mesajj['mesaj']; ?>
                      </div>
                     </div>
	     
		 <div>									
		

			
			 <div class="box-footer">
		
			</div>	
				
                  </li>
		<?php } ?>              
			   
			   </ul>
              </li>
			
			  <li class="footer"><a href="#">Mesajların Sonu</a></li>
			  
			  
				  
			  
			
              
            </ul>
		

 <?php 
 }
 ?>
	 
	     </li>		  
			 
 <?php 
 }
 ?>
