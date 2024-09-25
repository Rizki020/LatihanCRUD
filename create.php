<?php
include 'koneksi.php';

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];

    // Periksa apakah kode_barang sudah ada di database
    $check_query = "SELECT * FROM Barang WHERE kode_barang = '$kode_barang'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $error_message = 'Kode Barang sudah ada, silakan gunakan kode yang lain.';
    } else {
        // Upload file
        $image = $_FILES['image']['name'];
        $target = "image/" . basename($image);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Query insert
            $query = "INSERT INTO Barang (kode_barang, nama_barang, harga, image, keterangan) 
                      VALUES ('$kode_barang', '$nama_barang', '$harga', '$image', '$keterangan')";
            if (mysqli_query($conn, $query)) {
                header('Location: index.php');
                exit();
            } else {
                $error_message = 'Gagal menambahkan barang: ' . mysqli_error($conn);
            }
        } else {
            $error_message = 'Gagal mengupload gambar.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Tambah Barang</h1>

<?php if ($error_message): ?>
    <script>
        alert("<?php echo $error_message; ?>");
    </script>
<?php endif; ?>

<form action="create.php" method="POST" enctype="multipart/form-data">
    <label>Kode Barang:</label>
    <input type="text" name="kode_barang" required><br>
    
    <label>Nama Barang:</label>
    <input type="text" name="nama_barang" required><br>
    
    <label>Harga:</label>
    <input type="number" name="harga" required><br>
    
    <label>Image:</label>
    <input type="file" name="image" required><br>
    
    <label>Keterangan:</label>
    <textarea name="keterangan" required></textarea><br>
    
    <input type="submit" value="Tambah Barang">
</form>

</body>
</html>
