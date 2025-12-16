<?php
session_start();
include "koneksi.php";

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins';
            background: #f3f7ff;
        }

        nav {
            display: flex;
            justify-content: space-between;
            padding: 15px 40px;
            background: white;
            box-shadow: 0px 2px 10px rgba(0,0,0,0.1);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-area img {
            width: 50px;
        }

        .logo-area h1 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .container {
            width: 70%;
            margin: 40px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 6px 25px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
            font-weight: 700;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #c8c8c8;
            outline: none;
            font-size: 15px;
            margin-bottom: 20px;
            background: #fdfdfd;
        }

        input[type="file"] {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-submit {
            padding: 12px 22px;
            background: #0077ff;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #005cd1;
        }

        .preview-img {
            width: 200px;
            display: none;
            margin-top: 10px;
            border-radius: 10px;
        }

        .back-btn {
            margin-top: 10px;
            display: inline-block;
            color: #0077ff;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo-area">
            <img src="asset/logo.png">
            <h1>Admin Panel</h1>
        </div>

        <a href="logout.php" class="btn-login"><i class="ri-logout-box-line"></i> Logout</a>
    </nav>

    <div class="container">
        <div class="card">

            <h2>Tambah Berita Baru</h2>

            <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">

                <label>Judul Berita</label>
                <input type="text" name="judul" required>

                <label>Isi Berita</label>
                <textarea name="isi" rows="7" required></textarea>

                <label>Upload Gambar</label>
                <input type="file" name="gambar" accept="image/*" onchange="previewImage(event)" required>
                <img id="preview" class="preview-img">

                <button type="submit" class="btn-submit">Tambah Berita</button>
            </form>

            <a href="berita/" class="back-btn"><i class="ri-arrow-left-line"></i> Kembali ke daftar berita</a>

        </div>
    </div>

    <script>
        function previewImage(event) {
            let img = document.getElementById('preview');
            img.src = URL.createObjectURL(event.target.files[0]);
            img.style.display = "block";
        }
    </script>

</body>

</html>
