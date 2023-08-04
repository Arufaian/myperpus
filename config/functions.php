<?php 

$conn = mysqli_connect("localhost", "root", "", "mypus");

    if (!$conn) {
    die("gagal terhubung dengan database: " . mysqli_connect_error());
    }

    function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
    }


    function tambahAdmin($data){
    global $conn;

    $cekIdUser = "SELECT * FROM admins ORDER BY id DESC LIMIT 1";
    $cekHasil = mysqli_query($conn, $cekIdUser);
    if (mysqli_num_rows($cekHasil) > 0) {

        // ADMIN_id
        $row = mysqli_fetch_assoc($cekHasil);
        $id_admin = htmlspecialchars($row["id_admin"]);
        $get_numbers = str_replace("ADM", "", $id_admin);
        $id_increase = $get_numbers + 1;
        $get_string = str_pad($id_increase, 4,0, STR_PAD_LEFT); 
        $id = "ADM" . $get_string;
        // akhir ADMIN id

        $nama_admin = htmlspecialchars($data["nama_admin"]);
        $email_admin = htmlspecialchars($data["email_admin"]);
        $pw_admin = htmlspecialchars($data["pw_admin"]);

      
        

        // UPLOAD GAMBAR
        $foto = upload();
        if (!$foto) {
            return false;
        }


        $query = "INSERT INTO admins VALUES ('', '$id', '$nama_admin', ' $email_admin', '$pw_admin', '$foto')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
            

    } else {
        $id = "ADM0001";
        $nama_admin = htmlspecialchars($data["nama_admin"]);
        $email_admin = htmlspecialchars($data["email_admin"]);
        $pw_admin = htmlspecialchars($data["pw_admin"]);
        
        // UPLOAD GAMBAR
        $foto = upload();
        if (!$foto) {
            return false;
        }


        $query = "INSERT INTO admins VALUES ('', '$id', '$nama_admin', ' $email_admin', '$pw_admin', '$foto')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
        
    }
    
    function tambahAnggota($data){
    global $conn;

    $cekIdUser = "SELECT * FROM anggota ORDER BY id DESC LIMIT 1";
    $cekHasil = mysqli_query($conn, $cekIdUser);
    if (mysqli_num_rows($cekHasil) > 0) {

        // anggoat_id
        $row = mysqli_fetch_assoc($cekHasil);
        $id_anggota = htmlspecialchars($row["id_anggota"]);
        $get_numbers = str_replace("AG", "", $id_anggota);
        $id_increase = $get_numbers + 1;
        $get_string = str_pad($id_increase, 5,0, STR_PAD_LEFT); 
        $id = "AG" . $get_string;
        // akhir anggota id

        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $password = htmlspecialchars($data["password"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $jk = htmlspecialchars($data["jk"]);

      
        

        // UPLOAD GAMBAR
        $foto = upload();
        if (!$foto) {
            return false;
        }


        $query = "INSERT INTO anggota VALUES ('', '$id', '$nama', ' $jk', '$foto', '$alamat', '$email', '$password')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
            

    } else {
        $id = "AG00001";
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $password = htmlspecialchars($data["password"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $jk = htmlspecialchars($data["jk"]);
        
        // UPLOAD GAMBAR
        $foto = upload();
        if (!$foto) {
            return false;
        }


        $query = "INSERT INTO anggota VALUES ('', '$id', '$nama', ' $jk', '$foto', '$alamat', '$email', '$password')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
        
    }
    
    
    function tambahBuku($data){
    global $conn;

    $cekIdbuku = "SELECT * FROM buku ORDER BY id DESC LIMIT 1";
    $cekHasil = mysqli_query($conn, $cekIdbuku);
    if (mysqli_num_rows($cekHasil) > 0) {

        // id buku
        $row = mysqli_fetch_assoc($cekHasil);
        $id_buku = htmlspecialchars($row["id_buku"]);
        $get_numbers = str_replace("BK", "", $id_buku);
        $id_increase = $get_numbers + 1;
        $get_string = str_pad($id_increase, 5,0, STR_PAD_LEFT); 
        $id = "BK" . $get_string;
        // akhir id buku

        $judul = htmlspecialchars($data["judul"]);
        $nama_penulis = htmlspecialchars($data["nama_penulis"]);
        $status = "tersedia";

      
        

        // UPLOAD GAMBAR
        $foto = upload();
        if (!$foto) {
            return false;
        }


        $query = "INSERT INTO buku VALUES ('', '$id', '$judul', '$foto', '$nama_penulis', '$status')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
            

    } else {
        $id = "BK00001";
        $judul = htmlspecialchars($data["judul"]);
        $nama_penulis = htmlspecialchars($data["nama_penulis"]);
        $status = "tersedia";


        // UPLOAD GAMBAR
        $foto = upload();
        if (!$foto) {
            return false;
        }


        $query = "INSERT INTO buku VALUES ('', '$id', '$judul', '$foto', '$nama_penulis', '$status')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
        
    }



    // tambah data buku



    // upload gambar admin
    function upload(){
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek apakah gambar ada?
    if ($error === 4) {
        echo "<script>
                    alert('Silahkan upload gambar terlebih dahulu');
                </script>";

                return false;

    }

    // validasi ekstemsi file
    $validEks = ['jpg', 'jpeg', 'png'];
    $eksPict =  explode(".", $namaFile);
    $eksPict = strtolower(end($validEks));
    
    if (!in_array($eksPict, $validEks)) {
            echo "<script>
                    alert('File bukan gambar!!!');
                </script>";

                return false;
    }

    // menetapkan ukuran sebuah gambar
    if ($ukuranFile > 2097152) {
                echo "<script>
                    alert('Ukuran file terlalu besar');
                </script>";

                return false;
    }

    // generate nama baru
    $newName = uniqid();
    $newName .= '.';
    $newName .= $eksPict;


    move_uploaded_file($tmpName, "../adminPages/img/" . $newName);
    return $newName;

    }

    


    // delete admin
    function delete($id_admin){
    global $conn;
    mysqli_query($conn, "DELETE FROM admins WHERE id_admin = '$id_admin'");

    return mysqli_affected_rows($conn);
    }

    // delete buku
    function deleteBuku($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM buku WHERE id = $id");

    return mysqli_affected_rows($conn);
    }

    // delete anggota
    function deleteAnggota($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM anggota WHERE id = $id");

    return mysqli_affected_rows($conn);
    }

    // delete anggota
    function deletePeminjam($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM pinjam WHERE id_buku = '$id'");

    return mysqli_affected_rows($conn);
    }


    // update admin
    function update($data) {

        global $conn;
        $id = $data["id"];
        $nama_admin = htmlspecialchars($data["nama_admin"]);
        $email_admin = htmlspecialchars($data["email_admin"]);
        $pw_admin = htmlspecialchars($data["pw_admin"]);
        $foto_lama = $data["foto_lama"];

        // cek apakah user upload gambar baru atau tidak
        if ($_FILES['foto']['error'] === 4) {
            $foto = $foto_lama;
        } else {
            $foto = upload();
        }

        $query = "UPDATE admins SET 
        nama_admin = '$nama_admin', email_admin = '$email_admin', pw_admin = '$pw_admin', foto = '$foto' where id = $id";

        mysqli_query($conn, $query);

        
        return mysqli_affected_rows($conn);
    }

    // update admin
    function updateAnggota($data) {

        global $conn;
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $password = htmlspecialchars($data["password"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $jk = htmlspecialchars($data["jk"]);
        $foto_lama = $data["foto_lama"];

        // cek apakah user upload gambar baru atau tidak
        if ($_FILES['foto']['error'] === 4) {
            $foto = $foto_lama;
        } else {
            $foto = upload();
        }

        $query = "UPDATE anggota SET 
        nama = '$nama', email = '$email', password = '$password', alamat = '$alamat', jk  = '$jk', foto = '$foto' where id = $id";

        mysqli_query($conn, $query);

        
        return mysqli_affected_rows($conn);
    }


    // update buku
    function updateBuku($data) {

        global $conn;
        $id = $data["id"];
        $judul = htmlspecialchars($data["judul"]);
        $nama_penulis = htmlspecialchars($data["nama_penulis"]);
        $foto_lama = $data["foto_lama"];

        // cek apakah user upload gambar baru atau tidak
        if ($_FILES['foto']['error'] === 4) {
            $foto = $foto_lama;
        } else {
            $foto = upload();
        }

        $query = "UPDATE buku SET 
        judul = '$judul', nama_penulis = '$nama_penulis', foto = '$foto' where id = $id";

        mysqli_query($conn, $query);

        
        return mysqli_affected_rows($conn);
    }


    function kembalikanBuku($data) {

        global $conn;
        $id = $data["id"];
        // $nama_peminjam = $_POST['nama_peminjam'];
        // $id_peminjam = $data['id_peminjam'];
        $id_buku = $data['id_buku'];
        // $tp = $data['tp'];
        $tk = $data['tk'];
        $status = "dikembalikan";

        $query = "SELECT status FROM pinjam where id_buku = '$id_buku'";
        $status_result = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($status_result);

        if ($result['status'] == "dipinjam") {
            $query = "UPDATE pinjam SET tk = '$tk', status = '$status' where id_buku = '$id_buku'";
            $update_query = "UPDATE buku SET status = '$status' WHERE id_buku = '$id_buku'";
            mysqli_query($conn, $query);
            mysqli_query($conn, $update_query);
            return mysqli_affected_rows($conn);
        } else {
            echo "<script>
                    alert('buku sudah dikembalikan');
                    document.location.href = '../memberPages/Pengembalian.php';
                </script>";
        }



    }



?>
