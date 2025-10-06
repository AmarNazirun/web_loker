<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

include '../config/koneksi.php';
$query = "SELECT * FROM user inner join admin_disnaker on user.username = admin_disnaker.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// ambil data pelamar berdasarkan id dengan get
$id_calon = $_GET['id_calon'];
$query_calon = "SELECT * FROM data_calon WHERE id_calon = $id_calon";
$result_calon = mysqli_query($koneksi, $query_calon);
$data_calon = mysqli_fetch_assoc($result_calon);

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
                                                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($data_calon['nama_lengkap']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Handphone</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="handphone" class="form-control" value="<?php echo htmlspecialchars($data_calon['handphone']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Tempat Lahir</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($data_calon['tempat_lahir']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Jenis Kelamin</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="jenis_kelamin" class="form-control" value="<?php echo htmlspecialchars($data_calon['jenis_kelamin']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Agama</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="agama" class="form-control" value="<?php echo htmlspecialchars($data_calon['agama']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Status Kawin</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="status_kawin" class="form-control" value="<?php echo htmlspecialchars($data_calon['status_kawin']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Email</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="no_ktp" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>">
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
                                        echo "<td>" . $row['alamat_perusahaan'] . "</td>";
                                        echo "<td>" . $row['telepon'] . "</td>";
                                        echo "<td>" . $row['tahun_awal'] . "</td>";
                                        echo "<td>" . $row['tahun_akhir'] . "</td>";
                                        echo "<td>" . $row['posisi'] . "</td>";
                                        echo "<td>" . $row['tanggung_jawab'] . "</td>";
                                        echo "<td>" . $row['alasan_keluar'] . "</td>";
                                        echo "<td>" . $row['gaji_terakhir'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit_pengalaman.php?id_pengalaman=" . $row['id_pengalaman'] . "' class='btn btn-sm btn-warning'>Edit</a> ";
                                        echo "<form action='' method='post' class='d-inline'>";
                                        echo "<input type='hidden' name='id_pengalaman' value='" . $row['id_pengalaman'] . "'>";
                                        echo "<input type='submit' name='hapus_pengalaman' value='Hapus' class='btn btn-sm btn-danger'>";
                                        echo "</form>";
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
                                        echo "<form action='' method='post' class='d-inline'>";
                                        echo "<input type='hidden' name='id_prestasi' value='" . $row['id_prestasi'] . "'>";
                                        echo "<input type='submit' name='hapus_prestasi' value='Hapus' class='btn btn-sm btn-danger'>";
                                        echo "</form>";                                        
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
                                        echo "<form action='' method='post' class='d-inline'>";
                                        echo "<input type='hidden' name='id_organisasi' value='" . $row['id_organisasi'] . "'>";
                                        echo "<input type='submit' name='hapus_organisasi' value='Hapus' class='btn btn-sm btn-danger'>";
                                        echo "</form>";
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
                                        echo "<form action='' method='post' class='d-inline'>";
                                        echo "<input type='hidden' name='id_pendidikan' value='" . $row['id_pendidikan'] . "'>";
                                        echo "<input type='submit' name='hapus_pendidikan' value='Hapus' class='btn btn-sm btn-danger'>";
                                        echo "</form>";
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