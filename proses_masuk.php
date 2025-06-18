<?php
session_start();
require_once 'koneksi.php';

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
        $_SESSION['user_id'] = $data['id_pengguna'];
        $_SESSION['nama']    = $data['nama_pengguna'];
        header("Location: beranda.php"); // arahkan ke halaman beranda setelah login
        exit;
    } else {
        echo "<script>alert('Password salah'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akun tidak ditemukan'); window.history.back();</script>";
}
?>
