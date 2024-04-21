<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Include all input fields here -->
                        <div class="form-group">
                            <label for="id_barang">Nama Barang</label>
                            <select class="form-control select2" id="id_barang" name="id_barang">
                                <option selected disabled>Pilih Nama Barang</option>
                                <?php foreach ($data_barang as $item) : ?>
                                    <option value="<?= $item->id_barang; ?>" data-kategori="<?= $item->nama_kategori; ?>" data-satuan="<?= $item->nama_satuan; ?>" data-harga="<?= $item->harga; ?>" <?= set_value('id_barang', $item->id_barang); ?>>
                                        <?= $item->nama_barang; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <input id="peminta" name="peminta" type="text" class="form-control form-control-sm" value="<?= $this->session->userdata('id_user'); ?>" hidden>
                        <input id="kategori_barang" type="text" class="form-control form-control-sm" readonly>
                        <input id="satuan_barang" type="text" class="form-control form-control-sm" readonly>
                        <input id="harga" name="harga" type="text" class="form-control form-control-sm" readonly>
                        <input id="total_harga" name="total" type="text" class="form-control form-control-sm" readonly>
                        <!-- End of input fields -->

                        <!-- Jumlah Permintaan -->
                        <div class="form-group">
                            <label>Jumlah Permintaan</label>
                            <input id="jumlah" name="jumlah" type="number" class="form-control form-control-sm">
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <!-- Tombol untuk menambahkan barang -->
                        <button id="tombol_tambah" type="button" class="btn btn-outline-primary">Tambah</button>
                        <a href="<?= base_url('permintaan'); ?>" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
            <!-- /.col -->

            <div class="col-sm-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action; ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabel_data_permintaan" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">Jumlah</th>
                                    <th class="text-center align-middle">Sub Total</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <!-- Form untuk menyimpan permintaan -->
                        <form id="form_simpan_permintaan" action="<?= base_url('permintaan/simpan_permintaan'); ?>" method="POST">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" class="form-control form-control-sm" rows="2"><?= set_value('keterangan'); ?></textarea>
                            </div>

                            <!-- Input untuk menyimpan data barang -->
                            <input type="hidden" id="input_barang" name="barang">

                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        </form>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    $(document).ready(function() {
        var nomor = 1; // Variabel untuk penomoran otomatis
        var dataBarang = []; // Variabel untuk menyimpan data barang sementara

        $('#tombol_tambah').click(function() {
            // Mengambil semua nilai input
            var id_barang = $('#id_barang').val();
            var id_user = $('#peminta').val();
            var nama_barang = $('#id_barang option:selected').text();
            var harga_barang = parseFloat($('#id_barang option:selected').data('harga'));
            var jumlah_permintaan = $('#jumlah').val();

            // Validasi barang harus dipilih
            if (id_barang === null || id_barang === '') {
                const ErrorToast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                ErrorToast.fire({
                    icon: "error",
                    title: "Pilih barang terlebih dahulu!"
                });
                return;
            }

            // Validasi jumlah harus diisi dan lebih dari 0
            if (jumlah_permintaan === '' || parseInt(jumlah_permintaan) <= 0) {
                const ErrorToast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                ErrorToast.fire({
                    icon: "error",
                    title: "Masukan jumlah permintaan!"
                });
                return;
            }

            // Validasi barang sudah ada di list
            var barangExists = dataBarang.some(function(item) {
                return item.id_barang === id_barang;
            });
            if (barangExists) {
                const ErrorToast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                ErrorToast.fire({
                    icon: "error",
                    title: "Barang sudah ada di dalam daftar!"
                });
                return;
            }

            // Hitung subtotal
            var sub_total = harga_barang * parseInt(jumlah_permintaan);

            // Tambahkan data ke array dataBarang
            dataBarang.push({
                id_barang: id_barang,
                nama_barang: nama_barang,
                jumlah_permintaan: jumlah_permintaan,
                sub_total: sub_total.toFixed(2)
            });

            // Tambahkan data ke tabel permintaan sementara
            $('#tabel_data_permintaan tbody').append(
                '<tr>' +
                '<td class="text-center align-middle">' + nomor++ + '</td>' +
                '<td class="text-center align-middle">' + nama_barang + '</td>' +
                '<td class="text-center align-middle">' + jumlah_permintaan + '</td>' +
                '<td class="text-center align-middle">' + sub_total.toFixed(2) + '</td>' +
                '<td class="text-center align-middle"><button type="button" class="btn btn-outline-danger btn-sm hapus-barang"><i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>'
            );

            // Bersihkan input setelah ditambahkan ke tabel
            $('#id_barang').val('');
            $('#jumlah').val('');

            // Hitung ulang total harga dari semua barang yang ditambahkan
            var total_harga = 0;
            $.each(dataBarang, function(index, item) {
                total_harga += parseFloat(item.sub_total);
            });

            // Tampilkan total harga pada input hidden
            $('#total_harga').val(total_harga.toFixed(2));

            // Hitung total bayar
            var total_bayar = total_harga; // Total bayar sama dengan total harga
            $('#total_bayar').text('Total Bayar: ' + total_bayar.toFixed(2));
        });

        // Ketika tombol hapus pada tabel barang sementara diklik
        $(document).on('click', '.hapus-barang', function() {
            var index = $(this).closest('tr').index();
            dataBarang.splice(index, 1); // Hapus data dari array dataBarang berdasarkan index
            $(this).closest('tr').remove(); // Hapus baris dari tabel sementara

            // Hitung ulang total harga setelah barang dihapus
            var total_harga = 0;
            $.each(dataBarang, function(index, item) {
                total_harga += parseFloat(item.sub_total);
            });

            // Tampilkan total harga pada input hidden
            $('#total_harga').val(total_harga.toFixed(2));

            // Hitung ulang total bayar setelah barang dihapus
            var total_bayar = total_harga; // Total bayar sama dengan total harga
            $('#total_bayar').text('Total Bayar: ' + total_bayar.toFixed(2));
        });

        // Ketika form disubmit (simpan permintaan)
        $('#form_simpan_permintaan').submit(function(e) {
            e.preventDefault(); // Mencegah form melakukan submit default

            // Mengambil nilai keterangan dari textarea
            var keterangan = $('#keterangan').val();

            // Memastikan ada barang yang telah ditambahkan sebelumnya
            if (dataBarang.length === 0) {
                const ErrorToast = Swal.mixin({
                    toast: true,
                    position: "top",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                ErrorToast.fire({
                    icon: "error",
                    title: "Pilih barang terlebih dahulu!"
                });
                return;
            }

            // Lakukan AJAX request untuk menyimpan data ke server
            $.ajax({
                url: '<?= base_url('permintaan/simpan_permintaan'); ?>',
                type: 'POST',
                data: {
                    keterangan: keterangan,
                    barang: JSON.stringify(dataBarang) // Ubah array menjadi JSON string sebelum dikirim
                },
                success: function(response) {
                    // Handle response dari server (jika diperlukan)
                    console.log(response);
                    // Clear temporary data after successful save
                    dataBarang = [];
                    $('#tabel_data_permintaan tbody').empty();
                    $('#total_harga').val('');
                    $('#total_bayar').text('');
                    $('#keterangan').val('');
                    const SimpanToast = Swal.mixin({
                        toast: true,
                        position: "top",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    SimpanToast.fire({
                        icon: "success",
                        title: "Permintaan berhasil disimpan."
                    }).then((result) => {
                        window.location.href = `<?= base_url('permintaan'); ?>`;
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error (jika diperlukan)
                    console.error(xhr.responseText);
                    const GagalToast = Swal.mixin({
                        toast: true,
                        position: "top",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    GagalToast.fire({
                        icon: "error",
                        title: "Gagal menyimpan permintaan."
                    });
                }
            });
        });
    });
</script>