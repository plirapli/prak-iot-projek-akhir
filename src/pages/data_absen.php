<!DOCTYPE html>
<html lang="en">

<head>
  <title>Rekapitulasi Absensi</title>
  <link rel="stylesheet" href="../../assets/css/output.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js" defer></script>
</head>

<body class="min-h-screen bg-white w-full flex justify-center">
  <div class='flex flex-col w-full max-w-screen-md min-h-full'>
    <div class='px-3 flex flex-col w-full min-h-full'>
      <!-- Header -->
      <div class="py-4 flex gap-4 items-center">
        <a href="../../index.php" class="p-1 bg-black bg-opacity-10 rounded">
          <span class="iconify" data-icon="material-symbols:arrow-left-alt-rounded" data-width="28"></span>
        </a>
        <div class="font-bold">
          Data Absensi
        </div>
      </div>

      <!-- Search bar & Add button -->
      <form method="POST" action="../utils/filter_data_absen.php" class="pb-4 flex gap-4 w-full">
        <input type="date" name="date" class="form-input">
        <button type="submit" class="button min-w-fit bg-teal-500 text-white">
          Filter
        </button>
      </form>

      <div class="block w-full overflow-x-auto">
        <table class="w-full border-collapse ">
          <thead class="bg-teal-500 bg-opacity-10 text-teal-500">
            <tr>
              <th class="px-6 py-3 font-bold text-center text-xs uppercase rounded-l align-middle">
                No
              </th>
              <th class="px-6 py-3 font-bold text-left text-xs uppercase align-middle">
                Nama
              </th>
              <th class="px-6 py-3 font-bold text-left text-xs uppercase align-middle">
                Tanggal
              </th>
              <th class="px-6 py-3 font-bold text-center text-xs uppercase align-middle">
                Jam Masuk
              </th>
              <th class="px-6 py-3 font-bold text-center text-xs uppercase rounded-r align-middle">
                Jam Keluar
              </th>
            </tr>
          </thead>

          <tbody>
            <?php
            require_once "../../config/database.php";

            date_default_timezone_set('Asia/Jakarta');

            if (isset($_GET["date"])) {
              $tanggal = date($_GET["date"]);
            } else {
              $tanggal = date('Y-m-d');
            }

            // Filter absensi berdasarkan tanggal saat ini
            $command_get_all_users = "SELECT * FROM siswa";
            $all_users = $connect->query($command_get_all_users);
            $result;

            $i = 0;
            while ($user = $all_users->fetch_assoc()) {
              $result[$i]["name"] = $user["name"];
              $result[$i]["nis"] = $user["nis"];
              $result[$i]["card_no"] = $user["card_no"];
              $result[$i]["date"] = $tanggal;
              $result[$i]["jam_masuk"] = "-";
              $result[$i]["jam_keluar"] = "-";

              $card_no = $user['card_no'];
              // echo $card_no;
              $command_absen = "SELECT jam_masuk, jam_keluar 
                                FROM absen
                                WHERE card_no = '$card_no' 
                                AND `date` = '$tanggal'";
              $hasil_absen = $connect->query($command_absen);
              $absen = $hasil_absen->fetch_assoc();

              if ($absen != NULL) {
                $jam_masuk = $absen["jam_masuk"];
                $jam_keluar = $absen["jam_keluar"];
                $result[$i]["jam_masuk"] = $jam_masuk != "" ? $jam_masuk : "-";
                $result[$i]["jam_keluar"] = $jam_keluar != "" ? $jam_keluar : "-";
              }
              $i++;
            }
            $no = 0;
            foreach ($result as $data) {
              $no++;
            ?>
              <tr>
                <td class="text-center px-6 text-xs whitespace-nowrap p-4">
                  <?= $no ?>
                </td>
                <td class="px-6 text-xs whitespace-nowrap p-4 ">
                  <?= $data["name"] ?>
                </td>
                <td class="px-6 text-xs whitespace-nowrap p-4">
                  <?= $data["date"] ?>
                </td>
                <td class="text-center px-6 text-xs whitespace-nowrap p-4">
                  <?= $data["jam_masuk"] ?>
                </td>
                <td class="text-center px-6 text-xs whitespace-nowrap p-4">
                  <?= $data["jam_keluar"] ?>
                </td>
              </tr>
            <?php } ?>

          </tbody>

        </table>
      </div>

      <!--
      <div class="container-fluid">
        <h3>Rekapitulasi Absensi</h3>

        <table class="table table-bordered">
          <thead>
            <tr style="background-color: grey; color: white">
              <th>No.</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Jam Masuk</th>
              <th>Jam Keluar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "koneksi.php";

            //baca tanggal
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');

            //filter absensi berdasarkan tanggal saat ini
            $sql = mysqli_query($connect, "SELECT b.nim, b.name, a.date, a.jam_masuk, a.jam_keluar FROM absen a, 
                            mahasiswa b WHERE a.card_no=b.card_no AND `date`='$tanggal'");
            $no = 0;
            while ($data = mysqli_fetch_array($sql)) {
              $no++;
            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['nim'] ?></td>
                <td><?php echo $data['name'] ?></td>
                <td><?php echo $data['date'] ?></td>
                <td><?php echo $data['jam_masuk'] ?></td>
                <td><?php echo $data['jam_keluar'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div> -->
    </div>
  </div>
</body>

</html>