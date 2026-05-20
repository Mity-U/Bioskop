<?php
session_start();
include 'connection.php';

// Proteksi Halaman Admin
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}

// Logika Tambah Film
if (isset($_POST['tambah'])) {
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $sinopsis = mysqli_real_escape_string($conn, $_POST['sinopsis']);
    $durasi   = $_POST['durasi'];
    $genre    = $_POST['genre'];
    $poster   = $_FILES['poster']['name'];
    $tmp_name = $_FILES['poster']['tmp_name'];

    if (move_uploaded_file($tmp_name, "assets/" . $poster)) {
        mysqli_query($conn, "INSERT INTO films (judul, sinopsis, durasi, genre, poster) 
                             VALUES ('$judul', '$sinopsis', '$durasi', '$genre', '$poster')");
        echo "<script>alert('Film Berhasil Ditambah!'); window.location='admin.php';</script>";
    }
}

// Logika Hapus Film
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $cek = mysqli_query($conn, "SELECT poster FROM films WHERE id = $id");
    $data = mysqli_fetch_assoc($cek);
    
    if(file_exists("assets/".$data['poster'])) {
        unlink("assets/".$data['poster']);
    }

    mysqli_query($conn, "DELETE FROM films WHERE id = $id");
    header("Location: admin.php");
}

$films = mysqli_query($conn, "SELECT * FROM films ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - BlueCinema</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<header>
    <h2>BlueCinema Admin</h2>
    <a href="logout.php" style="color: white; text-decoration: none; border: 1px solid white; padding: 5px 15px; border-radius: 20px; font-size: 14px;">Logout</a>
</header>

<div class="wrapper">
    <section class="card-panel">
        <h3>Input Film Baru</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="judul" placeholder="Judul Film" required>
            <textarea name="sinopsis" placeholder="Tulis sinopsis film di sini..." rows="4" required></textarea>
            
            <div style="display: flex; gap: 15px;">
                <input type="number" name="durasi" placeholder="Durasi (Menit)" required>
                <select name="genre">
                    <option value="Action">Action</option>
                    <option value="Horror">Horror</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Drama">Drama</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                </select>
            </div>
            
            <label style="display:block; margin-top:10px; color:#555;">Upload Poster:</label>
            <input type="file" name="poster" accept="image/*" required>
            
            <button type="submit" name="tambah" class="btn-submit">Simpan ke Database</button>
        </form>
    </section>

    <section class="card-panel">
        <h3>Daftar Koleksi Film</h3>
        <table>
            <thead>
                <tr>
                    <th>Poster</th>
                    <th>Judul Film</th>
                    <th>Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($films)): ?>
                <tr>
                    <td><img src="assets/<?= $row['poster'] ?>" width="45" style="border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></td>
                    <td><strong><?= $row['judul'] ?></strong></td>
                    <td><?= $row['genre'] ?></td>
                    <td>
                        <a href="admin.php?hapus=<?= $row['id'] ?>" class="btn-del" onclick="return confirm('Apakah Anda yakin ingin menghapus film ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</div>

</body>
</html>