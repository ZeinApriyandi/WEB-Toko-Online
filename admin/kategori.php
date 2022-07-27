<?php include('./layout/header.php'); ?>
<h1 class="mb-3">Data Kategori</h1>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Kategori</button>
<table class="table table-bordered table-hover">
    <thead>
        <th>#</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </thead>
    <tbody>
<?php 
    include('../config/koneksi.php');

    if (isset($_POST['nama'])) {
        $nama = $_POST['nama'];

        $sql = "INSERT INTO kategori(nama) VALUES('$nama')";
        $query = mysqli_query($conn, $sql);
        $pesan = "Data Kategori gagal ditambah.";
        if ($query) {
            $pesan = "Data Kategori berhasil ditambah.";
        }

        echo "<script>
            alert('$pesan');
            location.href='./kategori.php';
        </script>";
    }

    if (isset($_POST['nama_edit'])) {
        $nama = $_POST['nama_edit'];
        $kode = $_POST['kode_edit'];

        $sql = "UPDATE kategori SET nama='$nama' WHERE id='$kode'";
        $query = mysqli_query($conn, $sql);
        $pesan = "Data Kategori gagal diupdate.";
        if ($query) {
            $pesan = "Data Kategori berhasil diupdate.";
        }

        echo "<script>
            alert('$pesan');
            location.href='./kategori.php';
        </script>";
    }

    if (isset($_POST['kode_hapus'])) {
        $kode = $_POST['kode_hapus'];

        $sql = "DELETE FROM kategori WHERE id='$kode'";
        $query = mysqli_query($conn, $sql);
        $pesan = "Data Kategori gagal dihapus.";
        if ($query) {
            $pesan = "Data Kategori berhasil dihapus.";
        }

        echo "<script>
            alert('$pesan');
            location.href='./kategori.php';
        </script>";
    }

    $sql = "SELECT * FROM kategori";
    $urutan = 1;
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($query)){
        echo "<tr>
                <td>".$urutan++."</td>
                <td>".$row['nama']."</td>
                <td>
                    <button data-bs-toggle='modal' data-bs-target='#modalEdit' class='btn btn-success btn-sm' data-bs-kode='".$row['id']."' data-bs-nama='".$row['nama']."'>Edit</button>
                    <button data-bs-toggle='modal' data-bs-target='#modalHapus' class='btn btn-danger btn-sm' data-bs-kode='".$row['id']."'>Hapus</button>
                </td>
            </tr>";
    }
?>
    </tbody>
</table>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group mb-3">
                <label for="nama">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group mb-3">
                <label for="nama_edit">Nama Kategori</label>
                <input type="hidden" id="kode_edit" name="kode_edit">
                <input type="text" class="form-control" id="nama_edit" name="nama_edit">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group mb-3">
                <label for="nama_edit">Yakin hapus kategori ini ?</label>
                <input type="hidden" id="kode_hapus" name="kode_hapus">
            </div>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include('./layout/footer.php'); ?>
<script>
    const modalEdit = document.getElementById('modalEdit')
    modalEdit.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const kode = button.getAttribute('data-bs-kode')
        const nama = button.getAttribute('data-bs-nama')
        
        const inputKode = modalEdit.querySelector('#kode_edit')
        const inputNama = modalEdit.querySelector('#nama_edit')

        inputKode.value = kode
        inputNama.value = nama
    })

    const modalHapus = document.getElementById('modalHapus')
    modalHapus.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const kode = button.getAttribute('data-bs-kode')
        
        const inputKode = modalHapus.querySelector('#kode_hapus')

        inputKode.value = kode
    })
</script>