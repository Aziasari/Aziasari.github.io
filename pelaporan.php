<?php
require 'koneksi.php'; // Menyertakan file koneksi database
require 'vendor/autoload.php'; // Autoload dari PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Hapus 'use TCPDF;' jika TCPDF dipanggil tanpa namespace

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['convert_to_pdf'])) {
    // Hapus semua output buffer untuk memastikan PDF tidak rusak
    if (ob_get_length()) {
        ob_end_clean();
    }

    // Membuat instance TCPDF baru
    $pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT); // 'L' untuk orientasi landscape

    // Mengatur metadata dokumen
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Admin');
    $pdf->SetTitle('Laporan Pendaftaran UMKM');

    // Menambahkan halaman baru
    $pdf->AddPage();

    // Konten tabel
    $html = '<h2>Laporan Data Pendaftaran UMKM</h2>
             <table border="1" cellpadding="5">
                 <thead>
                     <tr>
                         <th>No.</th>
                         <th>Nama Pelaku UMKM</th>
                         <th>Nama UMKM</th>
                         <th>Jenis UMKM</th>
                         <th>Nomor HP</th>
                         <th>Email</th>
                         <th>Alamat</th>
                     </tr>
                 </thead>
                 <tbody>';

    // Query untuk mengambil data dari tabel pendaftaran
    $sql = "SELECT * FROM pendaftaran";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $no = 1;
        while ($data = $result->fetch_assoc()) {
            $html .= '<tr>
                         <td>' . $no++ . '</td>
                         <td>' . htmlspecialchars($data['nama_pelaku_umkm']) . '</td>
                         <td>' . htmlspecialchars($data['nama_umkm']) . '</td>
                         <td>' . htmlspecialchars($data['jenis_umkm']) . '</td>
                         <td>' . htmlspecialchars($data['nomor_telpon']) . '</td>
                         <td>' . htmlspecialchars($data['email_pelaku_umkm']) . '</td>
                         <td>' . htmlspecialchars($data['alamat']) . '</td>
                      </tr>';
        }
    } else {
        $html .= '<tr><td colspan="7">Tidak ada data pendaftaran.</td></tr>';
    }

    $html .= '</tbody></table>';

    // Menulis konten HTML ke PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Output PDF ke browser
    $pdf->Output('data_pendaftaran.pdf', 'D');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menghapus semua output buffer untuk memastikan file Excel tidak rusak
    if (ob_get_length()) ob_end_clean();

    // Membuat objek Spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header kolom untuk file Excel
    $sheet->setCellValue('A1', 'No.');
    $sheet->setCellValue('B1', 'Nama Pelaku UMKM');
    $sheet->setCellValue('C1', 'Nama UMKM');
    $sheet->setCellValue('D1', 'Jenis UMKM');
    $sheet->setCellValue('E1', 'Nomor HP');
    $sheet->setCellValue('F1', 'Email');
    $sheet->setCellValue('G1', 'Alamat');

    // Query untuk mengambil data dari tabel pendaftaran
    $sql = "SELECT * FROM pendaftaran";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2;
        $no = 1;

        // Mengisi data dari database ke Excel
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $data['nama_pelaku_umkm']);
            $sheet->setCellValue('C' . $row, $data['nama_umkm']);
            $sheet->setCellValue('D' . $row, $data['jenis_umkm']);
            $sheet->setCellValue('E' . $row, $data['nomor_telpon']);
            $sheet->setCellValue('F' . $row, $data['email_pelaku_umkm']);
            $sheet->setCellValue('G' . $row, $data['alamat']);
            $row++;
        }

        // Menyimpan dan mengirim file Excel ke output
        $filename = 'data_pendaftaran.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } else {
        echo "Tidak ada data pendaftaran untuk diekspor.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="pelaporan.css" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nokora:wght@700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500&family=Jost:wght@400;700&family=Quicksand:wght@300;600&family=Roboto:wght@300;500&family=Shantell+Sans:wght@500&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title>Admin Dashboard</title>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
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
                        <i class="fab fa-instagram" style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="https://www.whatsapp.com/">
                        <i class="fab fa-whatsapp" style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="https://facebook.com/login/">
                        <i class="fab fa-facebook" style="color: #6d2932; font-size: 25px"></i>
                    </a>
                    <a class="nav-link" href="login.php">
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

    <!-- Admin Content -->
    <div class="container">
        <div style="margin-bottom: 40px" class="juduladmin">
            <h1>Pelaporan</h1>
        </div>

        <!-- Nav tabs -->
        <div class="nantab">
            <ul>
                <li>
                    <a href="adminsatini.php"> Input Bazar Saat Ini</a>
                </li>
                <li>
                    <a href="adminbazarakandatang.php">Input Bazar yang akan datang</a>
                </li>
                <li style="background-color: rgb(235, 235, 235)">
                    <a href="#">Pelaporan</a>
                </li>
            </ul>
        </div>
        <!-- Nav tabs -->

        <!-- Tab content -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="input-bazar-saat-ini" role="tabpanel" aria-labelledby="input-bazar-saat-ini-tab">
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pelaku UMKM</th>
                                <th>Nama UMKM</th>
                                <th>Jenis UMKM</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menampilkan data dari database dalam tabel
                            $sql = "SELECT * FROM pendaftaran";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                $no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_pelaku_umkm']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_umkm']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jenis_umkm']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nomor_telpon']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email_pelaku_umkm']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Tidak ada data pendaftaran.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center mt-4">
                <form method="post">
                    <button style="font-weight: bold" type="submit" class="buttonform">
                        Convert To Excel
                    </button>
                </form>
            </div>

            <div class="text-center mt-4">
                <form method="post">
                    <button name="convert_to_pdf" style="font-weight: bold" type="submit" class="buttonform">
                        Convert To PDF
                    </button>
                </form>
            </div>
        </div>
        <!-- Tab content -->
    </div>
    <!-- Admin Content -->
</body>

</html>