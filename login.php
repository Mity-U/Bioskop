<?php
session_start();
include 'connection.php';

if (isset($_POST['login'])) {
    // Ambil data dari form
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];

    // Cari user di database
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$user'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        // CARA A: Bandingkan langsung tanpa password_verify
        if ($pass == $data['password']) {
            // Jika benar, buat session
            $_SESSION['status_login'] = true;
            $_SESSION['admin_name'] = $data['username'];
            
            echo "<script>alert('Login Berhasil!'); window.location='admin.php';</script>";
        } else {
            echo "<script>alert('Password Salah!');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <style>
        body { background: #141414; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        form { background: #000; padding: 30px; border-radius: 10px; width: 300px; box-shadow: 0 0 10px rgba(255,0,0,0.5); }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #333; background: #222; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: red; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        button:hover { background: #b00; }
    </style>
</head>
<body>
    <form method="POST">
        <h2 style="text-align: center; color: red;">Admin Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
        <p style="text-align: center; font-size: 12px; margin-top: 15px;"><a href="index.php" style="color: #888; text-decoration: none;">Kembali ke Beranda</a></p>
    </form>
</body>
</html>