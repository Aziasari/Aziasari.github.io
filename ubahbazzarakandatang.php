<?php
require 'koneksi.php';

$bazar_id = null;
$bazar = null;

// Cek apakah ada bazar_id di URL untuk mengedit
if (isset($_GET['bazar_id'])) {
    $bazar_id = $_GET['bazar_id'];
    // Query untuk mendapatkan detail bazar berdasarkan bazar_id
    $query = "SELECT * FROM bazar_akan_datang WHERE bazar_id = $bazar_id";
    $result = mysqli_query($conn, $query);
    $bazar = mysqli_fetch_assoc($result);
}

function upload()
{

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    //cek apakah ada file diupload

    if ($error === 4) {
        echo "<script>
          alert('Pilih gambar terlebih dahulu');
          </script>";
        return false;
    }

    //cek apakah yang diupload itu gambar atau bukan

    $ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ekstensigambar = explode('.', $namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
        echo "<script>
        alert('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // cek ukuran gambar

    if ($ukuranfile > 1000000) {
        echo "<script>
        alert('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    // lolos pengecakan gambar siap diubload
    //generate nama gambar baru

    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpname, 'img/' . $namafilebaru);

    return $namafilebaru;
}

// Proses update data
if (isset($_POST["submit"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_kegiatan_bazzar = $_POST['nama_kegiatan_bazzar'];
        $tanggal_bazzar = $_POST['tanggal_bazzar'];
        $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
        $gambar_lama = $_POST['gambarlama'];

        // Upload gambar terlebih dahulu
        $gambar = upload(); // Fungsi upload harus didefinisikan sebelumnya
        if (!$gambar) {
            $gambar = $gambar_lama; // Jika tidak ada gambar baru, gunakan gambar lama
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
            // Update query
            $sql = "UPDATE bazar_akan_datang SET 
                        nama_bazar = '$nama_kegiatan_bazzar', 
                        tanggal = '$tanggal_bazzar', 
                        deskripsi = '$deskripsi_kegiatan', 
                        gambar_bazar = '$gambar' 
                    WHERE bazar_id = $bazar_id";

            if ($conn->query($sql) === TRUE) {
                echo "
                <script>
                   alert('Data berhasil diupdate');
                   document.location.href = 'adminplh.php';
                </script>
               ";
            } else {
                echo "
                <script>
                   alert('Data gagal diupdate');
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

    <div class="adminpage">
        <a href="adminplh.html">Kembali</a>
    </div>

    <div style="margin-bottom: 40px" class="juduladmin">
        <h1>Admin</h1>
    </div>

    <div class="container">
        <h2 style="margin-top: 50px" class="text-center mb-4">
            Input Bazar yang akan datang
        </h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gambarlama" value="<?php echo $bazar['gambar_bazar']; ?>">
            <input type="hidden" name="id" value="<?php echo $bazar_id; ?>">
            <!-- Nama Kegiatan Bazar -->
            <div class="mb-3">
                <label for="namaBazar" class="form-label">Nama Kegiatan Bazar</label>
                <input type="text" class="form-control" id="namaBazar" placeholder="Masukkan Nama Kegiatan Bazar" name="nama_kegiatan_bazzar" value="<?php echo htmlspecialchars($bazar['nama_bazar']); ?>" required />
            </div>

            <!-- Tanggal Bazar -->
            <div class="mb-3">
                <label for="tanggalBazar" class="form-label">Tanggal Bazar</label>
                <input type="date" class="form-control" id="tanggalBazar" name="tanggal_bazzar" value="<?php echo htmlspecialchars($bazar['tanggal']); ?>" required />
            </div>

            <!-- Deskripsi Kegiatan -->
            <div class="mb-3">
                <label for="deskripsiKegiatan" class="form-label">Deskripsi Kegiatan</label>
                <textarea id="deskripsiKegiatan" class="form-control" rows="10" name="deskripsi_kegiatan" required><?php echo htmlspecialchars($bazar['deskripsi']); ?></textarea>
            </div>

            <!-- Tambahkan Gambar -->
            <div class="mb-3">
                <label for="gambarBazar" class="form-label">Tambahkan Gambar</label>
                <img id="preview" src="<?php echo htmlspecialchars($bazar['gambar_bazar']); ?>" width="300" alt="" />
                <input type="file" class="form-control d-none" id="gambarBazar" name="gambar" onchange="previewImage(event)" />
                <button type="button" class="btnconfirm" onclick="document.getElementById('gambarBazar').click();">
                    Pilih Gambar
                </button>
            </div>

            <div class="text-center">
                <button type="submit" name="submit" class="text-white rounded-md py-2 px-4 btnsimpan">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const image = document.getElementById('preview');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>