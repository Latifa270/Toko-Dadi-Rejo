<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_pengguna'])) {
    header("Location: masuk.php");
    exit;
}
$id_pengguna = $_SESSION['id_pengguna'];


if (!isset($_POST['pilih']) || empty($_POST['pilih'])) {
    echo "<p style='text-align:center; font-size:18px; color:red;'>Produk tidak ditemukan atau belum dipilih.</p>";
    exit;
}

$ids = array_map('intval', $_POST['pilih']);
$id_list = implode(",", $ids);

$query = "SELECT tk.id_keranjang, tp.nama_produk, tp.harga_produk, tp.gambar_produk, tk.jumlah_pesanan
          FROM t_keranjang tk
          JOIN t_produk tp ON tk.id_produk = tp.id_produk
          WHERE tk.id_pengguna = $id_pengguna AND tk.id_keranjang IN ($id_list)";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style_info_produk.css" />
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: linear-gradient(120deg, #e0f7e9, #d1ecf1);
      min-height: 100vh;
    }

    .konfirmasi-container {
      max-width: 800px;
      margin: 40px auto;
      padding: 25px 30px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .item-keranjang {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 10px;
    }

    .gambar-produk {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
      margin-right: 20px;
    }

    .info-produk p {
      margin: 4px 0;
    }

    .info-produk .nama-produk {
      font-size: 18px;
      font-weight: bold;
    }

    .form-area label {
      font-weight: 600;
      display: block;
      margin-top: 10px;
    }

    .form-area textarea, 
    .form-area select, 
    .form-area input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .btn-beli {
      background-color: #7fba32;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
    }

    .btn-beli:hover {
      background-color: #689f38;
    }

    h2, h3 {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="macbook-pro">
    <div class="div konfirmasi-container">
      <h2>Konfirmasi Pembelian</h2>

      <form method="POST" action="proses_pembayaran.php">
        <?php
        $total = 0;
        while ($row = mysqli_fetch_assoc($result)):
            $subtotal = $row['harga_produk'] * $row['jumlah_pesanan'];
            $total += $subtotal;
        ?>
          <div class="item-keranjang">
            <img src="<?= $row['gambar_produk'] ?>" class="gambar-produk" />
            <div class="info-produk">
              <p class="nama-produk"><?= $row['nama_produk'] ?></p>
              <p>Harga: Rp <?= number_format($row['harga_produk'], 0, ',', '.') ?></p>
              <p>Jumlah: <?= $row['jumlah_pesanan'] ?></p>
              <p class="subtotal-produk">Subtotal: Rp <?= number_format($subtotal, 0, ',', '.') ?></p>
            </div>
          </div>
          <input type="hidden" name="pilih[]" value="<?= $row['id_keranjang'] ?>">
        <?php endwhile; ?>

        <h3>Total Bayar: Rp <?= number_format($total, 0, ',', '.') ?></h3>

        <div class="form-area">
          <label for="alamat_pengiriman">Alamat Pengiriman:</label>
          <textarea name="alamat_pengiriman" required rows="3"></textarea>

          <label for="metode">Metode Pembayaran:</label>
          <select name="metode" required>
            <option value="cod">COD</option>
            <option value="transfer bank">Transfer Bank</option>
          </select>

          <label for="catatan">Catatan (Opsional):</label>
          <input type="text" name="catatan">
        </div>

        <div style="text-align:center;">
          <button type="submit" class="btn-beli">Konfirmasi Beli</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
