<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Surat</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <?php include '../../partials/sidebar.php'; ?>
    <div class="container mt-3">
        <?php
        include '../../config/koneksi.php';

        // Proses penambahan data surat
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $no_surat = $_POST['no_surat'];
            $tanggal_surat = $_POST['tanggal_surat'];
            $tanggal_keluar = $_POST['tanggal_keluar'];
            $asal_surat = $_POST['asal_surat'];
            $perihal = $_POST['perihal'];
            $file_surat = $_FILES['file_surat']['name'];

            // Direktori tempat file akan disimpan
            $target_dir = "../../uploads/";
            // Path file yang akan disimpan di server
            $target_file = $target_dir . basename($_FILES["file_surat"]["name"]);

            // Pindahkan file yang diupload ke direktori yang ditentukan
            if (move_uploaded_file($_FILES["file_surat"]["tmp_name"], $target_file)) {
                // Query untuk menambahkan data surat baru
                $sql = "INSERT INTO suratkeluar (no_surat, tanggal_surat, tanggal_keluar, asal_surat, perihal, file_surat) VALUES ('$no_surat', '$tanggal_surat', '$tanggal_keluar', '$asal_surat', '$perihal', '$file_surat')";

                // Eksekusi query
                $query = mysqli_query($link, $sql);
                if ($query) {
                    header('location:../../suratkeluar.php');
                } else {
                    echo "Gagal menambahkan data.";
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        }
        ?>

        <h1 class="mb-3">Tambah Surat</h1>
        <!-- Form tambah surat -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Isi form di sini -->
            <div class="form-group">
                <label for="nama" class="form-label">Nomor Surat :</label>
                <input type="text" class="form-control" id="no_surat" name="no_surat" required>
            </div>
            <div class="form-group">
                <label for="nama" class="form-label">Tanggal Surat :</label>
                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
            </div>
            <div class="form-group">
                <label for="tgl_lhr" class="form-label">Tanggal Keluar :</label>
                <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" required>
            </div>
            <div class="form-group">
                <label for="text" class="form-label">Asal Surat :</label>
                <input type="text" class="form-control" id="asal_surat" name="asal_surat" required>
            </div>
            <div class="form-group">
                <label for="text" class="form-label">Perihal :</label>
                <input type="text" class="form-control" id="perihal" name="perihal" required>
            </div>
            <div class="form-group">
                <label for="kontak" class="form-label">File Surat :</label>
                <input type="file" class="form-control" id="file_surat" name="file_surat" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="../../suratkeluar.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>