<?php
session_start();
include 'baglanti.php'; // Veritabanı bağlantısını sağlayın

// Kullanıcı girişi kontrolü
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Kullanıcı girişi yapılmamış.'); window.location.href='giris.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$shoppingCart = isset($_SESSION["shoppingCart"]) ? $_SESSION["shoppingCart"] : null;

if ($shoppingCart) {
    // Sipariş özeti
    $total_amount = $shoppingCart["summary"]["total_price"];
    $order_date = date('Y-m-d H:i:s');
    $status = 'İşlemde';

    // Sipariş ekleme
    $sql = "INSERT INTO orders (user_id, order_date, total_amount, status) VALUES ('$user_id', '$order_date', '$total_amount', '$status')";
    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);

        // Sepetteki ürünleri sipariş detaylarına ekleme
        foreach (["ürünlistesi", "oyuncaklar", "kitaplar"] as $category) {
            if (isset($shoppingCart[$category])) {
                foreach ($shoppingCart[$category] as $product) {
                    $product_id = $product->id;
                    $quantity = $product->count;
                    $price = $product->fiyat;

                    $sql2 = "INSERT INTO order_items (order_id, product_id, quantity, price, product_type) VALUES ('$order_id', '$product_id', '$quantity', '$price', '$category')";
                    if (!mysqli_query($conn, $sql2)) {
                        echo "Hata (order_items): " . mysqli_error($conn);
                    }
                }
            }
        }

        // Sipariş tamamlandı, sepeti temizle
        unset($_SESSION["shoppingCart"]);

        // Siparişin başarıyla verildiği mesajını göster
        echo "Siparişiniz başarıyla verildi.";
    } else {
        echo "Sipariş oluşturulamadı: " . mysqli_error($conn);
    }
} else {
    echo "Sepetinizde ürün bulunmamaktadır.";
}
?>
