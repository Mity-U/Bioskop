<?php
// kelas ini akan digunakan jika terdapat error
if (isset($_GET['error'])) {
    $err = $_GET['error'];
    
    if ($err == "kosong") {
        echo "<p style='color:red;'>Semua kolom wajib diisi!</p>";
    } else if ($err == "format_email") {
        echo "<p style='color:red;'>Format Email salah! Contoh: user@mail.com</p>";
    } else if ($err == "gagal_insert") {
        echo "<p style='color:red;'>Terjadi kesalahan database.</p>";
    }
}
?>