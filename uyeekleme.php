<?php
session_start ();
require_once"connections/baglanti.php";
ob_start();
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

  
  
  
  
  <div class="register-box-body">
    
    
<div class="box-body box-profile"><img class="profile-user-img img-responsive" src="images/users.png" alt="User profile picture"></div

<div class="form-group has-feedback"></div> <!-- SADECE BO??LUK BIRAKMAK ??????N EKLEND?? -->
	
<?php 
include "ortak_sayfalar/cizgi.php"; 
?>

	
	
 <form action="ismerkezi.php" method="POST">
	
	
	
<div class="form-group has-feedback">  
  <select class="form-control selectb" title="Yetkini" name="yetki"  value="<?php echo htmlentities($row_gc['yetki'], ENT_COMPAT, 'utf-8'); ?>" tabindex="-1" style="width: 100%;">
<?php
 
 
 
 
 if(isset($_SESSION['login'])=="true" and ($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  
 $kat_sorgu = mysqli_query($baglanti,"SELECT * FROM yetkiler ORDER BY yetki_id ASC");           
		}else {
			$kat_sorgu = mysqli_query($baglanti,"SELECT * FROM yetkiler where yetki_id=1 ORDER BY yetki_id ASC");           
		}
		
 
 
 
while($dongu = mysqli_fetch_array($kat_sorgu)) {
	if($dongu["yetki_id"]==htmlentities($row_gc['yetki'])) {
	echo "<option selected='selected' value='".$dongu["yetki_id"]."'>".$dongu["yetki"]."</option>";
	}	else {
echo  "<option value='".$dongu["yetki_id"]."'>".$dongu["yetki"]."</option>";
}
}
 ?>
 </select>
  </div>


	
      <div class="form-group has-feedback">
        <input type="text" name="adi_soyadi" class="form-control" placeholder="Ad?? Soyad??">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  
	  
	  <div class="form-group has-feedback">
        <input type="text" name="telefon" class="form-control" placeholder="Telefon">
        <span class="fa fa-phone-square form-control-feedback"></span>
      </div>
	  
	   


	  
	    
	  
	  
      <div class="form-group has-feedback">
        <input type="email" name="eposta" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
	  
	  
	  
	  
      <div class="form-group has-feedback">
        <input type="password" name="sifre" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  
      <div class="form-group has-feedback">
        <input type="password" name="sifrer" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
	  
	  <?php include "ortak_sayfalar/cizgi.php"; ?>
	  
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
           
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
		
          <button type="submit" class="btn btn-primary btn-block btn-flat">??ye Ekle</button>
		  
        </div>
        <!-- /.col -->
      </div>
	   <input type="hidden" name="komut" value="uyeekleme">
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