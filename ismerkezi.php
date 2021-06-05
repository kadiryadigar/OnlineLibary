<?php
session_start (); 
include "connections/baglanti.php";
ob_start(); 






//********************************************* SEPET BÖLÜMÜ************************************************************************

//*********************************************LOGIN SEPET ONAYI************************************************************************
if($_REQUEST['komut']=="loginsepetionayla"){
$geldigi_sayfa ="liste.php?komut=uyearama&aranan=";  

$sorgus=mysqli_query($baglanti,"SELECT *FROM sepet WHERE uye_id= '".$_SESSION['uye_id']."'");	
if ($sorgus){
	 while($sepet = mysqli_fetch_array($sorgus)) { 
	 $sorgu=mysqli_query($baglanti,"INSERT INTO islemler (uye_id,kitap_id) VALUES ('".$_SESSION['uye_id']."','".$sepet['kitap_id']."')");
}
}
}


//****************************************** ÜYEYE ADMİN SEPETİNİ AKTARMA ****************************************
if($_REQUEST['komut']=="sepetiaktar"){
	$geldigi_sayfa="liste.php?komut=uyearama&aranan=";
$sorgus=mysqli_query($baglanti,"SELECT *FROM sepet WHERE uye_id= '".$_SESSION['uye_id']."'");	
	 while($sepet = mysqli_fetch_array($sorgus))
     { 
	  $sorgu=mysqli_query($baglanti,"INSERT INTO islemler (uye_id,kitap_id) VALUES ('".$_REQUEST['uye_id']."','".$sepet['kitap_id']."')");
} 
}

//***************************
if($_REQUEST['komut']=="loginsepetionayla" or $_REQUEST['komut']=="sepetiaktar" or $_REQUEST['komut']=="sepetibosalt" ){
$sorgu=mysqli_query($baglanti,"DELETE FROM sepet where uye_id='".$_SESSION['uye_id']."'");
}
//*******************************************************************************************************************************************




//******************************************** ÜYE SEPET ONAYI ***************************************************

if($_REQUEST['komut']=="sepetionayla" and $_SESSION['yetki']>=$_SESSION['superadmin']){
	
$geldigi_sayfa="liste.php?komut=uyearama&aranan=";
	
$sorgus=mysqli_query($baglanti,"SELECT *FROM sepet WHERE uye_id= '".$_REQUEST['uye_id']."'");	
if ($sorgus){
	 while($sepet = mysqli_fetch_array($sorgus)) { 
	 $sorgu=mysqli_query($baglanti,"INSERT INTO islemler (uye_id,kitap_id) VALUES ('".$_REQUEST['uye_id']."','".$sepet['kitap_id']."')");
}
}
// SEPET AKTARILDIKTAN SONRA BOŞALTILACAK
$sorgu=mysqli_query($baglanti,"DELETE FROM sepet WHERE uye_id= '".$_REQUEST['uye_id']."'");	
}




//**********************************LOGİN ÜYECE KİTAP SEPETE EKLEME*******************************
if($_REQUEST['komut']=="sepetencikar"){
$geldigi_sayfa ="liste.php?komut=kitaparama&aranan=";  
$sorgu=mysqli_query($baglanti,"DELETE FROM sepet WHERE sepet_id= '".$_REQUEST['sepet_id']."'");	
}



//***************************kitapekleme*******************************
if($_REQUEST['komut']=="kitapekleme"){	
$geldigi_sayfa ="liste.php?komut=kitaparama&aranan="; 	
$sorgu=mysqli_query($baglanti,"INSERT INTO kitaplar 
(kitap_adi, yazari, yayinevi, basim_tarihi, fiyati, stok) VALUES 
('".$_REQUEST['kitap_adi']."','".$_REQUEST['yazari']."', '".$_REQUEST['yayinevi']."', '".$_REQUEST['basim_tarihi']."', '".$_REQUEST['fiyati']."', '".$_REQUEST['stok']."')");
}           
//***************************kitapguncelleme*******************************
if($_REQUEST['komut']=="kitapguncelleme"){	
$geldigi_sayfa ="liste.php?komut=kitaparama&aranan="; 	
$sorgu=mysqli_query($baglanti,"UPDATE kitaplar SET kitap_adi='".$_REQUEST['kitap_adi']."', yazari='".$_REQUEST['yazari']."', yayinevi='".$_REQUEST['yayinevi']."', basim_tarihi='".$_REQUEST['basim_tarihi']."', fiyati='".$_REQUEST['fiyati']."', stok='".$_REQUEST['stok']."' where kitap_id='".$_REQUEST['kitap_id']."' and kitap_id>5");
}



 
//**********************************ÜYE EKLEME*******************************
if($_REQUEST['komut']=="uyeekleme"){	
$geldigi_sayfa ="liste.php?komut=uyearama&aranan="; 
$sorgu=mysqli_query($baglanti,"INSERT INTO uyeler (yetki, telefon, adi_soyadi, eposta, sifre) VALUES 
('".$_REQUEST['yetki']."','".$_REQUEST['telefon']."', '".$_REQUEST['adi_soyadi']."', '".$_REQUEST['eposta']."', md5('".$_REQUEST['sifre']."'))");

/*
 if ($sorgu){
	 echo " ok";
	 die;
 }else{	 
	 echo mysqli_error();
	 die;
	 
 }
 */
}


//**********************************ÜYE günceleme*******************************
if($_REQUEST['komut']=="uyeguncelleme"){	
$geldigi_sayfa ="liste.php?komut=uyearama&aranan="; 
$sorgu=mysqli_query($baglanti,"UPDATE uyeler SET yetki='".$_REQUEST['yetki']."',telefon='".$_REQUEST['telefon']."', adi_soyadi='".$_REQUEST['adi_soyadi']."', eposta='".$_REQUEST['eposta']."', sifre=md5('".$_REQUEST['sifre']."') where uye_id='".$_REQUEST['uye_id']."' and uye_id>3");
}




//**********************************LOGİN ÜYECE KİTAP SEPETE EKLEME*******************************
if($_REQUEST['komut']=="sepeteekle"){
$geldigi_sayfa ="liste.php?komut=kitaparama&aranan=";  	
$sorgu=mysqli_query($baglanti,"INSERT INTO sepet (uye_id,kitap_id) VALUES ('".$_SESSION['uye_id']."','".$_REQUEST['kitap_id']."')");
}



//*****************************************************************
if($_REQUEST['komut']=="kitapiade"){
$geldigi_sayfa ="liste.php?komut=uyearama&aranan=";  
$zaman2=date("Y-m-d h:i:s");
$sorgu=mysqli_query($baglanti,"UPDATE islemler SET teslim_tarihi='".$zaman2."' where islem_id='".$_REQUEST['islem_id']."'");
}

//********************************************* SEPET KİTAP BÖLÜMÜ SONU ************************************************************************






//****************************************** MESAJLARLA İLGİLİ BÖLÜM **********************************************************************
if($_REQUEST['komut']=="mesajokundu"){
$sorgui=mysqli_query($baglanti,"INSERT INTO okunan_mesajlar (mesaj_id,uye_id) VALUES ('".$_REQUEST['mesaj_id']."','".$_SESSION['uye_id']."')");
}



function sil ($sil_id) { 
 mysqli_query("delete from mesajlar where mesaj_id='$sil_id'"); 
 $sorgu=mysqli_query("select mesaj_id from mesajlar where cevap_id='$sil_id' or ana_id='$sil_id'"); 
 
 while ($silinecek=mysqli_fetch_array($sorgu)){ 
  
  sil ($silinecek['mesaj_id']); 
 } 
} 

//*********************************
if($_REQUEST['komut']=="mesajsil"){
sil($_REQUEST['mesaj_id']);
  }














//*********************************
if($_REQUEST['komut']=="cevapyaz"){
$cevap_id=$_REQUEST['cevap_id'];
$mesaj_id=$_REQUEST['mesaj_id'];
$newmesaj=$_REQUEST['newmesaj'];


$sorgui=mysqli_query($baglanti,"INSERT INTO mesajlar (mesaj,cevap_id,yazan_id) VALUES ('".$_REQUEST['newmesaj']."','".$_REQUEST['mesaj_id']."','".$_SESSION['uye_id']."')");

if($mesaj_id!=0){
$sorguu=mysqli_query("UPDATE mesajlar SET durum='1' where mesaj_id='".$_REQUEST['mesaj_id']."'");	
}

 
 
 
 
 if ($sorgu){
	 echo "oooooooo";
 }else{
	 
	 
	 echo "noooo".mysqli_error();
 }
}
//**************************************** MESAJLARLA İLGİLİ BÖLÜM ********************************************************************************
 



//********************ÜYE SİLME *********************************************
if($_REQUEST['komut']=="uyesilme"){
$geldigi_sayfa ="liste.php?komut=uyearama&aranan=";  
if ((isset($_REQUEST['uye_id'])) && ($_REQUEST['uye_id'] != "")  && ($_REQUEST['uye_id'] != $_SESSION['uye_id']) && (($_SESSION['yetki'])>=($_SESSION['superadmin']) )) {
$sorgu=mysqli_query($baglanti,"DELETE FROM uyeler where uye_id='".$_REQUEST['uye_id']."' and uye_id>3");

 
    


}
}


//********************KİTAP SİLME *********************************************
if($_REQUEST['komut']=="kitapsilme"){
$geldigi_sayfa ="liste.php?komut=kitaparama&aranan=";  
if ((isset($_REQUEST['kitap_id'])) && ($_REQUEST['kitap_id'] != "") && (($_SESSION['yetki'])>=($_SESSION['superadmin']) )) {
$sorgu=mysqli_query($baglanti,"DELETE FROM kitaplar where kitap_id='".$_REQUEST['kitap_id']."' and kitap_id>5");

}
}





// geldiği sayfaya geri gönderiyoruz  

if ($geldigi_sayfa){
	
}else{
$geldigi_sayfa = $_SERVER['HTTP_REFERER'];  
}


  
  if (isset($_SERVER['QUERY_STRING'])) {
    $$geldigi_sayfa .= (strpos($geldigi_sayfa, '?')) ? "&" : "?";
    $$geldigi_sayfa .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $geldigi_sayfa));
  
ob_end_flush();

exit();






