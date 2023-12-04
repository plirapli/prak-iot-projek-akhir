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
          Scan Kartu
        </div>
      </div>

      <div id="content"></div>

      <div>
      </div>
    </div>
  </div>

  <script>
    // Scanning membaca kartu rfid
    setInterval(() => {
      const contentElement = document.querySelector('#content')
      // if (!cardNoElement.value) {
      fetch('../utils/scan_card_absen.php')
        .then((res) => res.text())
        .then((data) => {
          const parser = new DOMParser()
          const dom = parser.parseFromString(data, "text/html");
          const state = dom.querySelector("div")?.getAttribute("id")
          const currentState = contentElement.children[0]?.getAttribute("id")

          if (currentState != state) {
            contentElement.innerHTML = data
          }
        });
      // }
    }, 2000);
  </script>
</body>

</html>