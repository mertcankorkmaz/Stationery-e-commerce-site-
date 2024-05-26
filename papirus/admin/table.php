<?php
include("baglanti.php");

// Sıralama için GET parametrelerini alma
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'order_id';
$order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'ASC';
$new_order_dir = ($order_dir == 'ASC') ? 'DESC' : 'ASC';

// Kullanıcıları ve mesajları çekme
$sql = "SELECT * FROM kullanicilar";
$result = mysqli_query($conn, $sql);
$personellist = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT * FROM iletisim1";
$result2 = mysqli_query($conn, $sql2);
$mesajlar = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// Tüm siparişleri çekme
$sql3 = "SELECT o.order_id, u.username, o.order_date, o.total_amount, o.status
         FROM orders o
         JOIN kullanicilar u ON o.user_id = u.user_id
         ORDER BY $order_by $order_dir";
$latest_orders_result = mysqli_query($conn, $sql3);
$latest_orders = mysqli_fetch_all($latest_orders_result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Papirus Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/pen.ico" rel="icon">
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
        .order-table-wrapper,
        .members-table-wrapper {
            max-height: 300px;
            overflow-y: auto;
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
            <a href="table.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'table.php' ? 'active' : ''; ?>"><i class="fa fa-table me-2"></i>Kullanıcı Tablosu</a>
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
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                </div>
                            </div>
                        </a>
                        <hr class="dropdown-divider">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all message</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Profile updated</h6>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New user added</h6>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Password changed</h6>
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
                                <h6 class="mb-4">Son Gelen Siparişler</h6>
                                <div class="order-table-wrapper">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"><a href="?order_by=order_id&order_dir=<?php echo $new_order_dir; ?>">Sipariş ID</a></th>
                                                <th scope="col"><a href="?order_by=username&order_dir=<?php echo $new_order_dir; ?>">Kullanıcı</a></th>
                                                <th scope="col"><a href="?order_by=order_date&order_dir=<?php echo $new_order_dir; ?>">Sipariş Tarihi</a></th>
                                                <th scope="col"><a href="?order_by=total_amount&order_dir=<?php echo $new_order_dir; ?>">Toplam Tutar</a></th>
                                                <th scope="col">Durum</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($latest_orders as $order) {
                                                echo "<tr>";
                                                echo "<td>" . $order['order_id'] . "</td>";
                                                echo "<td>" . $order['username'] . "</td>";
                                                echo "<td>" . $order['order_date'] . "</td>";
                                                echo "<td>" . $order['total_amount'] . "</td>";
                                                echo "<td>" . $order['status'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="admin_orders.php" class="btn btn-primary mt-3">Tüm Siparişleri Gör</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Latest Members</h6>
                                <div class="members-table-wrapper">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($personellist as $index => $person) {
                                                echo "<tr>";
                                                echo "<th scope='row'>" . ($index + 1) . "</th>";
                                                echo "<td>" . $person['username'] . "</td>";
                                                echo "<td>" . $person['email'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Kullanıcılar</h6>
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">İd</th>
                                            <th scope="col">İsim</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Şifre</th>
                                            <th scope="col">Sil</th>
                                        </tr>
                                        <?php
                                        foreach ($personellist as $person) {
                                            echo "<tr>";
                                            echo "<td>" . $person['user_id'] . "</td>";
                                            echo "<td>" . $person['username'] . "</td>";
                                            echo "<td>" . $person['email'] . "</td>";
                                            echo "<td>" . $person['password'] . "</td>";
                                            echo "<td><a href='kullanıcı.php?del_user=" . $person['user_id'] . "' class='btn btn-danger'>Sil</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="bg-light rounded h-100 p-4">
                                <h6 class="mb-4">Kullanıcı Mesajları</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">İd</th>
                                                <th scope="col">İsim</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Mesaj</th>
                                                <th scope="col">Sil</th>
                                            </tr>
                                            <?php
                                            foreach ($mesajlar as $person) {
                                                echo "<tr>";
                                                echo "<td>" . $person['id'] . "</td>";
                                                echo "<td>" . $person['isim'] . "</td>";
                                                echo "<td>" . $person['email'] . "</td>";
                                                echo "<td>" . $person['mesaj'] . "</td>";
                                                echo "<td><a href='kullanıcı.php?del_message=" . $person['id'] . "' class='btn btn-danger'>Sil</a></td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
