<?php
include "koneksi.php";
$sql = mysqli_query($connect, "SELECT * FROM `status`");
$data = mysqli_fetch_array($sql);
$mode = $data['mode'];

//uji mode absen
$mode_absen = "";
if ($mode == 1)
  $mode_absen = "Masuk";
else if ($mode == 2)
  $mode_absen = "Keluar";

//baca table temp_absen
$baca_kartu = mysqli_query($connect, "SELECT * FROM temp_rfid");
$data_kartu = mysqli_fetch_array($baca_kartu);
$card_no    = $data_kartu['card_no'];
?>

<div class="container-fluid" style="text-align: center">
  <?php if ($card_no == "") { ?>
    <h3>Silahkan Tempelkan RFID Anda</h3>

  <?php } else {
    // Cek apakah rfid terdaftar dalam db
    $cari_mhs = mysqli_query($connect, "SELECT * FROM mahasiswa WHERE card_no='$card_no'");
    $jumlah_data = mysqli_num_rows($cari_mhs);

    if ($jumlah_data == 0)
      echo "<h1>RFID Tidak Terdaftar</h1>";
    else {
      $data_mhs = mysqli_fetch_array($cari_mhs);
      $name = $data_mhs['name'];

      // Tanggal dan jam
      date_default_timezone_set('Asia/Jakarta');
      $tanggal = date('Y-m-d');
      $jam     = date('H:i:s');

      // Cek apakah orang yang ngetap baru nyampe atau mau pulang
      $cari_absen = mysqli_query(
        $connect,
        "SELECT * FROM absen WHERE card_no='$card_no' AND `date`='$tanggal'"
      );

      // Hitung jumlah data
      $jumlah_absen = mysqli_num_rows($cari_absen);

      if ($jumlah_absen == 0) {
        echo "<h1>Selamat Datang<br>$name</h1>";
        mysqli_query(
          $connect,
          "INSERT INTO absen (card_no, `date`, jam_masuk) VALUES ('$card_no', '$tanggal', '$jam')"
        );
      } else {
        echo "<h1>Selamat meninggalkan Kelas<br>$name</h1>";
        mysqli_query(
          $connect,
          "UPDATE absen SET jam_keluar='$jam' WHERE card_no='$card_no' AND `date`='$tanggal'"
        );
      }
    }

    // Kosongkan tabel temp_rfid
    mysqli_query($connect, "DELETE FROM temp_rfid");
  } ?>
</div>