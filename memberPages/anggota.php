<?php 
  require '../config/functions.php';
  session_start();

  if (!isset($_SESSION["key"])) {
    header("Location:../loginpages/loginAnggota.php");
  }
  
  $Suid = $_SESSION['key'];
  $data_admin = mysqli_query($conn, "SELECT * FROM anggota WHERE id = $Suid");
  $baris = mysqli_fetch_assoc($data_admin);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit anggota</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/Anggota.css" />
  </head>
  <body>
    <input type="checkbox" id="nav-toggle" />
    <div class="sidebar">
      <div class="sidebar-brand">
        <h2><i class="bi bi-book"></i> <span> MYPERPUS </span></h2>
      </div>

      <div class="sidebar-menu">
        <ul>
          <li>
            <a href="#" class="active"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
          </li>
          <li>
            <a href="koleksiBuku.php"><i class="bi bi-bookshelf"></i><span>Koleksi buku</span></a>
          </li>
          <li>
            <a href="pinjamBuku.php"><i class="bi bi-journal-arrow-up"></i> <span>Peminjaman</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journal-arrow-down"></i> <span>Pengembalian</span></a>
          </li>
          <li>
            <a href="../config/logoutAnggota.php" onclick="return confirm('Apakah anda ingin Logout?');"><i class="bi bi-power"></i><span>Logout</span></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="main-content">
      <header>
        <h3>
          <label for="nav-toggle">
            <i class="bi bi-list"></i>
          </label>
          DASHBOARD
        </h3>
        <div class="search-wrapper">
          <i class="bi bi-search"></i>
          <input type="text" name="" id="" placeholder="search here" />
        </div>
        <div class="user-wrapper">
          <img src="../adminPages/img/<?= $baris['foto'] ?>" width="40" height="40" alt="gambar user" />
          <div>
            <h6><?= $baris['nama'] ?></h6>
            <small>anggota</small>
          </div>
        </div>
      </header>

      <main>
        <div class="recent-grid">
          <div class="projects">
            <div class="crd">
              <div class="crd-head">
                <h2>Halaman anggota</h2>
              </div>
              <div class="crd-body">
                <div class="content">
                  <h2>Selamat datang di perpustakaan kami</h2>
                  <p>
                    Selamat datang di Halaman Perpustakaan kami yang penuh dengan pengetahuan dan keindahan sastra. Di sini, Anda akan menemukan beragam koleksi buku, majalah, jurnal, dan materi referensi lainnya, semua disusun dengan
                    cermat untuk memenuhi kebutuhan intelektual dan minat pembaca dari segala usia.
                  </p>

                  <p>
                    Kami bangga menjadi tempat bagi Anda untuk merenungi cerita-cerita yang menarik, menyelami dunia pengetahuan yang tak terbatas, dan menemukan inspirasi dari berbagai sudut pandang. Koleksi kami mencakup fiksi dan
                    non-fiksi, dari sastra klasik hingga ilmu pengetahuan modern, dari sejarah yang kaya hingga petualangan fantastis.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>
