<?php
// Include database connection
include 'config/koneksi.php';

// cek apakah tombol register sudah diklik?
if (isset($_POST['register'])) {
    // Ambil data dari form
    $Nama_Lengkap = $_POST['Nama_Lengkap'];
    $Posisi_Lamar = $_POST['Posisi_Lamar'];
    $Telepon_Rumah = $_POST['Telepon_Rumah'];
    $Handphone = $_POST['Handphone'];
    $Tanggal_Lahir = $_POST['Tanggal_Lahir'];
    $Tempat_Lahir = $_POST['Tempat_Lahir'];
    $Jenis_Kelamin = $_POST['Jenis_Kelamin'];
    $Agama = $_POST['Agama'];
    $Status_Kawin = $_POST['Status_Kawin'];
    $Golongan_Darah = $_POST['Golongan_Darah'];
    $No_KTP = $_POST['No_KTP'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Konfirmasi_Password = $_POST['Konfirmasi_Password'];
    $Foto = $_FILES['Foto']['name'];
    $Foto_Tipe = $_FILES['Foto']['type'];
    $Foto_Sumber = $_FILES['Foto']['tmp_name'];
    $Foto_Upload_Tujuan = 'assets/img/foto_pelamar/';
    $Foto_Upload_Tujuan .= basename($Foto);

    // cek username sudah ada?
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$Username'");
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Username sudah ada! Silakan gunakan username lain.');</script>";
    } else {
        // cek apakah password dan konfirmasi password sama?
        if ($Password !== $Konfirmasi_Password) {
            echo "<script>alert('Password dan Konfirmasi Password tidak sama!');</script>";
        } else {
            // ubah password menjadi hash
            $Password_Hash = password_hash($Password, PASSWORD_DEFAULT);

            // pisahkan nama file dan ekstensi
            $foto_extension = pathinfo($Foto, PATHINFO_EXTENSION);
            // Validasi ekstensi foto
            $valid_extensions = array('jpg', 'jpeg', 'png');
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
                $Foto_Upload_Tujuan = 'assets/img/foto_pelamar/';
                // simpan foto dengan nama baru
                $Foto_Upload_Tujuan .= basename($Foto);
                if (move_uploaded_file($Foto_Sumber, $Foto_Upload_Tujuan)) {
                    // Query untuk memasukkan data ke tabel user
                    $query_user = mysqli_query($koneksi, "INSERT INTO user (username, password, level) VALUES ('$Username', '$Password_Hash','user')");
                    // Query untuk memasukkan data ke tabel data_calon
                    $query_data_calon = mysqli_query($koneksi, "INSERT INTO data_calon (nama_lengkap, posisi_lamar, telepon_rumah, handphone, tanggal_lahir, tempat_lahir, jenis_kelamin, agama, status_kawin, golongan_darah, no_ktp, foto, username) VALUES ('$Nama_Lengkap', '$Posisi_Lamar', '$Telepon_Rumah', '$Handphone', '$Tanggal_Lahir', '$Tempat_Lahir', '$Jenis_Kelamin', '$Agama', '$Status_Kawin', '$Golongan_Darah', '$No_KTP', '$Foto', '$Username')");
                    // Cek apakah query berhasil
                    if ($query_data_calon && $query_user) {
                        echo "<script>alert('Registrasi berhasil! Silakan login.');</script>";
                        echo "<script>window.location.href='login.php';</script>";
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
    }
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register - Web Loker</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Registrasi Perusahaan</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                                        <!-- nama lengkap -->
                                        <div class="col-md-4">
                                            <label for="Nama_Lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="Nama_Lengkap" class="form-control" id="Nama_Lengkap" required>
                                            <div class="invalid-feedback">Masukkan Nama Lengkap Anda</div>
                                        </div>

                                        <!-- posisi lamar -->
                                        <div class="col-md-4">
                                            <label for="Posisi_Lamar" class="form-label">Posisi Lamar</label>
                                            <input type="text" name="Posisi_Lamar" class="form-control" id="Posisi_Lamar" required>
                                            <div class="invalid-feedback">Masukkan Posisi yang Dilamar</div>
                                        </div>

                                        <!-- telepon rumah -->
                                        <div class="col-md-4">
                                            <label for="Telepon_Rumah" class="form-label">Telepon Rumah</label>
                                            <input type="text" name="Telepon_Rumah" class="form-control" id="Telepon_Rumah" required>
                                            <div class="invalid-feedback">Masukkan Nomor Telepon Rumah Anda</div>
                                        </div>

                                        <!-- handphone -->
                                        <div class="col-md-4">
                                            <label for="Handphone" class="form-label">Handphone</label>
                                            <input type="text" name="Handphone" class="form-control" id="Handphone" required>
                                            <div class="invalid-feedback">Masukkan Nomor Handphone Anda</div>
                                        </div>

                                        <!-- tanggal lahir -->
                                        <div class="col-md-4">
                                            <label for="Tanggal_Lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="Tanggal_Lahir" class="form-control" id="Tanggal_Lahir" required>
                                            <div class="invalid-feedback">Masukkan Tanggal Lahir Anda</div>
                                        </div>

                                        <!-- tempat lahir -->
                                        <div class="col-md-4">
                                            <label for="Tempat_Lahir" class="form-label">Tempat Lahir</label>
                                            <input type="text" name="Tempat_Lahir" class="form-control" id="Tempat_Lahir" required>
                                            <div class="invalid-feedback">Masukkan Tempat Lahir Anda</div>
                                        </div>

                                        <!-- jenis kelamin -->
                                        <div class="col-md-4">
                                            <label for="Jenis_Kelamin" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" name="Jenis_Kelamin" id="Jenis_Kelamin" required>
                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Jenis Kelamin Anda</div>
                                        </div>

                                        <!-- Agama -->
                                        <div class="col-md-4">
                                            <label for="Agama" class="form-label">Agama</label>
                                            <select class="form-select" name="Agama" id="Agama" required>
                                                <option value="" disabled selected>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Agama Anda</div>
                                        </div>

                                        <!-- status kawin -->
                                        <div class="col-md-4">
                                            <label for="Status_Kawin" class="form-label">Status Kawin</label>
                                            <select class="form-select" name="Status_Kawin" id="Status_Kawin" required>
                                                <option value="" disabled selected>Pilih Status Kawin</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Janda/Duda">Janda/Duda</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Status Kawin Anda</div>
                                        </div>

                                        <!-- golongan darah -->
                                        <div class="col-md-4">
                                            <label for="Golongan_Darah" class="form-label">Golongan Darah</label>
                                            <select class="form-select" name="Golongan_Darah" id="Golongan_Darah" required>
                                                <option value="" disabled selected>Pilih Golongan Darah</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih Golongan Darah Anda</div>
                                        </div>

                                        <!-- no ktp -->
                                        <div class="col-md-4">
                                            <label for="No_KTP" class="form-label">Nomor KTP</label>
                                            <input type="text" name="No_KTP" class="form-control" id="No_KTP" required>
                                            <div class="invalid-feedback">Masukkan Nomor KTP Anda</div>
                                        </div>

                                        <!-- foto -->
                                        <div class="col-md-4">
                                            <label for="Foto" class="form-label">Foto</label>
                                            <input type="file" name="Foto" class="form-control" id="Foto" accept="image/*" required>
                                            <div class="invalid-feedback">Unggah Foto Anda</div>
                                        </div>

                                        <!-- username -->
                                        <div class="col-md-4">
                                            <label for="Username" class="form-label">Username</label>
                                            <input type="text" name="Username" class="form-control" id="Username" required>
                                            <div class="invalid-feedback">Masukkan Username Anda</div>
                                        </div>

                                        <!-- password -->
                                        <div class="col-md-4">
                                            <label for="Password" class="form-label">Password</label>
                                            <input type="password" name="Password" class="form-control" id="Password" required>
                                            <div class="invalid-feedback">Masukkan Password Anda</div>
                                        </div>

                                        <!-- konfirmasi password -->
                                        <div class="col-md-4">
                                            <label for="Konfirmasi_Password" class="form-label">Konfirmasi Password</label>
                                            <input type="password" name="Konfirmasi_Password" class="form-control" id="Konfirmasi_Password" required>
                                            <div class="invalid-feedback">Konfirmasi Password Anda</div>
                                        </div>

                                        <!-- submit -->
                                        <div class="col-12">
                                            <input type="submit" name="register" class="btn btn-primary w-100" value="Daftar">
                                        </div>
                                        <!-- reset -->
                                        <div class="col-12">
                                            <button class="btn btn-secondary w-100" type="reset">Reset</button>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="small mb-0">Sudah Punya Akun? <a href="login.php">Login</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>