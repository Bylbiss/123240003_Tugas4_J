<?php 
session_start();
require "../config/koneksi.php";

if(!isset($_SESSION['id_user'])){
    header("Location: ../login.php?status=login_dulu");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $todo = mysqli_real_escape_string($koneksi, $_POST['todo'] ?? '');
    $status = mysqli_real_escape_string($koneksi, $_POST['status'] ?? 'pending');
    $id_user = intval($_SESSION['id_user']);

    $query = "INSERT INTO todo (todo, status, id_user) VALUES ('$todo', '$status', $id_user)";
    $result = mysqli_query($koneksi, $query);

    if($result){
        header("Location: ../index.php");
        exit();
    } else {
        die("Gagal menambahkan todo: " . mysqli_error($koneksi));
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>