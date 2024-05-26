<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'path/to/PHPMailer/src/PHPMailer.php';
require_once 'path/to/PHPMailer/src/SMTP.php';
require_once 'path/to/PHPMailer/src/Exception.php';

// Hata ayıklama ayarlarını yapılandırın
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_log("Hata mesajı");

// Veritabanı bağlantısı yapın
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papirus";

try {
  $conn = new mysqli('localhost', 'root', '', 'papirus');
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log("Veritabanı hatası: " . $e->getMessage());
    http_response_code(500);
    exit("Veritabanı hatası");
}

// Form verilerini alın
if(empty($_POST['adsoyad']) || empty($_POST['yazi']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$adsoyad = strip_tags(htmlspecialchars($_POST['adsoyad']));
$mail = strip_tags(htmlspecialchars($_POST['mail']));
$yazi = strip_tags(htmlspecialchars($_POST['yazi']));

// Veritabanına kaydetmek için form verilerini hazırlayın

$stmt = $conn->prepare("INSERT INTO iletisim1 (isim, email, mesaj) VALUES ('$adsoyad', '$mail', '$yazi')");
$stmt->bindParam('$adsoyad', $adsoyad);
$stmt->bindParam('$mail', $mail);
$stmt->bindParam('$yazi', $yazi);

// Veritabanına kaydet
try {
    $stmt->execute();
} catch(PDOException $e) {
    error_log("Veritabanı hatası: " . $e->getMessage());
    http_response_code(500);
    exit("Veritabanı hatası");
}

// PHPMailer nesnesi oluşturun
$mail = new PHPMailer();

// SMTP ayarlarını yapılandırın
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'elmasbayram2000@gmail.com'; 
$mail->Password = 'Yagmurelmas.2001'; 
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// E-posta gönderim bilgilerini ayarlayın
$mail->setFrom($mail, $adsoyad);
$mail->addAddress('elmasbayram2000@gmail.com'); // Alıcının e-posta adresini belirtin
$mail->Subject = $adsoyad;
$mail->Body = $yazi;

// E-postayı gönderin
if(!$mail->send()) {
    http_response_code(500);
    error_log("Failed to send email to ");
    exit("Failed to send email");
} else {
    echo "Email sent successfully";
}
?>