<?php
require 'koneksi.php';

// Define the upload function first
function upload()
{
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    // Check if a file was uploaded
    if ($error === 4) {
        echo "<script>
              alert('Pilih gambar terlebih dahulu');
              </script>";
        return false;
    }

    // Check if the uploaded file is an image
    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script>
              alert('Yang anda upload bukan gambar');
              </script>";
        return false;
    }

    // Check the size of the uploaded image
    if ($ukuranfile > 1000000) {
        echo "<script>
              alert('Ukuran gambar terlalu besar, maksimum 1MB');
              </script>";
        return false;
    }

    // Generate a new file name and upload the file
    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpname, 'img/' . $namafilebaru);

    return $namafilebaru;
}

if (isset($_POST["submit"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        var_dump($_POST);
        $nama_kegiatan_bazzar = $_POST['nama_kegiatan_bazzar'];
        $tanggal_bazzar = $_POST['tanggal_bazzar'];
        $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];

        // Upload gambar terlebih dahulu
        $gambar = upload();
        if (!$gambar) {
            return false;
        }

        // Validate required fields
        if (empty($nama_kegiatan_bazzar) || empty($tanggal_bazzar) || empty($deskripsi_kegiatan)) {
            echo "
                <script>
                   alert('isi penuh');
                   document.location.href = 'adminbazarakandatang.php';
                </script>
               ";
        } else {
            $sql = "INSERT INTO bazar_akan_datang (nama_bazar, tanggal, deskripsi, gambar_bazar) VALUES ('$nama_kegiatan_bazzar', '$tanggal_bazzar', '$deskripsi_kegiatan', '$gambar')";

            if ($conn->query($sql) === TRUE) {
                echo "
                <script>
                   alert('Data berhasil ditambahkan');
                   document.location.href = 'adminplh.php';
                </script>
               ";
            } else {
                echo "
                <script>
                   alert('Data gagal ditambahkan');
                   document.location.href = 'adminbazarakandatang.php';
                </script>
               ";
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
    <link rel="stylesheet" href="adminbazzarkonten.css" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nokora:wght@700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500&family=Jost:wght@400;700&family=Quicksand:wght@300;600&family=Roboto:wght@300;500&family=Shantell+Sans:wght@500&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Admin Dashboard</title>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="images/Bazar_Logo.png" alt="Navbar Logo" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="https://www.instagram.com/accounts/login/">
                        <i class="fab fa-instagram" style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="https://www.whatsapp.com/">
                        <i class="fab fa-whatsapp" style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="https://facebook.com/login/">
                        <i class="fab fa-facebook" style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="login.html">
                        <i class="fas fa-circle-user" style="color: #6d2932; font-size: 25px"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Page Title -->
    <div class="adminpage">
        <a href="adminplh.php">Kembali</a>
    </div>

    <div style="margin-bottom: 40px" class="juduladmin">
        <h1>Admin</h1>
    </div>

    <!-- Admin Container -->
    <div class="container">
        <div class="nantab">
            <ul>
                <li>
                    <a href="adminsatini.php"> Input Bazar Saat Ini</a>
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
                    <input type="text" class="form-control" id="namaBazar" placeholder="Masukkan Nama Kegiatan Bazar" name="nama_kegiatan_bazzar" />
                </div>

                <!-- Tanggal Bazar -->
                <div class="mb-3">
                    <label for="tanggalBazar" class="form-label">Tanggal Bazar</label>
                    <input type="date" class="form-control" id="tanggalBazar" placeholder="Contoh: 20 Mei 2024" name="tanggal_bazzar" />
                </div>

                <!-- Deskripsi Kegiatan -->
                <div class="mb-3">
                    <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                    <textarea id="deskripsiKegiatan" class="form-control" rows="10" placeholder="Masukkan Deskripsi Singkat Kegiatan" name="deskripsi_kegiatan"></textarea>
                </div>

                <!-- Tambahkan Gambar -->
                <div class="mb-3">
                    <label for="gambarBazar" class="form-label">Tambahkan Gambar</label>
                    <img id="preview" src="" width="300" alt="" />
                    <input type="file" class="form-control d-none" id="gambarBazar" name="gambar" onchange="previewImage(event)" />
                    <button type="button" class="btnconfirm" onclick="document.getElementById('gambarBazar').click();">
                        Pilih Gambar
                    </button>
                </div>

                <div class="text-center">
                    <button
                        type="submit" name="submit"
                        class="text-white rounded-md py-2 px-4 btnsimpan" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <!-- Tab content -->
    </div>
    <!-- Admin Container -->

    <script>
        function previewImage(event) {
            const image = document.getElementById('preview');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>