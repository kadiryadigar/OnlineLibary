
<table width="100%" cellspacing="1" cellpadding="1">
<tr>
<?php					
if(isset($_SESSION['login'])=="true"){  
if(($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  ?> 
<td><a href="ismerkezi.php?komut=kitapsilme&kitap_id=<?php echo $row_ls['kitap_id']; ?>"><img src="images/sil.png" width="39" title="Kitap Silme" height="32"></a></td>
<td><a href="kitapguncelleme.php?kitap_id=<?php echo $row_ls['kitap_id']; ?>"><img src="images/guncelle.png"  title="Kitap güncelleme" width="32" height="32"></a></td>


<?php } ?>


<td><a href="ismerkezi.php?komut=sepeteekle&kitap_id=<?php echo $row_ls['kitap_id']; ?>"><img src="images/sepeteekle.png"  title="Sepete Ekle" width="32" height="32"></a></td>




<?php 
if (($_REQUEST['komut'])=="okunanlar" or $_REQUEST['komut']=='uyedekiler'  or $_REQUEST['komut']=='disardakiler'){ 
	
if ($row_ls['teslim_tarihi']!=NULL){
	$fark=round(abs(strtotime($row_ls['alis_tarihi'])-strtotime($row_ls['teslim_tarihi']))/86400); 
?>
<td><a href="#"><img src="images/kitaplar/<?php echo $row_ls['kitap_resim']; ?>"  title="<?php echo "+".$fark.' Günde okumuş.';?>" width="32" height="32"></a></td>
<?php } else { 
$fark=round(abs(strtotime($row_ls['alis_tarihi'])-strtotime(date("Y-m-d h:i:s")))/86400); 





if(($_SESSION['yetki'])>=($_SESSION['superadmin']) ){  
?> 

<td>
<a href="ismerkezi.php?islem_id=<?php echo $row_ls['islem_id']; ?>&komut=kitapiade"><img src="images/user.png"  title="Kitap İade" width="32" height="32"></a>
</td>


<?php 
} 
} 
}
?>

<?php
}
?>

<td>
<a href="liste.php?baslik_resim=<?php echo $row_ls['kitap_resim']; ?>&baslik=<?php echo $row_ls['kitap_adi']." Kimler Okumuş"; ?>&komut=okuyanlar&kitap_id=<?php echo $row_ls['kitap_id']; ?>"><img src="images/uyeler.png"  title="Okuyan Üyeler" width="32" height="32"></a>
</td>


</tr>
</table>
