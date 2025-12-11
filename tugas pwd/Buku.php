<?php
require_once 'Database.php';

class Buku extends Database {

    public function __construct() {
        parent::__construct();
    }
    public function createBuku($judul, $penulis, $tahun_terbit, $penerbit) {
        $stmt = $this->conn->prepare("INSERT INTO buku (judul, penulis, tahun_terbit, penerbit) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $judul, $penulis, $tahun_terbit, $penerbit); 

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllBuku() {
        $sql = "SELECT id_buku, judul, penulis, tahun_terbit, penerbit FROM buku ORDER BY judul ASC";
        $result = $this->conn->query($sql);

        $buku_array = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $buku_array[] = $row;
            }
        }
        return $buku_array;
    }
    public function getBukuById($id) {
        $stmt = $this->conn->prepare("SELECT id_buku, judul, penulis, tahun_terbit, penerbit FROM buku WHERE id_buku = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function updateBuku($id, $judul, $penulis, $tahun_terbit, $penerbit) {
        $stmt = $this->conn->prepare("UPDATE buku SET judul = ?, penulis = ?, tahun_terbit = ?, penerbit = ? WHERE id_buku = ?");
        $stmt->bind_param("ssisi", $judul, $penulis, $tahun_terbit, $penerbit, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // DELETE / HAPUS DATA
    public function deleteBuku($id) {
        $stmt = $this->conn->prepare("DELETE FROM buku WHERE id_buku = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>