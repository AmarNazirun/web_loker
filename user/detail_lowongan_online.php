<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Detail Lowongan</title>
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
    <?php include '../assets/template/header3.php'; ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php //include '../assets/template/sidebar.php'; 
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Lowongan</h1>
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
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail Lowongan</h5>
                            <p class="card-text">Berikut adalah detail dari lowongan yang Anda pilih.</p>
                            <?php
                            // Include database connection
                            include '../assets/koneksi.php';
                            // Get the ID of the job vacancy from the URL
                            $id_lowongan = $_GET['id_lowongan'];
                            // Query to get the job vacancy details
                            $query = "SELECT * FROM lowongan INNER JOIN data_perusahaan ON lowongan.id_perusahaan = data_perusahaan.id_perusahaan WHERE id_lowongan = '$id_lowongan'";
                            $result = mysqli_query($koneksi, $query);
                            // Check if the query was successful
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Fetch the job vacancy details
                                $row = mysqli_fetch_assoc($result);
                                // Display the job vacancy details
                                echo '<h3>' . $row['posisi'] . '</h3>';
                                echo '<p>Perusahaan: <a href="detail_perusahaan.php?id=' . $row['id_perusahaan'] . '">' . $row['nama_perusahaan'] . '</a></p>';
                                echo '<p>Lokasi: ' . $row['lokasi'] . '</p>';
                                echo '<p>Gaji: ' . $row['gaji'] . '</p>';
                                echo '<p>Deskripsi: ' . $row['deskripsi'] . '</p>';
                            } else {
                                echo '<p>Lowongan tidak ditemukan.</p>';
                            }
                            ?>
                            <hr>
                            <p class="card-text"><strong>Tanggal Dibuka:</strong> <?php echo $row['tanggal_dibuka']; ?></p>
                            <p class="card-text"><strong>Tanggal Ditutup:</strong> <?php echo $row['tanggal_ditutup']; ?></p>
                            <hr>
                            <a href="lowongan_online.php" class="btn btn-primary">Kembali ke Lowongan Online</a>
                        </div>
                    </div>
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