
    <?php
    // koneksi.php
    $servername = "localhost"; // Sesuaikan dengan konfigurasi server Anda
    $username = "root";        // Username database
    $password = "";            // Password database
    $database = "bazzar"; // Nama database Anda

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $database);

    // Mengecek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . htmlspecialchars($conn->connect_error)); // Menghindari XSS
    }
