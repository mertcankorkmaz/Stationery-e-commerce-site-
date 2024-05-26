<?php
include("baglanti.php");
session_start();

// Sıralama seçeneklerini belirleme
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'order_id';
$order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'ASC';

// Siparişleri çekme ve sıralama
$sql = "SELECT o.order_id, u.username, o.order_date, o.total_amount, o.status
        FROM orders o
        JOIN kullanicilar u ON o.user_id = u.user_id
        ORDER BY $order_by $order_dir";
$siparisler = mysqli_query($conn, $sql);

// Sipariş durumları
$status_options = [
    'İşlemde' => 'İşlemde',
    'Kargoda' => 'Kargoda',
    'Tamamlandı' => 'Tamamlandı',
    'İptal Edildi' => 'İptal Edildi'
];
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Admin - Siparişler</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/pen.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
            max-height: 300px; /* Belirli bir yükseklik */
            overflow-y: auto; /* Dikey kaydırma çubuğu */
            overflow-x: hidden; /* Yatay kaydırma çubuğunu gizle */
        }
        .message-item {
            margin-bottom: 20px;
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
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Siparişler</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <a href="?order_by=order_id&order_dir=<?php echo $order_dir === 'ASC' ? 'DESC' : 'ASC'; ?>">Sipariş ID</a>
                                    </th>
                                    <th scope="col">
                                        <a href="?order_by=username&order_dir=<?php echo $order_dir === 'ASC' ? 'DESC' : 'ASC'; ?>">Kullanıcı</a>
                                    </th>
                                    <th scope="col">
                                        <a href="?order_by=order_date&order_dir=<?php echo $order_dir === 'ASC' ? 'DESC' : 'ASC'; ?>">Sipariş Tarihi</a>
                                    </th>
                                    <th scope="col">
                                        <a href="?order_by=total_amount&order_dir=<?php echo $order_dir === 'ASC' ? 'DESC' : 'ASC'; ?>">Toplam Tutar</a>
                                    </th>
                                    <th scope="col">Durum</th>
                                    <th scope="col">Detaylar</th>
                                    <th scope="col">Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($siparisler)) { ?>
                                <tr>
                                    <td><?php echo $row['order_id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['total_amount']; ?></td>
                                    <td>
                                        <form method="POST" action="update_status.php">
                                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                            <select name="status" onchange="this.form.submit()">
                                                <?php foreach ($status_options as $value => $label) { ?>
                                                    <option value="<?php echo $value; ?>" <?php echo $row['status'] == $value ? 'selected' : ''; ?>>
                                                        <?php echo $label; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="admin_order_details.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-primary btn-sm">Detaylar</a>
                                    </td>
                                    <td>
                                        <form method="POST" action="delete_order.php" onsubmit="return confirm('Bu siparişi silmek istediğinize emin misiniz?');">
                                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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
    <script src="js/main.js"></script>
</body>
</html>
