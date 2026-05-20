<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Daftar Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #c7cdcf;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1a5f7a;
            margin-bottom: 20px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;

            margin-top: 20px;
        }

        th {
            background: #0d3b4f;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-size: 13px;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .center {
            text-align: center;
            margin-top: 20px;
        }

        a {
            display: inline-block;
            background: #1a5f7a;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 20px;">
        <h2>Data dari Database</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>pesan</th>
            </tr>
            <?php
            // Ambil data dari tabel 'kontak' yang ada di database
            $query = mysqli_query($conn, "SELECT * FROM kontak");

            // Lakukan perulangan selama data di dalam tabel masih ada
            while ($row = mysqli_fetch_assoc($query)) {
                // Tampilkan data ke dalam baris dan kolom tabel HTML
                echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['jkel']}</td>
            <td>{$row['email']}</td>
            <td>{$row['alamat']}</td>
            <td>{$row['kota']}</td>
            <td>{$row['pesan']}</td>
          </tr>";
            }
            ?>
        </table>
        <div class="center">

        </div>
    </div>

</body>

</html>