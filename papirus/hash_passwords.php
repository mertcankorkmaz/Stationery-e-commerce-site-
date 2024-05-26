<?php
// Veritabanı bağlantısını yapalım
$db = mysqli_connect('localhost', 'root', '', 'papirus');
if (!$db) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Kullanıcıları seçen sorgu
$query = "SELECT * FROM kullanicilar";
$results = mysqli_query($db, $query);

// Kullanıcıları döngü ile kontrol edip şifrelerini hashle
while ($user = mysqli_fetch_assoc($results)) {
    $id = $user['id'];
    $plain_password = $user['password'];
    // Şifre zaten hashlenmiş mi kontrol et
    if (password_get_info($plain_password)['algo'] === 0) {
        // Şifreyi hashle
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
        // Hashlenmiş şifreyi veritabanına güncelle
        $update_query = "UPDATE kullanicilar SET password='$hashed_password' WHERE id=$id";
        mysqli_query($db, $update_query);
    }
}

echo "Şifreler hashlenmiş olarak güncellendi.";
?>
