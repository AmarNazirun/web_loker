<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

include '../config/koneksi.php';
$query = "SELECT * FROM user inner join admin_disnaker on user.username = admin_disnaker.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// ambil data perusahaaan berdasarkan id dengan get
$id_perusahaan = $_GET['id_perusahaan'];
$query_perusahaan = "SELECT * FROM data_perusahaan WHERE id_perusahaan = $id_perusahaan";
$result_perusahaan = mysqli_query($koneksi, $query_perusahaan);
$data_perusahaan = mysqli_fetch_assoc($result_perusahaan);


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
    <?php include '../assets/template/header_disnaker.php'; ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php //include '../assets/template/sidebar.php'; 
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">
                <!-- profile -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Foto Profile Card -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 d-flex align-items-center justify-content-center">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Logo Perusahaan</h5>
                                    <div class="d-flex align-items-center justify-content-center w-100" style="height: 250px;">
                                        <img src="../assets/img/logo_perusahaan/<?php echo $data_perusahaan['logo']; ?>" alt="Logo Perusahaan" class="img-fluid" style="object-fit: cover; width: 200px; height: 200px;">
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="mb-1"><?php echo htmlspecialchars($data_perusahaan['nama_perusahaan']); ?></h5>
                                        <span class="text-muted">@<?php echo htmlspecialchars($data['username']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Identitas Profile Card -->
                        <div class="col-md-8 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Profile Perusahaan</h5>
                                    <form action="" method="post">
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Username</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['username']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Nama Perusahaan</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_perusahaan" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['nama_perusahaan']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Telepone</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="telepon" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['telepon']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Alamat</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['alamat']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Email</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['email']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Facebook</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="facebook" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['facebook']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Instagram</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="instagram" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['instagram']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Twitter/X</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="x" class="form-control" value="<?php echo htmlspecialchars($data_perusahaan['x']); ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <!-- card tentang perusahaan -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tentang Perusahaan</h5>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <!-- textarea -->
                                    <textarea class="form-control" name="tentang_perusahaan" rows="15" placeholder="Deskripsi Tentang Perusahaan"><?php echo htmlspecialchars($data_perusahaan['tentang_perusahaan']); ?></textarea>
                                </div>
                            </form>
                        </div>
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