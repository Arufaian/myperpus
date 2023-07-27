<?php 
  require '../config/functions.php';
  session_start();

  if (isset($_SESSION["key"])) {
    header("Location:../memberPages/anggota.php");
  }




  if (isset($_POST["login"])) {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result =  mysqli_query($conn, "SELECT * FROM anggota WHERE email = '$email' AND password = '$password'");


    // cek apakah admin ada
    if (mysqli_num_rows($result) === 1) {
        
        // cek password
        $row = mysqli_fetch_assoc($result);
        $_SESSION["key"] = $row["id"];
        $_SESSION["id_anggota"] = $row["id_anggota"];
        if ($password === $row['password']) {



        echo "<script>
            alert('Anda berhasil login');
            document.location.href = '../memberPages/anggota.php';
        </script>";
            // header("Location: ../adminPages/admin.php");
            exit;
        }
    }

    $error = true;
    if (isset($error)) {
            echo "<script>
            alert('Username/password salah!!!');
        </script>";
    }
}


?>

<link rel="stylesheet" href="">





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form registrasi</title>
    <!-- <link rel="stylesheet" href="Bootstrap/bootstrap.css"> -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../Bootstrap/bootstrap.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;1,100&display=swap" rel="stylesheet" />
  </head>
  <body>
    <div class="wrapper">
      <div class="container p-3" id="con">
        <div class="cardContent">
          <div class="cardTitle">
            <h2>LOGIN ANGGOTA</h2>
            <div class="underline"></div>
          </div>

          <form action="" method="post" class="form">
            <div class="form-floating mb-4">
              <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" />
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
              <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" />
              <label for="floatingPassword">Password</label>
            </div>

            <div class="d-grid">
              <button class="btn btn-primary my-4 p-3" type="submit" name="login" style="background-image: linear-gradient(to left, #b993d6, #8ca6db); border: none">Login</button>
            </div>
          </form>
          <div class="row">
            <a class="col-6 mb-3" href="register.php">Tidak punya akun?</a>
            <a class="col-8" href="loginAdmin.php">Login sebagi admin?</a>
          </div>
        </div>
      </div>
    </div>

    <script src="../Bootstrap/bootstrap.bundle.js"></script>
  </body>
</html>


