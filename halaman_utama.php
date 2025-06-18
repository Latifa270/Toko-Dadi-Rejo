<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Tambahkan ini
include 'koneksi.php';

// Jika user sudah login, redirect ke beranda.php
if(isset($_SESSION['user'])) {
    header("Location: beranda.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Toko Dadi Rejo</title>
    <link rel="stylesheet" href="style_utama.css">
</head>
<body>
    <div class="hero">
        <div class="overlay">
            <div class="content-left">
                <h1>Toko Dadi Rejo, Temukan<br>
                    Barang Sehari-hari<br>
                    dengan lebih mudah</h1>
            </div>
            <div class="content-right">
                <a href="daftar.php" class="btn-daftar">Daftar</a>
                <p class="login-link">Sudah Punya Akun? <a href="masuk.php">Masuk</a></p>
            </div>
        </div>
    </div>
</body>
</html>