<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

// ambil data user dan data_calon
include '../config/koneksi.php';
$query = "SELECT * FROM user inner join data_perusahaan on user.username = data_perusahaan.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// cek apakah tombol tambah lowongan sudah ditekan
if (isset($_POST['tambah_lowongan'])) {
    // ambil data dari form
    $judul_lowongan = $_POST['judul_lowongan'];
    $tanggal_dibuka = $_POST['tanggal_dibuka'];
    $tanggal_ditutup = $_POST['tanggal_ditutup'];
    $deskripsi = $_POST['deskripsi'];

    // query untuk memasukkan data lowongan ke database
    $query = "INSERT INTO lowongan (posisi, deskripsi, tanggal_dibuka, tanggal_ditutup, status, id_perusahaan) VALUES ('$judul_lowongan', '$deskripsi', '$tanggal_dibuka', '$tanggal_ditutup', 'belum terverifikasi', $data[id_perusahaan])";
    $result = mysqli_query($koneksi, $query);

    

    // cek apakah query berhasil
    if ($result) {
        echo "<script>alert('Lowongan berhasil ditambahkan!'); window.location.href='lowongan_saya.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan lowongan. Silakan coba lagi.'); window.location.href='tambah_lowongan.php';</script>";
    }
} elseif (isset($_POST['batal'])) {
    // jika tombol batal ditekan, redirect ke halaman lowongan
    header("Location: lowongan.php");
    exit();
}

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
    <?php include '../assets/template/header_perusahaan.php'; ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php //include '../assets/template/sidebar.php'; 
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Lowongan</h5>

                            <!-- Form Tambah Lowongan -->
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="judul_lowongan" class="form-label">Posisi Lowongan Yang Dicari</label>
                                        <input type="text" class="form-control" id="judul_lowongan" name="judul_lowongan" required>
                                    </div>
                                    <div class="mb-3 col-4"">
                                        <label for=" tanggal_dibuka" class="form-label">Tanggal Dibuka</label>
                                        <input type="date" class="form-control" id="tanggal_dibuka" name="tanggal_dibuka" required>
                                    </div>
                                    <div class="mb-3 col-4"">
                                        <label for=" tanggal_ditutup" class="form-label">Tanggal Ditutup</label>
                                        <input type="date" class="form-control" id="tanggal_ditutup" name="tanggal_ditutup" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Lowongan</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="6" required></textarea>
                                </div>
                                <hr>
                                <input type="submit" class="btn btn-primary" name="tambah_lowongan" value="Tambah Lowongan">
                                <input type="submit" class="btn btn-danger" name="batal" value="Batal">
                            </form>
                        </div>
                    </div>
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