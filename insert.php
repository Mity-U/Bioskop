<?php
include 'connection.php'; // memanggil koneksi dari kelas connection.php

// menggunakan prepared statement 
$stmt = $conn->prepare("INSERT INTO buku_tamu (name, email, isi) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $email, $isi);

if ($stmt->execute()) {

    // Jika berhasil akan langsung ke halam tampilData.php
    header("Location: tampildata.php");
} else {
    // Jika Gagal, tampilkan pesan error
    echo "Gagal input data: " . mysqli_error($conn);
}

$stmt->close();
?>