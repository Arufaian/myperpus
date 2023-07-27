<?php 
  require '../config/functions.php';
  session_start();
  if (!isset($_SESSION["id"])) {
    header("Location:../loginpages/loginAdmin.php");
  }
  // ambil data lewat url
  $id = $_GET["id"];

  // query data berdasarkan id
  $anggota = query("SELECT * FROM anggota WHERE id = $id")[0];
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
    <link rel="stylesheet" href="../css/admin_st.css" />

    <style>
      .ehe {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
      }

      .kartu-anggota {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 300px;
      }

      .nama {
        text-align: center;
        margin-top: 0;
        margin-bottom: 5px;
      }

      .role {
        text-align: center;
        margin: 0;
        color: #888;
      }

      .foto {
        display: block;
        margin: 0 auto;
        width: 125px;
        height: 125px;
        border-radius: 50%;
        object-fit: cover;
      }

      .kontak {
        margin-top: 10px;
        text-align: center;
        color: #444;
      }

      .kontak p {
        margin: 5px;
      }

      @media print {
        .ehe {
          border: 1px solid red;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100vw;
          height: 100vh;
        }

        .kartu-anggota {
          border: 1px solid #ccc;
          padding: 20px;
          border-radius: 5px;
          background-color: #fff;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
          width: 300px;
        }

        .nama {
          text-align: center;
          margin-top: 0;
          margin-bottom: 5px;
        }

        .role {
          text-align: center;
          margin: 0;
          color: #888;
        }

        .foto {
          display: block;
          margin: 0 auto;
          width: 125px;
          height: 125px;
          border-radius: 50%;
          object-fit: cover;
        }

        .kontak {
          margin-top: 10px;
          text-align: center;
          color: #444;
        }

        .kontak p {
          margin: 5px;
        }
      }
    </style>
  </head>
  <body>
    <div class="ehe">
      <div class="main">
        <div class="kartu-anggota">
          <h2 class="nama"><?= $anggota['nama'] ?></h2>
          <p class="role">Anggota</p>
          <img class="foto" src="./img/<?= $anggota['foto'] ?>" alt="Foto Anggota" />
          <div class="kontak">
            <p>Email: <?= $anggota['email'] ?></p>
            <p>ID Anggota: <?= $anggota['id_anggota'] ?></p>
          </div>
        </div>
      </div>
    </div>
    <script src="../Bootstrap/bootstrap.bundle.js"></script>
    <script>
      window.print();
    </script>
  </body>
</html>
