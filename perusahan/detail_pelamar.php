<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

// ambil data calon
include '../config/koneksi.php';
$query = "SELECT * FROM data_calon WHERE id_calon = $_GET[id_calon]";
$result = mysqli_query($koneksi, $query);
$data_calon = mysqli_fetch_assoc($result);

// ambil data perusahaan
$query_perusahaan = "SELECT * FROM data_perusahaan WHERE username = '$username'";
$result_perusahaan = mysqli_query($koneksi, $query_perusahaan);
$data = mysqli_fetch_assoc($result_perusahaan);

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

                <!-- profile -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Foto Profile Card -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 d-flex align-items-center justify-content-center">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Foto Profile</h5>
                                    <div class="d-flex align-items-center justify-content-center w-100" style="height: 250px;">
                                        <img src="../assets/img/foto_pelamar/<?php echo $data_calon['foto']; ?>" alt="Foto Profil" class="img-fluid" style="object-fit: cover; width: 200px; height: 200px;">
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="mb-1"><?php echo htmlspecialchars($data_calon['nama_lengkap']); ?></h5>
                                        <span class="text-muted">@<?php echo htmlspecialchars($data_calon['username']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Identitas Profile Card -->
                        <div class="col-md-8 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Profile</h5>
                                    <form action="" method="post">
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Username</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($data_calon['username']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Nama Lengkap</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($data_calon['nama_lengkap']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Handphone</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="handphone" class="form-control" value="<?php echo htmlspecialchars($data_calon['handphone']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Tempat Lahir</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($data_calon['tempat_lahir']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Jenis Kelamin</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jenis_kelamin" class="form-control" value="<?php echo htmlspecialchars($data_calon['jenis_kelamin']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Agama</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="agama" class="form-control" value="<?php echo htmlspecialchars($data_calon['agama']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Status Kawin</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="status_kawin" class="form-control" value="<?php echo htmlspecialchars($data_calon['status_kawin']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>No KTP</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="golongan_darah" class="form-control" value="<?php echo htmlspecialchars($data_calon['no_ktp']); ?>" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-3 text-end">
                                            <div class="row g-2">
                                                <div class="col-12 col-md-6">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_calon" value="<?php echo $data_calon['id_calon']; ?>">
                                                        <input type="hidden" name="id_lowongan" value="<?php echo $_GET['id_lowongan']; ?>">
                                                        <input type="submit" name="terima_lamaran" class="btn btn-success w-100" value="Terima" onclick="return confirm('Apakah Anda yakin ingin menerima pelamar ini?');">
                                                    </form>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_calon" value="<?php echo $data_calon['id_calon']; ?>">
                                                        <input type="hidden" name="id_lowongan" value="<?php echo $_GET['id_lowongan']; ?>">
                                                        <input type="submit" name="tolak_lamaran" class="btn btn-danger w-100" value="Tolak" onclick="return confirm('Apakah Anda yakin ingin menolak pelamar ini?');">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- pengalaman kerja -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Pengalaman Kerja</h5>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perusahaan</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Tahun Awal</th>
                                        <th>Tahun Akhir</th>
                                        <th>Posisi</th>
                                        <th>Tanggung Jawab</th>
                                        <th>Alasan Keluar</th>
                                        <th>Gaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_pengalaman = "SELECT * FROM data_calon INNER JOIN pengalaman_kerja ON data_calon.id_calon = pengalaman_kerja.id_calon WHERE data_calon.username = '$data_calon[username]'";
                                    $result_pengalaman = mysqli_query($koneksi, $query_pengalaman);
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result_pengalaman)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['perusahaan'] . "</td>";
                                        echo "<td>" . $row['alamat_perusahaan'] . "</td>";
                                        echo "<td>" . $row['telepon'] . "</td>";
                                        echo "<td>" . $row['tahun_awal'] . "</td>";
                                        echo "<td>" . $row['tahun_akhir'] . "</td>";
                                        echo "<td>" . $row['posisi'] . "</td>";
                                        echo "<td>" . $row['tanggung_jawab'] . "</td>";
                                        echo "<td>" . $row['alasan_keluar'] . "</td>";
                                        echo "<td>" . $row['gaji_terakhir'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- prestasi -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Prestasi</h5>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lembaga</th>
                                        <th>Bidang</th>
                                        <th>Tahun Awal</th>
                                        <th>Tahun Akhir</th>
                                        <th>Negara Kota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_prestasi = "SELECT * FROM data_calon INNER JOIN prestasi_calon ON data_calon.id_calon = prestasi_calon.id_calon WHERE data_calon.username = '$data_calon[username]'";
                                    $result_prestasi = mysqli_query($koneksi, $query_prestasi);
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result_prestasi)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['lembaga'] . "</td>";
                                        echo "<td>" . $row['bidang'] . "</td>";
                                        echo "<td>" . $row['tahun_awal'] . "</td>";
                                        echo "<td>" . $row['tahun_akhir'] . "</td>";
                                        echo "<td>" . $row['negara_kota'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Organisasi -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Organisasi</h5>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lembaga</th>
                                        <th>Bidang</th>
                                        <th>Tahun Awal</th>
                                        <th>Tahun Akhir</th>
                                        <th>Negara Kota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_organisasi = "SELECT * FROM data_calon INNER JOIN organisasi_calon ON data_calon.id_calon = organisasi_calon.id_calon WHERE data_calon.username = '$data_calon[username]'";
                                    $result_organisasi = mysqli_query($koneksi, $query_organisasi);
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result_organisasi)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['lembaga'] . "</td>";
                                        echo "<td>" . $row['bidang'] . "</td>";
                                        echo "<td>" . $row['tahun_awal'] . "</td>";
                                        echo "<td>" . $row['tahun_akhir'] . "</td>";
                                        echo "<td>" . $row['negara_kota'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pendidikan -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="card-title">Pendidikan</h5>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Lembaga</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Awal</th>
                                        <th>Tahun Akhir</th>
                                        <th>Kota</th>
                                        <th>Lulus</th>
                                        <th>gpa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_organisasi = "SELECT * FROM data_calon INNER JOIN pendidikan_calon ON data_calon.id_calon = pendidikan_calon.id_calon WHERE data_calon.username = '$data_calon[username]'";
                                    $result_organisasi = mysqli_query($koneksi, $query_organisasi);
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result_organisasi)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['lembaga'] . "</td>";
                                        echo "<td>" . $row['jurusan'] . "</td>";
                                        echo "<td>" . $row['tahun_awal'] . "</td>";
                                        echo "<td>" . $row['tahun_akhir'] . "</td>";
                                        echo "<td>" . $row['kota'] . "</td>";
                                        echo "<td>" . $row['lulus'] . "</td>";
                                        echo "<td>" . $row['gpa'] . "</td>";
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