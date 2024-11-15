<?php
$modalBerhasil = false;
$modalGagal = false;
require 'koneksi.php';


if (isset($_POST["submit"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_pelaku_umkm = $_POST['nama_pelaku_umkm'];
        $nama_umkm = $_POST['nama_umkm'];
        $jenis_umkm = $_POST['jenis_umkm'];
        $nomor_telpon = $_POST['nomor_telpon'];
        $email_pelaku_umkm = $_POST['email_pelaku_umkm'];
        $alamat = $_POST['alamat'];

        if (empty($nama_pelaku_umkm) || empty($nama_umkm) || empty($jenis_umkm) || empty($nomor_telpon) || empty($email_pelaku_umkm) || empty($alamat)) {
            $modalGagal = true;
        } else {
            $sql = "INSERT INTO pendaftaran (nama_pelaku_umkm, nama_umkm, jenis_umkm, nomor_telpon, email_pelaku_umkm, alamat) VALUES ('$nama_pelaku_umkm', '$nama_umkm', '$jenis_umkm', '$nomor_telpon', '$email_pelaku_umkm', '$alamat')";

            if ($conn->query($sql) === TRUE) {
                $modalBerhasil = true;
            } else {
                $modalGagal = true;
            }
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="halamanpendaftaran.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nokora:wght@700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Hind:wght@500&family=Jost:wght@400;700&family=Quicksand:wght@300;600&family=Roboto:wght@300;500&family=Shantell+Sans:wght@500&family=Ubuntu:wght@400;500;700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body class="flex justify-center items-center min-h-screen bg-gray-100">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container d-flex">
            <a class="navbar-brand" href="/">
                <img src="images/Bazar_Logo.png" alt="Navbar Logo" />
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarText"
                aria-controls="navbarText"
                aria-expanded="false"
                aria-label="Toggle navigation">
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
                    <!-- Sosmed Icons -->
                    <a
                        class="nav-link"
                        href="https://www.instagram.com/accounts/login/">
                        <i
                            class="fab fa-instagram"
                            style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="https://www.whatsapp.com/">
                        <i
                            class="fab fa-whatsapp"
                            style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="https://facebook.com/login/">
                        <i
                            class="fab fa-facebook"
                            style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <!-- Icon User dengan gambar eksternal -->
                    <a class="nav-link" href="login.php">
                        <i
                            class="fas fa-circle-user"
                            style="color: #6d2932; font-size: 25px"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!--Navbar-->

    <!--Pendaftaran-->
    <div
        class="container max-w-lg mx-auto p-8 bg-white shadow-md rounded-md"
        style="margin-bottom: 200px">
        <h1
            class="text-center"
            style="
            margin-top: 250px;
            color: #000;
            text-align: center;
            font-family: 'Fredoka';
            font-size: 32px;
            font-weight: 400;
            line-height: 30px;
          ">
            Pendaftaran
        </h1>
        <p class="text-center mb-6">
            Isilah formulir berikut untuk mendaftar sebagai peserta
        </p>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="nama-pelaku" class="form-label">Nama Pelaku UMKM</label>
                <input
                    type="text"
                    class="form-control custom-input"
                    id="nama-pelaku"
                    placeholder="Masukkan Nama Anda"
                    name="nama_pelaku_umkm" />
            </div>

            <div class="mb-4">
                <label for="nama-umkm" class="form-label">Nama UMKM</label>
                <input
                    type="text"
                    class="form-control custom-input"
                    id="nama-umkm"
                    placeholder="Masukkan Nama UMKM"
                    name="nama_umkm" />
            </div>

            <div class="mb-4">
                <label for="jenis-umkm" class="form-label">Jenis UMKM</label>
                <select class="form-select custom-input" id="jenis-umkm" name="jenis_umkm" required>
                    <option selected>Pilih Jenis UMKM</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Kerajinan">Kerajinan</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="nomor-hp" class="form-label">Nomor Handphone</label>
                <input
                    type="text"
                    class="form-control custom-input"
                    id="nomor-hp"
                    placeholder="Masukkan Nomor Handphone"
                    name="nomor_telpon" />
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control custom-input"
                    id="email"
                    placeholder="Masukkan Email Anda"
                    name="email_pelaku_umkm" />
            </div>

            <div class="mb-4">
                <label for="alamat" class="form-label">Alamat</label>
                <input
                    type="text"
                    class="form-control custom-input"
                    id="alamat"
                    placeholder="Masukkan Alamat Anda"
                    name="alamat" />
            </div>

            <p class="text-center text-gray-500 mb-4" style="margin-top: 100px">
                Pastikan data yang Anda masukkan sudah benar!
            </p>

            <div class="text-center">
                <button
                    type="submit" name="submit"
                    class="text-white rounded-md py-2 px-4 buttonform" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Daftar
                </button>
            </div>
        </form>
    </div>

    <!-- Popup -->
    <section class="popup-modal">
        <!-- Modal Berhasil -->
        <div class="modal fade <?= $modalBerhasil ? 'show' : '' ?>" id="modalBerhasil" tabindex="-1" aria-labelledby="modalBerhasilLabel" aria-hidden="<?= $modalBerhasil ? 'false' : 'true' ?>" style="<?= $modalBerhasil ? 'display: block;' : 'display: none;' ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <i class="fa-regular fa-circle-check"></i>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Data Berhasil disimpan</h5>
                    </div>
                    <div class="modal-body">
                        Silakan tunggu pesan konfirmasi dari WhatsApp atau email Anda.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-white" data-bs-dismiss="modal" onclick="window.location.href='detailbazar.php';">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Gagal -->
        <div class="modal fade <?= $modalGagal ? 'show' : '' ?>" id="modalGagal" tabindex="-1" aria-labelledby="modalGagalLabel" aria-hidden="<?= $modalGagal ? 'false' : 'true' ?>" style="<?= $modalGagal ? 'display: block;' : 'display: none;' ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <i class="fa-solid fa-circle-exclamation" style="color: #ab162a;"></i>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Data Anda Belum Benar!</h5>
                    </div>
                    <div class="modal-body">
                        Pastikan mengisi data dengan benar dan tidak ada yang kosong.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-white" data-bs-dismiss="modal" onclick="window.location.href='halamanpendaftaran.php';">OK</button>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="footer-group items1">
                <img src="images/Bazar_Logo.png" alt="art-studio-logo" />
            </div>
            <div class="footer-group items2">
                <div class="footer-items about">
                    <p>
                        Layanan pendaftaran online yang memudahkan Anda mengelola
                        registrasi acara dan penyebaran informasi bazar
                    </p>
                    <h6>Address</h6>
                    <p>Merpati No. 4, Pekanbaru, Indonesia</p>
                </div>
                <div class="footer-items general">
                    <h6>General</h6>
                    <ul>
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="index.php#daftar-bazar">Daftar Bazar</a></li>
                        <li><a href="halamantentangkami.php">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="footer-items social-media">
                    <h6>Follow Us</h6>
                    <div class="social-media-icons">
                        <a
                            class="nav-link"
                            href="https://www.instagram.com/accounts/login/">
                            <i
                                class="fab fa-instagram"
                                style="color: #000; font-size: 36px"></i>
                        </a>
                        <a class="nav-link" href="https://www.whatsapp.com/">
                            <i
                                class="fab fa-whatsapp"
                                style="color: #000; font-size: 36px"></i>
                        </a>
                        <a class="nav-link" href="https://facebook.com/login/">
                            <i
                                class="fab fa-facebook"
                                style="color: #000; font-size: 36px"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>Copyright RAC 2024, All Rights Reserved</p>
        </div>
    </footer>
    <!-- Footer -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>

</body>

</html>