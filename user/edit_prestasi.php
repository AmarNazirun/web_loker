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
    <?php //include '../assets/template/sidebar.php'; 
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Perbaharui Data Prestasi</h5>
                            <?php
                            // query untuk mengambil data pengalaman kerja
                            $query = "SELECT * FROM prestasi_calon WHERE id_calon = $data[id_calon]";
                            $result = mysqli_query($koneksi, $query);
                            $data = mysqli_fetch_assoc($result);
                            ?>
                            <!-- General Form Elements -->
                            <form action="" method="post" class="row g-3">
                                <div class="col-md-4">
                                    <label for="lembaga" class="form-label">Lembaga</label>
                                    <input type="text" class="form-control" id="lembaga" name="lembaga" <?php echo $data['lembaga'] ? 'value="' . htmlspecialchars($data['lembaga']) . '"' : ''; ?> required>
                                </div>
                                <div class="col-md-4">
                                    <label for="bidang" class="form-label">Bidang</label>
                                    <input type="text" class="form-control" id="bidang" name="bidang" <?php echo $data['bidang'] ? 'value="' . htmlspecialchars($data['bidang']) . '"' : ''; ?> required>
                                </div>
                                <div class="col-md-4">
                                    <label for="tahun_awal" class="form-label">Tahun Awal</label>
                                    <input type="text" class="form-control" id="tahun_awal" name="tahun_awal" <?php echo $data['tahun_awal'] ? 'value="' . htmlspecialchars($data['tahun_awal']) . '"' : ''; ?> required>
                                </div>
                                <div class="col-md-4">
                                    <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
                                    <input type="text" class="form-control" id="tahun_akhir" name="tahun_akhir" <?php echo $data['tahun_akhir'] ? 'value="' . htmlspecialchars($data['tahun_akhir']) . '"' : ''; ?> required>
                                </div>
                                <div class="col-md-4">
                                    <label for="negara_kota" class="form-label">Negara Kota</label>
                                    <input type="text" class="form-control" id="negara_kota" name="negara_kota" <?php echo $data['negara_kota'] ? 'value="' . htmlspecialchars($data['negara_kota']) . '"' : ''; ?> required>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan">
                            </form><!-- End General Form Elements -->
                            <?php
                            if (isset($_POST['submit'])) {
                                // ambil data dari form
                                $lembaga = $_POST['lembaga'];
                                $bidang = $_POST['bidang'];
                                $tahun_awal = $_POST['tahun_awal'];
                                $tahun_akhir = $_POST['tahun_akhir'];
                                $negara_kota = $_POST['negara_kota'];

                                // update data ke database
                                $query = "UPDATE prestasi_calon SET lembaga='$lembaga', bidang='$bidang', tahun_awal='$tahun_awal', tahun_akhir='$tahun_akhir', negara_kota='$negara_kota' WHERE id_prestasi=$_GET[id_prestasi]";
                                if (mysqli_query($koneksi, $query)) {
                                    echo "<script>alert('Data Prestasi berhasil disimpan');</script>";
                                    echo "<script>window.location.href='user_profile.php';</script>";
                                } else {
                                    echo "<script>alert('Gagal menyimpan data Prestasi');</script>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div><!-- End General Form Elements -->
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