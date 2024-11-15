<?php
require 'koneksi.php';
session_start();

// Cek apakah sudah ada session login
if (isset($_SESSION['username'])) {
    // Jika sudah login, arahkan ke halaman admin
    header("Location: adminplh.php");
    exit();
}

// Cek apakah form login disubmit
if (isset($_POST['login'])) {
    // Koneksi ke database
    $servername = "localhost"; // Ganti dengan nama host, misalnya localhost
    $username = "root"; // Ganti dengan username MySQL
    $password = ""; // Ganti dengan password MySQL
    $dbname = "adminn"; // Nama database

    // Ambil data input user
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Query untuk mengambil data user yang cocok dengan username
    $sql = "SELECT * FROM adminn WHERE username = '$inputUsername'";
    $result = $conn->query($sql);

    // Cek apakah ada user yang ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (isset($_POST['remember'])) {
            // Set cookie dengan durasi 30 detik
            setcookie('username', $inputUsername, time() + 30, "/");
            setcookie('password', $inputPassword, time() + 30, "/");
            setcookie('expiry_time', time() + 30, time() + 30, "/"); // Cookie untuk mengatur waktu kadaluwarsa
        } else {
            setcookie('username', "", time() - 3600, "/");
            setcookie('password', "", time() - 3600, "/");
            setcookie('expiry_time', "", time() - 3600, "/");
        }

        header("Location: adminplh.php");
        exit();
    } else {
        // Jika password tidak cocok
        $error = "Username atau Password salah!";
    }
} else {
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        $cookieTime = time(); // Waktu sekarang
        // $cookieExpiry = time() + 60; // 1 menit ke depan (sama seperti saat set cookie)
        if ($cookieTime < $cookieExpiry) {
            $inputUsername = $_COOKIE['username'];
            $inputPassword = $_COOKIE['password'];

            $sql = "SELECT * FROM adminn WHERE username = '$inputUsername' AND password = '$inputPassword'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $_SESSION['username'] = $inputUsername;
                header("Location: adminplh.php");
                exit();
            } else {
                setcookie('username', "", time() - 3600, "/");
                setcookie('password', "", time() - 3600, "/");
                header("Location: login.php");
                exit();
            }
        } else {
            setcookie('username', "", time() - 3600, "/");
            setcookie('password', "", time() - 3600, "/");
            header("Location: login.php");
            exit();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Page</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nokora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500&family=Jost:wght@400;700&family=Quicksand:wght@300;600&family=Roboto:wght@300;500&family=Shantell+Sans:wght@500&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .kembali {
            margin-top: 100px;
            padding-left: 70px;
            margin-bottom: 30px;
        }

        .kembali a {
            text-decoration: none;
            color: #000;
        }

        .kembali a:hover {
            text-decoration: none;
            color: #d3d3d3;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #f0f0f0;
        }

        .containerr {
            max-width: 400px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
        }

        .adminpage a {
            display: block;
            margin: 10px auto;
            text-align: center;
            color: #8b0000;
            text-decoration: none;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }

        p {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type='text'],
        input[type='password'] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .remember-me input {
            margin-right: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #8b0000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 0.8em;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container d-flex">
            <a class="navbar-brand" href="/"><img src="./asset-navigasi-footer/Bazar_Logo.png" alt="Navbar Logo" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#daftar-bazar">Daftar Bazar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="halamantentangkami.php">Tentang Kami</a>
                    </li>
                </ul>

                <div class="sosmed d-flex flex-row justify-content-center">
                    <a class="nav-link" href="https://www.instagram.com/accounts/login/">
                        <i class="fab fa-instagram" style="color: #6D2932; font-size: 25px;"></i>
                    </a>
                    <a class="nav-link" href="https://www.whatsapp.com/">
                        <i class="fab fa-whatsapp" style="color: #6D2932; font-size: 25px;"></i>
                    </a>
                    <a class="nav-link" href="https://facebook.com/login/">
                        <i class="fab fa-facebook" style="color: #6D2932; font-size: 25px;"></i>
                    </a>
                    <a class="nav-link" href="login.php">
                        <i class="fas fa-circle-user" style="color: #6D2932; font-size: 25px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="kembali">
        <a href="index.php">Kembali</a>
    </div>

    <div class="containerr">
        <h1>Login</h1>
        <p>Login ini hanya untuk Admin!</p>

        <!-- Tampilkan error jika ada -->
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif ?>

        <!-- Form dengan method post -->
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Masukkan Username" required name="username" value="<?php echo isset($inputUsername) ? $inputUsername : ''; ?>" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Masukkan Password" required name="password" value="<?php echo isset($inputPassword) ? $inputPassword : ''; ?>" />
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember" <?php echo (isset($_COOKIE['username']) && isset($_COOKIE['password'])) ? 'checked' : ''; ?> />
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <div class="footer">
        <p>Copyright RAC 2024, All Rights Reserved</p>
    </div>
</body>

</html>