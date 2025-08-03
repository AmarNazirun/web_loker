<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

// ambil data user dan data_calon
include '../config/koneksi.php';
$query = "SELECT * FROM user inner join admin_disnaker on user.username = admin_disnaker.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// cek apakah tombol verifikasi sudah ditekan
if (isset($_POST['verifikasi'])) {
    $id_lowongan = $_POST['id_lowongan'];
    // update status lowongan menjadi terverifikasi
    $update_query = "UPDATE lowongan SET status = 'terverifikasi' WHERE id_lowongan = $id_lowongan";
    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Lowongan berhasil diverifikasi!');</script>";
        echo "<script>window.location.href='lowongan_online.php';</script>";
    } else {
        echo "<script>alert('Gagal memverifikasi lowongan!');</script>";
        echo "<script>window.location.href='verifikasi_lowongan.php';</script>";
    }
} elseif (isset($_POST['hapus'])) {
    $id_lowongan = $_POST['id_lowongan'];
    // hapus lowongan
    $delete_query = "DELETE FROM lowongan WHERE id_lowongan = $id_lowongan";
    if (mysqli_query($koneksi, $delete_query)) {
        echo "<script>alert('Lowongan berhasil dihapus!');</script>";
        echo "<script>window.location.href='verifikasi_lowongan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus lowongan!');</script>";
        echo "<script>window.location.href='verifikasi_lowongan.php';</script>";
    }
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
    <?php include '../assets/template/header_disnaker.php'; ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php //include '../assets/template/sidebar.php'; 
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Verifikasi Lowongan</h5>
                            <p>Berikut adalah daftar lowongan yang belum diverifikasi. Silakan klik tombol "Verifikasi" untuk memverifikasi lowongan tersebut.</p>
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Lowongan</th>
                                        <th scope="col">Perusahaan</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM lowongan inner join data_perusahaan on lowongan.id_perusahaan = data_perusahaan.id_perusahaan WHERE lowongan.status = 'belum terverifikasi'";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['posisi'] . "</td>";
                                        echo "<td>" . $row['nama_perusahaan'] . "</td>";
                                        echo "<td>" . $row['tanggal_dibuka'] . "</td>";
                                        echo "<td>
                                        <a href='detail_lowongan.php?id_lowongan=" . $row['id_lowongan'] . "' class='btn btn-info'>Detail</a>
                                        <form action='' method='post' style='display:inline;'>
                                            <input type='hidden' name='id_lowongan' value='" . $row['id_lowongan'] . "'>
                                            <input type='submit' name='verifikasi' class='btn btn-success' value='Verifikasi'>
                                        </form>
                                        <form action='' method='post' style='display:inline;'>
                                            <input type='hidden' name='id_lowongan' value='" . $row['id_lowongan'] . "'>
                                            <input type='submit' name='hapus' class='btn btn-danger' value='Hapus'>
                                        </form>
                                        </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
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