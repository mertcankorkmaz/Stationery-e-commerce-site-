<?php
include ("baglanti.php");
$sql = "SELECT * FROM oyuncaklar";
$result = mysqli_query($conn, $sql);
$oyuncaklar = mysqli_fetch_all($result, MYSQLI_ASSOC);
session_start();
$total_count = isset($_SESSION["shoppingCart"]["summary"]["total_count"]) ? $_SESSION["shoppingCart"]["summary"]["total_count"] : 0;
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Oyuncak</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/pen.ico" rel="icon"/>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            function updateCartCount() {
                $.ajax({
                    url: 'sepet_db.php',
                    method: 'POST',
                    data: { p: 'getCart' },
                    success: function(response) {
                        $('.cart-count').text(response);
                    }
                });
            }

            updateCartCount(); // Update cart count on page load

            $('.enlarge-image').click(function() {
                var imageUrl = $(this).attr('src');
                $('body').append('<div class="enlarge-image-overlay"></div>');
                $('body').append('<div class="enlarge-image-container"><img src="' + imageUrl + '"></div>');
                $('.enlarge-image-overlay').fadeIn();
                $('.enlarge-image-container').fadeIn();
            });

            $('body').on('click', '.enlarge-image-overlay', function() {
                $('.enlarge-image-overlay').fadeOut(function() {
                    $(this).remove();
                });
                $('.enlarge-image-container').fadeOut(function() {
                    $(this).remove();
                });
            });

            $('.addToCartBtn').click(function(event) {
                event.preventDefault();
                var productId = $(this).data('product-id');
                $.ajax({
                    url: 'sepet_db.php',
                    method: 'POST',
                    data: { p: 'addToCart', urun_id: productId, category: 'oyuncaklar' },
                    success: function(response) {
                        updateCartCount();
                    }
                });
            });
        });
    </script>

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
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
                            <a href="giris.php"><button class="dropdown-item" type="button">Giriş Yap</button></a>
                            <a href="kayıt.php"><button class="dropdown-item" type="button">Kayıt Ol</button></a>
                            <a href="logout.php"><button class="dropdown-item" type="button">Çıkış Yap</button></a>
                        </div>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="profil.php" class="btn px-0 ml-2">
                        <i class="fas fa-user text-dark"></i>
                    </a>
                    <a href="sepet.php" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle cart-count" style="padding-bottom: 2px;">0</span>
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
                <form action="arama.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="kelime" placeholder="Ürün, marka veya kategori arayın">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <button class="fa fa-search"></button>
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
                            <a href="kirtasiye.php" class="nav-item nav-link">Kırtasiye</a>
                            <a href="oyuncak.php" class="nav-item nav-link active">Oyuncak</a>
                            <a href="kitap.php" class="nav-item nav-link">Kitap</a>              
                            <a href="contact.php" class="nav-item nav-link">İletişim</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="profil.php" class="btn px-0">
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

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Ana Sayfa</a>
                    <a class="breadcrumb-item text-dark" href="oyuncak.php">Oyuncak</a>
                    <span class="breadcrumb-item active">Oyuncaklar</span>
                </nav>

            <form method="post" action="#">
                <div class="row">
                    <?php foreach ($oyuncaklar as $oyuncak) { ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top enlarge-image" style="height: 400px;"
                            src="./admin/oyuncaklar/<?php echo $oyuncak['resim']; ?>" alt="<?php echo $oyuncak['ad']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $oyuncak['ad']; ?></h5>
                                <p class="card-text" style="font-size: 20px;"><?php echo $oyuncak['bilgi']; ?></p>
                                <div class="d-flex justify-content-between align-items-center"></div>
                                <small style="font-size: 20px;" class="text-muted"><?php echo $oyuncak['fiyat']; ?>₺</small>
                            </div>
                            <div class="btn-group">
                                <button data-product-id="<?php echo $oyuncak['id']; ?>" role="button" class="button addToCartBtn">Sepete ekle</button>
                            </div>
                        </div>
                    </div>
                     <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Shop End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">İletişimde Kalalım</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Sarıçam/Adana</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>mertcankorkmaz45@hotmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+90 567 111 19 05</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Hızlı Erişim</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Ana Sayfa</a>
                            <a class="text-secondary mb-2" href="contact.php"><i class="fa fa-angle-right mr-2"></i>İletişim</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Bizi Takip Edin</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="https://www.linkedin.com/in/mertcankorkmazzz/"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square" href="https://linktr.ee/mertcankorkmaz"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

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
