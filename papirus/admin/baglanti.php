<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papirus";

// Veritabanına bağlan
$conn = new mysqli('localhost', 'root', '', 'papirus');

// Bağlantıyı kontrol et
if ($conn->connect_error) {
  die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}

// Bağlantıyı kapatın
//mysqli_close($conn);

/*try{
	$host='localhost';
	$vtadi='papirus';// veritabanı adı
	$kullanici='root';//varsayılan olarak kullanıcı ismi
	$sifre='';//Varsayılan olarak Mysql root şifresi boş
	$vt=new PDO("mysql:host=$host;dbname=$vtadi;charset=UTF8","$kullanici",$sifre);
}
catch(PDOException $e){
	print $e->getMessage();
} //bu dosyayı bağlantı kuracağımız her sayfa için include edeceğiz.

$conn = new mysqli('localhost', 'root', '', 'papirus');

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}*/
?>