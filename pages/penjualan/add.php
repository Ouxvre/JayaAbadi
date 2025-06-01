<?php
include '../../config/koneksi.php';
include '../../includes/header.php';
include('../../includes/navbar.php');

// Ambil data pelanggan & produk untuk dropdown
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
$produk = mysqli_query($conn, "SELECT * FROM produk");

if (isset($_POST['submit'])) {
    $tanggal = $_POST['tanggal'];
    $pelangganID = $_POST['pelanggan'];
    $produkIDs = $_POST['produk'];
    $jumlahs = $_POST['jumlah'];

    $total = 0;
    $detail = [];

    foreach ($produkIDs as $index => $produkID) {
        $jumlah = $jumlahs[$index];

        // Ambil harga produk
        $result = mysqli_query($conn, "SELECT Harga FROM produk WHERE ProdukID = $produkID");
        $data = mysqli_fetch_assoc($result);
        $harga = $data['Harga'];

        $subtotal = $harga * $jumlah;
        $total += $subtotal;

        $detail[] = [
            'produkID' => $produkID,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal
        ];
    }

    // Simpan ke tabel penjualan
    mysqli_query($conn, "INSERT INTO penjualan (Tanggal, PelangganID, Total) 
                         VALUES ('$tanggal', '$pelangganID', '$total')");
    $penjualanID = mysqli_insert_id($conn);

    // Simpan ke detail_penjualan
    foreach ($detail as $d) {
        mysqli_query($conn, "INSERT INTO detail_penjualan (PenjualanID, ProdukID, Jumlah, Subtotal)
                             VALUES ($penjualanID, {$d['produkID']}, {$d['jumlah']}, {$d['subtotal']})");

        // Kurangi stok produk
        mysqli_query($conn, "UPDATE produk SET Stok = Stok - {$d['jumlah']} WHERE ProdukID = {$d['produkID']}");
    }

    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script>
        function addRow() {
            const row = document.querySelector('.produk-row').cloneNode(true);
            document.getElementById('produk-container').appendChild(row);
        }
    </script>
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Penjualan</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Pelanggan</label>
            <select name="pelanggan" class="form-control" required>
                <option value="">Pilih Pelanggan</option>
                <?php while ($p = mysqli_fetch_assoc($pelanggan)) : ?>
                    <option value="<?= $p['PelangganID'] ?>"><?= $p['NamaPelanggan'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div id="produk-container">
            <div class="row produk-row mb-2">
                <div class="col-md-6">
                    <select name="produk[]" class="form-control" required>
                        <option value="">Pilih Produk</option>
                        <?php
                        mysqli_data_seek($produk, 0); // reset pointer
                        while ($pr = mysqli_fetch_assoc($produk)) :
                        ?>
                            <option value="<?= $pr['ProdukID'] ?>"><?= $pr['NamaProduk'] ?> - Rp<?= number_format($pr['Harga']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-secondary w-100" onclick="addRow()">+</button>
                </div>
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary mt-3">Simpan Penjualan</button>
        <a href="list.php" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
</body>
</html>
<?php include('../../includes/footer.php'); ?>