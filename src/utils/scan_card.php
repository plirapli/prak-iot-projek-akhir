<?php

require_once "../../config/database.php";

$sql = mysqli_query($connect, "SELECT * FROM temp_rfid");
$data = mysqli_fetch_array($sql);

if ($data != NULL) {
  $card_no = $data['card_no'];
  echo $card_no;
} else {
  echo NULL;
}
