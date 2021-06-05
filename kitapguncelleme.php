<?php
session_start ();
require_once"connections/baglanti.php";
ob_start(); 
?>

<?php



if (isset($_GET['kitap_id'])) {
$kg = mysqli_query($baglanti,"SELECT * FROM kitaplar WHERE kitap_id ='".$_REQUEST['kitap_id']."'");
$row_kg = mysqli_fetch_assoc($kg);
}




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
          <h3 class="box-title"></h3>
          <?php 
		 // include "ortak_sayfalar/sayfagizleme.php";   
		  ?>
        </div>		
        <div class="box-body">
<!-- ********************************************************* -->          
		  
<div class="register-box">
  <div class="register-logo">   
  </div>

  
  
  
  
 
    
<div class="box-body box-profile"><img class="profile-user-img img-responsive" src="images/kitaplar/<?php echo htmlentities($row_kg['kitap_resim']); ?>" alt="User profile picture">
    </div>

 <?php include "ortak_sayfalar/cizgi.php"; ?>
	  
      



<form name="form2" enctype="multipart/form-data" action="resimyukle.php"  method="POST">
<tr>
<td><input type="FILE" name="RESIM"></td></tr>  
  <input type="text"  style="display:none" name="komut" value="kitapresmi"  class="form-control"/>
  <input type="text"  style="display:none" name="kitap_id" value=<?php echo htmlentities($row_kg['kitap_id']);?>  class="form-control"/>
  <input type="submit" value="Resim seçtikten sonra yükle">
 </form>
 
 
 
 </div>
	
	
	
<form action="ismerkezi.php" method="POST">


 <?php include "ortak_sayfalar/cizgi.php"; ?>
	  
      
	  
	
	
	
      <div class="form-group has-feedback">
        <input type="text" name="kitap_adi" value="<?php echo htmlentities($row_kg['kitap_adi'], ENT_COMPAT, 'utf-8'); ?>"  class="form-control" placeholder="Kitap Adı">
       <span class="fa fa-book form-control-feedback"></span>
      </div>
	  	  
      <div class="form-group has-feedback">
        <input type="text" name="yazari" value="<?php echo htmlentities($row_kg['yazari'], ENT_COMPAT, 'utf-8'); ?>"  class="form-control" placeholder="Yazarı ">
        <span class="fa fa-user-secret form-control-feedback"></span>
      </div>
	  
      <div class="form-group has-feedback">
        <input type="text" name="yayinevi" value="<?php echo htmlentities($row_kg['yayinevi'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" placeholder="Yayınevi">
        <span class="fa fa-home form-control-feedback"></span>
      </div>
	  	  
	  <div class="form-group has-feedback">
        <input type="text" name="basim_tarihi" value="<?php echo htmlentities($row_kg['basim_tarihi'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" placeholder="Basım Tarihi">
        <span class="fa fa-calendar-o form-control-feedback"></span>
      </div>
	  
	  
	  <div class="form-group has-feedback">
        <input type="text" name="fiyati" value="<?php echo htmlentities($row_kg['fiyati'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" placeholder="Fiyatı">
         <span class="fa fa-turkish-lira form-control-feedback"></span>
      </div>
	  	  
	  <div class="form-group has-feedback">
        <input type="text" name="stok" value="<?php echo htmlentities($row_kg['stok'], ENT_COMPAT, 'utf-8'); ?>"  class="form-control" placeholder="Stok Adedi">
         <span class="fa fa-cart-plus form-control-feedback"></span>
      </div>
	  
		
	 
	  <?php include "ortak_sayfalar/cizgi.php"; ?>
	  
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
           
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Güncelle</button>
        </div>
        <!-- /.col -->
      </div>
	   <input type="hidden" name="komut" value="kitapguncelleme">
      <input type="hidden" name="kitap_id" value="<?php echo $row_kg['kitap_id']; ?>">
    </form>

    

    
  </div>
  
  
  
  
  
  <!-- /.form-box -->
</div>

<!-- ********************************************************* -->          		  
    </div>
          <div class="box-footer"></div>
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
<?php
mysql_free_result($kg);
?>
