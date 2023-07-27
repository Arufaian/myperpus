<?php 
  require '../config/functions.php';

  session_start();

  if (!isset($_SESSION["key"])) {
    header("Location:../loginpages/loginAnggota.php");
  }

  $Suid = $_SESSION['key'];
  $data_admin = mysqli_query($conn, "SELECT * FROM anggota WHERE id = $Suid");
  $baris = mysqli_fetch_assoc($data_admin);

      if (isset($_POST["submit"])) {
        // cek apakah data berhasil ditambahkan
        if (tambahBuku($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil ditambahkan');
                    document.location.href = './dataBuku.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal ditambahkan');
                    document.location.href = './dataBuku.php';
                </script>";
        }
        
    }

  $books = query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Koleksi buku</title>
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
            <a href="anggota.php"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
          </li>
          <li>
            <a href="#" class="active"><i class="bi bi-bookshelf"></i><span>Koleksi buku</span></a>
          </li>
          <li>
            <a href="pinjamBuku.php"><i class="bi bi-journal-arrow-up"></i> <span>Peminjaman</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journal-arrow-down"></i> <span>Pengembalian</span></a>
          </li>
          <li>
          <a href="../config/logoutAnggota.php" onclick="confirm('Apakah anda ingin logout?');"><i class="bi bi-power"></i><span>Logout</span></a>
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
          Koleksi buku
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
                <h2>Koleksi buku</h2>
              </div>
              <div class="crd-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="dt" width="100%">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Id buku</td>
                        <td>Judul buku</td>
                        <td>Cover buku</td>
                        <td>Nama penulis</td>
                        <td>Status</td>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach($books as $book) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $book['id_buku'] ?></td>
                        <td><?= $book['judul'] ?></td>
                        <td><img src="../adminPages/img/<?= $book['foto'] ?>" alt="ehe" width="100"></td>
                        <td><?= $book['nama_penulis'] ?></td>
                        <td><?= $book['status'] ?></td>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                      </tr>
                    </tbody>
                  </table>
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
