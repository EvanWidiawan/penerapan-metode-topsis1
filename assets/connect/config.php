<?php
$host = "127.0.0.1:3307"; 
$user = "root";
$pass = ""; 
$db   = "metode_topsis";

$conn = mysqli_connect($host, $user, $pass, $db) or die("Koneksi gagal: " . mysqli_connect_error());
?>
