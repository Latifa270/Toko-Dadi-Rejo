<?php
include 'koneksi.php';

$id_kategori = 250023;
$search = isset($_GET['q']) ? $_GET['q'] : '';

$query = "SELECT * FROM t_produk WHERE id_kategori = $id_kategori AND status_produk = 'tersedia'";
if (!empty($search)) {
    $safeSearch = mysqli_real_escape_string($con, $search);
    $query .= " AND nama_produk LIKE '%$safeSearch%'";
}
$result = mysqli_query($con, $query);

// Produk Terlaris
$query_best = "SELECT id_produk, nama_produk, harga_produk, gambar_produk FROM t_produk WHERE is_best_seller = 1 LIMIT 6";
$result_best = mysqli_query($con, $query_best);

$nama_classes = ['text-wrapper-33', 'text-wrapper-34', 'text-wrapper-35', 'text-wrapper-36', 'text-wrapper-37', 'text-wrapper-38'];
$harga_classes = ['text-wrapper-27', 'text-wrapper-28', 'text-wrapper-29', 'text-wrapper-30', 'text-wrapper-31', 'text-wrapper-39'];
$gambar_classes = ['gula-removebg-2', 'energen-removebg-2', 'potabee-removebg', 'tehpucuk-removebg', 'untitled-removebg', 'extra-img'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style_kategori.css" />
  </head>
  <body>
    <div class="macbook-pro">
      <div class="div">
        <div class="overlap">
          <div class="overlap-group">
            <div class="rectangle"></div>
            <div class="text-wrapper">Produk</div>
            <div class="text-wrapper-2">Kategori Produk</div>
            <div class="text-wrapper-3">Kontak</div>
            <div class="text-wrapper-4">TOKO DADI REJO</div>
            <div class="rectangle-2"></div>
            <div class="rectangle-3"></div>
            <div class="text-wrapper-5">Rp. 21.000</div>
            <div class="text-wrapper-6">Rp. 19.000</div>
            <div class="text-wrapper-7"><a href="#">Gula</a></div>
            <div class="text-wrapper-8"><a href="#">Energen</a></div>
            <img class="gula-removebg" src="gambar/makanan_pokok/gula.png" />
            <img class="energen-removebg" src="gambar/minuman_sachet/energen.png" />
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

            <!-- Produk Utama -->
            <div class="product-center">
              <div class="product-container">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                  <div class="product-item">
                    <a href="info_produk.php?id=<?= $row['id_produk'] ?>">
                      <img src="<?= $row['gambar_produk'] ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>" />
                      <h3><?= htmlspecialchars($row['nama_produk']) ?></h3>
                      <p>Rp <?= number_format($row['harga_produk'], 0, ',', '.') ?></p>
                    </a>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>
          </div>

          <!-- Navigasi Kategori -->
          <div class="div-wrapper"><a href="kategori_makanan_pokok.php" class="text-wrapper-21">Makanan Pokok</a></div>
          <div class="overlap-2"><a href="kategori_makanan_ringan.php" class="text-wrapper-22">Makanan Ringan</a></div>
          <div class="overlap-3"><a href="kategori_minuman_botol.php" class="text-wrapper-23">Minuman Botol</a></div>
          <div class="overlap-4"><a href="kategori_bumbu_dapur.php" class="text-wrapper-24">Bumbu Dapur</a></div>
          <div class="overlap-5"><a href="kategori_minuman_sachet.php" class="text-wrapper-25">Minuman Sachet</a></div>

          <!-- Ikon Header -->
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
            $i = 0;
            while ($row_best = mysqli_fetch_assoc($result_best)) {
              if ($i >= 6) break;
              echo '<div class="' . $nama_classes[$i] . '"><a href="info_produk.php?id=' . $row_best['id_produk'] . '">' . htmlspecialchars($row_best['nama_produk']) . '</a></div>';
              echo '<div class="' . $harga_classes[$i] . '">Rp. ' . number_format($row_best['harga_produk'], 0, ',', '.') . '</div>';
              echo '<a href="info_produk.php?id=' . $row_best['id_produk'] . '"><img class="' . $gambar_classes[$i] . '" src="' . htmlspecialchars($row_best['gambar_produk']) . '" alt="' . htmlspecialchars($row_best['nama_produk']) . '" /></a>';
              $i++;
            }
            ?>
          </div>
        </div>

        <!-- Footer & Pencarian -->
        <div class="overlap-8">
          <div class="text-wrapper-38">TOKO DADI REJO</div>
          <a href="beranda.php" class="home-logo-wrapper">
            <img class="home-logo" src="gambar/iconRumah.png" alt="Beranda"/>
          </a>
          <div class="overlap-9">
        <p class="search-placeholder-text">Lakukan penyelusuran produk dengan kategori</p>
      </div>
          <p class="jl-dawuhan-kec-taman">Jl. Dawuhan Kec. Taman Kota Madiun</p>
          <div class="text-wrapper-43">Lokasi :</div>
        </div>
      </div>
    </div>
  </body>
</html>
