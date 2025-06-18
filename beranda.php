<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
    header('Location: masuk.php');
    exit;
}
require_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda - Toko Dadi Rejo</title>
  <link rel="stylesheet" href="style_beranda.css" />
</head>
<body>
<div class="macbook-pro">
  <div class="div">
    <div class="overlap">
      <div class="overlap-group">
        <!-- Header dan Keterangan -->
        <div class="rectangle"></div>
        <div class="text-wrapper">Produk</div>
        <div class="text-wrapper-2">Kategori Produk</div>
        <div class="text-wrapper-3">Kontak</div>
        <div class="text-wrapper-4">TOKO DADI REJO</div>
        <div class="rectangle-2"></div>
        <div class="rectangle-3"></div>

        <?php
        $produkIds = [120003, 120030]; // Gula dan Energen
        $kelasNama = ['text-wrapper-7', 'text-wrapper-8'];
        $kelasHarga = ['text-wrapper-5', 'text-wrapper-6'];
        $kelasGambar = ['gula-removebg', 'energen-removebg'];

        foreach ($produkIds as $index => $id) {
            $sql = "SELECT nama_produk, harga_produk, gambar_produk FROM t_produk WHERE id_produk = $id";
            $result = $con->query($sql);
            if ($result && $row = $result->fetch_assoc()) {
                $nama = htmlspecialchars($row['nama_produk']);
                $harga = number_format($row['harga_produk'], 0, ',', '.');
                $gambar = htmlspecialchars($row['gambar_produk']);

                echo '<div class="' . $kelasNama[$index] . '"><a href="info_produk.php?id=' . $id . '">' . $nama . '</a></div>';
                echo '<div class="' . $kelasHarga[$index] . '">Rp. ' . $harga . '</div>';
                echo '<a href="info_produk.php?id=' . $id . '">';
                echo '<img class="' . $kelasGambar[$index] . '" src="' . $gambar . '" alt="' . $nama . '"/>';
                echo '</a>';
            }
        }
        ?>

        <div class="group">
          <div class="text-wrapper-9">Makanan Pokok</div>
          <div class="text-wrapper-10">Makanan Ringan</div>
          <div class="text-wrapper-11">Minuman Botol</div>
          <div class="text-wrapper-12">Bumbu Dapur</div>
          <div class="text-wrapper-13">Minuman Sachet</div>
        </div>
        <p class="alamat-jl-dawuhan">Alamat : Jl. Dawuhan <br />Kec. Taman, Madiun</p>
        <div class="text-wrapper-14">2024</div>
        <div class="text-wrapper-15">Kontak : 089652248149</div>
        <div class="text-wrapper-16">Email : dadirjo1@gmail.com</div>
        <div class="text-wrapper-17">@2024 Toko Dadi Rejo</div>
        <p class="toko-dadi-rejo">
          Toko Dadi Rejo adalah toko kelontong yang menyediakan berbagai kebutuhan sehari-hari, mulai dari aneka
          jajanan, bahan dapur, minuman, <br />hingga bahan makanan pokok.
        </p>
        <div class="overlap-group-wrapper">
          <div class="overlap-group-2">
            <img class="pengunjung" src="gambar/beranda.png" />
          </div>
        </div>
      </div>

      <!-- Kategori -->
      <div class="div-wrapper"><a href="kategori_makanan_pokok.php" class="text-wrapper-21">Makanan Pokok</a></div>
      <div class="overlap-2"><a href="kategori_makanan_ringan.php" class="text-wrapper-22">Makanan Ringan</a></div>
      <div class="overlap-3"><a href="kategori_minuman_botol.php" class="text-wrapper-23">Minuman Botol</a></div>
      <div class="overlap-4"><a href="kategori_bumbu_dapur.php" class="text-wrapper-24">Bumbu Dapur</a></div>
      <div class="overlap-5"><a href="kategori_minuman_sachet.php" class="text-wrapper-25">Minuman Sachet</a></div>

      <!-- Sidebar -->
      <div class="overlap-6">
        <div class="rectangle-7"></div>
        <img class="akar-icons-text" src="gambar/garisTiga.png" />
        <div class="text-wrapper-26">Kategori</div>
      </div>
      <a href="profil_pengguna.php" class="mdi-light-account-wrapper">
        <img class="mdi-light-account" src="gambar/iconAkun.png" alt="user"/>
      </a>
      <a href="keranjang.php" class="mdi-light-cart-wrapper">
        <img class="img-2" src="gambar/iconKeranjang.png" alt="Keranjang"/>
      </a>
      <a href="tentang_kami.php" class="mdi-light-bell-wrapper">
        <img class="img-2" src="gambar/iconTentangKami.png" alt="Tentang Kami"/>
      </a>

      <!-- Produk Terlaris -->
      <div class="overlap-7">
        <div class="rectangle-8"></div>
        <div class="rectangle-9"></div>
        <div class="rectangle-10"></div>
        <div class="rectangle-11"></div>
        <div class="rectangle-12"></div>
        <div class="rectangle-13"></div>
        <div class="text-wrapper-32">Produk Terlaris</div>

        <?php
        $query = "SELECT id_produk, nama_produk, harga_produk, gambar_produk FROM t_produk WHERE is_best_seller = 1 LIMIT 6";
        $result = $con->query($query);

        $nama_classes  = ['text-wrapper-33', 'text-wrapper-34', 'text-wrapper-35', 'text-wrapper-36', 'text-wrapper-37', 'text-wrapper-38'];
        $harga_classes = ['text-wrapper-27', 'text-wrapper-28', 'text-wrapper-29', 'text-wrapper-30', 'text-wrapper-31', 'text-wrapper-39'];
        $gambar_classes= ['gula-removebg-2', 'energen-removebg-2', 'potabee-removebg', 'tehpucuk-removebg', 'untitled-removebg', 'extra-img'];

        $i = 0;
        while ($row = $result->fetch_assoc()) {
            if ($i >= 6) break;
            $id     = $row['id_produk'];
            $nama   = htmlspecialchars($row['nama_produk']);
            $harga  = number_format($row['harga_produk'], 0, ',', '.');
            $gambar = htmlspecialchars($row['gambar_produk']);

            echo '<div class="' . $nama_classes[$i] . '"><a href="info_produk.php?id=' . $id . '">' . $nama . '</a></div>';
            echo '<div class="' . $harga_classes[$i] . '">Rp. ' . $harga . '</div>';
            echo '<a href="info_produk.php?id=' . $id . '">';
            echo '<img class="' . $gambar_classes[$i] . '" src="' . $gambar . '" alt="' . $nama . '"/>';
            echo '</a>';

            $i++;
        }
        ?>
      </div>
    </div>

    <!-- Footer -->
    <div class="overlap-8">
      <div class="text-wrapper-38">TOKO DADI REJO</div>
      <a href="beranda.php" class="home-logo-wrapper">
        <img class="home-logo" src="gambar/iconRumah.png" alt="Beranda"/>
      </a>
      <div class="overlap-9">
        <p class="search-placeholder-text">Lakukan penyelusuran produk dengan kategori</p>
      </div>
      <p class="jl-dawuhan-kec-taman">Jl.&nbsp;&nbsp;Dawuhan Kec. Taman Kota Madiun</p>
      <div class="text-wrapper-43">Lokasi :</div>
      <div class="text-wrapper-user">
        <?php echo "Halo, " . htmlspecialchars($_SESSION['nama']); ?> |
        <a href="logout.php" style="color: red; text-decoration: none;">Logout</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
