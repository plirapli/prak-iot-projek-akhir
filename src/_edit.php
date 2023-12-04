<?php
    include "koneksi.php";

    $id = $_GET['id'];

    $cari = mysqli_query($connect, "SELECT * FROM mahasiswa WHERE id='$id'");
    $hasil = mysqli_fetch_array($cari);

    if(isset($_POST["btnsimpan"]))
    {
        $card_no = $_POST['card_no'];
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];

        $sql	= "UPDATE mahasiswa SET nim='$nim', card_no='$card_no', `name`='$name', prodi='$prodi' WHERE id='$id'";
        $query = mysqli_query($connect, $sql) or die(mysqli_error($connect));

        if($query)
        {
            header("location: dataMhs.php");
            echo"Edit data berhasil";
        }
        else
        {
            header("location: edit.php?message=failed");
            echo"Gagal Edit Data";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" type="text/css" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <?php include "menu.php"?>

    <div class="container-fluid">
        <h3>Tambah Data Mahasiswa</h3>

        <form method="POST">
            <div class="form-group">
                <label>No.Kartu</label><br>
                <input type="text" name="card_no" id="card_no" placeholder="Nomor Kartu RFID" style="width: 200px"
                value="<?php echo $hasil['card_no']; ?>">
                <br><br>
            </div>
            <div class="form-group">
                <label>Nama Mahasiswa</label><br>
                <input type="text" name="name" id="name" placeholder="Nama Mahasiswa" style="width: 400px"
                value="<?php echo $hasil['name'];?>">
                <br><br>
            </div>
            <div class="form-group">
                <label>NIM</label><br>
                <input type="text" name="nim" id="nim" placeholder="NIM" style="width: 200px"
                value="<?php echo $hasil['nim'];?>">
                <br><br>
            </div>
            <div class="form-group">
                <label>Program Studi</label><br>
                <input type="text" name="prodi" id="prodi" placeholder="Program Sudi" style="width: 200px"
                value="<?php echo $hasil['prodi'];?>">
                <br><br>
            </div>
            <button class="btn btn-primary" name="btnsimpan" id="btnsimpan">SIMPAN</button>
        </form>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</html>