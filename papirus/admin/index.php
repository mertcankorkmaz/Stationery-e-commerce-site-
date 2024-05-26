<?php
include("baglanti.php");
$sql = "SELECT * FROM kullanicilar";
$result = mysqli_query($conn, $sql);
$personellist = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql2 = "SELECT * FROM iletisim1";
$result2 = mysqli_query($conn, $sql2);
$mesajlar = mysqli_fetch_all($result2, MYSQLI_ASSOC);

// Siparişleri çekme
$sql3 = "SELECT o.order_id, u.username, o.order_date, o.total_amount, o.status
        FROM orders o
        JOIN kullanicilar u ON o.user_id = u.user_id";
$siparisler = mysqli_query($conn, $sql3);
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
            <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Ana Sayfa</a>
            <a href="form.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Ürün Formu</a>
            <a href="table.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Kullanıcı tablosu</a>
            <a href="admin_orders.php" class="nav-item nav-link"><i class="fa fa-box me-2"></i>Siparişler</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Diğer</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="404.html" class="dropdown-item">404 Error</a>
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
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4 scrollable-container">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="mb-0">Messages</h6>
                        </div>
                        <div class="user-messages">
                            <?php foreach($mesajlar as $mesaj): ?>
                            <div class="message-item">
                                <div class="message-user">
                                    <img src="img/userr.png" alt="User Image" style="width: 40px; height: 40px;">
                                    <div class="message-info">
                                        <h6><?php echo $mesaj['isim']; ?></h6>
                                        <p class="message-time"><?php echo $mesaj['email']; ?></p>
                                    </div>
                                </div>
                                <p class="message-text"><?php echo $mesaj['mesaj']; ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4 scrollable-container">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Calender</h6>
                        </div>
                        <div id="calender"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-4">
                    <div class="h-100 bg-light rounded p-4 scrollable-container">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">To Do List</h6>
                        </div>
                        <div class="d-flex mb-2">
                            <input id="taskInput" class="form-control bg-transparent" type="text" placeholder="Enter task">
                            <button id="addTaskButton" type="button" class="btn btn-primary ms-2">Add</button>
                        </div>
                        <div id="taskList"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Çalışanlar</h6>
                        <div class="owl-carousel testimonial-carousel"> 
                            <div class="testimonial-item text-center">
                                <img class="img-fluid rounded-circle mx-auto mb-4" src="img/müdür.jpg" style="width: 100px; height: 100px;">
                                <h5 class="mb-1">Mertcan Korkmaz</h5>
                                <p>Müdür</p>
                            </div>
                            <div class="testimonial-item text-center">
                                <img class="img-fluid rounded-circle mx-auto mb-4" src="img/testimonial-1.jpg" style="width: 100px; height: 100px;">
                                <h5 class="mb-1">Meryem Culhacı</h5>
                                <p>Kasiyer</p>
                            </div>
                                <div class="testimonial-item text-center">
                                    <img class="img-fluid rounded-circle mx-auto mb-4" src="img/wuser.png" style="width: 100px; height: 100px;">
                                    <h5 class="mb-1">Yasemin Kutlu</h5>
                                    <p>Sosyal Medya Uzmanı</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                        <iframe class="position-relative rounded w-100 h-100"src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50989.021597531486!2d35.246282290958774!3d36.99037633123839!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15288dcc4aa8cea9%3A0x6bf7bafd35014a46!2zw4d1a3Vyb3ZhIMOcbml2ZXJzaXRlc2kgQmlsZ2lzYXlhciBNw7xoZW5kaXNsacSfaSBiw7Zsw7w!5e0!3m2!1str!2str!4v1715990800613!5m2!1str!2str"  frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>

            <!-- Siparişler Tablosu -->
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Siparişler</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sipariş ID</th>
                                    <th scope="col">Kullanıcı</th>
                                    <th scope="col">Sipariş Tarihi</th>
                                    <th scope="col">Toplam Tutar</th>
                                    <th scope="col">Durum</th>
                                    <th scope="col">Detaylar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($siparisler)) { ?>
                                <tr>
                                    <td><?php echo $row['order_id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['order_date']; ?></td>
                                    <td><?php echo $row['total_amount']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>
                                        <a href="admin_order_details.php?order_id=<?php echo $row['order_id']; ?>" class="btn btn-primary btn-sm">Detaylar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Siparişler Tablosu End -->

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
    <script>
        $(document).ready(function() {
            // Görevleri yükle
            loadTasks();

            // Görev ekleme
            $('#addTaskButton').click(function() {
                const task = $('#taskInput').val();
                if (task) {
                    $.post('todolist.php', { task: task }, function(response) {
                        if (response.success) {
                            $('#taskInput').val('');
                            loadTasks();
                        }
                    }, 'json');
                }
            });

            // Görevleri yükleme fonksiyonu
            function loadTasks() {
                $.get('todolist.php', function(response) {
                    const tasks = JSON.parse(response);
                    let taskListHtml = '';
                    tasks.forEach(function(task) {
                        taskListHtml += `
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox" ${task.is_not_completed ? 'checked' : ''} onchange="toggleTask(${task.id}, this.checked)">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span class="${task.is_not_completed ? 'text-decoration-line-through' : ''}" id="task-${task.id}">${task.task}</span>
                                        <button class="btn btn-sm" onclick="deleteTask(${task.id})"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#taskList').html(taskListHtml);
                });
            }

            // Görev silme fonksiyonu
            window.deleteTask = function(id) {
                $.ajax({
                    url: 'todolist.php',
                    type: 'DELETE',
                    data: { id: id },
                    success: function(response) {
                        if (response.success) {
                            loadTasks();
                        }
                    },
                    dataType: 'json'
                });
            };

            // Görev durumu değiştirme fonksiyonu
            window.toggleTask = function(id, is_completed) {
                $.ajax({
                    url: 'todolist.php',
                    type: 'PUT',
                    data: { id: id, is_completed: is_completed },
                    success: function(response) {
                        if (response.success) {
                            const taskElement = document.getElementById(`task-${id}`);
                            if (is_completed) {
                                taskElement.classList.add('text-decoration-line-through');
                            } else {
                                taskElement.classList.remove('text-decoration-line-through');
                            }
                        }
                    },
                    dataType: 'json'
                });
            };
        });
    </script>
</body>
</html>
