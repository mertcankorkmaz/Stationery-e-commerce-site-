<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("baglanti.php");
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: giris.php");
    exit();
}

if (isset($_SESSION["username"])) {
    $kullaniciId = $_SESSION["username"];

    // Veritabanından kullanıcının bilgilerini çek
    $sql = "SELECT user_id, username, email FROM kullanicilar WHERE username = '$kullaniciId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["user_id"];
        $username = $row["username"];
        $email = $row["email"];
    } else {
        $userId = "-";
        $username = "-";
        $email = "-";
    }
} else {
    $userId = "-";
    $username = "-";
    $email = "-";
}

// Siparişleri veritabanından çek
$orderSql = "SELECT * FROM orders WHERE user_id = '$userId'";
$orderResult = $conn->query($orderSql);

$siparisler = [];
if ($orderResult->num_rows > 0) {
    while ($orderRow = $orderResult->fetch_assoc()) {
        $siparisler[] = $orderRow;
    }
}

$conn->close();

// Get the total count of items in the shopping cart from the session
$total_count = isset($_SESSION["shoppingCart"]["summary"]["total_count"]) ? $_SESSION["shoppingCart"]["summary"]["total_count"] : 0;

// Check for error messages
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
$success = isset($_SESSION["success"]) ? $_SESSION["success"] : "";

// Clear the messages after displaying them
unset($_SESSION["error"]);
unset($_SESSION["success"]);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Kullanıcı Profili</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/pen.ico" rel="icon"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block"></div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Hesabım</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="giris.php"> <button class="dropdown-item" type="button">Giriş Yap</button></a>
                            <a href="kayıt.php"><button class="dropdown-item" type="button">Kayıt Ol</button></a>
                            <a href="logout.php"><button class="dropdown-item" type="button">Çıkış Yap</button></a>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-user text-dark"></i>
                    </a>
                    <a href="sepet.php" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;"><?php echo $total_count; ?></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Papirus</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Ürün, marka veya kategori arayın">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">İletişim No:</p>
                <h5 class="m-0">+90 567 111 19 05</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Kategoriler</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100"> 
                        <a href="index.php" class="nav-item nav-link active">Ana Sayfa</a>
                        <a href="kirtasiye.php" class="nav-item nav-link">Kırtasiye</a>
                        <a href="oyuncak.php" class="nav-item nav-link">Oyuncak</a>
                        <a href="kitap.php" class="nav-item nav-link">Kitap</a>
                        <a href="contact.php" class="nav-item nav-link">İletişim</a>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-primary bg-dark px-2">Papirus</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Ana Sayfa</a>
                            <a href="kirtasiye.php" class="nav-item nav-link ">Kırtasiye</a>
                            <a href="oyuncak.php" class="nav-item nav-link">Oyuncak</a>
                            <a href="kitap.php" class="nav-item nav-link">Kitap</a>
                            <a href="contact.php" class="nav-item nav-link">İletişim</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-user text-primary"></i>
                            </a>
                            <a href="sepet.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle cart-count" style="padding-bottom: 2px;"><?php echo $total_count; ?></span>
                            </a> 
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container">
        <h2 class="text-center my-4">Kullanıcı Profili</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <table align="center" class="table table-bordered">
            <tr>
                <th>Kullanıcı Adı</th>
                <td><?php echo isset($username) ? $username : "-"; ?></td>
            </tr>
            <tr>
                <th>E-posta</th>
                <td><?php echo isset($email) ? $email : "-"; ?></td>
            </tr>
        </table>

        <h2 class="text-center my-4">Siparişlerim</h2>
        <table align="center" class="table table-bordered">
            <tr>
                <th>Sipariş ID</th>
                <th>Tarih</th>
                <th>Toplam Tutar</th>
                <th>Durum</th>
                <th>Detaylar</th>
                <th>İptal Et</th>
            </tr>
            <?php if (!empty($siparisler)): ?>
                <?php foreach ($siparisler as $siparis): ?>
                    <tr>
                        <td><?php echo $siparis['order_id']; ?></td>
                        <td><?php echo $siparis['order_date']; ?></td>
                        <td><?php echo $siparis['total_amount']; ?></td>
                        <td><?php echo $siparis['status']; ?></td>
                        <td><a href="order_details.php?order_id=<?php echo $siparis['order_id']; ?>" class="btn btn-info">Detaylar</a></td>
                        <td>
                            <?php if ($siparis['status'] == 'İşlemde'): ?>
                                <form action="cancel_order.php" method="post" onsubmit="return confirm('Bu siparişi iptal etmek istediğinize emin misiniz?');">
                                    <input type="hidden" name="order_id" value="<?php echo $siparis['order_id']; ?>">
                                    <button type="submit" class="btn btn-danger">İptal Et</button>
                                </form>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>İptal Edilemez</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Henüz siparişiniz bulunmamaktadır.</td>
                </tr>
            <?php endif; ?>
        </table>

        <h2 class="text-center my-4">Şifre Güncelleme</h2>
        <form action="sifre_degistir.php" method="post" class="form-inline justify-content-center">
            <div class="form-group mx-sm-3 mb-2">
                <label for="currentPassword" class="sr-only">Şuanki Şifreniz</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Şuanki Şifreniz" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="newPassword" class="sr-only">Yeni Şifreniz</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Yeni Şifreniz" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="confirmPassword" class="sr-only">Yeni Şifrenizi Onaylayın</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Yeni Şifrenizi Onaylayın" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Güncelle</button>
        </form>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>
