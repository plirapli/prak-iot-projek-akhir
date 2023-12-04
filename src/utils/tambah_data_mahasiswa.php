<?php

require_once "../../config/database.php";

if (isset($_POST["add_user"])) {
  $card_no = $_POST['card_no'];
  $name = $_POST['name'];
  $nis = $_POST['nis'];

  $command = "INSERT INTO siswa VALUES ('', '$nis', '$card_no', '$name')";
  $query = mysqli_query($connect, $command) or die(mysqli_error($connect));

  if ($query) {
    header("location: ../pages/data_mahasiswa.php");
  }
}

// Kosongkan tabel temp_rfid
mysqli_query($connect, "DELETE FROM temp_rfid");
