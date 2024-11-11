<?php
require 'koneksi.php';

$rows1 = mysqli_query($conn, "SELECT * FROM bazar_akan_datang");

// Ambil hanya data pertama
$row1 = mysqli_fetch_assoc($rows1);

$max_length = 200; // Tentukan panjang maksimal deskripsi

$deskripsi_akandatang = $row1['deskripsi'];

if (strlen($deskripsi_akandatang) > $max_length) {
    // Potong deskripsi dan tambahkan elipsis
    $deskripsi_akandatang = substr($deskripsi_akandatang, 0, $max_length) . '...';
}

// Menampilkan deskripsi yang telah dibatasi
echo "<p>$deskripsi_akandatang</p>";


$rows = mysqli_query($conn, "SELECT * FROM bazar_saat_ini");

// Ambil hanya data pertama
$row = mysqli_fetch_assoc($rows);

$max_length = 200; // Tentukan panjang maksimal deskripsi

// Ambil deskripsi dari data pertama
$deskripsi = $row['deskripsi'];

// Periksa apakah panjang deskripsi lebih dari batas yang ditentukan
if (strlen($deskripsi) > $max_length) {
    // Potong deskripsi dan tambahkan elipsis
    $deskripsi = substr($deskripsi, 0, $max_length) . '...';
}

// Menampilkan deskripsi yang telah dibatasi
echo "<p>$deskripsi</p>";

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Page</title>
    <link rel="stylesheet" href="beranda.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nokora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500&family=Jost:wght@400;700&family=Quicksand:wght@300;600&family=Roboto:wght@300;500&family=Shantell+Sans:wght@500&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

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
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#daftar-bazar">Daftar Bazar</a>
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

    <section class="hero-page" id="beranda"></section>
    <div class="hero">
        <div class="hero_group">
            <h1 style="font-family: 'Oleo Script'; font-size: 40px;">RAC</h1>
            <h1 style="color: #C7B7A3; font-size: 22px; margin-top: -5px; line-height: 36px;">Layanan Pendaftaran Online dan Promosi Bazar Pekanbaru</h1>
            <h1>Jangkau <span>peserta potensial</span> Anda bersama kami !</h1>
            <button class="hero-button" type="button">Hubungi Kami</button>
        </div>
        <div class="hero_group">
            <img src="asset-beranda/Bazar Hero Page 2.png" alt="Hero Image" />
        </div>
    </div>
    </section>

    <!-- Keuntungan -->
    <section class="keuntungan">
        <div class="keuntungan">
            <h2>Keuntungan yang <span>Anda Dapatkan</span></h2>

            <div class="keuntungan-group">
                <div class="keuntungan-group2">
                    <img src="asset-beranda/people.png" alt="people" />
                    <p>Bagi Anda penyelenggara bazar, layanan pendaftaran online yang memudahkan dalam mengelola data peserta dan menghemat waktu</p>
                </div>
                <div class="keuntungan-group2">
                    <img src="asset-beranda/collaboration.png" alt="collaboration" />
                    <p>Bagi Anda pelaku UMKM, memperluas jaringan bisnis, memperkuat citra merek, dan kesadaran publik terhadap produk Anda</p>
                </div>
                <div class="keuntungan-group2" style="width: 1180px;">
                    <img src="asset-beranda/checklist.png" alt="checklist" />
                    <p>Kemudahan penyebaran dan akses informasi bazar, serta proses pendaftaran yang sederhana</p>
                </div>
            </div>

            <a href="detailBazar.html">
                <button class="keuntungan-button" type="button">Daftar Sekarang</button>
            </a>
        </div>
    </section>

    <!-- Bazar saat ini -->
    <section class="latest-events">
        <div>
            <h2>Event Bazar Saat Ini</h2>
            <div class="latest-events-container" style="display: flex; flex-direction: column; align-items: center;">
                <?php foreach ($rows as $row) : ?>
                    <img style="width: 500px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);" src="uploads/<?php echo $row['gambar_bazar']; ?>" alt="<?php echo $row['nama_bazar']; ?>" class="latest-events-image" />
                    <h3 style="width: 700px;" href="#"><?php echo $row['nama_bazar']; ?></h3>
                    <p style="width: 800px;"><?php echo $deskripsi ?></p>
                <?php endforeach; ?>

                <a href="detailBazar.php">
                    <button class="keuntungan-button" type="button">Daftar Sekarang</button>
                </a>
            </div>
        </div>
    </section>

    <!-- Bazar yang akan datang -->
    <section class="list-bazar" id="daftar-bazar">
        <div>
            <h2>Event Bazar yang akan Datang</h2>
        </div>
        <?php foreach ($rows1 as $row1) : ?>
            <div class="bazar-group">
                <div class="event-group">
                    <img src="uploadakandatang/<?php echo $row1["gambar_bazar_akandatang"] ?>">
                    <div>
                        <p class="date">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" style="margin-right: 10px;">
                                <g clip-path="url(#clip0_434_132)">
                                    <path d="M11.25 0.5C14.0348 0.5 16.7055 1.60625 18.6746 3.57538C20.6438 5.54451 21.75 8.21523 21.75 11C21.75 13.7848 20.6438 16.4555 18.6746 18.4246C16.7055 20.3938 14.0348 21.5 11.25 21.5C8.46523 21.5 5.79451 20.3938 3.82538 18.4246C1.85625 16.4555 0.75 13.7848 0.75 11C0.75 8.21523 1.85625 5.54451 3.82538 3.57538C5.79451 1.60625 8.46523 0.5 11.25 0.5ZM2.71875 11C2.71875 13.2626 3.61758 15.4326 5.2175 17.0325C6.81742 18.6324 8.98737 19.5312 11.25 19.5312C13.5126 19.5312 15.6826 18.6324 17.2825 17.0325C18.8824 15.4326 19.7812 13.2626 19.7812 11C19.7812 8.73737 18.8824 6.56742 17.2825 4.9675C15.6826 3.36758 13.5126 2.46875 11.25 2.46875C8.98737 2.46875 6.81742 3.36758 5.2175 4.9675C3.61758 6.56742 2.71875 8.73737 2.71875 11ZM11.9062 6.73438V10.6614L14.568 11.7271C14.8026 11.8294 14.9881 12.0189 15.0853 12.2557C15.1824 12.4924 15.1836 12.7576 15.0886 12.9952C14.9935 13.2328 14.8097 13.424 14.576 13.5283C14.3424 13.6326 14.0773 13.6419 13.8369 13.5541L10.5557 12.2416C10.3733 12.1683 10.217 12.0422 10.1069 11.8794C9.9967 11.7167 9.93772 11.5247 9.9375 11.3281V6.73438C9.9375 6.4733 10.0412 6.22292 10.2258 6.03832C10.4104 5.85371 10.6608 5.75 10.9219 5.75C11.1829 5.75 11.4333 5.85371 11.6179 6.03832C11.8025 6.22292 11.9062 6.4733 11.9062 6.73438Z" fill="#B5B5B5" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_434_132">
                                        <rect width="21" height="21" fill="white" transform="translate(0.75 0.5)" />
                                    </clipPath>
                                </defs>
                            </svg> November 20, 2024
                        </p>
                        <a href="#"><?php echo htmlspecialchars($row1['nama_bazar']); ?></a>
                        <p><?php echo htmlspecialchars(substr($row1['deskripsi'], 0, 200)) . '...'; ?></p>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer">
            <div class="footer-group items1">
                <img src="asset-navigasi-footer/Bazar_Logo.png" alt="art-studio-logo" />
            </div>
            <div class="footer-group items2">
                <div class="footer-items about">
                    <p>Layanan pendaftaran online yang memudahkan Anda mengelola registrasi acara dan penyebaran informasi bazar</p>
                    <h6>Address</h6>
                    <p>Merpati No. 4, Pekanbaru, Indonesia</p>
                </div>
                <div class="footer-items general">
                    <h6>General</h6>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#daftar-bazar">Daftar Bazar</a></li>
                        <li><a href="halamantentangkami.php">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="footer-items social-media">
                    <h6>Follow Us</h6>
                    <div class="social-media-icons">
                        <a class="nav-link" href="https://www.instagram.com/accounts/login/">
                            <i class="fab fa-instagram" style="color: #000; font-size: 36px;"></i>
                        </a>
                        <a class="nav-link" href="https://www.whatsapp.com/">
                            <i class="fab fa-whatsapp" style="color: #000; font-size: 36px;"></i>
                        </a>
                        <a class="nav-link" href="https://facebook.com/login/">
                            <i class="fab fa-facebook" style="color: #000; font-size: 36px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>Copyright RAC 2024, All Rights Reserved</p>
        </div>
    </footer>

</body>

</html>