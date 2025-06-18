<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_hp    = $_POST['phone'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($no_hp) || empty($email) || empty($password)) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit;
    }

    $cek = $con->prepare("SELECT id_pengguna FROM t_pengguna WHERE email_pengguna = ? OR no_telepon_pengguna = ?");
    $cek->bind_param("ss", $email, $no_hp);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        echo "<script>alert('Email atau No HP sudah digunakan!'); window.history.back();</script>";
        $cek->close();
        exit;
    }
    $cek->close();

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $con->prepare("
        INSERT INTO t_pengguna 
        (username_pengguna, password_pengguna, nama_pengguna, email_pengguna, no_telepon_pengguna, tgl_dibuat)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");

    $nama = $email;
    $stmt->bind_param("sssss", $email, $password_hash, $nama, $email, $no_hp);

    if ($stmt->execute()) {
        $_SESSION['id_pengguna'] = $data['id_pengguna'];
        $_SESSION['nama'] = $nama;
        header("Location: beranda.php");
        exit;
    } else {
        echo "<script>alert('Gagal mendaftar: {$stmt->error}'); window.history.back();</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Toko Dadi Rejo</title>
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
                    <h2>Selamat Datang<br><strong>Toko Dadi Rejo !</strong></h2>
                </div>
            </div>
            <form class="form" method="post">
                <label for="phone">No HP</label>
                <input type="text" id="phone" name="phone" placeholder="No HP" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="submit">Daftar</button>
            </form>
            <!-- Tambahan -->
            <div class="login-link">
                Sudah punya akun? <a href="masuk.php">Masuk di sini.</a>
            </div>
        </div>
    </div>
</body>
</html>
