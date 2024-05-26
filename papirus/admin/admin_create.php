<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papirus";

// Veritabanına bağlan
$conn = new mysqli('localhost', 'root', '', 'papirus');
// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$admin_username = 'admin';
$admin_password = password_hash('mertcan', PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (username, password) VALUES ('$admin_username', '$admin_password')";

if ($conn->query($sql) === TRUE) {
    echo "New admin created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
