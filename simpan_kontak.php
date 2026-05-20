<?php
// Tarik file koneksi biar script ini bisa ngobrol sama database
include 'connection.php'; 

// Ambil semua data yang diketik user di form kontak.html lewat metode POST
$vnama = $_POST['nama'];     // Simpan input nama ke variabel $vnama
$vjkel = $_POST['jkel'];     // Simpan input jenis kelamin ke variabel $vjkel
$vemail = $_POST['email'];   // Simpan input email ke variabel $vemail
$valamat = $_POST['alamat']; // Simpan input alamat ke variabel $valamat
$vkota = $_POST['kota'];     // Simpan input kota ke variabel $vkota
$vpesan = $_POST['pesan'];   // Simpan isi pesan ke variabel $vpesan

// Susun perintah SQL buat masukin data-data tadi ke tabel 'kontak'
$sql = "INSERT INTO kontak (nama, jkel, email, alamat, kota, pesan) 
        VALUES ('$vnama', '$vjkel', '$vemail', '$valamat', '$vkota', '$vpesan')";

// Jalanin perintah SQL-nya ke database pake koneksi $conn
if ($conn->query($sql) === TRUE) {
    // Kalau berhasil kesimpen, tutup koneksinya biar gak boros resource
    $conn->close();
    // Balikin user ke halaman kontak.html sambil kasih tanda 'sukses' di URL
    header("location:kontak.html?status=sukses");
} else {
    // Kalau ada yang error, tampilin pesannya biar tau salahnya di mana
    echo "Error: " . $sql . "<br>" . $conn->error;
    $conn->close(); // Tetep tutup koneksi biarpun gagal
}
?>