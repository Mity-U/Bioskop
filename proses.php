<?php
// Memeriksa apakah user menekan tombol submit
if (isset($_POST['submit'])) {
    // mengambil data dari form
    $nama  = $_POST['nama'];   
    $email = $_POST['email'];
    $isi   = $_POST['isi'];

    // Memeriksa apakah nama atau email kosong
    if (empty($nama) || empty($email)) {
        header("Location: form.php?error=Nama dan Email wajib diisi!");
        exit();
    } 
    
    // Memeriksa format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: form.php?error=Format Email salah! Contoh: nama@email.com");
        exit();
    }

    // Jika semua data yang diinput user benar maka akan memanggil kelas insert.php
    include 'insert.php';
} else {

    header("Location: form.php");
}
?>