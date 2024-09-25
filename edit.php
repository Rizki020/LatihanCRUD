<?php
include 'koneksi.php';

$kode_barang = $_GET['kode_barang'];
$query = "SELECT * FROM Barang WHERE kode_barang='$kode_barang'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];

    // Cek apakah ada gambar baru
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "image/" . basename($image);
        
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $error_message = 'Gagal mengupload gambar.';
        }
    } else {
        $image = $row['image']; // Gunakan gambar lama jika tidak ada gambar baru
    }

    // Query update
    $update_query = "UPDATE Barang SET nama_barang='$nama_barang', harga='$harga', image='$image', keterangan='$keterangan' WHERE kode_barang='$kode_barang'";
    if (mysqli_query($conn, $update_query)) {
        header('Location: index.php');
        exit();
    } else {
        $error_message = 'Gagal memperbarui barang: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Edit Barang</h1>

<?php if ($error_message): ?>
    <script>
        alert("<?php echo $error_message; ?>");
    </script>
<?php endif; ?>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Nama Barang:</label>
    <input type="text" name="nama_barang" value="<?php echo htmlspecialchars($row['nama_barang']); ?>" required><br>
    
    <label>Harga:</label>
    <input type="number" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required><br>
    
    <label>Image:</label>
    <input type="file" name="image"><br>
    <img src="image/<?php echo htmlspecialchars($row['image']); ?>" width="100"><br>
    
    <label>Keterangan:</label>
    <textarea name="keterangan" required><?php echo htmlspecialchars($row['keterangan']); ?></textarea><br>
    
    <input type="submit" value="Update Barang">
</form>

</body>
</html>
