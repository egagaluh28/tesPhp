<?php
date_default_timezone_set('Asia/Jakarta');

// Pastikan session tidak dobel
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "application/connect.php";

// Ambil data dari form
$username = $_POST['usernamelaplakgar'];
$password = md5($_POST['passwordlaplakgar']);

// Jalankan query login
$login = mysql_query("SELECT a.*, b.kdwasgiat FROM user a 
    LEFT JOIN t_tingkat b ON a.kdtingkat = b.kdtingkat 
    WHERE a.usernamelaplakgar = '$username' AND a.passwordlaplakgar = '$password'") or die(mysql_error());

// Cek apakah user ditemukan
$ketemu = mysql_num_rows($login);
$r = mysql_fetch_array($login);

if ($ketemu > 0) {
    $_SESSION['usernamelaplakgar'] = $r['usernamelaplakgar'];
    $_SESSION['passwordlaplakgar'] = $r['passwordlaplakgar'];
    $_SESSION['nama_lengkap']      = $r['nama_lengkap'];
    $_SESSION['level']             = $r['level'];
    $_SESSION['kdtingkat']         = $r['kdtingkat'];
    $_SESSION['kdkotama']          = $r['kdkotama'];
    $_SESSION['kdsatker']          = $r['kdsatker'];
    $_SESSION['kdwasgiat']         = $r['kdwasgiat'];
    $_SESSION['telp']              = $r['telp'];

    header("Location: redirect.php");
    exit();
} else {
    echo "<script>
        alert('USERNAME ATAU PASSWORD SALAH');
        window.location = 'index.php';
    </script>";
}
?>
