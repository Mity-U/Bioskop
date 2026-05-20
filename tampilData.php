<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Tamu</title>
</head>
<body>
<center>
    <h2>Data dari Database</h2>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
        </tr>
        <?php
        // Code Query untuk ambil data
        $query = mysqli_query($conn, "SELECT * FROM buku_tamu");
        
        // Looping Setiap Data
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>" . $row['id_bt'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['isi'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    
    <br>
    <a href="form.php">Kembali</a>
</center>
</body>
</html>