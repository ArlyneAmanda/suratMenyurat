<?php
include '../../config/koneksi.php';

// Proses penambahan data surat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Ambil data dari form

            $No_surat = $_POST['No_surat'];
            $Tanggal_surat = $_POST['Tanggal_surat'];
            $Tanggal_keluar = $_POST['Tanggal_keluar'];
            $Kepada = $_POST['Kepada'];
            $Perihal = $_POST['Perihal'];
            $Isi_surat = $_POST['Isi_surat'];
            $File_surat = $_FILES['File_surat']['name'];

            // Direktori tempat file akan disimpan
            $target_dir = "../../uploads/";
            // Path file yang akan disimpan di server
            $target_file = $target_dir . basename($_FILES["File_surat"]["name"]);

            // Pindahkan file yang diupload ke direktori yang ditentukan
            if (move_uploaded_file($_FILES["File_surat"]["tmp_name"], $target_file)) {
                // Query untuk menambahkan data surat baru
                $sql = "INSERT INTO suratkeluar (No_surat, Tanggal_surat, Tanggal_keluar, Kepada, Perihal, Isi_surat, File_surat) VALUES ('$No_surat', '$Tanggal_surat', '$Tanggal_keluar', '$Kepada', '$Perihal', '$Isi_surat', '$File_surat')";

                 // Eksekusi query
                 $query = mysqli_query($link, $sql);
                 if ($query) {
                     echo " <script> 
                     alert ('data berhasil ditambah');
                     location.href='../../suratkeluar.php';
                     </script>";
                 } else {
                     echo "Gagal menambahkan data. Mohon coba lagi.";
                 }
             } else {
                 echo "Gagal mengunggah file. Pastikan ukuran file tidak melebihi batas dan coba lagi.";
             }
            }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Surat</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
<?php include '../../partials/sidebar.php'; ?>
    <div class="container mt-5">

        <h1 class="mb-4">Tambah Surat Keluar</h1>
        <!-- Form tambah surat -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Isi form di sini -->
            <div class="form-group">
            <label for="No_surat" class="form-label">Nomor Surat :</label>
            <input type="text" class="form-control" id="No_surat" name="No_surat" required>
        </div>
        <br>

        <div class="form-group">
            <label for="Tanggal_surat" class="form-label">Tanggal Surat :</label>
            <input type="date" class="form-control" id="Tanggal_surat" name="Tanggal_surat" required>
        </div>
        <br>

        <div class="form-group">
            <label for="Tanggal_keluar" class="form-label">Tanggal Keluar :</label>
            <input type="date" class="form-control" id="Tanggal_keluar" name="Tanggal_keluar" required>
        </div>
        <br>
        
        <div class="form-group">
            <label for="Kepada" class="form-label">Kepada :</label>
            <input type="text" class="form-control" id="Kepada" name="Kepada" required>
        </div>
        <br>
        
        <div class="form-group">
            <label for="Perihal" class="form-label">Perihal :</label>
            <input type="text" class="form-control" id="Perihal" name="Perihal" required>
        </div>
        <br>

        <div class="form-group">
            <label for="Isi_surat" class="form-label">Isi Surat :</label>
            <input type="text" class="form-control" id="Isi_surat" name="Isi_surat" required>
        </div>
        <br>

        <div class="form-group">
            <label for="File_surat" class="form-label">File Surat :</label>
            <input type="file" class="form-control" id="File_surat" name="File_surat" required>
        </div>
        <br>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../../suratkeluar.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>