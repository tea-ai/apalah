<?php
include "koneksi.php";
session_start();
$kantin_query = "SELECT * FROM cantens";
$kantin_result = $conn->query($kantin_query);
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bayar'])) {
    unset($_SESSION['cart']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Latihan</title>
</head>

<script>
function cekDanBayar() {
  var total = parseInt(document.getElementById('totalBayar').innerText);

  if (isNaN(total) || total <= 0) {
    alert("Pesan dulu ya!");
    return;
  }

  alert("Pembayaran berhasil!");
  document.getElementById("bayarForm").submit();
}
</script>
<body>
    <nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3 sticky-top">
  <a class="navbar-brand">Kantin Telkom</a>
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link" href="#scrollspyHeading1">About kantin</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#scrollspyHeading2">Cafetaria list</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#scrollspyHeading3">How to buy</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#scrollspyHeading4">Contact us</a>
    </li>
  </ul>
</nav>


<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
  
<section class = "about text-center">
    <h4 id="scrollspyHeading1" style="padding-top: 50px; padding-bottom: 50px;">About kantin</h4>
    <div class="profil" style="padding-bottom: 100px;">
      <img class="rounded-circle" style="width: 200px; height: 200px;" src="img/logo.jpg">
    </div>

    <div class="container text-center" style="padding-bottom: 100px;">
    <div class="row">
      <div class="col">
        <iframe src="https://www.youtube.com/embed/3AWQnv6g9sk?si=Hv5fps2Psy7ogeM-"></iframe>
      </div>
      <div class="col">
        <img src="img/kantin.jpg">
      </div>
      <div class="col">
        <p>SMK Telko jakarta memiliki fasilitas kantin yang sangat nyaman.
          Banyak tempat duduk yang bisa digunakan siswa. tempat nya pun bersih dan nyaman.
          Harga dari makanan dan minuman cenderung murah
        </p>
      </div>
    </div>
    </div>

</section>

<section class="list text-center" style="padding-bottom: 100px;">
  <h4 id="scrollspyHeading2" style="padding-top: 50px; padding-bottom: 50px;">Cafetaria List</h4>
  <div class="container text-center">
    <div class="row">
  <?php while ($cantens = $kantin_result->fetch_assoc()){ ?>
  <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
    <div class="card" style="width: 100%; max-width: 18rem;">
      <img src="<?php echo $cantens["foto"]; ?>" class="card-img-top" alt="<?php echo $cantens["judul"]; ?>">
      <div class="card-body">
        <h5 class="card-title text-center"><?php echo $cantens["judul"]; ?></h5>
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Menu</th>
              <th>Harga</th>
              <th>Beli</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $menu_query = "SELECT * FROM menu WHERE canten_id =" .$cantens['id'];
            $menu_result = $conn->query($menu_query);
            while ($menu_item = $menu_result->fetch_assoc()){
            ?>
            <tr>
              <td><?php echo $menu_item['nama']; ?></td>
              <td><?php echo $menu_item['harga']; ?></td>
              <td>
                <form action="process.php" method="GET">
                  <input type="hidden" name="menu" value="<?php echo $menu_item['nama']; ?>">
                  <input type="hidden" name="harga" value="<?php echo $menu_item['harga']; ?>">
                  <button type="submit" class="btn btn-link"><i class="fa fa-plus"></i></button>
                </form>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
  </div>
</section>

<section class="buy text-center" style="padding-bottom: 100px;">
  <h4 id="scrollspyHeading3" style="padding-bottom: 50px;">How to buy</h4>

  <div class="container text-center">
  <div class="row">
    <div class="col">
      <div class="card" style="width: 13rem;">
      <div class="card-body">
        <h5 class="card-title">Step 1</h5>
        <p class="card-text">Masuk ke halaman Cafetaria List</p>
      </div>
      </div>
    </div>

    <div class="col">
      <div class="card" style="width: 13rem;">
      <div class="card-body">
        <h5 class="card-title">Step 2</h5>
        <p class="card-text">Pilih menu yang kamu inginkan</p>
      </div>
      </div>
    </div>

    <div class="col">
      <div class="card" style="width: 13rem;">
      <div class="card-body">
        <h5 class="card-title">Step 3</h5>
        <p class="card-text">Klik tanda tambah di sebelah kanan menu</p>
      </div>
      </div>
    </div>

    <div class="col">
      <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Step 4</h5>
        <p class="card-text">Klik bayar di halaman how to buy, scan qr dan selesai</p>
      </div>
      </div>
    </div>
  </div>

  <div class="container text-center">
    <div class="bayar">
  <table class="table table-bordered w-75 mx-auto">
  <table>
    <thead>
    <tr>
      <th>Menu</th>
      <th>Harga</th>
      <th>Banyak</th>
      <th>Total</th>
    </tr>
    </thead>
    <tbody>
<?php if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])): ?>
    <?php foreach ($_SESSION['cart'] as $item): 
        $subtotal = $item['harga'] * $item['banyak'];
        $total += $subtotal;
    ?>
    <tr>
        <td><?php echo $item['menu']; ?></td>
        <td><?php echo $item['harga']; ?></td>
        <td><?php echo $item['banyak']; ?></td>
        <td><?php echo $subtotal; ?></td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4">Belum ada pesanan.</td>
    </tr>
<?php endif; ?>
</tbody>
  </table>
  </div>

    <div class="text-center">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bayarModal">
        Bayar
      </button>
    </div>
  </div>
</section>

<section id="contact" class="container py-5">
  <h4 id="scrollspyHeading4">Contact us</h4>
  <form method="get">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" nama="nama">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" email="email">
    </div>
    <div class="mb-3">
      <label for="tarea" class="form-label">Pesan</label>
      <textarea name="tarea" class="form-control" id="tarea" cols="10" rows="5" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
  </form>
</section>
</div>

<footer class="bg-primary text-center text-white py-3">
  <p>Hanna Setiowati</p>
</footer>

<div class="modal fade" id="bayarModal" tabindex="-1" aria-labelledby="bayarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <p>Silakan scan QR Code untuk melakukan pembayaran:</p>
                <img src="img/qrcode.jpg" alt="QR Code" style="width: 200px; height: 200px;">
                <p>Setelah pembayaran, klik tombol "Sudah"</p>
            </div>
            <div class="modal-footer">
                <h4>Total: <span id="totalBayar"><?php echo $total; ?></span></h4>
                <div class="text-center">
                  <form id="bayarForm" method="post">
                    <button type="button" class="btn btn-success" onclick="cekDanBayar()">Sudah</button>
                  </form>
                   <script>
                    function selesaiBayar() {
                    alert('Pembayaran berhasil!');
                    window.location.href = 'tes.php';
                    }
                    </script>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>


    
</body>
</html>