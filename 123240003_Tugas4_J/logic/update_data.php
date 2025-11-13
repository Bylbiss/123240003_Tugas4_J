<?php 
session_start();
require "../config/koneksi.php";

if(!isset($_SESSION['id_user'])){
    header("Location: ../login.php?status=login_dulu");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id_todo = intval($_POST['id_todo'] ?? 0);
    $todo = mysqli_real_escape_string($koneksi, $_POST['todo'] ?? '');
    $status = mysqli_real_escape_string($koneksi, $_POST['status'] ?? 'pending');
    $id_user = intval($_SESSION['id_user']);

    $check = mysqli_query($koneksi, "SELECT * FROM todo WHERE id_todo = $id_todo AND id_user = $id_user");
    if(mysqli_num_rows($check) === 0){
        die("Akses ditolak: todo bukan milikmu!!");
    }

    $query = "UPDATE todo SET todo = '$todo', status = '$status' WHERE id_todo = $id_todo";
    $update = mysqli_query($koneksi, $query);

    if($update){
        header("Location: ../index.php");
        exit();
    } else {
        die("Gagal memperbarui todo: " . mysqli_error($koneksi));
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>