<?php
include 'koneksi.php';

$kode_barang = $_GET['kode_barang'];
$query = "DELETE FROM Barang WHERE kode_barang='$kode_barang'";
mysqli_query($conn, $query);

header('Location: index.php');
?>
