<?php

require_once '../../config/database.php';

mysqli_query($connect, "DELETE FROM temp_rfid");

$card_no = $_GET['no_kartu'];
$scanned_card = mysqli_query(
  $connect,
  "INSERT INTO temp_rfid VALUES ('$card_no')"
);

if ($scanned_card)
  echo "Berhasil membaca kartu.";
else
  echo "Gagal membaca kartu: " + mysqli_error($connection);
