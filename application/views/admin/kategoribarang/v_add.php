    <div class="modal fade" id="tambahKategori" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('kategoribarang/add'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input name="nama_kategori" type="text" class="form-control" value="<?= set_value('nama_kategori'); ?>">
                        <small class="text-danger"><?= form_error('nama_kategori'); ?></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                    <?= form_submit('submit', 'Simpan', 'class="btn btn-outline-primary"'); ?>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>