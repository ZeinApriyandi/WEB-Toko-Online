<?php include('./layout/header.php'); ?>
<h1 class="mb-3">Data Produk</h1>
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Produk</button>
<table class="table table-bordered table-hover">
    <thead>
        <th>#</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Foto</th>
        <th>Aksi</th>
    </thead>
    <tbody>
<?php 
    include('../config/koneksi.php');

    if (isset($_POST['nama'])) {
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $foto = $_FILES['foto']['name'];
        $deskripsi = $_POST['deskripsi'];

        $sql = "INSERT INTO produk(kode,nama,id_kategori,harga,foto,deskripsi) 
                    VALUES('$kode','$nama','$kategori','$harga','$foto','$deskripsi')";
        $query = mysqli_query($conn, $sql);
        $pesan = "Data Produk gagal ditambah.";
        if ($query) {
            move_uploaded_file($_FILES['foto']['tmp_name'], "../img/produk/".$foto);
            $pesan = "Data Produk berhasil ditambah.";
        }

        echo "<script>
            alert('$pesan');
            location.href='./produk.php';
        </script>";
    }

    if (isset($_POST['nama_edit'])) {
        $id = $_POST['id_edit'];
        $kode = $_POST['kode_edit'];
        $nama = $_POST['nama_edit'];
        $harga = $_POST['harga_edit'];
        $deskripsi = $_POST['deskripsi_edit'];
        $kategori = $_POST['kategori_edit'];
        $foto = $_FILES['foto_edit']['name'];

        $sql = "UPDATE produk SET kode='$kode', nama='$nama', id_kategori='$kategori', harga='$harga', deskripsi='$deskripsi' WHERE id='$id'";
        $query = mysqli_query($conn, $sql);
        $pesan = "Data Produk gagal diupdate.";
        if ($query) {
            if (isset($foto)) {
                $sql = "SELECT foto FROM produk WHERE id='$id'";
                $query = mysqli_query($conn, $sql);
                $data = mysqli_fetch_array($query);

                if(file_exists("../img/produk/".$data['foto'])) {
                    unlink("../img/produk/".$data['foto']);
                }

                $sql = "UPDATE produk SET foto='$foto' WHERE id='$id'";
                $query = mysqli_query($conn, $sql);
                if($query){
                    move_uploaded_file($_FILES['foto_edit']['tmp_name'], "../img/produk/".$foto);
                }
            }
            $pesan = "Data Produk berhasil diupdate.";
        }

        echo "<script>
            alert('$pesan');
            location.href='./produk.php';
        </script>";
    }

    if (isset($_POST['kode_hapus'])) {
        $kode = $_POST['kode_hapus'];

        $sql = "SELECT foto FROM produk WHERE id='$kode'";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($query);

        if(file_exists("../img/produk/".$data['foto'])) {
            unlink("../img/produk/".$data['foto']);
        }

        $sql = "DELETE FROM produk WHERE id='$kode'";
        $query = mysqli_query($conn, $sql);
        $pesan = "Data Produk gagal dihapus.";
        if ($query) {
            $pesan = "Data Produk berhasil dihapus.";
        }

        echo "<script>
            alert('$pesan');
            location.href='./produk.php';
        </script>";
    }

    $sql = "SELECT * FROM produk";
    $urutan = 1;
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($query)){
        echo "<tr>
                <td>".$urutan++."</td>
                <td>".$row['kode']."</td>
                <td>".$row['nama']."</td>
                <td>Rp ".number_format($row['harga'], 2, ',', '.')."</td>
                <td>
                    <img width='100px' src='../img/produk/".$row['foto']."' /></td>
                <td>
                    <button data-bs-toggle='modal' data-bs-target='#modalEdit' class='btn btn-success btn-sm' 
                        data-bs-kode='".$row['id']."' 
                        data-bs-data='".$row['kode']."|".$row['nama']."|".$row['id_kategori']."|".$row['harga']."|".$row['deskripsi']."'>Edit</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="kode">Kode Produk</label>
                <input type="text" class="form-control" id="kode" name="kode">
            </div>
            <div class="form-group mb-3">
                <label for="nama">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="form-group mb-3">
                <label for="kategori">Kategori</label>
                <select class="form-select" id="kategori" name="kategori">
                <?php
                    $sql = "SELECT * FROM kategori";
                    $query = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($query)){
                        echo "<option value='".$row['id']."'>".$row['nama']."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="harga">Harga Jual</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="form-group mb-3">
                <label for="foto">Foto Produk</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="kode_edit">Kode Produk</label>
                <input type="hidden" id="id_edit" name="id_edit">
                <input type="text" class="form-control" id="kode_edit" name="kode_edit">
            </div>
            <div class="form-group mb-3">
                <label for="nama_edit">Nama Produk</label>
                <input type="text" class="form-control" id="nama_edit" name="nama_edit">
            </div>
            <div class="form-group mb-3">
                <label for="kategori_edit">Kategori</label>
                <select class="form-select" id="kategori_edit" name="kategori_edit">
                <?php
                    $sql = "SELECT * FROM kategori";
                    $query = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($query)){
                        echo "<option value='".$row['id']."'>".$row['nama']."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="harga_edit">Harga Jual</label>
                <input type="text" class="form-control" id="harga_edit" name="harga_edit">
            </div>
            <div class="form-group mb-3">
                <label for="foto_edit">Foto Produk</label>
                <input type="file" class="form-control" id="foto_edit" name="foto_edit" accept="image/*">
            </div>
            <div class="form-group mb-3">
                <label for="deskripsi_edit">Deskripsi Produk</label>
                <textarea class="form-control" id="deskripsi_edit" name="deskripsi_edit"></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group mb-3">
                <label for="nama_edit">Yakin hapus produk ini ?</label>
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
        const id = button.getAttribute('data-bs-kode')
        const data = button.getAttribute('data-bs-data').split('|')
        
        const inputId = modalEdit.querySelector('#id_edit')
        const inputKode = modalEdit.querySelector('#kode_edit')
        const inputNama = modalEdit.querySelector('#nama_edit')
        const inputKategori = modalEdit.querySelector('#kategori_edit')
        const inputHarga = modalEdit.querySelector('#harga_edit')
        const inputDeskripsi = modalEdit.querySelector('#deskripsi_edit')

        inputId.value = id
        inputKode.value = data[0]
        inputNama.value = data[1]
        inputKategori.value = data[2]
        inputHarga.value = data[3]
        inputDeskripsi.value = data[4]
    })

    const modalHapus = document.getElementById('modalHapus')
    modalHapus.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const kode = button.getAttribute('data-bs-kode')
        
        const inputKode = modalHapus.querySelector('#kode_hapus')

        inputKode.value = kode
    })
</script>