<?php 
    session_start();

    if(! isset($_SESSION['namauser'])) {
        echo "<script>
                location.href='index.php';
            </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Ecommerce</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        main{
            margin-top: 70px;
        } 
        footer{
            margin-top: 10px;
        }
    </style>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">E-Commerce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./kategori.php">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pesanan.php">Pesanan</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main id="konten"> 
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col">