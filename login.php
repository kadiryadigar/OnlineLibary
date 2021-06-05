<?php
session_start (); 
ob_start ();
include "connections/baglanti.php";

 
      $myusername = $_REQUEST['kullanici']; // POST İLE GELEN Kullanici adı
      $mypassword = $_REQUEST['sifre'];    // POST İLE GELEN ŞİFRE
	  
	   	
		
	  
$sorgulogin=mysqli_query($baglanti,"select * from uyeler where (telefon='".$_REQUEST['kullanici']."' or eposta='".$_REQUEST['kullanici']."' or uye_id='".$_REQUEST['kullanici']."') and sifre=md5('".$_REQUEST['sifre']."')");



         if (mysqli_num_rows($sorgulogin) > 0) {			
			 
            while($kayit = mysqli_fetch_assoc($sorgulogin)) {
         
			   
			   
				
	
        $_SESSION['superadmin'] ="3";
		$_SESSION['admin'] ="2";
		$_SESSION['login']="true";
		$_SESSION['sifre'] = $kayit['sifre'];
		$_SESSION['telefon'] = $kayit['telefon'];
		$_SESSION['eposta'] = $kayit['eposta'];	 
		$_SESSION['adi_soyadi'] = $kayit['adi_soyadi'];
	    $_SESSION['uye_id'] = $kayit['uye_id'];
		$_SESSION['kayit_tarihi'] = $kayit['kayit_tarihi'];
		$_SESSION['uye_resim'] = $kayit['uye_resim'];
		
		$_SESSION['islemmenu'] = "yatay";
	
		
		
//eğer giriş yapan id no 1 ise yetkisi ne olursa olsun onu otomat Super Admin olarak yetkilendiriyoruz
if ($kayit['uye_id']==1) {
$_SESSION['yetki'] = "3";
}else{
$_SESSION['yetki'] =  $kayit['yetki'];
}

//***************************************** 
 $url = "index.php";
echo"<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=".str_replace('&amp;', '&', $url)."  \">";

exit();
  }
}  else {
	  
	 
	  
	  die;
	$_SESSION['login']="false";
	
	$url = "cikis.php";
 echo"<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=".str_replace('&amp;', '&', $url)."  \">";
exit();
  } 
  


ob_end_flush();
?>
