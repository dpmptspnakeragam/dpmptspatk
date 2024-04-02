    <?php foreach ($kategori as $ki => $value) : ?>
        <div class="modal fade" id="deleteKategori<?= $value->id_kategori; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Hapus <?= $action; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open('kategoribarang/delete/' . $value->id_kategori); ?>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus kategori <strong class="text-danger"><?= $value->nama_kategori; ?></strong> ini?
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