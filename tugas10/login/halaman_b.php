<?php
require_once 'Auth.php';
$auth = new UserAuth();
$auth->cekLogin(1); 
?>
<!DOCTYPE html>
<html>
<body>
    <h1>HALAMAN B - DASHBOARD USER</h1>
    <p>Halo User: <?php echo $_SESSION['username']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>