<?php
// ceck if the user is logged in
session_start();

$username = $_SESSION['username'];

// ambil data user dan data_calon
include '../config/koneksi.php';
$query = "SELECT * FROM user inner join data_calon on user.username = data_calon.username WHERE user.username = '$username'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// jika user mau mengubah foto
if (isset($_POST['ubah'])) {
    // ambil data foto dari form
    $Foto_Sumber = $_FILES['foto']['tmp_name'];
    $Foto = $_FILES['foto']['name'];
    $Username = $data['username'];
    // pisahkan nama file dan ekstensi
    $foto_extension = pathinfo($Foto, PATHINFO_EXTENSION);
    // Validasi ekstensi foto
    $valid_extensions = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
    // Cek apakah ekstensi foto valid
    $foto_extension = strtolower($foto_extension); // Ubah ekstensi menjadi huruf kecil

    // Cek apakah ekstensi foto valid
    if (in_array($foto_extension, $valid_extensions)) {
        // hapus nama foto yang ada menjadi kosong
        $Foto = '';
        // buat nama foto baru dengan username
        $Foto = $Username;
        // tambahkan ekstensi foto
        $Foto .= '.' . $foto_extension;
        // Set tujuan upload foto
        $Foto_Upload_Tujuan = '../assets/img/foto_pelamar/';

        // cek apakah user menggunakan foto default
        if ($data['foto'] != 'default.png') {
            // jika tidak, hapus foto lama
            $Foto_Lama = '../assets/img/foto_pelamar/' . $data['foto'];
            if (file_exists($Foto_Lama)) {
                unlink($Foto_Lama);
            }
        }
        // simpan foto dengan nama baru
        $Foto_Upload_Tujuan .= $Foto;
        if (move_uploaded_file($Foto_Sumber, $Foto_Upload_Tujuan)) {
            // Update foto di database
            $query_update = "UPDATE data_calon SET foto='$Foto' WHERE username='$Username'";
            if (mysqli_query($koneksi, $query_update)) {
                echo "<script>alert('Foto Berhasil diubah');</script>";
            } else {
                // Jika gagal, hapus file foto yang sudah diupload
                unlink($Foto_Upload_Tujuan);
                echo "<script>alert('Registrasi gagal! Silakan coba lagi.');</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload foto! Pastikan file foto valid.');</script>";
        }
    } else {
        echo "<script>alert('Format foto tidak valid! Hanya diperbolehkan JPG, JPEG, atau PNG.');</script>";
    }
}

// jika user mau menghapus foto
if (isset($_POST['hapus'])) {
    // Ubah foto menjadi default.png
    $Foto = 'default.png';
    // Update foto di database
    $query_update = "UPDATE data_calon SET foto='$Foto' WHERE username='$username'";
    if (mysqli_query($koneksi, $query_update)) {
        // Hapus foto lama jika ada
        $Foto_Upload_Tujuan = '../assets/img/foto_pelamar/' . $data['foto'];
        if (file_exists($Foto_Upload_Tujuan)) {
            unlink($Foto_Upload_Tujuan);
        } 
        echo "<script>alert('Foto berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus foto! Silakan coba lagi.');</script>";
    }
}

// jika user mau mengubah data profile
if (isset($_POST['simpan_perubahan'])) {
    $id_calon = $_POST['id_calon'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $handphone = $_POST['handphone'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $status_kawin = $_POST['status_kawin'];
    $no_ktp = $_POST['no_ktp'];

    // Update data calon di database
    $query_update_profile = "UPDATE data_calon SET nama_lengkap='$nama_lengkap', handphone='$handphone', tempat_lahir='$tempat_lahir', jenis_kelamin='$jenis_kelamin', agama='$agama', status_kawin='$status_kawin', no_ktp='$no_ktp' WHERE id_calon='$id_calon'";
    
    if (mysqli_query($koneksi, $query_update_profile)) {
        echo "<script>alert('Data profile berhasil diubah');</script>";
    } else {
        echo "<script>alert('Gagal mengubah data profile! Silakan coba lagi.');</script>";
    }
}

// jika user mau menghapus pengalaman kerja
if (isset($_POST['hapus_pengalaman'])) {
    $id_pengalaman = $_POST['id_pengalaman'];
    // Hapus data pengalaman kerja dari database
    $query_delete_pengalaman = "DELETE FROM pengalaman_kerja WHERE id_pengalaman=$id_pengalaman";
    if (mysqli_query($koneksi, $query_delete_pengalaman)) {
        echo "<script>alert('Pengalaman kerja berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengalaman kerja! Silakan coba lagi.');</script>";
    }
}

// jika user mau menghapus prestasi
if (isset($_POST['hapus_prestasi'])) {
    $id_prestasi = $_POST['id_prestasi'];
    // Hapus data prestasi dari database
    $query_delete_prestasi = "DELETE FROM prestasi_calon WHERE id_prestasi=$id_prestasi";
    if (mysqli_query($koneksi, $query_delete_prestasi)) {
        echo "<script>alert('Prestasi berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus prestasi! Silakan coba lagi.');</script>";
    }
}

// jika user mau menghapus organisasi
if (isset($_POST['hapus_organisasi'])) {
    $id_organisasi = $_POST['id_organisasi'];
    // Hapus data organisasi dari database
    $query_delete_organisasi = "DELETE FROM organisasi_calon WHERE id_organisasi=$id_organisasi";
    if (mysqli_query($koneksi, $query_delete_organisasi)) {
        echo "<script>alert('Organisasi berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus organisasi! Silakan coba lagi.');</script>";
    }
}

// jika user mau menghapus pendidikan
if (isset($_POST['hapus_pendidikan'])) {
    $id_pendidikan = $_POST['id_pendidikan'];
    // Hapus data pendidikan dari database
    $query_delete_pendidikan = "DELETE FROM pendidikan_calon WHERE id_pendidikan=$id_pendidikan";
    if (mysqli_query($koneksi, $query_delete_pendidikan)) {
        echo "<script>alert('Pendidikan berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus pendidikan! Silakan coba lagi.');</script>";
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
                    <div class="row">

                        <!-- Foto Profile Card -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 d-flex align-items-center justify-content-center">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Foto Profile</h5>
                                    <div class="d-flex align-items-center justify-content-center w-100" style="height: 250px;">
                                        <img src="../assets/img/foto_pelamar/<?php echo $data['foto']; ?>" alt="Foto Profil" class="img-fluid" style="object-fit: cover; width: 200px; height: 200px;">
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="mb-1"><?php echo htmlspecialchars($data['nama_lengkap']); ?></h5>
                                        <span class="text-muted">@<?php echo htmlspecialchars($data['username']); ?></span>
                                    </div>
                                    <hr>
                                    <form action="" method="post" enctype="multipart/form-data" class="mt-3">
                                        <input type="file" name="foto" accept="image/*" class="form-control mb-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="submit" name="ubah" value="Ubah" class="btn btn-primary w-100">
                                            </div>
                                            <div class="col-6">
                                                <input type="submit" name="hapus" value="Hapus" class="btn btn-danger w-100">
                                            </div>
                                        </div>
                                    </form>
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
                                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($data['username']); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Nama Lengkap</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($data['nama_lengkap']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Handphone</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="handphone" class="form-control" value="<?php echo htmlspecialchars($data['handphone']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Tempat Lahir</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($data['tempat_lahir']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Jenis Kelamin</b></label>
                                            <div class="col-sm-8">
                                                <select name="jenis_kelamin" class="form-control">
                                                    <option value="Laki-laki" <?php if($data['jenis_kelamin']=='Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                                    <option value="Perempuan" <?php if($data['jenis_kelamin']=='Perempuan') echo 'selected'; ?>>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Agama</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="agama" class="form-control" value="<?php echo htmlspecialchars($data['agama']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Status Kawin</b></label>
                                            <div class="col-sm-8">
                                                <select name="status_kawin" class="form-control">
                                                    <option value="Belum Kawin" <?php if($data['status_kawin']=='Belum Kawin') echo 'selected'; ?>>Belum Kawin</option>
                                                    <option value="Kawin" <?php if($data['status_kawin']=='Kawin') echo 'selected'; ?>>Kawin</option>
                                                    <option value="Cerai" <?php if($data['status_kawin']=='Cerai') echo 'selected'; ?>>Cerai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>No KTP</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="no_ktp" class="form-control" value="<?php echo htmlspecialchars($data['no_ktp']); ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-3 text-end">
                                            <form action="update_profile.php" method="post">
                                                <input type="hidden" name="id_calon" value="<?php echo $data['id_calon']; ?>">
                                                <input type="submit" name="simpan_perubahan" value="Simpan Perubahan" class="btn btn-primary col-12">
                                            </form>
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
                                <div class="col-md-6 text-end">
                                    <a href="tambah_pengalaman.php" class="btn btn-sm btn-primary m-4">Tambah Pengalaman Kerja</a>
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
                                <div class="col-md-6 text-end">
                                    <a href="tambah_pendidikan.php" class="btn btn-sm btn-primary m-4">Tambah Pendidikan</a>
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