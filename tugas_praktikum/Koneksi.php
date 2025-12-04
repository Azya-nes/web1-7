<?php
class Koneksi {
    private $host = "localhost"; // Ganti jika host Anda berbeda
    private $user = "root";      // Ganti dengan username DB Anda
    private $pass = "";          // Ganti dengan password DB Anda
    private $dbName = "db_film";
    private $dbh; // Database Handler

    public function __construct() {
        
        $dsn = "mysql:host={$this->host};dbname={$this->dbName}";

        // Opsi koneksi
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    public function getKoneksi() {
        return $this->dbh;
    }
}
?>