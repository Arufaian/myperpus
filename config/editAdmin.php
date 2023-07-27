<?php 

    require 'functions.php';
    session_start();
    $Sid = $_SESSION['id'];
    $data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE id = $Sid");
    $baris = mysqli_fetch_assoc($data_admin);

    // ambil data lewat url
    $id = $_GET["id"];

    // query data berdasarkan id
    $admin = query("SELECT * FROM admins WHERE id = $id")[0];


    if (isset($_POST["submit"])) {

        // cek apakah data berhasil diubah
        if (update($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil diubah');
                    document.location.href = '../adminPages/dataAdmin.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal diubah');
                    document.location.href = '../adminPages/dataAdmin.php';
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
    <title>Edit admin</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/dataAdmin.css" />
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
            <a href="../adminPages/dataAdmin.php" class="active"> <i class="bi bi-person"></i> <span>Data admin</span></a>
          </li>
          <li>
            <a href="../adminPages/dataAnggota.php"> <i class="bi bi-people"></i> <span>Data anggota</span></a>
          </li>
          <li>
            <a href="../adminPages/dataBuku.php"><i class="bi bi-bookshelf"></i><span>Data buku</span></a>
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
          Data admin
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
                <h2>Ubah admin</h2>
              </div>
              <div class="crd-body">
                <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                  <input type="hidden" name="id" value="<?= $admin["id"] ?>"> <input type="hidden" name="foto_lama" value="<?= $admin["foto"] ?>">
                  <div class="col-md-12">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama_admin" required value="<?= $admin['nama_admin'] ?>" />
                  </div>
                  <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email_admin" required value="<?= $admin['email_admin'] ?>" />
                  </div>
                  <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="pw_admin" value="<?= $admin['pw_admin'] ?>" />
                  </div>
                  <div class="col-mb-12">
                    <label for="formFile" class="form-label">Masukan foto admin</label>
                    <input class="form-control" type="file" id="formFile" name="foto" />
                  </div>
                  <div class="col-mb-4 pt-3">
                    <button class="btn btn-warning"><a href="../adminPages/dataAdmin.php" style="text-decoration: none; color: white">kembali</a></button>
                    <button type="reset" class="btn btn-danger">reset</button>
                    <button type="submit" name="submit" class="btn btn-primary">submit</button>
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
