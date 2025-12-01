<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

// ambil data user dan data_calon
include '../config/koneksi.php';
$query = "SELECT * FROM user inner join data_perusahaan on user.username = data_perusahaan.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// jika lowongan dihapus
if (isset($_POST['hapus_lowongan'])) {
    
    $id_lowongan = $_POST['id_lowongan'];
    $hapus_lowongan = "DELETE FROM lowongan WHERE id_lowongan = '$id_lowongan'";
    $hapus_pelamar = "DELETE FROM pelamar WHERE id_lowongan = '$id_lowongan'";
    
    if (mysqli_query($koneksi, $hapus_lowongan) && mysqli_query($koneksi, $hapus_pelamar)) {
        echo "<script>alert('Lowongan berhasil dihapus.'); window.location.href='lowongan_saya.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus lowongan.'); window.location.href='lowongan_saya.php';</script>";
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
                            <h5 class="card-title">Lowongan Saya</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Posisi Lowongan</th>
                                        <th scope="col">Tanggal Dibuka</th>
                                        <th scope="col">Tanggal Ditutup</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Jumlah Pelamar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM lowongan WHERE id_perusahaan = $data[id_perusahaan] ORDER BY tanggal_dibuka DESC";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // status aktif jika tanggal ditutup belum lewat
                                        $status_aktif = (strtotime($row['tanggal_ditutup']) >= time()) ? 'Aktif' : 'Tidak Aktif'; 
                                        $jumlah_pelamar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pelamar WHERE id_lowongan = '" . $row['id_lowongan'] . "'"));
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $no++; ?></th>
                                            <td><?php echo $row['posisi']; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row['tanggal_dibuka'])); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row['tanggal_ditutup'])); ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $jumlah_pelamar; ?></td>
                                            <td>
                                                <a href="detail_lowongan.php?id_lowongan=<?php echo $row['id_lowongan']; ?>" class="btn btn-info btn-sm">Detail</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="hidden" name="id_lowongan" value="<?php echo $row['id_lowongan']; ?>">
                                                    <input type="submit" name="hapus_lowongan" class="btn btn-danger btn-sm" value="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($no == 1) {
                                        echo "<tr><td colspan='8' class='text-center'>Tidak ada lowongan yang tersedia.</td></tr>";
                                    } ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
        </section>

    </main><!-- End #main -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

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