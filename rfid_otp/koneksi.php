<?php
define("HOST", "localhost"); // Host database
define("USER", "root"); // Username database
define("PASSWORD", ""); // Password database
define("DATABASE", "rfid_otp"); // Nama database
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE); // Melakukan koneksi ke database berdasarkan konfigurasi diatas
 
if($mysqli->connect_error){
   trigger_error('Koneksi ke database gagal: ' . $mysqli->connect_error, E_USER_ERROR); // Jika koneksi gagal, tampilkan pesan "Koneksi ke database gagal"  
}
?>
