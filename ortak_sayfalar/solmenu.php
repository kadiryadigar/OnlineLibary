	  <ul class="sidebar-menu" data-widget="tree">
    
	
		
       <li><a href="index.php"><i class="fa fa-home"></i> Ana Sayfa</a></li>
       
		<li class="treeview">          		  
		  <a href="#">
            <i class="fa fa-users"></i> <span> Üyeler </span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		    <ul class="treeview-menu">
			<li><a href="uyeekleme.php"><i class="fa fa-edit"></i>Üye ekleme </a></li>
			<li><a href="liste.php?komut=uyearama&aranan=""><i class="fa fa-user"></i>Üye Listesi </a></li>
			<li><a href="liste.php?komut=uyedekiler&baslik=Kitap Alanlar&baslik_resim=genels.png"<i class="fa fa-book "> </i> Kitap Alanlar</a></li>
			
          </ul>
        </li>

		
		
		
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Kitaplar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  
          <ul class="treeview-menu">
         <?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>	
		 
		 
            <li><a href="kitapekleme.php"><i class="fa fa-edit"></i> Kitap ekleme</a></li>
          <?php } ?>
		  <li><a href="liste.php?komut=kitaparama&aranan=""><i class="fa fa-book"></i> Kitaap Listesi</a></li>
		  
		  <li><a href="liste.php?komut=disardakiler&baslik=Dişardaki Kitaplar&baslik_resim=genels.png"<i class="fa fa-book "> </i> Dışardaki Kitaplar</a></li>
		  
		  
		  </ul>
        </li>
		
		
	
	
	<?php if(isset($_SESSION['login'])=="true"){  ?>	
	<li><a href="cikis.php"><i class="glyphicon glyphicon-log-out"></i> Çıkış</a></li> 	
	<?php } ELSE { ?>	
	<li><a href="giris.php"><i class="fa fa-key"></i> Kullanıcı Giriş</a></li>			
   <?php } ?>	
              
      </ul>