<?php
session_start();
include 'koneksi.php';

$id_pengguna = $_SESSION['id_pengguna'] ?? 1; // ganti sesuai sistem loginmu

if (isset($_POST['tambah'])) {
    $id_keranjang = $_POST['tambah'];
    mysqli_query($con, "UPDATE t_keranjang SET jumlah_pesanan = jumlah_pesanan + 1 WHERE id_keranjang = $id_keranjang AND id_pengguna = $id_pengguna");
} elseif (isset($_POST['hapus'])) {
    $id_keranjang = $_POST['hapus'];
    
    // Cek jumlah sekarang
    $cek = mysqli_query($con, "SELECT jumlah_pesanan FROM t_keranjang WHERE id_keranjang = $id_keranjang AND id_pengguna = $id_pengguna");
    $data = mysqli_fetch_assoc($cek);

    if ($data['jumlah_pesanan'] <= 1) {
        mysqli_query($con, "DELETE FROM t_keranjang WHERE id_keranjang = $id_keranjang AND id_pengguna = $id_pengguna");
    } else {
        mysqli_query($con, "UPDATE t_keranjang SET jumlah_pesanan = jumlah_pesanan - 1 WHERE id_keranjang = $id_keranjang AND id_pengguna = $id_pengguna");
    }
} elseif (isset($_POST['beli'])) {
    echo "<script>alert('Berhasil beli produk!'); window.location='beranda.php';</script>";
    exit;
}

header('Location: keranjang.php');
exit;
?>
