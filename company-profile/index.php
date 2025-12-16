<?php 
include "koneksi.php";

// Ambil berita dari database (urut terbaru)
$query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP IT Anak Sholeh</title>
    
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <div class="logo-area">
                <img src="asset/logo.png" alt="Logo SMP IT">
                <h1>SMP IT Anak Sholeh</h1>
            </div>

            <ul class="nav-menu">
                <li><a href="#">Beranda</a></li>
                
                <li class="dropdown-menu"> 
                    <a href="#">Profil <i class="ri-arrow-down-s-line"></i></a>
                    
                    <ul class="dropdown-content">
                        <li><a href="guru.php">Guru</a></li>
                        <li><a href="pegawai.php">Pegawai</a></li>
                        <li><a href="pesertadidik.php">Peserta Didik</a></li>
                        <li><a href="kelas.php">Kelas</a></li>
                    </ul>
                </li>
                <li><a href="#visimisi">Visi & Misi</a></li>
                <li><a href="#berita">Berita</a></li>
                <li><a href="#ekstra">Ekstrakurikuler</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="/company-profile/login.php" class="btn-login"><i class="ri-login-circle-line"></i>Login</a>
            </div>
        </nav>
    </header>

    <section class="welcoming">
        <div class="hero-text">
            <h2>Bangun <span>Karakter & Ilmu</span> di Sekolah Terbaik</h2>
            <p>SMP IT Anak Sholeh berkomitmen mencetak generasi berilmu, berakhlak mulia, dan siap menghadapi masa depan.</p>
            <div class="hero-buttons">
                <a href="#" class="btn-primary">Mulai Sekarang</a>
                <a href="#berita" class="btn-outline">Lihat Kegiatan <i class="ri-play-circle-line"></i></a>
            </div>
        </div>

        <div class="hero-image">
            <div class="hero-image-container">
                <img src="asset/sekolah.png" alt="Sekolah">
            </div>
        </div>
    </section>

    <section id="visimisi">
        <h2>Visi & Misi</h2>
        <div class="visi-misi-container">
            <div class="visi">
                <h3>Visi</h3>
                <p>
                    Menjadi <b>Sekolah Islam Terpadu (IT) Unggulan</b> yang berkomitmen mencetak generasi <b>Shalih, Cerdas, dan Berwawasan Global</b>.
                </p>
            </div>
            <div class="misi">
                <h3>Misi</h3>
                <ul>
                    <li>Menyelenggarakan pendidikan berbasis Al-Qur'an dan Sunnah.</li>
                    <li>Mengembangkan potensi akademik dan non-akademik siswa secara maksimal.</li>
                    <li>Membentuk karakter Islami, mandiri, dan berjiwa kepemimpinan.</li>
                    <li>Menciptakan lingkungan belajar yang kondusif dan inovatif.</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="berita">
        <h2>Berita Terbaru</h2>
        <p class="subtitle">Simak kegiatan dan prestasi terkini dari siswa-siswi kami.</p>

        <div class="berita-container">

            <?php 
            $counter = 1;
            while ($row = mysqli_fetch_assoc($query)) : 
                $id = $row['id'];
                $judul = $row['judul'];
                $isi = $row['isi'];
                $gambar = $row['gambar'];
                $paragraf_id = "paragraf-" . $counter;
            ?>

            <div class="berita-card">
                <div class="image-wrapper-3-4">
                    <img src="upload/<?= $gambar ?>" alt="<?= $judul ?>">
                </div>

                <div class="berita-content">
                    <h3><?= $judul ?></h3>

                    <p id="<?= $paragraf_id ?>" class="berita-text">
                        <?= substr($isi, 0, 200) ?>...
                        <span class="full-text-content" style="display:none;">
                            <?= nl2br($isi) ?>
                        </span>
                    </p>

                    <a href="javascript:void(0)" class="read-more-link" onclick="toggleReadMore('<?= $paragraf_id ?>', this)">
                        <span>Baca Selengkapnya</span> <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>

            <?php 
            $counter++;
            endwhile;
            ?>

        </div>
    </section>

    <section id="ekstra" class="ekstra">
        <h2>Ekstrakurikuler</h2>
        <p>Berbagai kegiatan untuk mengembangkan potensi siswa di luar kelas</p>

        <div class="ekstra-container">
            <div class="ekstra-card">
                <i class="ri-compass-3-line"></i>
                <h3>Pramuka</h3>
                <p>Melatih kemandirian, tanggung jawab, dan jiwa kepemimpinan.</p>
            </div>
            <div class="ekstra-card">
                <i class="ri-football-line"></i>
                <h3>Futsal</h3>
                <p>Meningkatkan sportivitas dan kekompakan dalam tim.</p>
            </div>
            <div class="ekstra-card">
                <i class="ri-book-open-line"></i>
                <h3>Tahfidz</h3>
                <p>Mendalami hafalan Al-Qur’an dan memperkuat iman siswa.</p>
            </div>
            <div class="ekstra-card">
                <i class="ri-paint-brush-line"></i>
                <h3>Seni & Kreativitas</h3>
                <p>Mengasah bakat seni seperti melukis, tari, dan musik islami.</p>
            </div>
        </div>
    </section>

    <section id="kontak" class="kontak">
        <div class="kontak-wrapper">
            <div class="kontak-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.7140451228624!2d116.09224177477563!3d-8.623427391422558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcdbf03e3a2b35b%3A0x52d89f9894a432ae!2sSDIT%202%2C%20SMPIT%20%26%20SMAIT%20ANAK%20SHOLEH%20MATARAM!5e0!3m2!1sid!2sid!4v1762741214074!5m2!1sid!2sid" 
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="kontak-info">
                <h2>Hubungi Kami</h2>
                <p><i class="ri-map-pin-line"></i> Jl. Pendidikan No.10, Mataram, NTB</p>
                <p><i class="ri-phone-line"></i> (0370) 123456</p>
                <p><i class="ri-mail-line"></i> info@smpitanaksholeh.sch.id</p>
                <p><i class="ri-time-line"></i> Senin - Jumat: 07.00 - 15.00</p>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>