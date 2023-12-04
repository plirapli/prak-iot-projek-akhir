<?php

require_once "../../config/database.php";

$card_no = $_GET["card_no"];
$date = $_GET["date"];
$jam = $_GET["jam"];

// Cek apakah orang yang ngetap baru nyampe atau mau pulang
$cari_absen = mysqli_query(
  $connect,
  "SELECT * FROM absen WHERE card_no='$card_no' AND `date`='$date'"
);

// Hitung jumlah data
$jumlah_absen = mysqli_num_rows($cari_absen);

if ($jumlah_absen == 0) {
  mysqli_query(
    $connect,
    "INSERT INTO absen (card_no, `date`, jam_masuk) VALUES ('$card_no', '$date', '$jam')"
  );
} else {
  mysqli_query(
    $connect,
    "UPDATE absen SET jam_keluar='$jam' WHERE card_no='$card_no' AND `date`='$date'"
  );
}

// Kosongkan tabel temp_rfid
mysqli_query($connect, "DELETE FROM temp_rfid");

header("location: ../pages/scan_kartu.php");
