<?php 
require '../config/functions.php';
session_start();
if (!isset($_SESSION["id"])) {
    header("Location:../loginpages/loginAdmin.php");
}

$Sid = $_SESSION['id'];
$data_admin = mysqli_query($conn, "SELECT * FROM admins WHERE id = $Sid");
$baris = mysqli_fetch_assoc($data_admin);


    if (isset($_POST["submit"])) {
        // cek apakah data berhasil ditambahkan
        if (tambahAdmin($_POST) > 0) {
            echo "<script>
                    alert('Data berhasil ditambahkan');
                    document.location.href = './dataAdmin.php';
                </script>";
        } else {
            echo "<script>
                    alert('Data gagal ditambahkan');
                    document.location.href = './dataAdmin.php';
                </script>";
        }
        
    }

    $admin = query("SELECT * FROM admins");




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data admin</title>
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/dataAdmin.css" />

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
            <a href="#" class="active"> <i class="bi bi-person"></i> <span>Data admin</span></a>
          </li>
          <li>
            <a href="dataAnggota.php"> <i class="bi bi-people"></i> <span>Data anggota</span></a>
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
          Data admin
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
                <h2>List admin</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- form  tambah data user-->
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                          <div class="col-md-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama_admin" required />
                          </div>
                          <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email_admin" required />
                          </div>
                          <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" name="pw_admin" required />
                          </div>
                          <div class="col-mb-12">
                            <label for="formFile" class="form-label">Masukan foto admin</label>
                            <input class="form-control" type="file" id="formFile" name="foto" required />
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
                        </div>
                      </form>
                      <!-- akhir tambah data user -->
                    </div>
                  </div>
                </div>
              </div>
              <div class="crd-body">
                <div class="table-responsive">
                  <table id="dt" class="p-3" style="width: 100%;">
                    <thead class="">
                      <tr>
                        <td>No</td>
                        <td>Id admin</td>
                        <td>Nama admin</td>
                        <td>email admin</td>
                        <td>foto admin</td>
                        <td>Opsi</td>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach($admin as $data_admin): ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $data_admin['id_admin'] ?></td>
                        <td><?= $data_admin['nama_admin'] ?></td>
                        <td><?= $data_admin['email_admin'] ?></td>
                        <td><img src="./img/<?= $data_admin['foto'] ?>" alt="" style="border-radius: 50%; width: 75px;"></td>
                        <td>
                          <div class="action">
                            <button>
                              <a href="../config/editAdmin.php?id=<?= $data_admin['id'] ?>"><i class="bi bi-pencil"></i></a>
                            </button>
                            <button>
                              <a href="../config/hapusAdmin.php?id_admin=<?= $data_admin['id_admin'] ?>" onclick="return confirm('apakah anda ingin menghapus data?');"> <i class="bi bi-trash"></i></a>
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
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>


