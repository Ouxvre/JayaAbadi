<?php
include '../../config/koneksi.php';
include '../../includes/header.php';
include('../../includes/navbar.php');

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE ProdukID = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $update = mysqli_query($conn, "UPDATE produk SET 
        NamaProduk = '$nama',
        Harga = '$harga',
        Stok = '$stok'
        WHERE ProdukID = $id");

    if ($update) {
        header("Location: list.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Produk</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['NamaProduk']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $data['Harga'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= $data['Stok'] ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="list.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
<?php include('../../includes/footer.php'); ?>