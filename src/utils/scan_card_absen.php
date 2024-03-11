<?php

require_once "../../config/database.php";

// Cek ada yang ngescan apa engga temp_rfid
$baca_kartu = mysqli_query($connect, "SELECT * FROM temp_rfid");
$data_kartu = mysqli_fetch_array($baca_kartu);

if ($data_kartu != NULL) {
  $card_no = $data_kartu['card_no'];

  // Cek apakah rfid terdaftar dalam db
  $cari_mhs = mysqli_query($connect, "SELECT * FROM siswa WHERE card_no='$card_no'");
  $jumlah_data = mysqli_num_rows($cari_mhs);

  if ($jumlah_data == 0) {
    echo '<div id="not-found" class="bg-red-500 bg-opacity-10 text-red-500 p-4 rounded-md">
            Card is Not Registered. Please Try Again.
          </div>';
  } else {
    $data_mhs = mysqli_fetch_array($cari_mhs);
    $name = $data_mhs['name'];

    // Tanggal dan jam
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date('Y-m-d');
    $jam     = date('H:i:s');

    echo '
      <div id="found" class="w-full p-6 bg-blue-500 bg-opacity-10 rounded-md">
        <span class="iconify w-full" data-icon="bx:user" data-width="128"></span>
        <div class="mt-3 mb-4 flex flex-col gap-1.5 items-center">
          <div class="font-bold text-lg">' . $name . '</div>
          <div class="flex items-center gap-4">
            <div class="flex items-center gap-1.5">
              <span class="iconify" data-icon="solar:user-id-bold" data-width="32"></span>
              <div>' . $data_mhs["nis"] . '</div>
            </div>
            <div class="flex items-center gap-1.5">
              <span class="iconify" data-icon="ri:rfid-fill" data-width="32"></span>
              <div class="uppercase">' . $data_mhs["card_no"] . '</div>
            </div>
          </div>
          <div class="flex items-center gap-1.5">
            <span class="iconify" data-icon="mdi:clock-outline" data-width="32"></span>
            <div class="font-bold text-lg">' . $jam . '</div>
          </div>
        </div>
        <a 
          href="../utils/absen_add.php?card_no=' . $card_no . '&date=' . $tanggal . '&jam=' . $jam . '"
          class="w-full button bg-blue-500 text-white"
        >
          Proceed
        </a>
        <a href="../utils/absen_delete.php" class="mt-2 w-full button button-gray">
          Cancel
        </a>
      </div>
    ';
  }
} else {
  echo '
    <div id="waiting" class="flex flex-col items-center justify-center bg-blue-500 bg-opacity-10 gap-4 p-6 rounded-lg">
      <span class="iconify text-blue-500 animate-pulse" data-icon="ion:id-card-outline" data-width="128"></span>
      <div class="font-medium text-lg text-gray-400">Please Tap Your Card</div>
    </div>
  ';
}
