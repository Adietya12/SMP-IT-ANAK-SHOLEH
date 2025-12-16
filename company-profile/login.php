<?php
session_start();
include "koneksi.php";

$error = "";

// Jika tombol login ditekan
if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // password dienkripsi MD5

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;

      background: url('asset/smpit.jpg') no-repeat center center/cover;
      height: 100vh;

      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .overlay {
      position: absolute;
      width: 100%;
      height: 100%;
      background: rgba(7, 114, 32, 0.7);
      z-index: 1;
    }

    .login-box {
      position: relative;
      z-index: 2;
      width: 360px;
      background: #fff;
      border-radius: 8px;
      padding: 25px 30px;
      box-shadow: 0px 4px 20px rgba(0,0,0,0.3);
      text-align: center;
    }

    .login-box img {
      width: 120px;
      margin-bottom: 10px;
    }

    .divider {
      width: 100%;
      height: 1px;
      background: #ddd;
      margin: 10px 0 15px;
    }

    h3 {
      margin: 5px 0 20px;
      font-size: 20px;
      color: #222;
      font-weight: bold;
    }

    .input-wrapper {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 10px;
      background: #f5f5f5;
    }

    .input-wrapper i {
      padding: 10px;
      color: #555;
      font-size: 18px;
    }

    .input-wrapper input {
      width: 100%;
      padding: 12px 10px;
      border: none;
      background: transparent;
      outline: none;
      font-size: 14px;
    }

    .link-row {
      margin-top: 5px;
      display: flex;
      justify-content: space-between;
      font-size: 13px;
    }

    .link-row a {
      text-decoration: none;
      color: #0fad3f;
    }

    .btn-login {
      margin-top: 20px;
      background: #0a9841;
      color: white;
      width: 100%;
      padding: 12px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      font-size: 16px;
      transition: 0.2s;
      font-weight: bold;
    }

    .btn-login:hover {
      background: #0c4fb3;
    }

    .error {
      background: #ffdddd;
      padding: 8px;
      border-left: 4px solid #ff3333;
      margin-bottom: 10px;
      color: #900;
      font-size: 14px;
      border-radius: 3px;
    }

    @media (max-width: 480px) {
      .login-box {
        width: 90%;
      }
    }
  </style>
</head>

<body>

  <div class="overlay"></div>

  <div class="login-box">
    <img src="asset/logo.png" alt="Logo">

    <div class="divider"></div>

    <!-- ERROR -->
    <?php if ($error != "") : ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

      <div class="input-wrapper">
        <i class="ri-user-fill"></i>
        <input type="text" name="username" placeholder="Masukkan Username" required>
      </div>

      <div class="input-wrapper">
        <i class="ri-lock-password-fill"></i>
        <input type="password" name="password" placeholder="Masukkan Password" required>
      </div>

      <div class="link-row">
        <a href="#">Lupa kata sandi?</a>
        <a href="#">Bantuan</a>
      </div>

      <button type="submit" name="login" class="btn-login">
        Lanjut &nbsp; <i class="ri-arrow-right-line"></i>
      </button>

    </form>

  </div>

</body>
</html>
