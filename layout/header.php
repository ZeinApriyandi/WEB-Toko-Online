<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                            include('config/koneksi.php');
                            $sql = 'SELECT * FROM kategori';
                            $query = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($query)){
                                echo "<li><a class='dropdown-item' href='?k=".$row['id']."'>".$row['nama']."</a></li>";
                            }
                        ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./">Semua Kategori</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex">
                    <li class="nav-item">
                        <a href="./keranjang.php" class="nav-link position-relative">
                            Keranjang Belanja
                            <span id="jumlah" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                0
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./admin/">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>