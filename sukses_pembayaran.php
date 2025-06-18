<?php
session_start();

$id_pesanan = $_SESSION['id_pesanan_terakhir'] ?? null;
$total_pesanan = $_SESSION['total_pesanan_terakhir'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pembayaran Berhasil</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: linear-gradient(120deg, #e0f7e9, #d1ecf1);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .sukses-container {
      background: #fff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 600px;
    }

    .sukses-container h1 {
      color: #4caf50;
      font-size: 28px;
      margin-bottom: 20px;
    }

    .sukses-container p {
      font-size: 16px;
      color: #555;
      margin-bottom: 15px;
    }

    .highlight {
      font-weight: bold;
      color: #333;
    }

    .btn-kembali {
      background-color: #7fba32;
      color: white;
      padding: 12px 24px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
    }

    .btn-kembali:hover {
      background-color: #689f38;
    }
  </style>
</head>
<body>
  <div class="sukses-container">
    <h1>Pembayaran Berhasil!</h1>
    <p>Pesanan kamu telah diterima.</p>

    <?php if ($id_pesanan && $total_pesanan): ?>
      <p>ID Pesanan: <span class="highlight"><?= $id_pesanan ?></span></p>
      <p>Total Dibayar: <span class="highlight">Rp <?= number_format($total_pesanan, 0, ',', '.') ?></span></p>
    <?php endif; ?>

    <p>Terima kasih telah berbelanja di <strong>Toko Dadi Rejo</strong>.<br>Pesanan sedang diproses dan akan segera dikirim.</p>

    <a href="beranda.php" class="btn-kembali">Kembali ke Beranda</a>
  </div>
</body>
</html>
