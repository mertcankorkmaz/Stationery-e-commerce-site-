<?php
include("baglanti.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $order_id);

    if ($stmt->execute()) {
        header("Location: admin_orders.php");
        exit();
    } else {
        echo "Hata: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
