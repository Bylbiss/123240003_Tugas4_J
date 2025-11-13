<?php 
session_start();

// Ketika tidak ada $_SESSION['username']
if (!isset($_SESSION['id_user'])){
    header("Location: ../login.php?status=login_dulu");
    exit();
}
?>