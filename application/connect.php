<?php
// application/connect.php

date_default_timezone_set('Asia/Jakarta');
// !!! PENTING: Ekstensi mysql_* sudah DEPRECATED dan TIDAK AMAN.
// !!! Sangat disarankan untuk migrasi ke mysqli atau PDO.

// Coba koneksi ke database. Jika gagal, hentikan skrip dan tampilkan pesan error MySQL.
mysql_connect("localhost", "root", "") or die("Koneksi database GAGAL! Periksa status server database atau kredensial. Error: " . mysql_error());

// Pilih database. Jika gagal, hentikan skrip dan tampilkan pesan error MySQL.
mysql_select_db("dblaplakgar2024") or die("Database 'dblaplakgar2024' tidak bisa dibuka! Pastikan nama database benar. Error: " . mysql_error());

// Set karakter set untuk mencegah masalah encoding
mysql_set_charset('utf8');

// Variabel ini akan memberitahu pagu.php bahwa koneksi berhasil.
// Ini diperlukan karena mysql_connect tidak mengembalikan objek koneksi.
$conn_status_ok = true;

?>