<?php
// memanggil file koneksi.php
include "koneksi.php";
// membuat variable dengan nilai dari form
$id = $_POST['id']; // variablenya = username, dan nilainya sesuai yang dimasukkan di input name="username" tadi
$pass = $_POST['pass']; // variable password, dan nilainya sesuai yang dimasukkan di input name="password" tadi
// proses untuk login
// menyesuaikan dengan data di database
//$perintah = mysqli_query($GLOBALS["___mysqli_ston"], "select * from login WHERE username = '$username' AND password = '$password'");
$perintah = "select * from data WHERE id = '$id' AND pass = '$pass'";
$hasil = $mysqli->query($perintah);
 
if($hasil == false) { // Jika gagal menjalankan query
trigger_error('Perintah SQL salah: ' . $sql . ' Error: ' . $mysqli->error, E_USER_ERROR); // Tampilkan pesan
} 
else { // Jika berhasil
    while($data = $hasil->fetch_array()){ // Tampilkan data dengan pengulangan while
        if ($data['id'] == $id AND $data['pass'] == $pass) {
            session_start(); // memulai fungsi session
            $_SESSION['id'] = $id;
            header("location:otp.php"); // jika berhasil login, maka masuk ke file home.php
        }
        else {
            header("location:index.php"); // jika berhasil login, maka masuk ke file home.php
        }
    }
}
 ?>