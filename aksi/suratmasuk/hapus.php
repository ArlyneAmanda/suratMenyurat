<?php
// Include file koneksi database
include '../../config/koneksi.php';

// Periksa apakah parameter id telah diterima melalui URL
if (isset($_GET['id'])) {
    // Ambil id surat dari URL
    $id = $_GET['id'];

    // Buat query untuk menghapus data surat berdasarkan id
    $query = "DELETE FROM suratmasuk WHERE id='$id'";
    
    // Eksekusi query
    $result = mysqli_query($link, $query);

    unlink("../../uploads/" . $Id[$i]['file_surat']);
    mysqli_query($link, "DELETE FROM suratmasuk WHERE `id` = $id");

    // Periksa apakah penghapusan berhasil
    if ($result) {
        // Redirect kembali ke halaman utama setelah penghapusan berhasil
        header('Location: ../../suratmasuk.php');
        exit;
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        echo "Gagal menghapus data surat.";
    }
} else {
    // Jika tidak ada parameter id yang diterima, tampilkan pesan error
    echo "ID surat tidak ditemukan.";
}
