<?php foreach ($data_konfperm as $id => $value) : ?>
    <div class="modal fade" id="tolakkonfirmasi<?= $value->id_konfperm; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tolak <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menolak permintaan atk ini ?
                    <br>
                    <span>Kode Permintaan : <strong class="text-danger"><?= $value->kode_perm; ?></strong></span>
                    <br>

                    <?php
                    // Panggil query untuk mendapatkan nama user berdasarkan kode permintaan
                    $nama_user = $this->M_permintaan->nama_user($value->kode_perm);
                    ?>

                    <span>Nama Peminta : <strong class="text-danger"><?= $nama_user ? $nama_user->nama_user : ''; ?></strong></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('permintaan/tolak_konf/' . $value->id_konfperm); ?>" class="btn btn-outline-danger">Tolak</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>