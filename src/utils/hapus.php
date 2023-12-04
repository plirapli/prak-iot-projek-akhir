<?php
require_once '../../config/database.php';

$id = $_GET['id'];
$query = "DELETE FROM siswa WHERE id='$id'";

if (mysqli_query($connect, $query)) {
  header("location: ../pages/data_mahasiswa.php");
} else {
  header("location: _tambah.php?message=failed");
}
