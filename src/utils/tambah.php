<?php
require_once "koneksi.php";

$req_body = json_decode(file_get_contents('php://input'), true);

$card_no = $req_body['card_no'];
$name = $req_body['name'];
$nim = $req_body['nim'];
$prodi = $req_body['prodi'];

$command    = "INSERT INTO mahasiswa VALUES('', '$nim', '$card_no', '$name', '$prodi')";
$query = mysqli_query($connect, $command);

if ($query) {
  $response = [
    'status' => 1,
    'message' => 'Insert Success',
  ];
} else {
  $response = [
    'status' => 0,
    'message' => 'Insert Failed.'
  ];
}

header('Content-Type: application/json');
echo json_encode($response);

// Kosongkan tabel temp_rfid
mysqli_query($connect, "DELETE FROM temp_rfid");
