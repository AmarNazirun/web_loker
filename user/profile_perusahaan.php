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
        $Foto_Upload_Tujuan = '../assets/img/logo_perusahaan/';
        // hapus foto lama
        if (file_exists($Foto_Upload_Tujuan . $data['logo'])) {
            unlink($Foto_Upload_Tujuan . $data['logo']);
        }
        // simpan foto dengan nama baru
        $Foto_Upload_Tujuan .= basename($Foto);
        if (move_uploaded_file($Foto_Sumber, $Foto_Upload_Tujuan)) {
            // Update foto di database
            $query_update = "UPDATE data_perusahaan SET logo='$Foto' WHERE username='$Username'";
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

// jika user mau mengubah data profile
if (isset($_POST['simpan_perubahan'])) {
    // ambil data dari form
    $id_perusahaan = $_POST['id_perusahaan'];
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $x = $_POST['x'];

    // Update data calon di database
    $query_update_profile = "UPDATE data_perusahaan SET nama_perusahaan='$nama_perusahaan', telepon='$telepon', alamat='$alamat', email='$email', username='$username', facebook='$facebook', instagram='$instagram', x='$x' WHERE id_perusahaan=$id_perusahaan";
    
    if (mysqli_query($koneksi, $query_update_profile)) {
        echo "<script>alert('Data profile berhasil diubah');</script>";
    } else {
        echo "<script>alert('Gagal mengubah data profile! Silakan coba lagi.');</script>";
    }
}

// jika user merubah deskripsi tentang perusahaan
if (isset($_POST['simpan_tentang'])) {
    // ambil data dari form
    $id_perusahaan = $_POST['id_perusahaan'];
    $tentang_perusahaan = $_POST['tentang_perusahaan'];
    // Update data tentang perusahaan di database
    $query_update_tentang = "UPDATE data_perusahaan SET tentang_perusahaan='$tentang_perusahaan' WHERE id_perusahaan=$id_perusahaan";
    if (mysqli_query($koneksi, $query_update_tentang)) {
        echo "<script>alert('Deskripsi tentang perusahaan berhasil diubah');</script>";
        echo "<script>window.location.href = 'profile_perusahaan.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah deskripsi tentang perusahaan! Silakan coba lagi.');</script>";
        echo "<script>window.location.href = 'profile_perusahaan.php';</script>";
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

        <?php
        // Tampilkan data perusahaan
        $query = "SELECT * FROM data_perusahaan WHERE id_perusahaan = " . $_GET['id_perusahaan'];
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);
        ?>

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
                                        <img src="../assets/img/logo_perusahaan/<?php echo $data['logo']; ?>" alt="Logo Perusahaan" class="img-fluid" style="object-fit: cover; width: 200px; height: 200px;">
                                    </div>
                                    <div class="mt-3">
                                        <h5 class="mb-1"><?php echo htmlspecialchars($data['nama_perusahaan']); ?></h5>
                                        <span class="text-muted">@<?php echo htmlspecialchars($data['username']); ?></span>
                                    </div>
                                    <hr>
                                    <form action="" method="post" enctype="multipart/form-data" class="mt-3">
                                        <input type="file" name="foto" accept="image/*" class="form-control mb-2" required>
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
                                                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($data['username']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Nama Perusahaan</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="nama_perusahaan" class="form-control" value="<?php echo htmlspecialchars($data['nama_perusahaan']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Telepone</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="telepon" class="form-control" value="<?php echo htmlspecialchars($data['telepon']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Alamat</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($data['alamat']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Email</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Facebook</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="facebook" class="form-control" value="<?php echo htmlspecialchars($data['facebook']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Instagram</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="instagram" class="form-control" value="<?php echo htmlspecialchars($data['instagram']); ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-sm-4 col-form-label"><b>Twitter/X</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" name="x" class="form-control" value="<?php echo htmlspecialchars($data['x']); ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-3 text-end">
                                            <form action="update_profile.php" method="post">
                                                <input type="hidden" name="id_perusahaan" value="<?php echo $data['id_perusahaan']; ?>">
                                                <input type="submit" name="simpan_perubahan" value="Simpan Perubahan" class="btn btn-primary col-12">
                                            </form>
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
                                    <textarea class="form-control" name="tentang_perusahaan" rows="15" placeholder="Deskripsi Tentang Perusahaan"><?php echo htmlspecialchars($data['tentang_perusahaan']); ?></textarea>
                                </div>
                                <div class="text-end">
                                    <input type="hidden" name="id_perusahaan" value="<?php echo $data['id_perusahaan']; ?>">
                                    <input type="submit" name="simpan_tentang" value="Simpan Perubahan" class="btn btn-primary col-12">
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