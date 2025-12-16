<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("login.php");
    exit();
}

require_once "koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Guru</title>

    <style>
        body {
            background: #f9fff9;
            font-family: Poppins, sans-serif;
        }

        .container {
            max-width: 600px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #2e7d32;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #1b5e20;
        }

        .back {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Tambah Data Guru</h2>

    <form action="proses_tambah_guru.php" method="POST" enctype="multipart/form-data">
        <label>Nama Guru</label>
        <input type="text" name="nama" required>

        <label>NIP</label>
        <input type="text" name="nip">

        <label>Mata Pelajaran</label>
        <input type="text" name="mapel">

        <label>No. Telepon</label>
        <input type="text" name="telp">

        <label>Foto Guru</label>
        <input type="file" name="foto" accept="image/*">

        <button type="submit">Simpan Guru</button>
    </form>

    <div class="back">
        <a href="dashboard.php">⬅ Kembali ke Dashboard</a>
    </div>
</div>

</body>
</html>
