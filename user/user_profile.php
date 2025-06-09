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

                <!-- profile -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="../assets/img/<?php echo $data['foto']; ?>" alt="Foto Profil" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                                </div>
                                <div class="col-md-8">
                                    <h5>Username: <?php echo $data['username']; ?></h5>
                                    <p>Nama: <?php echo $data['nama_lengkap']; ?></p>
                                    <p>Posisi Lamar: <?php echo $data['posisi_lamar']; ?></p>
                                    <p>Telepon Rumah: <?php echo $data['telepon_rumah']; ?></p>
                                    <p>Handphone: <?php echo $data['handphone']; ?></p>
                                    <p>Tempat Lahir: <?php echo $data['tempat_lahir']; ?></p>
                                    <p>Jenis Kelamin: <?php echo $data['jenis_kelamin']; ?></p>
                                    <p>Agama: <?php echo $data['agama']; ?></p>
                                    <p>Status Kawin: <?php echo $data['status_kawin']; ?></p>
                                    <p>Golongan Darah: <?php echo $data['golongan_darah']; ?></p>
                                    <p>No. KTP: <?php echo $data['no_ktp']; ?></p>
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
                                <div class="col-md-6 text-end">
                                    <a href="tambah_pengalaman.php" class="btn btn-sm btn-primary m-4">Tambah Pengalaman Kerja</a>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Posisi</th>
                                        <th>Tahun Awal</th>
                                        <th>Tahun Akhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_pengalaman = "SELECT * FROM data_calon INNER JOIN pengalaman_kerja ON data_calon.id_calon = pengalaman_kerja.id_calon WHERE data_calon.username = '$data[username]'";
                                    $result_pengalaman = mysqli_query($koneksi, $query_pengalaman);
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result_pengalaman)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . $row['perusahaan'] . "</td>";
                                        echo "<td>" . $row['posisi'] . "</td>";
                                        echo "<td>" . $row['tahun_awal'] . "</td>";
                                        echo "<td>" . $row['tahun_akhir'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit_pengalaman.php?id_pengalaman=" . $row['id_pengalaman'] . "' class='btn btn-sm btn-warning'>Edit</a> ";
                                        echo "<a href='hapus_pengalaman.php?id_pengalaman=" . $row['id_pengalaman'] . "' class='btn btn-sm btn-danger'>Hapus</a>";
                                        echo "</td>";
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
                                <div class="col-md-6 text-end">
                                    <a href="tambah_prestasi.php" class="btn btn-sm btn-primary m-4">Tambah Prestasi</a>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_prestasi = "SELECT * FROM data_calon INNER JOIN prestasi_calon ON data_calon.id_calon = prestasi_calon.id_calon WHERE data_calon.username = '$data[username]'";
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
                                        echo "<td>";
                                        echo "<a href='edit_prestasi.php?id_prestasi=" . $row['id_prestasi'] . "' class='btn btn-sm btn-warning'>Edit</a> ";
                                        echo "<a href='hapus_prestasi.php?id_prestasi=" . $row['id_prestasi'] . "' class='btn btn-sm btn-danger'>Hapus</a>";
                                        echo "</td>";
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
                                <div class="col-md-6 text-end">
                                    <a href="tambah_organisasi.php" class="btn btn-sm btn-primary m-4">Tambah Organisasi</a>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_organisasi = "SELECT * FROM data_calon INNER JOIN organisasi_calon ON data_calon.id_calon = organisasi_calon.id_calon WHERE data_calon.username = '$data[username]'";
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
                                        echo "<td>";
                                        echo "<a href='edit_organisasi.php?id_organisasi=" . $row['id_organisasi'] . "' class='btn btn-sm btn-warning'>Edit</a> ";
                                        echo "<a href='hapus_organisasi.php?id_organisasi=" . $row['id_organisasi'] . "' class='btn btn-sm btn-danger'>Hapus</a>";
                                        echo "</td>";
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
                                <div class="col-md-6 text-end">
                                    <a href="tambah_organisasi.php" class="btn btn-sm btn-primary m-4">Tambah Pendidikan</a>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_organisasi = "SELECT * FROM data_calon INNER JOIN pendidikan_calon ON data_calon.id_calon = pendidikan_calon.id_calon WHERE data_calon.username = '$data[username]'";
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
                                        echo "<td>";
                                        echo "<a href='edit_pendidikan.php?id_pendidikan=" . $row['id_pendidikan'] . "' class='btn btn-sm btn-warning'>Edit</a> ";
                                        echo "<a href='hapus_pendidikan.php?id_pendidikan=" . $row['id_pendidikan'] . "' class='btn btn-sm btn-danger'>Hapus</a>";
                                        echo "</td>";
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