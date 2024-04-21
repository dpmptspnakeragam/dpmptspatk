<?php foreach ($data_permintaan as $id => $value) : ?>
    <div class="modal fade" id="konfirmasi<?= $value->id_konfperm; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Konfirmasi dan buat tanda tangan elektronik untuk seluruh permintaan ?
                    <br>
                    <span>Kode Permintaan : <strong class="text-primary"><?= substr($value->kode_perm, 0, strlen($value->kode_perm) - 16); ?></strong></span>
                    <br>

                    <?php
                    // Panggil query untuk mendapatkan nama user berdasarkan kode permintaan
                    $nama_user = $this->M_permintaan->tampilkan_nama_user_by_kode_perm($value->kode_perm);
                    ?>

                    <span>Nama Peminta : <strong class="text-primary"><?= $nama_user ? $nama_user->nama_user : ''; ?></strong></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('permintaan/konfirmasi/' . $value->id_konfperm); ?>" class="btn btn-outline-primary">Konfirmasi</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>