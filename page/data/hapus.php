<?php

$id = $_GET['id'];
$sql = $koneksi->query("DELETE FROM datacovid WHERE id = '$id'");

if ($sql) {
?>
    <script>
        alert("Data Telah Berhasil Dihapus !");
        window.location.href = "?page=data";
    </script>
<?php
}
