<?php
include 'koneksi.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Mendapatkan semua data anggota
    $sql = "SELECT * FROM anggota";
    $result = $conn->query($sql);

    $anggota = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $anggota[] = $row;
        }
        echo json_encode($anggota);
    } else {
        echo json_encode(array("message" => "No data found"));
    }
} elseif ($method == 'POST') {
    // Menambahkan data anggota baru
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->nim) && isset($data->nama) && isset($data->alamat) && isset($data->jenis_kelamin)) {
        $nim = $data->nim;
        $nama = $data->nama;
        $alamat = $data->alamat;
        $jenis_kelamin = $data->jenis_kelamin;

        $sql = "INSERT INTO anggota (nim, nama, alamat, jenis_kelamin) VALUES ('$nim', '$nama', '$alamat', '$jenis_kelamin')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Anggota berhasil ditambahkan"));
        } else {
            echo json_encode(array("message" => "Gagal menambahkan anggota"));
        }
    } else {
        echo json_encode(array("message" => "Data tidak lengkap"));
    }
} elseif ($method == 'DELETE') {
    // Menghapus data anggota berdasarkan id
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM anggota WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Anggota berhasil dihapus"));
        } else {
            echo json_encode(array("message" => "Gagal menghapus anggota"));
        }
    } else {
        echo json_encode(array("message" => "ID tidak ditemukan"));
    }
}

$conn->close();
