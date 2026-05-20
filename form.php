<!DOCTYPE html>
<html>
<head>
    <title>Input Buku Tamu</title>
</head>
<body>
<center>
    <h2>Form Buku Tamu</h2>
    
    <! Menampilkan pesan error jika terdaoat error >
    <?php if(isset($_GET['error'])) echo "<p style='color:red;'>".$_GET['error']."</p>"; ?>


     <! form untuk input data kemidian kirim ke proses.php >
    <form action="proses.php" method="POST">
        Nama: <input type="text" name="nama"><br><br>
        Email: <input type="text" name="email"><br><br>
        Pesan: <textarea name="isi"></textarea><br><br>
        <button type="submit" name="submit">Kirim</button>
    </form>
</center>
</body>
</html>