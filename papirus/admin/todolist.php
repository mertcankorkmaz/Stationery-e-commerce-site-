<?php
include("baglanti.php");

// Görevleri almak için sorgu
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM todolist";
    $result = mysqli_query($conn, $sql);
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($tasks);
}

// Görev ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO todolist (task) VALUES ('$task')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

// Görev silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];
    $sql = "DELETE FROM todolist WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

// Görev güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'];
    $is_completed = $_PUT['is_completed'] === 'true' ? 1 : 0;
    $sql = "UPDATE todolist SET is_completed=$is_completed WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
