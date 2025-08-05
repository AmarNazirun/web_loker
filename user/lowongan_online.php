<?php
// error_reporting(0);
// ob_start();
session_start();

$username = $_SESSION['username'];

// ambil data user dan data_calon
include '../config/koneksi.php';
$query = "SELECT * FROM user inner join data_calon on user.username = data_calon.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Cek apakah form lamaran telah disubmit
if (isset($_POST['lamar'])) {
    // Ambil ID lowongan dari form
    $id_lowongan = $_POST['id_lowongan'];

    // Cek apakah pengguna sudah login
    if (isset($_SESSION['username'])) {
        // Ambil ID user dari session
        $user_id = $data['id_calon'];
        // Cek apakah user sudah melamar untuk lowongan ini
        $check_query = "SELECT * FROM pelamar WHERE id_lowongan = '$id_lowongan' AND id_calon = '$user_id'";
        $check_result = mysqli_query($koneksi, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            // Jika sudah melamar, tampilkan pesan
            echo '<script>alert("Anda sudah melamar untuk lowongan ini.");</script>';
            echo '<script>window.location.href = "lowongan_online.php";</script>';
        } else {
            // Jika belum melamar, lakukan proses lamaran
            $insert_query = "INSERT INTO pelamar (tanggal_melamar, id_lowongan, id_calon, status_lamaran) VALUES (NOW(), '$id_lowongan', '$user_id', 'Menunggu Konfirmasi')";
            if (mysqli_query($koneksi, $insert_query)) {
                // Jika berhasil, tampilkan pesan sukses
                echo '<script>alert("Lamaran Anda telah berhasil dikirim.");</script>';
                echo '<script>window.location.href = "histori_lamaran_user.php";</script>';
            } else {
                // Jika gagal, tampilkan pesan error
                echo '<script>alert("Terjadi kesalahan saat mengirim lamaran. Silakan coba lagi.");</script>';
                echo '<script>window.location.href = "lowongan_online.php";</script>';
            }
        }
    } else {
        // Jika pengguna belum login, tampilkan pesan
        echo '<script>alert("Anda harus login terlebih dahulu untuk melamar.");</script>';
        echo '<script>window.location.href = "../login.php";</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Lowongan Online</title>
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
    <?php //include '../assets/template/sidebar.php'; 
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Lowongan Online</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Lowongan Online</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            
            <div class="row">
                <?php
                $query = "SELECT * FROM lowongan inner join data_perusahaan on lowongan.id_perusahaan = data_perusahaan.id_perusahaan WHERE lowongan.status = 'Terverifikasi'";
                $result = mysqli_query($koneksi, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <!-- card lowongan -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="detail_lowongan.php?id_lowongan=<?php echo $row['id_lowongan']; ?>" class="text-decoration-none">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['posisi']; ?></h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <img src="../assets/img/logo_perusahaan/<?php echo $row['logo']; ?>" alt="Logo Perusahaan" class="img-fluid" style="width: 50px; height: 50px;">
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $row['nama_perusahaan']; ?></h6>
                                            <!-- icon uang -->
                                            <p class="small mb-0"><i class="bi bi-cash-coin"></i> <?php //echo $row['gaji']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- End card lowongan -->
                <?php
                }
                ?>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include '../assets/template/footer.php'; ?>
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