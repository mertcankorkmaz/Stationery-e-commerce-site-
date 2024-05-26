

<html>
    
<head>

    <meta charset="utf-8">

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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>


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
                        </div>
                    </div>
                 
                    
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-user text-dark"></i>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
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
                <h5 class="m-0">+90 536 241 05 70</h5>
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
                        <a href="oyuncak.html" class="nav-item nav-link">Oyuncak</a>
                        <a href="book.html" class="nav-item nav-link">Kitap</a>
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
                            <a href="oyuncak.html" class="nav-item nav-link">Oyuncak</a>
                            <a href="kitap.php" class="nav-item nav-link">Kitap</a>
                            <a href="contact.php" class="nav-item nav-link">İletişim</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-user text-primary"></i>
                            </a>
                            <!-- <a href="sepet.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>  -->
                            <a href="sepet.php">
                              <span class="glyphicon glyphicon-shopping-cart cart-icon"></span>
                                <span class="badge cart-count">10</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
</body>

</html>