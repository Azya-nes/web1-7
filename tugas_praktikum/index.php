<?php
// Memuat kelas Film
require_once 'Film.php';

// Membuat objek dari kelas Film (OOP)
$film = new Film();

// Memanggil metode untuk mengambil data
$data_film = $film->getAllFilm();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Film Keren</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9f5ff;
            cursor: pointer;
        }
        .genre {
            font-style: italic;
            color: #e74c3c;
        }
        .sutradara {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><span style="color: #e74c3c;">⭐</span> Daftar Film Terbaik <span style="color: #e74c3c;">⭐</span></h2>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Film</th>
                <th>Tahun Rilis</th>
                <th>Genre</th>
                <th>Sutradara</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            // Looping untuk menampilkan data dari basis data
            foreach ($data_film as $row) { 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['judul']); ?></td>
                <td><?php echo htmlspecialchars($row['tahun_rilis']); ?></td>
                <td class="genre"><?php echo htmlspecialchars($row['genre']); ?></td>
                <td class="sutradara"><?php echo htmlspecialchars($row['sutradara']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php if (empty($data_film)): ?>
        <p style="text-align: center; margin-top: 20px;">Tidak ada data film yang tersedia.</p>
    <?php endif; ?>

</div>

</body>
</html>