<?php
// Include file koneksi database
include '../../config/koneksi.php';

// Periksa apakah parameter id telah diterima melalui URL
if (isset($_GET['Id'])) {
    // Ambil id surat dari URL
    $Id = $_GET['Id'];

    // Buat query untuk mengambil nama file surat berdasarkan id
    $query = "SELECT File_surat FROM suratkeluar WHERE Id='$Id'";

    // Eksekusi query
    $result = mysqli_query($link, $query);

    // Periksa apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil nama file surat
        $surat = mysqli_fetch_assoc($result);
        $File_surat = $surat['File_surat'];

        // Tentukan lokasi file surat
        $file_path = "../../uploads/" . $File_surat;

        // Periksa apakah file surat ada
        if (file_exists($file_path)) {
            // Set header untuk tipe konten dan attachment
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $File_surat . '"');

            // Baca dan cetak file surat
            readfile($file_path);

            // Tambahkan skrip JavaScript untuk menjalankan fungsi pencetakan bawaan browser
            echo '<script>window.onload = function() { window.print(); }</script>';

            // Keluar dari skrip setelah mencetak file surat
            exit();
        } else {
            // Jika file surat tidak ditemukan, tampilkan pesan error
            echo "File surat tidak ditemukan.";
        }
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error
        echo "Data surat tidak ditemukan.";
    }
} else {
    // Jika tidak ada parameter id yang diterima, tampilkan pesan error
    echo "ID surat tidak ditemukan.";
}