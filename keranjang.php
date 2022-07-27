<?php include('./layout/header.php'); ?>
<main>
    <div class="container mt-3">
        <h2>Keranjang Belanja</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Aksi</th>
            </thead>
            <tbody>
            <?php 
                session_start();
                $sesi = session_id();

                $sql = "SELECT keranjang.id,nama,harga,jumlah,(harga*jumlah) AS subtotal FROM keranjang JOIN produk ON keranjang.id_produk = produk.id WHERE sesi = '$sesi'";
                $query = mysqli_query($conn, $sql);
                $nomor = 1;
                $total = 0;

                if (mysqli_num_rows($query) == 0) {
            ?>
                <tr>
                    <td colspan="6">Keranjang Belanja masih kosong.</td>
                </tr>
            <?php
                } else {
                    while($row = mysqli_fetch_array($query)){
            ?>
                <tr>
                    <td><?=$nomor++;?></td>
                    <td><?=$row['nama'];?></td>
                    <td><?=$row['harga'];?></td>
                    <td><?=$row['jumlah'];?></td>
                    <td><?=$row['subtotal'];?></td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="removeFromCart('<?=$row['id'];?>')">Hapus</button>
                    </td>
                </tr>
            <?php
                        $total = $total + $row['subtotal'];
                    }
                }
            ?>
            </tbody>
            <tfoot>
                <th colspan="4">Total Keranjang Belanja</th>
                <th><?=$total;?></th>
            </tfoot>
        </table>
        <center>
            <a href="./" class="btn btn-primary">Lanjutkan Belanja</a>
            <?php if($total > 0) { ?>
            <a href="./checkout.php" class="btn btn-success">Check Out</a>
            <?php } ?>
        </center>
    </div>
</main>
<?php include('./layout/footer.php'); ?>