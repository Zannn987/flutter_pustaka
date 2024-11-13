<?php
include 'koneksi.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Mendapatkan semua data buku
    $sql = "SELECT * FROM buku";
    $result = $conn->query($sql);

    $buku = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $buku[] = $row;
        }
        echo json_encode($buku);
    } else {
        echo json_encode(array("message" => "No data found"));
    }
} elseif ($method == 'POST') {
    // Menambahkan data buku baru
    $data = json_decode(file_get_contents("php://input"));
    $judul = $data->judul;
    $pengarang = $data->pengarang;
    $penerbit = $data->penerbit;
    $tahun_terbit = $data->tahun_terbit;

    $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit) VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Buku berhasil ditambahkan"));
    } else {
        echo json_encode(array("message" => "Gagal menambahkan buku"));
    }
} elseif ($method == 'DELETE') {
    // Menghapus data buku berdasarkan id
    $id = $_GET['id'];
    $sql = "DELETE FROM buku WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Buku berhasil dihapus"));
    } else {
        echo json_encode(array("message" => "Gagal menghapus buku"));
    }
}

$conn->close();
