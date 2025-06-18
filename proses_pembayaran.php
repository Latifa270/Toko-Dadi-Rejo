<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengguna = $_SESSION['id_pengguna'] ?? 1; // sementara

    $ids_keranjang = $_POST['pilih'] ?? [];

    if (empty($ids_keranjang)) {
        echo "Tidak ada produk yang dipilih.";
        exit;
    }

    // Ambil data dari keranjang berdasarkan id_keranjang yang dipilih
    $id_list = implode(',', array_map('intval', $ids_keranjang));
    $query = "SELECT tk.id_keranjang, tk.id_produk, tk.jumlah_pesanan, tp.harga_produk 
              FROM t_keranjang tk 
              JOIN t_produk tp ON tk.id_produk = tp.id_produk 
              WHERE tk.id_pengguna = $id_pengguna AND tk.id_keranjang IN ($id_list)";
    $result = mysqli_query($con, $query);

    $total_pesanan = 0;
    $produk_dipesan = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $subtotal = $row['harga_produk'] * $row['jumlah_pesanan'];
        $total_pesanan += $subtotal;
        $produk_dipesan[] = $row;
    }

    // Simpan pesanan ke t_pesanan
    $alamat = $_POST['alamat_pengiriman'] ?? '';
    $catatan = $_POST['catatan'] ?? '';
    $metode = $_POST['metode'] ?? 'cod';

    $stmt = $con->prepare("INSERT INTO t_pesanan (id_pengguna, total_pesanan, metode_pembayaran, alamat_pengiriman, catatan) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idsss", $id_pengguna, $total_pesanan, $metode, $alamat, $catatan);
    $stmt->execute();

    $id_pesanan = $stmt->insert_id;
    $stmt->close();

    // Masukkan detail pesanan dan update stok
    $stmt = $con->prepare("INSERT INTO t_detail_pesanan (id_pesanan, id_produk, jumlah_pesanan, sub_total_produk) VALUES (?, ?, ?, ?)");
    foreach ($produk_dipesan as $item) {
        $subtotal = $item['harga_produk'] * $item['jumlah_pesanan'];
        $stmt->bind_param("iiid", $id_pesanan, $item['id_produk'], $item['jumlah_pesanan'], $subtotal);
        $stmt->execute();

        // Kurangi stok produk
        $id_produk = $item['id_produk'];
        $jumlah_dibeli = $item['jumlah_pesanan'];
        $con->query("UPDATE t_produk SET stok_produk = stok_produk - $jumlah_dibeli WHERE id_produk = $id_produk");

        // Update status jika stok habis
        $con->query("UPDATE t_produk SET status_produk = 'habis' WHERE id_produk = $id_produk AND stok_produk <= 0");
    }
    $stmt->close();

    // Hapus dari keranjang
    $hapus = "DELETE FROM t_keranjang WHERE id_pengguna = $id_pengguna AND id_keranjang IN ($id_list)";
    mysqli_query($con, $hapus);

    // Simpan ke session untuk ditampilkan di sukses_pembayaran.php
$_SESSION['id_pesanan_terakhir'] = $id_pesanan;
$_SESSION['total_pesanan_terakhir'] = $total_pesanan;

// Redirect ke halaman sukses
header("Location: sukses_pembayaran.php");
exit;

    // Redirect ke halaman sukses
    header("Location: sukses_pembayaran.php");
    exit;
} else {
    echo "Akses tidak valid.";
}
?>
