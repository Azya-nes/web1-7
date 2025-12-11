<?php
require_once 'Buku.php';

$buku_model = new Buku();
$message = ''; // Untuk pesan notifikasi

// 4. Logika Hapus (DELETE)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];
    
    if ($buku_model->deleteBuku($id_to_delete)) {
        $message = "success|Data buku berhasil dihapus.";
    } else {
        $message = "error|Gagal menghapus data buku.";
    }
}

// Ambil semua data buku untuk ditampilkan
$list_buku = $buku_model->getAllBuku();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Perpustakaan - CRUD</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
        .container { max-width: 1000px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        h1 { color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; text-align: center; }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; margin: 2px; display: inline-block; font-size: 14px; }
        .btn-add { background-color: #28a745; color: white; }
        .btn-edit { background-color: #ffc107; color: #333; }
        .btn-delete { background-color: #dc3545; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #dee2e6; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manajemen Data Buku Perpustakaan</h1>
        
        <?php 
        // Tampilkan pesan notifikasi
        if (!empty($message)) {
            list($type, $msg) = explode("|", $message);
            echo "<div class='alert alert-$type'>$msg</div>";
        }
        ?>

        <a href="form_buku.php" class="btn btn-add"> + Tambah Buku Baru</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($list_buku)): ?>
                    <?php foreach ($list_buku as $buku): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($buku['id_buku']); ?></td>
                            <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                            <td><?php echo htmlspecialchars($buku['penulis']); ?></td>
                            <td><?php echo htmlspecialchars($buku['tahun_terbit']); ?></td>
                            <td><?php echo htmlspecialchars($buku['penerbit']); ?></td>
                            <td>
                                <a href="form_buku.php?id=<?php echo $buku['id_buku']; ?>" class="btn btn-edit">Ubah</a>
                                
                                <button class="btn btn-delete" onclick="confirmDelete(<?php echo $buku['id_buku']; ?>, '<?php echo htmlspecialchars($buku['judul'], ENT_QUOTES); ?>')">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center;">Data buku kosong. Silakan tambahkan data baru.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(id, judul) {
            // 4. Menampilkan pop-up (alert/confirm) untuk validasi
            if (confirm("Apakah Anda yakin ingin menghapus buku:\n\"" + judul + "\" (ID: " + id + ")?")) {
                // Jika user menekan OK, arahkan ke halaman ini dengan parameter delete
                window.location.href = 'index.php?action=delete&id=' + id;
            }
        }
    </script>
</body>
</html>