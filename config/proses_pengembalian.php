<?php 
  require '../config/functions.php';
  session_start();
  if (!isset($_SESSION["key"])) {
    header("Location:../loginpages/loginAnggota.php");
  }


    $Suid = $_SESSION['id_anggota'];
    $data_anggota = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota = '$Suid'");
    $baris = mysqli_fetch_assoc($data_anggota);
    $id_buku = $_GET['id_buku'];

    $data_pinjam = query("SELECT * FROM pinjam WHERE id_buku = '$id_buku'")[0];
    $judul_buku = query("SELECT judul FROM buku where id_buku = '$id_buku'")[0];

    $tanggalHariIni = date("Y-m-d");



    if (isset($_POST["submit"])) {

        // cek apakah data berhasil diubah
        if (kembalikanBuku($_POST) > 0) {
            echo "<script>
                    alert('Buku berhasil di kembalikan');
                    document.location.href = '../memberPages/Pengembalian.php';
                </script>";
        } else {
            echo "<script>
                    alert('Buku gagal dikembalikan');
                    document.location.href = '../memberPages/Pengembalian.php';
                </script>";
        }
        
    }

?>

<link rel="stylesheet" href="">

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman pengembalian</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/dataBuku.css" />

    <!-- data table css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />

    <!-- data table js -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="../js/script.js"></script>
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
            <a href="#"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-bookshelf"></i><span>Koleksi buku</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journal-arrow-up"></i> <span>Peminjaman</span></a>
          </li>
          <li>
            <a href="#" class="active"><i class="bi bi-journal-arrow-down"></i> <span>Pengembalian</span></a>
          </li>
          <li>
          <a href="#" onclick="confirm('Apakah anda ingin logout?');"><i class="bi bi-power"></i><span>Logout</span></a>
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
          halaman pengembalian
        </h3>
        <div class="search-wrapper">
          <i class="bi bi-search"></i>
          <input type="text" name="" id="" placeholder="search here" />
        </div>
        <div class="user-wrapper">
          <img src="../adminPages/img/<?= $baris['foto'] ?>" width="40" height="40" alt="gambar user" />
          <div>
            <h6><?= $baris['nama'] ?></h6>
            <small>admin</small>
          </div>
        </div>
      </header>

      <main>
        <div class="recent-grid">
          <div class="projects">
            <div class="crd">
              <div class="crd-head">
                <h2>Pengembalian buku</h2>
              </div>
              <div class="crd-body">
                <form method="post" action="">
                  <!-- tangal peminjaman dan id -->
                  <input type="hidden" name="tp" value="<?= $data_pinjam['tp'] ?>">
                  <input type="hidden" name="id" value="<?= $data_pinjam['id'] ?>">

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="id_peminjam" value="<?= $data_pinjam['id_peminjam'] ?>" />
                    <label for="floatingInput">ID peminjam</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="id_buku" value="<?= $data_pinjam['id_buku'] ?>" />
                    <label for="floatingInput">ID buku</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" disabled value="<?= $judul_buku['judul'] ?>" />
                    <label for="floatingInputDisabled">Judul buku</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com" name="tk" value="<?= $tanggalHariIni ?>" />
                    <label for="floatingInput">Tanggal pengembalian</label>
                  </div>

                  <div>
                    <button class="btn btn-warning"><a href="../memberPages/Pengembalian.php" style="text-decoration: none; color: white">Batal</a></button>
                    <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Apakah anda ingin mengembalikan buku?');">Kembalikan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>    
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>
