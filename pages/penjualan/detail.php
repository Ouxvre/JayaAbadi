<?php
include '../../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data penjualan
$query_penjualan = mysqli_query($conn, "SELECT p.PenjualanID, p.Tanggal, pl.NamaPelanggan, p.Total
    FROM penjualan p
    JOIN pelanggan pl ON p.PelangganID = pl.PelangganID
    WHERE p.PenjualanID = $id");
$data_penjualan = mysqli_fetch_assoc($query_penjualan);

// Ambil detail produk
$query_detail = mysqli_query($conn, "SELECT dp.*, pr.NamaProduk, pr.Harga 
    FROM detail_penjualan dp
    JOIN produk pr ON dp.ProdukID = pr.ProdukID
    WHERE dp.PenjualanID = $id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Detail Penjualan</h2>
    <hr>

    <h5>Informasi Umum</h5>
    <p><strong>ID Penjualan:</strong> <?= $data_penjualan['PenjualanID'] ?></p>
    <p><strong>Tanggal:</strong> <?= $data_penjualan['Tanggal'] ?></p>
    <p><strong>Pelanggan:</strong> <?= $data_penjualan['NamaPelanggan'] ?></p>
    <p><strong>Total:</strong> Rp<?= number_format($data_penjualan['Total'], 0, ',', '.') ?></p>

    <h5 class="mt-4">Detail Produk</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($query_detail)) { ?>
            <tr>
                <td><?= $row['NamaProduk'] ?></td>
                <td>Rp<?= number_format($row['Harga'], 0, ',', '.') ?></td>
                <td><?= $row['Jumlah'] ?></td>
                <td>Rp<?= number_format($row['Subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="list.php" class="btn btn-secondary">Kembali</a>
</body>
</html>
