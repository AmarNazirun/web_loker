<?php

// konfigurasi koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "website_loker");


// cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>