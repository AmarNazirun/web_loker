<?php
// perintah sign_out.php
session_start();
// Hapus semua session
session_unset();
// Hancurkan session
session_destroy();
// Redirect ke halaman index
header("Location: ../index.php");
exit();
?>