<?php 

require '../config/functions.php';
session_start();
if (isset($_SESSION["id"])) {
    header("Location:../adminPages/admin.php");
}


if (isset($_POST["login"])) {
    
    $email = $_POST["email_admin"];
    $password = $_POST["pw_admin"];

    $result =  mysqli_query($conn, "SELECT * FROM admins WHERE email_admin = '$email' AND pw_admin = '$password'");

    // cek apakah admin ada
    if (mysqli_num_rows($result) === 1) {
        
        // cek password
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['pw_admin']) {

        $_SESSION["id"] = $row["id"];
        $_SESSION["admin_id"] = $row["id_admin"];

        echo "<script>
            alert('Anda berhasil login');
            document.location.href = '../adminPages/admin.php';
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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form registrasi</title>
    <!-- <link rel="stylesheet" href="Bootstrap/bootstrap.css"> -->
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;1,100&display=swap" rel="stylesheet">

    <style>
        .underline {
            width: 13vw;
        }
    </style>
</head>

    <div class="container">
        <div class="cardContent">
            <div class="cardTitle">
                <h2>LOGIN ADMIN</h2>
                <div class="underline"></div>
            </div>

            <form action="" method="post" class="form">
            <label for="username" class="label1">email</label>
            <input type="email" name="email_admin" class="form-content" id="username" autocomplete="on" required>
            <div class="form-border"></div>

            <label for="password" class="label2">Password</label>
            <input type="password" name="pw_admin" class="form-content" id="password">
            <div class="form-border"></div>

            <button type="submit" name="login">Login</button>
            <a href="loginAnggota.php">Login sebagai anggota?</a>
        </form>
        </div>

    </div>
</body>
</html>