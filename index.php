<?php
include 'koneksi.php'; // koneksi ke database

$query = "SELECT * FROM Barang";
$result = mysqli_query($conn, $query);

// Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <h1>Data Barang</h1>
    <!-- Kontainer untuk tabel -->
    <div class="table-container">
        <a href="create.php" class="button">
            <i class="fas fa-plus"></i></a>
        <table>
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Image</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['kode_barang']; ?></td>
                            <td><?php echo $row['nama_barang']; ?></td>
                            <td><?php echo 'Rp.' . number_format($row['harga']); ?></td>

                            <td><img src="image/<?php echo $row['image']; ?>" width="100" /></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td>
                                <a href="edit.php?kode_barang=<?php echo $row['kode_barang']; ?>" title="Edit"><i
                                        class="fas fa-edit"></i></a> |
                                <a href="delete.php?kode_barang=<?php echo $row['kode_barang']; ?>"
                                    onclick="return confirm('Yakin ingin menghapus? Baris yang dihapus tidak bisa dikembalikan lagi!')" title="Delete"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">Tidak ada data barang. Klik '+' untuk menambahkan data yang baru</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>