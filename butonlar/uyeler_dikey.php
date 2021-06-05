<table width="100%" cellspacing="1" cellpadding="1">
<tr>					
		      
  <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">İşlem
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                                       

	
<?php
if(isset($_SESSION['login'])=="true"){  
if(($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?> 

<li><a href="ismerkezi.php?komut=uyesilme&uye_id=<?php echo $row_ls['uye_id']; ?>"><img src="images/sil.png" title="<?php echo "SİLİNECEK ÜYE ".$row_ls['adi_soyadi']; ?>" width="39" height="32"> Silme</a></li>

<li><a href="uyeguncelleme.php?uye_id=<?php echo $row_ls['uye_id']; ?>"><img src="images/guncelle.png" title="<?php echo "GÜNCELLENECEK ÜYE ".$row_ls['adi_soyadi']; ?>" width="32" height="32"> Güncelleme</a></li>


<?php 

if (($_REQUEST['komut'])=="okunanlar" or $_REQUEST['komut']=='uyedekiler'  or $_REQUEST['komut']=='disardakiler'){ 
if ($row_ls['teslim_tarihi']!=NULL){
	
	
$fark=round(abs(strtotime($row_ls['alis_tarihi'])-strtotime($row_ls['teslim_tarihi']))/86400); 

?>
<li><a href="#"><img src="images/kitaplar/<?php echo $row_ls['kitap_resim']; ?>"  title="<?php echo "+".$fark.' Günde okumuş.';?>" width="32" height="32"><?php echo "+".$fark.' Günde okumuş.';?></a></li>
<?php } else {
	
	
$fark=round(abs(strtotime($row_ls['alis_tarihi'])-strtotime(date("Y-m-d h:i:s")))/86400); 
	?>



<li><a href="ismerkezi.php?islem_id=<?php echo $row_ls['islem_id']; ?>&komut=kitapiade"><img src="images/user.png"  title="<?php echo "+".$fark.' Gün, iade edilecek.';?>" width="32" height="32"><?php echo $fark.' Gündür okuyor, iade edilecek.';?></a></li>
<?PHP 
}
}
?>


<?php
$sorgu=mysqli_query($baglanti,"select * from sepet where uye_id='".$row_ls['uye_id']."'"); 
$varr=0;
 while($fetch = mysqli_fetch_array($sorgu))  {
	 $varr++;
 }
if ($varr>=1){ ?>
<li><a href="ismerkezi.php?komut=sepetionayla&uye_id=<?php echo $row_ls['uye_id']; ?>"><img src="images/sepetonay.png" title="<?php echo "SEPETİ ONAYLANACAK ÜYE ".$row_ls['adi_soyadi']; ?>" width="32" height="32"> Sepetini Onayla</a></li>
<?php } ?>









<?php
$sorguq=mysqli_query($baglanti,"select * from sepet where uye_id='".$_SESSION['uye_id']."' AND '".$_SESSION['yetki']."'>='".$_SESSION['superadmin']."'"); 
$vara=0;
 while($fetch = mysqli_fetch_array($sorguq))  {
	 $vara++;
 }
if ($vara>=1){ ?>
<li><a href="ismerkezi.php?komut=sepetiaktar&uye_id=<?php echo $row_ls['uye_id']; ?>"><img src="images/sepetaktar.png" title="<?php echo $row_ls['adi_soyadi']." AKTİF SEPETİ ALACAK"; ?>" width="32" height="32">Aktif Sepeti Aktar</a></li>
<?php } ?>





<?php } ?>


<li><a href="echat.php?komut=ozelmesaj&mesajadresi=<?php echo $row_ls['adi_soyadi']; ?>&uye_id=<?php echo $row_ls['uye_id']; ?>"><img src="images/mesajyaz.png" title="<?php echo "MESAJ YAZILACAK ÜYE ".$row_ls['adi_soyadi']; ?>" width="32" height="32"> Mesaj Gönder</a></li>



<?php }  ?>

<li class="divider"></li>

<li><a href="liste.php?baslik_resim=<?php echo $row_ls['uye_resim'];?>&komut=okunanlar&baslik=<?php echo $row_ls['adi_soyadi']." ÜYENİN OKUDUĞU KİTAPLAR"; ?>&uye_id=<?php echo $row_ls['uye_id']; ?>"><img src="images/kitapoku.png" title="<?php echo $row_ls['adi_soyadi']." ÜYENİN OKUDUĞU KİTAPLAR"; ?>" width="32" height="32"> Okuduğu Kitaplar</a></li>



</ul>
</div>
</tr>
</table>
