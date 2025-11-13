<?php
session_start();
require "../config/koneksi.php";

// =============
// PROSES LOGIN
// =============

if (isset($_POST['login'])) {
    // Tangkap Data
    $username = mysqli_real_escape_string($koneksi, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($koneksi, $_POST['password'] ?? '');

    // Query
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    // Pindah kemana?
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])){
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];

            header("Location: ../index.php");
            exit();
        } else {
            header("Location: ../login.php?status=gagal_login");
            exit();
        }
    } else {
        header("Location: ../login.php?status=gagal_login");
        exit();
    }
}

// ================
// PROSES REGISTER
// ================
if (isset($_POST['register'])) {
    // Tangkap Data
    $username = mysqli_real_escape_string($koneksi, $_POST['username'] ?? '');
    $password = mysqli_real_escape_string($koneksi, $_POST['password'] ?? '');
    $confirm = mysqli_real_escape_string($koneksi, $_POST['confirm'] ?? '');

    if($password !== $confirm){
        header("Location: ../register.php?status=password_tidak_sama");
        exit();
    }

    // Query
    $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if($check && mysqli_num_rows($check) > 0){
        header("Location: ../register.php?status=gagal_mendaftar");
        exit();
    }
    
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed')";
    $insert = mysqli_query($koneksi, $query);

    if ($insert) {
        header("Location: ../login.php?status=berhasil_mendaftar");
        exit();
    } else {
        header("Location: ../register.php?status=gagal_mendaftar");
        exit();
    }
}