<?php
include 'koneksi.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Mendapatkan semua data peminjaman
    $sql = "SELECT * FROM peminjaman";
    $result = $conn->query($sql);

    $peminjaman = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $peminjaman[] = $row;
        }
        echo json_encode($peminjaman);
    } else {
        echo json_encode(array("message" => "No data found"));
    }
} elseif ($method == 'POST') {
    // Menambahkan data peminjaman baru
    $data = json_decode(file_get_contents("php://input"));
    $tanggal_pinjam = $data->tanggal_pinjam;
    $tanggal_kembali = $data->tanggal_kembali;
    $anggota = $data->anggota;
    $buku = $data->buku;

    $sql = "INSERT INTO peminjaman (tanggal_pinjam, tanggal_kembali, anggota, buku) VALUES ('$tanggal_pinjam', '$tanggal_kembali', '$anggota', '$buku')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Peminjaman berhasil ditambahkan"));
    } else {
        echo json_encode(array("message" => "Gagal menambahkan peminjaman"));
    }
} elseif ($method == 'DELETE') {
    // Menghapus data peminjaman berdasarkan id
    $id = $_GET['id'];
    $sql = "DELETE FROM peminjaman WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Peminjaman berhasil dihapus"));
    } else {
        echo json_encode(array("message" => "Gagal menghapus peminjaman"));
    }
}

$conn->close();
