    <?php foreach ($satuan as $ki => $value) : ?>
        <div class="modal fade" id="updateSatuan<?= $value->id_satuan; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Perbarui <?= $action; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open('satuanbarang/update/' . $value->id_satuan); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Satuan</label>
                            <input name="nama_satuan" type="text" class="form-control" value="<?= $value->nama_satuan; ?>">
                            <small class="text-danger"><?= form_error('nama_satuan'); ?></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
                        <?= form_submit('submit', 'Perbarui', 'class="btn btn-outline-info"'); ?>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>