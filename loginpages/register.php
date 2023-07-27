<?php

    require '../config/functions.php';

    if (isset($_POST["submit"])) {
        // cek apakah data berhasil ditambahkan
      if (tambahAnggota($_POST) > 0) {
          echo "<script>
                    alert('Anda berhasil registrasi');
                    document.location.href = './loginAnggota.php';
                </script>";
        } else {
            echo "<script>
                    alert('Anda gagal registrasi');
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
    <title>Form registrasi</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/register.css" />
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <!-- akhir bootstrap -->

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;1,100&display=swap" rel="stylesheet" />
    <!-- akhir font -->

  </head>
  <body>
    <div class="wrapper">
      <div class="container p-3" id="con">
        <div class="cardContent">
          <div class="cardTitle">
            <h2>REGISTRASI ANGGOTA</h2>
            <div class="underline"></div>
          </div>

          <form action="" method="post" class="form" enctype="multipart/form-data">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama" />
              <label for="floatingInput">Nama anggota</label>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="alamat" />
              <label for="floatingInput">alamat</label>
            </div>

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" />
              <label for="floatingInput">email</label>
            </div>

            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="password" />
              <label for="floatingInput">password</label>
            </div>

            <select class="form-select mb-3" aria-label=".form-select-lg example" name="jk">
              <option selected>Jenis kelamin</option>
              <option value="pria">Pria</option>
              <option value="wanila">Wanita</option>
            </select>

            <div class="col-mb-12 mb-3">
              <label for="formFile" class="form-label">Masukan foto anggota</label>
              <input class="form-control" type="file" id="formFile" name="foto" required />
            </div>

            <div class="d-grid">
              <button class="btn btn-primary my-4 p-3" type="submit" name="submit" style="background-image: linear-gradient(to left, #b993d6, #8ca6db); border: none">register</button>
            </div>
            <a href="loginAnggota.php">Sudah ada akun?</a>
          </form>
        </div>
      </div>
    </div>

    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>
