<?php 
session_start();
require "../config/koneksi.php";

if(!isset($_SESSION['id_user'])){
    header("Location: ../login.php?status=login_dulu");
    exit();
}

if (isset($_GET['id'])){
    $id_todo = intval($_GET['id']);
    $id_user = intval($_SESSION['id_user']);

    $check = mysqli_query($koneksi, "SELECT * FROM todo WHERE id_todo = $id_todo AND id_user = $id_user");
    if(!$check || mysqli_num_rows($check) === 0){
        die("Akses ditolak: todo bukan milikmu!!!");
    }

    $query = "DELETE FROM todo WHERE id_todo = $id_todo";
    $delete = mysqli_query($koneksi, $query);

    if($delete){
        header("Location: ../index.php?status=hapus_berhasil");
        exit();
    } else {
        die("Gagal menghapus todo: " . mysqli_error($koneksi));
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>