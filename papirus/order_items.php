<?php
session_start();
include 'baglanti.php'; // Veritabanı bağlantısını sağlayın

// order_id ve shoppingCart kontrolü
if (!isset($_SESSION['order_id']) || !isset($_SESSION["shoppingCart"])) {
    echo "Sipariş ID'si veya sepet verisi bulunamadı.";
    exit();
}

$order_id = $_SESSION['order_id'];
$shoppingCart = $_SESSION["shoppingCart"];

// Sepet içeriğini kontrol et
echo "<pre>";
print_r($shoppingCart);
echo "Order ID: $order_id\n";
echo "</pre>";

$errors = []; // Hata mesajlarını saklamak için bir dizi

// Sepetteki ürünleri sipariş detaylarına ekleme
foreach ($shoppingCart["products"] as $product) {
    $product_type = $product["category"]; // Örneğin: 'ürünler', 'oyuncaklar', 'kitaplar'
    $product_id = $product["id"];
    $quantity = $product["count"];
    $price = $product["fiyat"];

    // Hata ayıklama için eklenen SQL sorgusunu yazdır
    $sql2 = "INSERT INTO order_items (order_id, product_type, product_id, quantity, price) VALUES ('$order_id', '$product_type', '$product_id', '$quantity', '$price')";
    echo "Executing SQL: $sql2<br>";
    if (!mysqli_query($conn, $sql2)) {
        // Hata durumunda mesaj göster
        $errors[] = "Hata (order_items): " . mysqli_error($conn) . " SQL: $sql2";
    } else {
        echo "Ürün başarıyla eklendi: " . $product_id . "<br>";
    }
}

// Hataları yazdır
if (!empty($errors)) {
    echo "<pre>";
    print_r($errors);
    echo "</pre>";
}

// Sipariş tamamlandı, sepeti temizle
unset($_SESSION["shoppingCart"]);
unset($_SESSION['order_id']);

// Siparişin başarıyla verildiği mesajını göster
echo "Siparişiniz başarıyla verildi.";
?>
