<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rekapitulasi Absensi</title>
    <link rel="stylesheet" type="text/css" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <?php include "menu.php"; ?>

    <div class="container-fluid">
        <h3>Rekapitulasi Absensi</h3>

        <table class="table table-bordered">
            <thead>
                <tr style="background-color: grey; color: white">
                    <th>No.</th>
                    <th>nim</th>
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
                    while ($data = mysqli_fetch_array($sql))
                    {
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
    </div>
</body>
</html>