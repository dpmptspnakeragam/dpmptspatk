<?php foreach ($user as $id => $value) : ?>
    <div class="modal fade" id="deleteUser<?= $value->id_user; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus user <strong class="text-danger"><?= $value->nama_user; ?></strong> ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('datauser/delete/' . $value->id_user); ?>" class="btn btn-outline-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>