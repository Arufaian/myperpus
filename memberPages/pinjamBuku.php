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
        $nama_peminjam = $_POST['nama_peminjam'];
        $id_peminjam = $_POST['id_peminjam'];
        $id_buku = $_POST['id_buku'];
        $tp = $_POST['tp'];
        // $tk = $_POST['tk'];
        $tk = "-";


        $status_query = "SELECT status FROM buku WHERE id_buku = '$id_buku'";
        $status_result = mysqli_query($conn, $status_query);
        if ($status_result) {

          $row = mysqli_fetch_assoc($status_result);
          $status_buku = $row['status'];

          if ($status_buku == 'tersedia') {
            // Status buku Tersedia, lanjutkan proses peminjaman
            // Kueri untuk menyimpan data peminjaman
            $query = "INSERT INTO pinjam VALUES ('', '$id_peminjam', '$id_buku', ' $nama_peminjam', '$tp', '$tk')";
            $result = mysqli_query($conn, $query);
            $status = "dipinjam";

            if ($result) {
                // Perbarui status buku menjadi "Disewa"
                $update_query = "UPDATE buku SET status = '$status' WHERE id_buku = '$id_buku'";
                $update_result = mysqli_query($conn, $update_query);
                echo "<script>
                    alert('buku berhasil dipinjam');
                    document.location.href = './pinjamBuku.php';
                </script>";


              
            } else {

              echo "<script>
                    alert('Gagal melakukan peminjaman buku');
                    document.location.href = './pinjamBuku.php';
                </script>";
              
            }

          } else {
              echo "<script>
                    alert('Buku sedang dipinjam');
                    document.location.href = './pinjamBuku.php';
                </script>";
          }

        } else {

                echo "<script>
                    alert('Buku sedang dipinjam');
                    document.location.href = './pinjamBuku.php';
                </script>";
        }
        
    }

  $id_peminjam = $baris['id_anggota'];
  $user_pinjam = query("SELECT * FROM pinjam WHERE id_peminjam = '$id_peminjam'");
  $books = query("SELECT * FROM buku");
  $tanggalHariIni = date("Y-m-d");
?>

<link rel="stylesheet" href="">

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman peminjaman</title>
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
            <a href="#" class="active"><i class="bi bi-journal-arrow-up"></i> <span>Peminjaman</span></a>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Pinjam buku</button>
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
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach($user_pinjam as $row) : ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $row['id_peminjam'] ?></td>
                        <td><?= $row['id_buku'] ?></td>
                        <td><?= $row['nama_peminjam'] ?></td>
                        <td><?= $row['tp'] ?></td>
                        <td><?= $row['tk'] ?></td>
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
                <input type="text" class="form-control" id="floatingInputDisabled" placeholder="name@example.com" name="nama_peminjam" value="<?= $baris['nama'] ?>"/>
                <label for="floatingInputDisabled">Nama peminjam</label>
              </div>

              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInputDisabled" placeholder="name@example.com" name="id_peminjam"  value="<?= $baris['id_anggota'] ?>"/>
                <label for="floatingInputDisabled">id peminjam</label>
              </div>

              <select class="form-select mb-3" name="id_buku" aria-label="Size 3 select example" required>
                <option selected>Pilih buku</option>
                <?php foreach($books as $book): ?>
                <option value="<?= $book['id_buku'] ?>"><?= $book['id_buku'] ?> (<?= $book['judul'] ?>)</option>
                <?php endforeach; ?>
              </select>

            <div class="col-mb-12 mb-3">
                <label for="formFile" class="form-label">Tanggal peminjaman</label>
                <input class="form-control" type="date" id="formFile" name="tp" required value="<?= $tanggalHariIni ?>" />
              </div>

            <div class="col-mb-12 mb-3">
                <input class="form-control" type="date" id="formFile" name="tk" hidden/>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

              <button type="submit" name="submit" class="btn btn-primary">submit</button>
            </div>
          </form>
        </div>
      </div>
    
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>
