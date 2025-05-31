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
}
?>

<h2>Edit Pelanggan</h2>
<form method="POST">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= $data['NamaPelanggan'] ?>" required><br>
    
    <label>Alamat</label>
    <textarea name="alamat" required><?= $data['Alamat'] ?></textarea><br>
    
    <label>Nomor Telepon</label>
    <input type="text" name="telepon" value="<?= $data['NomorTelepon'] ?>" required><br>
    
    <button type="submit" name="submit">Simpan</button>
    <a href="list.php">Kembali</a>
</form>
