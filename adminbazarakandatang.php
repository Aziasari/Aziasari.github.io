<?php
require 'koneksi.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="adminbazzarkonten.css" />
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

    <title>Admin Dashboard</title>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white">
        <div class="container">
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
                        <a class="nav-link" href="index.html">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#daftar-bazar">Daftar Bazar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="halamantentangkami.html">Tentang Kami</a>
                    </li>
                </ul>
                <div class="sosmed d-flex flex-row justify-content-center">
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
                    <a class="nav-link" href="login.html">
                        <i
                            class="fas fa-circle-user"
                            style="color: #6d2932; font-size: 25px"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Page Title -->
    <div class="adminpage">
        <a href="adminplh.html">Kembali</a>
    </div>

    <div style="margin-bottom: 40px" class="juduladmin">
        <h1>Admin</h1>
    </div>

    <!-- Nav tabs -->

    <!-- Admin Container -->
    <div class="container">
        <div class="nantab">
            <ul>
                <li>
                    <a href="adminsatini.html"> Input Bazar Saat Ini</a>
                </li>
                <li style="background-color: rgb(235, 235, 235)">
                    <a href="#">Input Bazar yang akan datang</a>
                </li>
                <li>
                    <a href="pelaporan.php">Pelaporan</a>
                </li>
            </ul>
        </div>
        <!-- Nav tabs -->

        <!-- Tab content -->
        <div class="tab-content" id="myTabContent">
            <!-- Form Section -->
            <h2 style="margin-top: 50px" class="text-center mb-4">
                Input Bazar yang akan datang
            </h2>
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Nama Kegiatan Bazar -->
                <div class="mb-3">
                    <label for="namaBazar" class="form-label">Nama Kegiatan Bazar</label>
                    <input
                        type="text"
                        class="form-control"
                        id="namaBazar"
                        placeholder="Masukkan Nama Kegiatan Bazar" />
                </div>

                <!-- Tanggal Bazar -->
                <div class="mb-3">
                    <label for="tanggalBazar" class="form-label">Tanggal Bazar</label>
                    <input
                        type="text"
                        class="form-control"
                        id="tanggalBazar"
                        placeholder="Contoh: 20 Mei 2024" />
                </div>

                <!-- Deskripsi Kegiatan -->
                <div class="mb-3">
                    <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                    <textarea
                        id="deskripsiKegiatan"
                        class="form-control"
                        rows="10"
                        placeholder="Masukkan Deskripsi Singkat Kegiatan"></textarea>
                </div>

                <!-- Tambahkan Gambar -->
                <div class="mb-3">
                    <label for="gambarBazar" class="form-label">Tambahkan Gambar</label>
                    <button type="button" class="btnconfirm">
                        Pilih Gambar
                    </button>
                </div>

                <!-- Footer Note -->
                <p class="text-center footernote">
                    Pastikan data yang dimasukkan sudah benar!
                </p>

                <!-- Simpan Button -->
                <div class="text-center">
                    <button type="submit" class="btnsimpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Admin Container -->
    <div class="footer">
        <p>Copyright RAC 2024, All Rights Reserved</p>
    </div>
</body>

</html>