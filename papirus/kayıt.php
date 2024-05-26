<?php
// Veritabanı bağlantısını yapalım
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papirus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = array();

// Form gönderildiğinde çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password_1 = $_POST["password_1"];
    $password_2 = $_POST["password_2"];
    $email = $_POST["email"];

    // Boş alan kontrolü
    if (empty($username)) { array_push($errors, "Kullanıcı adı gerekli"); }
    if (empty($password_1)) { array_push($errors, "Şifre gerekli"); }
    if (empty($email)) { array_push($errors, "Email gerekli"); }
    if ($password_1 != $password_2) { array_push($errors, "Şifreler eşleşmiyor"); }

    // Kullanıcı adı veya email'in daha önce kullanılıp kullanılmadığını kontrol et
    $user_check_query = "SELECT * FROM kullanicilar WHERE username='$username' OR email='$email' LIMIT 1";
    $result = $conn->query($user_check_query);
    $user = $result->fetch_assoc();

    if ($user) { // Kullanıcı var mı?
        if ($user['username'] === $username) {
            array_push($errors, "Kullanıcı adı zaten mevcut");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email zaten mevcut");
        }
    }

    // Hatalar yoksa kullanıcıyı kaydet
    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT); // Şifreyi hash'le

        $sql = "INSERT INTO kullanicilar (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Kayıt başarılı!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Yeni Kayıt Sayfası</title>
    <link rel="stylesheet" href="./css/loginstyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="shortcut icon" href="./img/pen.ico"/>
</head>
<body>
<div class="login-card-container">
    <div class="login-card">
        <div class="login-card-logo">
            <img src="./img/pen.ico" alt="logo">
        </div>
        <div class="login-card-header">
            <h1>Kayıt Ol</h1>
        </div>
        <form method="post" action="kayıt.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
                <label>Kullanıcı adı</label>
                <input type="text" name="username">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email">
            </div>
            <div class="input-group">
                <label>Şifre</label>
                <input type="password" name="password_1">
            </div>
            <div class="input-group">
                <label>Şifreyi tekrar giriniz</label>
                <input type="password" name="password_2">
            </div>
            <br>
            <button type="submit" name="reg_user">Kayıt Ol</button>
        </form>
        <div class="login-card-footer">
            Zaten bir hesabınız var mı? <a href="giris.php">Hemen giriş yap</a>
        </div>
    </div>
    <div class="login-card-social">
        <div>Bizi takip edebileceğiniz diğer kaynaklar</div>
        <div class="login-card-social-btn">
            <a href="https://www.linkedin.com/in/mertcankorkmazzz/" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path>
                </svg>
            </a>
            <a href="https://linktr.ee/mertcankorkmaz" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                    <path d="M16.5 7.5l0 .01"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
</body>
</html>
