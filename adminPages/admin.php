<?php 
require '../config/functions.php';
session_start();
if (!isset($_SESSION["id"])) {
    header("Location:../loginpages/loginAdmin.php");
}

$Sid = $_SESSION['id'];
$data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE id = $Sid");
$baris = mysqli_fetch_assoc($data_admin);




// menghitung jumlah admin
$query = "SELECT COUNT(*) AS total_admin FROM admins";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$jumlahAdmin = $row['total_admin'];

// menghitung jumlah anggota
$query = "SELECT COUNT(*) AS total_anggota FROM anggota";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$jumlahAnggota = $row['total_anggota'];

// menghitung jumlah buku
$query = "SELECT COUNT(*) AS total_buku FROM buku";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$jumlahBuku = $row['total_buku'];


$bukuTerbaru = query("SELECT * FROM buku ORDER BY id DESC LIMIT 5");

$anggotaTerbaru = query('SELECT * FROM anggota ORDER BY id DESC LIMIT 5')


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin page</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/admin_st.css">
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
            <a href="admin.php" class="active"><i class="bi bi-speedometer2"></i> <span>dashboard</span></a>
          </li>
          <li>
            <a href="dataAdmin.php"><i class="bi bi-person"></i><span>Data admin</span></a>
          </li>
          <li>
            <a href="dataAnggota.php"><i class="bi bi-people"></i><span>Data anggota</span></a>
          </li>
          <li>
            <a href="dataBuku.php"><i class="bi bi-bookshelf"></i><span>Data buku</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journal-arrow-up"></i><span>Data peminjaman</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journal-arrow-down"></i><span>Data pengembalian</span></a>
          </li>
          <li>
            <a href="../config/logout.php" onclick="confirm('Apakah anda ingin logout?');"><i class="bi bi-power"></i><span>Logout</span></a>
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
          dashboard
        </h3>
        <div class="search-wrapper">
          <i class="bi bi-search"></i>
          <input type="text" name="" id="" placeholder="search here" />
        </div>
        <div class="user-wrapper">
          <img src="./img/<?= $baris['foto'] ?>" width="40" height="40" alt="gambar user" />
          <div>
            <h6><?= $baris['nama_admin'] ?></h6>
            <small>admin</small>
          </div>
        </div>
      </header>

      <main>
        <div class="cards">
          <div class="card-single">
            <div>
              <h1><?= $jumlahAdmin ?></h1>
              <span>admin</span>
            </div>
            <div>
              <i class="bi bi-person"></i>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1><?= $jumlahAnggota ?></h1>
              <span>Anggota</span>
            </div>
            <div>
              <i class="bi bi-people-fill"></i>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1><?= $jumlahBuku ?></h1>
              <span>buku</span>
            </div>
            <div>
              <i class="bi bi-journal"></i>
            </div>
          </div>
          <div class="card-single">
            <div>
              <h1>54</h1>
              <span>income</span>
            </div>
            <div>
              <i class="bi bi-display"></i>
            </div>
          </div>
        </div>

        <div class="recent-grid">
          <div class="projects">
            <div class="crd">
              <div class="crd-head">
                <h2>Buku terakhir ditambahkan</h2>
                <button><a href="../adminPages/dataBuku.php" style="color: white; text-decoration: none;">selengkapnya</a></button>
              </div>
              <div class="crd-body">
                <div class="table-responsive">
                  <table width="100%">
                    <thead>
                      <tr>
                        <td>No</td>
                        <td>Judul buku</td>
                        <td>Penulis</td>
                      </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach($bukuTerbaru as $row): ?>
                    <tbody>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['nama_penulis'] ?></td>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="customers">
            <div class="crd">
              <div class="crd-head">
                <h2>Anggota baru</h2>
                <button>
                  <a href="../adminPages/dataAnggota.php" style="color: white; text-decoration: none;">selengkapnya</a>
                </button>
              </div>
              <div class="crd-body">

                <?php $i = 1; ?>
                <?php foreach($anggotaTerbaru as $row): ?>
                <div class="customer">
                  <div class="info">
                    <img src="../adminPages/img/<?= $row['foto'] ?>" width="35" height="35" alt="gambar user" />
                    <div>
                      <h4><?= $row['nama'] ?></h4>
                      <small>anggota</small>
                    </div>
                  </div>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>
