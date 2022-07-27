<?php include('./layout/header.php'); ?>
<h1 class="mb-3">Data Pesanan</h1>
<table class="table table-bordered table-hover">
    <thead>
        <th>#</th>
        <th>Nomor Pesanan</th>
        <th>Tanggal Pesanan</th>
        <th>Nama Konsumen</th>
        <th>Total Transaksi</th>
        <th>Aksi</th>
    </thead>
    <tbody>
<?php 
    include('../config/koneksi.php');

    $sql = "SELECT * FROM pesanan_hd ORDER BY tgl_trans DESC";
    $urutan = 1;
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($query)){
        echo "<tr>
                <td>".$urutan++."</td>
                <td>".strtoupper($row['no_trans'])."</td>
                <td>".$row['tgl_trans']."</td>
                <td>".$row['nama']."</td>
                <td>".$row['total']."</td>
                <td>
                    <button data-bs-toggle='modal' data-bs-target='#modalDetail' class='btn btn-outline-primary btn-sm' data-bs-kode='".$row['no_trans']."'>Rincian Pesanan</button>
                </td>
            </tr>";
    }
?>
    </tbody>
</table>

<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
            <thead>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </thead>
            <tbody id="data-pesanan"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include('./layout/footer.php'); ?>
<script>
    const modalDetail = document.getElementById('modalDetail')
    modalDetail.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const kode = button.getAttribute('data-bs-kode')
        const pesanan = modalDetail.querySelector('#data-pesanan')

        $.ajax({
            url: 'get_pesanan.php',
            type: 'GET',
            data: 'kode=' + kode,
            success: function(result) {
                pesanan.innerHTML = result
            }
        })
    })
</script>