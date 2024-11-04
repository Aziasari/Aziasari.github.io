<?php
require 'koneksi.php';

// Fetch data from the bazar_akan_datang table
$query = "SELECT bazar_id, nama_bazar FROM bazar_akan_datang";
$result = mysqli_query($conn, $query);

if (isset($_POST['delete_bazar'])) {
    $bazar_name = $_POST['bazar_name'];

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM bazar_akan_datang WHERE nama_bazar = ?");
    $stmt->bind_param("s", $bazar_name);

    if ($stmt->execute()) {
        // Redirect back to the same page to see the updated list
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
    <link rel="stylesheet" href="adminplh.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nokora:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@500&family=Jost:wght@400;700&family=Quicksand:wght@300;600&family=Roboto:wght@300;500&family=Shantell+Sans:wght@500&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="header">
        <img src="asset-nav/Bazar_Logo.png" alt="Logo" class="logo">
        <div class="nav-links">
            <a class="nav-link" href="index.html">Beranda</a>
            <a class="nav-link" href="index.html#daftar-bazar">Daftar Bazzar</a>
            <a class="nav-link" href="halamantentangkami.html">Tentang Kami</a>
        </div>
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
            <a class="nav-link" href="#">
                <i class="fas fa-circle-user" style="color: #6D2932; font-size: 25px;"></i>
            </a>
        </div>
    </div>

    <div class="container">
        <h1>Admin</h1>
        <button class="btn" onclick="window.location.href='adminsatini.html'">Tambah Bazar</button>
        <h2>Bazar saat ini</h2>
        <ul class="bazar-list">
            <li class="bazar-item">
                <span>Bazar Tahunan: "Menyalurkan Kreativitas UMKM Pekanbaru"</span>
                <div class="bazar-actions">
                    <span class="icon edit-icon">✏️</span>
                    <span class="icon delete-icon">🗑️</span>
                </div>
            </li>
        </ul>
        <h2>Bazar yang akan datang</h2>
        <ul class="bazar-list">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="bazar-item">';
                    echo '<span>' . htmlspecialchars($row['nama_bazar']) . '</span>';
                    echo '<div class="bazar-actions">';
                    // Memperbarui tautan edit untuk menyertakan bazar_id
                    echo '<a href="ubahbazzarakandatang.php?bazar_id=' . urlencode($row['bazar_id']) . '" class="icon edit-icon"> ✏️</a>';
                    echo '<span class="icon delete-icon" onclick="confirmDelete(\'' . htmlspecialchars($row['nama_bazar']) . '\')">🗑️</span>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo '<li class="bazar-item">Tidak ada bazar yang akan datang.</li>';
            }
            ?>
        </ul>
    </div>

    <form id="deleteForm" method="POST" action="">
        <input type="hidden" name="bazar_name" id="bazar_name">
        <input type="hidden" name="delete_bazar" value="1">
    </form>

    <div class="footer">
        <p>Copyright RAC 2024, All Rights Reserved</p>
    </div>

    <script>
        function confirmDelete(bazarName) {
            if (confirm('Apakah Anda yakin ingin menghapus bazar ini?')) {
                document.getElementById('bazar_name').value = bazarName;
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</body>

</html>