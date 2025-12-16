<?php
include "koneksi.php";

// Cek apakah ada ID
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = intval($_GET['id']);

// Ambil data gambar dulu
$cek = mysqli_query($conn, "SELECT gambar FROM berita WHERE id = $id");
$data = mysqli_fetch_assoc($cek);

if (!$data) {
    die("Data berita tidak ditemukan.");
}

// Jika ada gambar → hapus file fisiknya
if ($data['gambar'] != "" && file_exists("upload/" . $data['gambar'])) {
    unlink("upload/" . $data['gambar']);
}

// Hapus data dari database
mysqli_query($conn, "DELETE FROM berita WHERE id = $id");

// Kembali ke halaman admin
header("Location: admin_berita.php?msg=deleted");
exit;
