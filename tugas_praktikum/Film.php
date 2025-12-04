<?php
require_once 'Koneksi.php';

class Film {
    private $db;

    public function __construct() {
        // Membuat objek Koneksi dan mendapatkan koneksi PDO
        $koneksi = new Koneksi();
        $this->db = $koneksi->getKoneksi();
    }

    // Metode untuk mengambil semua data film
    public function getAllFilm() {
        $query = "SELECT * FROM film ORDER BY tahun_rilis DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        // Mengembalikan hasil dalam bentuk array asosiatif
        return $stmt->fetchAll(); 
    }
}
?>