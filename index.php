<?php
session_start ();
ob_start();
include "connections/baglanti.php";
//include "ortak_sayfalar/tablo_kontrol.php";
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
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
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
          <h3 class="box-title">SİTEYİ TEST ETME VE KULLANMAK İÇİN</h3>
          <?php 
		  include "ortak_sayfalar/sayfagizleme.php";   
		  ?>
        </div>		
        <div class="box-body">
<p>
  <!-- ********************************************************* -->  </p>
<table width="200" border="1">
  <tr>
    <td><div align="center">Kullanıcı</div></td>
    <td><div align="center">kullanıc adi</div></td>
    <td><div align="center">Şifre</div></td>
  </tr>
  
  <tr>
    <td><div align="right">Super Admin</div></td>
    <td><div align="center">1</div></td>
    <td><div align="center">111</div></td>
  </tr>
  
  <tr>
    <td><div align="right">Admin</div></td>
    <td><div align="center">2</div></td>
    <td><div align="center">222</div></td>
  </tr>
  
  <tr>
    <td><div align="right">Üye</div></td>
    <td><div align="center">3</div></td>
    <td><div align="center">333</div></td>
  </tr>
  
  

</table>


  
   </p>

<!-- ********************************************************* -->          		  
        </div>
          <div class="box-footer"> Not: ilk 3 kullanıcı ve ilk 5 kitap Silme güncellemeye karşı kilitlenmiştir. </div>
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
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
<?php  ob_end_flush(); ?>
</html>