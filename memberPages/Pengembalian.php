<?php 
  require '../config/functions.php';
  session_start();
  if (!isset($_SESSION["key"])) {
    header("Location:../loginpages/loginAnggota.php");
  }


    $Suid = $_SESSION['id_anggota'];
    $data_anggota = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota = '$Suid'");
    $baris = mysqli_fetch_assoc($data_anggota);

  $data_pinjam = query("SELECT * FROM pinjam WHERE id_peminjam = '$Suid'");
  // $books = query("SELECT judul FROM buku where id_buku = ''");
  $tanggalHariIni = date("Y-m-d");
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
            <a href="anggota.php"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
          </li>
          <li>
            <a href="koleksiBuku.php"><i class="bi bi-bookshelf"></i><span>Koleksi buku</span></a>
          </li>
          <li>
            <a href="pinjamBuku.php"><i class="bi bi-journal-arrow-up"></i> <span>Peminjaman</span></a>
          </li>
          <li>
            <a href="#" class="active"><i class="bi bi-journal-arrow-down"></i> <span>Pengembalian</span></a>
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
                <h2>List buku yang dipinjam</h2>
              </div>
              <div class="crd-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="dt" width="100%">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Id peminjam</td>
                        <td>Id buku</td>
                        <td>Nama peminjam</td>
                        <td>Tanggal peminjaman</td>
                        <td>Tanggal pengembalian</td>
                        <td>Status</td>
                        <td>Aksi</td>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach($data_pinjam as $row) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $row['id_peminjam'] ?></td>
                        <td><?= $row['id_buku'] ?></td>
                        <td><?= $row['nama_peminjam'] ?></td>
                        <td><?= $row['tp'] ?></td>
                        <td><?= $row['tk'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                          <button class="btn btn-danger"><a href="../config/proses_pengembalian.php?id_buku=<?= $row['id_buku'] ?>" style="text-decoration: none; color: white;">Kembalikan</a></button>
                        </td>
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

        <!-- Modal -->    
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>
