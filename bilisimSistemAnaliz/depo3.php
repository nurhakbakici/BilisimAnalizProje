<?php include("oturumKontrol.php"); ?>
<?php
// Rastgele renk oluşturan fonksiyon
function randomColor()
{
  return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}
// Veritabanına bağlan
include '02_baglan.php';

// Depo 1 ürünlerini listeleyen SQL sorgusu (urunler tablosu ile birleştirme)
$sql = "SELECT s.urun_id, u.urun_adi, SUM(s.miktar) AS urun_adedi FROM stok s
        JOIN urunler u ON s.urun_id = u.urun_id
        WHERE s.depo_id = 3
        GROUP BY s.urun_id";
$result = $conn->query($sql);

// Chart.js için gerekli veriyi oluştur
$labels = [];
$data = [];
$colors = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $labels[] = $row['urun_adi'];
    $data[] = $row['urun_adedi'];
    $colors[] = randomColor();
  }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>


<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>AYKUTSAN</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">AYKUTSAN</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></div>
    <!-- Navbar-->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <!--  <li><a class="dropdown-item" href="#!">Settings</a></li>-->
          <!-- <li><a class="dropdown-item" href="#!">Activity Log</a></li>-->
          <li class="dropdown-header">
            <?php echo $yonetici_adi; ?>
          </li>
          <li><a class="dropdown-item" href="cikisYap.php">Çıkış Yap</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <a class="nav-link" href="index.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Gösterge Paneli
            </a>
            <a class="nav-link" href="stokHareketleriListele.php">
              <div class="sb-nav-link-icon">
                <i class="fas fa-dolly"></i>
              </div>
              Stok Hareketleri
            </a>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="fas fa-warehouse" style="color:blue"></i></div>
              Depo Listele
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link" href="depo1.php">
                  <div class="sb-nav-link-icon"><i class="fa fa-align-left"></i></div>
                  Depo 1
                </a>
                <a class="nav-link" href="depo2.php">
                  <div class="sb-nav-link-icon"><i class="fa fa-align-left"></i></div>
                  Depo 2
                </a>
                <a class="nav-link" href="depo3.php">
                  <div class="sb-nav-link-icon"><i class="fa fa-align-left" style="color:blue"></i></div>
                  Depo 3
                </a>

              </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Düzenleme İşlemleri</div>
            <a class="nav-link" href="urunDuzenleSayfa.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-pen"></i>
              </div>
              Ürün Düzenle
            </a>
            <a class="nav-link" href="tedarikciDuzenleSayfa.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-boxes-packing"></i>
              </div>
              Tedarikçi Düzenle
            </a>
            <a class="nav-link" href="kategoriDuzenleSayfa.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-layer-group"></i>
              </div>
              Kategori Düzenle
            </a>
            <a class="nav-link" href="yoneticiDuzenleSayfa.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-user-tie"></i>
              </div>
              Yönetici Düzenle
            </a>
            <a class="nav-link" href="depoDuzenleSayfa.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-warehouse"></i>
              </div>
              Depo Düzenle
            </a>
            <a class="nav-link" href="stokDuzenleSayfa.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-box-open"></i>
              </div>
              Stok Düzenle
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
            </div>
            <div class="sb-sidenav-menu-heading">Tablolar</div>
            <a class="nav-link" href="urunListele.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-align-left"></i>
              </div>
              Ürün Listele
            </a>
            <a class="nav-link" href="tedarikciListele.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-truck-field"></i>
              </div>
              Tedarikçi Listele
            </a>
            <a class="nav-link" href="depoListele.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-warehouse"></i>
              </div>
              Depo Listele
            </a>
            <a class="nav-link" href="yoneticiListele.php">
              <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
              Yönetici Listele
            </a>
            <a class="nav-link" href="kategoriListele.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-layer-group"></i>
              </div>
              Kategori Listele
            </a>
            <a class="nav-link" href="stokListele.php">
              <div class="sb-nav-link-icon">
                <i class="fa fa-boxes-stacked"></i>
              </div>
              Stok Listele
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Depo 3 Ürünler</h1>
          <canvas id="myChart" width="250" height="150"></canvas>
        </div>
    </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">Copyright &copy;AYKUTSAN</div>
        </div>
      </div>
    </footer>
  </div>
  </div>
</body>
<script>
  // Verileri Chart.js formatına dönüştür
  var labels = <?php echo json_encode($labels); ?>;
  var data = <?php echo json_encode($data); ?>;
  var colors = <?php echo json_encode($colors); ?>;

  // Chart.js grafiği oluştur
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Ürün Adedi',
        data: data,
        backgroundColor: colors,
        borderColor: colors,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
  crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>