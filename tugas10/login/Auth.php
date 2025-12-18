<?php
session_start();

class UserAuth {
    private $host = "localhost";
    private $db_name = "login_system";
    private $user = "root"; 
    private $pass = "";     //  pass mysql 
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = (int)$user['level'];
            return $_SESSION['level'];
        }
        return false;
    }

    public function cekLogin($level_seharusnya) {
        if (!isset($_SESSION['level']) || $_SESSION['level'] != $level_seharusnya) {
            header("Location: index.php");
            exit();
        }
    }
}