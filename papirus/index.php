<?php
include("baglanti.php");
$sql = "SELECT * FROM kitaplar";
$result = mysqli_query($conn, $sql);
$kitaplar = mysqli_fetch_all($result, MYSQLI_ASSOC);
session_start();
$total_count = isset($_SESSION["shoppingCart"]["summary"]["total_count"]) ? $_SESSION["shoppingCart"]["summary"]["total_count"] : 0;
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Papirus</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="img/pen.ico" rel="icon"/>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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

            $('.addToCart').click(function() {
                var urunId = $(this).data('urun-id');
                var category = $(this).data('category');

                $.ajax({
                    url: 'sepet_db.php',
                    method: 'POST',
                    data: { p: 'addToCart', urun_id: urunId, category: category },
                    success: function(response) {
                        updateCartCount();
                      
                    }
                });
            });
        });
    </script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
            </div>
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
                        <div class="nav-item dropdown dropright">
                        
                        </div>

                        <a href="index.php" class="nav-item nav-link active">Ana Sayfa</a>
                        <a href="kirtasiye.php" class="nav-item nav-link">Kırtasiye</a>
                        <a href="oyuncak.php" class="nav-item nav-link">Oyuncak</a>
                        <a href="kitap.php" class="nav-item nav-link ">Kitap</a>
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
                            <a href="index.php" class="nav-item nav-link active">Ana Sayfa</a>
                            <a href="kirtasiye.php" class="nav-item nav-link">Kırtasiye</a>
                            <a href="oyuncak.php" class="nav-item nav-link">Oyuncak</a>
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

    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/ana-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Renkler</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Bütün resim ihtiyaçlarınız</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="kirtasiye.php">Hemen Alışveriş yap</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/ana-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Okul İhtiyaçları</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Bütün okul ihtiyaçlarınız</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="kirtasiye.php">Hemen Alışveriş yap</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/ana-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Çocuklar</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Çocuklar için oyuncak ve eğitim ihtiyaçları</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="oyuncak.php">Hemen Alışveriş yap</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/ana-2.2.jpg" alt="">
                    <div class="offer-text">
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/ana-2.1.jpg" alt="">
                    <div class="offer-text">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Kategoriler</span></h2>
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="kirtasiye.php">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/kalem.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Renkli Kalemler</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="oyuncak.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/anas.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Ana Sınıfı Malzemeleri</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="kirtasiye.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/ofis.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Ofis Malzemeleri</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="oyuncak.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/oyuncak.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Oyuncaklar</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="kirtasiye.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/defter.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Defterler</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="kitap.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/kitap.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Okuma Kitapları</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="kirtasiye.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/resim.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Resim Malzemeleri</h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="oyuncak.php">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/hamur.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>Oyun Hamurları</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Categories End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Son zamanlarda popüler olan ürünler</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/kitaplar/0000000064038-1.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="8" data-category="kitaplar"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="kitap.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="kitap.php">George Orwell - 1984</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/kitaplar/0000000147918-1.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="11" data-category="kitaplar"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="kitap.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="kitap.php">Yaşar Kemal - İnce Memed 1</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/kitaplar/0001914091001-1.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="5" data-category="kitaplar"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="kitap.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="kitap.php">Sezin Karameşe - 37</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/kitaplar/0001922926001-1.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="7" data-category="kitaplar"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="kitap.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="kitap.php">Matt Haig - Gece Yarısı Kütüphanesi</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/oyuncaklar/110000011248496.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="10" data-category="oyuncaklar"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="oyuncak.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="oyuncak.php">Barbie - Oyuncak Bebek</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/resimler/ürün13.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="92" data-category="ürünlistesi"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="kirtasiye.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="kirtasiye.php">Deniz Kızı Uçlu Kalem</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/oyuncaklar/nike-skills-03-pembe-mini-basketbol-topu-n.ki.08.644.03-siyahbordo-108926.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="13" data-category="oyuncaklar"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="oyuncak.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="oyuncak.php">Nike - Pembe Basketbol Topu</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="admin/resimler/ürün3.jpg" alt="">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square addToCart" data-urun-id="85" data-category="ürünlistesi"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="kirtasiye.php"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="kirtasiye.php">Faber Castell - Uçlu Kalem</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"></span></h2>

    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/main-1.1.jpg" alt="">
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="img/main-1.2.jpg" alt="">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


   
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Hangi Markalarla Çalışıyoruz?</span></h2>


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="bg-light p-4">
                        <img src="img/marka-1.png" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-2.png" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-10.png" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-3.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-5.jpg" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-6.png" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-7.png" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-8.png" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-9.png" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-4.gif" alt="">
                    </div>
                    <div class="bg-light p-4">
                        <img src="img/marka-11.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


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
                            <a class="text-secondary" href="contact.php"><i class="fa fa-angle-right mr-2"></i>İletişim</a>
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

</body>
</html>
