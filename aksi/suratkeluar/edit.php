<?php
include '../../config/koneksi.php';

// Proses penyuntingan data surat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $Id = $_POST['Id'];
    $No_surat = $_POST['No_surat'];
    $Tanggal_surat = $_POST['Tanggal_surat'];
    $Tanggal_keluar = $_POST['Tanggal_keluar'];
    $Kepada = $_POST['Kepada'];
    $Perihal = $_POST['Perihal'];
    $Isi_surat = $_POST['Isi_surat'];

    // Pemeriksaan apakah file surat telah diunggah
    if ($_FILES['File_surat']['size'] > 0) {
        // Direktori tempat file akan disimpan
        $target_dir = "../../uploads/";
        // Path file yang akan disimpan di server
        $target_file = $target_dir . basename($_FILES["File_surat"]["name"]);

        // Pindahkan file yang diupload ke direktori yang ditentukan
        if (move_uploaded_file($_FILES["File_surat"]["tmp_name"], $target_file)) {
            // Query untuk mengupdate data surat dengan file surat baru
            $sql = "UPDATE suratkeluar SET No_surat='$No_surat', Tanggal_surat='$Tanggal_surat', Tanggal_keluar='$Tanggal_keluar', Kepada='$Kepada', Perihal='$Perihal', Isi_surat='$Isi_surat', File_surat='" . basename($_FILES["File_surat"]["name"]) . "' WHERE id='$id'";
        } else {
            echo "Gagal mengunggah file.";
            exit(); // Berhenti eksekusi script
        }
    } else {
        // Jika tidak ada file yang diunggah, gunakan nilai file surat yang sudah ada
        $sql = "UPDATE suratkeluar SET No_surat='$No_surat', Tanggal_surat='$Tanggal_surat', Tanggal_keluar='$Tanggal_keluar', Kepada='$Kepada', Perihal='$Perihal', Isi_surat='$Isi_surat' WHERE Id='$Id'";
    }
    // Eksekusi query
    $query = mysqli_query($link, $sql);
    if ($query) {
        header('location: ../../suratkeluar.php');
    } else {
        echo "Gagal menyunting data.";
    }
} else {
    // Ambil id surat yang akan diedit
    $Id = $_GET['Id'];

    // Ambil data surat dari database
    $sql = "SELECT * FROM suratkeluar WHERE Id='$Id'";
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
    <title>Edit Surat Keluar</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
            <a href="../../suratkeluar.php" class="p=0 bg=transparent mr-2">
                <span class="text-white">&#8592;</span>
            </a>
            Edit Surat Keluar
        </header>
        <!-- <h1 class="mb-2 mt-2 ml-2">Edit Surat Keluar</h1> -->
        <!-- Form edit surat -->
        <form action="" method="POST" enctype="multipart/form-data" class="ml-2 w-95 mt-2">
            <!-- Isi form di sini -->
            <input type="hidden" name="Id" value="<?php echo isset($data['Id']) ? $data['Id'] : ''; ?>">
            <div class="form-group">
                <label for="No_surat">Nomor Surat:</label>
                <input type="text" class="form-control" id="No_surat" name="No_surat"
                    value="<?php echo isset($data['No_surat']) ? $data['No_surat'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Tanggal_surat">Tanggal Surat:</label>
                <input type="date" class="form-control" id="Tanggal_surat" name="Tanggal_surat"
                    value="<?php echo isset($data['Tanggal_surat']) ? $data['Tanggal_surat'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Tanggal_keluar">Tanggal Keluar:</label>
                <input type="date" class="form-control" id="Tanggal_keluar" name="Tanggal_keluar"
                    value="<?php echo isset($data['Tanggal_keluar']) ? $data['Tanggal_keluar'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Kepada">Kepada:</label>
                <input type="text" class="form-control" id="Kepada" name="Kepada"
                    value="<?php echo isset($data['Kepada']) ? $data['Kepada'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Perihal">Perihal:</label>
                <input type="text" class="form-control" id="Perihal" name="Perihal"
                    value="<?php echo isset($data['Perihal']) ? $data['Perihal'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Isi_surat">Isi Surat:</label>
                <input type="text" class="form-control" id="Isi_surat" name="Isi_surat"
                    value="<?php echo isset($data['Isi_surat']) ? $data['Isi_surat'] : ''; ?>" required>
            </div>
            <!-- <div class="form-group">
                <label for="File_surat">File Surat:</label>
                <input type="file" class="form-control" id="File_surat" name="File_surat">
            </div> -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <!-- <a href="../../suratkeluar.php" class="btn btn-secondary">Kembali</a> -->
            </div>
        </form>
    </div>
</body>

</html>