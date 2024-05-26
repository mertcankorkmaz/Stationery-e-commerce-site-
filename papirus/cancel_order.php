<?php
include("baglanti.php");
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: giris.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_id"])) {
    $orderId = $_POST["order_id"];
    
    // Siparişi iptal et
    $cancelSql = "UPDATE orders SET status = 'İptal Edildi' WHERE order_id = '$orderId'";
    if ($conn->query($cancelSql) === TRUE) {
        $_SESSION["success"] = "Sipariş başarıyla iptal edildi.";
    } else {
        $_SESSION["error"] = "Siparişi iptal ederken bir hata oluştu.";
    }
}

$conn->close();
header("Location: profil.php");
exit();
?>
