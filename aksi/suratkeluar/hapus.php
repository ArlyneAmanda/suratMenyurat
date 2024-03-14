<?php
// Include file koneksi database
include '../../config/koneksi.php';

// Periksa apakah parameter id telah diterima melalui URL
if (isset($_GET['Id'])) {
    // Ambil id surat dari URL
    $Id = $_GET['Id'];

    // Buat query untuk menghapus data surat berdasarkan id
    $query = "DELETE FROM suratkeluar WHERE Id='$Id'";
    
    // Eksekusi query
    $result = mysqli_query($link, $query);

    // Periksa apakah penghapusan berhasil
    if ($result) {
        // Redirect kembali ke halaman utama setelah penghapusan berhasil
        header('Location: ../../suratkeluar.php');
        exit;
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        echo "Gagal menghapus data surat.";
    }
} else {
    // Jika tidak ada parameter id yang diterima, tampilkan pesan error
    echo "ID surat tidak ditemukan.";
}
