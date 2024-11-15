<?php
require 'koneksi.php';

if (isset($_POST["submit"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Cek apakah tabel sudah memiliki 1 baris data
        $cek_query = "SELECT COUNT(*) AS total FROM bazar_saat_ini";
        $cek_result = $conn->query($cek_query);
        $cek_row = $cek_result->fetch_assoc();
        $total = $cek_row['total'];

        if ($total == 1) {
            echo "<script>alert('Tidak bisa menyimpan data karena database sudah berisi data bazar. Harap hapus data saat ini sebelum menyimpan data baru.');</script>";
        } else {
            $nama_bazar = htmlspecialchars(trim($_POST['nama_bazar']));
            $kontak_penyelenggara = htmlspecialchars(trim($_POST['kontak_penyelenggara']));
            $tanggal = htmlspecialchars(trim($_POST['tanggal']));
            $lokasi = htmlspecialchars(trim($_POST['lokasi']));
            $waktu = htmlspecialchars(trim($_POST['waktu']));
            $biaya = htmlspecialchars(trim($_POST['biaya']));
            $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
            $kuota_peserta = htmlspecialchars(trim($_POST['kuota_peserta']));

            if ($_FILES["gambar"]["error"] == 4) {
                echo "<script> alert ('Gambar tidak ditemukan'); </script>";
            } else {
                $namafile = $_FILES['gambar']['name'];
                $tmpname = $_FILES['gambar']['tmp_name'];

                $validImageExtension = ['jpg', 'jpeg', 'png'];
                $imageExtension = explode('.', $namafile);
                $imageExtension = strtolower(end($imageExtension));
                if (!in_array($imageExtension, $validImageExtension)) {
                    echo "<script> alert ('Gambar tidak ditemukan'); </script>";
                } else {
                    $newImageName = uniqid() . '.' . $imageExtension;
                    $uploadDirectory = 'uploads/';
                    move_uploaded_file($tmpname, $uploadDirectory . $newImageName);

                    $stmt = $conn->prepare("INSERT INTO bazar_saat_ini (nama_bazar, kontak_penyelenggara, tanggal, lokasi, waktu, biaya, deskripsi, kuota_peserta, gambar_bazar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssssis", $nama_bazar, $kontak_penyelenggara, $tanggal, $lokasi, $waktu, $biaya, $deskripsi, $kuota_peserta, $newImageName);

                    if ($stmt->execute()) {
                        echo "<script> alert ('Data Berhasil Disimpan!'); document.location.href = 'adminplh.php'; </script>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                    $stmt->close();
                }
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="adminsatini.css" />
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
    <title>Admin - Bazar Saat Ini</title>
</head>

<body class="bg-gray-100">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container d-flex">
            <a class="navbar-brand" href="/">
                <img src="asset-nav/Bazar_Logo.png" alt="Navbar Logo" />
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
    <!--Navbar-->

    <!-- Page Title -->
    <div class="adminpage">
        <a href="adminplh.php">Kembali</a>
    </div>

    <div style="margin-bottom: 40px" class="juduladmin">
        <h1>Admin</h1>
    </div>

    <!-- Nav tabs -->

    <!-- Admin Container -->
    <div class="container">
        <div class="nantab">
            <ul>
                <li style="background-color: rgb(235, 235, 235)">
                    <a href="#.html"> Input Bazar Saat Ini</a>
                </li>
                <li>
                    <a href="adminbazarakandatang.php">Input Bazar yang akan datang</a>
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
                Input Bazar Saat Ini
            </h2>
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateImage()">
                <!-- Nama Kegiatan Bazar -->
                <div class="mb-3">
                    <label for="nama_bazar" class="form-label">Nama Kegiatan Bazar</label>
                    <input
                        type="text"
                        class="form-control"
                        id="nama_bazar"
                        name="nama_bazar"
                        placeholder="Masukkan Nama Kegiatan Bazar"
                        required />
                </div>
                <!-- Kontak Penyelenggara -->
                <div class="mb-3">
                    <label for="kontak_penyelenggara" class="form-label">Kontak Penyelenggara</label>
                    <input
                        type="text"
                        class="form-control"
                        id="kontak_penyelenggara"
                        name="kontak_penyelenggara"
                        placeholder="Contoh:08122345678"
                        required />
                </div>
                <!-- Tanggal Bazar -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Bazar</label>
                    <input
                        type="date"
                        class="form-control"
                        id="tanggal"
                        name="tanggal"
                        placeholder="Contoh: 20 Mei 2024"
                        required />
                </div>
                <!-- Lokasi Bazar -->
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi Bazar</label>
                    <input
                        type="text"
                        class="form-control"
                        id="lokasi"
                        name="lokasi"
                        placeholder="Masukkan Lokasi Bazar"
                        required />
                </div>
                <!-- Waktu Kegiatan -->
                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu Kegiatan</label>
                    <input
                        type="text"
                        class="form-control"
                        id="waktu"
                        name="waktu"
                        placeholder="Contoh: 09.00 - 18.00 WIB"
                        required />
                </div>
                <!-- Biaya Pendaftaran -->
                <div class="mb-3">
                    <label for="biaya" class="form-label">Biaya Pendaftaran</label>
                    <input
                        type="text"
                        class="form-control"
                        id="biaya"
                        name="biaya"
                        placeholder="Contoh: 100.000"
                        required />
                </div>
                <!-- Deskripsi Kegiatan -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        class="form-control"
                        rows="10"
                        placeholder="Masukkan Deskripsi Singkat Kegiatan"
                        required></textarea>
                </div>
                <!-- Kuota Peserta -->
                <div class="mb-3">
                    <label for="kuota_peserta" class="form-label">Kuota Peserta</label>
                    <input
                        type="text"
                        class="form-control"
                        id="kuota_peserta"
                        name="kuota_peserta"
                        placeholder="Contoh: 50"
                        required />
                </div>

                <!-- Tambahkan Gambar -->
                <div class="mb-3">
                    <label for="gambar_bazar" class="form-label" style="margin-top: 20px;">Tambahkan Gambar</label>
                    <img id="preview" src="" width="300" alt="" />
                    <input type="file" class="form-control d-none" id="gambar_bazar" name="gambar" onchange="previewImage(event)" />
                    <button type="button" class="btnconfirm" onclick="triggerFileInput()">
                        Pilih Gambar
                    </button>
                </div>

                <!-- Footer Note -->
                <p class="text-center footernote">
                    Pastikan data yang dimasukkan sudah benar!
                </p>

                <!-- Simpan Button -->
                <div class="text-center">
                    <button type="submit" name="submit" class="btnsimpan">Simpan</button>
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

<script>
    function triggerFileInput() {
        document.getElementById('gambar_bazar').click();
    }

    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
    }

    // Validate if image has been uploaded
    function validateImage() {
        const imageInput = document.getElementById('gambar_bazar');

        if (!imageInput.value) {
            alert("Harap tambahkan gambar sebelum melanjutkan..");
            return false;
        }

        // Check the file size (2 MB limit)
        const file = imageInput.files[0];

        // Validate file type (only allow images)
        const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
        if (!allowedTypes.includes(file.type)) {
            alert("Jenis file tidak didukung. Harap pilih gambar dengan format JPEG, PNG, atau JPG.");
            return false;
        }

        const maxSizeInMB = 2;
        if (file.size > maxSizeInMB * 1024 * 1024) { // Convert MB to bytes
            alert("Ukuran gambar terlalu besar. Harap pilih gambar yang ukurannya tidak lebih dari 2 MB.");
            return false;
        }

        return true;
    }
</script>