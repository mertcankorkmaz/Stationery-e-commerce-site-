<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Sepetim</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="img/pen.ico" rel="icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="contact.php">İletişim</a>
                </div>
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

<?php
if (isset($_SESSION["shoppingCart"])) {
    $shoppingCart = $_SESSION["shoppingCart"];
    $total_count = $shoppingCart["summary"]["total_count"];
    $total_price = $shoppingCart["summary"]["total_price"];
    $ürünlistesi = isset($shoppingCart["ürünlistesi"]) ? $shoppingCart["ürünlistesi"] : [];
    $oyuncaklar = isset($shoppingCart["oyuncaklar"]) ? $shoppingCart["oyuncaklar"] : [];
    $kitaplar = isset($shoppingCart["kitaplar"]) ? $shoppingCart["kitaplar"] : [];
    $shopping_products = array_merge($ürünlistesi, $oyuncaklar, $kitaplar);
} else {
    $total_count = 0;
    $total_price = 0.0;
}
?>

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

<!-- main content-->
<div class="container">
<?php if ($total_count > 0) { ?>
<h2 class="text-center"> Sepetinizde <strong class="text-danger"><?php echo $total_count; ?></strong> adet ürün bulunmaktadır</h2>
<hr>
<div class="row">
    <div class="border-2 col-12">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Ürün Resmi</th>
                    <th class="text-center">Ürün adı</th>
                    <th class="text-center">Ürün Bilgisi</th>
                    <th class="text-center">Fiyatı</th>
                    <th class="text-center">Adet</th>
                    <th class="text-center">Toplam</th>
                    <th class="text-center">Sepetten çıkar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shopping_products as $ürün) { 
                    $category = isset($ürün->category) ? $ürün->category : 'ürünlistesi';
                    $imagePath = "admin/resimler/{$ürün->resim}";
                    if ($category == 'kitaplar') {
                        $imagePath = "admin/kitaplar/{$ürün->resim}";
                    } elseif ($category == 'oyuncaklar') {
                        $imagePath = "admin/oyuncaklar/{$ürün->resim}";
                    }
                ?>
                <tr>
                    <td class="text-center" width="200px">
                        <img src="<?php echo $imagePath; ?>" alt="" width="100px">
                    </td>
                    <td class="text-center" width="250px"><?php echo $ürün->ad; ?></td>
                    <td class="text-center" width="250px"><?php echo $ürün->bilgi; ?></td>
                    <td class="text-center" width="200px"><strong><?php echo $ürün->fiyat; ?> TL</strong></td>
                    <td class="text-center" width="400px">
                        <button class="btn btn-xs btn-success updateCart" data-urun-id="<?php echo $ürün->id; ?>" data-category="<?php echo $category; ?>" data-action="inc">+</button>
                        <input type="text" value="<?php echo $ürün->count; ?>" class="sepet-ürün-sayısı" readonly>
                        <button class="btn btn-xs btn-danger updateCart" data-urun-id="<?php echo $ürün->id; ?>" data-category="<?php echo $category; ?>" data-action="dec">-</button>
                    </td>
                    <td class="text-center" width="200px"><?php echo $ürün->total_price; ?> TL</td>
                    <td class="text-center" width="120px">
                        <button class="btn btn-danger btn-sm updateCart" data-urun-id="<?php echo $ürün->id; ?>" data-category="<?php echo $category; ?>" data-action="remove">Sepetten çıkar</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">Toplam ürün: <span class="text-danger"><?php echo $total_count; ?></span></th>
                    <th colspan="5" class="text-right">Toplam tutar: <span class="text-danger"><?php echo $total_price; ?> TL</span></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Sepeti boşalt düğmesi -->
<div class="text-center mt-4">
    <button id="clearCartBtn" class="btn btn-danger">Sepeti Boşalt</button>
    <button id="createOrderBtn" class="btn btn-success">Siparişi Tamamla</button>
</div>

<?php } else { ?>
<div class="alert alert-info">
    <strong>Sepetinizde henüz bir ürün bulunmamaktadır. Eklemek için <a href="index.php">tıklayınız</a></strong>
</div>
<?php } ?>
</div>
<!--end main-->

<script>
    $(document).ready(function() {
        $('.updateCart').click(function() {
            var urunId = $(this).data('urun-id');
            var action = $(this).data('action');
            var category = $(this).data('category');

            $.ajax({
                url: 'sepet_db.php',
                method: 'POST',
                data: { p: action, urun_id: urunId, category: category },
                success: function(response) {
                    location.reload();
                }
            });
        });

        $('#clearCartBtn').click(function() {
            $.ajax({
                url: 'sepet_db.php',
                method: 'POST',
                data: { p: 'clearCart' },
                success: function(response) {
                    location.reload();
                }
            });
        });

        $('#createOrderBtn').click(function() {
            $.ajax({
                url: 'order.php',
                method: 'POST',
                success: function(response) {
                    alert(response);
                    location.reload(); // Sayfayı yeniden yükleyerek sepeti güncelle
                }
            });
        });
    });
</script>

</body>
</html>
