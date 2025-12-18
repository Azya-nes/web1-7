<?php
require_once 'Auth.php';
$auth = new UserAuth();
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hasil = $auth->login($_POST['username'], $_POST['password']);
    
    if ($hasil === 0) {
        header("Location: halaman_a.php");
    } elseif ($hasil === 1) {
        header("Location: halaman_b.php");
    } else {
        $pesan = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login OOP Multi Level</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #e9ecef; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); width: 320px; }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        input { width: 100%; padding: 12px; margin: 8px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #28a745; border: none; color: white; border-radius: 5px; cursor: pointer; font-weight: bold; }
        button:hover { background: #218838; }
        .err { color: #dc3545; text-align: center; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>LOGIN</h2>
        <?php if($pesan) echo "<div class='err'>$pesan</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">MASUK</button>
        </form>
    </div>
</body>
</html>