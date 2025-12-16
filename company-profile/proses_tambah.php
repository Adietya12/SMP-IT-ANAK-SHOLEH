<?php
session_start();

// pastikan koneksi.php mendefinisikan $conn (bukan $koneksi). 
// Jika koneksi.php kamu menggunakan $koneksi, ubah semua $conn di bawah menjadi $koneksi
include "koneksi.php";

// Pastikan hanya admin yang boleh akses (opsional, tergantung implementasimu)
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Cek form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil input, lakukan sanitasi dasar
    $judul = isset($_POST['judul']) ? trim($_POST['judul']) : '';
    $isi   = isset($_POST['isi']) ? trim($_POST['isi']) : '';

    // Validasi sederhana
    if ($judul === '' || $isi === '') {
        die("Judul dan isi berita harus diisi.");
    }

    // Proses upload gambar (opsional required tergantung form)
    $namaFileBaru = null;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file      = $_FILES['gambar'];
        $tmpName   = $file['tmp_name'];
        $origName  = $file['name'];
        $size      = $file['size'];
        $error     = $file['error'];

        // cek error upload
        if ($error !== UPLOAD_ERR_OK) {
            die("Terjadi kesalahan saat upload file. Error code: $error");
        }

        // cek ukuran (contoh max 5MB)
        if ($size > 5 * 1024 * 1024) {
            die("Ukuran file terlalu besar. Maks 5MB.");
        }

        // cek ekstensi
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (!in_array($ext, $allowed)) {
            die("Tipe file tidak diperbolehkan. Hanya: " . implode(", ", $allowed));
        }

        // buat folder upload jika belum ada
        $uploadDir = __DIR__ . '/upload';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // buat nama file baru agar unik
        $namaFileBaru = time() . '_' . preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $origName);
        $targetPath = $uploadDir . '/' . $namaFileBaru;

        if (!move_uploaded_file($tmpName, $targetPath)) {
            die("Gagal memindahkan file ke folder upload.");
        }
    }

    // Simpan ke database menggunakan prepared statement (lebih aman)
    // Pastikan $conn tersedia dari koneksi.php
    if (!isset($conn)) {
        // jika koneksi.php kamu menggunakan nama variabel $koneksi, ubah baris ini menjadi $koneksi
        die("Koneksi database tidak ditemukan. Pastikan koneksi.php mendefinisikan \$conn.");
    }

    $sql = "INSERT INTO berita (judul, isi, gambar) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    // bind parameter
    mysqli_stmt_bind_param($stmt, "sss", $judul, $isi, $namaFileBaru);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        // redirect kembali ke halaman daftar berita atau index
        header("Location: index.php?msg=added");
        exit;
    } else {
        $err = mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        die("Gagal menyimpan berita: " . $err);
    }

} else {
    // jika bukan POST
    header("Location: tambahberita.php");
    exit;
}
