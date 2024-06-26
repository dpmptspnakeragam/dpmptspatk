<?php foreach ($data_konfperm as $id => $value) : ?>
    <div class="modal fade" id="tolak<?= $value->id_konfperm; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tolak <?= $title; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Default box -->
                    <div class="card card-solid">
                        <div class="card-body">
                            <table id="TabelData1" class="table table-bordered table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" col>No</th>
                                        <th class="text-center align-middle">Nama Barang</th>
                                        <th class="text-center align-middle">QTY</th>
                                        <th class="text-center align-middle">Keterangan</th>
                                        <th class="text-center align-middle">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nama_barang = $this->M_permintaan->nama_barang($value->kode_perm); ?>

                                    <?php $count = 1; ?>
                                    <?php foreach ($nama_barang as  $barang) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $count++; ?></td>
                                            <td class="text-center align-middle nama-barang"><?= $barang->nama_barang; ?></td>
                                            <td class="text-center align-middle"><?= $barang->jumlah_perm; ?></td>
                                            <td class="text-center align-middle"><?= $barang->ket; ?></td>
                                            <td class="text-right align-middle">Rp. <?= number_format($barang->sub_total, 0, ',', '.'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <td class="text-center" colspan="3">Total</td>
                                    <td class="text-right">Rp. <?= number_format($value->total_bayar, 0, ',', '.'); ?></td>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="modal-footer">
                    <?= form_open('permintaan/tolak_perm/' . $value->id_konfperm); ?>
                    <div class="card-footer bg-transparent">
                        <?= form_submit('submit', 'Tolak', 'class="btn btn-outline-danger"'); ?>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<style>
    .nama-barang {
        max-width: 100px;
        /* Lebar maksimum sebelum diklik */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        /* Ubah kursor saat diarahkan ke nama barang */
    }

    .nama-barang-full {
        max-width: none;
        /* Menghapus batasan lebar maksimum */
        white-space: normal;
        /* Memastikan teks ditampilkan dengan normal (tidak terpotong) */
    }
</style>

<script>
    // Tambahkan event click pada nama_barang
    $(document).on('click', '.nama-barang', function() {
        // Toggle class untuk menampilkan/menutup nama barang dengan full
        $(this).toggleClass('nama-barang-full');
    });
</script>