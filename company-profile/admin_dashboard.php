<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <!-- ================== CSS DISATUKAN ================== -->
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

        /* DASHBOARD WRAPPER */
        .admin-dashboard {
            width: 100%;
            padding: 40px;
        }

        h2 {
            color: #1b5e20;
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 25px;
            text-align: center;
        }

        /* CARD MENU */
        .dashboard-menu {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .menu-card {
            background: #ffffff;
            padding: 25px 35px;
            border-radius: 15px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
            text-align: center;
            border-top: 8px solid #2e7d32;
            transition: 0.3s;
            min-width: 220px;
        }
        .menu-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        }

        .menu-card h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #2e7d32;
        }

        .menu-card a {
            display: inline-block;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 10px;
            color: white;
            background: #2e7d32;
            transition: 0.3s;
        }
        .menu-card a:hover {
            background: #1b5e20;
        }

        /* LOGOUT BUTTON */
        .logout-btn {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }

        .logout-btn a {
            background: #ff7f50;
            color: #fff;
            padding: 12px 22px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.3s;
        }
        .logout-btn a:hover {
            background: #e6673d;
        }
    </style>
</head>

<body>

<div class="admin-dashboard">

    <h2>Dashboard Admin</h2>

    <div class="dashboard-menu">
        <div class="menu-card">
            <h3>Kelola Berita</h3>
            <a href="tambah_berita.php">Tambah Berita</a>
        </div>

        <div class="menu-card">
            <h3>Lihat Berita</h3>
            <a href="list_berita.php">Daftar Berita</a>
        </div>

        <div class="menu-card">
            <h3>Tambah Guru</h3>
            <a href="tambah_guru.php">Tambah Guru</a>
        </div>
    </div>

    <div class="logout-btn">
        <a href="../logout.php">Logout</a>
    </div>

</div>

</body>
</html>
