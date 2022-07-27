<?php include('./layout/header.php'); ?>
<main>
    <div class="container mt-3">
        <h2>Check Out Belanja</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </thead>
            <tbody>
            <?php 
                session_start();
                $sesi = session_id();

                $sql = "SELECT keranjang.id,nama,harga,jumlah,(harga*jumlah) AS subtotal FROM keranjang JOIN produk ON keranjang.id_produk = produk.id WHERE sesi = '$sesi'";
                $query = mysqli_query($conn, $sql);
                $nomor = 1;
                $total = 0;
                while($row = mysqli_fetch_array($query)){
            ?>
                <tr>
                    <td><?=$nomor++;?></td>
                    <td><?=$row['nama'];?></td>
                    <td><?=$row['harga'];?></td>
                    <td><?=$row['jumlah'];?></td>
                    <td><?=$row['subtotal'];?></td>
                </tr>
            <?php
                    $total = $total + $row['subtotal'];
                }
            ?>
            </tbody>
            <tfoot>
                <th colspan="4">Total Keranjang Belanja</th>
                <th id="total"><?=$total;?></th>
            </tfoot>
        </table>
        <h2 class="mt-5 mb-3">Data Pengiriman</h2>
        <form action="#" method="post" id="formCheckOut">
        <div class="form-floating mb-3">
                <input type="text" name="nama" id="nama" class="form-control" required>
                <label for="nama">Nama Konsumen</label>
            </div>
            <div class="form-floating mb-3">
                <textarea name="alamat" id="alamat" rows="5" class="form-control" required></textarea>
                <label for="nama">Alamat Konsumen</label>
            </div>
            <div class="form-floating mb-3">
                <select name="provinsi" id="provinsi" class="form-select" required></select>
                <label for="provinsi">Provinsi</label>
            </div>
            <div class="form-floating mb-3">
                <select name="kota" id="kota" class="form-select" required></select>
                <label for="kota">Kabupaten / Kota</label>
            </div>
            <div class="form-floating mb-3">
                <select name="kurir" id="kurir" class="form-select" required>
                    <option disabled selected>-- Pilih Kurir --</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS Indonesia</option>
                </select>
                <label for="kurir">Kurir</label>
            </div>
            <div class="form-floating mb-3">
                <select name="paket" id="paket" class="form-select" required></select>
                <label for="paket">Jenis Paket</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="grandtotal" id="grandtotal" class="form-control" required>
                <label for="total">Total + Ongkir</label>
            </div>
            <button type="submit" class="btn btn-primary">Check Out</button>
        </form>
    </div>
</main>
<?php include('./layout/footer.php'); ?>