<?php 
    include('../config/koneksi.php');

    $nomor = $_GET['kode'];

    $sql = "SELECT produk.nama, produk.harga, pesanan_dt.jumlah, (produk.harga * pesanan_dt.jumlah) as subtotal 
            FROM pesanan_dt JOIN produk ON pesanan_dt.id_produk = produk.id 
            WHERE no_trans = '$nomor'";

    $urutan = 1;
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($query)){
        echo "<tr>
                <td>".$urutan++."</td>
                <td>".$row['nama']."</td>
                <td>".$row['harga']."</td>
                <td>".$row['jumlah']."</td>
                <td>".$row['subtotal']."</td>
            </tr>";
    }
?>