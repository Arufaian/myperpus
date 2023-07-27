<?php 
  require '../config/functions.php';
session_start();
if (!isset($_SESSION["id"])) {
    header("Location:../loginpages/loginAdmin.php");
}

$Sid = $_SESSION['id'];
$data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE id = $Sid");
$baris = mysqli_fetch_assoc($data_admin);


  $peminjam = query("SELECT * FROM pinjam");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data peminjaman</title>
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
            <a href="admin.php"> <i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
          </li>
          <li>
            <a href="dataAdmin.php"><i class="bi bi-person"></i><span>Data admin</span></a>
          </li>
          <li>
            <a href="dataAnggota.php"> <i class="bi bi-people"></i> <span>Data anggota</span></a>
          </li>
          <li>
            <a href="dataBuku.php"><i class="bi bi-bookshelf"></i><span>Data buku</span></a>
          </li>
          <li>
            <a href="#" class="active"><i class="bi bi-journal-arrow-up"></i><span>Data peminjaman</span></a>
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
          Data peminjaman
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
        <div class="recent-grid">
          <div class="projects">
            <div class="crd">
              <div class="crd-head">
                <h2>List peminjam</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
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
                        <td>aksi</td>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach($peminjam as $row) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $row['id_peminjam'] ?></td>
                        <td><?= $row['id_buku'] ?></td>
                        <td><?= $row['nama_peminjam'] ?></td>
                        <td><?= $row['tp'] ?></td>
                        <td><?= $row['tk'] ?></td>
                        <td>
                          <div class="action">
                            <button>
                              <a href="../config/editBuku.php?id_buku=<?= $row['id_buku'] ?>"><i class="bi bi-pencil"></i></a>
                            </button>
                            <button onclick="return confirm('Apakah anda ingin menghapus data peminjaman?');">
                              <a href="../config/hapusPeminjaman.php?id_buku=<?= $row['id_buku'] ?>"><i class="bi bi-trash"></i></a>
                            </button>
                          </div>
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
    <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="post" action="" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="judul" />
                <label for="floatingInput">judul buku</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama_penulis" />
                <label for="floatingInput">nama penulis</label>
              </div>

              <div class="col-mb-12 mb-3">
                <label for="formFile" class="form-label">Masukan cover buku</label>
                <input class="form-control" type="file" id="formFile" name="foto" required />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

              <button type="submit" name="submit" class="btn btn-primary">submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>
