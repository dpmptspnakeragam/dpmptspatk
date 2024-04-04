    <div class="modal fade" id="tambahNama" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah <?= $action; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open_multipart('namabarang/add'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Nama</label>
                        <input name="nama_barang" type="text" class="form-control" value="<?= set_value('nama_barang'); ?>">
                        <small class="text-danger"><?= form_error('nama_barang'); ?></small>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pilih Gambar</label>
                                <input name="gambar" type="file" class="form-control-file" id="addBarangUpload" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <!-- Pratinjau gambar -->
                            <label>Pratinjau Gambar</label>
                            <div class="form-group">
                                <img src="<?= base_url('assets/image/barang/barang-default.png'); ?>" id="addBarangPreview" style="max-width: 100%; max-height: 200px;">
                            </div>
                        </div>
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

    <script>
        document.getElementById('addBarangUpload').onchange = function(e) {
            var input = e.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    document.getElementById('addBarangPreview').src = event.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        };
    </script>