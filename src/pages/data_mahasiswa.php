<!DOCTYPE html>
<html lang="en">

<head>
  <title>Data Mahasiswa</title>
  <link rel="stylesheet" href="../../assets/css/output.css">
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
          Data Siswa
        </div>
      </div>

      <div>
        <!-- Search bar & Add button -->
        <div class="pb-4 flex items-center gap-4">
          <form class="w-full">
            <input type="text" class="form-input" placeholder="Cari Siswa">
          </form>
          <button onclick="modalAddSiswaHandler(0)" class="button button-black min-w-fit">
            Tambah Siswa
          </button>
        </div>

        <!-- Siswa List -->
        <div class="flex items-start gap-3 pb-4">

          <?php
          include "../../config/database.php";
          $sql = "SELECT * FROM siswa";
          $query = mysqli_query($connect, $sql);

          while ($data = mysqli_fetch_array($query)) {
          ?>
            <!-- Card -->
            <div class="w-40 p-3 bg-black bg-opacity-5 rounded-md">
              <div class="w-full h-24 bg-fuchsia-500 rounded"></div>
              <div>
                <div class="mt-3 text-sm font-medium">
                  <?= $data['name'] ?>
                </div>
                <div class="mt-1 flex items-center gap-1.5">
                  <span class="iconify" data-icon="solar:user-id-bold" data-width="24"></span>
                  <div class="text-sm"><?= $data['nis'] ?></div>
                </div>
                <div class="mt-0.5 flex items-center gap-1.5">
                  <span class="iconify" data-icon="ri:rfid-fill" data-width="24"></span>
                  <div class="text-sm uppercase font-mono"><?= $data['card_no'] ?></div>
                </div>
              </div>
              <div class="mt-2">
                <a href="../utils/data_mhs_hapus.php?= $data['id'] ?>" class="w-full button button-sm button-danger">Hapus</a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <dh-component>
    <div style="display: none;" class="py-12 bg-black bg-opacity-50 transition-all z-10 absolute top-0 right-0 bottom-0 left-0" id="modal">
      <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-md">
        <form method="POST" action="../utils/data_mhs_tambah.php" class="relative p-6 bg-white shadow-lg rounded">
          <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-2">Tambah Data Siswa</h1>
          <div class="mb-3">
            <label for="name" class="text-gray-800 text-sm">Nama Siswa</label>
            <input id="name" name="name" class="mt-1 form-input" placeholder="Masukkan nama siswa" required />
          </div>
          <div class="mb-3">
            <label for="nis" class="text-gray-800 text-sm">Nomor Induk Siswa</label>
            <input id="nis" name="nis" class="mt-1 form-input" placeholder="Masukkan NIS" required />
          </div>
          <div class="mb-5">
            <label for="card_no" class="text-gray-800 text-sm">Nomor Kartu</label>
            <input id="card_no" readonly name="card_no" class="mt-1 form-input" placeholder="Masukkan nomor kartu" required />
          </div>
          <div class="flex flex-col gap-2.5 w-full">
            <button type="submit" name="add_user" class="button button-black">Tambah</button>
            <button type="button" class="button button-gray" onclick="modalAddSiswaHandler(1)">Kembali</button>
          </div>
        </form>
      </div>
    </div>

    <script>
      const modal = document.querySelector("#modal");

      const modalAddSiswaHandler = (isModalOpen) => {
        isModalOpen ? fadeOut(modal) : fadeIn(modal)
      }

      const fadeOut = (modalElement) => {
        modalElement.style.opacity = 1;
        (function fade() {
          if ((modalElement.style.opacity -= 0.1) < 0) {
            modalElement.style.display = "none";
          } else {
            requestAnimationFrame(fade);
          }
        })();
      }

      const fadeIn = (modalElement, display) => {
        modalElement.style.opacity = 0;
        modalElement.style.display = display || "flex";
        (function fade() {
          let val = parseFloat(modalElement.style.opacity);
          if (!((val += 0.2) > 1)) {
            modalElement.style.opacity = val;
            requestAnimationFrame(fade);
          }
        })();
      }

      // Scanning membaca kartu rfid
      setInterval(() => {
        const cardNoElement = document.querySelector('#card_no')
        if (!cardNoElement.value) {
          fetch('../utils/scan_card.php')
            .then((res) => res.text())
            .then((data) => {
              if (data) {
                cardNoElement.value = data
                // fetch()
              }
            });
        }
      }, 1000);
    </script>

    </script>
  </dh-component>
</body>

</html>