<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <?php include '../../partials/sidebar.php'; ?>
    <div class="container mt-3">
        <?php
        include '../../config/koneksi.php';

        // Proses penyuntingan data surat
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $id = $_POST['id'];
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
                // Query untuk mengupdate data surat
                $sql = "UPDATE suratkeluar SET no_surat='$no_surat', tanggal_surat='$tanggal_surat', tanggal_keluar='$tanggal_keluar', asal_surat='$asal_surat', perihal='$perihal', file_surat='$file_surat' WHERE id='$id'";

                // Eksekusi query
                $query = mysqli_query($link, $sql);
                if ($query) {
                    header('location:../../suratkeluar.php');
                } else {
                    echo "Gagal menyunting data.";
                }
            } else {
                echo "Gagal mengunggah file.";
            }
        } else {
            // Ambil id surat yang akan diedit
            $id = $_GET['id'];

            // Ambil data surat dari database
            $sql = "SELECT * FROM suratkeluar WHERE id='$id'";
            $query = mysqli_query($link, $sql);
            $data = mysqli_fetch_array($query);
        }
        ?>

        <h1 class="mb-3">Edit Surat</h1>
        <!-- Form edit surat -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Isi form di sini -->
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="form-group">
                <label for="no_surat">Nomor Surat:</label>
                <input type="text" class="form-control" id="no_surat" name="no_surat"
                    value="<?php echo $data['no_surat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_surat">Tanggal Surat:</label>
                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat"
                    value="<?php echo $data['tanggal_surat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_keluar">Tanggal Keluar:</label>
                <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
                    value="<?php echo $data['tanggal_keluar']; ?>" required>
            </div>
            <div class="form-group">
                <label for="asal_surat">Asal Surat:</label>
                <input type="text" class="form-control" id="asal_surat" name="asal_surat"
                    value="<?php echo $data['asal_surat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="perihal">Perihal:</label>
                <input type="text" class="form-control" id="perihal" name="perihal"
                    value="<?php echo $data['perihal']; ?>" required>
            </div>
            <div class="form-group">
                <label for="file_surat">File Surat:</label>
                <input type="file" class="form-control" id="file_surat" name="file_surat" required>
            </div>
            <div class="mb-5">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="../../suratkeluar.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>

</html>