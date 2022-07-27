<?php include('./layout/header.php'); ?>
<main>
    <div class="container-fluid">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="./img/banner1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="./img/banner2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                <img src="./img/banner3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container-fluid mt-3">
        <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php 
            $filter = '';
            if(isset($_GET['k'])) {
                $filter = "WHERE id_kategori = '".$_GET['k']."'";
            }
            $sql = "SELECT * FROM produk $filter";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($query)){
        ?>
            <div class="col">
                <div class="card h-100">
                    <img src="./img/produk/<?=$row['foto'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['nama'];?></h5>
                        <p class="card-text"><?=$row['harga'];?></p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary" onclick="addToCart('<?=$row['id'];?>')">Beli</a>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</main>
<?php include('./layout/footer.php'); ?>