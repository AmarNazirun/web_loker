<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

// ambil data user dan data_calon
include '../config/koneksi.php';
$query = "SELECT * FROM user inner join data_perusahaan on user.username = data_perusahaan.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// cek apakah tombol terima_lamaran atau tolak_lamaran ditekan
if (isset($_POST['terima_lamaran']) || isset($_POST['tolak_lamaran'])) {
    $id_calon = $_POST['id_calon'];
    $id_lowongan = $_POST['id_lowongan'];
    $status = isset($_POST['terima_lamaran']) ? 'Diterima' : 'Ditolak';

    // update status pelamar
    $update_status = "UPDATE pelamar SET status_lamaran = '$status' WHERE id_calon = $id_calon AND id_lowongan = $id_lowongan";
    if (mysqli_query($koneksi, $update_status)) {
        $message = "Lamaran telah " . strtolower($status) . ".";
        echo "<script>alert('$message'); window.location.href='detail_lowongan.php?id_lowongan=$id_lowongan';</script>";
    } else {
        $message = "Gagal mengupdate status pelamar.";
        echo "<script>alert('$message'); window.location.href='detail_lowongan.php?id_lowongan=$id_lowongan';</script>";
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

                    <!-- tabel pelamar -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Pelamar</h5>
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pelamar</th>
                                        <th scope="col">Handphone</th>
                                        <th scope="col">Tanggal Melamar</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_pelamar = "SELECT * FROM pelamar inner join data_calon on pelamar.id_calon = data_calon.id_calon WHERE id_lowongan = '" . $_GET['id_lowongan'] . "'";
                                    $result_pelamar = mysqli_query($koneksi, $query_pelamar);
                                    $no = 1;
                                    while ($pelamar = mysqli_fetch_assoc($result_pelamar)) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $no++; ?></th>
                                            <td><?php echo $pelamar['nama_lengkap']; ?></td>
                                            <td><?php echo $pelamar['handphone']; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($pelamar['tanggal_melamar'])); ?></td>
                                            <td><?php echo $pelamar['status_lamaran']; ?></td>
                                            <td>
                                                <a href="detail_pelamar.php?id_calon=<?php echo $pelamar['id_calon']; ?>&id_lowongan=<?php echo $_GET['id_lowongan']; ?>" class="btn btn-info btn-sm">Detail</a>
                                                <form action="" method="post" class="d-inline">
                                                    <input type="hidden" name="id_calon" value="<?php echo $pelamar['id_calon']; ?>">
                                                    <input type="hidden" name="id_lowongan" value="<?php echo $_GET['id_lowongan']; ?>">
                                                    <input type="submit" name="terima_lamaran" class="btn btn-success btn-sm" value="Terima" onclick="return confirm('Apakah Anda yakin ingin menerima pelamar ini?');">
                                                    <input type="submit" name="tolak_lamaran" class="btn btn-danger btn-sm" value="Tolak" onclick="return confirm('Apakah Anda yakin ingin menolak pelamar ini?');">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($no == 1) {
                                        echo "<tr><td colspan='5' class='text-center'>Tidak ada pelamar untuk lowongan ini.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- End tabel pelamar -->
                        </div>
                    </div>
                    <!-- End tabel pelamar -->

                    <!-- Form Tambah Lowongan -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail Lowongan</h5>

                            <!-- Form Tambah Lowongan -->
                            <form action="" method="POST">
                                <?php
                                $query = "SELECT * FROM lowongan WHERE id_lowongan = '" . $_GET['id_lowongan'] . "'";
                                $result = mysqli_query($koneksi, $query);
                                $lowongan = mysqli_fetch_assoc($result);
                                ?>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="judul_lowongan" class="form-label">Posisi Lowongan Yang Dicari</label>
                                        <span class="d-block"><b><?php echo $lowongan['posisi']; ?></b></span>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for=" tanggal_dibuka" class="form-label">Jenis Pekerjaan</label>
                                        <span class="d-block"><b><?php echo $lowongan['jenis_pekerjaan']; ?></b></span>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for=" tanggal_dibuka" class="form-label">Pendidikan Minimal</label>
                                        <span class="d-block"><b><?php echo $lowongan['pendidikan_minimal']; ?></b></span>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for=" tanggal_dibuka" class="form-label">Gaji</label>
                                        <span class="d-block"><b>Rp. <?php echo $lowongan['gaji']; ?> /Bulan</b></span>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for=" tanggal_dibuka" class="form-label">Tanggal Dibuka</label>
                                        <span class="d-block"><b><?php echo date('d M Y', strtotime($lowongan['tanggal_dibuka'])); ?></b></span>
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for=" tanggal_ditutup" class="form-label">Tanggal Ditutup</label>
                                        <span class="d-block"><b><?php echo date('d M Y', strtotime($lowongan['tanggal_ditutup'])); ?></b></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label"><b>Deskripsi Lowongan</b></label>
                                    <p id="deskripsi" name="deskripsi">
                                        <?php echo nl2br(htmlspecialchars($lowongan['deskripsi'])); ?>
                                    </p>
                                </div>
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