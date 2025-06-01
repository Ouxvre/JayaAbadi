<?php
include '../../config/koneksi.php';

$id = $_GET['id'] ?? 0;

mysqli_query($conn, "DELETE FROM produk WHERE ProdukID = $id");

header("Location: list.php");
exit;
