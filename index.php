<!DOCTYPE html>
<html lang="en">

<head>
  <title>Menu Utama</title>
  <link rel="stylesheet" href="assets/css/output.css">
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>

<body class="min-h-screen bg-white w-full flex justify-center">
  <div class='flex flex-col w-full max-w-screen-md min-h-full'>
    <div class='px-3 flex flex-col w-full min-h-full'>

      <!-- Content -->
      <div class='flex items-end gap-2 mt-4 mb-2'>
        <div class='w-full'>
          <h1 class='inline text-lg font-bold leading-none'>
            Student Attendance Management
          </h1>
          <div class='text-gray-400 text-sm'>
            SD NEGERI "VETERAN" YOGYAKARTA
          </div>
        </div>
      </div>
      <a href="./src/pages/scan_kartu.php" class="mt-3 w-full px-4 py-4 bg-blue-500 bg-opacity-10 rounded-md">
        <div class="h-20">
          <span class="iconify text-blue-500" data-icon="tabler:line-scan" data-width="100%"></span>
        </div>
        <div class="font-bold mt-2 text-center text-blue-500">
          Scan Card
        </div>
      </a>
      <div class="mt-4 flex flex-col sm:flex-row gap-4">
        <a href="./src/pages/data_mahasiswa.php" class="w-full px-4 py-3 bg-pink-500 bg-opacity-10 rounded-md">
          <div class="rounded-md p-1.5 bg-white w-10">
            <span class="iconify text-pink-500" data-icon="mdi:users" data-width="100%"></span>
          </div>
          <div class="font-bold mt-2">
            Student Data
          </div>
        </a>
        <a href="./src/pages/data_absen.php" class="w-full px-4 py-3 bg-teal-500 bg-opacity-10 rounded-md">
          <div class="rounded-md p-1.5 bg-white w-10">
            <span class="iconify text-teal-500" data-icon="fluent:text-bullet-list-square-person-20-filled" data-width="100%"></span>
          </div>
          <div class=" font-bold mt-2">
            List of Attendance
          </div>
        </a>
      </div>

    </div>
  </div>
</body>

</html>