<?php
require_once 'Auth.php';
$auth = new UserAuth();
$auth->cekLogin(0); 
?>
<!DOCTYPE html>
<html>
<body>
    <h1>HALAMAN A - DASHBOARD ADMIN</h1>
    <p>Halo Admin: <?php echo $_SESSION['username']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>