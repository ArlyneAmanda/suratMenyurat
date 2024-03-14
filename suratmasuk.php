<?if (!isset($_SESSION['login'])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Surat Masuk</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include 'partials/sidebar.php'; ?>
    <div class="container mt-3">
        <h1>Daftar Surat Masuk</h1>
        <a href="aksi/suratmasuk/tambah.php" class="btn btn-primary mb-3 mt-2">+ Tambah Surat Masuk</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Masuk</th>
                    <th>Asal Surat</th>
                    <th>Perihal</th>
                    <th>File Surat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include file koneksi database
                include 'config/koneksi.php';

                // Query untuk mengambil data surat
                $query = "SELECT * FROM suratmasuk";
                $result = mysqli_query($link, $query);

                // Periksa apakah ada data surat
                if (mysqli_num_rows($result) > 0) {
                    // Tampilkan data surat dalam tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['no_surat'] . "</td>";
                        echo "<td>" . $row['tanggal_surat'] . "</td>";
                        echo "<td>" . $row['tanggal_masuk'] . "</td>";
                        echo "<td>" . $row['asal_surat'] . "</td>";
                        echo "<td>" . $row['perihal'] . "</td>";
                        echo "<td><a href='uploads/" . $row['file_surat'] . "' target='_blank'>" . $row['file_surat'] . "</a></td>"; // Tautan untuk melihat file surat
                        echo "<td>";
                        echo "<a href='aksi/suratmasuk/edit.php?id=" . $row['id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i></a>";
                        echo "<a href='aksi/suratmasuk/hapus.php?id=" . $row['id'] . "' class='btn btn-danger mr-2'><i class='fas fa-trash-alt'></i></a>";
                        echo "<a href='aksi/suratmasuk/cetak.php?id=" . $row['id'] . "' class='btn btn-success'><i class='fas fa-print'></i></a>"; // Tambahkan tautan untuk mencetak surat
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Jika tidak ada data surat
                    echo "<tr><td colspan='7'>Tidak ada surat.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>