<?php 

require 'functions.php';

$id = $_GET["id_admin"];

if (delete($id) > 0) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = '../adminPages/dataAdmin.php';
        </script>";
} else {
    echo "<script>
            alert('Data gagal dihapus');
            document.location.href = '../adminPages/dataAdmin.php';
        </script>";
}




?>

