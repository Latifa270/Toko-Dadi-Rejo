<?php
session_start();
include "koneksi.php"; // pastikan file koneksi ke DB

if (!isset($_SESSION['id_pengguna'])) {
    header("Location: masuk.php"); // balik ke login kalau belum login
    exit;
}

$id_pengguna = $_SESSION['id_pengguna'];

$nama = $_POST['nama_pengguna'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];

$query = "UPDATE t_pengguna SET 
          nama_pengguna='$nama', 
          jenis_kelamin='$jenis_kelamin', 
          tanggal_lahir='$tanggal_lahir' 
          WHERE id_pengguna='$id_pengguna'";

if (mysqli_query($con, $query)) {
    // redirect setelah sukses update
    header("Location: lihat_profil.php");
    exit;
} else {
    echo "Gagal memperbarui profil: " . mysqli_error($con);
}


header("Location: lihat_profil.php");
exit;

?>
