<?php
// ===============================
// KONEKSI DATABASE
// ===============================
require_once "koneksi.php";

// Query data guru
$query_guru = mysqli_query($conn, "SELECT * FROM guru ORDER BY nama ASC");

// Cek jika query gagal
if (!$query_guru) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Guru - SMP IT Anak Sholeh</title>

    <!-- ICON & FONT -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: #f9fff9;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* HEADER */
        header {
            background: #ffffff;
            padding: 15px 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            color: #2e7d32;
        }

        .btn-login {
            background: #2e7d32;
            color: #fff;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #1b5e20;
        }

        /* CONTENT */
        .page-content {
            padding: 60px 40px;
            text-align: center;
        }

        .daftar-guru {
            max-width: 1200px;
            margin: auto;
        }

        .daftar-guru h2 {
            color: #1b5e20;
            font-size: 34px;
            font-weight: 800;
        }

        .subtitle {
            color: #555;
            margin-bottom: 40px;
        }

        /* GRID */
        .guru-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        /* CARD */
        .guru-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
            border-top: 8px solid #2e7d32;
            overflow: hidden;
            transition: 0.3s;
        }

        .guru-card:hover {
            transform: translateY(-7px);
        }

        .guru-photo-wrapper {
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .guru-photo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .guru-info {
            padding: 20px;
        }

        .guru-info h3 {
            color: #2e7d32;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .nip {
            font-size: 14px;
            color: #999;
            margin-bottom: 10px;
        }

        .mapel {
            font-weight: 500;
            margin-bottom: 15px;
        }

        .btn-contact {
            background: #ff7f50;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }

        /* EMPTY STATE */
        .empty-data {
            grid-column: 1 / -1;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.12);
            color: #777;
            font-size: 18px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .page-content {
                padding: 40px 20px;
            }
        }
    </style>
</head>

<body>

<header>
    <nav>
        <div class="logo-area">
            <img src="asset/logo.png" alt="Logo">
            <h1>Daftar Guru</h1>
        </div>
        <a href="../index.php" class="btn-login">
            <i class="ri-home-4-line"></i> Beranda
        </a>
    </nav>
</header>

<main class="page-content">
    <section class="daftar-guru">
        <h2>Tenaga Pendidik Kami</h2>
        <p class="subtitle">Berdedikasi mencetak generasi berilmu dan berakhlak mulia</p>

        <div class="guru-container">
        <?php if (mysqli_num_rows($query_guru) > 0): ?>
            <?php while ($guru = mysqli_fetch_assoc($query_guru)): ?>

                <?php
                $foto = !empty($guru['foto']) ? $guru['foto'] : 'default-guru.png';
                ?>

                <div class="guru-card">
                    <div class="guru-photo-wrapper">
                        <img src="../upload/<?= $foto ?>" alt="Foto Guru">
                    </div>
                    <div class="guru-info">
                        <h3><?= htmlspecialchars($guru['nama']) ?></h3>
                        <p class="nip">NIP: <?= $guru['nip'] ?? '-' ?></p>
                        <p class="mapel">
                            <i class="ri-book-open-line"></i>
                            <?= $guru['mapel'] ?? 'Belum ditentukan' ?>
                        </p>

                        <?php if (!empty($guru['telp'])): ?>
                            <a href="tel:<?= $guru['telp'] ?>" class="btn-contact">
                                <i class="ri-phone-line"></i> Hubungi
                            </a>
                        <?php else: ?>
                            <small style="color:#aaa;">Kontak belum tersedia</small>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-data">
                📌 Data guru belum tersedia saat ini.<br>
                Silakan kembali lagi nanti.
            </div>
        <?php endif; ?>
        </div>
    </section>
</main>

</body>
</html>
