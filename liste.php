<?php
session_start ();
ob_start(); 
require_once"connections/baglanti.php"; 
ob_start();
?>

 <?php

 $baslikresim="kitaplar/kitaplar.png";    
 

if(isset($_REQUEST['komut'])=='true' and ($_REQUEST['komut']=='okuyanlar')){ 
$basliklar=$_REQUEST['baslik']; 	
$baslikresim="kitaplar/".$_REQUEST['baslik_resim'];  

}elseif(isset($_REQUEST['komut'])=='true' and $_REQUEST['komut']=='okunanlar'){
$basliklar=$_REQUEST['baslik']; 	
$baslikresim="uyeler/".$_REQUEST['baslik_resim'];  
}

 

 
 
 
 
$cl_ls = "-1";


//**************************************************************************************************************			
if($_REQUEST['komut']=='uyearama'){	
$cl_ls = $_REQUEST['aranan'];
$ara="";
$basliklar="Üye Listesi"; 	

if(isset($_REQUEST['aranan'])){  	
$ara="WHERE adi_soyadi LIKE '%". $cl_ls."%' OR telefon LIKE '%".$cl_ls."%' or eposta LIKE '%".$cl_ls."%'";
$basliklar="Bulunan Üyeler"; 	
}
$query_ls = "SELECT uy.uye_id,kt.kitap_resim, uy.adi_soyadi, uy.eposta,uy.telefon,uy.kayit_tarihi,uy.uye_resim,isl.kitap_id,isl.islem_id,isl.alis_tarihi,isl.teslim_tarihi, COUNT(isl.uye_id) 
FROM uyeler uy 
LEFT JOIN islemler isl
ON uy.uye_id = isl.uye_id 
LEFT JOIN kitaplar kt
ON kt.kitap_id = isl.kitap_id 
$ara
GROUP BY uy.uye_id";



$baslik1="Adı Soyadı";
$baslik2="Reytingi";
$baslik3="Telefon";
$baslik4="E-Posta";




//**************************************************************************************************************			
} elseif($_REQUEST['komut']=='kitaparama'){	
$cl_ls = $_REQUEST['aranan'];
$ara="";
$basliklar="Kitap Listesi"; 	

if(isset($_REQUEST['aranan'])){  	
$basliklar="Bulunan Kitaplar"; 	
$ara="WHERE kitap_adi LIKE '%". $cl_ls."%' OR yazari LIKE '%".$cl_ls."%' or yayinevi LIKE '%".$cl_ls."%'";
}


$query_ls = "SELECT kt.kitap_id,kt.kitap_adi,kt.yazari,kt.yayinevi,kt.basim_tarihi,kt.kitap_resim,kt.stok,kt.fiyati,isl.islem_id,isl.teslim_tarihi,isl.alis_tarihi,COUNT(isl.kitap_id) 
FROM kitaplar kt 
LEFT JOIN islemler isl
ON kt.kitap_id = isl.kitap_id 
$ara
GROUP BY kt.kitap_id";




$baslik1="Kitap Adı";
$baslik2="Reytingi";
$baslik3="Yazarı";
$baslik4="Yayınevi";



//**************************************************************************************************************			
} elseif($_REQUEST['komut']=='okuyanlar'){
$query_ls = "SELECT uy.uye_id,uy.adi_soyadi, uy.eposta, uy.telefon, uy.kayit_tarihi, uy.uye_resim, isl.islem_id,kt.kitap_resim,kt.kitap_adi,isl.kitap_id,isl.alis_tarihi,isl.teslim_tarihi 
FROM uyeler uy 
LEFT JOIN islemler isl
ON uy.uye_id = isl.uye_id 
LEFT JOIN kitaplar kt
ON kt.kitap_id = isl.kitap_id 
WHERE isl.kitap_id='".$_REQUEST['kitap_id']."'
GROUP BY uy.uye_id";


$baslik1="Adı Soyadı";
$baslik2="Kitap Adı";
$baslik3="Alış Tarihi";
$baslik4="Teslim Tarihi";

//**************************************************************************************************************			
}elseif($_REQUEST['komut']=='uyedekiler'){
$query_ls = "SELECT uy.uye_id,uy.adi_soyadi,kt.kitap_id, kt.kitap_adi, kt.yazari,kt.yayinevi,kt.kitap_resim,isl.teslim_tarihi,isl.islem_id,isl.alis_tarihi 
FROM kitaplar kt 
LEFT JOIN islemler isl 
ON (kt.kitap_id = isl.kitap_id)
LEFT JOIN uyeler uy 
ON (isl.uye_id=uy.uye_id)
where kt.kitap_id=isl.kitap_id and isl.teslim_tarihi IS NULL";



$baslik1="Adı Soyadı";
$baslik2="Kitap Adı";
$baslik3="Alış Tarihi";
$baslik4="Teslim Tarihi";

$basliklar="Kitap teslim etmeyen üyeler"; 	

//**************************************************************************************************************			
}elseif($_REQUEST['komut']=='disardakiler'){
$query_ls = "SELECT uy.uye_id,uy.adi_soyadi,kt.kitap_id, kt.kitap_adi, kt.yazari,kt.yayinevi,kt.kitap_resim,isl.teslim_tarihi,isl.islem_id,isl.alis_tarihi 
FROM kitaplar kt 
LEFT JOIN islemler isl 
ON (kt.kitap_id = isl.kitap_id)
LEFT JOIN uyeler uy 
ON (isl.uye_id=uy.uye_id)
where kt.kitap_id=isl.kitap_id and isl.teslim_tarihi IS NULL";

$baslik1="Kitap Adı";
$baslik2="Adı Soyadı";
$baslik3="Alış Tarihi";
$baslik4="Teslim Tarihi";

$basliklar="Üyelerde olan Kitaplar"; 	

//**************************************************************************************************************			
} elseif($_REQUEST['komut']=='okunanlar'){
$query_ls = "SELECT uy.kayit_tarihi,uy.adi_soyadi, kt.kitap_id,kt.kitap_adi,kt.yazari,kt.yayinevi,kt.basim_tarihi,kt.kitap_resim,kt.stok,kt.fiyati,isl.islem_id,isl.teslim_tarihi,isl.alis_tarihi 
FROM kitaplar kt 
LEFT JOIN islemler isl
ON kt.kitap_id = isl.kitap_id 
LEFT JOIN uyeler uy
ON uy.uye_id = isl.uye_id 
WHERE isl.uye_id='".$_REQUEST['uye_id']."'
GROUP BY kt.kitap_id";

$baslik1="Kitap Adı";
$baslik2="Yazarı";
$baslik3="Alış Tarihi";
$baslik4="Teslim Tarihi";
}
//**************************************************************************************************************			


$ls = mysqli_query($baglanti,$query_ls) or die(mysql_error());

 

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php 
	include "ortak_sayfalar/baslik.php";
	?>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 <header class="main-header">
	 <?php
	 include "ortak_sayfalar/logo.php";
	 ?>
    <nav class="navbar navbar-static-top">
	  <?php  
	  include "ortak_sayfalar/gsmmenu.php";
	  ?>
	      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
      <?php 
	  include "ortak_sayfalar/girismenu.php";
	  include "ortak_sayfalar/sepet.php";
	  include "ortak_sayfalar/mesajlar.php";
	  include "ortak_sayfalar/profil.php";  
	  ?>
	     <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
	  <?php 
	  include "ortak_sayfalar/userpaneli.php";
	  include "ortak_sayfalar/arama.php";
	  include "ortak_sayfalar/solmenu.php"; 
	  ?>
    </section>
    </aside>
  <div class="content-wrapper">
	 <?php  
	 include "ortak_sayfalar/projebaslik.php";  
	 ?>
    <section class="content">
      <div class="box">
	  
        <div class="box-header with-border">
		
        <h3 class="box-title"><?php echo $basliklar;  ?>	  
        <div class="box-body box-profile"><img class="profile-user-img img-responsive" 
		src="images/<?php echo $baslikresim; ?>" alt="User profile picture">
    	</img></div></h3>
		  
		  
         
<?php 
 //include "ortak_sayfalar/sayfagizleme.php";   
?>
		  
        </div>		
        <div class="box-body">
<!-- ********************************************************* -->          
		  
	
            <div class="box-body">
			
 
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                
                <th>No</th>
				<th><?php echo $baslik1;?></th>
				<?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>	
				<th><?php echo $baslik2;?></th>
				<th><?php echo $baslik3;?></th>
				<th><?php echo $baslik4;?></th>	
				 <?php } ?>
				
				<th>İşlemler
				
                <!--
                 <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">İşlemler
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#"><?php $_SESSION['islemmenu']="yatay";?>Yatay</a></li>
                    <li><a href="#"><?php $_SESSION['islemmenu']="dikey";?>Dikey</a></li>
                  
                  </ul>
                </div>
                 -->
				
                </th> 
				
				</tr>
                </thead>
                <tbody>
				
				
				<?php 
				while ($row_ls = mysqli_fetch_assoc($ls)) { ?>
				<tr>				

				
				
				
				
	


				<!-- //butonlar ************************************* -->                

                <?php if($_REQUEST['komut']=='uyearama') { ?> 
				<td><?php echo $row_ls['uye_id']; ?></td>
				<td><?php echo $row_ls['adi_soyadi']; ?></td>
				
				<?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>	
				<td><?php echo $row_ls['COUNT(isl.uye_id)']; ?></td>
                <td><?php echo $row_ls['telefon']; ?></td>
                <td><?php echo $row_ls['eposta']; ?></td> 
				<?php } 		
				
				
				} elseif($_REQUEST['komut']=='kitaparama'){ ?> 
				<td><?php echo $row_ls['kitap_id']; ?></td>
				<td><?php echo $row_ls['kitap_adi']; ?></td>
				
         		<?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>	
				<td><?php echo $row_ls['COUNT(isl.kitap_id)']; ?></td>
				<td><?php echo $row_ls['yazari']; ?></td>
                <td><?php echo $row_ls['yayinevi']; ?></td> 
				 <?php }
				
				
				
				
				
					
		        } elseif($_REQUEST['komut']=='okunanlar'){ ?> 
		        <td><?php echo $row_ls['kitap_id']; ?></td>
				<td><?php echo $row_ls['kitap_adi']; ?></td>
		        <?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>	
				<td><?php echo $row_ls['yazari']; ?></td>
				<td><?php echo $row_ls['alis_tarihi']; ?></td>
                <td><?php echo $row_ls['teslim_tarihi']; ?></td> 
				<?php } 
				
		         } elseif($_REQUEST['komut']=='uyedekiler' or $_REQUEST['komut']=='okuyanlar'){ ?> 
				<td><?php echo $row_ls['uye_id']; ?></td>
				<td><?php echo $row_ls['adi_soyadi']; ?></td>
				<?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>	
		        <td><?php echo $row_ls['kitap_adi']; ?></td>
				<td><?php echo $row_ls['alis_tarihi']; ?></td>
                <td><?php echo $row_ls['teslim_tarihi']; ?></td> 
				<?php } 
				
				} elseif($_REQUEST['komut']=='disardakiler'){ ?> 
				<td><?php echo $row_ls['kitap_id']; ?></td>
				<td><?php echo $row_ls['kitap_adi']; ?></td>
				<?php if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?>	
		        <td><?php echo $row_ls['adi_soyadi']; ?></td>
				<td><?php echo $row_ls['alis_tarihi']; ?></td>
                <td><?php echo $row_ls['teslim_tarihi']; ?></td> 
		        <?php } 
		              } ?>
				
				<!-- //butonlar ************************************* -->





<td>

<?php

if($_REQUEST['komut']=='uyearama' or $_REQUEST['komut']=='okuyanlar'){  

if($_SESSION['islemmenu']=="dikey") { //işlemmenu değişkenini login.php de tanımlıyoruz..
include "butonlar/uyeler_dikey.php";   	
}else{
include "butonlar/uyeler_yatay.php";   	
}

}else{

if($_SESSION['islemmenu']=="dikey") {
include "butonlar/kitap_dikey.php";   	
}else{
include "butonlar/kitap_yatay.php";   	
}

}




?>		



			  				  		  
</td>


		
                </tr>
                  <?php }  ?>
				  
				  
				  
                </tbody>
                </table>
			    </div>

<!-- ********************************************************* -->          		  
        </div>
          <div class="box-footer">

		  
		  <?php
			echo $basliklar;   
		     ?>
		  

		  
		  </div>
         </div>
      </section>
   </div>
   <footer class="main-footer">
    <?php
	include "ortak_sayfalar/altbilgi.php";
	?>
  </footer>
   <aside class="control-sidebar control-sidebar-dark">
     <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      </ul>
      <div class="tab-content">
          <div class="tab-pane" id="control-sidebar-home-tab">
          <ul class="control-sidebar-menu">
         </ul>
        <ul class="control-sidebar-menu">
         </li>
         </ul>
		 </div>
         <div class="tab-pane" id="control-sidebar-settings-tab">
      </div>
      </div>
  </aside>
  <div class="control-sidebar-bg"></div>
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
<?php
mysqli_free_result($ls);
ob_end_flush(); 
?>
</html>
