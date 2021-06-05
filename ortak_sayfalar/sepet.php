			   

<?php
$mesajsayisi=0;

   if(isset($_SESSION['login'])=="true"){
	   
	$sorgu=mysqli_query($baglanti,"select * from sepet where uye_id='".$_SESSION['uye_id']."'"); 	       
			        
	
	 
	
	 $mesajsayisi=mysqli_num_rows($sorgu);
	 
	 	 
	 }
	
	
	
	if ($mesajsayisi>=1){ ?>
		

	
	
<li class="dropdown messages-menu">      
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-cart-plus"></i>
			  <span class="label label-success"><?php echo $mesajsayisi;?></span>
            </a>
		
			<ul class="dropdown-menu"><li class="header">
						
			<?php
			if ($mesajsayisi>0){ 
			echo "Sepetinizde $mesajsayisi adet kitap var";
			} ?> 
			
			</li>
            <li>
            <ul class="menu">					  	   
   		   
 <?php				


$sorgu=mysqli_query($baglanti,"SELECT sepet.sepet_id,kitaplar.kitap_adi,kitaplar.yazari,kitaplar.yayinevi,kitaplar.fiyati,kitaplar.kitap_resim,kitaplar.basim_tarihi,sepet.kitap_id,sepet.uye_id FROM uyeler INNER JOIN (sepet INNER JOIN kitaplar ON sepet.kitap_id=kitaplar.kitap_id) ON uyeler.uye_id=sepet.uye_id WHERE uyeler.uye_id= '".$_SESSION['uye_id']."'");	 
	     
	 
	
	 while($mesajj = mysqli_fetch_array($sorgu)){?>             				  
               		
			   
			     <li>
               
                      <a href="#">					
					    <div class="pull-left">
					  
					  <img src="images/kitaplar/<?php echo $mesajj['kitap_resim'];?>" alt="book Image">
                      </div>
					  
					  
					  
					  
                      
					  <h6><?php echo $mesajj['kitap_adi']." ";?></h6>
                      				  
					  </a>
					  				  
				   
					  <a href="ismerkezi.php?sepet_id=<?php echo $mesajj['sepet_id'];?>&komut=sepetencikar"><image align="right" src= "images/sil.png" title="Sepeten Çıkar"></a>
					 
					  
                      <h5><?php echo $mesajj['yayinevi']." YAYINLARI"; ?></h5>					  
					  </h4></p><h5>Fiyati : <?php echo $mesajj['fiyati'];?><i class="fa fa-turkish-lira"></i></h5>
					  <?php echo $mesajj['yazari']." ";?><small><i class="fa fa-clock-o"></i><?php echo $mesajj['basim_tarihi']." "; ?></small>
					 </li>
				  
				  
				  
		<?php } ?>              
			
			  
			   </ul>
              </li>
              <li class="footer">
			<p>
			
			
			   <?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>
			<a href="ismerkezi.php?sepet_id=<?php echo $mesajj['sepet_id'];?>&komut=loginsepetionayla"><image align="left" src= "images/sepetonay.png" title="Sepeteki Ürünleri Onayla"></a>
			
				<?php } ?>       
			
   		    <a href="ismerkezi.php?komut=sepetibosalt"><image align="right" src= "images/sil.png" title="Sepeteki Ürünleri boşalt"></a>
			</p>
			  			  
			  </li>
			  
			  
			  
            </ul>	 
	  </li>		  
	<?php }	?>
			 