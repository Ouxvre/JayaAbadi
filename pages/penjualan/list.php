<?php
include '../../config/koneksi.php';

$query = mysqli_query($conn, "
    SELECT p.PenjualanID, p.Tanggal, pl.NamaPelanggan, p.Total
    FROM penjualan p
    JOIN pelanggan pl ON p.PelangganID = pl.PelangganID
    ORDER BY p.Tanggal DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Data Penjualan</h2>
    <a href="add.php" class="btn btn-primary mb-3">Tambah Penjualan</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $row['PenjualanID'] ?></td>
                <td><?= $row['Tanggal'] ?></td>
                <td><?= $row['NamaPelanggan'] ?></td>
                <td>Rp<?= number_format($row['Total'], 0, ',', '.') ?></td>
                <td>
                    <a href="detail.php?id=<?= $row['PenjualanID'] ?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="delete.php?id=<?= $row['PenjualanID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus penjualan ini?')">Hapus</a>

                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="../../index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>
</body>
</html>
