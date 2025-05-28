
-- Pembuatan Tabel
CREATE TABLE pelanggan (
    PelangganID INT PRIMARY KEY,
    NamaPelanggan VARCHAR(255),
    Alamat TEXT,
    NomorTelepon VARCHAR(15)
);

CREATE TABLE produk (
    ProdukID INT PRIMARY KEY,
    NamaProduk VARCHAR(255),
    Harga DECIMAL(10,2),
    Stok INT
);

CREATE TABLE penjualan (
    PenjualanID INT PRIMARY KEY,
    TanggalPenjualan DATE,
    TotalHarga DECIMAL(10,2),
    PelangganID INT,
    FOREIGN KEY (PelangganID) REFERENCES pelanggan(PelangganID)
);

CREATE TABLE detailpenjualan (
    DetailID INT PRIMARY KEY,
    PenjualanID INT,
    ProdukID INT,
    JumlahProduk INT,
    Subtotal DECIMAL(10,2),
    FOREIGN KEY (PenjualanID) REFERENCES penjualan(PenjualanID),
    FOREIGN KEY (ProdukID) REFERENCES produk(ProdukID)
);

-- Data Sample
INSERT INTO pelanggan VALUES (1, 'Andi', 'Jl. Merdeka', '08123456789');
INSERT INTO produk VALUES (101, 'Kopi Hitam', 12000, 50);
INSERT INTO penjualan VALUES (1001, '2025-05-28', 24000, 1);
INSERT INTO detailpenjualan VALUES (1, 1001, 101, 2, 24000);

-- Contoh Query
-- 1. Lihat semua transaksi
SELECT * FROM penjualan;

-- 2. Transaksi dengan nama pelanggan
SELECT p.PenjualanID, p.TanggalPenjualan, pel.NamaPelanggan
FROM penjualan p
JOIN pelanggan pel ON p.PelangganID = pel.PelangganID;

-- 3. Detail produk dalam transaksi
SELECT dp.JumlahProduk, pr.NamaProduk, dp.Subtotal
FROM detailpenjualan dp
JOIN produk pr ON dp.ProdukID = pr.ProdukID;
