    <?php foreach ($role as $ki => $value) : ?>
        <div class="modal fade" id="deleteRole<?= $value->id_role; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Hapus Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open('role/delete/' . $value->id_role); ?>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus role <strong class="text-danger"><?= $value->nama_role; ?></strong> ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <?= form_submit('submit', 'Hapus', 'class="btn btn-outline-danger   "'); ?>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>