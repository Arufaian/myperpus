<?php 

require '../config/functions.php';

$id_buku = $_GET["id_buku"];


if (deletePeminjam($id_buku) > 0) {

    $status = "tersedia";
    $update_query = "UPDATE buku SET status = '$status' WHERE id_buku = '$id_buku'";
    $update_result = mysqli_query($conn, $update_query);

    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = '../adminPages/dataPeminjaman.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = '../adminPages/dataPeminjaman.php';
        </script>";
}


?>
