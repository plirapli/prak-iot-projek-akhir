<?php

require_once "../../config/database.php";

if (isset($_POST["date"])) {
  $tanggal = date($_POST["date"]);
  header("location: ../pages/data_absen.php?date=" . $tanggal);
} else {
  header("location: ../pages/data_absen.php");
}
