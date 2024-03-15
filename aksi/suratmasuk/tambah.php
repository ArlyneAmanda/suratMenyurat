<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Surat Masuk</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        header {
            background-color: #1B1A55;
            color: white;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .content {
            flex: 1;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <?php include '../../partials/sidebar.php'; ?>
    <div class="w-100">
        <?php
        include '../../config/koneksi.php';

        // Proses penambahan data surat
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ambil data dari form
            $no_surat = $_POST['no_surat'];
            $tanggal_surat = $_POST['tanggal_surat'];
            $tanggal_masuk = $_POST['tanggal_masuk'];
            $asal_surat = $_POST['asal_surat'];
            $perihal = $_POST['perihal'];
            $file_surat = $_FILES['file_surat']['name'];

            // Pemeriksaan apakah file surat telah diunggah
            if ($_FILES['file_surat']['size'] > 0) {
                // Direktori tempat file akan disimpan
                $target_dir = "../../uploads/";
                // Path file yang akan disimpan di server
                $target_file = $target_dir . basename($_FILES["file_surat"]["name"]);

                // Pindahkan file yang diupload ke direktori yang ditentukan
                if (move_uploaded_file($_FILES["file_surat"]["tmp_name"], $target_file)) {
                    // Query untuk menambahkan data surat baru
                    $sql = "INSERT INTO suratmasuk (no_surat, tanggal_surat, tanggal_masuk, asal_surat, perihal, file_surat) VALUES ('$no_surat', '$tanggal_surat', '$tanggal_masuk', '$asal_surat', '$perihal', '$file_surat')";

                    // Eksekusi query
                    $query = mysqli_query($link, $sql);
                    if ($query) {
                        echo " <script> 
                        alert ('data berhasil ditambah');
                        location.href='../../suratmasuk.php';
                        </script>";
                    } else {
                        echo "Gagal menambahkan data. Mohon coba lagi.";
                    }
                } else {
                    echo "Gagal mengunggah file. Pastikan ukuran file tidak melebihi batas dan coba lagi.";
                }
            } else {
                echo "Silakan pilih file surat.";
            }
        }
        ?>
        <script>

        </script>
        <header class="p-3 d-flex justify-item-center gap-">
            <a href="../../suratmasuk.php" class="p=0 bg=transparent mr-2">
                <span class="text-white">&#8592;</span>
            </a>
            Tambah Surat Masuk
        </header>
        <h1 class="mb-2 ml-2">Tambah Surat Masuk</h1>
        <!-- Form tambah surat -->
        <form action="" method="POST" enctype="multipart/form-data" class="ml-2">
            <div class="form-group">
                <label for="no_surat" class="form-label">Nomor Surat:</label>
                <input type="text" class="form-control" id="no_surat" name="no_surat" required>
            </div>
            <div class="form-group">
                <label for="tanggal_surat" class="form-label">Tanggal Surat:</label>
                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
            </div>
            <div class="form-group">
                <label for="asal_surat" class="form-label">Asal Surat:</label>
                <input type="text" class="form-control" id="asal_surat" name="asal_surat" required>
            </div>
            <div class="form-group">
                <label for="perihal" class="form-label">Perihal:</label>
                <input type="text" class="form-control" id="perihal" name="perihal" required>
            </div>
            <div class="form-group">
                <label for="file_surat" class="form-label">File Surat:</label>
                <input type="file" class="form-control" id="file_surat" name="file_surat" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan Surat</button>
                <!-- <a href="../../suratmasuk.php" class="btn btn-secondary">Kembali</a> -->
            </div>
        </form>
    </div>
</body>

</html>