<?php 

    require 'functions.php';
    session_start();
    $Sid = $_SESSION['id'];
    $data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE id = $Sid");
    $baris = mysqli_fetch_assoc($data_admin);


    // ambil data lewat url
    $id = $_GET["id"];

    // query data berdasarkan id
    $anggota = query("SELECT * FROM anggota WHERE id = $id")[0];


    if (isset($_POST["submit"])) {

        // cek apakah data berhasil diubah
        if (updateAnggota($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil diubah');
                    document.location.href = '../adminPages/dataAnggota.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal diubah');
                    document.location.href = '../adminPages/dataAnggota.php';
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
    <title>Edit anggota</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/dataAnggota.css" />
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
            <a href="../adminPages/dataAnggota.php" class="active"> <i class="bi bi-people"></i> <span>Data anggota</span></a>
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
          Data anggota
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
                <h2>Edit anggota</h2>
              </div>
              <div class="crd-body">
                <form method="post" action="" enctype="multipart/form-data">
                  <!-- id dan gambar lama -->
                  <input type="hidden" name="id" value="<?= $anggota['id'] ?>" />
                  <input type="hidden" name="foto_lama" value="<?= $anggota['foto'] ?>" />
                  <!-- akhir id dan gambar lama -->

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama" value="<?= $anggota['nama'] ?>" />
                    <label for="floatingInput">Nama siswa</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="alamat" value="<?= $anggota['alamat'] ?>" />
                    <label for="floatingInput">alamat</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?= $anggota['email'] ?>" />
                    <label for="floatingInput">email</label>
                  </div>

                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="password" value="<?= $anggota['password'] ?>" />
                    <label for="floatingInput">password</label>
                  </div>

                  <select class="form-select mb-3" aria-label=".form-select-lg example" name="jk">
                    <option selected value="<?= $anggota['jk'] ?>">Jenis kelamin</option>
                    <option value="pria">Pria</option>
                    <option value="wanila">Wanita</option>
                  </select>

                  <div class="col-mb-12 mb-3">
                    <label for="formFile" class="form-label">Masukan foto anggota</label>
                    <input class="form-control" type="file" id="formFile" name="foto" />
                  </div>

                  <button class="btn btn-warning"><a href="../adminPages/dataAnggota.php" style="text-decoration: none; color: white">kembali</a></button>
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

