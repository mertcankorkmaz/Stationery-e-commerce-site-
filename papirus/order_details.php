<?php
session_start();
include 'baglanti.php'; // Veritabanı bağlantısını sağlayın

// Check if order_id is set in the URL
if (!isset($_GET['order_id'])) {
    die("Geçersiz sipariş ID.");
}

$order_id = intval($_GET['order_id']); // Sanitize input

// Sipariş bilgilerini veritabanından çekme
$sql = "SELECT o.order_id, u.username, o.order_date, o.total_amount, o.status
        FROM orders o
        JOIN kullanicilar u ON o.user_id = u.user_id
        WHERE o.order_id = $order_id";
$order_result = mysqli_query($conn, $sql);

if (!$order_result) {
    die("Veritabanı hatası: " . mysqli_error($conn));
}

$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    die("Sipariş bulunamadı.");
}

// Sipariş ürünlerini veritabanından çekme
$sql = "SELECT oi.*, p.ad AS product_name
        FROM order_items oi
        JOIN ürünler p ON oi.product_id = p.id
        WHERE oi.order_id = $order_id
        UNION
        SELECT oi.*, p.ad AS product_name
        FROM order_items oi
        JOIN oyuncaklar p ON oi.product_id = p.id
        WHERE oi.order_id = $order_id
        UNION
        SELECT oi.*, p.ad AS product_name
        FROM order_items oi
        JOIN kitaplar p ON oi.product_id = p.id
        WHERE oi.order_id = $order_id";
$order_items = mysqli_query($conn, $sql);

if (!$order_items) {
    die("Veritabanı hatası: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <title>Admin - Sipariş Detayları</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Sipariş Detayları</h1>
        <a href="profil.php" class="btn btn-primary mb-3">← Geri</a>
        <p><strong>Sipariş ID:</strong> <?php echo htmlspecialchars($order['order_id']); ?></p>
        <p><strong>Kullanıcı:</strong> <?php echo htmlspecialchars($order['username']); ?></p>
        <p><strong>Sipariş Tarihi:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
        <p><strong>Toplam Tutar:</strong> <?php echo htmlspecialchars($order['total_amount']); ?></p>
        <p><strong>Durum:</strong> <?php echo htmlspecialchars($order['status']); ?></p>

        <h2>Ürünler</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ürün Adı</th>
                    <th>Adet</th>
                    <th>Fiyat</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($order_items) > 0) {
                    while ($row = mysqli_fetch_assoc($order_items)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                        </tr>
                    <?php } 
                } else { ?>
                    <tr>
                        <td colspan="3">Bu siparişe ait ürün bulunamadı.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
