<?php
include("baglanti.php");

function reloadPage() {
    echo '<script type="text/javascript">
            window.location.href = window.location.href;
          </script>';
}

// Handle product deletions
if (isset($_GET['del_urun'])) {
    $id = intval($_GET['del_urun']);
    $sql = "DELETE FROM ürünler WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        reloadPage();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_GET['del_kitap'])) {
    $id = intval($_GET['del_kitap']);
    $sql = "DELETE FROM kitaplar WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        reloadPage();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_GET['del_oyuncak'])) {
    $id = intval($_GET['del_oyuncak']);
    $sql = "DELETE FROM oyuncaklar WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        reloadPage();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Handle product updates
if (isset($_POST["update_urun"])) {
    $id = intval($_POST["id"]);
    $adi = mysqli_real_escape_string($conn, $_POST["adi"]);
    $aciklama = mysqli_real_escape_string($conn, $_POST["aciklama"]);
    $fiyat = floatval($_POST["fiyat"]);

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        move_uploaded_file($_FILES["foto"]["tmp_name"], "resimler/" . $_FILES["foto"]["name"]);
        $dosya = $_FILES["foto"]["name"];
        $sql = "UPDATE ürünler SET ad='$adi', bilgi='$aciklama', fiyat=$fiyat, resim='$dosya' WHERE id=$id";
    } else {
        $sql = "UPDATE ürünler SET ad='$adi', bilgi='$aciklama', fiyat=$fiyat WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        reloadPage();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_POST["update_kitap"])) {
    $id = intval($_POST["id"]);
    $kadi = mysqli_real_escape_string($conn, $_POST["kadi"]);
    $kaciklama = mysqli_real_escape_string($conn, $_POST["kaciklama"]);
    $kfiyat = floatval($_POST["kfiyat"]);

    if (isset($_FILES["kfoto"]) && $_FILES["kfoto"]["error"] == 0) {
        move_uploaded_file($_FILES["kfoto"]["tmp_name"], "kitaplar/" . $_FILES["kfoto"]["name"]);
        $kdosya = $_FILES["kfoto"]["name"];
        $sql = "UPDATE kitaplar SET ad='$kadi', bilgi='$kaciklama', fiyat=$kfiyat, resim='$kdosya' WHERE id=$id";
    } else {
        $sql = "UPDATE kitaplar SET ad='$kadi', bilgi='$kaciklama', fiyat=$kfiyat WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        reloadPage();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

if (isset($_POST["update_oyuncak"])) {
    $id = intval($_POST["id"]);
    $oadi = mysqli_real_escape_string($conn, $_POST["oadi"]);
    $oaciklama = mysqli_real_escape_string($conn, $_POST["oaciklama"]);
    $ofiyat = floatval($_POST["ofiyat"]);

    if (isset($_FILES["ofoto"]) && $_FILES["ofoto"]["error"] == 0) {
        move_uploaded_file($_FILES["ofoto"]["tmp_name"], "oyuncaklar/" . $_FILES["ofoto"]["name"]);
        $odosya = $_FILES["ofoto"]["name"];
        $sql = "UPDATE oyuncaklar SET ad='$oadi', bilgi='$oaciklama', fiyat=$ofiyat, resim='$odosya' WHERE id=$id";
    } else {
        $sql = "UPDATE oyuncaklar SET ad='$oadi', bilgi='$oaciklama', fiyat=$ofiyat WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        reloadPage();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Handle product additions
if (isset($_POST["adi"]) && isset($_POST["aciklama"]) && isset($_POST["fiyat"]) && isset($_FILES["foto"])) {
    $dir = 'resimler/';
    
    if (is_dir($dir)) {
        if (chmod($dir, 0755)) {
            echo "Dosya izinleri başarıyla ayarlandı.";
        } else {
            echo "Dosya izinleri ayarlanamadı.";
        }
    } else {
        echo "Belirtilen dizin mevcut değil.";
    }
    $adi = mysqli_real_escape_string($conn, $_POST["adi"]);
    $aciklama = mysqli_real_escape_string($conn, $_POST["aciklama"]);
    $fiyat = floatval($_POST["fiyat"]);
    move_uploaded_file($_FILES["foto"]["tmp_name"],"resimler/" . $_FILES["foto"]["name"]);          
    $dosya=$_FILES["foto"]["name"];
    $sql = "INSERT INTO ürünler (ad, bilgi, fiyat, resim) VALUES ('$adi','$aciklama',$fiyat,'$dosya')";
    if (mysqli_query($conn, $sql)) {
          reloadPage();
    } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

} else if (isset($_POST["kadi"]) && isset($_POST["kaciklama"]) && isset($_POST["kfiyat"]) && isset($_FILES["kfoto"])) {
    $dir = 'kitaplar/';
        
    if (is_dir($dir)) {
        if (chmod($dir, 0755)) {
            echo "Dosya izinleri başarıyla ayarlandı.";
        } else {
            echo "Dosya izinleri ayarlanamadı.";
        }
    } else {
        echo "Belirtilen dizin mevcut değil.";
    }
    $kadi = mysqli_real_escape_string($conn, $_POST["kadi"]);
    $kaciklama = mysqli_real_escape_string($conn, $_POST["kaciklama"]);
    $kfiyat = floatval($_POST["kfiyat"]);
    move_uploaded_file($_FILES["kfoto"]["tmp_name"],"kitaplar/" . $_FILES["kfoto"]["name"]);            
    $kdosya=$_FILES["kfoto"]["name"];
    $sql = "INSERT INTO kitaplar (ad, bilgi, fiyat, resim) VALUES ('$kadi','$kaciklama',$kfiyat,'$kdosya')";
    if (mysqli_query($conn, $sql)) {
          reloadPage();
    } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

} else if (isset($_POST["oadi"]) && isset($_POST["oaciklama"]) && isset($_POST["ofiyat"]) && isset($_FILES["ofoto"])) {
    $dir = 'oyuncaklar/';
        
    if (is_dir($dir)) {
        if (chmod($dir, 0755)) {
            echo "Dosya izinleri başarıyla ayarlandı.";
        } else {
            echo "Dosya izinleri ayarlanamadı.";
        }
    } else {
        echo "Belirtilen dizin mevcut değil.";
    }
    $oadi = mysqli_real_escape_string($conn, $_POST["oadi"]);
    $oaciklama = mysqli_real_escape_string($conn, $_POST["oaciklama"]);
    $ofiyat = floatval($_POST["ofiyat"]);
    move_uploaded_file($_FILES["ofoto"]["tmp_name"],"oyuncaklar/" . $_FILES["ofoto"]["name"]);          
    $odosya=$_FILES["ofoto"]["name"];
    $sql = "INSERT INTO oyuncaklar (ad, bilgi, fiyat, resim) VALUES ('$oadi','$oaciklama',$ofiyat,'$odosya')";
    if (mysqli_query($conn, $sql)) {
          reloadPage();
    } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

} else if (isset($_POST["isim"]) && isset($_POST["mail"]) && isset($_POST["sifre"])) {
    $isim = mysqli_real_escape_string($conn, $_POST["isim"]);
    $mail = mysqli_real_escape_string($conn, $_POST["mail"]);
    $sifre = mysqli_real_escape_string($conn, $_POST["sifre"]);
    
    // Doğrulama kontrollerini yap
    $hatalar = array();
    
    if (empty($isim)) {
        $hatalar[] = "İsim alanı boş olamaz.";
    }
    
    if (empty($mail)) {
        $hatalar[] = "Mail alanı boş olamaz.";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $hatalar[] = "Geçersiz bir mail adresi girdiniz.";
    }
    
    if (empty($sifre)) {
        $hatalar[] = "Şifre alanı boş olamaz.";
    }
    
    // Hata kontrolü
    if (count($hatalar) > 0) {
        foreach ($hatalar as $hata) {
            echo $hata . "<br>";
        }
    } else {
        // Veritabanına ekleme işlemi
        $sql = "INSERT INTO kullanicilar (username, email, password) VALUES ('$isim', '$mail', '$sifre')";
        //hashlenmiş şifre için;
        //$hashedSifre = password_hash($sifre, PASSWORD_DEFAULT);
        //$sql = "INSERT INTO kullanicilar (username, email, password) VALUES ('$isim', '$mail', '$hashedSifre')";

        
        if (mysqli_query($conn, $sql)) {
            reloadPage();
        } else {
            echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }

} else {
    echo "";
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Papirus Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/pen.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        #sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 15px;
            height: 100vh;
            color: white;
            position: fixed;
            overflow-y: auto;
        }
        #sidebar .nav-link {
            color: #cfd8dc;
        }
        #sidebar .nav-link.active {
            background-color: #495057;
            color: white;
        }
        #main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .scrollable-container {
            max-height: 300px;
            overflow-y: auto;
        }
        .message-item {
            margin-bottom: 20px;
        }
        .table-wrapper {
            height: 400px;
            overflow-y: scroll;
        }
    </style>
</head>

<body>
    <div id="sidebar">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Papirus</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/müdür.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Mertcan Korkmaz</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>"><i class="fa fa-tachometer-alt me-2"></i>Ana Sayfa</a>
            <a href="form.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'form.php' ? 'active' : ''; ?>"><i class="fa fa-keyboard me-2"></i>Ürün Formu</a>
            <a href="table.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'table.php' ? 'active' : ''; ?>"><i class="fa fa-table me-2"></i>Kullanıcı tablosu</a>
            <a href="admin_orders.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'admin_orders.php' ? 'active' : ''; ?>"><i class="fa fa-box me-2"></i>Siparişler</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo basename($_SERVER['PHP_SELF']) == '404.html' ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Diğer</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="404.html" class="dropdown-item <?php echo basename($_SERVER['PHP_SELF']) == '404.html' ? 'active' : ''; ?>">404 Error</a>
                </div>
            </div>
        </div>
    </div>

    <div id="main-content" class="content">
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <form class="d-none d-md-flex ms-4">
                <input class="form-control border-0" type="search" placeholder="Arama">
            </form>
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Profile updated</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">New user added</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <h6 class="fw-normal mb-0">Password changed</h6>
                            <small>15 minutes ago</small>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item text-center">See all notifications</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="img/müdür.jpg" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">Mertcan Korkmaz</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">Profilim</a>
                        <a href="#" class="dropdown-item">Ayarlar</a>
                        <a href="#" class="dropdown-item">Çıkış Yap</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Kullanıcı Ekle</h6>
                        <form method="POST">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="exampleInputname1" class="form-label">İsim</label>
                                    <input type="Name" class="form-control" name="isim">
                                </div>
                                <label for="exampleInputEmail1" class="form-label">Mail</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Şifre</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="sifre">
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>

                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Kitap ekle</h6>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="kadi" id="floatingInput" required>
                                <label for="floatingInput">Ürün Adı</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="kaciklama" id="floatingInput" required>
                                <label for="floatingTextarea">Yazar İsmi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="kfiyat" id="floatingInput" required>
                                <label for="floatingInput">Fiyat</label>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Fotoğraf için:</label>
                                <input class="form-control" type="file" id="formFile" name="kfoto" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>

                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Kırtasiye ürünü ekle</h6>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="adi" id="floatingInput" required>
                                <label for="floatingInput">Ürün Adı</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="aciklama" id="floatingInput" required>
                                <label for="floatingTextarea">Ürün Açıklaması</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="fiyat" id="floatingInput" required>
                                <label for="floatingInput">Fiyat</label>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Fotoğraf için:</label>
                                <input class="form-control" type="file" id="formFile" name="foto" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>

                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Oyuncak Ekle</h6>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="oadi" id="floatingInput" required>
                                <label for="floatingInput">Ürün Adı</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="oaciklama" id="floatingInput" required>
                                <label for="floatingTextarea">Ürün Açıklaması</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="ofiyat" id="floatingInput" required>
                                <label for="floatingInput">Fiyat</label>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Fotoğraf için:</label>
                                <input class="form-control" type="file" id="formFile" name="ofoto" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Add product lists with delete and update buttons -->
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Ürünler Listesi</h6>
                        <div class="table-wrapper">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ürün Adı</th>
                                        <th scope="col">Açıklama</th>
                                        <th scope="col">Fiyat</th>
                                        <th scope="col">Resim</th>
                                        <th scope="col">Sil</th>
                                        <th scope="col">Güncelle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM ürünler";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $row['id'] . "</th>";
                                        echo "<td>" . $row['ad'] . "</td>";
                                        echo "<td>" . $row['bilgi'] . "</td>";
                                        echo "<td>" . $row['fiyat'] . "</td>";
                                        echo "<td><img src='resimler/" . $row['resim'] . "' alt='' width='50'></td>";
                                        echo "<td><a href='?del_urun=" . $row['id'] . "' class='btn btn-danger'>Sil</a></td>";
                                        echo "<td><button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateModal" . $row['id'] . "'>Güncelle</button></td>";
                                        echo "</tr>";

                                        // Update Modal
                                        echo "
                                        <div class='modal fade' id='updateModal" . $row['id'] . "' tabindex='-1' aria-labelledby='updateModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='updateModalLabel'>Ürün Güncelle</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <form method='POST' enctype='multipart/form-data'>
                                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                            <div class='mb-3'>
                                                                <label for='adi' class='form-label'>Ürün Adı</label>
                                                                <input type='text' class='form-control' name='adi' value='" . $row['ad'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='aciklama' class='form-label'>Açıklama</label>
                                                                <input type='text' class='form-control' name='aciklama' value='" . $row['bilgi'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='fiyat' class='form-label'>Fiyat</label>
                                                                <input type='number' class='form-control' name='fiyat' value='" . $row['fiyat'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='foto' class='form-label'>Fotoğraf</label>
                                                                <input class='form-control' type='file' name='foto'>
                                                            </div>
                                                            <button type='submit' name='update_urun' class='btn btn-primary'>Güncelle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Kitaplar Listesi</h6>
                        <div class="table-wrapper">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kitap Adı</th>
                                        <th scope="col">Açıklama</th>
                                        <th scope="col">Fiyat</th>
                                        <th scope="col">Resim</th>
                                        <th scope="col">Sil</th>
                                        <th scope="col">Güncelle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM kitaplar";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $row['id'] . "</th>";
                                        echo "<td>" . $row['ad'] . "</td>";
                                        echo "<td>" . $row['bilgi'] . "</td>";
                                        echo "<td>" . $row['fiyat'] . "</td>";
                                        echo "<td><img src='kitaplar/" . $row['resim'] . "' alt='' width='50'></td>";
                                        echo "<td><a href='?del_kitap=" . $row['id'] . "' class='btn btn-danger'>Sil</a></td>";
                                        echo "<td><button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateKitapModal" . $row['id'] . "'>Güncelle</button></td>";
                                        echo "</tr>";

                                        // Update Modal
                                        echo "
                                        <div class='modal fade' id='updateKitapModal" . $row['id'] . "' tabindex='-1' aria-labelledby='updateKitapModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='updateKitapModalLabel'>Kitap Güncelle</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <form method='POST' enctype='multipart/form-data'>
                                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                            <div class='mb-3'>
                                                                <label for='kadi' class='form-label'>Kitap Adı</label>
                                                                <input type='text' class='form-control' name='kadi' value='" . $row['ad'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='kaciklama' class='form-label'>Açıklama</label>
                                                                <input type='text' class='form-control' name='kaciklama' value='" . $row['bilgi'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='kfiyat' class='form-label'>Fiyat</label>
                                                                <input type='number' class='form-control' name='kfiyat' value='" . $row['fiyat'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='kfoto' class='form-label'>Fotoğraf</label>
                                                                <input class='form-control' type='file' name='kfoto'>
                                                            </div>
                                                            <button type='submit' name='update_kitap' class='btn btn-primary'>Güncelle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Oyuncaklar Listesi</h6>
                        <div class="table-wrapper">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Oyuncak Adı</th>
                                        <th scope="col">Açıklama</th>
                                        <th scope="col">Fiyat</th>
                                        <th scope="col">Resim</th>
                                        <th scope="col">Sil</th>
                                        <th scope="col">Güncelle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM oyuncaklar";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $row['id'] . "</th>";
                                        echo "<td>" . $row['ad'] . "</td>";
                                        echo "<td>" . $row['bilgi'] . "</td>";
                                        echo "<td>" . $row['fiyat'] . "</td>";
                                        echo "<td><img src='oyuncaklar/" . $row['resim'] . "' alt='' width='50'></td>";
                                        echo "<td><a href='?del_oyuncak=" . $row['id'] . "' class='btn btn-danger'>Sil</a></td>";
                                        echo "<td><button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateOyuncakModal" . $row['id'] . "'>Güncelle</button></td>";
                                        echo "</tr>";

                                        // Update Modal
                                        echo "
                                        <div class='modal fade' id='updateOyuncakModal" . $row['id'] . "' tabindex='-1' aria-labelledby='updateOyuncakModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='updateOyuncakModalLabel'>Oyuncak Güncelle</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <form method='POST' enctype='multipart/form-data'>
                                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                            <div class='mb-3'>
                                                                <label for='oadi' class='form-label'>Oyuncak Adı</label>
                                                                <input type='text' class='form-control' name='oadi' value='" . $row['ad'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='oaciklama' class='form-label'>Açıklama</label>
                                                                <input type='text' class='form-control' name='oaciklama' value='" . $row['bilgi'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='ofiyat' class='form-label'>Fiyat</label>
                                                                <input type='number' class='form-control' name='ofiyat' value='" . $row['fiyat'] . "' required>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='ofoto' class='form-label'>Fotoğraf</label>
                                                                <input class='form-control' type='file' name='ofoto'>
                                                            </div>
                                                            <button type='submit' name='update_oyuncak' class='btn btn-primary'>Güncelle</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
