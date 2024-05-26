<?php
include("baglanti.php");
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: giris.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    $username = $_SESSION["username"];

    if ($newPassword != $confirmPassword) {
        $_SESSION["error"] = "Yeni şifreler uyuşmuyor.";
        header("Location: profil.php");
        exit();
    }

    $sql = "SELECT password FROM kullanicilar WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($currentPassword, $hashedPassword)) {
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateSql = "UPDATE kullanicilar SET password = '$newHashedPassword' WHERE username = '$username'";

            if ($conn->query($updateSql) === TRUE) {
                $_SESSION["success"] = "Şifreniz başarıyla güncellendi.";
            } else {
                $_SESSION["error"] = "Şifre güncellenirken hata oluştu: " . $conn->error;
            }
        } else {
            $_SESSION["error"] = "Mevcut şifreniz yanlış.";
        }
    } else {
        $_SESSION["error"] = "Kullanıcı bulunamadı.";
    }

    $conn->close();
    header("Location: profil.php");
    exit();
}
?>
