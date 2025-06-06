<?php
include '../../config/koneksi.php';

if (isset($_GET['id'])) {
    $penjualanID = $_GET['id'];

    // Ambil data detail penjualan untuk mengembalikan stok
    $queryDetail = mysqli_query($conn, "SELECT * FROM detail_penjualan WHERE PenjualanID = $penjualanID");
    while ($detail = mysqli_fetch_assoc($queryDetail)) {
        $produkID = $detail['ProdukID'];
        $jumlah = $detail['Jumlah'];

        // Kembalikan stok produk
        mysqli_query($conn, "UPDATE produk SET Stok = Stok + $jumlah WHERE ProdukID = $produkID");
    }

    // Hapus data dari detail_penjualan
    mysqli_query($conn, "DELETE FROM detail_penjualan WHERE PenjualanID = $penjualanID");

    // Hapus data dari penjualan
    mysqli_query($conn, "DELETE FROM penjualan WHERE PenjualanID = $penjualanID");

    // Redirect
    header("Location: list.php");
    exit;
} else {
    echo "ID tidak ditemukan.";
}
?>
