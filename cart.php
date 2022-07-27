<?php 
    include('config/koneksi.php');
    session_start();
    $sesi = session_id();

    if (isset($_GET['tipe'])) {
        $tipe = $_GET['tipe'];
        $kode = $_GET['kode'];
        $pesan = "Data keranjang gagal di$tipe";

        switch($tipe) {
            case 'tambah':
                $sql = "SELECT * FROM keranjang WHERE id_produk='$kode' AND sesi='$sesi'";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) == 0) {
                    $sql = "INSERT INTO keranjang(id_produk, jumlah, sesi) VALUES('$kode','1','$sesi')";
                } else {
                    $sql = "UPDATE keranjang SET jumlah=jumlah+1 WHERE id_produk='$kode' AND sesi='$sesi'";
                }
                break;
            case 'hapus':
                $sql = "DELETE FROM keranjang WHERE id='$kode'";
                break;
        }
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $pesan = "Data keranjang berhasil di$tipe";
        }
        echo $pesan;

    } else {
        $sql = "SELECT SUM(jumlah) AS jumlah FROM keranjang WHERE sesi = '$sesi'";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($query);
        $jumlah = is_null($data['jumlah']) ? 0 : $data['jumlah'];

        echo $jumlah;
    }
?>