<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usernamelaplakgar'])) {
    header('location:index.php'); 
    exit;
}
?>
