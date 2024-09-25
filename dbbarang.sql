CREATE TABLE Barang (
    kode_barang VARCHAR(50) PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    harga int(10) NOT NULL,
    image VARCHAR(255),
    keterangan TEXT
);
INSERT INTO Barang (kode_barang, nama_barang, harga, image, keterangan) 
VALUES 
('B001', 'Tas', 150000, 'tas.jpg', 'Tas yang bagus dan cocok untuk anak sekolah'),
('B002', 'Laptop', 15000000, 'Laptop.jpg', 'Laptop Bagus untuk kuliah');



