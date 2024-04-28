<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <?= $action; ?></h3>
                    </div>
                    <div class="card-body">
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
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kategori_barang">Kategori Barang</label>
                                    <input id="kategori_barang" type="text" class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="satuan_barang">Satuan Barang</label>
                                    <input id="satuan_barang" type="text" class="form-control form-control-sm" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Satuan</label>
                            <input id="harga" name="harga" type="text" class="form-control form-control-sm" disabled>
                        </div>
                        <div class="form-group">
                            <label>QTY</label>
                            <input id="jumlah" name="jumlah" type="number" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="tombol_tambah" type="button" class="btn btn-outline-primary">Tambah</button>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tabel <?= $action; ?></h3>
                    </div>
                    <div class="card-body">
                        <table id="tabel_data_permintaan" class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">No</th>
                                    <th class="text-center align-middle">Nama Barang</th>
                                    <th class="text-center align-middle">QTY</th>
                                    <th class="text-center align-middle">Sub Total</th>
                                    <th class="text-center align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <form id="form_simpan_permintaan" action="<?= base_url('permintaan/simpan_permintaan'); ?>" method="POST">
                            <div class="form-group">
                                <label for="total_harga">Total Bayar</label>
                                <input id="total_harga" name="total" type="text" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" class="form-control form-control-sm" rows="2"><?= set_value('keterangan'); ?></textarea>
                            </div>
                            <input type="hidden" id="input_barang" name="barang">
                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                            <a href="<?= base_url('permintaan'); ?>" class="btn btn-outline-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script menampilkan tb_barang secara otomatis -->
<script>
    $(document).ready(function() {
        // Handle dropdown change
        $('#id_barang').change(function() {
            var selectedOption = $(this).find(':selected');
            var kategori = selectedOption.data('kategori');
            var satuan = selectedOption.data('satuan');
            var harga = selectedOption.data('harga');

            $('#kategori_barang').val(kategori);
            $('#satuan_barang').val(satuan);
            // Ubah format harga menjadi Rupiah
            $('#harga').val(formatRupiah(harga));
            hitungTotalHarga(); // Hitung total harga saat dropdown berubah
        });

        // Fungsi untuk mengubah format harga menjadi Rupiah
        function formatRupiah(angka) {
            var number_string = angka.toString();
            var split = number_string.split(',');
            var sisa = split[0].length % 3;
            var rupiah = split[0].substr(0, sisa);
            var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp. ' + rupiah;
        }

        // Hitung total harga saat input jumlah berubah
        $('#jumlah').on('input', function() {
            hitungTotalHarga();
        });

        // Fungsi hitung total harga
        function hitungTotalHarga() {
            var jumlah = parseInt($('#jumlah').val());
            var harga = parseInt($('#harga').val().replace(/\D/g, '')); // Menghilangkan semua karakter non-digit dari harga
            var total = jumlah * harga;

            // Ubah format total harga menjadi Rupiah
            $('#total_harga').val(formatRupiah(total));
        }
    });
</script>

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

            var satuan_barang = $('#id_barang option:selected').data('satuan');

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

            function formatRupiah(angka) {
                var number_string = angka.toString();
                var split = number_string.split(',');
                var sisa = split[0].length % 3;
                var ribuan = split[0].substr(0, sisa);
                var ribuan_baru = split[0].substr(sisa).match(/\d{3}/g);

                if (ribuan_baru) {
                    separator = sisa ? '.' : '';
                    ribuan += separator + ribuan_baru.join('.');
                }

                ribuan = split[1] != undefined ? ribuan + ',' + split[1] : ribuan;
                return 'Rp. ' + ribuan;
            }

            // Hitung subtotal
            var sub_total = harga_barang * parseInt(jumlah_permintaan);
            var formatted_sub_total = formatRupiah(sub_total.toFixed(2));

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
                '<td class="td-nama-barang align-middle">' + nama_barang + '</td>' +
                '<td class="text-center align-middle">' + jumlah_permintaan + ' ' + satuan_barang + '</td > ' +
                '<td class="text-right align-middle">' + formatted_sub_total + '</td>' +
                '<td class="text-center align-middle"><button type="button" class="btn btn-outline-danger btn-sm hapus-barang"><i class="fas fa-trash-alt"></i></button></td>' +
                '</tr>'
            );

            // Bersihkan input setelah ditambahkan ke tabel
            $('#jumlah').val('');
            $('#satuan_barang').val('');
            $('#kategori_barang').val('');
            $('#harga').val('');
            // Setelah seleksi selesai, kembalikan ke opsi default
            $('#id_barang').val('');
            $('#id_barang option:selected').prop('selected', false);
            $('#id_barang option:disabled').prop('selected', true);

            // Hitung ulang total harga dari semua barang yang ditambahkan
            var total_harga = 0;
            $.each(dataBarang, function(index, item) {
                total_harga += parseFloat(item.sub_total);
            });

            var formatted_total_harga = formatRupiah(total_harga.toFixed(2));

            // Tampilkan total harga yang diformat pada input hidden
            $('#total_harga').val(formatted_total_harga);


            // Hitung total bayar
            // var total_bayar = total_harga; // Total bayar sama dengan total harga
            // $('#total_bayar').text('Total Bayar: ' + total_bayar.toFixed(2));
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

<style>
    .td-nama-barang {
        max-width: 100px;
        /* Lebar maksimum sebelum diklik */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        /* Ubah kursor saat diarahkan ke nama barang */
    }

    .td-nama-barang-full {
        max-width: none;
        /* Menghapus batasan lebar maksimum */
        white-space: normal;
        /* Memastikan teks ditampilkan dengan normal (tidak terpotong) */
    }
</style>

<script>
    // Tambahkan event click pada nama_barang
    $(document).on('click', '.td-nama-barang', function() {
        // Toggle class untuk menampilkan/menutup nama barang dengan full
        $(this).toggleClass('td-nama-barang-full');
    });
</script>