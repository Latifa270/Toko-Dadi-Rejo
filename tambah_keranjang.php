<?php
session_start();
require_once 'koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_pengguna'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='masuk.php';</script>";
    exit;
}

// Cek apakah permintaan menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengguna = $_SESSION['id_pengguna'];

    // Validasi input dari form
    if (!isset($_POST['id_produk']) || !is_numeric($_POST['id_produk'])) {
        echo "<script>alert('ID produk tidak valid'); window.location='beranda.php';</script>";
        exit;
    }

    $id_produk = intval($_POST['id_produk']); // Pastikan integer

    // Cek apakah produk sudah ada di keranjang
    $query_cek = "SELECT jumlah_pesanan FROM t_keranjang WHERE id_pengguna = ? AND id_produk = ?";
    $stmt_cek = $con->prepare($query_cek);
    $stmt_cek->bind_param("ii", $id_pengguna, $id_produk);
    $stmt_cek->execute();
    $result = $stmt_cek->get_result();

    if ($result->num_rows > 0) {
        // Tambah jumlah_pesanan
        $query_update = "UPDATE t_keranjang SET jumlah_pesanan = jumlah_pesanan + 1 WHERE id_pengguna = ? AND id_produk = ?";
        $stmt_update = $con->prepare($query_update);
        $stmt_update->bind_param("ii", $id_pengguna, $id_produk);
        $stmt_update->execute();
    } else {
        // Tambah data baru
        $query_insert = "INSERT INTO t_keranjang (id_pengguna, id_produk, jumlah_pesanan) VALUES (?, ?, 1)";
        $stmt_insert = $con->prepare($query_insert);
        $stmt_insert->bind_param("ii", $id_pengguna, $id_produk);
        $stmt_insert->execute();
    }

    echo "<script>alert('Produk berhasil ditambahkan ke keranjang'); window.location='keranjang.php';</script>";
    exit;
} else {
    echo "<script>alert('Akses tidak valid'); window.location='beranda.php';</script>";
    exit;
}
?>
