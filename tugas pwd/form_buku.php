<?php
require_once 'Buku.php';

$buku_model = new Buku();
$is_edit = false;
$data_buku = [
    'id_buku' => '',
    'judul' => '',
    'penulis' => '',
    'tahun_terbit' => '',
    'penerbit' => ''
];
$title = "Tambah Buku Baru";
$message = '';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $data_buku = $buku_model->getBukuById($id);
    if ($data_buku) {
        $is_edit = true;
        $title = "Ubah Data Buku: " . htmlspecialchars($data_buku['judul']);
    } else {
        $message = "error|Data buku tidak ditemukan.";
        $is_edit = false; 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id_buku']) ? (int)$_POST['id_buku'] : 0;
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = (int)$_POST['tahun_terbit'];
    $penerbit = $_POST['penerbit'];

    if (empty($judul) || empty($penulis) || empty($tahun_terbit)) {
        $message = "error|Semua kolom wajib diisi!";
    } else {
        if ($id > 0 && $is_edit) {
            if ($buku_model->updateBuku($id, $judul, $penulis, $tahun_terbit, $penerbit)) {
                header("Location: index.php?message=success|Data buku berhasil diubah.");
                exit();
            } else {
                $message = "error|Gagal mengubah data buku.";
            }
        } else {
            if ($buku_model->createBuku($judul, $penulis, $tahun_terbit, $penerbit)) {
                header("Location: index.php?message=success|Data buku berhasil ditambahkan.");
                exit();
            } else {
                $message = "error|Gagal menambahkan data buku.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        h1 { color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; box-sizing: border-box; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; margin-right: 10px; }
        .btn-submit { background-color: #007bff; color: white; }
        .btn-cancel { background-color: #6c757d; color: white; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; font-weight: bold; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>

        <?php 
        if (!empty($message)) {
            list($type, $msg) = explode("|", $message);
            echo "<div class='alert alert-$type'>$msg</div>";
        }
        ?>

        <form method="POST" action="form_buku.php<?php echo $is_edit ? '?id=' . htmlspecialchars($data_buku['id_buku']) : ''; ?>">
            
            <?php if ($is_edit): ?>
                <input type="hidden" name="id_buku" value="<?php echo htmlspecialchars($data_buku['id_buku']); ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="judul">Judul Buku:</label>
                <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($data_buku['judul']); ?>" required>
            </div>
            <div class="form-group">
                <label for="penulis">Penulis:</label>
                <input type="text" id="penulis" name="penulis" value="<?php echo htmlspecialchars($data_buku['penulis']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit:</label>
                <input type="number" id="tahun_terbit" name="tahun_terbit" value="<?php echo htmlspecialchars($data_buku['tahun_terbit']); ?>" min="1900" max="<?php echo date('Y'); ?>" required>
            </div>
            <div class="form-group">
                <label for="penerbit">Penerbit:</label>
                <input type="text" id="penerbit" name="penerbit" value="<?php echo htmlspecialchars($data_buku['penerbit']); ?>">
            </div>

            <button type="submit" class="btn btn-submit"><?php echo $is_edit ? 'Simpan Perubahan' : 'Tambah Data'; ?></button>
            <a href="index.php" class="btn btn-cancel">Batal</a>
        </form>
    </div>
</body>
</html>