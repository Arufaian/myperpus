<?php 

require '../config/functions.php';

$id = $_GET["id"];

if (deleteAnggota($id) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = '../adminPages/dataAnggota.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = '../adminPages/dataAnggota.php';
        </script>";
}




?>
