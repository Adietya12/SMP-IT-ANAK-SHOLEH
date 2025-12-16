<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

require_once "koneksi.php";

// Ambil data
$nama  = $_POST['nama'];
$nip   = $_POST['nip'];
$mapel = $_POST['mapel'];
$telp  = $_POST['telp'];

// Default foto
$namaFoto = "default-guru.png";

// Jika upload foto
if (!empty($_FILES['foto']['name'])) {
    $folder = "../upload/";
    $namaFoto = time() . "_" . $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $namaFoto);
}

// Simpan ke database
$query = mysqli_query($conn, "INSERT INTO guru 
    (nama, nip, mapel, telp, foto) 
    VALUES ('$nama', '$nip', '$mapel', '$telp', '$namaFoto')");

if ($query) {
    header("Location: dashboard.php");
} else {
    echo "Gagal menyimpan data";
}
