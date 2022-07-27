<?php 
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'ecommerce';
    $port = '3306';

    $conn = mysqli_connect($host, $user, $pass, $database, $port);

    if (! $conn) {
        die("Koneksi Database Gagal.");
    }
?>
