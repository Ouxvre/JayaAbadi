<?php
include ('../../config/koneksi.php');
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Pelanggan</h2>
        <a href="../pelanggan/add.php" class="btn btn-primary">+ Tambah Pelanggan</a> <!-- nanti arahkan ke add.php -->
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM pelanggan";
            $result = mysqli_query($conn, $sql);
            $no = 1;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['NamaPelanggan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Alamat']) . "</td>";
                echo "<td>" . htmlspecialchars($row['NomorTelepon']) . "</td>";
                echo "<td>
                        <a href='edit.php?id={$row['PelangganID']}' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='delete.php?id={$row['PelangganID']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin hapus?')\">Hapus</a>
                    </td>";
                echo "</tr>";

                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include('../../includes/footer.php'); ?>
