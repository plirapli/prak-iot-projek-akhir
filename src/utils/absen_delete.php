<?php

require_once "../../config/database.php";
mysqli_query($connect, "DELETE FROM temp_rfid");
header("location: ../pages/scan_kartu.php");
