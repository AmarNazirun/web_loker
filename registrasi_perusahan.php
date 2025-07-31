<?php

include 'config/koneksi.php';
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['daftar'])) {
    $nama_perusahaan = $_POST['Nama_Perusahaan'];
    $alamat = $_POST['Alamat'];
    $telepon = $_POST['Telepon'];
    $website = $_POST['website'];
    $contact_person = $_POST['contact_person'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $Password = $_POST['password'];
    $Konfirmasi_Password = $_POST['konfirm_password'];

    // cek username
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        echo "<script>alert('Username sudah ada! Silakan gunakan username lain.');</script>";
    } else {
        // cek apakah password dan konfirmasi password sama?
        if ($Password !== $Konfirmasi_Password) {
            echo "<script>alert('Password dan Konfirmasi Password tidak sama!');</script>";
        } else {
        // ubah password menjadi hash
            $Password_Hash = password_hash($Password, PASSWORD_DEFAULT);

            // Query untuk memasukkan data ke tabel user
            $query_user = mysqli_query($koneksi, "INSERT INTO user (username, password, level) VALUES ('$username', '$Password_Hash', 'perusahaan')");
            // Query untuk memasukkan data ke tabel data_perusahaan
            $query_data_perusahaan = mysqli_query($koneksi, "INSERT INTO data_perusahaan (nama_perusahaan, alamat, telepon, website, contact_person, email, username) VALUES ('$nama_perusahaan', '$alamat', '$telepon', '$website', '$contact_person', '$email', '$username')");
            // Cek apakah query berhasil
            if ($query_user && $query_data_perusahaan) {
                echo "<script>alert('Registrasi Perusahaan Berhasil! Silakan login.'); window.location.href='login.php';</script>";
            }
            else {
                echo "<script>alert('Registrasi Perusahaan Gagal!');</script>";
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
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Registrasi Perusahaan</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form action="" method="POST" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama Perusahaan</label>
                                            <input type="text" name="Nama_Perusahaan" class="form-control" id="yourName" required>
                                            <div class="invalid-feedback">Masukkan Nama Perusahan</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Alamat</label>
                                            <input type="text" name="Alamat" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Masukkan Alamat Perusahaan</div> 
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Telepon</label>
                                            <input type="text" name="Telepon" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Masukkan Nomor Telepon Perusahaan</div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Website</label>
                                            <input type="text" name="website" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Masukkan Website Perusahaan</div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">contact Person</label>
                                            <input type="text" name="contact_person" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback"> Masukkan Contact Person Perusahaan</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback"> Masukkan Email Perusahaan</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Username Perusahaan</label>
                                            <input type="text" name="username" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback"> Masukkan Username Perusahaan</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Konfirmasi Password</label>
                                            <div class="input-group has-validation">
                                                <input type="password" name="konfirm_password" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>
    
                                        <div class="col-12">
                                            <input type="submit" name="daftar" class="btn btn-primary w-100" value="Register">
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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