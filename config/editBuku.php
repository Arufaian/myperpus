<?php 

    require 'functions.php';
    session_start();
    $Sid = $_SESSION['id'];
    $data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE id = $Sid");
    $baris = mysqli_fetch_assoc($data_admin);


    // ambil data lewat url
    $id = $_GET["id"];

    // query data berdasarkan id
    $buku = query("SELECT * FROM buku WHERE id = $id")[0];



    if (isset($_POST["submit"])) {

        // cek apakah data berhasil diubah
        if (updateBuku($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil diubah');
                    document.location.href = '../adminPages/dataBuku.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal diubah');
                    document.location.href = '../adminPages/dataBuku.php';
                </script>";
        }
        
    }
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit buku</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/dataBuku.css" />
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
            <a href="../adminPages/admin.php"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
          </li>
          <li>
            <a href="../adminPages/dataAdmin.php"> <i class="bi bi-person"></i> <span>Data admin</span></a>
          </li>
          <li>
            <a href="../adminPages/dataAnggota.php"> <i class="bi bi-people"></i> <span>Data anggota</span></a>
          </li>
          <li>
            <a href="../adminPages/dataBuku.php" class="active"><i class="bi bi-bookshelf"></i><span>Data buku</span></a>
          </li>
          <li>
            <a href="../adminPages/dataPeminjaman.php"><i class="bi bi-journal-arrow-up"></i><span>Data peminjaman</span></a>
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
          Data buku
        </h3>
        <div class="search-wrapper">
          <i class="bi bi-search"></i>
          <input type="text" name="" id="" placeholder="search here" />
        </div>
        <div class="user-wrapper">
          <img src="../adminPages/img/<?= $baris['foto'] ?>" width="40" height="40" alt="gambar user" />
          <div>
            <h6><?= $baris['nama_admin'] ?></h6>
            <small>admin</small>
          </div>
        </div>
      </header>

      <main>
        <div class="recent-grid">
          <div class="projects">
            <div class="crd">
              <div class="crd-head">
                <h2>EDIT BUKU</h2>
              </div>
              <div class="crd-body">
                <form method="post" action="" enctype="multipart/form-data">
                  <!-- gambar dan id -->
                  <input type="hidden" name="id" value="<?= $buku['id'] ?>" />
                  <input type="hidden" name="foto_lama" value="<?= $buku['foto'] ?>" />
                  <!-- gambar dan id -->

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="judul" value="<?= $buku['judul'] ?>" />
                    <label for="floatingInput">judul buku</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama_penulis" value="<?= $buku['nama_penulis'] ?>" />
                    <label for="floatingInput">nama penulis</label>
                  </div>

                  <div class="col-mb-12 mb-3">
                    <label for="formFile" class="form-label">Masukan cover buku</label>
                    <input class="form-control" type="file" id="formFile" name="foto" />
                  </div>

                  <button class="btn btn-warning"><a href="../adminPages/dataBuku.php" style="text-decoration: none; color: white">kembali</a></button>

                  <button type="reset" class="btn btn-danger">reset</button>

                  <button type="submit" name="submit" class="btn btn-primary">submit</button>
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

