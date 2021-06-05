<?php
ob_start();
session_start();
include "connections/baglanti.php";
 

 if(!isset($_SESSION['login'])=='true'){ 
$deleteGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
  ob_end_flush();
 exit();
 } 


$boy=200;
//$yol = "images/";




  
if($_REQUEST['komut']=='uyeresmi'){
$yeniisim=$_REQUEST['telefon'];
$yol = "images/uyeler/";
 }


  
if($_REQUEST['komut']=='kitapresmi'){
$yeniisim=$_REQUEST['kitap_id'];
$yol = "images/kitaplar/";
  }

  


if (strlen($_FILES['RESIM']['name']))
 {
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
$gecerli_formatlar = array("PNG","JPG","GIF","png","jpg","gif");


//$gecerli_formatlar = array("jpg","jpeg","png","gif");



$yeni_adi= $yeniisim;
 
$dosyaadi = $_FILES['RESIM']['name'];
$boyutu = $_FILES['RESIM']['size'];

echo "<p>" ;
 
if(strlen($dosyaadi))
{
list($txt, $uzanti) = explode(".", $dosyaadi);




$uzanti= strtolower($uzanti);




if(in_array($uzanti,$gecerli_formatlar))
{
if($boyutu<(4096*4096))
{
$yeni_adi = $yeniisim.".".$uzanti;



$gecici = $_FILES['RESIM']['tmp_name'];

if(move_uploaded_file($gecici, $yol.$yeni_adi))
{
$dosya = $yol.$yeni_adi;




if ($uzanti=="jpg"  || $uzanti=="JPG" )
$resim = imagecreatefromjpeg($dosya);  

if ($uzanti=="png"  || $uzanti=="PNG" )
$resim = imagecreatefrompng($dosya); 
 
if ($uzanti=="gif" || $uzanti=="GIF" )
$resim = imagecreatefromgif($dosya); 
 
$boyutlar = getimagesize($dosya);  
 
$resimorani = $boy / $boyutlar[0];  
$yeniyukseklik = $resimorani*$boyutlar[1];  
 
$yeniresim = imagecreatetruecolor($boy, $yeniyukseklik);
 
if ($uzanti=="png" || $uzanti=="gif"  || $uzanti=="GIF"  || $uzanti=="PNG")
{
imagecolortransparent($yeniresim, imagecolorallocatealpha($yeniresim, 0, 0, 0, 127));
imagealphablending($yeniresim, false);
imagesavealpha($yeniresim, true);
}
 
imagecopyresampled($yeniresim, $resim, 0, 0, 0, 0, $boy, $yeniyukseklik, $boyutlar[0], $boyutlar[1]);
$hedefdosya=$yol.$yeni_adi;



 
switch($uzanti) {

case "gif":
imagegif($yeniresim,$hedefdosya); 
break;

case "jpg":
imagejpeg($yeniresim,$hedefdosya,100); 
break;


case "png":
case "x-png":
imagepng($yeniresim,$hedefdosya);  
break;

 
chmod ($hedefdosya, 0777);
$resimsonuc.= "<center><img src='".$yol."'.'".$yeniresim."'  class='preview'></center> ";

} //switch


		

 if($_REQUEST["komut"]=='uyeresmi'){
$sor=mysqli_query($baglanti,"UPDATE uyeler SET uye_resim='$yeni_adi' where telefon='".$_REQUEST['telefon']."'");  
  }
 
if($_REQUEST["komut"]=="kitapresmi"){
$sor=mysqli_query($baglanti,"UPDATE kitaplar SET kitap_resim='$yeni_adi' where kitap_id='".$_REQUEST['kitap_id']."'");  
  }



// geldiği sayfaya geri gönderiyoruz  
$geldigi_sayfa = $_SERVER['HTTP_REFERER'];  

  
  if (isset($_SERVER['QUERY_STRING'])) {
    $$geldigi_sayfa .= (strpos($geldigi_sayfa, '?')) ? "&" : "?";
    $$geldigi_sayfa .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $geldigi_sayfa));
  
ob_end_flush();

exit();


 
 
 
}
} else echo "Fotoğraf boyutu maks 4 MB olabilir, resminiz çok büyük..."; 
}else echo "Geçersiz dosya formati, JPG veya PNG formatında olmalıdır."; 
} else echo "Resim veya fotoğraf seçiniz..!";
 
 
}//post
}//dosya adı

ob_end_flush();

 ?>