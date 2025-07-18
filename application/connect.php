<?php
// application/connect.php

// !!! PENTING: Ekstensi mysql_* sudah DEPRECATED dan TIDAK AMAN.
// !!! Sangat disarankan untuk migrasi ke mysqli atau PDO.
// !!! Kode ini TIDAK AKAN BERJALAN di PHP 7.0 atau lebih baru.

// Aktifkan error reporting untuk melihat pesan kesalahan PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// PERBAIKAN: Set zona waktu default
date_default_timezone_set('Asia/Jakarta'); // Atau zona waktu lain yang sesuai, contoh 'Asia/Jakarta' untuk WIB

// Coba koneksi ke database. Jika gagal, hentikan skrip dan tampilkan pesan error MySQL.
$db_host = "localhost";
$db_user = "root";
$db_pass = ""; // Ganti dengan password Anda jika ada
$db_name = "dblaplakgar2024";

// Fungsi mysql_connect tidak mengembalikan resource koneksi jika tidak di-assign
// Namun, jika gagal, die() akan dipanggil.
mysql_connect($db_host, $db_user, $db_pass) or die("Koneksi database GAGAL! Periksa status server database atau kredensial. Error: " . mysql_error());

// Pilih database. Jika gagal, hentikan skrip dan tampilkan pesan error MySQL.
mysql_select_db($db_name) or die("Database '" . htmlspecialchars($db_name) . "' tidak bisa dibuka! Pastikan nama database benar. Error: " . mysql_error());

// Set karakter set untuk mencegah masalah encoding
mysql_set_charset('utf8');

// Variabel ini akan memberitahu file lain bahwa koneksi berhasil.
$conn_status_ok = true;

?>