<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "tugas4_if-j";

$koneksi = mysqli_connect($host, $user, $pass, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>