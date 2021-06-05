<?php 
# Hataları Gizle #
	error_reporting(0);
	
$host 		= "localhost";
$user		= "root";
$pass		= "";
$db		= "kitaplik";



$baglanti = new mysqli($host,$user,$pass);

if($baglanti->connect_errno) die ('Bağlantı Hatası:' .$baglanti->connect_error);
$baglanti->set_charset("utf8");
$s=$baglanti->prepare("CREATE DATABASE IF NOT EXISTS $db"); 
$s->execute();

$baglanti->query("USE  $db");
$result = $baglanti->prepare("SHOW TABLES FROM $db");
$result->execute();
$sonuc=$result->get_result();
	
	
if($sonuc->num_rows>0){
//echo "kayıt sayısı:".$sonuc->num_rows; 
//tablo varsa aşağıdaki kodlara gitmeden bu sayfadan çıkış yapıyoruz
}ELSE{
//echo "kayıt sayısı:".$sonuc->num_rows;




//************* TABLOLAR VE ÖRNEK KAYITLAR OLUŞTURMA ************************


$zaman=date("Y-m-d h:i:s");



$sql1 = $baglanti->prepare("CREATE TABLE IF NOT EXISTS uyeler (
  `uye_id` int(11) NOT NULL AUTO_INCREMENT,
  `yetki` int(11) DEFAULT 1,
  `telefon` varchar(11) COLLATE utf8_turkish_ci DEFAULT NULL UNIQUE,
  `adi_soyadi` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `eposta` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kayit_tarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `uye_resim` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `sifre` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL,
  `uye_durum`  int(11) DEFAULT 0,
   index(uye_id),
   PRIMARY KEY (uye_id) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;");

$sql1->execute();



if ($sql1) { 
$kayittarihi=date("d-m-Y h:i:s");
$sorgu1 = $baglanti->prepare("INSERT INTO uyeler (telefon,adi_soyadi,eposta,uye_resim,sifre,yetki) VALUES 
('05327896543','VELİ YETİŞGENGİL','yetısveli@gmail.com','05424196898.png','698d51a19d8a121ce581499d7b701668',3),
('05427896543','ALİ YASİR YILMAZ','yasirali@gmail.com','5555555555.jpg','bcbe3365e6ac95ea2c0343a2395834dd',2),
('05057896543','KADİR YADİGAR','kadiryadigar@gmail.com','kadir.jpg','310dcbbf4cce62f762a2aaa148d556bd',1)");
$sorgu1->execute();
}



$sql2 = $baglanti->prepare("CREATE TABLE IF NOT EXISTS kitaplar (
  `kitap_id` int unsigned NOT NULL AUTO_INCREMENT,
  `kitap_adi` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `yazari` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `yayinevi` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL,
  `basim_tarihi` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL, 
  `kitap_resim` varchar(30) COLLATE utf8_turkish_ci DEFAULT NULL,
  `fiyati` int DEFAULT NULL,   
  `stok` int DEFAULT NULL,   
  `kitap_durum`  int(11) DEFAULT NULL,
   PRIMARY KEY ( kitap_id ) 
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;");
$sql2->execute();

if ($sql2) { 
$sorgu2 = $baglanti->prepare("INSERT INTO kitaplar(kitap_adi,yazari,yayinevi,basim_tarihi,kitap_resim,fiyati,kitap_durum) VALUES 
('DEVLET','DEVLET','KÜLTÜR','2020','8.jpg','12','0'),
('BEYAZ GECELER','DOSTOYEVSKİ','KÜLTÜR','2020','7.jpg','12','0'),
('VAİDEKİ ZAMBAK','BALZAC','KÜLTÜR','2020','6.jpg','12','0'),
('İDEAL DEVLET','FARABİ','KÜLTÜR 2020','2020','5.jpg','12','0'),
('TOPLUM SÖZLEŞMESİ','JEAN-JACQUES ROUSSEAU','KÜLTÜR','2020','9.jpg','12','0')");
$sorgu2->execute();

}



$sql3 = $baglanti->prepare("CREATE TABLE IF NOT EXISTS islemler (
  `islem_id` int(11) NOT NULL AUTO_INCREMENT,
  `uye_id` int NOT NULL,   
  `kitap_id` int DEFAULT NULL,   
  `alis_tarihi` timestamp DEFAULT CURRENT_TIMESTAMP,
  `teslim_tarihi` timestamp ON UPDATE CURRENT_TIMESTAMP,
   index(uye_id),  
   foreign key (uye_id) REFERENCES uyeler(uye_id) on delete cascade,
   PRIMARY KEY (islem_id) 
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;");
$sql3->execute();

if ($sql3) { 
$sorgu3 = $baglanti->prepare("INSERT INTO islemler(islem_id,uye_id,kitap_id) VALUES 
(1,1,1)");
$sorgu3->execute();
}


$sql4 = $baglanti->prepare("CREATE TABLE IF NOT EXISTS `mesajlar` (
  `mesaj_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cevap_id` int(11) DEFAULT NULL,
  `yazan_id` int(11) DEFAULT NULL,
  `ana_id` int(11) DEFAULT NULL,
  `mesaj` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL,
  `zaman1` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `zaman2` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `durum`  int(11) DEFAULT 0,
  
   PRIMARY KEY (`mesaj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;");
$sql4->execute();

if ($sql4) {
$sorgu4 = $baglanti->prepare("INSERT INTO mesajlar (mesaj_id,`cevap_id`,`yazan_id`,`ana_id`,mesaj,durum) VALUES 
(1,0,1,1,'Aramıza Hoşgeldiniz','0'),
(2,1,2,1,'Hoşbulduk','0'),
(3,2,3,1,'Hoşbulduk Sağolun','0')");	
$sorgu4->execute();
}


$sql5 = $baglanti->prepare("CREATE TABLE IF NOT EXISTS `okunan_mesajlar` (
  `okunan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesaj_id` int(10)  DEFAULT NULL,
  `uye_id` int(10)  DEFAULT NULL,
  `zaman1` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`okunan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;");

$sql5->execute();

if ($sql5) {
$sorgu5 = $baglanti->prepare("INSERT INTO OKUNAN_mesajlar (mesaj_id,`uye_id`) VALUES 
(1,1),
(1,2),
(1,3)");	
$sorgu5->execute();
}





$sql6 = $baglanti->prepare("CREATE TABLE IF NOT EXISTS `yetkiler` (
  `yetki_id` int NOT NULL,
  `yetki` varchar(20) COLLATE utf8_turkish_ci DEFAULT NULL UNIQUE,
   PRIMARY KEY ( yetki_id ) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;");
$sql6->execute();

if (sql6) 
{
$sorgu6 = $baglanti->prepare("INSERT INTO yetkiler (yetki_id,yetki) VALUES (1,'Üye'),(2,'Admin'),(3,'Super Admin')");
$sorgu6->execute();
}





$sql7 = $baglanti->prepare("CREATE TABLE IF NOT EXISTS sepet (
  `sepet_id` int unsigned NOT NULL AUTO_INCREMENT,
  `uye_id` int DEFAULT NULL,    
  `kitap_id` int DEFAULT NULL,   
   PRIMARY KEY ( sepet_id ) 
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;");
$sql7->execute();


if ($sql7) 
{
$sorgu7 = $baglanti->prepare("INSERT INTO sepet (uye_id,kitap_id) VALUES 
(1,1),(2,2),(1,5)");
$sorgu7->execute();
}









	}
	
	
	
	
?>


