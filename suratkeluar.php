<?php
include 'config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Surat Keluar</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include 'partials/sidebar.php'; ?>
    <div class="container mt-3">
        <h1 class="">Data Surat Keluar</h1>
        <a href="aksi/suratkeluar/tambah.php" class="btn btn-primary mt-2 mb-3">+ Tambah Surat Keluar</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Keluar</th>
                    <th>Kepada</th>
                    <th>Perihal</th>
                    <th>Isi Surat</th>
                    <th>File Surat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // Query untuk mengambil data surat
                $query = "SELECT * FROM suratkeluar";
                $result = mysqli_query($link, $query);

                // Periksa apakah ada data surat
                if (mysqli_num_rows($result) > 0) {
                    // Tampilkan data surat dalam tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['No_surat'] . "</td>";
                        echo "<td>" . $row['Tanggal_surat'] . "</td>";
                        echo "<td>" . $row['Tanggal_keluar'] . "</td>";
                        echo "<td>" . $row['Kepada'] . "</td>";
                        echo "<td>" . $row['Perihal'] . "</td>";
                        echo "<td>" . $row['Isi_surat'] . "</td>";
                        echo "<td><a href='uploads/" . $row['File_surat'] . "' target='_blank'>" . $row['File_surat'] . "</a></td>"; // Tautan untuk melihat file surat
                        echo "<td>";
                        echo "<a href='aksi/suratkeluar/edit.php?Id=" . $row['Id'] . "' class='btn btn-primary mr-2'><i class='fas fa-edit'></i></a>";
                        echo "<a href='aksi/suratkeluar/hapus.php?Id=" . $row['Id'] . "' class='btn btn-danger mr-2'><i class='fas fa-trash-alt'></i></a>";
                        echo "<a href='aksi/suratkeluar/cetak.php?Id=" . $row['Id'] . "' class='btn btn-success'><i class='fas fa-print'></i></a>"; // Tambahkan tautan untuk mencetak surat
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