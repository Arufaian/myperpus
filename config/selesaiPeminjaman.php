<?php 

require '../config/functions.php';

$id_buku = $_GET["id_buku"];
$status = query("SELECT status FROM buku WHERE id_buku = '$id_buku'");
$status_buku = $status[0]['status'];

    if ($status_buku == "dikembalikan") {
    
    if (deletePeminjam($id_buku) > 0) {
        
        
        $status = "tersedia";
        $update_query = "UPDATE buku SET status = '$status' WHERE id_buku = '$id_buku'";
        $update_result = mysqli_query($conn, $update_query);
        
        echo "<script>
        alert('Peminjaman selesai');
        document.location.href = '../adminPages/dataPengembalian.php';
        </script>";
    } else {
        echo "<script>
        alert('Proses pengembalian gagal');
        document.location.href = '../adminPages/dataPengembalian.php';
        </script>";
    }
    
    } else {

        echo "<script>
        alert('Buku belum dikembalikan');
        document.location.href = '../adminPages/dataPengembalian.php';
        </script>";
    }

?>
