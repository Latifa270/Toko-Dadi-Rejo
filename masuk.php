<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identitas = $_POST['identitas'] ?? '';
    $password  = $_POST['password'] ?? '';

    if (filter_var($identitas, FILTER_VALIDATE_EMAIL)) {
        $query = "SELECT * FROM t_pengguna WHERE email_pengguna = ?";
    } else {
        $query = "SELECT * FROM t_pengguna WHERE no_telepon_pengguna = ?";
    }

    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $identitas);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $data = $result->fetch_assoc();

        if (password_verify($password, $data['password_pengguna'])) {
           $_SESSION['id_pengguna'] = $data['id_pengguna']; // GANTI dari 'user_id'
            $_SESSION['nama']        = $data['nama_pengguna'];


            header("Location: beranda.php");
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Akun tidak ditemukan!'); window.history.back();</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Toko Dadi Rejo</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <img src="gambar/backgroundLogin.png" alt="Belanja" class="background-image">
            <div class="overlay"></div>
        </div>
        <div class="right-panel">
            <div class="header">
                <span class="back" onclick="window.history.back();">&#8592;</span>
                <div class="title-box">
                    <h2>Masuk<br><strong>Toko Dadi Rejo !</strong></h2>
                </div>
            </div>
            <form class="form" method="post" action="masuk.php">
    <label for="identitas">Email atau No HP</label>
    <input type="text" id="identitas" name="identitas" placeholder="Email atau No HP" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Password" required>

    <button type="submit">Masuk</button>
</form>
<div class="login-link">
                Belum punya akun? <a href="daftar.php">Daftar sekarang.</a>
            </div>


        </div>
    </div>
</body>
</html>
