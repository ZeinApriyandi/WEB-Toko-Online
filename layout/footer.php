    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            getCart();
            getProvinsi();
        })

        function getCart() {
            $.ajax({
                url: 'cart.php',
                type: 'GET',
                success: function(result) {
                    $('#jumlah').html(result);
                }
            })
        }

        function addToCart(id) {
            $.ajax({
                url: 'cart.php',
                type: 'GET',
                data: 'tipe=tambah&kode=' + id,
                success: function(result) {
                    Swal.fire(
                        'Keranjang Belanja',
                        result,
                        'success'
                    )
                    getCart();
                }
            })
        }

        function removeFromCart(id) {
            Swal.fire({
                title: 'Keranjang Belanja',
                text: "Yakin hapus produk ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'cart.php',
                        type: 'GET',
                        data: 'tipe=hapus&kode=' + id,
                        success: function(result) {
                            Swal.fire(
                                'Keranjang Belanja',
                                result,
                                'success'
                            )
                            location.reload();
                        }
                    })
                }
            })
        }

        function getProvinsi() {
            $.ajax({
                url: 'provinsi.php',
                type: 'GET',
                success: function(result) {
                    var data = JSON.parse(result);
                    var hasil = "<option disabled selected>-- Pilih Provinsi--</option>";
                    data.rajaongkir.results.map(row => {
                        hasil += "<option value='" + row.province_id + "'>" + row.province + "</option>";
                    });

                    $('#provinsi').html(hasil);
                }
            })
        }

        $('#provinsi').change(function(){
            var hasil = $(this).val();
            getCity(hasil);
        })

        function getCity(id) {
            $.ajax({
                url: 'kota.php',
                type: 'GET',
                data: 'id=' + id,
                success: function(result) {
                    var data = JSON.parse(result);
                    var hasil = "<option disabled selected>-- Pilih Kota--</option>";
                    data.rajaongkir.results.map(row => {
                        hasil += "<option value='" + row.city_id + "'>" + row.type + " " + row.city_name + "</option>";
                    });

                    $('#kota').html(hasil);
                }
            })
        }

        $('#kurir').change(function(){
            var hasil = $(this).val();
            var kota = $('#kota').val();
            getCost(kota, hasil);
        })

        function getCost(city_id, courier) {
            $.ajax({
                url: 'ongkir.php',
                type: 'POST',
                data: 'kota=' + city_id + '&kurir=' + courier,
                success: function(result) {
                    var data = JSON.parse(result);
                    var hasil = "<option disabled selected>-- Pilih Paket --</option>";
                    data.rajaongkir.results[0].costs.map(row => {
                        hasil += "<option value='" + row.cost[0].value + "'>" + row.description + " (" + row.service + ") - " + row.cost[0].etd + " hari</option>";
                    });

                    $('#paket').html(hasil);
                }
            })
        }

        $('#paket').change(function(){
            var ongkir = $(this).val();
            var total = $('#total').html();

            var grand_total = parseInt(ongkir) + parseInt(total);
            $('#grandtotal').val(grand_total);
        })

        $('#formCheckOut').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Check Out Belanja',
                text: "Apakah Anda sudah yakin ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    var data = $(this).serialize();
                    $.ajax({
                        url: 'simpan_checkout.php',
                        method: 'POST',
                        data: data,
                        success: function(result) {
                            var hasil = result.split('|');

                            if (hasil[0] === '1') {
                                Swal.fire(
                                    'Check Out Belanja',
                                    hasil[1],
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = './';
                                    }
                                })
                            } else {
                                Swal.fire(
                                    'Check Out Belanja',
                                    hasil[1],
                                    'error'
                                );
                            }
                        }
                    })
                }
            })
        })
    </script>
</body>
</html>