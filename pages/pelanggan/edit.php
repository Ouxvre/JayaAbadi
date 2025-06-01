<?php
include '../../config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE PelangganID = $id");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    mysqli_query($conn, "UPDATE pelanggan SET 
        NamaPelanggan = '$nama', 
        Alamat = '$alamat', 
        NomorTelepon = '$telepon' 
        WHERE PelangganID = $id");

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Pelanggan</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['NamaPelanggan']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['Alamat']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($data['NomorTelepon']) ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="list.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
