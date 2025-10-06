<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

// ambil data user dan data_calon
include '../config/koneksi.php';
$query = "SELECT * FROM user inner join data_calon on user.username = data_calon.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<style>
  
</style>

<body>

  <!-- ======= Header ======= -->
  <?php include '../assets/template/header_user.php'; ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php //include '../assets/template/sidebar.php'; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- card jumlah lowongan -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Jumlah Lowongan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-briefcase-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $query = "SELECT COUNT(*) AS total_lowongan FROM lowongan";
                      $result = mysqli_query($koneksi, $query);
                      $data = mysqli_fetch_assoc($result);
                      $total_lowongan = $data['total_lowongan'];
                      ?>
                      <h6><?php echo $total_lowongan; ?></h6>
                      <span class="text-success small pt-1 fw-bold">Lowongan</span> <span class="text-muted small pt-2 ps-1">Tersedia</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End card jumlah lowongan-->

            <!-- card jumlah perusahaan -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Jumlah Perusahaan</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $query = "SELECT COUNT(*) AS total_perusahaan FROM data_perusahaan";
                      $result = mysqli_query($koneksi, $query);
                      $data = mysqli_fetch_assoc($result);
                      $total_perusahaan = $data['total_perusahaan'];
                      ?>
                      <h6><?php echo $total_perusahaan; ?></h6>
                      <span class="text-success small pt-1 fw-bold">Perusahaan</span> <span class="text-muted small pt-2 ps-1">Terdaftar</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End card jumlah perusahaan-->

            <!-- card jumlah pelamar -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Jumlah Pelamar</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $query = "SELECT COUNT(*) AS total_pelamar FROM data_calon";
                      $result = mysqli_query($koneksi, $query);
                      $data = mysqli_fetch_assoc($result);
                      $total_pelamar = $data['total_pelamar'];
                      ?>
                      <h6><?php echo $total_pelamar; ?></h6>
                      <span class="text-success small pt-1 fw-bold">Pelamar</span> <span class="text-muted small pt-2 ps-1">Terdaftar</span>

                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End card jumlah pelamar-->

            <!-- jumlah lowongan terbaru bulan ini -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Lowongan Bulan Ini</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-event-fill"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $current_month = date('m');
                      $current_year = date('Y');
                      $query = "SELECT COUNT(*) AS total_lowongan_bulan_ini FROM lowongan WHERE MONTH(tanggal_dibuka) = '$current_month' AND YEAR(tanggal_dibuka) = '$current_year'";
                      $result = mysqli_query($koneksi, $query);
                      $data = mysqli_fetch_assoc($result);
                      $total_lowongan_bulan_ini = $data['total_lowongan_bulan_ini'];
                      ?>
                      <h6><?php echo $total_lowongan_bulan_ini; ?></h6>
                      <span class="text-success small pt-1 fw-bold">Lowongan</span> <span class="text-muted small pt-2 ps-1">Bulan Ini</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End jumlah lowongan terbaru bulan ini-->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- 5 loker terbaru -->
          <div class="card">

            <div class="card-body pb-0">
              <h5 class="card-title">Lowongan Terbaru</h5>

              <?php
              $query = "SELECT * FROM lowongan JOIN data_perusahaan ON lowongan.id_perusahaan = data_perusahaan.id_perusahaan ORDER BY lowongan.tanggal_dibuka DESC LIMIT 5";
              $result = mysqli_query($koneksi, $query);
              while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <div class="news">
                  <div class="post-item clearfix">
                    <img src="assets/img/logo_perusahaan/<?php echo $row['logo']; ?>" alt="Logo Perusahaan" class="img-fluid" style="width: 50px; height: 50px;">
                    <h4><a href="detail_lowongan.php?id_lowongan=<?php echo $row['id_lowongan']; ?>&id_perusahaan=<?php echo $row['id_perusahaan']; ?>"><?php echo $row['posisi']; ?></a></h4>

                    <p><?php echo $row['nama_perusahaan']; ?></p>
                  </div>
                </div><!-- End sidebar recent posts-->
              <?php } ?>
            </div>
          </div>
          <!-- End Lowongan Terbaru -->

          <!-- jumlah pekerjaan berdasarkan pendidikan -->
          <div class="card">

            
          </div><!-- End Website Traffic -->

        </div>
      </div><!-- End Website Traffic -->

      <!-- News & Updates Traffic -->

      <!-- End News & Updates -->

      </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  <br>
  <br>
  <br>
  <br>
  <br>

  <!-- ======= Footer ======= -->
  <?php include 'assets/template/footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>