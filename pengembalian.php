<?php
include 'koneksi.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Mendapatkan semua data pengembalian
    $sql = "SELECT * FROM pengembalian";
    $result = $conn->query($sql);

    $pengembalian = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pengembalian[] = $row;
        }
        echo json_encode($pengembalian);
    } else {
        echo json_encode(array("message" => "No data found"));
    }
} elseif ($method == 'POST') {
    // Menambahkan data pengembalian baru
    $data = json_decode(file_get_contents("php://input"));
    $tanggal_dikembalikan = $data->tanggal_dikembalikan;
    $terlambat = $data->terlambat;
    $denda = $data->denda;
    $peminjaman = $data->peminjaman;

    $sql = "INSERT INTO pengembalian (tanggal_dikembalikan, terlambat, denda, peminjaman) VALUES ('$tanggal_dikembalikan', '$terlambat', '$denda', '$peminjaman')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Pengembalian berhasil ditambahkan"));
    } else {
        echo json_encode(array("message" => "Gagal menambahkan pengembalian"));
    }
} elseif ($method == 'DELETE') {
    // Menghapus data pengembalian berdasarkan id
    $id = $_GET['id'];
    $sql = "DELETE FROM pengembalian WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Pengembalian berhasil dihapus"));
    } else {
        echo json_encode(array("message" => "Gagal menghapus pengembalian"));
    }
}

$conn->close();
