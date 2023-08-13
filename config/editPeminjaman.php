<?php 

    require 'functions.php';
    session_start();
    $Sid = $_SESSION['id'];
    $data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE id = $Sid");
    $baris = mysqli_fetch_assoc($data_admin);


    // ambil data lewat url
    $id_buku = $_GET["id_buku"];

    // query data berdasarkan id
    $data_peminjam = query("SELECT * FROM pinjam WHERE id_buku = '$id_buku'")[0];
    
    // variabel continue
    $nama = trim($data_peminjam['nama_peminjam']);
    $memberID = $data_peminjam['id_peminjam'];
    $bukuID = $data_peminjam['id_buku'];


    


    // query data anggota
    $data_anggota = query("SELECT * FROM anggota");

    // query data buku 
    $data_buku = query("SELECT * FROM buku");

    // tanggalHariIni
    $tanggalHariIni = date('Y-m-d');





    if (isset($_POST["submit"])) {

        // cek apakah data berhasil diubah
        if (updatePeminjam($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil diubah');
                    document.location.href = '../adminPages/dataPeminjaman.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal diubah');
                    document.location.href = '../adminPages/dataPeminjaman.php';
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
    <title>Edit peminjaman</title>
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
            <a href="#"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
          </li>
          <li>
            <a href="#"> <i class="bi bi-person"></i> <span>Data admin</span></a>
          </li>
          <li>
            <a href="#"> <i class="bi bi-people"></i> <span>Data anggota</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-bookshelf"></i><span>Data buku</span></a>
          </li>
          <li>
            <a href="#" class="active"><i class="bi bi-journal-arrow-up"></i><span>Data peminjaman</span></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journal-arrow-down"></i><span>Data pengembalian</span></a>
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
          Data peminjaman
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
                <h2>EDIT PEMINJAMAN</h2>
              </div>
              <div class="crd-body">
                <form method="post" action="" enctype="multipart/form-data">

                    <div class="form-floating">
                        <select class="form-select mb-3" name="nama_peminjam" aria-label="Size 3 select example" required>
                            <option selected value="<?= $data_peminjam['nama_peminjam'] ?>"><?= $data_peminjam['nama_peminjam'] ?></option>
                            <?php foreach($data_anggota as $member): ?>
                                <?php if ($member['nama'] == $nama) {
                                    continue;
                                } ?>
                                <option value="<?= $member['nama'] ?>"><?= $member['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="floatingSelect">Nama peminjam</label>
                    </div>

                    <div class="form-floating">
                        <select class="form-select mb-3" name="id_peminjam" aria-label="Size 3 select example" required>
                            <option selected value="<?= $data_peminjam['id_peminjam'] ?>"><?= $data_peminjam['id_peminjam'] ?></option>
                            <?php foreach($data_anggota as $member): ?>
                                <?php if ($member['id_anggota'] == $memberID) {
                                    continue;
                                } ?>
                            <option value="<?= $member['id_anggota'] ?>"><?= $member['id_anggota'] ?> (<?= $member['nama'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <label for="floatingSelect">List id anggota</label>
                    </div>

                    <div class="form-floating">
                        <select class="form-select mb-3" name="id_buku" aria-label="Size 3 select example" required>
                            <option selected value="<?= $data_peminjam['id_buku'] ?>"><?= $data_peminjam['id_buku'] ?> </option>
                            <?php foreach($data_buku as $buku): ?>
                                <?php if ($buku['id_buku'] == $bukuID) {
                                    continue;
                                } ?>
                            <option value="<?= $buku['id_buku'] ?>"><?= $buku['id_buku'] ?> (<?= $buku['judul'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <label for="floatingSelect">List buku</label>
                    </div>

                    <div class="form-floating">
                        <input class="form-control" type="date" id="formFile" name="tp" required value="<?= $tanggalHariIni ?>" />
                        <label for="floatingSelect">Tanggal peminjaman</label>
                    </div>

                    <div class="col-mb-12 mb-3">
                        <input class="form-control" type="date" id="formFile" name="tk" hidden/>
                    </div>
                    </div>

                    <div class="ms-3">
                        <a class="btn btn-secondary" href="../adminPages/dataPeminjaman.php">Kembali</a>
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

