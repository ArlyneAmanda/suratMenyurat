<?php
include '../../config/koneksi.php';

// Proses penyuntingan data surat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = $_POST['id'];
    $no_surat = $_POST['no_surat'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $asal_surat = $_POST['asal_surat'];
    $perihal = $_POST['perihal'];

    // Cek apakah ada file yang diunggah
    if ($_FILES['file_surat']['size'] > 0) {
        // Direktori tempat file akan disimpan
        $target_dir = "../../uploads/";
        // Path file yang akan disimpan di server
        $target_file = $target_dir . basename($_FILES["file_surat"]["name"]);

        // Pindahkan file yang diupload ke direktori yang ditentukan
        if (move_uploaded_file($_FILES["file_surat"]["tmp_name"], $target_file)) {
            // Query untuk mengupdate data surat dengan file surat
            $sql = "UPDATE suratmasuk SET
             no_surat='$no_surat', tanggal_surat='$tanggal_surat', tanggal_masuk='$tanggal_masuk', asal_surat='$asal_surat', perihal='$perihal', file_surat='" . basename($_FILES["file_surat"]["name"]) . "' WHERE id='$id'";
        } else {
            echo "Gagal mengunggah file.";
            exit(); // Berhenti eksekusi script
        }
    } else {
        // Query untuk mengupdate data surat tanpa mengubah file surat
        $sql = "UPDATE suratmasuk SET no_surat='$no_surat', tanggal_surat='$tanggal_surat', tanggal_masuk='$tanggal_masuk', asal_surat='$asal_surat', perihal='$perihal' WHERE id='$id'";
    }

    // Eksekusi query
    $query = mysqli_query($link, $sql);
    if ($query) {
        header('location:../../suratmasuk.php');
    } else {
        echo "Gagal menyunting data.";
    }
} else {
    // Ambil id surat yang akan diedit
    $id = $_GET['id'];

    // Ambil data surat dari database
    $sql = "SELECT * FROM suratmasuk WHERE id='$id'";
    $query = mysqli_query($link, $sql);
    $data = mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat Masuk</title>
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
        <header class="p-3 d-flex justify-item-center gap-">
            <a href="../../suratmasuk.php" class="p=0 bg=transparent mr-2">
                <span class="text-white">&#8592;</span>
            </a>
            Edit Surat Masuk
        </header>
        <!-- <h1 class="mb-2 ml-2">Edit Surat Masuk</h1> -->
        <!-- Form edit surat -->
        <form action="" method="POST" enctype="multipart/form-data" class="ml-2 mt-2">
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
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                    value="<?php echo $data['tanggal_masuk']; ?>" required>
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
            <!-- <div class="form-group">
                <label for="file_surat">File Surat:</label>
                <input type="file" class="form-control" id="file_surat" name="file_surat">
            </div> -->
            <div class="mb-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <!-- <a href="../../suratmasuk.php" class="btn btn-secondary">Kembali</a> -->
            </div>
        </form>
    </div>
</body>

</html>