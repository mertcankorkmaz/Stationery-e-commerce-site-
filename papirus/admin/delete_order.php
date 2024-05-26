<?php
include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = intval($_POST['order_id']);
    
    // Bağlantıyı kapatma
    mysqli_autocommit($conn, FALSE);

    // Siparişe ait ürünleri sil
    $sql_order_items = "DELETE FROM order_items WHERE order_id = ?";
    $stmt_order_items = mysqli_prepare($conn, $sql_order_items);
    mysqli_stmt_bind_param($stmt_order_items, "i", $order_id);
    
    if (mysqli_stmt_execute($stmt_order_items)) {
        // Siparişi sil
        $sql_orders = "DELETE FROM orders WHERE order_id = ?";
        $stmt_orders = mysqli_prepare($conn, $sql_orders);
        mysqli_stmt_bind_param($stmt_orders, "i", $order_id);
        
        if (mysqli_stmt_execute($stmt_orders)) {
            // Başarılı silme işlemi
            mysqli_commit($conn);
            header("Location: admin_orders.php?message=Sipariş başarıyla silindi");
            exit;
        } else {
            // Hata oluştu
            mysqli_rollback($conn);
            echo "Hata: " . mysqli_error($conn);
        }
    } else {
        // Hata oluştu
        mysqli_rollback($conn);
        echo "Hata: " . mysqli_error($conn);
    }
}
?>
