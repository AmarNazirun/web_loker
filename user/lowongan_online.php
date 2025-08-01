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
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Simpan lamaran ke database
        $query = "INSERT INTO lamaran (id_lowongan, id_user) VALUES ('$id_lowongan', '$user_id')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Lamaran berhasil dikirim!');</script>";
        } else {
            echo "<script>alert('Gagal mengirim lamaran. Silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Anda harus login terlebih dahulu untuk melamar.');</script>";
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
                <div class="col-lg-12">
                    
                    <?php
                    
                    // gabungkan tabel lowongan dengan tabel perusahaan
                    $query = "SELECT * FROM lowongan inner join data_perusahaan on lowongan.id_perusahaan = data_perusahaan.id_perusahaan"; 
                    $result = mysqli_query($koneksi, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Tampilkan data lowongan online
                        echo '<div class="card mb-3">';
                        echo '<div class="card-header">';
                        echo '<div class="card-body">';
                        echo '<h3>' . $row['posisi'] . '</h3>';
                        echo '<p>Perusahaan:  <a href="detail_perusahaan.php?id=' . $row['id_perusahaan'] . '">' . $row['nama_perusahaan'] . '</a></p>';
                        echo '<hr>';
                        echo '<p class="card-text"><strong>Deskripsi:</strong></p>';
                        echo '<p class="card-text">' . $row['deskripsi'] . '</p>';
                        echo '<p class="card-text"><strong>Tanggal Dibuka:</strong> ' . $row['tanggal_dibuka'] . '</p>';
                        echo '<p class="card-text"><strong>Tanggal Ditutup:</strong> ' . $row['tanggal_ditutup'] . '</p>';
                        echo '<hr>';
                        // Tampilkan tombol untuk melamar
                        echo '<form action="" method="post">';
                        echo '<input type="hidden" name="id_lowongan" value="' . $row['id_lowongan'] . '">';
                        echo '<input type="submit" name="lamar" class="btn btn-primary" value="Lamar Sekarang">';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    
                    ?>

                </div>
            </div>
        </section><!-- End Section -->

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