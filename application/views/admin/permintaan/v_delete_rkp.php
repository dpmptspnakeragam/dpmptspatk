<?php foreach ($data_konfperm as $kode => $value) : ?>
    <div class="modal fade" id="delete_riwayat_konfperm<?= $value->id_konfperm; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Riwayat <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data riwayat konfirmasi <strong class="text-danger"><?= $value->kode_perm; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('permintaan/delete_riwayat_konfperm/' . $value->id_konfperm); ?>" class="btn btn-outline-danger">
                        Hapus
                    </a>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>