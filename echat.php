<?php
session_start ();
include "connections/baglanti.php";
ob_start();  




if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_cl = 10;
$pageNum_cl = 0;
if (isset($_POST['pageNum_cl'])) {
  $pageNum_cl = $_POST['pageNum_cl'];
}
$startRow_cl = $pageNum_cl * $maxRows_cl;

mysqli_select_db($database_baglanti, $baglanti);


$query_cl = "SELECT uy.uye_id, uy.adi_soyadi, uy.eposta,uy.telefon,uy.kayit_tarihi,uy.uye_resim,msj.mesaj,msj.zaman1,msj.zaman2,msj.yazan_id,msj.cevap_id,msj.mesaj_id,msj.ana_id,msj.durum 
FROM uyeler uy 
INNER JOIN mesajlar msj 
ON uy.uye_id=msj.yazan_id 
where yazan_id='".$_SESSION['uye_id']."' or cevap_id='".$_SESSION['uye_id']."' or ana_id='".$_SESSION['uye_id']."' or cevap_id=0
ORDER BY mesaj_id ASC";






$query_limit_cl = sprintf("%s LIMIT %d, %d", $query_cl, $startRow_cl, $maxRows_cl);
$cl = mysqli_query($baglanti,$query_limit_cl) or die(mysqli_error());
$row_cl = mysqli_fetch_assoc($cl);

if (isset($_GET['totalRows_cl'])) {
  $totalRows_cl = $_GET['totalRows_cl'];
} else {
  $all_cl = mysqli_query($query_cl);
  $totalRows_cl = mysqli_num_rows($all_cl);
}
$totalPages_cl = ceil($totalRows_cl/$maxRows_cl)-1;

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
        
<!-- ******************************************************************************************** -->	
		
		  
          <div class="row">
            <div class="col-md-6">
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
				
				<?php if(isset($_REQUEST['komut'])=="ozelmesaj"){ ?>
				
                  <h3 class="box-title"><?php echo $_REQUEST['mesajadresi']." Üyemize mesaj yazacaksınız.";?></h3>
				<?php } else { ?>
					<h3 class="box-title">Genel bir Mesaj yazabilirsiniz</h3>
				<?php } ?>
				  
				   

				  
				  
				  
				  
				  <!-- ekle mesaj -->
				  <!-- genel mesaj gönderme  -->
				                
				  <div class="box-footer">
                  <div class="box-footer">
				  
				  
				  
			 		<form action="ismerkezi.php" method="POST">
                    <div class="input-group">
					
                    <?php if(isset($_REQUEST['komut'])=="ozelmesaj"){ ?>
					
					<input type="text" name="newmesaj" placeholder="Mesajınız sadece <?php echo $_REQUEST['mesajadresi']." Üyemize gönderilecektir.";?>" class="form-control">
					
					<input type="text" style="display:none" name="cevap_id" value="<?php echo $_REQUEST['uye_id'];?>" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
                    
					<?php } else {?>
			        <input type="text" name="newmesaj" placeholder="Bu Mesajınız herkese gider ..." class="form-control">
					<input type="text" style="display:none" name="cevap_id" value="0" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık --> 
			        <?php } ?>
					
					<input type="text" style="display:none" name="mesaj_id" value="0" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
					<input type="text" style="display:none" name="komut" value="cevapyaz" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
				   
				   
				   <span class="input-group-btn">
                   <button type="submit" class="btn btn-primary btn-block btn-flat">Gönder</button>
				</span>
                    </div>
                  </form>
				  
				  
				  
				  
				  
				  
			 
				  </div>	
		        </div>
		<!-- genel mesaj gönderme  -->
				  <div class="box-header with-border">
				  <div class="box box-warning direct-chat direct-chat-warning"></div> <!-- sarı çizgi -->
				  </div>
				
				
				
				
				
                <!-- mesaj varsa çalışsın -->
                
<?php			
	
	$sorgu=mysqli_query($baglanti,"select * from mesajlar where ana_id='".$_SESSION['uye_id']."' or yazan_id='".$_SESSION['uye_id']."' or ana_id='".$_SESSION['uye_id']."' or cevap_id=0");
	
	  $mesajsayisi = mysqli_num_rows($sorgu); 
	
if (mysqli_num_rows($sorgu)>0){
	

	?>


	
	
	
				
				<div class="box-body">
                <div class="direct-chat-messages">
					
	<?php do { 
				
				if($_SESSION['uye_id']==$row_cl['yazan_id']){ ?>					
					<div class="direct-chat-msg left">
					  <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $row_cl['adi_soyadi']; ?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo $row_cl['zaman1']; ?></span>
                      </div>					  
				<?php } else {	?>
				      <div class="direct-chat-msg right">
				      <div class="direct-chat-info clearfix">
					  <span class="direct-chat-name pull-right"><?php echo $row_cl['adi_soyadi']; ?></span>
                        <span class="direct-chat-timestamp pull-left"><?php echo $row_cl['zaman1']; ?></span>
                       </div>

				<?php } ?>
				
					  
					  
                       <img class="direct-chat-img" src="images/uyeler/<?php echo $row_cl['uye_resim']; ?>" alt="message user image">
                       <div class="direct-chat-text">
                        <?php echo $row_cl['mesaj']; ?>
                      </div>
                     </div>
				
				 
					  
		     <?php  if ($row_cl['durum']>="0" and $row_cl['cevap_id']==$_SESSION['uye_id']){ ?>			
		 	<a href="ismerkezi.php?mesaj_id=<?php echo $row_cl['mesaj_id'];?>&uye_id=<?php echo $_SESSION['uye_id'];?>&komut=mesajokundu""><image src= "images/mesajoku.png" title="Mesaj Oku"></a> 
			<?php } ?>
			
			
             <?php  if ($row_cl['durum']>="0" and $row_cl['yazan_id']==$_SESSION['uye_id']){ ?>			
			 <a href="ismerkezi.php?mesaj_id=<?php echo $row_cl['mesaj_id']; ?>&komut=mesajsil"><image src= "images/mesajsil.png" title="Okunan bu mesajı silebilrsiniz"></a>
             <?php } ?>
					  
					  
          	 <div class="box-footer">
			 <?php if($row_cl['durum']=="0" and $row_cl['yazan_id']!=$_SESSION['uye_id']){ ?>			
				 <form action="ismerkezi.php" method="POST">
                    <div class="input-group">
					<input type="text" name="newmesaj" placeholder="Cevabınızı bura yaz gönder ..." class="form-control">
					<input type="text" style="display:none" name="cevap_id" value="<?php echo $row_cl['yazan_id'];?>" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
                    <input type="text" style="display:none" name="komut" value="cevapyaz" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
					<input type="text" style="display:none" name="mesaj_id" value="<?php echo $row_cl['mesaj_id'];?>" class="form-control"><!-- verileri göndersin diye aktif ama gizli yaptık -->
				   <span class="input-group-btn">
                   <button type="submit" class="btn btn-primary btn-block btn-flat">Cevapla</button>
				</span>
                    </div>
                  </form>
			  <?php } ?>	
				  </div>
			<?php     }
			 while ($row_cl = mysqli_fetch_assoc($cl)); 
			 ?> 
		</div>	
		</div>
		  
		
        </div>
      </div>  
<?php } ?>     
	  
	  <!-- =============================================== -->



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