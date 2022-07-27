<?php 
    include('./config/koneksi.php');

    if (isset($_POST['nama'])) {

        session_start();

        $sesi = session_id();
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $provinsi = $_POST['provinsi'];
        $kota = $_POST['kota'];
        $kurir = $_POST['kurir'];
        $total = $_POST['grandtotal'];

        $nomor_pesanan = strtoupper(uniqid());
        $sql = "INSERT INTO pesanan_dt(no_trans, id_produk, jumlah) 
                SELECT '$nomor_pesanan', id_produk, jumlah FROM keranjang WHERE sesi = '$sesi'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            $sql = "INSERT INTO pesanan_hd VALUES('$nomor_pesanan', CURRENT_TIMESTAMP(), 
                    '$nama', '$alamat', '$provinsi', '$kota', '$kurir', '$total')";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                $sql = "DELETE FROM keranjang WHERE sesi = '$sesi'";
                $query = mysqli_query($conn, $sql);

                echo "1|Check Out pesanan berhasil.";
            } else {
                $sql = "DELETE FROM pesanan_dt WHERE no_trans = '$nomor_pesanan'";
                $query = mysqli_query($conn, $sql);

                echo "0|Check Out pesanan gagal.";
            }
        } else {
            echo "0|Check Out pesanan gagal.";
        }
    }
?>