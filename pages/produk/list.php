<?php
include '../../config/koneksi.php';
include('../../includes/header.php');
include('../../includes/navbar.php');

$query = mysqli_query($conn, "SELECT * FROM produk");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Data Produk</h2>
    <a href="add.php" class="btn btn-primary mb-3">Tambah Produk</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $row['ProdukID'] ?></td>
                <td><?= $row['NamaProduk'] ?></td>
                <td>Rp<?= number_format($row['Harga'], 0, ',', '.') ?></td>
                <td><?= $row['Stok'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['ProdukID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['ProdukID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="../../index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>

<?php include('../../includes/footer.php'); ?>
</body>
</html>
